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
		// $this->object->paytoMarket('112','1','1','2','26.00','测试');exit;
		$page = Safe::filterGet('page','int',1);
		$name = Safe::filterGet('name');
		$where = '';
		
		$name && $where .= 'username = '.$name;
		$list = $this->object->paylist($page,$where);
		$this->getView()->assign('data',$list['data']);
		$this->getView()->assign('page',$list['page']);
	}

	public function detailAction(){
		$id = safe::filter($this->_request->getParam('id'),'int');
		$data = $this->object->detail($id);
		$mem = new \nainai\member();
		$data['user'] = $mem->getUserDetail(array('username'=>$data['username']));
		$product = new \nainai\offer\product();
		$data['offer'] = $product->offerDetail($data['offer_id']);
		// echo '<pre>';var_dump($data);exit;
		$this->getView()->assign('data',$data);
	}
}