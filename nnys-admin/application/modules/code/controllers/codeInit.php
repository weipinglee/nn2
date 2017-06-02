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

	public function doCreateCodeAction(){
		if(IS_POST){
			$field_names = safe::filterPost('field_name');
			if(count($field_names) != count(array_unique($field_names))){
				die(json::encode(\Library\tool::getSuccInfo(0,'字段名有重复值，请取别名')));
			}
			$list  = array();
			foreach($field_names as $key=>$val){
				$list[$key]['no'] = safe::filterPost('sortNo_'.$val);
				$list[$key]['tableName'] = safe::filterPost('tableName_'.$val);
				if(strpos($val,' as ')){//存在别名转换，获取真正的字段名和别名
					$list[$key]['fieldName'] = trim(explode(' as ',$val)[0]);
					$list[$key]['aliasName'] = trim(explode(' as ',$val)[1]);
					if(in_array($list[$key]['aliasName'],$field_names)){
						die(json::encode(\Library\tool::getSuccInfo(0,'字段命名别名后仍有重复值，请再取其他别名')));
					}
				}
				else{
					$list[$key]['fieldName'] = $val;
					$list[$key]['aliasName'] = '';
				}

				$list[$key]['dataType'] = safe::filterPost('dataType_'.$val);
				$list[$key]['zhname'] = safe::filterPost('zhname_'.$val);
				$list[$key]['show'] = safe::filterPost('show_'.$val);
				$list[$key]['showType']['name'] = safe::filterPost('showType_'.$val);
				$argNums = safe::filterPost('argNum_'.$val);
				for($i=0;$i<$argNums;$i++){
					$j = $i+1;
					$list[$key]['showType']['args']['$'.$j] = safe::filterPost('$'.$j.'_'.$val);
				}
			}

			print_r($list);
			$data = array();
			$data['main'] = $list;//主要的数据
			//$data[]
			//把data序列化写入数据库
			//TODO

			//把data传入函数生成文件


		}
	}


}

?>