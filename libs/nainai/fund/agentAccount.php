<?php
/**
 * 代理账户管理类
 * author: weipinglee
 * Date: 2016/4/20
 * Time: 17:25
 */

namespace nainai\fund;
use \Library\M;
 class agentAccount extends account{


     private $agentModel = null;
     private $agentTable = 'user_account';//代理账户数据表名

     private $errorCode = array(
         'fundLess' => '账户余额不足',
     );


     public function __construct(){
        $this->agentModel = new M($this->agentTable);
     }
    /**
     * 获取可用余额
     * @param int $user_id
     */
    public function getActive($user_id){
        $agentData = $this->agentModel->fields('fund,freeze')->where(array('user_id'=>$user_id))->getObj();
        if(!empty($agentData)){
            $active = $agentData['fund']-$agentData['freeze'];
            return $active>0 ? $active : 0;
        }
        return 0;
    }

    /**
     * 获取冻结资金金额
     * @param int $user_id 用户id
     */
    public function getFeeze($user_id){
        $agentData = $this->agentModel->fields('freeze')->where(array('user_id'=>$user_id))->getObj();
        if(!empty($agentData)){
            return $agentData['freeze']>0 ? $agentData['freeze'] : 0;
        }
        return 0;
    }
    /**
     * 入金操作
     * @param int $user_id 用户id
     * @param $num float 入金金额
     */
    public function in($user_id,$num){
        return $this->agentModel->where(array('user_id'=>$user_id))->setInc('fund',$num);
    }



    /**
     * 资金冻结
     * @param int $user_id 用户id
     * @param float $num 冻结金额
     */
    public function freeze($user_id,$num){
        //$this->agentModel->beginTrans();
        $fund = $this->agentModel->where(array('user_id'=>$user_id))->getField('fund');

        if($fund===false || $fund<$num)
            return $this->errorCode['fundLess'];
        $res = $this->agentModel
            ->where(array('user_id'=>$user_id))
            ->data(array('fund'=>'fund - :num1','freeze'=>'freeze - :num2'))
            ->bind(array('num1'=>$num,'num2'=>$num))
            ->update();
echo 123;

        return $res;
       // return $this->agentModel->commit();
    }

    /**
     * 冻结资金释放
     * @param int $user_id
     * @param float $num 释放金额
     */
    public function freezeRelease($user_id,$num){
        $this->agentModel->where(array('user_id'=>$user_id))->setInc('fund',$num);
        $this->agentModel->where(array('user_id'=>$user_id))->setDec('freeze',$num);
    }

    /**
     * 冻结资金支付
     * 将冻结资金解冻，支付给另外一个用户
     * @param int $from 冻结账户用户id
     * @param int $to  转到的账户用户id
     * @param float $num 转账的金额
     *
     */
    public function freezePay($from,$to,$num){

    }

    /**
     * 可用余额直接付款给市场
     * @param int $user_id 支付用户id
     * @param float $num 转账的金额
     */
    public function payMarket($user_id,$num){

    }


}