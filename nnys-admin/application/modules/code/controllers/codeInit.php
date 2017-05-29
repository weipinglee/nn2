<?php
/*
会员账户管理
author:wangzhande
Date:2016/5/10
 */
use Library\Query;
use Library\Safe;
use Library\json;


class codeInitController extends InitController {


	public function init() {
		$this->getView()->setLayOut('admin');
	}

	//输入代码相关信息
	public function createCodePageAction(){
		$htmlObj = new \auto\html\adminHtml();
		$listTags = $htmlObj->getListTags();


		//获取操作标签内容
		$operTags = $htmlObj->getOperTags();
		//print_r($operTags);
		$this->getView()->assign('operTags',$operTags);
		$this->getView()->assign('listTags',$listTags);

	}

	public function getTableDataAction(){
		$tableName = safe::filterPost('table_name');
		$autoObj = new \auto\codeCreator('nn');
		$data = $autoObj->getTabelData($tableName);
		die(json::encode($data));
	}

	//返回一个空数据
	public function getRowDataAction(){
		$data = array(
			0=>array(
				'Field'=>'',
				'Type' => '',

			)
		);
		die(json::encode($data));
	}


}

?>