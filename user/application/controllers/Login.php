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
        $this->getView()->setLayout('layout');
       			 $model = new \nainai\system\DealSetting();
			$deal = $model->getsetting();
			$this->getView()->assign('deal', $deal);
		//echo $this->getViewPath();
	}
	
	/** 
     * 默认动作
     * Yaf支持直接把Yaf_Request_Abstract::getParam()得到的同名参数作为Action的形参
     * 对于如下的例子, 当访问http://yourhost/yar-demo/index/index/index/name/root 的时候, 你就会发现不同
     */
	public function indexAction() {
		$this->redirect(\Library\url::createUrl('/Login/login@user'));
	}

	public function captchaAction(){
		$ca = new \Library\captcha();
		$ca->CreateImage();
	}

	/**
	 * 注册协议
	 */
	public function agreementAction(){
		$this->getView()->setLayout('');
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
			    'pid'          => 0,
			    'type'         => -1,//初始用户类型设置为-1
			    'mobile'       => safe::filterPost('mobile','/^\d+$/'),
			    'create_time' => \Library\time::getDateTime()
		    );

            $res = $userModel->userInsert($userData);

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
		//$res['returnUrl'] = url::createUrl('/ucenter/dealcert@user');
		die(json::encode($res));


	}

    /**
     * 会员申请
     */
	public function newMemberAction(){
        $login = session::get('login');
        $userModel = new UserModel();
	    if(IS_POST){
            $user_id = 0;
            if($login){//已登录
                $user_id = $login['user_id'];
                $res = tool::getSuccInfo();
            }else{
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
                    die(json::encode($res));
                }
                else
                {
                    $userData = array(
                        'username'     =>safe::filterPost('username'),
                        'password'     =>trim($_POST['password']),
                        'repassword'   =>trim($_POST['repassword']),
                        'pid'          => 0,
                        'type'         => -1,//初始用户类型设置为-1
                        'mobile'       => safe::filterPost('mobile','/^\d+$/'),
                        'create_time' => \Library\time::getDateTime()
                    );
                    $res = $userModel->userInsert($userData);
                }
                if(isset($res['success']) && $res['success']==1){//注册成功
                    $login = new CheckRight();
                    $login->loginAfter($userData);
                    $user_id = $userData['id'];
                    $credit = new \nainai\CreditConfig();
                    $credit->changeUserCredit($userData['id'],'register');
                    //$this->redirect('index');
                    $mess = new \nainai\message($res['info']);
                    $re = $mess->send('register');
                }
                //$res['returnUrl'] = url::createUrl('/ucenter/dealcert@user');

            }
            if($user_id>0){
                //会员数据
                $memeberData = array(
                    'user_id'=>$user_id,
                    'name'=> safe::filterPost('company_name'),
                    'area' => safe::filterPost('area'),
                    'address' => safe::filterPost('address'),
                    'contact_person' => safe::filterPost('contact'),
                    'contact_phone'  => safe::filterPost('contact_phone'),
                    'apply_time' => \Library\time::getDateTime()
                );
                $vipType = safe::filterPost('vip_type','int',1);
                if($vipType==1){
                    $certObj = new \nainai\cert\certVipTemp();
                }else{
                    $certObj = new \nainai\cert\certVip();
                }

                $certObj->certApply($memeberData);
            }
            die(json::encode($res));
        }else{
            $loginStatus = $login ? 1 : 0;
	        if($login){//如果已登录，且是企业用户，带出企业信息
                $companyData = array();
                $user_id = $login['user_id'];
                if($login['user_type']==1){
                    $userData = $userModel->getCompanyInfo($user_id);
                    $companyData = array(
                        'company_name' => $userData['company_name'],
                        'area' => $userData['area'],
                        'address' => $userData['address'],
                        'contact' => $userData['contact'],
                        'contact_phone' => $userData['contact_phone']
                    );

                }

                $res = $userModel->vipInfo($user_id);
                if(!empty($res)){
                    $companyData = array(
                        'company_name' => $res['name'],
                        'area' => $res['area'],
                        'address' => $res['address'],
                        'contact' => $res['contact_person'],
                        'contact_phone' => $res['contact_phone']
                    );
                }
                $this->getView()->assign('company',$companyData);

            }
            $this->getView()->assign('login',$loginStatus);
            $oper = safe::filterGet('oper');
	        $oper = $oper=='update' ? $oper : '';
	        $this->getView()->assign('oper',$oper);
        }

    }

    public function updateMemberAction(){
        $login = session::get('login');
        if(IS_POST && $login){
            $user_id = $login['user_id'];
            //会员数据
            $memeberData = array(
                'user_id'=>$user_id,
                'name'=> safe::filterPost('company_name'),
                'area' => safe::filterPost('area'),
                'address' => safe::filterPost('address'),
                'contact_person' => safe::filterPost('contact'),
                'contact_phone'  => safe::filterPost('contact_phone'),
                'apply_time' => \Library\time::getDateTime()
            );

            $certObj = new \nainai\cert\certVipTemp();
            $certObj->certUpdate($memeberData);
            die(json::encode(tool::getSuccInfo()));
        }


    }


    public function regsuccedAction(){
        
    }
    
    /**
     *
     * 验证手机验证码
     * @param $phone
     * @param $num
     * @return array
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
       // if(!$captchaObj->check($captcha))
       // {
           // die(JSON::encode(tool::getSuccInfo(0, '验证码错误')));
        //}
        $userObj = new M('user');
        if($userObj->where('mobile="'.$phone.'"')->getFields('id'))
        {
            die(JSON::encode(tool::getSuccInfo(0, '该手机号已注册')));
        }
        $temp = rand(100000, 999999);
        $text = "您申请的校验码为 {$temp},请尽快操作，妥善保管，如非本人操作，请忽略此信息。";
        session::set('mobileValidateReg', array('phone' => $phone, 'num' => $temp, 'time' => time()));
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
		$callback = isset($_GET['callback']) ? htmlspecialchars($_GET['callback'],ENT_QUOTES) : '';
		$this->getView()->assign('callback',$callback);
	}

	/**
	 * 登录处理
	 */
	public function doLogAction(){
		if(IS_AJAX){
			$account = safe::filterPost('account');
			$password = htmlspecialchars($_POST['password']);
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
			elseif(!$captchaObj->check($captcha)){//验证码是否正确
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

			$data['returnUrl'] =  isset($_POST['callback']) && $_POST['callback']!=''?htmlspecialchars(trim($_POST['callback'])) : url::createUrl('/index/index@deal');

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

		if (empty($password)) {
			exit(json::encode(tool::getSuccInfo(0, '请填写密码')));
		}

		if (empty($mobile) ) {
			exit(json::encode(tool::getSuccInfo(0, '请填写手机号')));
		}

		// if ( empty(\Library\session::get('mobile')) ) {
		// 	exit(json::encode(tool::getSuccInfo(0, '请填写手机号')));
		// }
		
		if(strlen($password) < 6 || strlen($password) > 15){
			die(JSON::encode(\Library\tool::getSuccInfo(0,'密码长度需在6-15位之间')));
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
		if (time() - strtotime($info['create_time'])  > 15*60){
			die(JSON::encode(\Library\tool::getSuccInfo(0,'验证吗过期')));
		}
		$data=array(
			'id'=>$uid,
			'password'=>$password
		);
		$userModel->updateUserInfo($data);
		\Library\session::clear('mobile');
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
			$uid = safe::filterPost('uid');

//			$captchaObj = new captcha();
//			if (!$captchaObj->check($code)) {
//				die(JSON::encode(\Library\tool::getSuccInfo(0, '验证码错误')));
//			}
			$userObj = new UserModel();
			if (empty($mobile)) {
				$res = tool::getSuccInfo(0, '手机号不存在用户');
			}
			
			$user_id = $userObj->getMobileUserInfo($mobile);
			if ($user_id == false) {
				$res = tool::getSuccInfo(0, '手机号不存在用户');
			}else{
				if ($user_id == $uid) {
					$res = $userObj->getMobileCode($mobile, 3, 'database', $uid, 'login');
				}else{
					$res = tool::getSuccInfo(0, '请求的用户不存在');
				}
			}
			//var_dump($_SESSION);
			die(JSON::encode($res));
		}
	}

	public function getUserInfoAction(){
		$mobile = safe::filterPost('mobile');
		if (empty($mobile) ) {
			exit(json::encode(tool::getSuccInfo(0, '请填写手机号')));
		}

		$userObj = new UserModel();
		$uid = $userObj->getMobileUserInfo($mobile);
		exit(json::encode(tool::getSuccInfo(1,  $uid)));
	}

	public function checkMobileCodeAction(){
		$code = safe::filterPost('code');
		$uid = safe::filterPost('uid');
		$mobile = safe::filterPost('mobile');

		if (empty($code)) {
			exit(json::encode(tool::getSuccInfo(0, '请填写验证码')));
		}

		if (empty($uid) ) {
			exit(json::encode(tool::getSuccInfo(0, '请填写手机号')));
		}

		$model = new UserModel();
		$info = $model->getPasswordInfo($uid);
		if (time() - strtotime($info['create_time']) > 15*60) {
			exit(json::encode(tool::getSuccInfo(0, '验证码过期')));
		}
		
		if ($info['code'] == $code) {
			\Library\session::set('mobile', $mobile);
			$model->clearPassword($uid);
			//做登录处理
            $userObj = new M('user');
            $userData = $userObj->where(array('mobile'=>$mobile))->fields('id,username,mobile,pid,type')->getObj();
            if(!empty($userData)){
                $rightObj = new \Library\checkRight();
                $rightObj->loginAfter($userData);
            }
			exit(json::encode(tool::getSuccInfo(1, 'success', url::createUrl('/Login/resetTo'))));
		}else{
			exit(json::encode(tool::getSuccInfo(0, '验证码错误')));
		}
	}

	public function resetToAction(){
		$mobile = \Library\session::get('mobile');
		if (empty($mobile) ) {
			$this->redirect('PasswordReset');
		}

		$this->getView()->assign('mobile', $mobile);
	}


	public function resetendAction(){

	}

	//银联支付异步回调
	public function rechargeServerCallbackAction(){
		//从URL中获取支付方式
		$payment_id      = $this->getRequest()->getParam('id');
		$payment_id      = safe::filter($payment_id,'int');
		$payObj = null;
		if($payment_id == 3){
			$payFac = new \Library\payment\factory\unionFactory();
			$payObj = $payFac->getPayObj();
		}
		elseif($payment_id == 4){
			$payFac = new \Library\payment\factory\unionb2bFactory();
			$payObj = $payFac->getPayObj();
		}
		else{
			die(json::encode(\Library\tool::getSuccInfo(0,'支付方式不存在')) ) ;
		}

		$payment = new nainai\payment\recharge($payObj);

		$callbackData = array_merge($_POST,$_GET);
		unset($callbackData['controller']);
		unset($callbackData['action']);
		unset($callbackData['id']);
		$res = $payment->payAfter($callbackData);
		if($res){
			$payObj->notifyStop();
		}

		exit;
	}



}
