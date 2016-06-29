<?php

namespace nainai\controller;
use \Library\checkRight;
use \Library\url;

/**
 * 用户中心的抽象基类
 */
class Base extends \Yaf\Controller_Abstract{

	protected $certType = null;

	//认证页面方法，检测到未认证跳转到该位置
	private static $certPage = array(
		'deal'=>'dealcert',
		'store'=>'storecert'
	);

	 protected function init(){
		$right = new checkRight();
		$right->checkLogin($this);//未登录自动跳到登录页

		 if(isset($this->user_id) && $this->user_id>0){
			 $this->getView()->assign('login',1);
			 $this->getView()->assign('username',$this->username);
		 }else $this->getView()->assign('login',0);
		  //需要认证的方法未认证则跳转到认证页面
		  // if($this->certType!==null  && (!isset($this->cert[$this->certType]) || $this->cert[$this->certType]==0))
		  // {
			 //  $this->redirect(url::createUrl('/ucenter/'.self::$certPage[$this->certType].'@user'));exit;
		  // }

    }

	protected function success($info = '操作成功！',$redirect = ''){
		if(isset($redirect)){
			$redirect = str_replace('%','||',urlencode($redirect));
		}

		$this->redirect(url::createUrl("/Oper/success?info={$info}&redirect={$redirect}"));
	}

	protected function error($info = '操作失败！',$redirect = ''){

		if(isset($redirect)){
			$redirect = str_replace('%','||',urlencode($redirect));
		}
		$this->redirect(url::createUrl("/Oper/error?info={$info}&redirect={$redirect}"));
	}

	protected function confirm($info = '确认此项操作？',$redirect = ''){

		if(isset($redirect)){
			$redirect = str_replace('%','||',urlencode($redirect));
		}
		$this->redirect(url::createUrl("/Oper/confirm?info={$info}&redirect={$redirect}"));
	}



}
