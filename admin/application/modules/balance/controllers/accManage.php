<?php
/*
会员账户管理
author:wangzhande
Date:2016/5/10
 */
use Library\Query;
use Library\Safe;
use Library\json;
use Library\tool;
class accManageController extends Yaf\Controller_Abstract {
	//会用账户列表
	public function init() {
		$this->getView()->setLayOut('admin');
		$this->account = new userAccountModel();
	}
	public function userAccListAction() {
		$page = safe::filterGet('page', 'int');
		$accObj = new Query('user_account as a');
		$accObj->join = 'left join user as u on a.user_id = u.id';
		$accObj->fields = 'a.*,u.username,u.mobile,u.create_time';
		$accObj->page = $page;
		$accInfo = $accObj->find();
		$accBar = $accObj->getPageBar();
		foreach ($accInfo as $k => $v) {
			$accInfo[$k]['amount'] = $v['fund']+$v['freeze'];
		}
		//$accInfo['amount'] = $accInfo['fund']+$accInfo['freeze'];
		$this->getView()->assign('accInfo', $accInfo);
		$this->getView()->assign('accBar', $accBar);

	}
	public function userAccInfoAction() {
		echo "<br />";
		echo "<br />";
		$page = safe::filterGet('page', 'int');
		$id = safe::filterGet('user_id', 'int');

		$fundFlowObj = new Query('user_fund_flow as f');
		$fundFlowObj->join = 'left join user as u on u.id=f.user_id';
		$fundFlowObj->fields = 'u.username,f.*';
		$fundFlowObj->where = 'f.user_id= :user_id';
		$fundFlowObj->bind = array('user_id' => $id);
		$fundFlowObj->page = $page;
		$userAccInfo = $fundFlowObj->find();
		$userAccBar = $fundFlowObj->getPageBar();
		$this->getView()->assign('userAccBar', $userAccBar);
		$this->getView()->assign('userAccInfo', $userAccInfo);

	}

	/**
	 * 信誉保证金账户列表
	 */
	public function userCreditListAction(){
		$page = safe::filterGet('page','int');
		$list = $this->account->userCreditList($page);
		$this->getView()->assign('data',$list['data']);
		$this->getView()->assign('page',$list['bar']);
	}

	/**
	 * 信誉保证金详情
	 */
	public function userCreditDetailAction(){
		$user_id = safe::filterGet('user_id','int');
		$info = $this->account->userCreditDetail($user_id);
		// tool::pre_dump($info);
		$this->getView()->assign('info',$info);
	}
	
	/**
	 * 后台增加或减少用户信誉值保证金
	 */
	public function userCreditAddAction()
	{
		if(IS_POST){
			$credit = safe::filterPost('credit','floatval');
			$user_id = safe::filterPost('user_id','int');
			$credit_config = new \nainai\CreditConfig();
			$res = $credit_config->changeUserCredit($user_id,'credit_money',$credit);
			if($res){
				$log = new \Library\log();
				$log->addLog(array('content'=>$user_id.'充值信誉保证金'.$credit.'元'));
				//报错：SQLSTATE[42S22]: Column not found: 1054 Unknown column 'datetime' in 'field list'
			}
			die(JSON::encode($res === true ? tool::getSuccInfo() : tool::getSuccInfo(0,'操作失败')));
		}else{
			die('error');
		}
	}
	/**
	 * 会员待审核开户列表
	 *
	 */
	public function checkbankListAction()
	{
		$obj = new fundBankModel();
		$page = safe::filterGet('page', 'int', 1);
		$where = 'b.status = 0';
		$data = $obj->getBankList($page, $where);
		$this->getView()->assign('data', $data[0]);
		$this->getView()->assign('bar', $data[1]);
	}

	/**
	 * 开户信息审核页面
	 */
	public function checkBankDetailAction(){
		$obj = new fundBankModel();
		if(IS_POST){
			$user_id = safe::filterPost('id','int');
			$status = safe::filterPost('status','int');
			$res = $obj->bankVerify($user_id,$status);
			die(json::encode($res));

		}
		else{
			$user_id = safe::filterGet('user_id','int',0);

			$data = $obj->getBankDetail($user_id);
			$this->getView()->assign('bank',$data[0]);
			$this->getView()->assign('user',$data[1]);

		}
	}

	/**
	 * 开户信息审核页面
	 */
	public function checkedBankDetailAction(){
		$obj = new fundBankModel();

		$user_id = safe::filterGet('user_id','int',0);

		$data = $obj->getBankDetail($user_id);
		$this->getView()->assign('bank',$data[0]);
		$this->getView()->assign('user',$data[1]);

	}

	/**
	 * 会员已审核开户列表
	 *
	 */
	public function checkedbankListAction(){
		$obj = new fundBankModel();
		$page = safe::filterGet('page','int',1);
		$where = 'b.status != 0';
		$data = $obj->getBankList($page,$where);
		$this->getView()->assign('data',$data[0]);
		$this->getView()->assign('bar',$data[1]);
	}
}

?>