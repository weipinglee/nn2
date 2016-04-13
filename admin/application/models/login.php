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
		$user = $this->admin->where(array('name'=>$name))->fields('password,name,id,role')->getObj();
		if(isset($user['password']) && sha1($pwd) === $user['password']){
			$resInfo = tool::getSuccInfo();
			//获取用户分组
			$rbacModel = new RbacModel();
			$role_name = admintool\admin::is_admin($user['id']) ? '超级管理员' : $rbacModel->adminRole($user['role']);
			Session::set(tool::getConfig('rbac')['user_session'],array('id'=>$user['id'],'name'=>$user['name'],'role'=>$role_name));
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
		admintool\admin::logout();
		return tool::getSuccInfo();
	}
}
 ?>
