<?php 

/**
 * 保证金提货
 */
use \Library\safe;
use \Library\tool;
use \Library\JSON;
use \Library\url;
use \Library\checkRight;

class DepositDeliveryController extends Yaf\Controller_Abstract{

	public function init(){
        // $right = new checkRight();
        // $right->checkLogin($this);//未登录自动跳到登录页
        // $this->getView()->setLayout('ucenter');
		$this->deposit = new \nainai\delivery\DepositDelivery();
	}

	//生成提货表
	public function geneDeliveryAction(){
		$order_id = 1;
		$num = 1;


		$deliveryData['order_id'] = $order_id;
		$deliveryData['num'] = $num;
		$deliveryData['user_id'] = 49;

		$res = $this->deposit->geneDelivery($deliveryData);

		var_dump($res);exit;
	}

	//卖家发货
	public function sellerConsignmentAction(){
		$delivery_id = 2;
		$user_id = 45;//$this->user_id;
		$res = $this->deposit->sellerConsignment($delivery_id,$user_id);

		var_dump($res);exit;
	}

	//买家确认收货
	public function buyerConfirmAction(){
		$delivery_id = 2;
		$user_id = 49;

		$res = $this->deposit->buyerConfirm($delivery_id,$user_id);
		var_dump($res);exit;

	}
}