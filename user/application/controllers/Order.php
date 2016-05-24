<?php
/**
 * 订单控制器
 */

use \Library\safe;
use \Library\tool;
use \Library\JSON;
use \Library\url;
use \Library\checkRight;

class OrderController extends UcenterBaseController{

	public function init(){
		parent::init();
        // $right = new checkRight();
        // $right->checkLogin($this);//未登录自动跳到登录页
        // $this->getView()->setLayout('ucenter');
        $this->order = new \nainai\order\Order;
        $this->free = new \nainai\order\FreeOrder();
		$this->deposit = new \nainai\order\DepositOrder();
		$this->store = new \nainai\order\StoreOrder();
		$this->entrust = new \nainai\order\EntrustOrder();
	}

	//买家支付尾款
	public function buyerRetainageAction(){
		if(IS_POST){
			$order_id = safe::filterPost('order_id','int');
			$type = safe::filterPost('payment');
			$proof = safe::filterPost('imgproof');
			$user_id = 36;//$this->user_id;
			$res = $this->order->buyerRetainage($order_id,$user_id,$type,$proof);
			if($res['success'] == 1){
				$title = $type == 'offline' ? '已上传支付凭证' : '已支付尾款';
				$info = $type == 'offline' ? '请等待卖家确认凭证' : '合同已生效，可申请提货';

				$this->redirect(url::createUrl('/Order/payRetainageSuc')."/title/$title/info/$info");
			}else{
				die($res['info']);
			}
			return false;
		}else{
			$order_id = safe::filter($this->_request->getParam('order_id'),'int');
			$data = $this->order->contractDetail($order_id);
			$data['pay_retainage'] = number_format(floatval($data['amount']) - floatval($data['pay_deposit']),2);
			$this->getView()->assign('show_online',$data['mode'] == \nainai\order\Order::ORDER_DEPOSIT || $data['mode'] == \nainai\order\Order::ORDER_STORE ? 1 : 0);
			$this->getView()->assign('data',$data);
		}
	}
	
	//支付尾款成功
	public function payRetainageSucAction(){
		$this->getView()->assign('title',safe::filter($this->_request->getParam('title')));
		$this->getView()->assign('info',safe::filter($this->_request->getParam('info')));
	}

	//卖家确认买方线下支付凭证
	public function confirmProofAction(){
		$order_id = intval($this->_request->getParam('order_id'));
		$type = safe::filter('type');//0:未确认 1：确认
		$type = true;
		$user_id = 36;//$this->user_id;
		$res = $this->order->confirmProof($order_id,$user_id,$type);
		if($res['success'] == 1)
			$this->redirect($_SERVER['HTTP_REFERER']);
		else
			echo $res['info'];
		return false;
	}
}