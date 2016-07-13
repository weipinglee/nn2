<?php
/*
会员账户管理
author:wangzhande
Date:2016/5/10
 */
use Library\Query;
use Library\Safe;
use Library\json;


class AccmanageController extends Yaf\Controller_Abstract {

	protected $account = '';
	//会用账户列表
	public function init() {
		$this->account = new userAccountModel();
		$this->getView()->setLayOut('admin');

	}

	protected function getBankListPage(){
		$pageData = array();
		$pageData['search'] = array('time'=>'申请时间','like'=>'用户名，身份证号');
		$pageData['listTitle'] = array('username'=>'用户名','bank_name'=>'开户行','card_type'=>'银行卡类型','true_name'=>'姓名','identify_no'=>'身份证号','status'=>'状态');
		$this->getView()->assign('pageData',$pageData);
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
	 * 会员待审核开户列表
	 *
	 */
	public function checkbankListAction()
	{
		$this->getBankListPage();
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
		$this->getView()->assign('info',$info);
	}

	/**
	 * 后台增加用户信誉值保证金
	 */
	public function userCreditAddAction()
	{
		if(IS_POST){
			$credit = safe::filterPost('credit','floatval');
			$user_id = safe::filterPost('user_id','int');
			$obj = new \Library\M('user_account');
			$obj->beginTrans();
			$obj->where(array('user_id'=>$user_id))->setInc('credit',$credit);

			$credit_config = new \nainai\CreditConfig();
			$credit_config->changeUserCredit($user_id,'credit_money',$credit);

			$log = new \Library\log();
			$log->addLog(array('content'=>'为用户'.$user_id.'充值信誉保证金'.$credit.'元'));

			$res = $obj->commit();
			die(JSON::encode($res === true ? \Library\tool::getSuccInfo() : \Library\tool::getSuccInfo(0,'操作失败')));
		}else{
			die('error');
		}
	}
}

?>