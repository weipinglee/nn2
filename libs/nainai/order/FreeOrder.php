<?php
/**
 * @author panduo
 * @date 2016-4-25
 * @brief 自由摘牌订单表 暂只支持余额支付
 *
 */
namespace nainai\order;
use \Library\M;
use \Library\Query;
use \Library\tool;
use \Library\url;
class FreeOrder extends Order{
	
	public function __construct(){
		parent::__construct(parent::ORDER_FREE);
	}

	//生成摘牌订单
	public function geneOrder($orderData){
		if($orderData['mode'] == self::ORDER_FREE){
			$orderData['contract_status'] = self::CONTRACT_BUYER_RETAINAGE;
		}else{
			return tool::getSuccInfo(0,'生成订单错误');
		}
		
		$offer_exist = $this->offerExist($orderData['offer_id']);
		if($offer_exist === false) return tool::getSuccInfo(0,'报盘不存在或未通过审核');

		$offer_info = $this->offerInfo($orderData['offer_id']);
		if($offer_info['user_id'] == $orderData['user_id']){
			return tool::getSuccInfo(0,'不能购买自己的商品');
		}
		if(isset($offer_info['price']) && $offer_info['price']>0){
			$product_valid = $this->productNumValid($orderData['num'],$offer_info);
			if($product_valid !== true)
				return tool::getSuccInfo(0,$product_valid);
			$orderData['amount'] = $offer_info['price'] * $orderData['num'];

			$upd_res = $this->orderUpdate($orderData);
			$pro_res = $this->productsFreeze($offer_info,$orderData['num']);
			if($pro_res != true) return tool::getSuccInfo(0,$pro_res);
			$res = isset($res) ? tool::getSuccInfo(0,$res) : $upd_res;
		}else{
			$res = tool::getSuccInfo(0,'无效报盘');
		}
		return $res;
	}
}




