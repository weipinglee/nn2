<?php 

use \Library\M;
use \Library\Query;
use \Library\tool;
use \Library\session;
class loginModel{
	/**
	 * 登录处理方法
	 * @return [type] [description]
	 */
	private $admin = '';
	public function __construct(){
		$this->admin = new M('admin'); 
	}
	public function login($name,$pwd){
		$user = $this->admin->where(array('name'=>$name))->fields('password,name,id,role,session_id')->getObj();
		if(isset($user['password']) && sha1($pwd) === $user['password']){
			try {
				$this->admin->beginTrans();
				if($user['session_id'] != session_id()){
					//若session_id不同 则删除原session
					$admin_session = new M('admin_session');
					$admin_session->where(array('session_id'=>$user['session_id']))->delete();
				}
				$data = array('last_ip'=>$_SERVER['REMOTE_ADDR'],'session_id' => session_id());
				$this->admin->where(array('id'=>$user['id']))->data($data)->update();
				
				$resInfo = tool::getSuccInfo();
				//获取用户分组
				$rbacModel = new RbacModel();
				$role_name = admintool\admin::is_admin($user['id']) ? '超级管理员' : $rbacModel->adminRole($user['role']);
				Session::set(tool::getConfig('rbac')['user_session'],array('id'=>$user['id'],'name'=>$user['name'],'role'=>$role_name));
				$this->admin->commit();
			} catch (PDOException $e) {
				$this->admin->rollBack();
				$resInfo = tool::getSuccInfo(0,$e->getMessage());
			}
			
		}else{	
			$resInfo = tool::getSuccInfo(0,'用户名或密码错误');
		}
		return $resInfo;
	}

	/**
	 * 登出
	 * @return [type] [description]
	 */
	public function logout(){
		Session::set(tool::getConfig('rbac')['user_session'],array());
		return tool::getSuccInfo();
	}
}
 ?>
