<?php

/**
 * 保证金摘牌控制器
 */
use \Library\Safe;
use \Library\tool;
use \Library\JSON;
use \Library\url;

class ComplainController extends InitController{

	/**
	 * 申述列表
	 */
	public function complainListAction(){
		$page = Safe::filterGet('page', 'int', 0);
		$status = $this->getRequest()->getParam('status');

		$condition = array(
			'where' => 'FIND_IN_SET(a.status, :status)',
			'bind' => array('status' => ($status==0) ? implode(',', array(
				 \nainai\order\OrderComplain::APPLYCOMPLAIN,
				 \nainai\order\OrderComplain::INTERVENECOMPLAIN,
				))  : implode(',', array(
				\nainai\order\OrderComplain::DONTCOMPLAIN,
				\nainai\order\OrderComplain::CONFERCOMPLAIN,
				\nainai\order\OrderComplain::BUYBREAKCOMPLAIN,
				\nainai\order\OrderComplain::SELLBREAKCOMPLAIN
				))
			)
		);

		if (!empty(Safe::filterPost('order_no'))) {
			$condition['where'] .= ' AND order_no=:order_no';
			$condition['bind']['order_no'] = Safe::filterPost('order_no');
			$this->getView()->assign('order_no', $condition['bind']['order_no']);
		}

		$complainModel = new \nainai\order\OrderComplain();
		$complainList = $complainModel->getComplainList($page, 10, $condition);

		$this->getView()->assign('complainList', $complainList['list']);
		$this->getView()->assign('pageHtml', $complainList['pageHtml']);
		$this->getView()->assign('status', $status);
	}

	/**
	 * 申述详情
	 */
	public function detailAction(){
		$id = $this->getRequest()->getParam('id');
		$id = Safe::filter($id, 'int', 0);

		if (intval($id) > 0) {
			$checkAdminData = $handlerAdminData = array();
			$complainModel = new \nainai\order\OrderComplain();
			$complainDetail = $complainModel->getComplainDetail($id);

			//获取审核人信息
			if (intval($complainDetail['check_admin']) > 0) {
				$checkAdminModel = new AdminModel();
				$checkAdminData = $checkAdminModel->getAdminInfo($complainDetail['check_admin']);
			}
			//如果审核人和处理人是同一个
			if ($complainDetail['check_admin'] == $complainDetail['handle_admin']) {
				$handlerAdminData = $checkAdminData;
			}elseif (intval($complainDetail['handle_admin']) > 0) {
				$checkAdminModel = new AdminModel();
				$handlerAdminData = $checkAdminModel->getAdminInfo($complainDetail['handle_admin']);
			}

			switch ($complainDetail['status'] ) {
				case \nainai\order\OrderComplain::APPLYCOMPLAIN:
					$handler = 1; //菜单控制,申请审核，显示介入处理，不通过
					break;
				case \nainai\order\OrderComplain::INTERVENECOMPLAIN:
					$handler = 2; //菜单控制，介入处理，显示通过，和违约
					break;
				default:
					$handler = 0;
					break;
			}

			$this->getView()->assign('handler', $handler);
			$this->getView()->assign('checkAdminData', $checkAdminData);
			$this->getView()->assign('handlerAdminData', $handlerAdminData);
			$this->getView()->assign('detail', $complainDetail);
		}else{
			$this->redirect('complainList');
		}
	}

	/**
	 * 审核申述
	 */
	public function docheckAction(){
		$id = Safe::filterPost('id', 'int', 0);

		if (IS_POST && intval($id) > 0) {
			$session = \Library\session::get('admin');
			
			$complainData = array('check_time' => \Library\Time::getDateTime(), 'check_msg' => Safe::filterPost('msg'),'check_admin'=>$session['id']);
			$pass = Safe::filterPost('pass');

			switch (mb_strlen($pass)) {
				case 4: //介入处理
					$order_id = Safe::filterPost('oid');

					$complainData['status'] = \nainai\order\OrderComplain::INTERVENECOMPLAIN;
					$orderModel = new \nainai\order\Order('product_order');
					$res = $orderModel->orderUpdate(array('id'=>$order_id, 'is_lock' => 1));
	
					break;

				case 3: //不通过
					$complainData['status'] = \nainai\order\OrderComplain::DONTCOMPLAIN;
					$res = array('success' => 1);
					break;
			}

			if ($res['success'] == 1) {
				$complainModel = new \nainai\order\OrderComplain();
				$complainModel->updateOrderComplain($complainData, $id);
			}
		}

		$this->redirect('complainList');
	}

	/**
	 * 处理申述
	 */
	public function dohandlerAction(){
		$id = Safe::filterPost('id', 'int', 0);

		if (IS_POST && intval($id) > 0) {
			$session = \Library\session::get('admin');
			
			$complainData = array('handle_time' => \Library\Time::getDateTime(), 'handle_msg' => Safe::filterPost('msg'),'handle_admin'=>$session['id']);
			$pass = Safe::filterPost('pass');

			switch (mb_strlen($pass)) {
				case 7: //介入处理申述协商通过
					$order_no = Safe::filterPost('oid');

					$complainData['status'] = \nainai\order\OrderComplain::CONFERCOMPLAIN;
					$orderModel = new \nainai\order\Order('product_order');
					$res = $orderModel->orderUpdate(array('id'=>$order_no, 'is_lock' => 0));
					break;

				case 4: //买方违约
					$complainData['status'] = \nainai\order\OrderComplain::BUYBREAKCOMPLAIN;
					//扣除定金操作
					break;

				case 5: //卖方违约
					$complainData['status'] = \nainai\order\OrderComplain::SELLBREAKCOMPLAIN;
					break;
			}

			if ($res['success'] == 1) {
				$complainModel = new \nainai\order\OrderComplain();
				$complainModel->updateOrderComplain($complainData, $id);
			}
			
		}

		$this->redirect('complainList');
	}

	
}