<?php 

/**
 * 报盘
 */

use \Library\Query;
use \nainai\order\Order;
use \Library\M;
class OffersModel{
	private $offer ;
	public function __construct(){
		$this->offer = new M('product_offer');
	}

	public function getList($page,$where =''){
		$query = new Query('product_offer as o');
		$query->join = "join products as p on o.product_id = p.id left join product_photos as pp on p.id = pp.products_id";
		$query->fields = "o.*,p.cate_id,p.name,pp.img,p.quantity,p.freeze,p.sell,p.unit,o.price,o.accept_area,p.produce_area,p.id as product_id";
		if($where) $query->where = $where;
		$query->page = $page;
		$query->pagesize = 5;
		$query->order = "apply_time desc";
		$data = $query->find();
		foreach ($data as $key => &$value) {
			$value['mode_txt'] = $this->offerMode($value['mode']);
			$value['img'] = empty($value['img']) ? 'no_picture.jpg' : $value['img'];//获取缩略图
			$value['left'] = number_format(floatval($value['quantity']) - floatval($value['freeze']) - floatval($value['sell']),2);
		}
		$pageBar =  $query->getPageBar();
		return array('data'=>$data,'bar'=>$pageBar);
	}

	//获取报盘类型
	public function offerMode($type){
		switch ($type) {
			case Order::ORDER_FREE:
				$mode_txt = '自由报盘';
				break;
			case Order::ORDER_DEPOSIT:
				$mode_txt = '保证金报盘';
				break;
			case Order::ORDER_STORE:
				$mode_txt = '仓单报盘';
				break;
			default:
				$mode_txt = '未知类型';
				break;
		}

		return $mode_txt;
	}

	/**
	 * 获取报盘详情
	 */
	public function offerDetail($id){
		$query = new Query('product_offer as o');
		$query->join = "join products as p on o.product_id = p.id left join product_photos as pp on p.id = pp.products_id";
		$query->fields = "o.*,p.cate_id,p.name,pp.img,p.quantity,p.freeze,p.sell,p.unit";
		$query->where = 'o.id = :id';
		$query->bind = array('id'=>$id);
		$res = $query->getObj();
		$res['img'] = empty($res['img']) ? 'no_picture.jpg' : $res['img'];//获取缩略图
		$res['left'] = number_format(floatval($res['quantity']) - floatval($res['freeze']) - floatval($res['sell']),2);
		
		return $res ? $res : array();
	}

	//获取报盘类型
	public function offerType($id){
		return intval($this->offer->where(array('id'=>$id))->getField('mode'));
	}
}
 ?>
