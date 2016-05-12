<?php

use \Library\url;
use \Library\Safe;
use \Library\Tool;
use \Library\json;
use \member\agentModel;
/**
 * 代理商
 */
class AgentController extends InitController{

	/**
	 * 代理商列表
	 */
	public function agentListAction(){
		$page = Safe::filterGet('page', 'int', 0);
		$startDate = Safe::filterGet('startDate');
		$endDate = Safe::filterGet('endDate');
		$username = Safe::filterGet('username');

		$where = ' 1 ';
		$bind = array();

		if (!empty($startDate)) {
			$where .= ' AND create_time>=:startDate';
			$bind['startDate'] = $startDate . ' 00:00:00';
		}

		if (!empty($endDate)) {
			$where .= ' AND create_time<=:endDate';
			$bind['endDate'] = $endDate . ' 23:59:59';
		}

		if (!empty($username)) {
			$where .= ' AND username like "%'.$username.'%"';
		}

		$agentModel = new agentModel();
		$agentData = $agentModel->getAgentList($page, $where, $bind);

		$this->getView()->assign('agentData', $agentData['list']);
		$this->getView()->assign('pageHtml', $agentData['pageHtml']);
	}

	/**
	 * 添加代理商
	 */
	public function addAgentAction(){
		if (IS_POST) {
			$agentData = array(
				'username' => Safe::filterPost('username'),
				'mobile' => Safe::filterPost('mobile'),
				'email' => Safe::filterPost('email'),
				'company_name' => Safe::filterPost('company'),
				'area' => Safe::filterPost('area', 'int'),
				'contact' => Safe::filterPost('contactName'),
				'contact_phone' => Safe::filterPost('contacttel'),
				'address' => Safe::filterPost('contactAddress'),
				'status' => Safe::filterPost('status', 'int'),
				'create_time' => \Library\Time::getDateTime()
			);

			$agentModel = new agentModel();
			$returnData = $agentModel->addAgent($agentData);

			if($returnData['success']==1){
		                $this->redirect('agentList');
		          }else{
		                echo $returnData['info'];
		          }
			exit();
		}
	}

	/**
	 * 修改代理商
	 */
	public function updateAgentAction(){
		if (IS_POST) {
			$id = Safe::filterPost('id', 'int', 0);
			$agentData = array(
				'username' => Safe::filterPost('username'),
				'mobile' => Safe::filterPost('mobile'),
				'email' => Safe::filterPost('email'),
				'company_name' => Safe::filterPost('company'),
				'area' => Safe::filterPost('area'),
				'contact' => Safe::filterPost('contactName'),
				'contact_phone' => Safe::filterPost('contacttel'),
				'address' => Safe::filterPost('contactAddress'),
				'status' => Safe::filterPost('status', 'int')
			);

			$guideModel = new agentModel();
			$returnData = $guideModel->updateAgent($agentData, $id);

			echo JSON::encode($returnData);
			exit();
		}else{	
			$id = $this->getRequest()->getParam('id');
			$id = Safe::filter($id, 'int', 0);

			if (intval($id) > 0) {
				$agentModel = new agentModel();
				$agentData = $agentModel->getAgentDetail($id);
				$this->getView()->assign('agentData', $agentData);
			}
		}

	}

	/**
	 * 删除代理商
	 */
	public function deleteAgentAction(){
		$id = $this->getRequest()->getParam('id');
		$id = Safe::filter($id, 'int', 0);

		if (intval($id) > 0) {
			$agentModel = new agentModel();
			$returnData = $agentModel->deleteAgent($id);

			if($returnData === true){
				echo JSON::encode(Tool::getSuccInfo(1, '删除成功!'));
		          }else{
		                	echo JSON::encode(Tool::getSuccInfo(0, '删除失败!'));
		          }
		}else{
			echo JSON::encode(Tool::getSuccInfo(0, '删除失败!'));
		};
		exit();
	}

	/**
	 * 更换代理商状态
	 */
	public function ajaxUpdateAgentStatusAction(){
		$id = $this->getRequest()->getParam('id');
		$status = $this->getRequest()->getParam('status');
		$id = Safe::filter($id, 'int', 0);
		$status = Safe::filter($status, 'int', 0);

		if (intval($id) > 0) {
			$agentData = array(
				'status' => ($status+1)%2
			);

			$agentModel = new agentModel();
			$returnData = $agentModel->updateAgent($agentData, $id);

			if($returnData === true){
				echo JSON::encode(Tool::getSuccInfo(1, '更新成功!'));
		          }else{
		                	echo JSON::encode(Tool::getSuccInfo(0, '更新失败!'));
		          }
		}else{
			echo JSON::encode(Tool::getSuccInfo(0, '更新失败!'));
		}
		exit();
	}
}