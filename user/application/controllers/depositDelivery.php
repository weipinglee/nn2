<?php 

/**
 * 保证金提货
 */
use \Library\safe;
use \Library\tool;
use \Library\JSON;
use \Library\url;
use \Library\checkRight;

class DepositDeliveryController extends DeliveryController{

	//卖家发货
	public function sellerConsignmentAction(){
		$delivery_id = safe::filter($this->_request->getParam('id'),'int');
		$user_id = 45;//$this->user_id;
		$deposit = new \nainai\delivery\DepositDelivery();
		$res = $deposit->sellerConsignment($delivery_id,$user_id);

		var_dump($res);exit;
	}

	//买家确认收货
	public function buyerConfirmAction(){
		$delivery_id = filter($this->_request->getParam('id'),'int');
		$user_id = 49;

		$deposit = new \nainai\delivery\DepositDelivery();
		$res = $deposit->buyerConfirm($delivery_id,$user_id);
		
		if($res['success'] == 1){
			$this->redirect(url::createUrl('/Delivery/deliveryList'));
		}else{
			die($res['info']);
		}

	}
}