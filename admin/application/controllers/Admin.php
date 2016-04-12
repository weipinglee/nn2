<?php
/**
 * @name AdminController
 * @author panduo
 * @desc 后台管理员控制器
 */
use \Library\safe;
use \Library\url;
use \Library\json;
class AdminController extends Yaf\Controller_Abstract {

	private $adminModel;
	public function init(){
		$this->getView()->setLayout('admin');
		$this->adminModel = new AdminModel();
		//echo $this->getViewPath();
	}

	/**
	 * [adminListAction 获取后台管理员列表]
	 * @return void 
	 */
	public function adminListAction(){
		$page = safe::filterGet('page','int');
		$name = safe::filterGet('name');
		$pageData = $this->adminModel->getList($page,$name);
		$this->getView()->assign('data',$pageData['data']);
		$this->getView()->assign('bar',$pageData['bar']);
		$this->getView()->assign('name',$name);
	}

    /**
     * 后台管理员添加页面
     * @return 
     */
	public function adminAddAction(){
		//权限验证 TODO
		if(IS_AJAX){
			$adminData['name'] 	    = safe::filterPost('admin-name');
			$adminData['password']  = safe::filterPost('admin-pwd');
			$adminData['email']     = safe::filterPost('admin-email');
			$adminData['role']      = safe::filterPost('admin-role');
			$adminData['last_ip']   = $_SERVER['REMOTE_ADDR'];
			$adminData['last_time'] = $adminData['create_time'] = date('Y-m-d H:i:s');
			$adminData['status']    = 0;
            $res = $this->adminModel->adminUpdate($adminData);

            echo JSON::encode($res);
            return false;
		}

		//$this->getView()->display('/adminUpdate.tpl');
	}

	/**
	 * 修改页面及逻辑
	 * @return [type] [description]
	 */
	public function adminUpdateAction(){
		if(IS_AJAX){
			$adminData['name']  = safe::filterPost('admin-name');
			$adminData['id']    = safe::filterPost('admin-id');
			$adminData['email'] = safe::filterPost('admin-email');
			$res = $this->adminModel->adminUpdate($adminData);

            echo JSON::encode($res);
            return false;
		}else{
			//输出页面
			$id = intval($this->_request->getParam('id'));
			$admin_info = $this->adminModel->getAdminInfo($id);
			$this->getView()->assign('info',$admin_info);
		}
	}

	/**
	 * 修改管理员密码
	 * @param int password
	 * @return [type] [description]
	 */
	public function adminPwdAction(){
		//密码加盐TODO
		if(IS_AJAX){
			$adminData['id'] = safe::filterPost("admin-id");
			$adminData['password'] = sha1(safe::filterPost("admin-pwd"));
			$res = $this->adminModel->adminUpdate($adminData);

	        echo JSON::encode($res);
	        return false;
	    }else{
	    	$id = intval($this->_request->getParam('id'));
			$admin_info = $this->adminModel->getAdminInfo($id);
			$this->getView()->assign('info',$admin_info);
	    }
	}

	/**
	 * 设置数据状态
	 */
	public function setStatusAction(){
		if(IS_AJAX){
			$adminData['status'] = intval(safe::filterPost('status'));
			$adminData['id'] = intval($this->_request->getParam('id'));
			$res = $this->adminModel->adminUpdate($adminData);

            echo JSON::encode($res);
            return false;
		}
		return false;
	}
}