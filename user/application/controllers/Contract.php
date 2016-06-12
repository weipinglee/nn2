<?php
/**
 * 卖方合同管理
 * @author: panduo 
 * @Date: 2016-04-28 10:20:57
 */
use \Library\json;
use \Library\url;
use \Library\Safe;
use \Library\Thumb;
use \Library\tool;
use \Library\PlUpload;

class ContractController extends UcenterBaseController{



	public function sellerListAction(){
		$user_id = $this->user_id;
		$order = new \nainai\order\Order();
		// $page = $this->_request->getParam('page');
		$page = safe::filterGet('page','int',1);
		$name = safe::filterPost('name');
		$where = array();
		if(!empty($name)){
			$where []= array(" and p.name = :name ",array('name'=>$name)); 
		}
		$list = $order->sellerContractList($user_id,$page,$where);
		$this->getView()->assign('data',$list['data']);
		$this->getView()->assign('page',$list['bar']);
	}

	public function depositListAction(){
		$user_id = $this->user_id;
		$deposit = new \nainai\order\DepositOrder();

		// $page = $this->_request->getParam('page');
		$page = safe::filterGet('page','int',1);
		$name = safe::filterPost('name');
		$where = array();
		if(!empty($name)){
			$where []= array(" and p.name = :name ",array('name'=>$name));
		}

		$list = $deposit->depositContractList($user_id,$page,$where);

		$this->getView()->assign('data',$list['data']);
		$this->getView()->assign('page',$list['bar']);
	}

	public function storeListAction(){
		$user_id = $this->user_id;
		$store = new \nainai\order\StoreOrder();
		// $page = $this->_request->getParam('page');
		$page = safe::filterGet('page','int',1);
		$name = safe::filterPost('name');
		$where = array();
		if(!empty($name)){
			$where []= array(" and p.name = :name ",array('name'=>$name));
		}
		$list = $store->storeContractList($user_id,$page,$where);
		$this->getView()->assign('data',$list['data']);
		$this->getView()->assign('page',$list['bar']);
	}


	public function sellerDetailAction(){
		$id = safe::filter($this->_request->getParam('id'),'int');
		$order = new \nainai\order\Order();
		$info = $order->contractDetail($id,'seller');
		$this->getView()->assign('info',$info);
	}

	//购买合同列表
	public function buyerListAction(){
		$user_id = $this->user_id;
		$order = new \nainai\order\Order();
		// $page = $this->_request->getParam('page');
		$page = safe::filterGet('page','int',1);
		$name = safe::filterPost('name');
		$where = array();
		if(!empty($name)){
			$where []= array(" and p.name = :name ",array('name'=>$name));
		}
		$list = $order->buyerContractList($user_id,$page,$where);
		$this->getView()->assign('data',$list['data']);
		$this->getView()->assign('page',$list['bar']);
	}

	//购买合同详情
	public function buyerDetailAction(){
		$id = safe::filter($this->_request->getParam('id'),'int');
		$order = new \nainai\order\Order();
		$info = $order->contractDetail($id);
		$this->getView()->assign('info',$info);
	}


	/**
	 * 申述合同
	 */
	public function complainContractAction(){
		$complainModel = new \nainai\order\OrderComplain();

		$this->backUrl = url::createUrl('/Contract/complainList');
		$this->goUrl = url::createUrl('/Contract/complainContract');

		if (IS_POST) {
			$order_id = Safe::filterPost('orderId', 'int');

			$ContractData = $complainModel->getContract($order_id, 2);
			if (empty($ContractData)) {//没有这合同直接跳转
				$this->HandlerHtml(tool::getSuccInfo(0, '无效的合同！'));
			}

			$complainData = array(
				'order_id' => $order_id ,
				'user_id' => $this->user_id,
				'title' => Safe::filterPost('title'),
				'detail' => Safe::filterPost('content'),
				'proof' => serialize(Safe::filterPost('imgData')),
				'apply_time' => \Library\Time::getDateTime(),
				'type' => ($this->user_id == Safe::filterPost('userId', 'int')) ? \nainai\order\OrderComplain::BUYCOMPLAIN : \nainai\order\OrderComplain::SELLCOMPLAIN, //判断合同userid和申请人是否为同一人，来选择是买方申述，还是卖方申述
				'status' => \nainai\order\OrderComplain::APPLYCOMPLAIN
			);

			//判断是否是当前买方或者卖方申请的
			switch ($complainData['type']) {
				case \nainai\order\OrderComplain::BUYCOMPLAIN:
					if ($this->user_id != $ContractData['user_id']) {
						$this->HandlerHtml(tool::getSuccInfo(0, '请不要申请不是你购买的合同！'));
					}
					break;
				case \nainai\order\OrderComplain::SELLCOMPLAIN:
					if ($this->user_id != $ContractData['sell_user']) {
						$this->HandlerHtml(tool::getSuccInfo(0, '请不要申请不是你销售的合同'));
					}
					break;
			}

			$returnData = $complainModel->addOrderComplain($complainData);

			$this->HandlerHtml($returnData);
		}

		$id = Safe::filterGet('id', 'int');

		if (intval($id) > 0) {
			$ContractData = array();
			$ContractData = $complainModel->getContract($id);

			if (empty($ContractData)) {//没有这合同直接跳转
				$this->HandlerHtml(tool::getSuccInfo(0, '无效的合同！'));
			}

			//获取卖方和卖方的中文名
			$userModel = new \nainai\user\User();
			$ContractData['usercn']  = $userModel->getUser($ContractData['user_id'], 'username');
			if ($ContractData['user_id'] == $ContractData['sell_user']) {
				$ContractData['sellcn'] = $ContractData['usercn'];
			}else{
				$ContractData['sellcn'] = $userModel->getUser($ContractData['sell_user'], 'username');
			}

			//上传图片插件
			$plupload = new PlUpload(url::createUrl('/ManagerDeal/swfupload'));

			//注意，js要放到html的最后面，否则会无效
			$this->getView()->assign('plupload',$plupload->show());
			$this->getView()->assign('ContractData', $ContractData);
		}else{
			$this->HandlerHtml(tool::getSuccInfo(0, '无效的合同！'));
		}
	}

	/**
	 * 申述列表
	 */
	public function complainListAction(){
		$page = Safe::filterGet('page', 'int', 0);

		$condition = array(
			'where' => 'a.user_id =:user_id',
			'bind' => array('user_id' => $this->user_id)
		);

		$complainModel = new \nainai\order\OrderComplain();
		$complainList = $complainModel->getComplainList($page, $this->pagesize, $condition);

		$this->getView()->assign('complainList', $complainList['list']);
		$this->getView()->assign('pageHtml', $complainList['pageHtml']);
	}

	/**
	 * 申述详情
	 */
	public function ComplainDetailAction(){
		$id = $this->getRequest()->getParam('id');
		$id = Safe::filter($id, 'int', 0);

		if (intval($id) > 0) {
			$complainModel = new \nainai\order\OrderComplain();
			$complainDetail = $complainModel->getComplainDetail($id);

			$this->getView()->assign('complainDetail', $complainDetail);
		}else{
			$this->redirect('complainList');
		}
	}




}