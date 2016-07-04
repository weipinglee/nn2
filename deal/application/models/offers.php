<?php
/**
 * User: maoyong
 * Date: 2016/5/17 0017
 * Time: ÏÂÎç 5:05
 */

use \Library\Query;
use \Library\M;
class offersModel extends \nainai\offer\product{

    private $offer;
    public function __construct(){
        $this->offer = new M('product_offer');
    }

    public function beginTrans(){
        $this->offer->beginTrans();
    }

    public function commit(){
        $this->offer->commit();
    }
    public function rollBack(){
        $this->offer->rollBack();
    }
    /**
     * »ñÈ¡²úÆ·¶ÔÓ¦·ÖÀàÏÂµÄµÄ±¨ÅÌÐÅÏ¢ÁÐ±í
     * @param  [Int] $cateId [·ÖÀàid]
     * @return [Array]
     */
    /**
     * ×Ô¶¨ÒåµÄmysqlº¯Êý
     * getChildLists(rootId)
     *  BEGIN
        DECLARE sTemp VARCHAR(1000);
        DECLARE sTempChd VARCHAR(1000);
        SET sTemp = '$';
        SET sTempChd =cast(rootId as CHAR);
        WHILE sTempChd is not null DO
        SET sTemp = concat(sTemp,',',sTempChd);
        SELECT group_concat(id) INTO sTempChd FROM nn.product_category where FIND_IN_SET(pid,sTempChd)>0;
        END WHILE;
        RETURN sTemp;
        END
     */
    public function getOfferCategoryList($cateId){
        $query = new Query('product_offer as a');
        $query->fields = 'a.id, a.type,a.accept_area, a.price, b.cate_id,b.id as product_id, b.name as pname, b.quantity, b.freeze,b.sell,b.unit,b.produce_area, c.name as cname ';
        $query->join = 'LEFT JOIN products as b ON a.product_id=b.id LEFT JOIN product_category as c ON b.cate_id=c.id LEFT JOIN admin_kefu as kefu on a.kefu = kefu.admin_id';
        $query->where = 'a.status='.self::OFFER_OK.' AND a.expire_time>now() AND find_in_set(b.cate_id, getChildLists(:cid))';
        $query->bind = array('cid' => $cateId);
        $query->order = 'a.apply_time desc';
        $query->limit = 5;
        $query->fields = 'a.id,a.type,a.accept_area,a.price,b.name as pname,b.id as product_id,b.quantity,b.sell,b.freeze,b.unit,b.produce_area,kefu.ser_name,kefu.qq';
        return $query->find();


    }


    /**
     * 获取所有子分类
     */
    private function getChildCate($pid,$level=1){
        static $cate = array();
        $obj = new M('product_category');
        $cates = $obj->where(array('pid'=>$pid))->fields('id,name')->select();
        static $childCates = array();
        static $childName = '';
        if($level==0){
            //获取下级分类统称
            $childName = $obj->where(array('id'=>$pid))->getField('childname');
            if(!$childName)
                $childName = '商品分类';
            $childCates = $cates;
        }
        foreach($cates as $k=>$v){
            $this->getChildCate($v['id']);
        }
        $cate = array_merge($cate,$cates);
        return array($cate,$childCates,$childName);
    }

    public function getList($page,$condition = array(),$order=''){
        $query = new Query('product_offer as o');
        $query->join = "left join products as p on o.product_id = p.id LEFT JOIN product_category as c ON p.cate_id=c.id";
        $query->fields = "o.*,p.cate_id,p.name,p.quantity,p.freeze,p.sell,p.unit,o.price,o.accept_area,p.produce_area,p.id as product_id, c.name as cname";
        $where = 'o.status=:status and p.quantity>p.sell+p.freeze and o.expire_time > now()';
        $bind = array('status'=>self::OFFER_OK);
        //获取分类条件
        $childcates = array();
        $childname = '';
        if(isset($condition['pid']) && $condition['pid']>0) {
            $cates = $this->getChildCate($condition['pid'],0);
            $childname = $cates[2];
            $cate_ids = array();
            $cate_ids[] = $condition['pid'];
            foreach($cates[0] as $v){
                $cate_ids[] = $v['id'];
            }
            $cate_ids = join(',',$cate_ids);
            $where .= ' and c.id in ('.$cate_ids.')';

            $childcates = $cates[1];

        }

        //获取报盘类型条件
        if(isset($condition['type']) && $condition['type']!=0){
            $where .= ' and o.type=:type';
            $bind['type'] = $condition['type'];
        }

        //获取报盘类型
        if(isset($condition['mode']) && $condition['mode']!=0){
            $where .= ' and o.mode=:mode';
            $bind['mode'] = $condition['mode'];
        }

        //获取地区条件
        if(isset($condition['area']) && $condition['area']!=0){
            $where .= ' and left(p.produce_area,2) = :area ';
            $bind['area'] = $condition['area'];
        }

        //获取搜索条件
        if(isset($condition['search']) && $condition['search']!=''){
            $where .= ' and p.name like "%'.$condition['search'].'%" ';
        }

        $query->where = $where;
        $query->bind = $bind;

        $query->page = $page;
        $query->pagesize = 20;
        if($order=='')
            $query->order = "o.apply_time desc";
        else {
            $query->order = $order;
        }
        $data = $query->find();
        foreach ($data as $key => &$value) {
            $value['mode_txt'] = $this->offerMode($value['mode']);
            $value['img'] = empty($value['img']) ? 'no_picture.jpg' : $value['img'];//获取缩略图
            $value['left'] = number_format(floatval($value['quantity']) - floatval($value['freeze']) - floatval($value['sell']));
        }
        $pageBar =  $query->getPageBar();
        return array('data'=>$data,'bar'=>$pageBar,'cate'=>$childcates,'childname'=>$childname);
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
        $query->fields = "o.*,p.cate_id,p.name,pp.img,p.quantity,p.freeze,p.sell,p.unit, o.expire_time";
        $query->where = 'o.id = :id';
        $query->bind = array('id'=>$id);
        $res = $query->getObj();

        if(!empty($res)){
            $res['mode_text'] = $this->offerMode($res['mode']);


            $res['img'] = empty($res['img']) ? 'no_picture.jpg' : \Library\thumb::get($res['img'],100,100);//获取缩略图
            $res['left'] = floatval($res['quantity']) - floatval($res['freeze']) - floatval($res['sell']);
            


            if($res['divide']==self::UNDIVIDE)
                $res['minimum'] = $res['quantity'];
        }


        return $res ? $res : array();
    }

    //获取报盘类型
    public function offerType($id){
        return intval($this->offer->where(array('id'=>$id))->getField('mode'));
    }

    /**
     * 获取统计报盘的数量
     * @return Int
     */
    public function getOfferNum(){
        return $this->offer->table('products')->fields('COUNT(id) as num ')->where('quantity-sell > 0')->getObj();
    }

    /**
        * 获取某一分类的所有祖先分类
        * @param
    */
    public function getCateTopList($cate){
        if(intval($cate)>0){
            $cate = intval($cate);
            $parent = array();
            $obj = new M('product_category');
            $pid = $obj->where(array('id'=>$cate))->getField('pid');
            if($pid==0)
                $parent[] = $cate;
            while($pid!=0){
                $parent[] = $pid;
                $pid = $obj->where(array('id'=>$pid))->getField('pid');
            }
            return array_reverse($parent);
        }
        return array();

    }

}