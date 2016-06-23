<?php
/**
 * @author panduo
 * @date 2016-06-21 13:31:28
 * @brief 采购订单
 *
 */
namespace nainai\order;
use \Library\M;
use \Library\Query;
use \Library\tool;
use \Library\url;

class PurchaseOrder extends Order{
	
	public function __construct(){
		parent::__construct(parent::ORDER_DEPOSIT);
		$this->purchase = new M('purchase_report');
	}

	/**
	 * 生成采购订单
	 * @param  int $purchase_id 采购表purchase_report id
	 * @param  int $type 0:定金 1:全款
	 * @return array  结果数组
	 */
	public function purchaseOrder($purchase_id,$type = 0){

		$query = new Query('purchase_report as pr');
		$query->join = 'left join product_offer as po on pr.offer_id = po.id left join products as p on po.product_id = p.id left join order_sell as o on po.id = o.offer_id';
		$query->fields = 'pr.*,p.id as product_id,p.quantity,po.user_id as buyer_id,o.id as order_id';
		$query->where = 'pr.id = :purchase_id';
		$query->bind = array('purchase_id'=>$purchase_id);
		$purchase_info = $query->getObj();
		if(empty($purchase_info['order_id'])){

			$product_info = $this->products->where(array('id'=>$purchase_info['product_id']))->getObj();
			
			try {
				$this->offer->beginTrans();
				$this->offer->data(array('price'=>$purchase_info['price']))->where(array('id'=>$purchase_info['offer_id']))->update();

				$orderData['offer_id'] = $purchase_info['offer_id'];
				$orderData['num'] = $purchase_info['quantity'];
				$orderData['order_no'] = tool::create_uuid();
				$orderData['user_id'] = $purchase_info['seller_id'];
				$orderData['create_time'] = date('Y-m-d H:i:s',time());
				$orderData['mode'] = self::ORDER_PURCHASE;
				$gen_res = $this->geneOrder($orderData);
				if($gen_res['success'] == 1){
					$this->payLog($order_id,$data['user_id'],0,'买方下单');
					//支付定金
					$deposit = new \nainai\order\DepositOrder();
					$dep_res = $deposit->buyerDeposit($gen_res['order_id'],$type,$purchase_info['buyer_id']);
					if($dep_res['success'] != 1){
						$error = $dep_res['info'];
					}
				}else{
					$error = $gen_res['info'];
				}
			} catch (\PDOException $e) {
				$this->offer->rollBack();
				$error = $e->getMessage();
			}
		}else{
			$error = '此报价已生成订单';
		}

		
		
		return isset($error) ? tool::getSuccInfo(0,$error) : tool::getSuccInfo();

	}

	/**
	 * 买方预付定金(全款或定金)
	 * @param array $info 订单信息数组
	 * @param int $type 0:定金1:全款 默认定金支付
	 * @param int $user_id 当前session用户id
	 */
	public function buyerDeposit($order_id,$type,$user_id){
		$info = $this->orderInfo($order_id);
		$offerInfo = $this->offerInfo($info['offer_id']);
		if(is_array($info) && isset($info['contract_status'])){
			if($info['contract_status'] != self::CONTRACT_NOTFORM)
				return tool::getSuccInfo(0,'合同状态有误');
			if($offerInfo['user_id'] != $user_id)
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
			$upd_res = $this->orderUpdate($orderData);
			if($upd_res['success'] == 1){
				//冻结买方帐户资金  payment=1 余额支付
				$acc_res = $this->account->freeze($offerInfo['user_id'],$orderData['pay_deposit']);
				if($acc_res === true){
					$pro_res = $this->productsFreeze($offerInfo,$info['num']);
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

		}else{
			$res = '无效订单id';
		}

		return $res === true ? array_merge(tool::getSuccInfo(),array('amount'=>$info['amount'],'pay_deposit'=>$orderData['pay_deposit'])) : tool::getSuccInfo(0,$res ? $res : '未知错误');
	}

	
}




