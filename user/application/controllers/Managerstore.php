<?php

use \Library\url;
use \nainai\store;
use \Library\Safe;
use \Library\Thumb;

class ManagerStoreController extends \nainai\Abstruct\UcenterControllerAbstract{

	protected function  getLeftArray(){
	        return array(
	            array('name' => '仓单管理', 'list' => array()),
	            array('name' => '仓单管理', 'url' => '',  'list' => array()),
	            array('name' => '仓单审核', 'url' => url::createUrl('/ManagerStore/ApplyStoreList'),  'list' => array())
	        );
	    }

	public function indexAction(){}


	/**
	 * 审核仓单列表
	 */
	public function ApplyStoreListAction(){
		$page = intval(Safe::filterGet('page', 'int')) >= 0 ? Safe::filterGet('page', 'int') : 0;
		$store = new store();
		$data = $store->getApplyStoreList($page, $this->pagesize);

		$this->getView()->assign('statuList', $store->getStatus());
		$this->getView()->assign('storeList', $data['list']);
		$this->getView()->assign('attrs', $data['attrs']);
		$this->getView()->assign('pageHtml', $data['pageHtml']);
	}	

	/**
	 * 审核仓单，仓单的详情页面
	 */
	public function ApplyStoreDetailsAction(){
		$id = $this->getRequest()->getParam('id');
		if (intval($id) > 0) {
			$store = new store();
			$data = $store->getApplyStoreDetails($id);

			foreach ($data['imgData'] as $key => $value) {
				$data['imgData'][$key] = Thumb::get($value['img'],180,180);
			}

			$this->getView()->assign('storeDetail', $data);
		}else{
			$this->redirect('ApplyStoreList');
		}
	}

	/**
	 * 处理审核
	 * @return 
	 */
	public function doApplyStoreAction(){
		$id = Safe::filterPost('id', 'int');
		if (IS_POST && intval($id) > 0) {
			$apply = array(
				'store_pos' => Safe::filterPost('pos'),
				'status' =>1
			);

			$store = new store();
			$store->UpdateApplyStore($apply, $id);
			echo 'ok';exit();
		}
		$this->redirect('ApplyStoreDetails');
	}
}