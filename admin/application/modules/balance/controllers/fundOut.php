<?php
/*
出金审核操作类
author: wangzhande
Date:2016-5-6
 */
use Library\JSON;
use Library\safe;
use Library\tool;

class fundOutController extends Yaf\Controller_Abstract {
	public function init() {
		$this->getView()->setLayout('admin');
	}
	//出金列表
	public function fundOutListAction() {
		$page = safe::filterGet('page', 'int');
		$fundOutModel = new fundOutModel();
		$data = $fundOutModel->getFundOutList($page);

		//分配数据
		$this->getView()->assign('outInfo', $data[0]);
		$this->getView()->assign('outBar', $data[1]);

	}
	//出金详情页
	public function fundOutEditAction() {
		$id = safe::filterGet('id', 'int');

		$fundOutModel = new fundOutModel();
		$data = $fundOutModel->fundOutDetail($id);
		$controllerName = $this->getRequest()->getControllerName();
		$moduleName = $this->getRequest()->getModuleName();
		$data['url'] = \Library\url::createUrl($moduleName . '/' . $controllerName . '/' . $data['action']);

		$this->getView()->assign('outInfo', $data);
	}
	//出金初审
	public function firstCheckAction() {
		$id = safe::filterPost('out_id', 'int');
		$status = safe::filterPost('status', 'int');
		$message = safe::filterPost('message');
		$fundOutModel = new fundOutModel();
		$res = $fundOutModel->fundOutFirst($id, $status, $message);
		die(JSON::encode(tool::getSuccInfo($res['code'], $res['info'])));
	}
	//出金终审
	public function finalCheckAction() {
		$id = safe::filterPost('out_id', 'int');
		$status = safe::filterPost('status', 'int');
		$message = safe::filterPost('message');
		$fundOutModel = new fundOutModel();
		$res = $fundOutModel->fundOutFinal($id, $status, $message);
		die(JSON::encode(tool::getSuccInfo($res['code'], $res['info'])));
	}
	//上传凭证
	public function transferAction() {
		$id = safe::filterPost('out_id', 'int');
		if (!empty($_FILES['proot']['name'])) {

			$fundOutModel = new fundOutModel();
			$res = $fundOutModel->fundOutTransfer($id);
			/*var_dump($res);
			 */

			echo JSON::encode($res);

			return false;
			//die(JSON::encode(tool::getSuccInfo($res['code']), $res['info']));
		} else {
			//die(JSON::encode(tool::getSuccInfo(0, '请上传凭证')));
			echo JSON::encode($res);
			return false;
		}
	}
	public function delAction() {
		$id = safe::filterGet('id', 'int');
		$fundOutModel = new fundOutModel();
		$res = $fundOutModel->logicDel($id);
		echo JSON::encode($res);
		return false;
	}
}
?>