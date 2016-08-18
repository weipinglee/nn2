<?php
/**
 * 合同列表
 */
use \Library\safe;
use \Library\tool;
use \Library\JSON;
use \Library\url;
use \Library\session;
class ContractController extends Yaf\Controller_Abstract{

	private $order;
	public function init(){
		$this->order = new \nainai\order\Order();
		$this->getView()->setLayout('admin');
		//echo $this->getViewPath();
	}

	//获取所有状态为已生效及之后（不为已完成）状态的合同
	public function contractListAction(){
		$page = safe::filterGet('page','int',1);
		$name = safe::filter($this->_request->getParam('name'));

		$list = $this->order->memberContractList($page,$name ? 'do.order_no like "%'.$name.'%"' : '');
		// var_dump($list);
		$this->getView()->assign('data',$list);
	}
}