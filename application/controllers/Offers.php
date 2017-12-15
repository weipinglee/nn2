<?php
/**
 * @author panduo
 * @desc 报盘列表offers
 * @date 2016-05-05 10:07:47
 */
use \tool\http;
use \Library\url;
use \Library\safe;
use \Library\tool;
use \nainai\order\Order;
use \Library\checkRight;


use \nainai\offer\product;

use \Library\JSON;

class OffersController extends PublicController {


	private $offer;
	private $order;

	public function init(){
		parent::init();
		//$this->getView()->setLayout('header');
		$this->offer = new offersModel();
		$this->order = new \nainai\order\Order();
	}

	//支付成功页面
	public function paySuccessAction(){
		$id = safe::filter($this->_request->getParam('id'));
		$order_no = safe::filter($this->_request->getParam('order_no'));
		$amount = safe::filter($this->_request->getParam('amount'));
		$pay_deposit = safe::filter($this->_request->getParam('payed'));
		$info = safe::filter($this->_request->getParam('info'));

		$this->getView()->assign('order_no',$order_no);
		$this->getView()->assign('id',$id);
		$this->getView()->assign('amount',$amount);
		$this->getView()->assign('info',$info);
		$this->getView()->assign('pay_deposit',$pay_deposit);
		$this->getView()->setLayout('layout2');
	}

	//列表
	public function offerListAction(){
		$this->getView()->assign('cur','offerlist');
		$page = safe::filterGet('page','int',1);

		//获取分类信息
		$cate = $this->getRequest()->getParam('cate');
		$cate = safe::filter($cate,'int',0);
		if($cate){
			$model = new offersModel();
			$cate_list = $model->getCateTopList($cate);
			$this->getView()->assign('cate_list',$cate_list);

		}
		//获取报盘类型信息
		$offertype = $this->getRequest()->getParam('type');
		$offertype = safe::filter($offertype);
		if($offertype=='gong'){
			$this->getView()->assign('searchtype',1);
		}
		else if($offertype=='qiu'){
			$this->getView()->assign('searchtype',2);
		}
		else{
			$this->getView()->assign('searchtype',0);
		}

		//获取搜索信息
		$search = $this->getRequest()->getParam('content');
		$search = safe::filter($search);
		$this->getView()->assign('search',$search);
		//获取商品顶级分类
		$productModel = new product();
		$category = $productModel->getTopCate();
		//获取报盘类型
		$type = $productModel->getTypeArray();
		//获取报盘模式
		$mode = $productModel->getModelArray();
		unset($mode[0]);
		$this->getView()->assign('cate', $category);
		$this->getView()->assign('type', $type);
		$this->getView()->assign('mode', $mode);
		$this->getView()->assign('user_type', $this->login['user_type']);
	}


	//计算定金
	public function payDepositComAction(){
		$num = safe::filterPost('num','floatval');
		$id = safe::filterPost('id','int');
		$price = safe::filterPost('price','floatval');

		$amount = $num * $price;
		$payDeposit = $this->order->payDepositCom($id,$amount);
		$res = $payDeposit === false ? tool::getSuccInfo(0,'获取定金失败') : tool::getSuccInfo(1,$payDeposit);
		die(JSON::encode($res));
	}

	//验证用户输入产品数量
	// public function checkNumAction(){
	// 	if(IS_AJAX){
	// 		$num = safe::filterPost('num','floatval');
	// 		$id = safe::filterPost('id','int');
	// 		$info = $this->offer->offerDetail($id);
	// 		$order = new \nainai\order\Order();
	// 		$res = $order->productNumValid($num,$info);
	// 		die(JSON::encode($res === true ? tool::getSuccInfo() : tool::getSuccInfo(0,$res)));
	// 	}


	public function offerDetailsAction(){
	$id = $this->getRequest()->getParam('id');
	$id = Safe::filter($id, 'int');

	if($id){
		$info = $this->offer->offerDetail($id);//print_r($info);exit;
		if(empty($info)){
			$this->error('报盘不存在或未通过审核');
		}
		if(time() > strtotime($info['expire_time'])){
			$this->error('报盘不存在或已过期');
		}

		$pro = new \nainai\offer\product();
		$info = array_merge($info,$pro->getProductDetails($info['product_id']));

		if ($info['insurance'] == 1 && $info['risk']) {
			$risk = new \nainai\insurance\Risk();
			$riskData = $risk->getProductRisk($info['risk']);
			$this->getView()->assign('riskData',$riskData);
		}

		$kefuData = array();
		if($info['kefu']){
			$kefu = new \Library\M('admin_kefu');
			$kefuData = $kefu->where(array('admin_id'=>$info['kefu']))->getObj();
		}

		$mem = new \nainai\member();

		$userData = $mem->getUserDetail($info['user_id']);

		//卖家资质
		$certObj = new \nainai\cert\certificate();
		$certStatus = $certObj->getCertStatus($info['user_id'],'deal');
		if($certStatus['status']==2){
			$this->getView()->assign('no_cert',0);
		}else{
			$mess = new \nainai\message($info['user_id']);
			$mess->send('credentials');
			$this->getView()->assign('no_cert',1);
		}

		$this->getView()->assign('data',$info);
		$this->getView()->assign('user',$userData);
		$this->getView()->assign('kefu',$kefuData);
		$this->getView()->assign('cur','offerlist');
	}
}

	public function purchaseDetailsAction(){
		$id = $this->getRequest()->getParam('id');
		$id = Safe::filter($id, 'int');

		if($id){
			$info = $this->offer->offerDetail($id);
			if(empty($info)){
				$this->error('报盘不存在或未通过审核');
			}
			if(time() > strtotime($info['expire_time'])){
				$this->error('报盘不存在或已过期');
			}
			
			$pro = new \nainai\offer\product();
			$info = array_merge($info,$pro->getProductDetails($info['product_id']));
			$kefuData = array();
			if($info['kefu']){
				$kefu = new \Library\M('admin_kefu');
				$kefuData = $kefu->where(array('admin_id'=>$info['kefu']))->getObj();
			}

			$mem = new \nainai\member();

			$userData = $mem->getUserDetail($info['user_id']);

			//卖家资质
			$certObj = new \nainai\cert\certificate();
			if ($this->login['pid'] == 0) {
				$certStatus = $certObj->getCertStatus($this->login['user_id'],'deal');
			}else{
				$certStatus = $certObj->getCertStatus($this->login['pid'],'deal');
			}
			if($certStatus['status']==2){
				$this->getView()->assign('no_cert',0);
			}else{
				$this->getView()->assign('no_cert',1);
			}

			$this->getView()->assign('data',$info);
			$this->getView()->assign('user',$userData);
			$this->getView()->assign('kefu',$kefuData);
			$this->getView()->assign('user_type', $this->login['user_type']);
		}
	}

	public function indexofferListAction()
	{
		$page = safe::filterGet('page','int',1);
		$config_id = $this->getRequest()->getParam('configid');
		$res = $this->offer->getOfferlistByConfig($config_id,$page,20,'o.id DESC',1);
		$this->getView()->assign('offer',$this->offer);
		$this->getView()->assign('data',$res);

	}

	//竞价一口价的详情页面
	public function offerDetails2Action(){
		$id = $this->getRequest()->getParam('id');
		$id = Safe::filter($id, 'int');

		if($id){
			$info = $this->offer->offerDetail($id);
			if(empty($info)){
				$this->error('报盘不存在或未通过审核');
			}
			if(time() > strtotime($info['expire_time'])){
				$this->error('报盘不存在或已过期');
			}

			$pro = new \nainai\offer\product();
			$info = array_merge($info,$pro->getProductDetails($info['product_id']));

			if ($info['insurance'] == 1 && $info['risk']) {
				$risk = new \nainai\insurance\Risk();
				$riskData = $risk->getProductRisk($info['risk']);
				$this->getView()->assign('riskData',$riskData);
			}

			$kefuData = array();
			if($info['kefu']){
				$kefu = new \Library\M('admin_kefu');
				$kefuData = $kefu->where(array('admin_id'=>$info['kefu']))->getObj();
			}

			$mem = new \nainai\member();

			$userData = $mem->getUserDetail($info['user_id']);

			//卖家资质
			$certObj = new \nainai\cert\certificate();
			$certStatus = $certObj->getCertStatus($info['user_id'],'deal');
			if($certStatus['status']==2){
				$this->getView()->assign('no_cert',0);
			}else{
				$mess = new \nainai\message($info['user_id']);
				$mess->send('credentials');
				$this->getView()->assign('no_cert',1);
			}

			//获取报价信息
            $baojiaData = $this->offer->baojiaData($id);

			$this->getView()->assign('data',$info);
			$this->getView()->assign('user',$userData);
			$this->getView()->assign('kefu',$kefuData);
			$this->getView()->assign('cur','offerlist');
			$this->getView()->assign('baojiaData',$baojiaData);
		}
	}





}