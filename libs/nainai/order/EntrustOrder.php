<?php
/**
 * @author panduo
 * @date 2016-5-9
 * @brief 委托订单表 暂只支持余额支付
 *
 */
namespace nainai\order;
use \Library\M;
use \Library\Query;
use \Library\tool;
use \Library\url;
class entrustOrder extends Order{
	
	/**
	 * 获取用户所有合同信息(含商品信息与买家信息)
	 * @param  int $user_id 卖家id
	 */
	public function entrustContractList($user_id,$page,$where = array()){
		$query = new Query('entrust_order as do');
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
						$href  = url::createUrl('/entrustOrder/confirmProof?order_id='.$value['id']);
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




