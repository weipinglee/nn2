<?php 

/**
 * 委托报盘摘牌控制器
 */
use \Library\safe;
use \Library\tool;
use \Library\JSON;
use \Library\url;
use \Library\checkRight;

class EntrustOrderController extends Yaf\Controller_Abstract{

	public function init(){
        // $right = new checkRight();
        // $right->checkLogin($this);//未登录自动跳到登录页
        // $this->getView()->setLayout('ucenter');
		$this->entrust = new \nainai\order\EntrustOrder(4);
	}

	/**
	 * 生成订单
	 */
	public function geneOrderAction(){
		$orderData['offer_id'] = safe::filterPost('offer_id','int');
		$orderData['num'] = safe::filterPost('num');

		$orderData['offer_id'] = 1;
		$orderData['num'] = 20;
		$orderData['order_no'] = tool::create_uuid();
		$orderData['user_id'] = $this->user_id;//session
		$orderData['create_time'] = date('Y-m-d H:i:s',time());
		$res = $this->entrust->geneOrder($orderData);
		die(JSON::encode($res));
	}

	//买家支付定金
	public function buyerDepositAction(){
		die(JSON::encode(tool::getSuccInfo()));
	}

	//买家上传线下支付凭证
	public function buyerRetainageAction(){
		$order_id = safe::filter('id','int');
		$order_id = 1;
		$type = 'offline';
		$user_id = 49;//$this->user_id;
		$proof = 'xianxia.jpg';
		$res = $this->entrust->buyerRetainage($order_id,$user_id,$type,$proof);
		var_dump($res);
		return false;
	}

	//卖家确认买方线下支付凭证
	public function confirmProofAction(){
		$order_id = intval($this->_request->getParam('order_id'));
		$type = safe::filter('type');//0:未确认 1：确认
		$type = true;
		$user_id = 42;//$this->user_id;
		$res = $this->entrust->confirmProof($order_id,$user_id,$type);
		if($res['success'] == 1)
			$this->redirect($_SERVER['HTTP_REFERER']);
		else
			echo $res['info'];
		return false;
	}
}