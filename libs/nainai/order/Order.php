<?php
/**
 * @author panduo
 * @date 2016-5-2
 * @brief 合同订单基类
 *
 */
namespace nainai\order;
use \Library\M;
use \Library\Query;
use \Library\tool;
use \Library\url;
class Order{

	//合同制状态常量
	const CONTRACT_NOTFORM = 0;//合同未形成
	const CONTRACT_SELLER_DEPOSIT = 1;//合同等待卖家缴纳保证金
	const CONTRACT_CANCEL = 2;//卖家未按时支付保证金合同作废
	const CONTRACT_BUYER_RETAINAGE = 3;//卖家支付保证金后等待接受尾款
	const CONTRACT_EFFECT = 4;//支付完成合同生效
	const CONTRACT_COMPLETE = 5;//提货完成 合同完成

	//订单类型常量定义
	const ORDER_FREE = 1;//自由报盘订单
	const ORDER_DEPOSIT = 2;//保证金报盘订单
	const ORDER_STORE = 3;//仓单报盘订单

	protected $order_table;//订单表
	protected $order;
	protected $offer;//报盘表
	protected $account;//用户资金类
	protected $products;//商品表
	protected $paylog;//日志

	/**
	 * 规则
	 */
	protected $orderRules = array(
		array('id','number','id错误',0,'regex'),
		array('offer_id','number','报盘id错误',0,'regex'),
		array('user_id','number','买方id错误',0,'regex'),
	);


	public function __construct($order_type){
		switch ($order_type) {
			case self::ORDER_FREE:
				$table = 'free_order';
				break;
			case self::ORDER_DEPOSIT:
				$table = 'deposit_order';
				break;
			case self::ORDER_STORE:
				$table = 'store_order';
				break;
			
			default:
				$table = '';
				break;
		}
		if(empty($table)) return false;
		$this->order_table = $table;
		$this->order = new M($table);
		$this->offer = new M('product_offer');
		$this->products = new M('products');
		$this->paylog = new M('pay_log');
		$this->account = new \nainai\fund\agentAccount();
	}	


	/**
	 * 新增或更新订单数据
	 * @param  object $order 订单表对象	
	 * @param  array $data  订单数据
	 * @return array $res  返回结果信息
	 */
	protected function orderUpdate($data){
		$order = $this->order;
		if($order->data($data)->validate($this->orderRules)){
			if(isset($data['id']) && $data['id']>0){
				$id = $data['id'];
				//编辑
				unset($data['id']);
				$res = $order->where(array('id'=>$id))->data($data)->update();
				$res = $res>0 ? true : ($order->getError() ? $order->getError() : '数据未修改');
			}else{
				while($this->existOrderData($order,array('order_no'=>$data['order_no']))){
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
	 * @param object $order 订单表对象
	 * @param array $orderData 订单数据
	 * @return bool  存在 true 否则 false
     */
	private function existOrderData($order,$orderData){
		$data = $order->fields('id')->where($orderData)->getObj();
		if(empty($data))
			return false;
		return true;
	}


	//生成摘牌订单
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
	 * 根据订单id获取报盘用户的id
	 * @param  int $order_id 订单id
	 * @return int:用户id string:错误信息
	 */
	protected function sellerUserid($order_id){
		$query = new Query($this->order_table.' as o');
		$query->join = 'left join product_offer as po on po.id = o.offer_id';
		$query->fields = 'po.user_id';
		$query->where = 'o.id=:id';
		$query->bind = array('id'=>intval($order_id));
		$res = $query->getObj();
		$user_id = intval($res['user_id']);
		return $user_id ? $user_id : '用户不存在';
	}

	//根据订单id获取订单内容	
	protected function orderInfo($order_id){
		return empty($order_id) ? array() : $this->order->where(array('id'=>$order_id))->getObj();
	}

	//根据报盘id获取相应信息
	protected function offerInfo($offer_id){
		$query = new Query('product_offer as po');
		$query->join = 'left join user as u on po.user_id = u.id';
		$query->where = " po.id = :id";
		$query->bind = array('id'=>$offer_id);
		$query->fields = "po.*,u.username";
		$res = $query->getObj();
		return $res ? $res : array();
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
			$res = '无效订单';
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

	/**
	 * 根据订单id计算买方定金数额
	 * @param  array $info 订单信息数组
	 * @return float:定金数值 string:报错信息
	 */
	final protected function payDeposit($info){
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
	 * 买家支付定金后冻结相应数量的商品
	 * @param  array $offer_info 报盘信息数组
	 * @param  float $num  商品数目
	 * @return true:冻结成功 string:报错信息
	 */
	final protected function productsFreeze($offer_info,$num){
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

				$res = $this->products->where(array('id'=>$product['id']))->data(array('freeze'=>$freeze+$num))->update();
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
	final protected function productsFreezeRelease($offer_info,$num){
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

	/**
	 * 订单日志记录
	 * @param  int $order_id  订单id
	 * @param  int $user_id   操作用户id
	 * @param  int $user_type 操作用户身份 0:买家 1:卖家
	 * @param  string $remark 备注
	 * @return array $res     返回结果信息
	 */
	final protected function payLog($order_id,$user_id,$user_type,$remark){
		$res = $this->paylog->data(array('pay_type'=>$this->order_table,'order_id'=>$order_id,'user_id'=>$user_id,'user_type'=>$user_type,'remark'=>$remark,'create_time'=>date('Y-m-d H:i:s',time())))->add();
		$err = $this->paylog->getError();
		return  intval($res) > 0 ? true : (!empty($err) ? $err : '日志记录失败');
	}

}