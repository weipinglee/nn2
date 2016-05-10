<?php
/**
 * 出入金管理类
 * User: weipinglee
 * Date: 2016/5/10 0010
 * Time: 下午 1:27
 */
use \Library\M;
use \Library\tool;
class fundModel{

    private $outFundRules = array(
        array('id','number','id错误',0,'regex'),
        array('user_id','number','',0,'regex'),
        array('request_no','require','不为空'),
        array('amount','currency','货币错误',0,'regex'),
        array('acc_name','require','开户名必须填写',0,'regex'),
        array('bank_name','require','银行名称必填',0,'regex'),
        array('back_card','require','请填写银行卡号',0,'regex'),
       // array('note','mobile','手机号码错误',2,'regex'),
    );

    /**
     *
     * @param $user_id
     * @param $data
     * @return bool
     */
    public function fundOutApply($user_id,$data){

        $fundModel = \nainai\fund::createFund(1);
        $userFund = $fundModel->getActive($user_id);
        echo $userFund;
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
}