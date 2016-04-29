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

	public function __construct(){
		$this->order = new M('order_deposit');
		$this->offer = new M('product_offer');
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
	public function orderUpdate($data){
		$order = $this->order;
		if($order->data($data)->validate($this->orderRules)){
			if(isset($data['id']) && $data['id']>0){
				$id = $data['id'];
				//编辑
				unset($data['id']);
				$res = $order->where(array('id'=>$id))->data($data)->update();
				$res = is_int($res) && $res>0 ? true : ($order->getError() ? $order->getError() : '数据未修改');
			}else{
				while($this->existOrderData(array('order_no'=>$data['order_no']))){
					$data['order_no'] = tool::create_uuid();
				}
				
				$order->beginTrans();
				$aid = $order->data($data)->add();
				//TODO
				$res = $order->commit();
			}
		}else{
			$res = $order->getError();
		}
	
		
		if($res===true){
			$resInfo = tool::getSuccInfo();
		}
		else{
			$resInfo = tool::getSuccInfo(0,is_string($res) ? $res : '系统繁忙，请稍后再试');
		}
		return $resInfo;
	}

	/**
	 * 验证订单数据是否已存在
	 * @param array $orderData 订单数据
	 * @return bool  存在 true 否则 false
     */
	public function existOrderData($orderData){
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
	public function payDeposit($info){
		if(isset($info['offer_id']) && isset($info['amount'])){
			$amount = $info['amount'];
			if(($amount = floatval($amount)) > 0){
				//获取保证金比率
				$query = new Query('products as p');
				$query->join = 'left join product_offer as po on po.product_id = p.id left join product_category as pc on pc.id = p.cate_id';
				$query->fields = 'pc.percent';
				$query->where = 'po.id=:offer_id';
				$query->bind = array('offer_id'=>$info['offer_id']);
				$percent = intval($query->getObj()['percent']);
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
	public function sellerUserid($order_id){
		$query = new Query('order_deposit as o');
		$query->join = 'left join product_offer as po on po.id = o.offer_id';
		$query->fields = 'po.user_id';
		$query->where = 'o.id=:id';
		$query->bind = array('id'=>intval($order_id));
		$user_id = $query->getObj()['user_id'];
		return intval($user_id) ? intval($user_id) : '用户不存在';
	}

	/**
	 * 买方预付定金(全款或定金)		
	 * @param int $order_id 保证金订单id
	 * @param int $type 0:定金1:全款 默认定金支付
	 * @return array 结果信息数组
	 */
	public function buyerDeposit($order_id,$type=0){
		if(isset($order_id)){
			$info = $this->orderInfo($order_id);
			if($info['contract_status'] != self::CONTRACT_NOTFORM)
				return tool::getSuccInfo(0,'合同状态有误');
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
						$res = $this->order->commit();
					}else{
						$this->order->rollBack();
						$res = $acc_res['info'];
					}	
				}else{
					$this->order->rollBack();
					$res = $upd_res['info'];
				}
			} catch (\PDOException $e) {
				$res = $e->getMessage();
				$this->order->rollBack();
			}
			return $res === true ? tool::getSuccInfo() : tool::getSuccInfo(0,$res ? $res : '未知错误');
		}else{
			return tool::getSuccInfo(0,'未指定订单id');
		}
	}

	/**
	 * 卖方支付保证金
	 * @param  int  $order_id 订单id
	 * @param  boolean $pay      卖方是否支付保证金 若未支付则取消合同 同时扣除卖方信誉值
	 * @return array   结果信息数组
	 */
	public function sellerDeposit($order_id,$pay = true){
		if(($order_id = intval($order_id)) > 0 ){
			$orderData['id'] = $order_id;
			$info = $this->orderInfo($order_id);
			if($info['contract_status'] != self::CONTRACT_SELLER_DEPOSIT)
				return tool::getSuccInfo(0,'合同状态有误');
			try {
				$this->order->beginTrans();
				if($pay === false){
					//未支付 合同取消
					
					//扣除信誉值 TODO
					
					//将买方冻结资金解冻
					$acc_res = $this->account->freezeRelease($info['user_id'],floatval($info['pay_deposit']));
					$orderData['contract_status'] = self::CONTRACT_CANCEL;
				}elseif($pay === true){
					//卖方支付保证金

					//获取卖方帐户id
					$seller = $this->sellerUserid($order_id);
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
					}else{
						$res = $seller;
					}
				}else{
					$res = '参数错误';
				}

				if($acc_res === true){
					$upd_res = $this->orderUpdate($orderData);
					if($upd_res['success'] == 1){
						$res = $this->order->commit();
					}else{
						$this->order->rollBack();
						$res = $upd_res['info'];
					}
				}else{
					$this->order->rollBack();
					$res = isset($acc_res['info']) ? $acc_res['info'] : $res;
				}
			} catch (\PDOException $e) {
				$res = $e->getMessage();
				$this->order->rollBack();
			}
			return $res === true ? tool::getSuccInfo() : tool::getSuccInfo(0,$res ? $res : '未知错误');
		}else{
			return tool::getSuccInfo(0,'参数错误');
		}
	}


	//买家支付尾款
	public function buyerRetainage($order_id,$payment='online',$proof = ''){
		$info = $this->orderInfo(intval($order_id));
		if(is_array($info) && isset($info['contract_status'])){
			if($info['contract_status'] == self::CONTRACT_BUYER_RETAINAGE){
				$amount = floatval($info['amount']);
				$buyerDeposit = floatval($info['pay_deposit']);
				$retainage = $amount - $buyerDeposit;

				if($retainage>0){
					try {
						$this->order->beginTrans();
						$orderData['id'] = $order_id;
						$orderData['contract_status'] = self::CONTRACT_EFFECT;//payment为1  合同状态置为生效
						if($payment == 'online'){
							//冻结买家帐户余额
							$acc_res = $this->account->freeze($info['user_id'],$retainage);

							if($acc_res === true){
								$orderData['pay_retainage'] = $retainage;
								$upd_res = $this->orderUpdate($orderData);
								if($upd_res['success'] == 1){
									$res = $this->order->commit();
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
								$res = $this->order->commit();
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
	 * @param  boolean $confirm  true:确认收款 false:未收款 买家需重新上传凭证
	 * @return array  结果信息数组
	 */
	public function confirmProof($order_id,$confirm = true){
		if(($order_id = intval($order_id)) > 0 ){
			$info = $this->orderInfo($order_id);
			if($info['contract_status'] != self::CONTRACT_BUYER_RETAINAGE){
				return tool::getSuccInfo(0,'合同状态有误');
			}

			if(empty($info['proof'])){
				return tool::getSuccInfo(0,'无效支付凭证');
			}
			$orderData['id'] = $order_id;
			if($confirm === true){
				//卖家确认收款
				
				//合同状态置为生效
				$orderData['contract_status'] = self::CONTRACT_EFFECT;

			}elseif($confirm === false){
				//删除之前上传proof
				$orderData['proof'] = null;

				//发送提示信息买家  TODO
			}else{
				$res = '参数错误';
			}

			if(!isset($res)){
				$upd_res = $this->orderUpdate($orderData);
				$res = $upd_res['success'] === 1 ? true : $upd_res['info'];
			}

		}else{
			$res = '参数错误';
		}

		return $res === true ? tool::getSuccInfo() : tool::getSuccInfo(0,$res ? $res : '未知错误');
	}

	//根据订单id获取订单内容	
	public function orderInfo($order_id){
		return $this->order->where(array('id'=>$order_id))->getObj();
	}


	//根据报盘id获取相应信息
	public function offerInfo($offer_id){
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
		$query = new Query('order_deposit as do');
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

}




