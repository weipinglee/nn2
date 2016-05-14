<?php 

/**
 * 仓单提货
 */
use \Library\safe;
use \Library\tool;
use \Library\JSON;
use \Library\url;
use \Library\checkRight;

class StoreDeliveryController extends Yaf\Controller_Abstract{

	public function init(){
        // $right = new checkRight();
        // $right->checkLogin($this);//未登录自动跳到登录页
        // $this->getView()->setLayout('ucenter');
		$this->store = new \nainai\delivery\StoreDelivery();
	}

	//生成提货表
	public function geneDeliveryAction(){
		$order_id = 2;
		$num = 1;

		$deliveryData['order_id'] = $order_id;
		$deliveryData['num'] = $num;
		$deliveryData['user_id'] = 49;

		$res = $this->store->geneDelivery($deliveryData);

		var_dump($res);exit;
	}

	//卖家支付仓库管理费用
	public function storeFeesAction(){
		$delivery_id = 5;
		$user_id = 44;//$this->user_id;
		$res = $this->store->storeFees($delivery_id,$user_id);

		var_dump($res);exit;
	}

	//模拟仓库管理员确认出货
	public function managerCheckoutAction(){
		$delivery_id = 5;

		$res = $this->store->managerCheckout($delivery_id);
		var_dump($res);exit;

	}

	//模拟后台管理员进行审核
	public function adminCheckAction(){
		$delivery_id = 5;
		$res = $this->store->adminCheck($delivery_id);

		var_dump($res);exit;
	}
}