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
class StoreOrder extends Order{
	
	/**
	 * 买方预付定金(全款或定金)
	 * @param array $info 订单信息数组
	 * @param int $type 0:定金1:全款 默认定金支付
	 * @param int $user_id 当前session用户id
	 */
	public function buyerDeposit($order_id,$type,$user_id){
		$info = $this->orderInfo($order_id);
		if(is_array($info) && isset($info['contract_status'])){
			if($info['contract_status'] != self::CONTRACT_NOTFORM)
				return tool::getSuccInfo(0,'合同状态有误');
			if($info['user_id'] != $user_id)
				return tool::getSuccInfo(0,'订单买家信息有误');
			$orderData['id'] = $order_id;
			if($type == 0){
				//定金支付
				$orderData['contract_status'] = self::CONTRACT_BUYER_RETAINAGE;//合同状态置为等待买方支付尾款
				$pay_deposit = $this->payDeposit($info);
				if(is_float($pay_deposit)){
					$orderData['pay_deposit'] = $pay_deposit;
				}else{
					return tool::getSuccInfo(0,$pay_deposit);
				}
			}else{
				//全款
				$orderData['contract_status'] = self::CONTRACT_EFFECT;//合同状态置为已生效
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
			} catch (\PDOException $e) {
				$this->order->rollBack();
				$res = $e->getMessage();
			}
		}else{
			$res = '无效订单id';
		}
		return $res === true ? tool::getSuccInfo() : tool::getSuccInfo(0,$res ? $res : '未知错误');
	}

	/**
	 * 获取用户所有合同信息(含商品信息与买家信息)
	 * @param  int $user_id 卖家id
	 */
	public function storeContractList($user_id,$page,$where = array()){
		$query = new Query('store_order as do');
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
						$href  = url::createUrl('/storeOrder/confirmProof?order_id='.$value['id']);
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




