<?php

use \Library\url;
use \nainai\store;
use \Library\Safe;
use \Library\Thumb;

/**
 * 仓单管理的的控制器类
 */
class ManagerStoreController extends \nainai\Abstruct\UcenterControllerAbstract{

	/**
	 * 获取左侧菜单数据
	 * @var name [<菜单名称>]
	 * @var url   [<菜单url>]
	 * @var list [<子菜单的数据，key和父级菜单一致>]
	 * @return [Array]
	 */
	protected function  getLeftArray(){
	        return array(
	            array('name' => '仓单管理', 'list' => array()),
	            array('name' => '仓单管理', 'url' => url::createUrl('/ManagerStore/ManagerStoreList'),  'list' => array()),
	            array('name' => '仓单审核', 'url' => url::createUrl('/ManagerStore/ApplyStoreList'),  'list' => array())
	        );
	    }

	public function indexAction(){}

	public function addSuccessAction(){}

	/**
	 * 审核仓单列表
	 */
	public function ApplyStoreListAction(){
		$page = Safe::filterGet('page', 'int', 0);
		$store = new store();
		$data = $store->getApplyStoreList($page, $this->pagesize);

		$this->getView()->assign('statuList', $store->getStatus());
		$this->getView()->assign('storeList', $data['list']);
		$this->getView()->assign('attrs', $data['attrs']);
		$this->getView()->assign('pageHtml', $data['pageHtml']);
	}	

	/**
	 * 审核仓单后，仓单签发的详情页面
	 */
	public function ApplyStoreDetailsAction(){
		$id = $this->getRequest()->getParam('id');
		$id = Safe::filter($id, 'int', 0);
		if (intval($id) > 0) {
			$store = new store();
			$data = $store->getUserStoreDetail($id);

			$productModel = new \nainai\product();

			$this->getView()->assign('storeDetail', $data);
			$this->getView()->assign('photos', $productModel->getProductPhoto($data['pid']));
		}else{
			$this->redirect('/ManagerStore/ApplyStoreList');
		}
	}


	/**
	 * 仓单审核页面
	 */
	public function ApplyStoreAction(){
		$category = array();
		$id = $this->getRequest()->getParam('id');
		$id = Safe::filter($id, 'int', 0);
		if (intval($id) > 0) {
			$store = new store();
			$data = $store->getUserStoreDetail($id);
			//获取商品分类信息，默认取第一个分类信息
		        $productModel = new \nainai\product();
		        $attr_ids = array();
		        $data['attribute'] = unserialize($data['attribute']);
		        foreach ($data['attribute'] as $key => $value) {
		        		$attr_ids[] = $key;
		        }

		       $this->getView()->assign('detail', $data);
	                $this->getView()->assign('attrs', $productModel->getHTMLProductAttr($attr_ids));
	               $this->getView()->assign('photos', $productModel->getProductPhoto($data['pid']));
		}
	        
	}

	/**
	 * 处理审核
	 * @return 
	 */
	public function doApplyStoreAction(){
		$id = Safe::filterPost('id', 'int', 0);
		if (IS_POST && intval($id) > 0) {
			$apply = array();
			$apply['status'] = (Safe::filterPost('apply', 'int', 0) == 1) ? 1 : 2;

			$store = new store();
			$store->UpdateApplyStore($apply, $id);
			$this->redirect('addSuccess');exit();
		}
		$this->redirect('ApplyStore');
	}

	/**
	 * 处理仓单签发
	 */
	public function doStoreSignAction(){
		$id = Safe::filterPost('id', 'int', 0);
		if (IS_POST && intval($id) > 0) {
			$apply = array(
				'store_pos' => Safe::filterPost('pos'),
				'in_time' => Safe::filterPost('inTime'),
				'rent_time' => Safe::filterPost('rentTime')
			);

			if (!empty(Safe::filterPost('packNumber'))) {
				$apply['package_num'] = Safe::filterPost('packNumber', 'float');
				$apply['package_weight'] = Safe::filterPost('packWeight', 'float');
			}

			$store = new store();
			$store->UpdateApplyStore($apply, $id);
			$this->redirect('addSuccess');exit();
		}
		$this->redirect('ApplyStoreDetails');
	}

	/**
	 * 仓单管理页面
	 */
	public function ManagerStoreListAction(){
		$page = Safe::filterGet('page', 'int', 0);
		$store = new store();
		$data = $store->getApplyStoreList($page, $this->pagesize, $this->user_id);

		$this->getView()->assign('statuList', $store->getStatus());
		$this->getView()->assign('storeList', $data['list']);
		$this->getView()->assign('attrs', $data['attrs']);
		$this->getView()->assign('pageHtml', $data['pageHtml']);
	}

}