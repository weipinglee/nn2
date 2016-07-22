<?php
/**
 * 中信银行银企直连
 * author: panduo
 * Date: 2016/7/16
 */

namespace nainai\fund;
use \Library\M;
use \Library\Time;
use \Library\tool;
class zx extends account{

     private $agentModel = null;
     private $flowModel  = null;
     private $attachAccount = null;
     private $agentTable = 'user_account';//代理账户数据表名
     private $fundFlowTable = 'user_fund_flow';//资金流水表

     const USERNAME = 'NNYS';//中信银行前置机登陆名
     const MAINACC = '8110701013900006451';//主体账户
     const XML_PREFIX = '<?xml version="1.0" encoding="GBK"?>';//XML结构头
     const BANK = 'zx';

     public function __construct(){
        $this->agentModel = new M($this->agentTable);
        $this->flowModel  = new M($this->fundFlowTable);
        $this->attachAccount = new attachAccount();

     }

     /**
      * 保存主账户附属账户
      * @param  int $user_id 用户id
      * @return string  反馈信息
      */
     public function saveAttachAccount($user_id,$attach_no = 'test'){
        //先判断此用户是否已有对应银行附属账户
        $info = $this->attachAccountInfo($user_id);
        if($info){
            return '已有附属账户';
        }else{
            $res = $this->attachAccount->addAttach(array('user_id'=>$user_id,'no'=>$attach_no,'bank'=>'zx','time'=>date('Y-m-d H:i:s',time())));
            return $res;
        }
     }
     
     /**
      * 获取指定用户附属账户信息    
      * @param  int $user_id 用户id   
      * @return array 
      */
     public function attachAccountInfo($user_id){
        return $this->attachAccount->attachInfo($user_id,'zx');
     }


    /**
     * 获取可用余额
     * @param int $user_id
     */
    public function getActive($user_id){
        //TODO 
        
    }

    /**
     * 获取冻结资金金额
     * @param int $user_id 用户id
     */
    public function getFreeze($user_id){
        //TODO
    }

     /**
      * 获取资金流水表
      * @param int $user_id
      * @param int $where 查询条件 ‘begin'开始时间，’end'结束时间，'no'序列号
      */
     public function getFundFlow($user_id=0,$cond=array()){
         if($user_id){
             $where = 'user_id = :user_id ';
             $cond['user_id'] = $user_id;
             if(isset($cond['begin'])&& $cond['begin']!=''){
                 $where .= ' AND time > :begin';
             }
             else{
                 unset($cond['begin']);
             }
             if(isset($cond['end'])&& $cond['end']!=''){
                 $where  .= ' AND time < :end';
             }
             else{
                 unset($cond['end']);
             }

             if(isset($cond['no']) && $cond['no']!=''){
                 $where  .= ' AND flow_no = :no';
             }
             else{
                 unset($cond['no']);
             }

             $this->flowModel->bind($cond);

             return $this->flowModel->where($where)->bind($cond)->order('time DESC')->select();
         }
     }
    
     public function in($user_id,$num){
         
     }

    
     public function out($user_id){
        $accInfo = $this->attachAccount->attachInfo($user_id);
        $clientID = tool::create_uuid($user_id);
        $xml = self::XML_PREFIX."
            <stream>
                <action>DLFNDOUT</action>
                    <userName>".self::USERNAME."</userName>
                <clientID>{$clientID}</clientID>
                <accountNo>{$accInfo['no']}</accountNo>
                <recvAccNo></recvAccNo>
                <recvAccNm></recvAccNm><!--收款账户名称varchar(122)-->
                <tranAmt></tranAmt><!--交易金额decimal(15,2)-->
                <sameBank></sameBank><!--中信标识char(1) 0：本行 1： 他行-->
                <!--收款账户开户行信息begin-->
                <!--收款账户若为他行，则收款账户开户行支付联行号与收款账户开户行名至少一项不为空-->
                <recvTgfi></recvTgfi><!--收款账户开户行支付联行号varchar(20)-->
                <recvBankNm></recvBankNm><!--收款账户开户行名varchar (122)-->
                <!--收款账户开户行信息end-->
                <memo></memo><!--摘要varchar(102) 可空-->
                <preFlg></preFlg><!--预约标志（0：非预约1：预约）char(1)-->
                <preDate></preDate><!--预约日期（格式：YYYYMMDD 预约时非空）char(8)-->
                <preTime></preTime><!--预约时间（格式：hhmmss 预约时非空，只限100000、120000、140000、160000四个时间点）char(6)-->
            </stream>";
     }


    /**
     * 资金冻结
     * @param int $user_id 用户id
     * @param float $num 冻结金额
     */
    public function freeze($user_id,$num,$note=''){
         return $this->bankTransfer($num,$user_id,0,'freeze',$note);
    }

    
    /**
     * 冻结资金释放
     * @param int $user_id
     * @param float $num 释放金额
     */
    public function freezeRelease($user_id,$num,$note=''){
        return $this->bankTransfer($num,$user_id,0,'freezeRelease',$note);
    }

    /**
     * 冻结资金支付
     * 将冻结资金解冻，支付给另外一个用户
     * @param int $from 冻结账户用户id
     * @param int $to  转到的账户用户id,0代表市场
     * @param float $num 转账的金额
     *
     */
    public function freezePay($from,$to=0,$num,$note=''){
        return $this->bankTransfer($num,$from,$to,'freezePay',$note);
    }

    /**
     * 可用余额直接付款给市场
     * @param int $user_id 支付用户id
     * @param float $num 转账的金额
     */
    public function payMarket($user_id,$num,$note=''){
        
    }

    /**
     * 资金初始化
     * @param  string $subAccNo 附属账号
     * @param  string $subAccNm 附属账户名称
     * @param  float  $num      初始金额
     * @param  string $memo     摘要
     * @return 
     */
    public function acountInit($subAccNo,$subAccNm,$num=0.0,$memo=''){
        $clientID = '9828382382';
        $xml = self::XML_PREFIX."
            <stream>
                <action>DLFNDINI</action>
                <userName>".self::USERNAME."</userName>
                <clientID>{$clientID}</clientID>
                <accountNo>3110710003081005213</accountNo>
                <subAccNo>{$subAccNo}</subAccNo>
                <subAccNm>{$subAccNm}</subAccNm>
                <tranAmt>{$num}</tranAmt>
                <memo></memo>
            </stream>";
        return $this->attachAccount->curl($xml);
    }

    /**
     * 附属账户签约
     * @param  array  $data 相关数据数组
     * @return true/string
     */
    public function geneAttachAccount($data=array()){
        //判断对应user_id是否已有附属账户
        $data['bank'] = self::BANK;
        $accInfo = $this->attachAccount->attachInfo($data['user_id']);
        if(!($data['user_id'] && $data['name'] && $data['id_card'] && $data['contact_name'] && $data['contact_phone'] && $data['mail_address'])){
            $res = '参数错误';
        }elseif($accInfo){
            $res = '已有附属账户';
        }else{
            $xml = self::XML_PREFIX."
                <stream>
                    <action>DLBREGSN</action>
                    <userName>".self::USERNAME."</userName>
                    <mainAccNo>".self::MAINACC."</mainAccNo>
                    <appFlag>2</appFlag>
                    <accGenType>0</accGenType>
                    <subAccNo></subAccNo>
                    <subAccNm>王五</subAccNm>
                    <accType>03</accType>
                    <calInterestFlag>0</calInterestFlag>
                    <interestRate></interestRate>
                    <overFlag>0</overFlag>
                    <overAmt></overAmt>
                    <overRate></overRate>
                    <autoAssignInterestFlag>0</autoAssignInterestFlag>
                    <autoAssignTranFeeFlag>0</autoAssignTranFeeFlag>
                    <feeType>0</feeType>
                    <realNameParm>0</realNameParm>
                    <subAccPrintParm>0</subAccPrintParm>
                    <mngNode>231001</mngNode>
                    <vtlCustNm>{$data['name']}</vtlCustNm>
                    <legalPersonNm>asdsad</legalPersonNm>
                    <custCertType>0</custCertType>
                    <custCertNo>{$data['id_card']}</custCertNo>
                    <branch>024</branch>
                    <commAddress>sbbbs</commAddress>
                    <list name='VilcstDataList'>
                        <row>
                        <contactName>{$data['contact_name']}</contactName>
                        <contactPhone>{$data['contact_phone']}</contactPhone>
                        <mailAddress>{$data['mail_address']}</mailAddress>
                        </row>
                    </list>
                </stream>";
            $res = $this->attachAccount->curl($xml);
            if($res['status'] == 'AAAAAAA'){
                //成功  插入数据
                $data['no'] = $res['subAccNo'];
                $data['name'] = iconv('utf-8','gbk',$res['subAccNm']);

                $res = $this->attachAccount->addAttach($data);

            }else{
                $res = $res['statusText'];
            }
        }

        return $res === true ? tool::getSuccInfo() : tool::getSuccInfo(0,$res);
    }

    /**
     * 根据交易类型生成不同的银行报文
     * @param  float $num 交易数额
     * @param  int $from 付款方id
     * @param  int $to 收款方id
     * @param  string $type 交易类型（方法名）
     * @return 银行返回信息 成功为true  失败为具体信息字符串
     */
    public function bankTransfer($num,$from = 0,$to = 0,$type,$memo=''){
        if(!intval($from)) return '付款账户未指定';
        if(floatval($num) <= 0) return '交易数额错误';
        $type_txt = '';
        switch ($type) {
            case 'freeze':
                //冻结付款方账户
                $type_txt = 'BR';
                break;
            case 'freezeRelease':
                //解冻付款方账户
                $type_txt = 'BG';
                break;
            case 'freezePay':
                //解冻支付
                $type_txt = 'BH';
                break;
            default:
                return '交易类型未指定';
                break;
        }
        $clientID = tool::create_uuid();//交易流水号
        $payAccInfo = $this->attachAccount->attachInfo($from);
        $recvAccInfo = intval($to) ? $this->attachAccount->attachInfo(intval($to)) : array('no'=>'','name'=>'');

        //TODO  冻结编号查询
        
        
        //强制转账报文
        $xml = self::XML_PREFIX."
            <stream>
                <action>DLMDETRN</action>
                <userName>".self::USERNAME."</userName>
                <clientID>{$clientID}</clientID>
                <accountNo>".self::MAINACC."</accountNo>
                <payAccNo>{$payAccInfo['no']}</payAccNo>
                <tranType>{$type_txt}</tranType>
                <recvAccNo>{$recvAccInfo['no']}</recvAccNo>
                <recvAccNm>{$recvAccInfo['name']}</recvAccNm>
                <tranAmt>{$num}</tranAmt>
                <freezeNo></freezeNo>
                <memo>{$memo}</memo>
                <tranFlag>1</tranFlag>
            </stream>";
        $res = $this->attachAccount->curl($xml);
        return $res;

    }

    /**
     * 交易状态查询
     * @param string $clientID 原操作流水号
     * @return 成功:true 失败:string
     */
    public function transStatus($clientID){
        $xml = self::XML_PREFIX."
            <stream>
                <action>DLCIDSTT</action>
                <userName>".self::USERNAME."</userName>
                <clientID>{$clientID}</clientID>
            </stream>";
        $res = $this->attachAccount->curl($xml);
        return $res;
    }

    /**
     * 查询指定附属账户余额   
     * @param  string $subAccNo 附属账号
     * @return array:账户余额数组 string:错误信息
     */
    public function attachBalance($subAccNo){
        $xml = self::XML_PREFIX."
            <stream>
                <action>DLSBALQR</action>
                <userName>".self::USERNAME."</userName>
                <accountNo>".self::MAINACC."</accountNo>
                <subAccNo>{$subAccNo}</subAccNo>
            </stream>";
        $res = $this->attachAccount->curl($xml);
        return $res;
    }

    /**
     * 查询指定附属账户交易明细(10条/次)
     * @param  string $subAccNo 附属账户
     * @return array:明细信息数组 string:错误信息
     */
    public function attachTransDetails($subAccNo){
        $xml = self::XML_PREFIX."
            <stream>
            <action>DLSTRNDT</action>
                <userName>".self::USERNAME."</userName>
                <accountNo>".self::MAINACC."</accountNo>
                <subAccNo>{$subAccNo}</subAccNo>
                <queryType></queryType>
                <startDate></startDate>
                <endDate></endDate>
                <tranType></tranType>
                <startRecord></startRecord>
                <pageNumber>10</pageNumber>
            </stream>";
        $res = $this->attachAccount->curl($xml);
        return $res;
    }

}