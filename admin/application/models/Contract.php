<?php
/**
 * 用户合同相关操作
 */

use \Library\M;
use \Library\Query;
use \Library\tool;
class ContractModel{

	//模型对象实例
	private $order;
	public function __construct(){
		$this->order = new M('order_sell');
	}

	//订单列表
	public function orderList(){

	}

	//待后台管理员审核的仓单摘牌订单列表
	public function storeOrderList($page = 1){
		$query = new Query('order_sell as o');
		$query->join = 'left join product_offer as po on o.offer_id = po.id left join products as p on po.product_id = p.id left join product_category as pc on p.cate_id = pc.id left join product_delivery as pd on pd.order_id = o.id left join store_products as sp on p.id = sp.product_id left join store_list as sl on sp.store_id = sl.id';
		$query->fields = 'o.*,p.name as product_name,pc.name as cate_name,sl.name as store_name,pd.create_time as delivery_time,p.unit,pd.num as delivery_num,pd.id as delivery_id';
		$query->where = 'o.mode='.\nainai\order\Order::ORDER_STORE.' and pd.status='.\nainai\delivery\Delivery::DELIVERY_ADMIN_CHECK;

		$query->order = 'pd.create_time desc';
		$query->page = $page;
		$query->pagesize = 5;
		$list = $query->find();
		return array('data'=>$list,'bar'=>$query->getPageBar());
	}

}