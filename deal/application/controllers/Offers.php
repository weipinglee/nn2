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
use \nainai\order;
use \Library\checkRight;
class OffersController extends \Yaf\Controller_Abstract {

	private $offer;
	private $right;



	public function init(){
		$this->offer = new OffersModel();
	}


	//列表
	public function offerListAction(){
		$page = safe::filterGet('page','int');

		$pageData = $this->offer->getList($page);

		$this->getView()->assign('data',$pageData['data']);
		$this->getView()->assign('bar',$pageData['bar']);
	}

	//支付页面
	public function checkAction(){
		$id = safe::filter($this->_request->getParam('id'),'int',1);
		$info = $this->offer->offerDetail($id);

		print_r($info);
		$info['amount'] = $info['minimum'] * $info['price'];
		$order_mode = new order\Order();
		$info['pay_deposit'] = $order_mode->payDepositCom($info['id'],$info['amount']);

		$this->getView()->assign('data',$info);
	}






}