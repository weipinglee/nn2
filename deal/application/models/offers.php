<?php
/**
 * User: maoyong
 * Date: 2016/5/17 0017
 * Time: 下午 5:05
 */

use \Library\Query;
class offersModel extends \nainai\offer\product{

    /**
     * 获取产品对应分类下的的报盘信息列表
     * @param  [Int] $cateId [分类id]
     * @return [Array]
     */
    /**
     * 自定义的mysql函数
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
}