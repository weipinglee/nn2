<?php
/**
 * @name MemberController
 * @author weipinglee
 * @desc 用户管理控制器
 */
use \Library\safe;
use \nainai\certificate;
use \Library\Thumb;
use \nainai\subRight;
use \Library\url;
use \nainai\member;
use \Library\json;
use \Library\tool;
class VipManageController extends InitController {

    private $vipModel = null;
	public function init(){
		$this->getView()->setLayout('admin');
		$this->vipModel = new \member\VipModel();
		//echo $this->getViewPath();
	}

    public function applyListAction(){
	    $page = safe::filterGet('page','int',1);
        $where = 'v.status=:status or v.status=:status1';//状态1位申请状态，certificate类有定义
        $bind = array('status'=>1,'status1'=>4);
        $data = $this->vipModel->getList($page,$where,$bind);
        $this->getView()->assign('data',$data);
    }

    public function vipListAction(){
        $page = safe::filterGet('page','int',1);
        $where = 'v.status!=:status';
        $bind = array('status'=>1);
        $data = $this->vipModel->getList($page,$where,$bind);
        $this->getView()->assign('data',$data);
    }

    public function detailAction(){
        $id = $this->getRequest()->getParam('id');
        $data = $this->vipModel->getDetail($id);
        $this->getView()->assign('user',$data);
    }

    public function setStatusAction(){
        if(IS_POST){
            $user_id = safe::filterPost('user_id','int');
            $status = safe::filterPost('status','int',1);
            $type = safe::filterPost('type','int',1);
            $res = $this->vipModel->setStatus($user_id,$status,$type);
            if($res){
                die(json::encode(tool::getSuccInfo()));
            }
        }
        die(json::encode(tool::getSuccInfo(0,'设置失败')));
    }


}
