<?php

use Library\Query;
use Library\Safe;
use Library\json;

/**
 * 银行签到签退
 */
class BankSignController extends InitController {

	//手动签到签退
	public function manuAction(){
		$sign = new BankSignModel();		
		if(IS_POST){
			$type = safe::filterPost('type');
			$bank_name = safe::filterPost('bank_name');
			$res = call_user_func_array(array($sign,$type),array($bank_name,$this->admin_id));
			die(json::encode($res));
		}else{
			$res = $sign->getSettings();
			$bank_sign = $sign->bank_sign();
			foreach ($res as $key => &$value) {
				foreach ($bank_sign as $k => $v) {
					if($v['bank_name'] == $value['bank_name']){
						$value['signin'] = 1;
						$value['signout'] = $v['signout'] ? 1 : 0;
					}
				}
			}
			// echo '<pre>';var_dump($res);exit;
			$this->getView()->assign('settings',$res);
		}
	}

	//自动签到签退
	public function autoAction(){
		$sign = new BankSignModel();
		if(IS_POST){
			$data['bank_name'] = safe::filterPost('bank_name');
			$data['auto_signin'] = safe::filterPost('auto_signin');
			$data['auto_signout'] = safe::filterPost('auto_signout');
			$data['trade_date'] = implode(',',safe::filterPost('trade_date'));
			$res = $sign->updateSettings($data);
			die(json::encode($res));
		}else{
			//获取所有设置银行
			$res = $sign->getSettings();
			$this->getView()->assign('settings',$res);
		}
	}
}