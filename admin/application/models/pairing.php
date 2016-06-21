<?php

use \Library\M;
use \Library\Query;
use \Library\tool;
class pairingModel{

	//模型对象实例
	private $order;
	public function __construct(){
		$this->order = new M('order_sell');
		$this->admin = new M('admin');
		$this->pairing = new M('order_pairing');
	}

	/**
	 * 新增
	 * @param  array $data 数据
	 * @return array  结果
	 */
	public function pairingUpdate($data){
		$res = $this->pairing->data($data)->add();
		if(intval($res) > 0){
			return tool::getSuccInfo();
		}else{
			return tool::getSuccInfo(0,'添加失败');
		}
	}

	/**
	 * 获取合同状态为已生效及之后的列表
	 */
	public function contractList($page,$where = '',$pairing = 0){
		$query = new Query('order_sell as o ');
		$query->join = 'left join product_offer as po on o.offer_id = po.id left join products as p on po.product_id = p.id left join order_pairing as op on op.order_id = o.id';
		$sql_where = 'o.contract_status >= '.\nainai\order\Order::CONTRACT_EFFECT;
		if($pairing){
			$sql_where .= ' and op.admin_id = '.$pairing;
		}else{
			$sql_where .= ' and op.order_id is null';
		}
		if($where) $sql_where .= ' and '.$where;
		$query->where = $sql_where;
		$query->fields = 'o.*,p.name as product_name,p.unit';
		$query->page = $page;
		$query->pagesize = 5;
		$res = $query->find();
		$bar = $query->getPageBar();

		$order = new \nainai\order\Order();
		$order->adminContractStatus($res);

		return array('data'=>$res,'bar'=>$bar);
	}


	/**
	 * 合同详情
	 */
	public function contractDetail($order_id){
		
		$order = new \nainai\order\Order(0);
		$user = new M('user');
		$info = $order->contractDetail($order_id);
		$admin_id = $this->pairing->where(array('order_id'=>$order_id))->getField('admin_id');
		if($admin_id){
			$admin_name = $this->admin->where(array('id'=>$admin_id))->getField('name');
			$info['admin_name'] = $admin_name;
			$info['admin_id'] = $admin_id;
			
		}
		$info['buyer'] = $user->where(array('id'=>$info['user_id']))->fields('username,mobile,email')->getObj();
		$info['seller'] = $user->where(array('id'=>$info['seller_id']))->fields('username,mobile,email')->getObj();
		return $info;
	}

	/**
	 * 获取可以成为撮合人的管理员列表
	 * @return array 结果
	 */
	public function managerList(){
		$admin_list = $this->admin->where(array('status'=>0))->select();
		$options = '<option value=-1>请选择</option>';
		foreach ($admin_list as $key => $value) {
			$options .= "<option value={$value['id']}>{$value['name']}</option>";
		}

		return $options;
	}
}



