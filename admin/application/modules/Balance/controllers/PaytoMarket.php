<?php
/*
支付到平台资金明细类
@author panduo
 */
use Library\JSON;
use Library\safe;
use Library\tool;

class PaytoMarketController extends InitController {
	
	public function init() {
		$this->getView()->setLayout('admin');
		$this->object = new \nainai\fund\paytoMarket();

	}

	public function indexAction(){
		$page = Safe::filterGet('page','int',1);

		$list = $this->object->paylist($page);
		$this->getView()->assign('data',$list);
	}

	public function detailAction(){
		$id = safe::filter($this->_request->getParam('id'),'int');
		$data = $this->object->detail($id);
		$mem = new \nainai\member();
		$data['user'] = $mem->getUserDetail($data['user_id']);
		$product = new \nainai\offer\product();
		$data['offer'] = $product->offerDetail($data['offer_id']);
		$this->getView()->assign('data',$data);
	}
}