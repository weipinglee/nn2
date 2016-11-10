<?php 

/**
 * 委托报盘摘牌控制器
 */
use \Library\safe;
use \Library\tool;
use \Library\JSON;
use \Library\url;
use \Library\checkRight;

class EntrustOrderController extends OrderController{
	//支付宝支付委托费用回调函数
	public function alipayEntrustAction(){
		//TODO  支付宝回调验证
		$order_id = safe::filter($this->_request->getParam('order_id'));
		$user_id = safe::filter($this->_request->getParam('user_id'));
		$entrust = new \nainai\order\EntrustOrder();
		$res = $entrust->sellerDeposit($order_id,true,$user_id,\nainai\order\Order::PAYMENT_ALIPAY);
		$this->success('委托费用支付成功！',url::createUrl('/Contract/sellerList@user'));
	}
}