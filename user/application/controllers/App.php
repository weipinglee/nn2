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

	


	

	/**
	 * 注册操作
	 * @return bool
	 */
	public function doRegAction(){
		$agent = safe::filterPost('agent', 'int', 0);
		if ($agent == 0) {
			die(json::encode(\Library\tool::getSuccinfo(0, '请同意耐耐网注册协议')));
		}
		\Library\session::clear('login');
        $validPhoneCode = safe::filterPost('validPhoneCode','int');
        $phone = safe::filterPost('mobile','/^\d+$/');
         $data = self::checkMobileValidateCode($phone,$validPhoneCode);
        if($data['err'] == 1)
        {
            $res = array('success'=>0,'info'=>$data['info']);
        }
        else
        {
		    $userModel = new UserModel();
		    $userData = array(
			    'username'     =>safe::filterPost('username'),
			    'password'     =>trim($_POST['password']),
			    'repassword'   =>trim($_POST['repassword']),
			    'type'         => safe::filterPost('type','int'),
			    'mobile'       => safe::filterPost('mobile','/^\d+$/'),
			    'email'        =>safe::filterPost('email','email'),
			    'agent' => safe::filterPost('agent','int',0),
			    'serial_no' => safe::filterPost('agent_pass'),
			    'create_time' => \Library\time::getDateTime()
		    );

		    if($userData['type']==1){
			    $companyData = array(
				    'company_name' => safe::filterPost('company_name'),
				    'area'         => safe::filterPost('area','/\d+/'),
				    'legal_person' =>safe::filterPost('legal_person'),
				    'reg_fund'     => safe::filterPost('reg_fund','float'),
				    'category'     => safe::filterPost('category','int'),
				    'nature'       => safe::filterPost('nature','int'),
				    'contact'      => safe::filterPost('contact'),
				    'contact_phone'=> safe::filterPost('contact_phone','/^\d+$/'),
				    'contact_duty' => safe::filterPost('contact_duty','int'),


			    );
			    $res = $userModel->companyReg($userData,$companyData);
		    }else{
			    $res = $userModel->userInsert($userData);
            }
        }
		if(isset($res['success']) && $res['success']==1){//注册成功
			$login = new CheckRight();
			$login->loginAfter($userData);
			$credit = new \nainai\CreditConfig();
			$credit->changeUserCredit($userData['id'],'register');
			//$this->redirect('index');
			$mess = new \nainai\message($res['info']);
			$re = $mess->send('register');
		}

		die(json::encode($res));


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
				$data['info'] = '账号或密码错误';
			}
			else if($password==''){
				$data['errorCode'] = 2;
				$data['info'] = '账号或密码错误';
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
		die(JSON::encode(array('errorCode'=>5,'info'=>'账号或密码错误'))) ;
		return false;
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
