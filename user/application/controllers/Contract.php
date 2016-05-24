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
		// $list = $deposit->depositContractList($user_id,$page,$where);
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

	/**
	 * 申述合同
	 */
	public function complainContractAction(){
		if (IS_POST) {
			$complainData = array(
				'order_id' => Safe::filterPost('orderId', 'int'),
				'user_id' => $this->user_id,
				'title' => Safe::filterPost('title'),
				'detail' => Safe::filterPost('content'),
				'proof' => serialize(Safe::filterPost('imgData')),
				'apply_time' => \Library\Time::getDateTime(),
				'type' => ($this->user_id == Safe::filterPost('userId', 'int')) ? \nainai\order\OrderComplain::BUYCOMPLAIN : \nainai\order\OrderComplain::SELLCOMPLAIN, //判断合同userid和申请人是否为同一人，来选择是买方申述，还是卖方申述
				'status' => \nainai\order\OrderComplain::APPLYCOMPLAIN
			);

			$complainModel = new \nainai\order\OrderComplain();
			$returnData = $complainModel->addOrderComplain($complainData);
			$this->HandlerHtml($returnData);
		}
		
		$ContractData = array();
		$ContractData['id'] = 1;
		$ContractData['user_id'] = 21;
		//上传图片插件
	        $plupload = new PlUpload(url::createUrl('/ManagerDeal/swfupload'));

	        //注意，js要放到html的最后面，否则会无效
	        $this->getView()->assign('plupload',$plupload->show());
	        $this->getView()->assign('ContractData', $ContractData);
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

	public function addsuccessAction(){
	}

}