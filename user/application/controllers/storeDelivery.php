<?php 

/**
 * 仓单提货
 */
use \Library\safe;
use \Library\tool;
use \Library\JSON;
use \Library\url;
use \Library\checkRight;

class StoreDeliveryController extends DeliveryController{

	//显示仓库费用
	public function storeFeesPageAction(){
		$delivery_id = safe::filter($this->_request->getParam('id'));
		$store = new \nainai\delivery\StoreDelivery();
		$storeInfo = $store->storeFees($delivery_id);
		$this->getView()->assign('info',$storeInfo);
	}

	//卖家支付仓库管理费用
	public function storeFeesAction(){
		$delivery_id = safe::filter($this->_request->getParam('id'));
		$user_id = $this->user_id;

		$store = new \nainai\delivery\StoreDelivery();
		$res = $store->payStoreFees($delivery_id,$user_id);

		if($res['success'] == 1){
			$this->success('已支付仓库费用',url::createUrl('/Delivery/deliveryList?is_seller=1'));
		}else{
			$this->error($res['info']);
		}
	}
		
}