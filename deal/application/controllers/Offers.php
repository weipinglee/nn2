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
		$this->offer = new OffersModel();
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
	}

	//列表
	public function offerListAction(){
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

		$this->getView()->assign('cate', $category);
		$this->getView()->assign('type', $type);
		$this->getView()->assign('mode', $mode);
	}

	//支付页面
	public function checkAction(){

		$id = safe::filter($this->_request->getParam('id'),'int',1);

		$info = $this->offer->offerDetail($id);
		if(empty($info)){
			$this->error('报盘不存在或未通过审核');
		}
		if(time() > strtotime($info['expire_time'])){
			$this->error('报盘不存在或已过期');
		}

		if($info['divide']==\nainai\offer\product::UNDIVIDE ){//不可拆分
			$info['fixed'] = true;
			$info['minimum'] = $info['quantity'];
			$info['amount'] = $info['quantity'] * $info['price'];
		}
		else if($info['left'] <= $info['minimum']){//余量不够最小起订量
			$info['fixed'] = true;
			$info['minimum'] = $info['left'];
			$info['amount'] = $info['left'] * $info['price'];
		}
		else{//可拆分且余量大于起订量
			$info['fixed'] = false;
			$info['amount'] = $info['minimum'] * $info['price'];
		}

		$order_mode = new Order($info['mode']);
		$info['minimum_deposit'] = floatval($order_mode->payDepositCom($info['id'],$info['minimum']*$info['price']));
		$info['left_deposit'] = floatval($order_mode->payDepositCom($info['id'],$info['left']*$info['price']));

		$info['show_payment'] = in_array($info['mode'],array(\nainai\order\Order::ORDER_STORE,\nainai\order\Order::ORDER_DEPOSIT)) ? 1 : 0;
		//商品剩余数量
		$pro = new \nainai\offer\product();

		$info = array_merge($info,$pro->getProductDetails($info['product_id']));

		//判断下是否能够申请保险
		if($info['insurance'] == 0){
			//已经申请了的不能在申请
			$risk = new \nainai\insurance\RiskApply();
			$data = $risk->getRiskApply(array('buyer_id' => $this->login['user_id'], 'offer_id' => $info['id']), 'id');
			if (!empty($data)) {
				$info['insurance'] = 1;
			}
		}

		$this->getView()->assign('data',$info);

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



	 /**
	 * AJax获取产品分类信息
	* @return [Json]
	*/
	public function ajaxGetCategoryAction(){
		$pid = safe::filterPost('pid', 'int',0);
		$type = safe::filterPost('type', 'int',0);
		$mode = safe::filterPost('mode', 'int',0);
		$page = safe::filterPost('page','int',1);
		$order = safe::filterPost('sort');
		$area = safe::filterPost('area','int',0);
		$search = safe::filterPost('search');



		//获取这个分类下对应的产品信息
		$condition = array();
		$cate = array();
		if($pid!=0)
			$condition['pid'] = $pid;
		if($type!=0){
			$condition['type'] = $type;
		}
		if($mode!=0){
			$condition['mode'] = $mode;
		}
		if($area!=0){
			$condition['area'] = $area;
		}
		if($search!=''){
			$condition['search'] = $search;
		}

		if($order!=''){
			$orderArr = explode('_',$order);
			switch($orderArr[0]){
				case 'price' : {
					if(isset($orderArr[1]) && $orderArr[1]=='asc')
						$order = 'price asc';
					else $order = 'price desc';
				}
					break;
				case 'time' : {
					if(isset($orderArr[1]) && $orderArr[1]=='asc')
						$order = 'apply_time asc';
					else $order = 'apply_time desc';
				}
					break;
				default : {
					$order = 'apply_time desc';
				}
			}
		}
		else $order = '';

		$data = $this->offer->getList($page, $condition,$order);

		echo json::encode($data);
		exit();
	}


	/**
	 * 报价页面
	 */
	public function reportAction(){
		$id = $this->getRequest()->getParam('id');
		$id = Safe::filter($id, 'int');

		if (intval($id) > 0) {
			$PurchaseOfferModel = new \nainai\offer\PurchaseOffer();
			$offerDetail = $PurchaseOfferModel->getOfferProductDetailDeal($id);

			if(empty($offerDetail)){
				$this->error('采购不存在');exit;
			}


			$this->getView()->assign('offer', $offerDetail[0]);
			$this->getView()->assign('product', $offerDetail[1]);
		}else{
			$this->error('未知的采购报盘!');
		}

	}

	public function offerDetailsAction(){
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

			$this->getView()->assign('data',$info);
			$this->getView()->assign('user',$userData);
			$this->getView()->assign('kefu',$kefuData);
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

			$this->getView()->assign('data',$info);
			$this->getView()->assign('user',$userData);
			$this->getView()->assign('kefu',$kefuData);
		}
	}



}