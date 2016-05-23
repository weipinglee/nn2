<?php
/**
 * @date 2015-9-13 
 * @author zhengyin <zhengyin.name@gmail.com>
 * @blog http://izhengyin.com
 *
 */
use \Library\M;
use \Library\Query;
use \Library\Time;
class UserModel{

	/**
	 * 验证规则：
	 * array(字段，规则，错误信息，条件，附加规则，时间）
	 * 条件：0：存在字段则验证 1：必须验证 2：不为空时验证
	 *
	 */
	/**
	 * @var
	 */
	protected $userRules = array(
		array('id','number','id错误',0,'regex'),
		array('pid','number','',0,'regex'),
		array('username','/^[a-zA-Z0-9_]{3,30}$/','用户名格式错误'),
		array('password','/^\S{6,15}$/','密码格式错误',0,'regex',3),
		array('repassword','password','两次密码输入不同',0,'confirm'),
		array('type',array(0,1),'类型错误',0,'in'),
		array('head_photo','/^[a-zA-Z0-9_@\.\/]+$/','请正确上传头像',2,'regex'),
		array('mobile','mobile','手机号码错误',0,'regex'),
		array('email','email','邮箱格式错误',2,'regex'),
		array('agent','number','代理商选择错误'),
		//array('agent_pass','/^[a-zA-Z0-9]{6,30}$/','填写代理商密码')
	);

	protected $personRules = array(
		array('true_name','/.{2,20}/','真实姓名必填',0),//默认是正则
		array('sex',array(0,1),'性别错误',0,'in'),
		array('identify_no','/^\d{1,20}[a-zA-Z]?$/','请填写身份证号码'),
		array('identify_front','/^[a-zA-Z0-9_@\.\/]+$/','请上传图片'),
		array('identify_back','/^[a-zA-Z0-9_@\.\/]+$/','请上传图片'),
		array('birth','date','请正确填写生日',2,'regex'),
		array('education','number','请选择学历',2,'regex'),
		array('qq','/^\d+$/','请正确填写QQ号',2,'regex'),
		array('zhichen','require','填写职称',2,'regex')

	);

	protected $companyRules = array(
		array('company_name','s{2,9}','公司名称必填'),
		array('area','number','地区错误'),
		array('legal_person','zh{2,30}','法人填写错误'),
		array('reg_fund','double','注册资金格式错误'),
		array('category','number','企业分类错误'),
		array('nature','number','企业类型错误'),
		array('contact','require','请填写联系人'),
		array('contact_phone','mobile','填写正确的联系人手机号'),
		array('contact_duty','number','正确选择职务'),
		array('check_taker_phone','mobile','请正确填写收票人电话'),
		array('check_taker_add','require','请填写收票人地址'),
		array('deposit_bank','require','请填写开户银行'),
		array('bank_acc','number','请正确填写银行账号'),
		array('tax_no','require','请填写税号'),
		array('qq','number','请正确填写qq',2,'regex'),
		array('cert_bl','/^[a-zA-Z0-9_@\.\/]+$/','请上传图片'),
		array('cert_oc','/^[a-zA-Z0-9_@\.\/]+$/','请上传图片'),
		array('cert_tax','/^[a-zA-Z0-9_@\.\/]+$/','请上传图片'),
		array('business','/.{1,100}/','请填写主营品种'),

	);




	static private  $userObj = '';

	public function __construct(){
		self::$userObj = new M('user');
	}

	/**
	 * 验证代理商密码是否正确
	 * @param $agentId
	 * @param $agentNo
	 */
	protected function checkAgentPass($agentId,$agentNo){
		if($agentId==0){//如果是市场，不需有密码
			return true;
		}
		else{
			$agent = new M('agent');
			$no = $agent->where(array('id'=>$agentId))->getField('serial_no');
			if($no==$agentNo){
				return true;
			}
			else return false;
		}
	}
	//个人用户注册
	public function userInsert(&$data){

		if(false===$this->checkAgentPass($data['agent'],$data['serial_no']))
			return $this->getSuccInfo(0,'代理商密码错误');

		$user = self::$userObj;
		if($user->data($data)->validate($this->userRules)){
			if($this->existUser(array('username'=>$data['username'])))
				return $this->getSuccInfo(0,'用户名已注册');

			if($this->existUser(array('mobile'=>$data['mobile'])))
				return $this->getSuccInfo(0,'手机号码已注册');
			unset($user->repassword);
			unset($user->serial_no);
			$user->password = $data['password'] = sha1($data['password']);
			$user->beginTrans();
			$uID = $user->add();
			if(is_numeric($uID) ){
				$user->table('person_info')->data(array('user_id'=>$uID))->add();
			}
			$res = $user->commit();

		}
		else{
			$res = $user->getError();
		}
		if($res===true){
			$data['id'] = $uID;
			$resInfo = $this->getSuccInfo();
		}
		else{
			$resInfo = $this->getSuccInfo(0,is_string($res) ? $res : '系统繁忙，请稍后再试');
		}
		return $resInfo;
	}

	/**
	 * 统一格式返回操作成功/失败信息
	 * @param int $res 0:失败 1：成功
	 * @param string $info 错误信息
	 */
	private function getSuccInfo($res=1,$info=''){
		return array('success'=>$res,'info'=>$info);
	}

	/**
	 * 公司注册
	 * @param array $userData 用户数据
	 * @param array $companyData 公司数据
	 * @return string
	 */
	public function companyReg(&$userData,$companyData){

		if(false===$this->checkAgentPass($userData['agent'],$userData['serial_no']))
			return $this->getSuccInfo(0,'代理商密码错误');
		$user = self::$userObj;
		if($user->data($userData)->validate($this->userRules) && $user->validate($this->companyRules,$companyData)){
			if($this->existUser(array('username'=>$userData['username'])))
				return $this->getSuccInfo(0,'用户名已注册');
			if($this->existUser(array('mobile'=>$userData['mobile'])))
				return $this->getSuccInfo(0,'手机号码已注册');
			unset($user->repassword);

			$user->password = $userData['password'] = sha1($userData['password']);
			$user->beginTrans();
			$user_id = $user->add();
			$userData['id'] = $user_id;
			$companyData['user_id'] = $user_id;
			if($user_id)$user->table('company_info')->data($companyData)->add();
			$res = $user->commit();
		}
		else{
			$res =  $user->getError();
		}

		if(true === $res){//操作成功
			return $this->getSuccInfo();
		}else{
			return $this->getSuccInfo(0,is_string($res) ? $res : '系统繁忙，请稍后再试');
		}


	}


	/**
	 * 子账户注册
	 * @param $data
	 * @return array
	 */
	public function subAccReg($data){
		$user = self::$userObj;
		if($user->data($data)->validate($this->userRules)){
			if($this->existUser(array('username'=>$data['username'])))
				return $this->getSuccInfo(0,'用户名已注册');

			if($this->existUser(array('mobile'=>$data['mobile'])))
				return $this->getSuccInfo(0,'手机号码已注册');
			unset($user->repassword);
			$user->password = $data['password'] = sha1($data['password']);

			$res = $user->add();

		}
		else{
			$res = $user->getError();
		}
		if(is_numeric($res)){
			$resInfo = $this->getSuccInfo();
		}
		else{
			$resInfo = $this->getSuccInfo(0,is_string($res) ? $res : '系统繁忙，请稍后再试');
		}
		return $resInfo;
	}

	/**
	 * 子账户编辑
	 * @param $data
	 * @return array
	 */
	public function subAccUpdate($data){
		$user = self::$userObj;
		if($user->data($data)->validate($this->userRules)){
			$user_id = $data['user_id'];
			if($this->existUser(array('id'=>array('neq',$user_id),'username'=>$data['username']))){
				return $this->getSuccInfo(0,'用户名已注册');
			}

			if($this->existUser(array('id'=>array('neq',$user_id),'mobile'=>$data['mobile'])))
				return $this->getSuccInfo(0,'手机号码已注册');
			if(isset($data['password'])){
				unset($user->repassword);
				$user->password  = sha1($data['password']);
			}
			unset($user->user_id);unset($user->pid);


			$res = $user->where(array('id'=>$user_id,'pid'=>$data['pid']))->update();

		}
		else{
			$res = $user->getError();
		}
		if(is_numeric($res)){
			$resInfo = $this->getSuccInfo();
		}
		else{
			$resInfo = $this->getSuccInfo(0,is_string($res) ? $res : '系统繁忙，请稍后再试');
		}
		return $resInfo;
	}


	/**
	 * 更新用户表数据
	 * @param $data
	 */
	public function updateUserInfo($data){
		if($this->existUser(array('username'=>$data['username'],'id'=>array('neq'=>$data['id'])))){
			return \Library\tool::getSuccInfo(0,'用户名已存在');
		}
		if($this->existUser(array('email'=>$data['email'],'id'=>array('neq'=>$data['id'])))){
			return \Library\tool::getSuccInfo(0,'邮箱已存在');
		}
		if(!is_object(self::$userObj)){
			self::$userObj = new M('user');
		}
		$id = $data['id'];
		unset($data['id']);
		$res = self::$userObj->where(array('id'=>$id))->data($data)->update();
		if($res!==false){
			return \Library\tool::getSuccInfo();
		}
		else
			return \Library\tool::getSuccInfo(0,'系统繁忙，稍后再试');



	}
	/**验证用户是否已注册
	 * @param array $userData 用户数据
	 * @return bool  存在 true 否则 false
     */
	public function existUser($userData){

		if(!is_object(self::$userObj)){
			self::$userObj = new M('user');
		}

		$data = self::$userObj->fields('id')->where($userData)->getObj();
		if(empty($data))
			return false;
		return true;
	}

	/**
	 * 验证用户名、密码是否正确
	 * @param string $userAcc 用户账户：用户名或 手机号
	 * @param string $password 密码（未加密）
	 */
	public function checkUser($userAcc,$password){

		$where = 'username=:username AND password = :password OR mobile=:mobile AND password = :password';
		return self::$userObj->fields('id,username,mobile,password,type')->where($where)->bind(array('username'=>$userAcc,'password'=>sha1($password),'mobile'=>$userAcc))->getObj();

	}


	/**
	 * 个人用户认证信息验证
	 * @param array $data 个人用户数据
	 */
	public function checkPersonInfo($data){

		if(self::$userObj->validate($this->personRules,$data)){
			return true;
		}
		return self::$userObj->getError();


	}

	/**
	 * 企业用户认证信息验证
	 * @param array 企业用户数据
	 */
	public function checkCompanyInfo($data){
		if(self::$userObj->validate($this->companyRules,$data)){
			return true;
		}
		return self::$userObj->getError();
	}


	/**
	 *获取用户数据，仅user表
	 * @param int $user_id
	 * @param int $pid 父账户id
	 * @return array
     */
	public function getUserInfo($user_id,$pid=0){
		$um = self::$userObj;
		$where = $pid!=0 ? array('id'=>$user_id,'pid'=>$pid) : array('id'=>$user_id);
		return $um->fields('id,username,email,mobile,head_photo,status')->where($where)->getObj();
	}
	/**
	 * 获取个人用户信息
	 */
	public function getPersonInfo($user_id){
		$m = new Query('user as u');
		$m->join = 'left join person_info as p on u.id = p.user_id';
		$m->where = 'u.id='.$user_id.' and u.type=0';
		$m->limit = 1;
		$res = $m->getObj();
		return $res;
	}

	/**
	 * 获取企业用户信息
	 */
	public function getCompanyInfo($user_id){
		$m = new Query('user as u');
		$m->join = 'left join company_info as p on u.id = p.user_id';
		$m->where = 'u.id='.$user_id.' and u.type=1';
		$res = $m->getObj();
		return $res;
	}

	/**
	 * 个人用户更新信息
	 * @param array $userData 用户表数据
	 * @param array $personData 个人表数据
	 * @return array or string 操作结果
	 */
	public function personUpdate($userData,$personData){
		$user = new M('user');
		if($user->data($userData)->validate($this->userRules,2) && $user->validate($this->personRules,$personData,2)){
			$user_id = $userData['user_id'];
			if($this->existUser(array('id'=>array('neq',$user_id),'username'=>$userData['username']))){
				return $this->getSuccInfo(0,'用户名已注册');
			}
			$user->beginTrans();

			unset($userData['user_id']);
			if(($res1=$user->where(array('id'=>$user_id))->data($userData)->update()) !== false)
				$res2=$user->table('person_info')->where(array('user_id'=>$user_id))->data($personData)->update();
			if(false!==$res1 && isset($res2) && false !==$res2){//操作成功
				if($res1===0 && $res2===0){//更新成功，但数据未改变
					$user->commit();
					$res=2;
				}
				else $res=1;//此时事务不提交，后续还要更新认证状态
			}
			else{
				$res = '系统繁忙，请稍后再试';
			}
		}
		else{
			$res = $user->getError();
		}
		if(is_numeric($res)){//操作成功
			return $this->getSuccInfo($res);
		}else{
			return $this->getSuccInfo(0,$res);
		}
	}

	/**
	 * 企业用户信息更新
	 * @param array $userData 用户数据
	 * @param array $companyData 企业数据
	 */
	public function companyUpdate($userData,$companyData){
		$user = new M('user');
		if($user->data($userData)->validate($this->userRules,2) && $user->validate($this->companyRules,$companyData,2)){
			$user_id = $userData['user_id'];
			if($this->existUser(array('id'=>array('neq',$user_id),'username'=>$userData['username']))){
				return $this->getSuccInfo(0,'用户名已注册');
			}
			$user->beginTrans();

			unset($userData['user_id']);
			if(($res1=$user->where(array('id'=>$user_id))->data($userData)->update()) !== false)
				$res2=$user->table('company_info')->where(array('user_id'=>$user_id))->data($companyData)->update();

			if(false!==$res1 && isset($res2) && false !==$res2){//操作成功
				if($res1===0 && $res2===0){//更新成功，但数据未改变
					$user->commit();
					$res=2;
				}
				else $res=1;//此时事务不提交，后续还要更新认证状态
			}
			else{
				$res = '系统繁忙，请稍后再试';
			}
			//$res = $user->commit();
		}
		else{
			$res = $user->getError();
		}
		if(is_numeric($res)){//操作成功
			return $this->getSuccInfo($res);
		}else{
			return $this->getSuccInfo(0,$res);
		}
	}
	/**
	 * 更改密码
	 * @param array $userData 用户密码数据
	 * @param int $user_id 用户id
	 * @return
	 */
	public function changePass($userData,$user_id){
		if($this->existUser(array('id'=>$user_id,'password'=>sha1($userData['old_pass'])))){//原密码正确
			$user = self::$userObj;
			unset($userData['old_pass']);
			if($user->data($userData)->validate($this->userRules)){
				unset($user->repassword);
				$user->password = sha1($userData['password']);
				if($user->where(array('id'=>$user_id))->update() === false){
					$res = '系统繁忙，请稍后再试';
				}
				else{
					return $this->getSuccInfo();
				}
			}
			else{
				$res = $user->getError();
			}
			return $this->getSuccInfo(0,$res);
		}else{
			return $this->getSuccInfo(0,'原密码错误');
		}
	}







}