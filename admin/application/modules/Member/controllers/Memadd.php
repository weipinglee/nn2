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
class MemaddController extends InitController {


	public function init(){
		$this->getView()->setLayout('admin');
		//echo $this->getViewPath();
	}

	public function addMemberAction(){
		if(IS_POST){
			//会员数据
			$user = array(
				'username' => safe::filterPost('username'),
				'mobile' => safe::filterPost('mobile'),
				'email' => safe::filterPost('email'),
				'type' => safe::filterPost('type','int'),
				'credit'=>0,
				'create_time' => safe::filterPost('create_time')

			);
			if($this->existUser($user)){
				die(json::encode(tool::getSuccInfo(1,'用户名或手机已存在')));
			}
			$userObj = new \Library\M('user');
			$userObj->beginTrans();
			$user_id = $userObj->data($user)->add();

			if(!$user_id){
				$userObj->rollBack();
				die(json::encode(tool::getSuccInfo(1,'生成错误，请重新提交')));
			}


			//代理商数据
			$agentAccount = array(
				'user_id'=> $user_id,
				'fund' => safe::filterPost('fund'),
				'freeze' => safe::filterPost('freeze')
			);
			$userObj->table('user_account')->data($agentAccount)->add();

			//交易商认证信息
			$dealer = array(
				'user_id'=> $user_id,
				'status'=> safe::filterPost('status'),
				'apply_time' => safe::filterPost('apply_time'),
				'verify_time' => safe::filterPost('verify_time')
			);
			if($dealer['status']!=0){
				$userObj->table('dealer')->data($dealer)->add();
			}

			//仓库认证信息
			$store_manager = array(
				'user_id'=> $user_id,
				'status'=> safe::filterPost('status_1'),
				'apply_time' => safe::filterPost('apply_time_1'),
				'verify_time' => safe::filterPost('verify_time_1'),
				'store_id'   => safe::filterPost('store_id','int')
			);
			if($dealer['status']!=0){
				$userObj->table('store_manager')->data($store_manager)->add();
			}

			if($user['type']==1){
				//企业信息
				$company_info = array(
					'user_id'=> $user_id,
					'company_name'=>safe::filterPost('company_name'),
					'legal_person'=>safe::filterPost('legal_person'),
					'reg_fund'=>safe::filterPost('reg_fund'),
					'category'=>safe::filterPost('category'),
					'nature'=>safe::filterPost('nature'),
					'business'=>safe::filterPost('business'),
					'contact'=>safe::filterPost('contact'),
					'contactphone'=>safe::filterPost('contactphone'),
					'contact_phone'=>safe::filterPost('contactphone'),
					'area'=>safe::filterPost('area'),
					'address'=>safe::filterPost('address'),
					'cert_tax'=>Tool::setImgApp(safe::filterPost('imgfile1')),
					'cert_bl'=>Tool::setImgApp(safe::filterPost('imgfile2')),
					'cert_oc'=>Tool::setImgApp(safe::filterPost('imgfile3')),
				);
				$userObj->table('company_info')->data($company_info)->add();
			}
			else{
				$person_info = array(
					'user_id'=> $user_id,
					'true_name'=>safe::filterPost('true_name'),
					'identify_no'=>safe::filterPost('identify_no'),
					'area'=>safe::filterPost('area1'),
					'address'=>safe::filterPost('address1'),
					'identify_front'=>Tool::setImgApp(safe::filterPost('imgfile4')),
					'identify_back'=>Tool::setImgApp(safe::filterPost('imgfile5')),
				);
				$userObj->table('person_info')->data($person_info)->add();
			}

			//开户信息
			$bank = array(
				'user_id'=> $user_id,
				'status' => safe::filterPost('status'),
				'bank_name' => safe::filterPost('bank_name'),
				'card_type' => safe::filterPost('card_type'),
				'true_name' => safe::filterPost('true_name1'),
				'identify_no' => safe::filterPost('identify'),
				'card_no' => safe::filterPost('card_no'),
				'proof'=>Tool::setImgApp(safe::filterPost('imgfile6')),
				'apply_time' => safe::filterPost('apply_time_2'),
				'check_time' => safe::filterPost('check_time'),
			);

			if($bank['status']!=-1){
				$userObj->table('user_bank')->data($bank)->add();
			}
			//开票信息
			$piao = array(
				'user_id'=> $user_id,
				'title' => safe::filterPost('title'),
				'tax_no' => safe::filterPost('tax_no'),
				'address' => safe::filterPost('address2'),
				'phone' => safe::filterPost('tel'),
				'bank_name' => safe::filterPost('bankName'),
				'bank_no' => safe::filterPost('bankAccount'),
			);
			$userObj->table('user_invoice')->data($piao)->add();
			$zx = array(
				'user_id'=> $user_id,
				'no' => safe::filterPost('no'),
				'name' => safe::filterPost('name'),
				'bank'=>'zx',
				'legal'=> safe::filterPost('legal'),
				'id_card'=> safe::filterPost('id_card'),
				'address' => safe::filterPost('address3'),
				'contact_name'=> safe::filterPost('contact_name'),
				'contact_phone'=> safe::filterPost('contact_phone'),
				'mail_address'=> safe::filterPost('mail_address'),
				'time'=> safe::filterPost('time')
			);
			$userObj->table('user_attach')->data($zx)->add();
			$res = $userObj->commit();
			if($res){
				die(json::encode(tool::getSuccInfo()));
			}
			else{
				die(json::encode(tool::getSuccInfo(0,'添加失败')));
			}
		}
		else{
			$member = new \nainai\member();
			$comtype = $member->getComType();
			$comNature = $member->getComNature();
			$this->getView()->assign('comtype',$comtype);
			$this->getView()->assign('comNature',$comNature);

			$store = nainai\store::getStoretList();
			$this->getView()->assign('store',$store);




		}



	}

	/**验证用户是否已注册
	 * @param array $userData 用户数据
	 * @return bool  存在 返回数组 否则 false
	 */
	public function existUser($data){
		$userObj = new \Library\M('user');
		$uniqueFields = array(
			'username'=>'用户名',
			'mobile'=>'手机号'
		);
		$where = array();

		foreach($uniqueFields as $f=>$v){
			if(isset($data[$f])){
				$where[$f] = $data[$f];
				$res = $userObj->fields('id')->where($where)->getObj();
				if(!empty($res))
					return true;
				else{
					unset($where[$f]);
				}

			}
		}
		return false;
	}




}
