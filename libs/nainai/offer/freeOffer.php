<?php
/**
 * 自由报盘管理类
 * author: weipinglee
 * Date: 2016/5/7
 * Time: 21:59
 */

namespace nainai\offer;
use nainai\fund;
class freeOffer extends product{



    /**
     * 获取自由报盘费率 TODO
     *
     */
    public function getFee(){
        return 100;
    }

    /**
     * 报盘申请插入数据
     * @param array $productData  商品数据
     * @param array $offerData 报盘数据
     *
     */
    public function doOffer($productData,$offerData){
        $user_id = $this->user_id;
        $acc_type = $offerData['acc_type'];
        $fund = fund::createFund($acc_type);
        $active = $fund->getActive($this->user_id);//获取用户可用金额
        $fee = $this->getFee();//获取自由报盘费用
        if($active >= $fee){
            $offerData['offer_fee'] = $fee;
            $offerData['user_id'] = $user_id;
            $offerData['mode'] = self::FREE_OFFER;
            $this->_productObj->beginTrans();
            $insert = $this->insertOffer($productData,$offerData);

            if($insert===true){
                $fund->freeze($user_id,$fee);
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
        else{//资金不足
            return $this->errorCode['fundLess'];
        }

    }

}