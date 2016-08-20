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
use \Library\tool;
use \Library\Hsms;
class LoginController extends \Yaf\Controller_Abstract {

	public function init(){
		//echo $this->getViewPath();
	}
	/** 
     * 默认动作
     * Yaf支持直接把Yaf_Request_Abstract::getParam()得到的同名参数作为Action的形参
     * 对于如下的例子, 当访问http://yourhost/yar-demo/index/index/index/name/root 的时候, 你就会发现不同
     */
	public function indexAction() {
		echo $this->getViewPath();
	}

	public function captchaAction(){
		$ca = new \Library\captcha();
		$ca->CreateImage();
	}

	/**
	 * 注册协议
	 */
	public function agreementAction(){

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
        $validPhoneCode = safe::filterPost('validPhoneCode','int');
        $phone = safe::filterPost('mobile','/^\d+$/');
        $data = array('err'=>0);
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
		}

		die(json::encode($res));


	}
    
    /**
     *
     * 验证手机验证码
     * @param $phone
     * @param $num
     * @return int
     */
    function checkMobileValidateCode($phone,$num){
        if($mobileValidateSess = session::get('mobileValidateReg')){
            if(time() - $mobileValidateSess['time']>=1800){//session过期
                return array('err' => 1, 'info' => '验证码过期');
            }else if($mobileValidateSess['num']!=$num || $mobileValidateSess['phone']!=$phone){
                return array('err' => 1, 'info' => '验证码错误');//错误
            }else return array('err' => 0, 'info' => '正确');//正确
        }
        else
        {
            return array('err' => 1, 'info' => '验证失败');
        }
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

        $w = safe::filterGet('w','int', 150);
        $h = safe::filterGet('h','int', 50);
		$ca = new \Library\captcha(array('width' => $w, 'height' => $h));
		$ca->CreateImage();
	}
    

    
    //发送短信
    public function sendMessageAction()
    {
        $phone = safe::filterPost('phone');
        $captcha = safe::filterPost('captcha');
        $captchaObj = new captcha();
        if(!$captchaObj->check($captcha))
        {
            die(JSON::encode(tool::getSuccInfo(0, '验证码错误')));
        }
        $text = rand(100000, 999999);
        session::set('mobileValidateReg', array('phone' => $phone, 'num' => $text, 'time' => time()));
        $hsms = new Hsms();
        if (!$hsms->send($phone, $text))
        {
            die(JSON::encode(tool::getSuccInfo(0, '发送失败')));
        }
        die(JSON::encode(tool::getSuccInfo()));        
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
			$captcha  = safe::filterPost('captcha');

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
            $userModel = new UserModel();
            $userData = $userModel->checkUser($account,$password);
            if(empty($userData)){//账户密码错误
                $data['errorCode'] = 5;
            }
            else{
                if(!$captchaObj->check($captcha)){//验证码是否正确
                    $data['errorCode'] = 4;
                }
                else{//登录成功
                    $checkRight = new checkRight();
                    $checkRight->loginAfter($userData);
                }
            }
			

			$data['returnUrl'] =  isset($_POST['callback']) && $_POST['callback']!=''?trim($_POST['callback']) : url::createUrl('/index/index@deal');
			// var_dump($data);exit;
			echo JSON::encode($data);
		}

		return false;
	}

	public function logOutAction(){
		$checkRight = new checkRight();
		$checkRight->logOut();
		$this->redirect(url::createUrl('/index/index@deal'));
		return false;
	}

	//==========================================================================

	//找回密码

	//=========================================================================

	/**
	 *找回密码界面
	 */
	public function PasswordResetAction(){

	}
	/*
	 * 修改密码
	 * */
	public function findPasswordAction(){
		$mobile= safe::filterPost('mobile','/^\d+$/');
		$password = safe::filterPost('password');

		if (empty($mobile) || empty($password)) {
			exit(json::encode(tool::getSuccInfo(0, 'Error Request')));
		}
		$userModel=new UserModel();
		$uid = $userModel->getMobileUserInfo($mobile);
		if(empty($uid)){
			die(JSON::encode(\Library\tool::getSuccInfo(0,'手机号不存在')));
		}
		$info = $userModel->getPasswordInfo($uid);
		if (empty($info) OR !empty($info['code'])) {
			die(JSON::encode(\Library\tool::getSuccInfo(0,'Error Request')));
		}
		$data=array(
			'id'=>$uid,
			'password'=>$password
		);
		$userModel->updateUserInfo($data);
		$userLog=new \Library\userLog();
		$userLog->addLog(['action'=>'找回密码操作','进行了找回密码操作']);
		die(JSON::encode(\Library\tool::getSuccInfo(1,'修改成功', url::createUrl('/Login/resetend'))));
	}

	/**
	 *找回密码时获取手机验证码
	 */
	public function getMobileCodeAction(){
		if (IS_POST || IS_AJAX) {
			$mobile = safe::filterPost('mobile');
			$code = safe::filterPost('code');
			$captchaObj = new captcha();
			if (!$captchaObj->check($code)) {
				die(JSON::encode(\Library\tool::getSuccInfo(0, '验证码错误')));
			}
			$userObj = new UserModel();
			$res = $userObj->getForgetMobileCode($mobile);
			//var_dump($_SESSION);
			die(JSON::encode($res));
		}
	}

	public function checkMobileCodeAction(){
		$code = safe::filterPost('code');
		$uid = safe::filterPost('uid');
		$mobile = safe::filterPost('mobile');

		if (empty($uid) || empty($code)) {
			exit(json::encode(tool::getSuccInfo(0, 'Error Request')));
		}

		$model = new UserModel();
		$info = $model->getPasswordInfo($uid);
		if (time() - strtotime($info['create_time']) > 15*60) {
			exit(json::encode(tool::getSuccInfo(0, '过期的验证')));
		}
		

		if ($info['code'] == $code) {
			$model->clearPassword($uid);
			exit(json::encode(tool::getSuccInfo(1, 'success', url::createUrl('/Login/resetTo?mobile='.$mobile))));
		}else{
			exit(json::encode(tool::getSuccInfo(0, '验证码错误')));
		}
	}

	public function resetToAction(){
		$mobile = $this->getRequest()->getParam('mobile');
		$mobile = safe::filter($mobile, 'int');

		if (intval($mobile) <= 0) {
			exit('Error Request');
		}

		$this->getView()->assign('mobile', $mobile);
	}


	public function resetendAction(){

	}


}
