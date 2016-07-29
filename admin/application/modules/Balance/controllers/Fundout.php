<?php
/*
出金审核操作类
author: wangzhande
Date:2016-5-6
 */
use Library\JSON;
use Library\safe;
use Library\tool;

class FundoutController extends InitController {
	public function init() {
		$this->getView()->setLayout('admin');
	}

	/**
	 * 出金待审核
	 */
	public function checkfundoutlistAction(){
		$condition = array('name' => '出金待审核', 'status' => fundOutModel::FUNDOUT_APPLY.','.fundOutModel::FUNDOUT_FIRST_OK);
		$this->listData($condition);
	}

	/**
	 * 出金待拨款
	 */
	public function pendingpaymentlistAction(){
		$condition = array('name' => '出金待拨款', 'status' => fundOutModel::FUNDOUT_FINAL_OK);
		$this->listData($condition);
	}

	/**
	 * 出金已审核
	 */
	public function checkedfundoutlistAction(){
		$condition = array('name' => '出金已审核', 'status' => fundOutModel::FUNDOUT_OK.','.fundOutModel::FUNDOUT_FIRST_NG.','.fundOutModel::FUNDOUT_FINAL_NG);
		$this->listData($condition);
	}
	//出金列表
	public function listData($condition) {
		$page = Safe::filterGet('page', 'int', 1);
		$begin = Safe::filterGet('begin');
		$end = Safe::filterGet('end');
		$down = Safe::filterGet('down', 'int', 0);
		$condition['down'] = $down;

		if (empty($begin)) {
			$begin = \Library\Time::getDateTime('Y-m-d');
		}

		if (empty($end)) {
			$end = \Library\Time::getDateTime('Y-m-d');
		}
		$_GET['begin'] =  $begin . ' 00:00:00';
		$_GET['end'] = $end . ' 23:59:59';

		
		$fundOutModel = new fundOutModel();
		$data = $fundOutModel->getFundOutList($page, $this->pagesize, $condition);

		if ($down == 1) {
			$excel = array(0 => array('用户名', '手机号', '订单号',  '金额', '状态', '时间'));
			foreach ($data['list'] as $key => $value) {
				$item = array();
				$item['username'] = $value['username'];
				$item['mobile'] = $value['mobile'];
				$item['order_no'] = $value['request_no'];
				$item['amount'] = $value['amount'];
				$item['status_text'] = $fundOutModel::getFundOutStatustext($value['status']);
				$item['create_time'] = $value['create_time'];
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
	}
	//出金详情页
	public function fundOutEditAction() {
		$id = safe::filterGet('id', 'int');

		$fundOutModel = new fundOutModel();
		$data = $fundOutModel->fundOutDetail($id);
		$controllerName = $this->getRequest()->getControllerName();
		$moduleName = $this->getRequest()->getModuleName();
		$data['url'] = \Library\url::createUrl($moduleName . '/' . $controllerName . '/' . $data['action']);

		$data['proot'] = \Library\Thumb::get($data['proot'],180,180);
		$data['bank_proof'] = \Library\Thumb::get($data['bank_proof'],180,180);
		$this->getView()->assign('outInfo', $data);
	}
	//出金初审
	public function firstCheckAction() {
		if(IS_AJAX && IS_POST){
			$id = safe::filterPost('out_id', 'int');
			$status = safe::filterPost('status', 'int');
			$message = safe::filterPost('message');
			$fundOutModel = new fundOutModel();
			$res = $fundOutModel->fundOutFirst($id, $status, $message);
			die(JSON::encode(tool::getSuccInfo($res['code'], $res['info'])));
		}

	}
	//出金终审
	public function finalCheckAction() {
		if(IS_AJAX && IS_POST){
			$id = safe::filterPost('out_id', 'int');
			$status = safe::filterPost('status', 'int');
			$message = safe::filterPost('message');
			$fundOutModel = new fundOutModel();
			$res = $fundOutModel->fundOutFinal($id, $status, $message);
			die(JSON::encode(tool::getSuccInfo($res['code'], $res['info'])));
		}

	}
	//上传凭证
	public function transferAction() {
		if(IS_AJAX && IS_POST){
			$id = safe::filterPost('out_id', 'int',0);
			$proof = safe::filterPost('imgfile2');


			if(!$id || $proof==''){
				die(JSON::encode(tool::getSuccInfo(0,'请上传打款凭证'))) ;
			}

			$proof = tool::setImgApp($proof);
			$fundOutModel = new fundOutModel();
			$res = $fundOutModel->fundOutTransfer($id,$proof);
			die(JSON::encode(tool::getSuccInfo($res['code'], $res['info'])));
		}
	}

	public function delAction() {
		if(IS_AJAX && IS_POST) {
			$id = safe::filterGet('id', 'int');
			$fundOutModel = new fundOutModel();
			$res = $fundOutModel->logicDel($id);
			echo JSON::encode($res);
			return false;
		}
	}


}
?>