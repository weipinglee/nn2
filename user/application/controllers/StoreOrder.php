<?php 

/**
 * 仓单摘牌控制器
 */
use \Library\safe;
use \Library\tool;
use \Library\JSON;
use \Library\url;
use \Library\checkRight;

class StoreOrderController extends UcenterBaseController{

	public function init(){
        // $right = new checkRight();
        // $right->checkLogin($this);//未登录自动跳到登录页
        // $this->getView()->setLayout('ucenter');
		$this->store = new \nainai\order\StoreOrder();
	}

	// /**
	//  * 生成订单
	//  */
	// public function geneOrderAction(){
	// 	$orderData['offer_id'] = safe::filterPost('offer_id','int');
	// 	$orderData['num'] = safe::filterPost('num');

	// 	$orderData['offer_id'] = 1;
	// 	$orderData['num'] = 20;
	// 	$orderData['order_no'] = tool::create_uuid();
	// 	$orderData['user_id'] = $this->user_id;//session
	// 	$orderData['create_time'] = date('Y-m-d H:i:s',time());
	// 	$res = $this->store->geneOrder($orderData);
	// 	die(JSON::encode($res));
	// }

	// //买家支付定金
	// public function buyerDepositAction(){
	// 	$orderData['id'] = safe::filter('id','int');
	// 	$orderData['type'] = safe::filter('type');//1:全款 0:定金

	// 	$order_id = 1;
	// 	$type = 0;//1:全款 0:定金		
	// 	$user_id = $this->user_id;
	// 	$res = $this->store->buyerDeposit($order_id,$type,$user_id);
	// 	var_dump($res);
	// 	return false;
	// }

	//买家支付尾款 
	public function buyerRetainageAction(){
		$order_id = safe::filter('id','int');
		$type = safe::filter('type');//online:线上 offline:线下

		$order_id = 2;
		$type = 'online';
		$user_id = 49;//$this->user_id;
		$proof = 'xianxia.jpg';
		$res = $this->store->buyerRetainage($order_id,$user_id,$type,$proof);
		var_dump($res);
		return false;
	}

	//卖家确认买方线下支付凭证
	public function confirmProofAction(){
		$order_id = intval($this->_request->getParam('order_id'));
		$type = safe::filter('type');//0:未确认 1：确认
		$type = true;
		$user_id = 42;//$this->user_id;
		$res = $this->store->confirmProof($order_id,$user_id,$type);
		if($res['success'] == 1)
			$this->redirect($_SERVER['HTTP_REFERER']);
		else
			echo $res['info'];
		return false;
	}

	//提货完成后买家确认订单货物质量
	public function verifyQaulityAction(){
		$order_id = 2;
		$res = $this->store->verifyQaulity($order_id);
		var_dump($res);exit;
	}

	//买家确认合同结束
	public function contractCompleteAction(){
		$order_id = 2;
		$res = $this->store->contractComplete($order_id);
		var_dump($res);exit;
	}
}