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

	}

	public function getTableDataAction(){
		$tableName = safe::filterPost('table_name');
		$autoObj = new \auto\codeCreator('nn_dev');
		$data = $autoObj->getTabelData($tableName);
		die(json::encode($data));
	}


}

?>