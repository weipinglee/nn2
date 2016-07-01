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
	 * 新增或更新
	 * @param  array $data 数据
	 * @return array  结果
	 */
	public function pairingUpdate($data){
		if(isset($data['id'])){
			$res = $this->pairing->where(array('id'=>$data['id']))->data($data)->update();
		}else{
			$res = $this->pairing->data($data)->add();	
		}
		if(intval($res) > 0){
			return tool::getSuccInfo();
		}else{
			return tool::getSuccInfo(0,'操作失败');
		}
	}

	/**
	 * 获取合同状态为已生效及之后的列表	
	 * @param  int  $page   分页数
	 * @param  string  $where   附加条件
	 * @param  int $pairing  撮合人员id 为0获取未绑定合同列表
	 * @param  boolean $is_complete 合同是否为已完成状态
	 * @return array   结果
	 */
	public function contractList($page,$where = '',$pairing = 0,$is_complete = false){
		$query = new Query('order_sell as o ');
		$query->join = 'left join product_offer as po on o.offer_id = po.id left join products as p on po.product_id = p.id left join order_pairing as op on op.order_id = o.id';
		if($is_complete){
			$sql_where = 'o.contract_status = '.\nainai\order\Order::CONTRACT_COMPLETE;
		}else{
			$sql_where = 'o.contract_status >= '.\nainai\order\Order::CONTRACT_EFFECT.' and o.contract_status < '.\nainai\order\Order::CONTRACT_COMPLETE;
		}
		if($pairing){
			$sql_where .= ' and op.admin_id = '.$pairing;
		}else{
			$sql_where .= ' and op.order_id is null';
		}
		if($where) $sql_where .= ' and '.$where;
		$query->where = $sql_where;
		$query->fields = 'o.*,p.name as product_name,p.unit,op.id as pairing_id';
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
		}else{
			$info['admin_id'] = 0;
		}
		$info['buyer'] = $user->where(array('id'=>$info['user_id']))->fields('username,mobile,email')->getObj();
		$info['seller'] = $user->where(array('id'=>$info['seller_id']))->fields('username,mobile,email')->getObj();

		return $info;
	}

	/**
	 * 获取可以成为撮合人的管理员列表
	 * @return array 结果
	 */
	public function managerList($admin_id){
		$cuoheTag = 'cuohe';
		$admin = new Query('admin as a');
		$admin->join = 'left join admin_role as r on a.role = r.id';
		$admin->where = 'a.status = 0 and r.tag = "'.$cuoheTag.'"';
		$admin->fields = 'a.*';
		$admin_list = $admin->find();

		$options = '<option value=-1>请选择</option>';
		foreach ($admin_list as $key => $value) {
			$is_sel = $value['id'] == $admin_id ? 'selected=selected' : '';
			$options .= "<option {$is_sel} value={$value['id']}>{$value['name']}</option>";
		}

		return $options;
	}
}



