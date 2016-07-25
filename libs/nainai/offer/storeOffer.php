<?php
/**
 * 自由报盘管理类
 * author: weipinglee
 * Date: 2016/5/7
 * Time: 21:59
 */

namespace nainai\offer;
use nainai\fund;
use \Library\tool;
use \Library\M;
class storeOffer extends product{


    /**
     * 仓单报盘数据添加
     * @param int $id 仓单id
     * @param  [Array] $productOffer [报盘的数据]
     * @return [Array]
     */
    public function insertStoreOffer($id, & $productOffer){
        $productOffer['expire_time'] = $this->getExpireTime();
        if ($this->_productObj->validate($this->productOfferRules, $productOffer)) {
            $productOffer['mode'] = self::STORE_OFFER;

            $obj = new M('store_products');
            $obj->beginTrans();
            $obj->data(array('is_offer'=>1))->where(array('id'=>$id))->update();//更改为已报盘
            $this->_productObj->table('product_offer')->data($productOffer)->add();
            $res = $obj->commit();
        }else{
            $res = $this->_productObj->getError();
        }

        if ($res===true) {
            return Tool::getSuccInfo(1, '报盘成功');
        }else{
            return Tool::getSuccInfo(0,is_string($res) ? $res : '系统繁忙，请稍后再试');
        }
    }

    /**
     * 获取仓库详情
     * @param  integer $id     id
     * @param  string  $fields 字段
     * @return Array          
     */
    public function getStoreListDetail($id = 0, $fields='*'){
        $detail = array();
        if (intval($id) > 0) {
            $where = array('id' => $id);
            $detail = $this->_productObj->table('store_list')->fields($fields)->where($where)->getObj();
        }
        return $detail;
    }

}