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
class MemberController extends InitController {


	public function init(){
		$this->getView()->setLayout('admin');
		//echo $this->getViewPath();
	}


	/**
	 * 获取会员列表
	 */
	public function memberListAction(){
		$m = new MemberModel();
		$pageData = $m->getList();
		$down = safe::filterGet('down', 'int', 0);//是否导出
		if ($down == 1) {
			$condition = array('name' => '会员列表', 'type' =>'user');
			$this->downExcel($pageData['list'], $condition);
		}

		$this->getView()->assign('data',$pageData);
	}

	public function detailAction(){
		$user_id = $this->getRequest()->getParam('id');
		$user_id = safe::filter($user_id,'int',0);
		if($user_id){
			$mem = new member();
			$user = $mem->getUserDetail($user_id);

			//获取客服人员列表
			$yewu = new YewuModel();
			$yewuData = $yewu->getAllkefu();

			$this->getView()->assign('user',$user);
			$this->getView()->assign('yewu',$yewuData);

		}
	}



	/**
	 *角色添加页面，如果传递参数id，则为更新
	 *
	 */
	public function roleAddAction(){
		$id = $this->getRequest()->getParam('id',0);
		$id = safe::filter($id,'int',0);

		$subModel = new subRight();
		//获取用户组数据，指定用户组来分配菜单
		$usergroupModel = new \nainai\user\MenuRole();
		$usergroupList = $usergroupModel->getRoleList();
		$userModel = new \nainai\user\User();
		$userDetail = $userModel->getUser($id, 'id, gid');
		$userDetail['gid'] = unserialize($userDetail['gid'] );

		if($id){//编辑情形
			$roleData = $subModel->getRoleData($id);
			$this->getView()->assign('roleData',$roleData);
		}
		$dataTree = $subModel->getSubRights();

		$this->getView()->assign('tree',$dataTree);
		$this->getView()->assign('usergroupList',$usergroupList);
		$this->getView()->assign('userDetail',$userDetail);
	}

	/**
	 * 子账户角色添加处理
	 * @return bool
	 */
	public function doRoleAddAction(){
		if(IS_POST){
			//分配用户组
			$id = Safe::filterPost('id', 'int', 0);
			$userData = array('gid' => serialize(Safe::filterPost('gid', 'int', 0)));
			$userModel = new \nainai\user\User();
			$res = $userModel->updateUser($userData, $id);

			$role['id']   = safe::filterPost('role_id','int',0);
			$role['name'] = safe::filterPost('role_name');
			$role['status'] = safe::filterPost('status','int');
			$role['note'] = safe::filterPost('role_note');
			$first_role_id = isset($_POST['first_role_id'])?$_POST['first_role_id'] : array();
			$second_role_id = isset($_POST['second_role_id'])?$_POST['second_role_id'] : array();
			$third_role_id = isset($_POST['third_role_id'])?$_POST['third_role_id'] : array();

			//如果存在某个应用级权限，则删除其下的子权限（控制器级和方法级)，同时将应用及权限代码写入数组
			$right_ids = array();
			if(!empty($first_role_id)){
				foreach($first_role_id as $key=>$v){
					if(is_numeric($v))$right_ids[] = $v;
					if(isset($second_role_id[$v])){
						unset($second_role_id[$v]);
					}
					if(isset($third_role_id[$v])){
						unset($third_role_id[$v]);
					}
				}
			}
			//如果存在某个控制器权限，则删除其下的子权限（方法级)，同时将控制器级权限写入数组
			if(!empty($second_role_id)){
				foreach($second_role_id as $key=>$val){
					foreach($second_role_id[$key] as $k=>$v){
						if(is_numeric($v))$right_ids[] = $v;
						if(isset($third_role_id[$key][$v])){
							unset($third_role_id[$key][$v]);
						}
					}

				}
			}
			//将剩下的方法级权限写入数组
			if(!empty($third_role_id)){
				foreach($third_role_id as $k=>$v){
					foreach($third_role_id[$k] as $k1=>$v1){
						foreach($third_role_id[$k][$k1] as $k2 =>$v2){
							if(is_numeric($v2))$right_ids[] = $v2;
						}
					}
				}
			}
			$role['right_id'] = $right_ids;


			$subRight = new subRight();
			if($role['id']==0){
				$res = $subRight->addRole($role);
			}
			else{
				$res = $subRight->updateRole($role);
			}

			if($res['success']==1){
				$this->redirect('subRoleList');
			}
			else{
				echo $res['info'];
			}
		}

		return false;
	}



	/**
	 * 子账户角色列表
	 *
	 */
	public function subRoleListAction(){
		$m = new subRight();
		$page = safe::filterGet('page','int');
		$pageData = $m->getRoleList($page);
		$this->getView()->assign('subroles',$pageData['data']);
		$this->getView()->assign('bar',$pageData['bar']);
	}

	/**
	 * 子账户角色删除
	 */
	public function subRoleDelAction(){
		$id = $this->getRequest()->getParam('id',0);
		$id = safe::filter($id,'int',0);
		if($id){
			$m = new subRight();
			$res = $m->delRoleData($id);

				$this->redirect(url::createUrl('/member/subRoleList'));
			
		}
		return false;
	}


	public function allocationUsergroupAction(){

	}

	/**
	 * 给报盘添加业务员
	 */
	public function yewuAddAction(){
		if(IS_POST){
			$user_id = safe::filterPost('id','int',0);
			$yewu = safe::filterPost('yewu','int',0);
			$mem = new MemberModel();
			$res = $mem->addYewu($user_id,$yewu);
			die(\Library\json::encode($res));
		}
		return false;
	}
	public function OnLineListAction(){
		$page=safe::filterGet('page','int');
		$memberModel=new MemberModel();
		$member=$memberModel->getOnLine($page);
		//var_dump($member);
		$memberObj=new \nainai\cert\certificate();
		foreach($member[0] as $k=>$v){
			//var_dump($v);
			$status=$memberObj->getUserCertStatus($v['id']);
			if(!empty($status)){
				$member[0][$k]['status']=implode('/',$memberObj->getUserCertStatus($v['id']));
			}else{
				$member[0][$k]['status']='未认证';
			}
		}
		$this->getView()->assign('member',$member[0]);
		$this->getView()->assign('pageBar',$member[1]);

	}


}
