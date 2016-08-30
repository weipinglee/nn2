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
	 * 未处理申述列表
	 */
	public function uncomplainListAction(){
		$page = Safe::filterGet('page', 'int', 0);

		$condition = array(
			'where' => 'FIND_IN_SET(a.status, :status)',
			'bind' => array('status' => implode(',', array(
				 \nainai\order\OrderComplain::APPLYCOMPLAIN,
				 \nainai\order\OrderComplain::INTERVENECOMPLAIN,
				))
			)
		);

		if (!empty(Safe::filterPost('order_no'))) {
			$condition['where'] .= ' AND order_no=:order_no';
			$condition['bind']['order_no'] = Safe::filterPost('order_no');
			$this->getView()->assign('order_no', $condition['bind']['order_no']);
		}

		$complainModel = new \nainai\order\OrderComplain();

		$complainList = $complainModel->getComplainList($condition);

		$this->getView()->assign('data', $complainList);
		$this->getView()->assign('status', 0);
	}

	/**
	 * 已处理申述列表
	 */
	public function complainListAction(){
		$page = Safe::filterGet('page', 'int', 0);
		$status = $this->getRequest()->getParam('status');

		$condition = array(
			'where' => 'FIND_IN_SET(a.status, :status)',
			'bind' => array('status' => implode(',', array(
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
		
		$complainList = $complainModel->getComplainList($condition);

		$this->getView()->assign('data', $complainList);
		$this->getView()->assign('status', 1);
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
			
			$complainData = array('id'=>$id,'status'=>Safe::filterPost('status'),'check_time' => \Library\Time::getDateTime(), 'check_msg' => Safe::filterPost('msg'),'check_admin'=>$session['id']);

			$order_id = Safe::filterPost('oid');

			$complainModel = new \nainai\order\OrderComplain();
			$res = $complainModel->firstCheck($complainData, $order_id);
			die(json::encode($res));
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
			
			$complainData = array('id'=>$id,'handle_time' => \Library\Time::getDateTime(), 'handle_msg' => Safe::filterPost('msg'),'handle_admin'=>$session['id']);
			$pass = Safe::filterPost('status','int');
			$order_id = Safe::filterPost('oid');
			switch ($pass) {
				case 1: //介入处理申述协商通过
					$complainData['status'] = \nainai\order\OrderComplain::CONFERCOMPLAIN;
					break;
				case 2: //买方违约

					$complainData['status'] = \nainai\order\OrderComplain::BUYBREAKCOMPLAIN;
					//扣除定金操作
					break;

				case 3: //卖方违约
					$complainData['status'] = \nainai\order\OrderComplain::SELLBREAKCOMPLAIN;
					break;
			}


			$complainModel = new \nainai\order\OrderComplain();
			$res = $complainModel->secondCheck($complainData, $order_id);
			die(json::encode($res));
			
		}

		$this->redirect('complainList');
	}

	
}