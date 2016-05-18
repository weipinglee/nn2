<?php
use \Library\url;
use \Library\Safe;
use \Library\Tool;
use \Library\json;

class GuideController extends InitController{

	/**
	 * 导航栏的类型
	 * @var array
	 */
	private $_bar = array(
		0 => '主导航',
		1 => '顶部导航',
		2 => '底部导航'
	);

	/**
	 * 导航栏列表
	 */
	public function guideListAction(){
		$type = $this->getRequest()->getParam('type');
		$type = Safe::filter($type, 'int', 0);
		$page = Safe::filterGet('page', 'int', 0);

		$guideModel = new \nainai\Guide();
		$guideData = $guideModel->getGuideList($page, $this->pagesize, $type);

		$this->getView()->assign('bar', $this->_bar);
		$this->getView()->assign('type', $type);
		$this->getView()->assign('guideData', $guideData['list']);
		$this->getView()->assign('pageHtml', $guideData['pageHtml']);
	}

	/**
	 * 添加导航栏
	 */
	public function addGuideAction(){
		if (IS_POST) {
			$guideData = array(
				'name' => Safe::filterPost('name'),
				'link' => Safe::filterPost('url'),
				'type' => Safe::filterPost('type', 'int'),
				'sort' => Safe::filterPost('sort', 'int'),
				'pid' => Safe::filterPost('pid', 'int'),
				'status' => 0,
				'create_time' => \Library\Time::getDateTime()
			);
			$guideModel = new \nainai\Guide();
			$returnData = $guideModel->addGuide($guideData);

			if($returnData['success']==1){
		                $this->redirect('guideList');
		          }else{
		                echo $returnData['info'];
		          }
			exit();
		}else{
			$guideModel = new \nainai\Guide();
			$guideModel->getGuideCategoryOption();

			$this->getView()->assign('category', $guideModel->category);
			$this->getView()->assign('bar', $this->_bar);
		}
	}

	/**
	 * 修改导航栏
	 */
	public function updateGuideAction(){
		if (IS_POST) {
			$id = Safe::filterPost('id', 'int', 0);
			$guideData = array(
				'name' => Safe::filterPost('name'),
				'link' => Safe::filterPost('url'),
				'type' => Safe::filterPost('type', 'int'),
				'sort' => Safe::filterPost('sort', 'int'),
				'status' => 0,
				'create_time' => \Library\Time::getDateTime()
			);

			$guideModel = new \nainai\Guide();
			$returnData = $guideModel->updateGuide($guideData, $id);

			if($returnData === true){
		                $this->redirect('guideList');
		          }else{
		                echo '更新失败';
		          }
			exit();
		}

		$id = $this->getRequest()->getParam('id');
		$id = Safe::filter($id, 'int', 0);

		if (intval($id) > 0) {
			$guideModel = new \nainai\Guide();
			$guideData = $guideModel->getGuide($id);
			$guideModel->getGuideCategoryOption($guideData['id'], $guideData['type']);

			$this->getView()->assign('bar', $this->_bar);
			$this->getView()->assign('category', $guideModel->category);
			$this->getView()->assign('guideData', $guideData);
		}
	}

	/**
	 * 删除导航栏
	 */
	public function deleteGuideAction(){
		$id = $this->getRequest()->getParam('id');
		$id = Safe::filter($id, 'int', 0);

		if (intval($id) > 0) {
			$guideModel = new \nainai\Guide();
			$returnData = $guideModel->deleteGuide($id);

			if($returnData === true){
				echo JSON::encode(Tool::getSuccInfo(1, '删除成功!'));
		          }else{
		                	echo JSON::encode(Tool::getSuccInfo(0, '删除失败!'));
		          }
		}else{
			echo JSON::encode(Tool::getSuccInfo(0, '删除失败!'));
		}
		exit();
	}

	/**
	 * ajax获取导航栏的分类
	 * @return [type] [description]
	 */
	public function ajaxGetGuideCategoryAction(){
		$type = Safe::filterPost('type', 'int', 0);
		$guideModel = new \nainai\Guide();
		$guideModel->getGuideCategoryOption(0, $type);

		echo JSON::encode(Tool::getSuccInfo(1, $guideModel->category));
		exit();
	}


}