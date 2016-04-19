<?php 

/**
 * 信誉制配置项控制器
 */
use \Library\safe;
use \Library\tool;
use \Library\JSON;
use \Library\url;
class ConfcreditController extends Yaf\Controller_Abstract{

	private $confcredit;
	public function init(){
		$this->confcredit = new confcreditModel();
		$this->getView()->setLayout('admin');
		//echo $this->getViewPath();
	}

	/**
	 * 获取列表
	 * @return 
	 */
	public function creditListAction(){
		$page = safe::filterGet('page','int');
		$pageData = $this->confcredit->getList($page);
		$this->getView()->assign('data',$pageData['data']);
		$this->getView()->assign('bar',$pageData['bar']);
	}
	
	/**
	 * 新增或修改
	 */

	public function creditOperAction(){
		if(IS_AJAX){
			$oper_type = safe::filterPost("oper_type","int");
			$confcreditData['name'] 	= safe::filterPost('name');
			$confcreditData['name_zh']  = safe::filterPost('name_zh');
			$confcreditData['type']     = safe::filterPost('type','int');
			$confcreditData['sign']     = safe::filterPost('sign','int');
			$confcreditData['value']    = safe::filterPost('value','float');
			$confcreditData['sort']     = safe::filterPost('sort','int');
			$confcreditData['note']     = safe::filterPost('note');
			if($oper_type == 1){
				//新增
				$confcreditData['time']    = date("Y-m-d H:i:s",time());
			}else{
				//更新
				$confcreditData['ori_name'] = safe::filterPost('ori_name');
			}
			$res = $this->confcredit->confcreditUpdate($confcreditData);
			echo JSON::encode($res);
			return false;
		}else{
			$oper_type = $this->_request->getParam('oper_type');
			if($oper_type == 2){
				$oper = "编辑";
				$name = $this->_request->getParam('name');
				$confcreditInfo = $this->confcredit->getconfcreditInfo($name);
				$this->getView()->assign('info',$confcreditInfo);
			}else{
				$oper = "新增";
			}
			$this->getView()->assign('oper',$oper);
			$this->getView()->assign('oper_type',$oper_type);
		}
	}

	/**
	 * 删除
	 */
	public function creditDelAction(){
		$name = $this->_request->getParam('name');
		$res = $this->confcredit->creditDel($name);
		die(JSON::encode($res));
	}

}
 ?>