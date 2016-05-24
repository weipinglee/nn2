<?php 

/**
 * 仓单摘牌控制器
 */
use \Library\safe;
use \Library\tool;
use \Library\JSON;
use \Library\url;
use \Library\checkRight;

class StoreOrderController extends OrderController{

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