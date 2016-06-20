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
        $query->fields = 'a.id, accept_area, a.price, b.cate_id, b.name as pname, b.quantity, b.produce_area, c.name as cname';
        $query->join = 'LEFT JOIN products as b ON a.product_id=b.id LEFT JOIN product_category as c ON b.cate_id=c.id';
        $query->where = ' find_in_set(b.cate_id, getChildLists(:cid))';
        $query->bind = array('cid' => $cateId);
        $query->order = 'a.apply_time desc';
        $query->limit = 5;

        return $query->find();


    }


    /**
     * 获取所有子分类
     */
    private function getChildCate($pid){
        static $cate = array();
        $obj = new M('product_category');
        $cates = $obj->where(array('pid'=>$pid))->fields('id,name')->select();

        foreach($cates as $k=>$v){
            $this->getChildCate($v);
        }
        $cate = array_merge($cate,$cates);
        return $cate;
    }

    public function getList($page,$condition = array(),$order=''){
        $query = new Query('product_offer as o');
        $query->join = "left join products as p on o.product_id = p.id LEFT JOIN product_category as c ON p.cate_id=c.id";
        $query->fields = "o.*,p.cate_id,p.name,p.quantity,p.freeze,p.sell,p.unit,o.price,o.accept_area,p.produce_area,p.id as product_id, c.name as cname";
        $where = 'o.status=:status and p.quantity>p.sell+p.freeze ';
        $bind = array('status'=>self::OFFER_OK);
        //获取分类条件
        $cates = array();
        if(isset($condition['pid']) && $condition['pid']>0) {
            $cates = $this->getChildCate($condition['pid']);
            $cate_ids = array();
            $cate_ids[] = $condition['pid'];
            foreach($cates as $v){
                $cate_ids[] = $v['id'];
            }
            $cate_ids = join(',',$cate_ids);
            $where .= ' and c.id in ('.$cate_ids.')';
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

        $query->where = $where;
        $query->bind = $bind;

        $query->page = $page;
        $query->pagesize = 5;
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
        return array('data'=>$data,'bar'=>$pageBar,'cate'=>$cates);
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

}