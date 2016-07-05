<?php

use \Library\url;
use \nainai\store;
use \Library\Safe;
use \Library\Thumb;
use \nainai\offer\product;
use \Library\json;
/**
 * 仓单管理的的控制器类
 */
class ManagerStoreController extends UcenterBaseController{

	protected  $certType = 'store';



	public function indexAction(){}

	public function addSuccessAction(){}

	/**
	 * 审核仓单列表
	 */
	public function applyStoreListAction(){
		$page = Safe::filterGet('page', 'int', 0);
		$type = $this->getRequest()->getParam('type');
		$type = Safe::filter($type,'int',1);
		$store = new store();

		if($type==1)
			$data = $store->getManagerApplyStoreList($page,$this->user_id);
		else
			$data = $store->getManagerStoreList($page,$this->user_id);

		$this->getView()->assign('statuList', $store->getStatus());
		$this->getView()->assign('storeList', $data['list']);
		$this->getView()->assign('attrs', $data['attrs']);
		$this->getView()->assign('pageHtml', $data['pageHtml']);
	}

	/**
	 * 仓单提货出库审核列表
	 */
	public function storeCheckListAction(){
		$store = new \nainai\delivery\StoreDelivery();
		$page = safe::filterGet('page','int',1);
		$list = $store->storeCheckList($page,$this->user_id);
		$this->getView()->assign('data',$list['data']);
        $this->getView()->assign('page',$list['bar']);
	}

	/**
	 * 仓单提货详情
	 */
	public function storeCheckDetailAction(){
		$store = new \nainai\delivery\StoreDelivery();
		$id = safe::filter($this->_request->getParam('id'));
		$info = $store->storeFees($id);
		$this->getView()->assign('info',$info);
	}

	/**
	 * 确认出库
	 */
	public function storeDeliveryCheckAction(){
		$delivery_id = safe::filter($this->_request->getParam('id'));

		$store = new \nainai\delivery\StoreDelivery();
		$res = $store->managerCheckout($delivery_id);
		if($res['success'] == 1){
			$this->success('已确认出库',url::createUrl('/ManagerStore/storeCheckList'));
		}else{
			$this->error($res['info']);
		}

	}

	/**
	 * 审核仓单后，仓单签发的详情页面
	 */
	public function applyStoreSignAction(){
		$id = $this->getRequest()->getParam('id');
		$id = Safe::filter($id, 'int', 0);
		if (intval($id) > 0) {
			$store = new store();
			$data = $store->getManagerStoreDetail($id,$this->user_id);


			$this->getView()->assign('storeDetail', $data);
		}else{
			$this->redirect('/ManagerStore/ApplyStoreList');
		}
	}


	/**
	 * 仓单审核页面
	 */
	public function applyStoreCheckAction(){
		$category = array();
		$id = $this->getRequest()->getParam('id');
		$id = Safe::filter($id, 'int', 0);
		if (intval($id) > 0) {
			$store = new store();
			$data = $store->getManagerStoreDetail($id,$this->user_id);

			//获取商品分类信息，默认取第一个分类信息
		        $productModel = new product();
		        $attr_ids = array();
		        $data['attribute'] = unserialize($data['attribute']);
		        $attr_ids = array_keys($data['attribute']);

		       $this->getView()->assign('detail', $data);
	         $this->getView()->assign('attrs', $productModel->getHTMLProductAttr($attr_ids));
		}
	        
	}

	public function applyStoreDetailAction(){
		$id = $this->getRequest()->getParam('id');
		$id = Safe::filter($id, 'int', 0);
		if (intval($id) > 0) {
			$store = new store();
			$data = $store->getManagerStoreDetail($id,$this->user_id);

			$this->getView()->assign('storeDetail', $data);
			$this->getView()->assign('photos', $data['photos']);
		}else{
			$this->redirect('/ManagerStore/ApplyStoreList');
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
			$apply['status'] = (Safe::filterPost('apply', 'int', 0) == 1) ? 1 : 0;//获取审核状态

			$store = new store();
			$res = $store->storeManagerCheck($apply, $id,$this->user_id);
			die(json::encode($res)) ;
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
				'store_pos' => safe::filterPost('pos'),
				'cang_pos'  => safe::filterPost('cang'),
				'store_price'=> safe::filterPost('store_price'),
				'in_time' => safe::filterPost('inTime'),
				'rent_time' => safe::filterPost('rentTime'),
				'check_org' => safe::filterPost('check'),
				'check_no'  => safe::filterPost('check_no'),
				'confirm'   => \Library\tool::setImgApp(safe::filterPost('imgfile1'))
			);

			if (!empty(safe::filterPost('packNumber'))) {
				$apply['package_num'] = safe::filterPost('packNumber', 'float');
				$apply['package_weight'] = safe::filterPost('packWeight', 'float');
			}

			$productData = array('quantity'=>safe::filterPost('quantity','float'));

			$store = new store();
			$res = $store->storeManagerSign($apply, $productData,$id,$this->user_id);
			die(json::encode($res)) ;
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