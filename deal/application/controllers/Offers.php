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


	//列表
	public function offerListAction(){
		$page = safe::filterGet('page','int');
		$category = array();

		//获取商品分类信息，默认取第一个分类信息
		$productModel = new product();
		$category = $productModel->getCategoryLevel();

		$pageData = $this->offer->getList($page);

        		$this->getView()->assign('categorys', $category['cate']);
		$this->getView()->assign('data',$pageData['data']);
		$this->getView()->assign('page',$pageData['bar']);
	}

	//支付页面
	public function checkAction(){

		$id = safe::filter($this->_request->getParam('id'),'int',1);
		$info = $this->offer->offerDetail($id);

		if(empty($info)){
			die(JSON::encode(tool::getSuccInfo(0,'报盘不存在或未通过审核')));
		}
		$info['amount'] = $info['minimum'] * $info['price'];
		$order_mode = new Order($info['mode']);
		$info['minimum_deposit'] = floatval($order_mode->payDepositCom($info['id'],$info['minimum']*$info['price']));
		$info['left_deposit'] = floatval($order_mode->payDepositCom($info['id'],$info['left']*$info['price']));


		$info['show_payment'] = in_array($info['mode'],array(\nainai\order\Order::ORDER_STORE,\nainai\order\Order::ORDER_DEPOSIT)) ? 1 : 0;
		//商品剩余数量
		
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
		$pid = Safe::filterPost('pid', 'int',0);
		if($pid){
			$productModel = new product();
			$cate = $productModel->getCategoryLevel($pid);

			//获取这个分类下对应的产品信息
			$condition = array(
				'where' => 'FIND_IN_SET(cate_id, :ids)',
				'bind' => array('ids' => $pid)
			);
			$cate['product'] = $this->offer->getList($pid, $condition);
			unset($cate['chain']);

			echo json::encode($cate);
		}
		exit();
	}


	/**
	 * 报价页面
	 */
	public function reportAction(){
		$id = $this->getRequest()->getParam('id');
		$id = safe::filter($id, 'id');

		if (intval($id) > 0) {
			$PurchaseOfferModel = new \nainai\offer\PurchaseOffer();
			$offerDetail = $PurchaseOfferModel->getOfferProductDetail($id);
			$user = new \Library\M('user');
			$username = $user->where(array('id'=>$offerDetail[0]['user_id']))->getField('username');

			$attrText = array_keys($offerDetail[1]['attr_arr']);
			$attrs = array_keys($offerDetail[1]['attribute']);
			$this->getView()->assign('attr', $attrs);
			$this->getView()->assign('attrtext', $attrText);
			$this->getView()->assign('username', $username);
			$this->getView()->assign('offer', $offerDetail[0]);
			$this->getView()->assign('product', $offerDetail[1]);
		}else{
			$this->error('未知的采购报盘!');
		}

	}





}