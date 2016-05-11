<?php 

/**
 * 保证金摘牌控制器
 */
use \Library\safe;
use \Library\tool;
use \Library\JSON;
use \Library\url;
use \Library\checkRight;

class DepositController extends UcenterBaseController{

	public function init(){
        $right = new checkRight();
        $right->checkLogin($this);//未登录自动跳到登录页
        $this->getView()->setLayout('ucenter');
		$this->deposit = new \nainai\order\DepositOrder(2);
	}

	/**
	 * 生成订单
	 */
	public function geneOrderAction(){
		$orderData['offer_id'] = safe::filterPost('offer_id','int');
		$orderData['num'] = safe::filterPost('num');

		$orderData['offer_id'] = 1;
		$orderData['num'] = 100;
		$orderData['order_no'] = tool::create_uuid();
		$orderData['user_id'] = $this->user_id;//session
		$orderData['create_time'] = date('Y-m-d H:i:s',time());
		$res = $this->deposit->geneOrder($orderData);
		die(JSON::encode($res));
	}

	//买家支付定金
	public function buyerDepositAction(){
		$orderData['id'] = safe::filter('id','int');
		$orderData['type'] = safe::filter('type');//1:全款 0:定金


		$order_id = 22;
		$type = 0;//1:全款 0:定金		
		$user_id = $this->user_id;
		$res = $this->deposit->buyerDeposit($order_id,$type,$user_id);
		var_dump($res);
		return false;
	}

	//卖家支付保证金
	public function sellerDepositAction(){
		$order_id = intval($this->_request->getParam('order_id'));
		// $pay = safe::filter('pay');
		$pay = true;
		$order_id = 22;
		$user_id = 42;//$this->user_id;
		$res = $this->deposit->sellerDeposit($order_id,$pay,$user_id);
		if($res['success'] == 1)
			$this->redirect($_SERVER['HTTP_REFERER']);
		else
			echo $res['info'];
		return false;
	}

	//买家支付尾款
	public function buyerRetainageAction(){
		$order_id = safe::filter('id','int');
		$type = safe::filter('type');//online:线上 offline:线下


		$order_id = 22;
		$type = 'offline';
		$user_id = $this->user_id;
		$proof = 'xianxia.jpg';
		$res = $this->deposit->buyerRetainage($order_id,$user_id,$type,$proof);
		var_dump($res);
		return false;
	}

	//卖家确认买方线下支付凭证
	public function confirmProofAction(){
		$order_id = intval($this->_request->getParam('order_id'));
		$type = safe::filter('type');//0:未确认 1：确认
		$type = true;
		$user_id = 42;//$this->user_id;
		$res = $this->deposit->confirmProof($order_id,$user_id,$type);
		if($res['success'] == 1)
			$this->redirect($_SERVER['HTTP_REFERER']);
		else
			echo $res['info'];
		return false;
	}
}