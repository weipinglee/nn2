<?php
/**
 * @date 2016-4-7
 * 后台管理员操作
 *
 */

use \Library\M;
use \Library\Query;
use \Library\tool;
class KefuModel extends AdminModel{

	protected $table = 'admin_kefu';

	protected $rules = array(
		array('id','number','id错误',0,'regex'),
		//array('admin_id','/^[1-9][\d]{0,}$/','管理员id错误'),
		array('ser_name','s{2,40}','名称错误'),
		array('phone','mobile','手机号码错误'),
		array('qq','number','qq号码错误'),
	);
	//模型对象实例
	private $kefuObj;
	public function __construct(){
		parent::__construct();
		$this->kefuObj = new M('admin_kefu');
	}

	/**
	 * 添加客服
	 * @param array $adminData 管理员数据
	 * @param array $kefu 客服数据
	 * @return array
	 */
	public function addKefu($adminData,$kefu){
		$admin = $this->adminObj;
		$log = new \Library\log();
		if($admin->data($adminData)->validate($this->adminRules)){
			$data = $adminData;
			$admin->beginTrans();
			if(isset($data['id']) && $data['id']>0){
				$id = $data['id'];
				if(isset($data['name']) && $this->existAdmin(array('name'=>$data['name'],'id'=>array('neq',$id))))
					return tool::getSuccInfo(0,'用户名已注册');

				if(isset($data['email']) && $this->existAdmin(array('email'=>$data['email'],'id'=>array('neq',$id))))
					return tool::getSuccInfo(0,'邮箱已注册');
				//编辑
				if(isset($data['password']))
					$admin->password = $data['password'] = sha1($data['password']);
				unset($data['id']);
				$admin->where(array('id'=>$id))->data($data)->update();

			}else{
				if($this->existAdmin(array('name'=>$data['name'])))
					return tool::getSuccInfo(0,'用户名已注册');

				if($this->existAdmin(array('email'=>$data['email'])))
					return tool::getSuccInfo(0,'邮箱已注册');
				$admin->password = $data['password'] = sha1($data['password']);

				$aid = $admin->add();
				$id = $aid;



			}

			if($this->kefuObj->validate($this->rules,$kefu)){//客服数据验证
				$kefu['admin_id'] = $id;
				$this->kefuObj->insertUpdate($kefu,$kefu);
				$type = isset($adminData['id']) && $adminData['id']>0 ? 'update' : 'add';
				$log->addLog(array('table'=>'客服','type'=>$type,'id'=>$id));
				$res = $this->kefuObj->commit();
			}
			else{
				$admin->rollBack();
				$res = $this->kefuObj->getError();
			}
		}else{
			$res = $admin->getError();
		}

		if($res===true){
			$resInfo = tool::getSuccInfo();
		}
		else{
			$resInfo = tool::getSuccInfo(0,is_string($res) ? $res : '系统繁忙，请稍后再试');
		}
		return $resInfo;
	}
	/**
	 * 获取客服角色id
	 * @return mixed
	 */
	public function getKefuRole(){
		$obj = new M('admin_role');
		$id = $obj->where(array('tag'=>'kefu'))->getField('id');
		if(!$id)
			return 0;
		return $id;
	}

	/**
	 * 获取客服列表
	 * @param $page
	 * @return array
	 */
	public function getKefuList($page){
		$Q = new Query($this->table.' as ke');
		$Q->join = 'left join admin as a on ke.admin_id=a.id';
		$Q->fields = 'ke.*,a.name';
		$Q->page = $page;
		$Q->pagesize = 18;
		$data = $Q->find();
		$pageBar =  $Q->getPageBar();
		return array('data'=>$data,'bar'=>$pageBar);
	}

	/**
	 * 获取客服详情
	 * @param $id
	 * @return array
	 */
	public function getKefuData($id){
		$Q = new Query($this->table.' as ke');
		$Q->join = 'left join admin as a on ke.admin_id=a.id';
		$Q->fields = 'ke.*,a.name,a.email';
		$Q->where = ' ke.admin_id=:id';
		$Q->bind = array('id'=>$id);
		$data = $Q->getObj();
		return $data;
	}

	/**
	 * 删除客服
	 * @param $id
	 * @return array
	 */
	public function delKefu($id){
		$m = $this->kefuObj;
		$log = new \Library\log();
		$m->beginTrans();
		$m->where(array('admin_id'=>$id))->delete();
		$log->addLog(array('table'=>'客服','type'=>'delete','id'=>$id));
		$res = $m->commit();
		if($res){
			return tool::getSuccInfo();
		}
		else{
			return tool::getSuccInfo(0,'删除失败');
		}
	}

	/**
	 * 获取所有客服
	 * @return array
	 */
	public function getAllkefu(){
		$Q = new Query($this->table.' as ke');
		$Q->join = 'left join admin as a on ke.admin_id=a.id';
		$Q->fields = 'ke.*,a.name';
		$data = $Q->find();
		return $data;
	}


}