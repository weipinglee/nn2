<?php
/**
 * 出入金管理类
 * User: weipinglee
 * Date: 2016/5/10 0010
 * Time: 下午 1:27
 */
use \Library\M;
use \Library\tool;
class fundModel extends \nainai\user\UserBank{

    /**
     *
     * @param $user_id
     * @param $data
     * @return bool
     */
    public function fundOutApply($user_id,$data){

        $fundModel = \nainai\fund::createFund(1);
        $userFund = $fundModel->getActive($user_id);

        $amount = $data['amount'];
        $withdrawRequest = new M('withdraw_request');
        if ($userFund != 0 && $userFund > $amount) {
            $check = $withdrawRequest->validate($this->outFundRules,$data);
            if(false == $check)
                 return tool::getSuccInfo(0,$withdrawRequest->getError());

            $withdrawRequest->beginTrans();
            $withdrawRequest->data($data)->add();

            //冻结资金
            $fundModel->freeze($user_id, $amount);

            $res = $withdrawRequest->commit();
            if($res){
                return tool::getSuccInfo();
            }
            else{
                return tool::getSuccInfo(0,'提现失败');
            }

        } else {

            return tool::getSuccInfo(0,'账户资金不足');
        }
    }


    /**
     * 插入更新开户信息
     * @param $data
     * @return \Library\查询结果|string
     */
    public function bankUpdate($data){
        $userBank=new M('user_bank');
        $data['status'] = self::BANK_APPLY;
        if($userBank->validate($this->bankRules,$data)){
            $res = $userBank->insertUPdate($data,$data);
        }
        else{
            $res = $userBank->getError();
        }

        if(is_int($res)){
            return tool::getSuccInfo();
        }
        else{
            return tool::getSuccInfo(0,is_string($res)?$res : '操作失败');
        }
    }


}