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
		$this->account = new \nainai\fund\zx();

	}

	private function checkSign(){
		if(true===$this->account->signStatus()){
			return true;
		}
		return false;
	}

	public function txingListAction(){
		$type = 'ing';
		$obj = new \nainai\payment\withdraw();
		$list = $obj->getList($type);

		$this->getView()->assign('data', $list);

	}
	
	public function txedListAction(){
		$type = 'ed';
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
			$bankObj = new \nainai\user\UserBank();
			$bankData = $bankObj->getActiveBankInfo($detail['user_id']);
			$userData = $userObj->getUserDetail($detail['user_id']);
			$this->getView()->assign('user',$userData);
			$this->getView()->assign('bank',$bankData);
		}
		$this->getView()->assign('detail',$detail);
	}

	public function txFirstHandleAction(){
		if(!$this->checkSign()){
			die(json::encode(\Library\tool::getSuccInfo(0,'银行未签到')));
		}
		if(IS_POST){
			$id = safe::filterPost('id','int');
			if($id){
				$status = safe::filterPost('status','int');
				$message = safe::filterPost('message');
				$zxObj = new \nainai\fund\zx();
				$obj = new \nainai\payment\withdraw($zxObj);
				if($status==1){
					$res = $obj->firstHandle($id,array('status'=>\nainai\payment\withdraw::FIRST_SUCCESS,'first_message'=>$message));
				}
				else{
					$res = $obj->firstHandle($id,array('status'=>\nainai\payment\withdraw::FIRST_FAIL,'first_message'=>$message));

				}

				if($res['success']==1){
					$log = new \Library\log();
					$status_txt = $status ==1? '通过' : '被驳回';
					$log->addLog(array('content'=>'id为'.$id.'的中信提现申请终审'.$status_txt,'action'=>'中信出金初审'));
				}


				die(json::encode($res));
			}
		}

		die(json::encode(\Library\tool::getSuccInfo(0,'操作失败')));
	}

	//提现终审
	public function txFinalHandleAction(){
		if(!$this->checkSign()){
			die(json::encode(\Library\tool::getSuccInfo(0,'银行未签到')));
		}
		if(IS_POST){
			$id = safe::filterPost('id','int');
			if($id){
				$status = safe::filterPost('status','int');
				$message = safe::filterPost('message');
				$zxObj = new \nainai\fund\zx();
				$obj = new \nainai\payment\withdraw($zxObj);
				if($status==1){
					$res = $obj->payAfter(array('id'=>$id,'final_message'=>$message));
				}
				else{
					$res = $obj->finalHandleFail($id,array('final_message'=>$message));

				}
				if($res['success']==1){
					$log = new \Library\log();
					$status_txt = $status ==1? '通过' : '被驳回';
					$log->addLog(array('content'=>'id为'.$id.'的中信提现申请终审'.$status_txt,'action'=>'中信出金终审'));
				}

				die(json::encode($res));
			}
		}

		die(json::encode(\Library\tool::getSuccInfo(0,'操作失败')));
	}


}

?>