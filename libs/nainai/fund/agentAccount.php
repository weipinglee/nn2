<?php
/**
 * 代理账户管理类
 * author: weipinglee
 * Date: 2016/4/20
 * Time: 17:25
 */

namespace nainai\fund;
use \Library\M;
use \Library\Time;
 class agentAccount extends account{


     private $agentModel = null;
     private $agentTable = 'user_account';//代理账户数据表名
     private $fundFlowTable = 'user_fund_flow';//资金流水表

     private $errorCode = array(
         'fundLess' => array('code'=>-1,'info'=>'账户余额不足'),
         'fundWrong'=> array('code'=>-2,'info'=>'金额数据错误'),

     );

     /**
      * 生成一个流水号
      */
     private function createFlowNo(){
        return date('YmdHis').rand(100000,999999);
     }

     /**
      * 生成流水数据
      * @param int $user_id 用户id
      * @param float $num 更改金额
      * @param str $type 类型
      *
      */
     private function createFlowData($user_id,$num,$type){

         $this->agentModel->table($this->agentTable)->where(array('user_id'=>$user_id));
         $flow_data = array();

         $flow_data['flow_no'] = $this->createFlowNo();
         $flow_data['user_id'] = $user_id;
         $flow_data['time']    = Time::getDateTime();
         $flow_data['acc_type'] = 1;
         $fund = $this->agentModel->fields('fund,freeze')->getObj();//如金前的总金额

        switch($type){
            case 'in' : {
                $flow_data['fund_in'] = $num;
                $flow_data['total']   = $num + $fund['fund'];
                $flow_data['active']  = $num + $fund['fund'] - $fund['freeze'];
            }
            break;

            case 'freeze' : {
                $flow_data['freeze']  = $num;
                $flow_data['total']   = $fund['fund'] + $fund['freeze'] ;
                $flow_data['active']  = $flow_data['total']  -$fund['freeze'] - $flow_data['freeze'];
            }
        }

         return $this->agentModel->table($this->fundFlowTable)->data($flow_data)->add(1);



     }

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
        if(is_integer($num) || is_float($num)){
            $this->agentModel->beginTrans();

            $this->agentModel->table($this->agentTable)->where(array('user_id'=>$user_id))->setInc('fund',$num);//总帐户增加金额
            $this->createFlowData($user_id,$num,'in');
             return $this->agentModel->commit();
        }
        else{
            return $this->errorCode['fundWrong'];
        }


    }



    /**
     * 资金冻结
     * @param int $user_id 用户id
     * @param float $num 冻结金额
     */
    public function freeze($user_id,$num){
        if(is_integer($num) || is_float($num)){
            $fund = $this->agentModel->table($this->agentTable)->where(array('user_id'=>$user_id))->getField('fund');
            if($fund===false || $fund<$num)
                return $this->errorCode['fundLess'];
            $this->agentModel->beginTrans();
            $this->createFlowData($user_id,$num,'freeze');

            $sql = 'UPDATE '.$this->agentModel->table().
                ' SET fund = fund - :fund ,freeze = freeze + :fund  WHERE user_id = :user_id';
            $this->agentModel->query($sql,array('fund'=>$num,'user_id'=>$user_id));

            return $this->agentModel->commit();

        }
        else{
            return $this->errorCode['fundWrong'];
        }
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