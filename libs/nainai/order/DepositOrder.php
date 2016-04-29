<?php
/**
 * @author panduo
 * @date 2016-4-25
 * @brief 保证金订单表 暂只支持余额支付
 *
 */
namespace nainai\order;
use \Library\M;
use \Library\Query;
use \Library\tool;
use \Library\url;
class DepositOrder{

	//合同制状态常量
	const CONTRACT_NOTFORM = 0;//合同未形成
	const CONTRACT_SELLER_DEPOSIT = 1;//合同等待卖家缴纳保证金
	const CONTRACT_CANCEL = 2;//卖家未按时支付保证金合同作废
	const CONTRACT_BUYER_RETAINAGE = 3;//卖家支付保证金后等待接受尾款
	const CONTRACT_EFFECT = 4;//支付完成合同生效
	const CONTRACT_COMPLETE = 5;//提货完成 合同完成

	private $order;//订单表
	private $offer;//报盘表
	private $account;//用户资金类
	private $products;//商品表
	private $paylog;//日志

	public function __construct(){
		$this->order = new M('deposit_order');
		$this->offer = new M('product_offer');
		$this->products = new M('products');
		$this->paylog = new M('pay_log');
		$this->account = new \nainai\fund\agentAccount();
	}

	/**
	 * 规则
	 */
	protected $orderRules = array(
		array('id','number','id错误',0,'regex'),
		array('offer_id','number','报盘id错误',0,'regex'),
		array('user_id','number','买方id错误',0,'regex'),
	);


	/**
	 * 新增或编辑保证金订单
	 * @param  array 操作数据数组
	 * @return mixed
	 */
	private function orderUpdate($data){
		$order = $this->order;
		if($order->data($data)->validate($this->orderRules)){
			if(isset($data['id']) && $data['id']>0){
				$id = $data['id'];
				//编辑
				unset($data['id']);
				$res = $order->where(array('id'=>$id))->data($data)->update();
				$res = $res>0 ? true : ($order->getError() ? $order->getError() : '数据未修改');
			}else{
				while($this->existOrderData(array('order_no'=>$data['order_no']))){
					$data['order_no'] = tool::create_uuid();
				}
				try {
					$order->beginTrans();
					$order_id = $order->data($data)->add();
					$this->payLog($order_id,$data['user_id'],0,'买方下单');
					
					$res = $order->commit();	
				} catch (PDOException $e) {
					$order->rollBack();
					$res = $e->getMessage();
				}
			}
		}else{
			$res = $order->getError();
		}
		
		if($res === true){
			$resInfo = tool::getSuccInfo();
		}else{
			$resInfo = tool::getSuccInfo(0,is_string($res) ? $res : '系统繁忙，请稍后再试');
		}
		return $resInfo;
	}

	/**
	 * 验证订单数据是否已存在
	 * @param array $orderData 订单数据
	 * @return bool  存在 true 否则 false
     */
	private function existOrderData($orderData){
		$data = $this->order->fields('id')->where($orderData)->getObj();
		if(empty($data))
			return false;
		return true;
	}


	//生成保证金摘牌订单
	public function geneOrder($orderData){
		$orderData['contract_status'] = self::CONTRACT_NOTFORM;
		$offer_info = $this->offerInfo($orderData['offer_id']);
		if(isset($offer_info['price']) && $offer_info['price']>0){
			$orderData['amount'] = $offer_info['price'] * $orderData['num'];
			$res = $this->orderUpdate($orderData);
		}else{
			$res = tool::getSuccInfo(0,'无效报盘');
		}

		return $res;
	}

	/**
	 * 根据订单id计算买方定金数额
	 * @param  array $info 订单信息数组
	 * @return float:定金数值 string:报错信息
	 */
	private function payDeposit($info){
		if(isset($info['offer_id']) && isset($info['amount'])){
			$amount = $info['amount'];
			if(($amount = floatval($amount)) > 0){
				//获取保证金比率
				$query = new Query('products as p');
				$query->join = 'left join product_offer as po on po.product_id = p.id left join product_category as pc on pc.id = p.cate_id';
				$query->fields = 'pc.percent';
				$query->where = 'po.id=:offer_id';
				$query->bind = array('offer_id'=>$info['offer_id']);
				$res = $query->getObj();
				$percent = intval($res['percent']);
				if($percent>0 && $percent<100){
					//能否等于0或者100
					return ($percent/100)*$amount;
				}
				return '无效定金比例';
			}
			return '无效订单';
		}else{
			return '参数错误';
		}
	}

	/**
	 * 根据保证金订单id获取报盘用户的id
	 * @param  int $order_id 订单id
	 * @return int:用户id string:错误信息
	 */
	private function sellerUserid($order_id){
		$query = new Query('deposit_order as o');
		$query->join = 'left join product_offer as po on po.id = o.offer_id';
		$query->fields = 'po.user_id';
		$query->where = 'o.id=:id';
		$query->bind = array('id'=>intval($order_id));
		$res = $query->getObj();
		$user_id = intval($res['user_id']);
		return $user_id ? $user_id : '用户不存在';
	}

	/**
	 * 买方预付定金(全款或定金)		
	 * @param int $order_id 保证金订单id
	 * @param int $type 0:定金1:全款 默认定金支付
	 * @param int $user_id 当前session用户id
	 * @return array 结果信息数组
	 */
	public function buyerDeposit($order_id,$type=0,$user_id){
		$info = $this->orderInfo($order_id);
		if(is_array($info) && isset($info['contract_status'])){
			if($info['contract_status'] != self::CONTRACT_NOTFORM)
				return tool::getSuccInfo(0,'合同状态有误');
			if($info['user_id'] != $user_id)
				return tool::getSuccInfo(0,'订单买家信息有误');
			$orderData['id'] = $order_id;
			$orderData['contract_status'] = self::CONTRACT_SELLER_DEPOSIT;//合同状态置为等待卖方保证金支付
			if($type == 0){
				//定金支付
				$pay_deposit = $this->payDeposit($info);
				if(is_float($pay_deposit)){
					$orderData['pay_deposit'] = $pay_deposit;
				}else{
					return tool::getSuccInfo(0,$pay_deposit);
				}
			}else{
				//全款
				$amount = floatval($info['amount']);
				if($amount>0){
					$orderData['pay_deposit'] = $amount;
				}else{
					return tool::getSuccInfo(0,'无效订单');
				}
			}

			try {
				$this->order->beginTrans();
				$upd_res = $this->orderUpdate($orderData);
				if($upd_res['success'] == 1){
					//冻结买方帐户资金  payment=1 余额支付
					$acc_res = $this->account->freeze($info['user_id'],$orderData['pay_deposit']);
					if($acc_res === true){
						$pro_res = $this->productsFreeze($this->offerInfo($info['offer_id']),$info['num']);
						if($pro_res === true){
							$log_res = $this->payLog($order_id,$user_id,0,'买方预付定金--'.$type == 0 ? '定金' : '全款');
							if($log_res === true){
								$res = $this->order->commit();
							}else{
								$this->order->rollBack();
								$res = $log_res;
							}
						}else{
							$this->order->rollBack();
							$res = $pro_res;
						}
					}else{
						$this->order->rollBack();
						$res = $acc_res['info'];
					}	
				}else{
					$this->order->rollBack();
					$res = $upd_res['info'];
				}
			} catch (PDOException $e) {
				$this->order->rollBack();
				$res = $e->getMessage();
			}
		}else{
			$res = '无效订单id';
		}
		return $res === true ? tool::getSuccInfo() : tool::getSuccInfo(0,$res ? $res : '未知错误');
	}

	/**
	 * 卖方支付保证金
	 * @param  int  $order_id 订单id
	 * @param  boolean $pay      卖方是否支付保证金 若未支付则取消合同 同时扣除卖方信誉值
	 * @param  int $user_id session中用户id
	 * @return array   结果信息数组
	 */
	public function sellerDeposit($order_id,$pay = true,$user_id){
		$info = $this->orderInfo($order_id);
		if(is_array($info) && isset($info['contract_status'])){
			$orderData['id'] = $order_id;
			$seller = $this->sellerUserid($order_id);//获取卖方帐户id

			if($info['contract_status'] != self::CONTRACT_SELLER_DEPOSIT)
				return tool::getSuccInfo(0,'合同状态有误');
			if($seller != $user_id)
				return tool::getSuccInfo(0,'订单卖家信息有误');
			try {
				$this->order->beginTrans();
				if($pay === false){
					//未支付 合同取消
					
					//扣除信誉值 TODO
					
					//将买方冻结资金解冻
					$acc_res = $this->account->freezeRelease($info['user_id'],floatval($info['pay_deposit']));
					//将商品数量解冻
					$pro_res = $this->productsFreezeRelease($this->offerInfo($info['offer_id']),$info['num']);

					$log_res = $this->payLog($order_id,$user_id,1,'卖方未支付保证金,合同作废,扣除信誉值');
					$orderData['contract_status'] = self::CONTRACT_CANCEL;

				}elseif($pay === true){
					//卖方支付保证金
					
					if(is_int($seller)){
						//获取卖方保证金数值 TODO
						$seller_deposit = 1;
						//冻结卖方帐户保证金
						$acc_res = $this->account->freeze($seller,$seller_deposit);
						$orderData['seller_deposit'] = $seller_deposit;
						//判断此订单是否支付全款
						if($info['amount'] === $info['pay_deposit']){
							//全款 合同生效 等待提货 生成提货表 TODO
							$orderData['contract_status'] = self::CONTRACT_EFFECT;
						}else{
							//定金 等待支付尾款
							$orderData['contract_status'] = self::CONTRACT_BUYER_RETAINAGE;
						}
						$pro_res = true;
						$log_res = $this->payLog($order_id,$user_id,1,'卖方支付保证金');
					}else{
						$res = $seller;
					}
				}else{
					$res = '参数错误';
				}

				if($acc_res === true){
					$upd_res = $this->orderUpdate($orderData);
					if($upd_res['success'] == 1){
						$res = $pro_res === true && $log_res === true ? $this->order->commit() : ($pro_res === true ? $log_res : $pro_res);
					}else{
						$this->order->rollBack();
						$res = $upd_res['info'];
					}
				}else{
					$this->order->rollBack();
					$res = isset($acc_res['info']) ? $acc_res['info'] : $res;
				}
			} catch (PDOException $e) {
				$res = $e->getMessage();
				$this->order->rollBack();
			}
		}else{
			$res = '无效订单id';
		}

		return $res === true ? tool::getSuccInfo() : tool::getSuccInfo(0,$res ? $res : '未知错误');
	}


	//买家支付尾款
	public function buyerRetainage($order_id,$user_id,$payment='online',$proof = ''){
		$info = $this->orderInfo(intval($order_id));
		if(is_array($info) && isset($info['contract_status'])){
			if($info['contract_status'] == self::CONTRACT_BUYER_RETAINAGE){
				if($info['user_id'] != $user_id)
					return tool::getSuccInfo(0,'订单买家信息有误');

				$amount = floatval($info['amount']);
				$buyerDeposit = floatval($info['pay_deposit']);
				$retainage = $amount - $buyerDeposit;

				if($retainage>0){
					try {
						$this->order->beginTrans();
						$orderData['id'] = $order_id;
						if($payment == 'online'){
							//冻结买家帐户余额
							$acc_res = $this->account->freeze($info['user_id'],$retainage);

							if($acc_res === true){
								$orderData['pay_retainage'] = $retainage;
								$orderData['contract_status'] = self::CONTRACT_EFFECT;//payment为1  合同状态置为生效
								$upd_res = $this->orderUpdate($orderData);
								if($upd_res['success'] == 1){
									$log_res = $this->payLog($order_id,$user_id,0,'买家线上支付尾款');
									$res = $log_res === true ? $this->order->commit() : $log_res;
								}else{
									$res = $upd_res['info'];
								}
							}else{
								$this->order->rollBack();
								$res = $acc_res['info'];
							}
						}elseif($payment == 'offline'){
							//买方上传支付凭证 TODO
							$orderData['proof'] = $proof;
							$upd_res = $this->orderUpdate($orderData);
							if($upd_res['success'] == 1){
								$log_res = $this->payLog($order_id,$user_id,0,'买家上传线下支付凭证');
								$res = $log_res === true ? $this->order->commit() : $log_res;
							}else{
								$res = $upd_res['info'];
							}
						}else{
							$this->order->rollBack();
							$res = '无效支付方式';
						}	
					} catch (PDOException $e) {
						$res = $e->getMessage();
						$this->order->rollBack();
					}
				}else{
					$res = '合同金额有误';
				}
			}else{
				$res = '合同状态有误';
			}
		}else{
			$res = '无效保证金订单';
		}

		return $res === true ? tool::getSuccInfo() : tool::getSuccInfo(0,$res ? $res : '未知错误');
	}

	/**
	 * 卖家确认买家线下支付凭证
	 * @param  int  $order_id 订单id
	 * @param  int  $user_id  session中用户id
	 * @param  boolean $confirm  true:确认收款 false:未收款 买家需重新上传凭证
	 * @return array  结果信息数组
	 */
	public function confirmProof($order_id,$user_id,$confirm = true){
		$info = $this->orderInfo($order_id);
		if(is_array($info) && isset($info['contract_status'])){
			if($info['contract_status'] != self::CONTRACT_BUYER_RETAINAGE){
				return tool::getSuccInfo(0,'合同状态有误');
			}
			$seller = $this->sellerUserid($order_id);//获取卖方帐户id
			if($seller != $user_id)
				return tool::getSuccInfo(0,'订单卖家信息有误');

			if(empty($info['proof'])){
				return tool::getSuccInfo(0,'无效支付凭证');
			}
			$orderData['id'] = $order_id;
			if($confirm === true){
				//卖家确认收款
				
				//合同状态置为生效
				$orderData['contract_status'] = self::CONTRACT_EFFECT;
				$log_res = $this->payLog($order_id,$user_id,1,'卖家确认线下支付凭证');
			}elseif($confirm === false){
				//删除之前上传proof
				$orderData['proof'] = null;
				$log_res = $this->payLog($order_id,$user_id,1,'线下支付凭证无效');
				//发送提示信息买家  TODO
			}else{
				$res = '参数错误';
			}

			if(!isset($res)){
				try {
					$this->order->beginTrans();
					$upd_res = $this->orderUpdate($orderData);
					if($upd_res['success'] == 1){
						$res = $log_res === true ? $this->order->commit() : $log_res;
					}else{
						$this->order->rollBack();
						$res = $upd_res['info'];
					}
				} catch (PDOException $e) {
					$this->order->rollBack();
					$res = $e->getMessage();
				}
			}

		}else{
			$res = '无效订单id';
		}

		return $res === true ? tool::getSuccInfo() : tool::getSuccInfo(0,$res ? $res : '未知错误');
	}

	//根据订单id获取订单内容	
	public function orderInfo($order_id){
		return empty($order_id) ? array() : $this->order->where(array('id'=>$order_id))->getObj();
	}


	//根据报盘id获取相应信息
	private function offerInfo($offer_id){
		$query = new Query('product_offer as po');
		$query->join = 'left join user as u on po.user_id = u.id';
		$query->where = " po.id = :id";
		$query->bind = array('id'=>$offer_id);
		$query->fields = "po.*,u.username";
		$res = $query->getObj();
		return $res ? $res : array();
	}

	/**
	 * 获取用户所有合同信息(含商品信息与买家信息)
	 * @param  int $user_id 卖家id
	 */
	public function depositContractList($user_id,$page,$where = array()){
		$query = new Query('deposit_order as do');
		$query->join  = 'left join product_offer as po on do.offer_id = po.id left join user as u on u.id = do.user_id left join products as p on po.product_id = p.id';
		$query->where = 'po.user_id = :user_id';
		// $bind = array();
		// if($where){
		// 	foreach ($where as $key => $value) {
		// 		$query->where .= $value[0];	
		// 		$bind = array_merge($bind,$value[1]);
		// 	}
		// }
		$query->fields = 'u.username,do.*,p.name as product_name,p.unit';
		// $query->bind  = array_merge($bind,array('user_id'=>$user_id));
		$query->bind  = array('user_id'=>$user_id);
		$query->page  = $page;
		$query->pagesize = 2;
		// $query->order = "sort";
		$data = $query->find();
		foreach ($data as $key => &$value) {
			//根据合同状态得出对应操作
			$contract_status = $value['contract_status'];
			$href = '';
			switch ($contract_status) {
				case self::CONTRACT_NOTFORM:
					$title = '等待买方付款';
					break;
				case self::CONTRACT_SELLER_DEPOSIT:
					$title = '支付保证金';
					$href  = url::createUrl('/Deposit/sellerDeposit?order_id='.$value['id']);
					break;
				case self::CONTRACT_CANCEL:
					$title = '合同已作废';
					break;
				case self::CONTRACT_EFFECT:
					$title = '合同生效,待提货';
					break;
				case self::CONTRACT_BUYER_RETAINAGE:
					if(empty($value['proof'])){
						$title = '等待支付尾款';
					}else{
						$title = '确认线下凭证';
						$href  = url::createUrl('/Deposit/confirmProof?order_id='.$value['id']);
					}
					break;
				case self::CONTRACT_COMPLETE:
					$title = '合同已完成';
					break;
				default:
					$title = '无效状态';
					break;
			}

			$value['action'] = $title;
			$value['action_href'] = $href;
		}
		// tool::pre_dump($data);
		$pageBar =  $query->getPageBar();
		return array('data'=>$data,'bar'=>$pageBar);
	}

	/**
	 * 买家支付定金后冻结相应数量的商品
	 * @param  array $offer_info 报盘信息数组
	 * @param  float $num  商品数目
	 * @return true:冻结成功 string:报错信息
	 */
	private function productsFreeze($offer_info,$num){
		$num = floatval($num);
		if($offer_info && is_array($offer_info) && $num > 0){
			$product = $this->products->where(array('id'=>$offer_info['product_id']))->getObj();
			if($product){
				$quantity = floatval($product['quantity']); //商品总数量
				$sell = floatval($product['sell']); //商品已售数量
				$freeze = floatval($product['freeze']);//商品已冻结数量
				if($offer_info['divide'] == 0 && $num != $quantity)
					return '此商品不可拆分';

				$product_left = $quantity-$sell-$freeze;//商品剩余数量
				if($num > $product_left)
					return '商品存货不足';
				if($num < $offer_info['minimum'])
					return '小于最小起订量';

				$res = $this->products->where(array('id'=>$product['id']))->data(array('freeze'=>$num))->update();
				return is_int($res) && $res>0 ? true : ($this->products->getError() ? $this->products->getError() : '数据未修改');
			}
			return '无效产品';
		}
		return '无效报盘';
	}
	/**
	 * 合同作废 将冻结的商品数量恢复
	 * @param  array $offer_info 报盘信息数组
	 * @param  float $num  商品数目
	 * @return true:解冻成功 string:报错信息
	 */
	private function productsFreezeRelease($offer_info,$num){
		$num = floatval($num);
		if($offer_info && is_array($offer_info) && $num > 0){
			$product = $this->products->where(array('id'=>$offer_info['product_id']))->getObj();
			$freeze = floatval($product['freeze']);//已冻结商品数量
			if($freeze >= $num){
				$res = $this->products->where(array('id'=>$product['id']))->data(array('freeze'=>($freeze-$num)))->update();
				return is_int($res) && $res>0 ? true : ($this->products->getError() ? $this->products->getError() : '数据未修改');
			}else{
				return '冻结商品数量有误';
			}
		}else{
			return '无效报盘';
		}
	}

	//记录日志
	private function payLog($order_id,$user_id,$user_type,$remark = ''){
		$res = $this->paylog->data(array('pay_type'=>'deposit_order','order_id'=>$order_id,'user_id'=>$user_id,'user_type'=>$user_type,'remark'=>$remark,'create_time'=>date('Y-m-d H:i:s',time())))->add();
		$err = $this->paylog->getError();
		return  intval($res) > 0 ? true : (!empty($err) ? $err : '日志记录失败');
	}

}




