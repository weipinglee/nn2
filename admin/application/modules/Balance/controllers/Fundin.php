<?php
/*
入金审核
author  wzd
Date:2016/5/4
 */
use Library\adminrbac\rbac;
use Library\JSON;
use Library\M;
use Library\Query;
use Library\safe;
use nainai\fund;
use \Library\url;
use \Library\tool;

class FundinController extends InitController {


	public function init() {
		$this->getView()->setLayout('admin');
	}
	//线上列表
	public function onlineListAction() {
		$fundObj = new fundInModel();
		$condition = array('type' => fundInModel::DIRECT. ',' . fundInModel::UNION, 'name' => '线上列表', 'controller'=>'line');
		$this->listData($condition);
	}
	//线下列表
	public function offlineListAction() {
		$condition = array('type' => fundInModel::OFFLINE, 'name' => '线下列表', 'controller'=>'off');
		$this->listData($condition);
	}

	public function listData($condition=array()){
		$page = Safe::filterGet('page', 'int', 1);
		$begin = Safe::filterGet('begin');
		$end = Safe::filterGet('end');
		$down = Safe::filterGet('down', 'int', 0);
		$condition['down'] = $down;

		$fundObj = new fundInModel();

		if (empty($begin)) {
			$begin = \Library\Time::getDateTime('Y-m-d');
		}

		if (empty($end)) {
			$end = \Library\Time::getDateTime('Y-m-d');
		}
		$_GET['begin'] =  $begin . ' 00:00:00';
		$_GET['end'] = $end . ' 23:59:59';

		
		$data = $fundObj->getOnlineList($page, $this->pagesize, $condition);
		if ($down == 1) {
			if ($condition['controller'] == 'line') {
				$excel = array(0 => array('用户名', '订单号',  '金额', '充值方式', '状态', '时间'));
			}else{
				$excel = array(0 => array('用户名', '订单号',  '金额', '状态', '时间'));
			}
			
			foreach ($data['list'] as $key => $value) {
				$item = array();
				$item['username'] = $value['username'];
				$item['order_no'] = $value['order_no'];
				$item['amount'] = $value['amount'];
				if ($condition['controller'] == 'line') {
					$item['pay_type'] = $fundObj::getPayType($value['pay_type']);
				}
				$item['status_text'] = $fundObj::getOffLineStatustext($value['status']);
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
	//线下详情页
	public function offlineEditAction() {
		//判断当前用户有没有终审的权限

		$id = safe::filterGet('id', 'int');
		$fundObj = new fundInModel();
		$data = $fundObj->offLineDetail($id);
		$data['proot'] = \Library\Thumb::get($data['proot'],300,200);
		$controllerName = $this->getRequest()->getControllerName();
		$moduleName = $this->getRequest()->getModuleName();
		$data['url'] = \Library\url::createUrl($moduleName.'/'.$controllerName.'/'.$data['action']);


		$this->getView()->assign('reInfo', $data);

	}
	//初审
	public function offlineFirstAction() {

		$id = safe::filterPost('re_id', 'int');
		$status = safe::filterPost('status', 'int');
		$mess  = safe::filterPost('message');
		$fundObj = new fundInModel();

		$res = $fundObj->offLineFirst($id,$status,$mess);//初审操作

		die(json::encode($res));
	}
	//终审
	public function offlineFinalAction() {
		$id = safe::filterPost('re_id', 'int');
		$status = safe::filterPost('status', 'int');
		$mess  = safe::filterPost('message');

		$fundObj = new fundInModel();

		$res = $fundObj->offLineFinal($id,$status,$mess);//终审操作

		die(json::encode($res));

	}

	/**
	 *
	 */
	public function delAction() {
		$id = safe::filterGet('id', 'int');

		$fundObj = new fundInModel();

		if($fundObj->logicDel($id)){

		}



	}
}

?>