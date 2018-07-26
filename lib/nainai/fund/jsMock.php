<?php
/**
 * 建设银行MOCK
 * author: liweiping
 * Date: 2018/7/26
 */

namespace nainai\fund;
use \Library\M;
use \Library\Time;
use \Library\tool;
use \nainai\fund\jianshe\common;
class jsMock extends account{


    private $headParams = array();
     private $mainacc = '';
    private $messageObj = null;//处理报文的对象
    private $communicateObj = null;//通信对象
    private $attachAccount = null;
    private $encoding = 'gb2312';
    private $config = array();
    private $errorText = '';//错误信息
    private $bankName  = 'js';
    private $bankTableObj = '';
    private $requestUrl = '/abutment/sendRequest';
     public function __construct()
     {

     }



    protected function createMessageProduct()
    {

    }

    protected function createCommunicateProduct()
    {

    }







    public function getActive($user_id)
    {
       return false;

    }

    public function getFreeze($user_id)
    {
        return false;
    }

    /**
     * 查询
     * @param int $user_id 用户id
     * @param array $cond 查询条件
     */
    public function getFundFlow($user_id=0,$cond=array())
    {
        return false;
    }

    /**
     * 获取市场账号流水
     * @param array $conf
     */
    public function marketFlow($conf = array())
    {
        if(isset($conf['start'])){
            $date = new \DateTime($conf['start']);
            $startDate = $date->format('Y-m-d');
        }else{
            $date = new \DateTime();
            $date->sub(new \DateInterval('P7D'));
            $startDate = $date->format('Y-m-d');
        }
        if(isset($conf['end'])){
            $date = new \DateTime($conf['end']);
            $endDate = $date->format('Y-m-d');
        }else{
            $date = new \DateTime();
            $endDate = $date->format('Y-m-d');
        }

        $obj = new M('mock_jsbank');
        $where = 'TX_DT>= "'.$startDate. '" AND TX_DT <="'.$endDate.'"';
        $data = $obj->where($where)->select();
        foreach($data as &$item){
            $item['TX_DT']  = str_replace('-','',$item['TX_DT']);
            $item['TX_TM']  = str_replace(':','',$item['TX_TM']).'000';
        }
        return $data;

    }


    /**
     * @param int $user_id 要冻结的用户id
     * @param float $num 金额
     * @param string $note
     * @param int $buyer_id 买方id
     * @param int $seller_id 卖方id
     * @param string $orderNo ,can't be empty
     * @param float $amount 合同总金额
     * @return bool|string
     */
    public function freeze($user_id, $num, $note = '',$buyer_id=0,$seller_id=0,$orderNo='',$amount=0)
    {

        return false;

    }



    /**
     * 买方支付给卖方货款，不存在卖方支付给买方的情况
     * @param int $from 买方id
     * @param int $to 卖方id
     * @param float $num 金额
     * @param string $note
     * @param string $orderNo  订单号,必须输入
     * @param int $payTime 付款批次
     * @param string $orderTime 订单时间
     */
    public function freezePay($from, $to, $num, $note = '',$orderNo='',$payTime=1,$orderTime='')
    {

    }


    /**
     * 交易终止冻结支付
     * @param $from
     * @param $num
     * @param string $note
     * @param int $buyer_id
     * @param int $seller_id
     * @param string $orderNo
     * @param int $payTime
     * @return bool|string
     */
    public function breakFreezePay($from, $num, $note = '',$buyer_id=0,$seller_id=0,$orderNo='',$payTime=1){

        return false;
    }

    public function freezeRelease($user_id, $num, $note,$buyer_id=0,$seller_id=0,$orderNo='',$amount=0)
    {

        return false;
    }

    /**
     * 强制付款通知,发起后才可以发起强制付款
     * @param int $buyer_id
     * @param int $seller_id
     * @param string $orderNo
     * @param float $amount
     * @param string $orderTime
     * @return bool|string
     */
    public function payNotice($buyer_id,$seller_id,$orderNo,$amount,$orderTime){
       return false;
    }

    public function in($user_id, $num , $note='')
    {
        return false;

    }

    public function payMarket($user_id, $num,$note='')
    {
         $bankObj = new \nainai\user\UserBank();
         $bankData = $bankObj->getBankInfo($user_id);
         if(empty($bankData)){
             return tool::getSuccInfo(0,'未开户');
         }

         $obj = new M('mock_jsbank');
         $data = array(
             'OP_ACCT_NO_32'=>$bankData['card_no'],
             'TX_AMT'=>$num,
             'OP_CUST_NAME'=>$bankData['true_name'],
             'TX_LOG_NO'=>tool::create_uuid(),
             'TX_DT'=>date('Y-m-d'),
             'TX_TM'=>date('H:i:s')
         );
         $res = $obj->data($data)->add();
         return $res ? true : false;

    }

    public function marketToUser($user_id, $num,$note='')
    {
            return false;

    }


    public function out($user_id,$num,$note='')
    {
            return false;

    }

    public function signedStatus($user_id)
    {
            return false;


    }

    public function transSigninfo($user_id)
    {
            return false;


    }

    public function sendOut($bankFlowno,$status=1){

            return false;

    }




}