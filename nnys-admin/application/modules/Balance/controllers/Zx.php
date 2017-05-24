<?php
/**
 *中信账户管理
 *author:weipinglee
 *date:2017/5/24
 */
use Library\Query;
use Library\Safe;
use Library\json;


class ZxController extends InitController {

	protected $account = '';
	//会用账户列表
	public function init() {
		$this->getView()->setLayOut('admin');

	}

	public function txListAction(){
		$type = $this->getRequest()->getParam('type');
		$obj = new \nainai\payment\withdraw();
		$list = $obj->getList($type);

		$this->getView()->assign('data', $list);

	}

	public function txDetailAction(){
		$id = safe::filterGet('id','int');
		$obj = new \nainai\payment\withdraw();
		$detail = $obj->getDetails($id);
		if(!empty($detail)){
			$userObj = new \nainai\member();
			$userData = $userObj->getUserDetail($detail['user_id']);
			$this->getView()->assign('user',$userData);
		}
		$this->getView()->assign('detail',$detail);
	}

	public function txHandleAction(){
		if(IS_POST){
			$id = safe::filterPost('id','int');
			if($id){
				$status = safe::filterPost('status','int');
				$zxObj = new \nainai\fund\zx();
				$obj = new \nainai\payment\withdraw($zxObj);
				if($status==1){
					//$res = $obj->payAfter(array('id'=>$id));
				}
				else{
					//$res = $obj->handleReject(array('id'=>$id));

				}

				//die(json::encode($res));
			}
		}

		die(json::encode(\Library\tool::getSuccInfo(0,'操作失败')));
	}


}

?>