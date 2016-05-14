<?php 

/**
 * 报盘
 */

use \Library\Query;
use \Library\M;
class OffersModel extends \nainai\offer\product{
	private $offer ;
	public function __construct(){
		$this->offer = new M('product_offer');
	}

	public function getList($page,$where =''){
		$query = new Query('product_offer as o');
		$query->join = "left join products as p on o.product_id = p.id ";
		$query->fields = "o.*,p.cate_id,p.name,p.quantity,p.freeze,p.sell,p.unit,o.price,o.accept_area,p.produce_area,p.id as product_id";
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
		return $this->getMode($type);
	}

	/**
	 * 获取报盘详情
	 */
	public function offerDetail($id){
		$query = new Query('product_offer as o');
		$query->join = "left join products as p on o.product_id = p.id left join product_photos as pp on p.id = pp.products_id";
		$query->fields = "o.*,p.cate_id,p.name,pp.img,p.quantity,p.freeze,p.sell,p.unit";
		$query->where = 'o.id = :id';
		$query->bind = array('id'=>$id);
		$res = $query->getObj();

		if(!empty($res)){
			$res['mode_text'] = $this->offerMode($res['mode']);
			$res['img'] = empty($res['img']) ? 'no_picture.jpg' : \Library\thumb::get($res['img'],100,100);//获取缩略图
			$res['left'] = number_format(floatval($res['quantity']) - floatval($res['freeze']) - floatval($res['sell']),2);
			if($res['divide']==self::UNDIVIDE)
				$res['minimum'] = $res['quantity'];
		}


		return $res ? $res : array();
	}

	//获取报盘类型
	public function offerType($id){
		return intval($this->offer->where(array('id'=>$id))->getField('mode'));
	}
}
 ?>
