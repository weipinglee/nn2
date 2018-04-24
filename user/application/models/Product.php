<?php

use \Library\Query;
use \Library\tool;
use \Library\M;
/**
 * 商品模型
 * @author zengmaoyong 
 */
class productModel extends \nainai\offer\product{


	/**
	 * 获取报盘对应的产品列表
	 * @param  [Int] $page     [分页]
	 * @param  [Int] $pagesize [分页]
	 * @param  string $where    [where的条件]
	 * @param  array  $bind     [where绑定的参数]
	 * @return [Array.list]           [返回的对应的列表数据]
	 * @return [Array.pageHtml]           [返回的分页html数据]
	 */
	public function getOfferProductList($page, $pagesize, $where='', $bind=array()){
		$query = new Query('product_offer as c');
		$query->fields = 'c.id, a.name, c.pro_name,b.name as cname, a.quantity,a.unit,a.freeze,a.sell, c.price, c.expire_time, c.status, c.mode, a.user_id, c.apply_time,c.max_num,c.sell_num';
		$query->join = '  LEFT JOIN products as a ON c.product_id=a.id LEFT JOIN product_category as b ON a.cate_id=b.id ';
		$query->page = $page;
		$query->pagesize = $pagesize;
		$query->order = 'c.id desc';
		// $query->order = ' a.create_time desc';

		$status = implode(',', array(self::OFFER_APPLY, self::OFFER_OK, self::OFFER_NG,self::OFFER_CANCEL,self::OFFER_COMPLETE,self::OFFER_WAITINGTRADE));
		$where .= ' AND c.status IN (' .$status. ')';
		if (empty($where)) {
			$where = ' AND c.mode IN (1, 2,3, 4) ';
		}else{
			$where .= ' AND c.mode IN (1, 2,3, 4) ';
			$query->bind = $bind;
		}
		$query->where = $where;
		$list = $query->find();
		foreach($list as $k=>$v){
			$list[$k]['status'] = $this->getStatus($list[$k]['status']);
			$list[$k]['left'] = min($v['quantity']-$v['freeze']-$v['sell'],$v['max_num']-$v['sell_num']);
		}
		return array('list' => $list, 'pageHtml' => $query->getPageBar());
	}

	/**
	 * 获取正在进行的产品列表
	 * @param  string $user_id    所属用户
	 * @param  array  $mode    报盘类型
	 * @return array   报盘数据
	 */
	public function getOkoffer( $user_id,$mode=array()){
		$query = new Query('product_offer as o');
		$query->fields = 'o.id,o.offer_no,o.mode,p.name,p.quantity-p.freeze-p.sell as leftnum,o.price';
		$query->join = '  LEFT JOIN products as p ON o.product_id=p.id  ';

		// $query->order = ' a.create_time desc';
		$where = '';
        if(!empty($mode)){
			$mode = join(',',$mode);
			$where .= 'o.mode in ('.$mode.') and';
		}
		else
			$mode = '';
		$where .= ' o.user_id='.$user_id.' and o.type=1 and  o.sub_mode=0 and o.status='.self::OFFER_OK.' and o.is_del=0 and o.expire_time>now()';

		$query->where = $where;
		$list = $query->find();
		foreach($list as &$item){
			$item['mode_txt'] = $this->getMode($item['mode']);
		}

		return  $list;
	}


	/**
	 * 获取对应id的报盘和产品详情数据
	 * @param  [Int] $id [报盘id]
	 * @return [Array]     [报盘和产品数据]
	 */
	public function getOfferProductDetail($id,$user_id){
		$query = new M('product_offer');
		$offerData = $query->where(array('id'=>$id,'user_id'=>$user_id))->getObj();
		$offerData['divide_txt'] = $this->getDivide($offerData['divide']);
		$offerData['status_txt'] = $this->getStatus($offerData['status']);
		$productData = $this->getProductDetails($offerData['product_id']);
		return array($offerData,$productData);
	}

	/*****推荐管理***************/


	public function offerRecommend($offer_id,$page=1){
	    //获取报盘的商品名、分类、属性
        $query = new Query('product_offer as o');
        $query->join = 'left join products as p on o.product_id=p.id';
        $query->fields = 'o.type,p.name,p.cate_id,p.attribute,o.id,p.id as pid';
        $query->where = 'o.id=:offer_id';
        $query->bind  = array('offer_id'=>$offer_id);
        $data = $query->getObj();
        if(empty($data)){
            return array();
        }

        //根据获取的名称、分类、属性，查找匹配的商品
        //获取分类的上级分类，再由上级分类找出其下级所有分类
        $cateObj = new M('product_category');
        $pid = $cateObj->where(array('id'=>$data['cate_id']))->getField('pid');
        $cldIds = '';//父分类相同的同级分类id
        if($pid){
            $childs = $cateObj->where(array('pid'=>$pid))->fields('id')->select();
            if(!empty($childs)){
                foreach($childs as $c){
                    if($c['id']==$data['cate_id'])
                        continue;
                    $cldIds .= $cldIds=='' ? $c['id'] : ','.$c['id'];
                }
            }

        }
        $search = new Query('products as p ');
        $search->join = 'left join product_offer as o on o.product_id=p.id';
        $now = date('Y-m-d');
        $where = 'o.expire_time>"'.$now.'" and o.status=1 AND o.max_num - o.sell_num>0 and ';
        $where .= $data['type']==1? ' o.type=2 and ' : 'o.type=1 and ';
        $where .= ' ((p.cate_id=:cate_id or p.name like "%'.$data['name'].'%")';
        $where .= $cldIds !='' ? ' OR (p.cate_id in('.$cldIds.')  or p.name like "%'.$data['name'].'%"))' : ')';
        $search->where = $where;
        $search->bind = array('cate_id'=>$data['cate_id']);
        $search->fields = ' o.id,o.accept_area,p.produce_area,p.id as pid,p.quantity as num,o.type,o.max_num,o.sell_num,p.name,o.price,o.price_l,o.price_r,p.unit';
        $search->page = $page;
        $search->pagesize = 5;
        $res = $search->find();//print_r($res);
        if(!empty($res)){
            foreach($res as  &$item){
                $item['last'] = $item['max_num'] - $item['sell_num'];
                $item['last'] = $item['last'] > 0 ? $item['last'] : 0;
            }
        }
        $bar = $search->getPageBar();
        return array('list'=>$res,'bar'=>$bar);

    }


}