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

class testController extends  UcenterBaseController{

	public function indexAction(){
		$pay = safe::filter($this->_request->getParam('pay'));
		if($pay){
			$pay_secret = $this->getRequest()->getParam('pay_secret');

			$user = new \nainai\member();
			$res = $user->validPaymentPassword($pay_secret,$this->user_id);
			if($res)
				echo 'ok';
			else echo 'ng';
		}
		else{

		}
	}

	public function formAction(){
		if(IS_POST){
			die(json::encode(tool::getSuccInfo()));
		}
		else{

		}

	}

}