<?php

use \Library\safe;
use \Library\Thumb;
use \nainai\subRight;
use \Library\tool;
use \Library\JSON;
class StoreorderController extends Yaf\Controller_Abstract{

    public function init(){
        $this->getView()->setLayout('admin');
        //echo $this->getViewPath();
    }

    //待审核出库订单列表
    public function checkorderListAction(){
		$delivery = new \nainai\delivery\StoreDelivery();
		
		$page = safe::filterGet('page','int',1);
		$name = safe::filter($this->_request->getParam('name'));
		$data = $delivery->storeOrderList($page,$name ? 'o.order_no like "%'.$name.'%"' : '');

		$this->getView()->assign('data',$data);
	}

	//待审核详情
	public function storeOrderDetailAction(){
		$id = safe::filter($this->_request->getParam('id'));
		$delivery = new \nainai\delivery\StoreDelivery();
		$info = $delivery->storeOrderDetail($id);

		$this->getView()->assign('info',$info);
	}

	//通过仓单出库审核
	public function storeOrderPassAction(){
		$delivery_id = safe::filterPost('id');
		$status = safe::filterPost('status');
		$msg = safe::filterPost('msg');

		$store = new \nainai\delivery\StoreDelivery();
		$res = $store->adminCheck($delivery_id, $status, $msg);
		
		if($res['success']==1){
			$log = new \Library\log();
			if ($status == 1) {
				$content = '提货单'.$delivery_id.'出库审核通过';
			}else{
				$content = '提货单'.$delivery_id.'出库审核驳回';
			}
			$log->addLog(array('content'=>$content));
		}
		die(JSON::encode($res));
	}



	//已审核列表
	public function checkedorderListAction(){
		$delivery = new \nainai\delivery\StoreDelivery();
		
		$page = safe::filterGet('page','int',1);
		$name = safe::filter($this->_request->getParam('name'));
		$data = $delivery->storeOrderList($page,$name ? 'o.order_no like "%'.$name.'%"' : '',1);
		$this->getView()->assign('data',$data);
	}

	//已审核详情
	public function checkedOrderDetailAction(){
		$id = safe::filter($this->_request->getParam('id'));
		$delivery = new \nainai\delivery\StoreDelivery();

		$info = $delivery->storeOrderDetail($id,1);
		$this->getView()->assign('info',$info);
	}
}