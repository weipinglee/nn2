<?php
/**
 * 报盘模型
 */

use \Library\M;
use \Library\Query;
use \Library\tool;
use \Library\Thumb;
class OfferManageModel{

	//模型对象实例
	private $offer;
	//报盘模式
	const FREE_OFFER = 1;//自由
	const DEPOSITE_OFFER = 2;//保证金
	const STORE_OFFER = 3;//仓单

	public function __construct(){
		$this->offer = new M('product_offer');
	}
	

	/**
	 * 获取列表
	 * @param  int $page 当前页index
	 * @return array
	 */
	public function getList($page,$where =''){
		$Q = new Query('product_offer as o');
		$Q->join = "join user as u on o.user_id = u.id";
		$Q->fields = "o.*,u.username";
		if($where) $Q->where = $where;
		$Q->page = $page;
		$Q->pagesize = 5;
		// $Q->order = "sort";
		$sql = 'select count(*) as count from product_offer as o '.($where ? ' where '.$where : '');
		$count = $this->offer->query($sql);
		$data = $Q->find();
		foreach ($data as $key => &$value){
			$value['mode_txt'] = $this->getMode($value['mode']);
			$value['status_txt'] = $this->getStatus($value['status']);
			$value['type_txt'] = $this->getType($value['type']);
		}
		$pageBar =  $Q->getPageBar();
		return array('data'=>$data,'bar'=>$pageBar,'count'=>$count[0]['count']);
	}

	/**
	 * 获取某一商品分类所有父级分类
	 * @param int $cate_id 分类id
	 * @return array
	 */
	public function getParents($cate_id){
		if(!($cate_id && $cate_id>0)) return array();
		$m = new M('product_category');
		$data = $m->select();
		$res = $this->listParents($data,$cate_id);
		return $res;
	}

	private function listParents($data,$id,$parents = array()){
		foreach ($data as $key => $value) {
			if($value['id'] == $id){
				$parents []= array('id'=>$id,'name'=>$value['name']);
				$pid = $value['pid'];
				if($pid != 0){
					$parents = $this->listParents($data,$pid,$parents);
				}
			}
		}
		return $parents;
	}

	/**
	 * 获取信息
	 * 
	 * @param  int $id 
	 * @return array  信息
	 */
	public function getofferInfo($id){
		$query = new Query("product_offer as o");
		$query->join = 'left join products as p on o.product_id = p.id';
		$query->fields = 'o.*,p.name,p.cate_id,p.unit';
		$query->where = 'o.id = '.$id;
		$info = $query->getobj();
		$parent_cates = $this->getParents($info['cate_id']);
		$info['topcate_name'] = array_pop($parent_cates)['name'];
		foreach ($parent_cates as $value) {
			$parents []= $value['name'];
		}
		$info['type'] = $info['type'] == 1 ? "卖盘" : "买盘";
		$info['mode_txt'] = $this->getMode($info['mode']);
		$info['status_txt'] = $this->getStatus($info['status']);
		$info['parent_cates'] = implode('/', array_reverse($parents));
		return $info ? $info : array();
	}

	/**
	 * 更新审核状态
	 */
	public function setStatus($id,$status){
		if(!($id = intval($id))) return tool::getSuccInfo(0,'参数错误');
		$status = isset($status) ? intval($status) : 1;
		try {
			$this->offer->beginTrans();	
			$this->offer->where(array('id'=>$id))->data(array('status'=>$status))->update();
			$res = $this->offer->commit();
		} catch (PDOException $e) {
			$this->offer->rollBack();
			$res = $e->getMessage();
		}
		return $res == true ? tool::getSuccInfo() : tool::getSuccInfo(0,(is_string($res) && $res) ? $res : '未知错误');
	}

	//获取方式
	public function getMode($mode){
		switch ($mode) {
			case self::FREE_OFFER:
				$mode_txt = '自由报盘';
				break;
			case self::DEPOSITE_OFFER:
				$mode_txt = '保证金报盘';
				break;
			case self::STORE_OFFER:
				$mode_txt = '仓单报盘';
				break;
			default:
				$mode_txt = '未知';
				break;
		}
		return $mode_txt;
	}

	//获取状态信息
	public function getStatus($status){
		switch ($status) {
			case -1:
				$st = '已删除';
				break;
			case 0:
				$st = '已通过';
				break;
			case 1:
				$st = '待审核';
				break;
			case 2:
				$st = '未通过';
				break;
			default:
				$st = '未知';
				break;
		}
		return $st;
	}

	//获取交易方式
	public function getType($type){
		switch ($type) {
			case 1:
				$tp = '卖盘';
				break;
			case 2:
				$tp = '买盘';
				break;
			
			default:
				$tp = '未知';
				break;
		}
		return $tp;
	}

	/**
	 * 删除
	 * @param  int $id 
	 */
	public function offerDel($id){
		$offer = $this->offer;
		if(($id = trim($id))){
			try {
				$offer->beginTrans();

				$offer->where(array('id'=>$id))->delete();

				$res = $offer->commit();
			} catch (PDOException $e) {
				$offer->rollBack();
				$res = $e->getMessage();
			}
			
		}else{
			$res = '参数错误';
		}

		if($res===true){
			$resInfo = tool::getSuccInfo();
		}
		else{
			$resInfo = tool::getSuccInfo(0,is_string($res) ? $res : '系统繁忙，请稍后再试');
		}
		return $resInfo;		
	}
	
}