<?php

/**
 * @name MemberController
 * @author weipinglee
 * @desc 角色认证管理控制器
 * date:2016-5-3
 */
use \Library\safe;
use \nainai\cert\certDealer;
use \Library\Thumb;
use \Library\url;
class certManageController extends Yaf\Controller_Abstract {


	public function init(){
		$this->getView()->setLayout('admin');
		//echo $this->getViewPath();
	}
	/** 
     * 默认动作
     * Yaf支持直接把Yaf_Request_Abstract::getParam()得到的同名参数作为Action的形参
     * 对于如下的例子, 当访问http://yourhost/yar-demo/index/index/index/name/root 的时候, 你就会发现不同
     */
	public function indexAction() {


	}



	/**
	 *交易商认证列表页
     */
	public function dealerCertAction(){
		$m = new certDealer();

		$page = safe::filterGet('page','int',1);
		$pageData = $m->certList($page);

		$this->getView()->assign('certData',$pageData['data']);
		$this->getView()->assign('bar',$pageData['bar']);

	}

	/**
	 * 交易商申请认证详情页
	 */
	public function dealercertDetailAction(){
		$id = $this->getRequest()->getParam('uid',0);
		$id = safe::filter($id,'int',0);

		if($id){
			$certObj = new certificate();

			$certData = $certObj->getCertDetail($id,'deal');

			if(empty($certData))
				$this->redirect(url::createUrl('/member/dealerCert'));

			$this->getView()->assign('user',$certData[0]);
			$this->getView()->assign('detail',$certData[1]);
			$this->getView()->assign('cert',$certData[2]);
		}
		else{
			return false;
		}



	}

	/**
	 * 角色认证
	 */
	public function doDealerCertAction(){
		if(IS_POST){
		$user_id = safe::filterPost('user_id','int',0);
		$status  = safe::filterPost('result','int',0);
		$info    = safe::filterPost('info');
		$status  = $status==1 ? 1 : 0;
		$m = new certificate();
		$m->certVerify($user_id,$status,$info,'deal');

		}
		return false;

	}








}
