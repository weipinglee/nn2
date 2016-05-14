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
class OffersController extends \Yaf\Controller_Abstract {

	private $offer;


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

		if(empty($info)){
			return false;
		}
		$info['amount'] = $info['minimum'] * $info['price'];
		$order_mode = new Order($info['mode']);
		$info['pay_deposit'] = $order_mode->payDepositCom($info['id'],$info['amount']);

		$this->getView()->assign('data',$info);
	}

//支付成功页面
	public function paySuccessAction(){
		$order_no = safe::filter($this->_request->getParam('order_no'));
		$amount = safe::filter($this->_request->getParam('amount'));
		$pay_deposit = safe::filter($this->_request->getParam('payed'));

		$this->getView()->assign('order_no',$order_no);
		$this->getView()->assign('amount',$amount);
		$this->getView()->assign('pay_deposit',$pay_deposit);
	}


}