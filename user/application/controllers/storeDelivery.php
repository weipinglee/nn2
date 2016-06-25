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
		if(IS_POST){
			$delivery_id = safe::filterPost('id','int',0);
			$user_id = $this->user_id;
			if($delivery_id){
				$store = new \nainai\delivery\StoreDelivery();
				$res = $store->payStoreFees($delivery_id,$user_id);
				if($res['success'] == 1){
					die(json::encode(tool::getSuccInfo(1,'已支付仓库费用',url::createUrl('/delivery/deliselllist'))));

				}else{
					die(json::encode($res));
				}
			}



		}

	}
		
}