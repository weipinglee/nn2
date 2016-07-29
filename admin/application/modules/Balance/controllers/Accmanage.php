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
		$page = safe::filterGet('page', 'int');
		$down = Safe::filterGet('down', 'int', 0);

		$condition['down'] = $down;
		$data = $this->account->userCreditList($page, $this->pagesize, $condition);

		if ($down == 1) {
			if ($condition['type'] == 'Acc') {
				$excel = array(0 => array('用户名', '手机号',  '总金额', '可用资金', '冻结资金'));
			}else{
				$excel = array(0 => array('用户名', '手机号',  '信誉保证金'));
			}
			foreach ($data['list'] as $key => $value) {
				$item = array();
				$item['username'] = $value['username'];
				$item['mobile'] = $value['mobile'];
				if ($condition['type'] == 'Acc') {
					$item['amount'] = $value['amount'];
					$item['fund'] = $value['fund'];
					$item['freeze'] = $value['freeze'];
				}else{
					$item['credit'] = $value['credit'];
				}
				array_push($excel, $item);
			}
			$obj = new \Library\Excel\ExcelHtml();
			$obj->createExecl($excel, count($excel[0]), "{$condition['name']}信息报表");
			exit();
		}
		$this->getView()->assign('data', $data);
		$this->getView()->assign('isDown', 1);
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
		$obj = new fundBankModel();
		$condition = array('status' => $obj::BANK_APPLY);
		$condition['name'] = '待审核开户';
		$this->listData($condition);
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
		$condition = array('status' =>$obj::BANK_OK .','.$obj::BANK_NG);
		$condition['name'] = '已审核开户';
		$this->listData($condition);
	}

	public function listData($condition = array()){
		$obj = new fundBankModel();
		$page = Safe::filterGet('page', 'int', 1);
		$begin = Safe::filterGet('begin');
		$end = Safe::filterGet('end');
		$down = Safe::filterGet('down', 'int', 0);

		$bankObj = new \nainai\user\userBank();
		$card_type = $bankObj->getCardType();
		$status_text = $bankObj::$status_text;
		$condition['down'] = $down;

		$data = $obj->getBankList($page, $this->pagesize, $condition);

		if ($down == 1) {
			$excel = array(0 => array('用户名', '姓名',  '开户银行', '银行卡类型', '身份证号', '状态'));
			foreach ($data['list'] as $key => $value) {
				$item = array();
				$item['username'] = $value['username'];
				$item['truename'] = $value['true_name'];
				$item['bank_name'] = $value['bank_name'];
				$item['card_type'] = $card_type[$value['card_type']];
				$item['identify_no'] = $value['identify_no']; 
				$item['status_text'] = $status_text[$value['status']]; 
				array_push($excel, $item);
			}
			$obj = new \Library\Excel\ExcelHtml();
			$obj->createExecl($excel, count($excel[0]), "{$begin}至{$end}{$condition['name']}信息报表");
			exit();
		}

		$this->getView()->assign('begin', $begin);
		$this->getView()->assign('end', $end);
		$this->getView()->assign('data', $data);
		$this->getView()->assign('isDown', 1);
		$this->getView()->assign('card_type', $card_type);
		$this->getView()->assign('status_text', $status_text);
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