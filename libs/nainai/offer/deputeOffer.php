<?php
/**
 * 委托报盘管理
 * author: weipinglee
 * Date: 2016/5/7
 * Time: 23:43
 */

namespace nainai\offer;

class deputeOffer extends product{

    /**
     * 获取委托报盘费率
     * @return int
     */
    public function getFeeRate($user_id){
        return 20;
    }


    /**
     * 报盘插入数据
     * @param array $productData  商品数据
     * @param array $offerData 报盘数据
     */
    public function doOffer($productData,$offerData){
        $offerData['mode'] = self::DEPUTE_OFFER;
        $this->_productObj->beginTrans();
        $offerData['user_id'] = $this->user_id;
        $insert = $this->insertOffer($productData,$offerData);

        if($insert===true){
            if($this->_productObj->commit()){
                return true;
            }
            else return $this->errorCode['server'];
        }
        else{
            $this->_productObj->rollBack();
            $this->errorCode['dataWrong']['info'] = $insert;
            return $this->errorCode['dataWrong'];
        }
    }
}