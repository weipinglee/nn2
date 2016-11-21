<?php

/**
 * 银行签到签退管理与设置
 */
use \Library\M;
use \Library\Query;
use \Library\tool;
class BankSignModel{

	protected $sign;
	protected $setting;
	public function __construct(){
		$this->sign = new M('bank_sign');
		$this->setting = new M('bank_sign_setting');
	}

	//获取所有可设置银行信息
	public function getSettings(){
		$res = $this->setting->where(array('status'=>1))->select();
		foreach ($res as $key => &$value) {
			$value['trade_date'] = explode(',', $value['trade_date']);
		}
		return $res;
	}

	/**
	 * 更新自动签到/退设置
	 * @param  array $data 数据数组
	 * @return array
	 */
	public function updateSettings($data){
		$bank_name = $data['bank_name'];
		unset($data['bank_name']);
		$res = $this->setting->where(array('bank_name'=>$bank_name))->data($data)->update();
		return intval($res)>0 ? tool::getSuccInfo() : tool::getSuccInfo(0,$this->setting->getError());
	}

	/**
	 * 签到
	 * @param  string $bank_name 签到银行名
	 * @param  int  $admin_id  当前管理员id
	 */
	public function signin($bank_name,$admin_id){
		$day = date('Y-m-d',time());
		$data = array('date'=>$day,'bank_name'=>$bank_name);
		$is_signed = $this->sign->where($data)->getObj();

		if($is_signed){
			return tool::getSuccInfo(0,'已签到,请不要重复签到');
		}else{
			$data['signin'] = date('Y-m-d H:i:s',time());
			$data['signin_user'] = $admin_id;
			$res = $this->sign->data($data)->add();
			return intval($res)>0 ? tool::getSuccInfo(1,'已签到') : tool::getSuccInfo(0,$this->setting->getError()?$this->setting->getError() : '签到失败，请重试');
		}
	}

	/**
	 * 签退
	 * @param  string $bank_name 签退银行名
	 * @param  int  $admin_id  当前管理员id
	 */
	public function signout($bank_name,$admin_id){
		$day = date('Y-m-d',time());
		$data = array('date'=>$day,'bank_name'=>$bank_name);
		$record = $this->sign->where($data)->getObj();

		if($record['signout']){
			return tool::getSuccInfo(0,'已签退,请不要重复签退');
		}else{
			$data['signout'] = date('Y-m-d H:i:s',time());
			$data['signout_user'] = $admin_id;
			$res = $this->sign->where(array('id'=>$record['id']))->data($data)->update();
			return intval($res)>0 ? tool::getSuccInfo(1,'已签退') : tool::getSuccInfo(0,$this->setting->getError()?$this->setting->getError() : '签退失败，请重试');
		}
	}

	/**
	 * 获取各银行签到签退情况
	 */
	public function bank_sign(){
		$day = date('Y-m-d',time());
		return $this->sign->where(array('date'=>$day))->select();
	}

}