<?php
/**
 * @name IndexController
 * @author root
 * @desc 默认控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
 */
use \Library\Session\Driver\Db;
use \Library\M;
use \Library\checkRight;
use \Library\json;
use \Library\Captcha;
use \Library\url;
use \Library\session;
use \Library\safe;
use \Library\tool;
use \Library\Hsms;
class AppController extends \Yaf\Controller_Abstract {

	//判断是否登陆接口
	public function checkLogAction(){
		$checkRight = new checkRight();
		$res = $checkRight->checkLogin();
		if($res==true){
			die(Json::encode(array('log'=>1)));
		}
		else die(Json::encode(array('log'=>0)));
	}
	

	/**
	 * 登录处理
	 */
	public function doLogAction(){
		if(IS_POST){
			$account = safe::filterPost('account');
			$password = $_POST['password'];
			$data=array('errorCode'=>0,'info'=>'登陆成功');

			if($account == ''){
				$data['errorCode'] = 1;
				$data['info'] = '账号不能为空';
			}
			else if($password==''){
				$data['errorCode'] = 2;
				$data['info'] = '密码不能为空';
			}
            $userModel = new UserModel();
            $userData = $userModel->checkUser($account,$password);
            
            if(empty($userData)){//账户密码错误
                $data['errorCode'] = 5;
				$data['info'] = '账号或密码错误';
            }
            else{
                    $checkRight = new checkRight();
                    $checkRight->loginAfter($userData);
                  
            }
		
			die(JSON::encode($data)) ;
		}
		die(JSON::encode(array('errorCode'=>3,'info'=>'提交错误'))) ;
	
	}


	public function logOutAction(){
		$checkRight = new checkRight();
		if($checkRight->logOut()){
			die(JSON::encode(array('errorCode'=>0,'info'=>'已退出登录'))) ;
		}
		else{
			die(JSON::encode(array('errorCode'=>1,'info'=>'退出失败'))) ;
		}
		
	}



}
