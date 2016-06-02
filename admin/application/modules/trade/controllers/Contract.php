<?php
/**
 * @author panduo
 */
use \Library\safe;
use \nainai\certificate;
use \Library\Thumb;
use \nainai\subRight;
use \Library\json;
class ContractController extends InitController{

	/**
	 * 获取所有待审核的仓单摘牌订单
	 * @return [type] [description]
	 */
	public function storeOrderListAction(){
		$order = new ContractModel();
		
		$page = safe::filterGet('page','int',1);
		$name = safe::filterPost('name');

		$list = $order->storeOrderList($page);
		$this->getView()->assign('data',$list['data']);
		$this->getView()->assign('page',$list['bar']);
	}

	//通过仓单出库审核
	public function storeOrderPassAction(){
		$delivery_id = safe::filter($this->_request->getParam('id'));
		$store = new \nainai\delivery\StoreDelivery();
		$res = $store->adminCheck($delivery_id);
		die(JSON::encode($res));
	}
}