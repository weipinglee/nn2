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
use \Library\swfupload;
use \Library\safe;
class IndexController extends \Yaf\Controller_Abstract {

	public function init(){
		//echo $this->getViewPath();
	}
	/** 
     * 默认动作
     * Yaf支持直接把Yaf_Request_Abstract::getParam()得到的同名参数作为Action的形参
     * 对于如下的例子, 当访问http://yourhost/yar-demo/index/index/index/name/root 的时候, 你就会发现不同
     */
	public function indexAction() {
		print_r($_SESSION);
		//echo $a;

	}

	public function captchaAction(){
		$ca = new \Library\captcha();
		$ca->CreateImage();
	}


	/**
	 *注册页面
     */
	public function registerAction(){
		$member = new \nainai\member();
		$comtype = $member->getComType();
		$comNature = $member->getComNature();
		$duty = $member->getComDuty();
		$agent = $member->getAgentList();
		$this->getView()->assign('comtype',$comtype);
		$this->getView()->assign('comNature',$comNature);
		$this->getView()->assign('duty',$duty);
		$this->getView()->assign('agent',$agent);
	}

	/**
	 * 注册操作
	 * @return bool
	 */
	public function doRegAction(){
		\Library\session::clear('login');
		$userModel = new UserModel();
		$userData = array(
			'username'     =>safe::filterPost('username'),
			'password'     =>trim($_POST['password']),
			'repassword'   =>trim($_POST['repassword']),
			'type'         => safe::filterPost('type','int'),
			'mobile'       => safe::filterPost('mobile','/^\d+$/'),
			'email'        =>safe::filterPost('email','email'),
			'agent' => safe::filterPost('agent','int',0),
			'serial_no' => safe::filterPost('agent_pass')
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
		if(isset($res['success']) && $res['success']==1){//注册成功
			$login = new CheckRight();
			$login->loginAfter($userData);
			//$this->redirect('index');
		}

		die(json::encode($res));


	}

	public function checkIsOneAction(){
		if(IS_AJAX){
			$user = new UserModel();
			$field = safe::filterPost('field','/^[a-zA-Z]+$/');
			$value = safe::filterPost('value','[a-zA-Z0-9_]+');
			switch($field){
				case 'mobile' :
					$field = 'mobile';
					break;
				case 'username' :
				default : $field = 'username';
					break;
			}
			//
			$arr = array($field=>$value);
			if($user->existUser($arr))echo 1;
			else echo 0;
		}

		return false;

	}

	/**
	 * 生成验证码
	 */
	public function getCaptchaAction(){
		$ca = new captcha();
		$ca->CreateImage();
	}
	/**
	 * 登录
	 */
	public function loginAction(){
		$callback = isset($_GET['callback'])?safe::filterGet('callback') : '';
		$this->getView()->assign('callback',$callback);
	}

	/**
	 * 登录处理
	 */
	public function doLogAction(){
		if(IS_AJAX){
			$account = safe::filterPost('account');
			$password = $_POST['password'];
			$captcha  = safe::filterPost('captcha','/^[a-zA-Z]{4}$/');


			$data=array('errorCode'=>0);
			$captchaObj = new captcha();
			if($account == ''){
				$data['errorCode'] = 1;
			}
			else if($password==''){
				$data['errorCode'] = 2;
			}
			else if($captcha==''){
				$data['errorCode'] = 3;
			}
			else if(!$captchaObj->check($captcha)){//验证码是否正确
				$data['errorCode'] = 4;
			}
			else{
				$userModel = new UserModel();
				$userData = $userModel->checkUser($account,$password);
				if(empty($userData)){//账户密码错误
					$data['errorCode'] = 5;
				}
				else{//登录成功
					$checkRight = new checkRight();
					$checkRight->loginAfter($userData);

				}
			}
			$data['returnUrl'] =  isset($_POST['callback']) && $_POST['callback']!=''?trim($_POST['callback']) : url::createUrl('/ucenter/baseinfo');

			echo JSON::encode($data);
		}

		return false;
	}

	public function logOutAction(){
		$checkRight = new checkRight();
		$checkRight->logOut();
		$this->redirect('login');
		return false;
	}




}
