<?php
/*
会员账户管理
author:wangzhande
Date:2016/5/10
 */
use Library\Query;
use Library\Safe;
use Library\json;


class AccmanageController extends InitController {

	protected $account = '';
	//会用账户列表
	public function init() {
		$this->account = new userAccountModel();
		$this->getView()->setLayOut('admin');

	}

	/**
	 * 信誉保证金账户列表
	 */
	public function userCreditListAction(){
		$condition = array('name' => '信誉保证金账户列表', 'type' => 'Credit', 'types' => 1);
		$this->userListData($condition);
	}

	//开户信息表
	public function userAccListAction() {
		$condition = array('name' => '开户信息表', 'type' => 'Acc');
		$this->userListData($condition);
	}

	public function userListData($condition=array()){
		$data = $this->account->userCreditList($condition);

		$this->getView()->assign('data', $data);
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
	 * 开户信息审核页面
	 */
	public function checkBankDetailAction(){
		$obj = new fundBankModel();
		if(IS_POST){
			$user_id = safe::filterPost('id','int');
			if(!$user_id) $user_id = intval($this->_request->getParam('user_id'));
			$status = safe::filterPost('status','int');
			$message=safe::filterPost('message');
			$res = $obj->bankVerify($user_id,$status,$message);
			if($res['success']==1)  $adminMsg = new \nainai\adminMsg();
			$adminMsg->setStatus($this,$user_id);
			$messObj=new \nainai\message();
			if($status==1){
				$messObj->send('accountOk');
			}else{
				$messObj->send('accountFail');
			}
			die(json::encode($res));
		}
		else{
			$user_id = safe::filterGet('user_id','int',0);
			if(!$user_id) $user_id = intval($this->_request->getParam('user_id'));
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
		$condition = array('status' =>$obj::BANK_OK .','.$obj::BANK_NG);
		$condition['name'] = '已审核开户';
		$condition['type'] = 'user_bank';
		$this->listData($condition);
	}

	/**
	 * 会员待审核开户列表
	 *
	 */
	public function checkbankListAction()
	{
		$obj = new fundBankModel();
		$condition = array('status' => $obj::BANK_APPLY);
		$condition['name'] = '待审核开户';
		$condition['type'] = 'user_bank';
		$this->listData($condition);
	}

	public function listData($condition = array()){
		$obj = new fundBankModel();
		$data = $obj->getBankList($condition);

		$this->getView()->assign('data', $data);
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