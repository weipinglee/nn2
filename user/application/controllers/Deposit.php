<?php 

/**
 * 保证金摘牌控制器
 */
use \Library\safe;
use \Library\tool;
use \Library\JSON;
use \Library\url;
use \Library\checkRight;
use \Library\M;

class DepositController extends OrderController{

	//卖家支付保证金
	public function sellerDepositAction(){
		if(IS_POST){
			$order_id = safe::filterPost('order_id','int');
			$payment = safe::filterPost('payment','int');
			$user_id = $this->user_id;
			$pay = true;
			$res = $this->deposit->sellerDeposit($order_id,$pay,$user_id,$payment);
			if($res['success'] == 1)
				die(json::encode(tool::getSuccInfo(1,'保证金支付成功',url::createUrl('/contract/sellerdetail?id='.$order_id))));
			else
				die(json::encode(tool::getSuccInfo(0,$res['info'])));
			return false;
		}else{
			$order_id = safe::filter($this->getRequest()->getParam('order_id'),'int');
			$data = $this->deposit->contractDetail($order_id,'seller');
			$sys_percent_obj = new M('scale_offer');//后台配置保证金基数比例
			$sys_percent = $sys_percent_obj->where(array('id'=>1))->getField('deposite');
			//获取当前用户等级保证金比例
			$user = new \nainai\member();
			$user_percent = $user->getUserGroup($this->user_id);//当前用户id
			if($user_percent === false){
				$this->error('用户错误');
			}

			$percent = floatval($sys_percent) * floatval($user_percent['caution_fee']);
			$data['seller_percent'] = $percent / 100;
			$data['seller_deposit'] = number_format($data['amount'] * $percent / 10000,2);
			$this->getView()->assign('data',$data);
		}
	}

	//支付保证金成功页面
	public function sucAction(){}

}