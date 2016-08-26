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
        $clientID = tool::create_uuid($user_id);
        return $this->bankTransfer($clientID,$num,$user_id,0,'freeze');
    }

    
    /**
     * 冻结资金释放
     * @param int $user_id
     * @param float $num 释放金额
     */
    
    public function freezeRelease($user_id,$num,$time=''){
        $freeze_records = $this->freezeTrans($user_id,$time);
        $djcode = $this->getFreezeCode($freeze_records,$num);
        if(!$djcode) return '无效冻结金额';
        return $this->bankTransfer('',$num,$user_id,0,'freezeRelease','',$djcode);
    }

    /**
     * 冻结资金支付
     * 将冻结资金解冻，支付给另外一个用户
     * @param int $from 冻结账户用户id
     * @param int $to  转到的账户用户id,0代表市场
     * @param mixed $num 转账的金额
     *
     */

    public function freezePay($from,$to=0,$num,$time='',$amount=''){
        $freeze_records = $this->freezeTrans($from,$time);//加缓存TODO
        if(is_array($num)){
            $temp = array();
            $freeze_nos = array();
            foreach ($num as $key=>$value) {
                $code = $this->getFreezeCode($freeze_records,$amount ? $amount[$key] : $value,$temp);
                if($code){
                    $freeze_nos [$value]= $code;
                    $temp []= $value;
                }else{
                    return '冻结信息获取错误:'.$value;
                }
            }

            foreach ($freeze_nos as $amount => $code) {
                $res = $this->bankTransfer('',$amount,$from,$to,'freezePay','',$code);   
                if($res !== true){
                    return $res['info'];
                }
            }
        }else{
            $code = $this->getFreezeCode($freeze_records,$amount ? $amount : $num);
            if(!$code) return '冻结信息获取错误:'.($amount ? $amount : $Num);
            $res = $this->bankTransfer('',$num,$from,$to,'freezePay','',$code); 
            if($res !== true){
                return $res['info'];
            }  
        }
        return true;
        
    }

    /**
     * 强制转账
     * @param  int $from 付款用户id
     * @param  int $to   收款用户id
     * @param  float $num  金额
     */
    public function transfer($from,$to,$num){
        return $this->bankTransfer('',$num,$from,$to,'transfer');

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

    public function acountInit($user_id,$num=0.0,$memo=''){
        $clientID = tool::create_uuid($user_id);
        $payAccInfo = $this->attachAccount->attachInfo($user_id);

        $xml = self::XML_PREFIX."
            <stream>
                <action>DLFNDINI</action>
                <userName>".self::USERNAME."</userName>
                <clientID>{$clientID}</clientID>

                <accountNo>3110710003081005215</accountNo>
                <subAccNo>{$payAccInfo['no']}</subAccNo>
                <subAccNm>{$payAccInfo['name']}</subAccNm>

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

        if(!($data['user_id'] && $data['legal'] && $data['name'] && $data['id_card'] && $data['address'] && $data['contact_name'] && $data['contact_phone'] && $data['mail_address'])){

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

                    <subAccNm>{$data['name']}</subAccNm>

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

                    <vtlCustNm>vtlcus</vtlCustNm>
                    <legalPersonNm>{$data['legal']}</legalPersonNm>
                    <custCertType>0</custCertType>
                    <custCertNo>{$data['id_card']}</custCertNo>
                    <branch>024</branch>
                    <commAddress>{$data['address']}</commAddress>

                    <list name='VilcstDataList'>
                        <row>
                        <contactName>{$data['contact_name']}</contactName>
                        <contactPhone>{$data['contact_phone']}</contactPhone>
                        <mailAddress>{$data['mail_address']}</mailAddress>
                        </row>
                    </list>
                </stream>";

                // var_dump($xml);exit;
            $res = $this->attachAccount->curl($xml);
            
            if($res['status'] == 1){

                //成功  插入数据
                $data['no'] = $res['subAccNo'];
                $data['name'] = iconv('utf-8','gbk',$res['subAccNm']);

                $res = $this->attachAccount->addAttach($data);

            }else{

                $res = $res['info'];

            }
        }

        return $res === true ? tool::getSuccInfo() : tool::getSuccInfo(0,$res);
    }

    /**
     * 根据交易类型生成不同的银行报文
     * @param  string $clientID 流水号
     * @param  float $num 交易数额
     * @param  int $from 付款方id
     * @param  int $to 收款方id
     * @param  string $type 交易类型（方法名）
     * @return 银行返回信息 成功为true  失败为具体信息字符串
     */

    public function bankTransfer($clientID,$num,$from = 0,$to = 0,$type,$memo='',$freezeno=''){
        $clientID = $clientID ? $clientID : tool::create_uuid($from);

        if(!intval($from)) return '付款账户未指定';
        if(floatval($num) <= 0) return '交易数额错误';
        $type_txt = '';
        switch ($type) {

            case 'transfer':
                //转账
                $type_txt = 'BF';
                break;
            case 'freeze':
                //冻结付款方账户
                $type_txt = 'BR';
                break;
            case 'freezeRelease':
                //解冻付款方账户
                $type_txt = 'BG';

                $to = $from;
                // $freezeInfo = $this->freezeTrans($from,'20160727');

                break;
            case 'freezePay':
                //解冻支付
                $type_txt = 'BH';
                break;
            default:
                return '交易类型未指定';
                break;
        }

        $payAccInfo = $this->attachAccount->attachInfo($from);
        $recvAccInfo = intval($to) ? $this->attachAccount->attachInfo(intval($to)) : array('no'=>'','name'=>'');

        
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

                <freezeNo>{$freezeno}</freezeNo>
                <memo>{$memo}</memo>
                <tranFlag>1</tranFlag>
            </stream>";

        $res = $this->attachAccount->curl($xml);
        // var_dump($res);exit;
        return $res['status'] == 1 ? true : $res['info'];

    }

    /**
     * 获取指定冻结金额的冻结编号
     * @param  array $records 冻结记录
     * @param  float $amount 冻结金额
     * @param  array $exist  已有冻结编号数组(用于同时取得多个冻结编号 防止重复)
     * @param  string $djtype 冻结类型  默认冻结
     * @return string  冻结编号
     */
    public function getFreezeCode($records,$amount,$exist=array(),$djtype='4'){
        $amount = number_format($amount,2);
        if($records['status'] == 1){
            foreach ($records['row'] as $key => $value) {
                if($value['DJAMT'] == $amount && $value['JDTIME'] == '000000' && $value['DJTYPE'] == $djtype){
                    if(in_array($value['DJCODE'],$exist)){
                        continue;
                    }else{
                        return $value['DJCODE'];
                    }
                }
            }
        }else{
            return '';
        }
        return '';
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

                <type>DLMDETRN</type>
            </stream>";
        $res = $this->attachAccount->curl($xml);
        return $res;
    }

    /**
     * 附属账户冻结信息查询
     * @param  int $user_id 用户id
     * @param  datetime $date 冻结时间
     * @return array 
     */
    public function freezeTrans($user_id,$date){
        $date = strlen($date)<=8 ? $date : '';
        $payAccInfo = $this->attachAccount->attachInfo($user_id);
       // var_dump($payAccInfo);exit;
        $starDate = $date ? date('Ymd',strtotime($date)) : date('Ymd',time()-86400*90);
        $endDate = $date ? date('Ymd',strtotime($date)+86400*90) : date('Ymd',time());
        $xml = self::XML_PREFIX."
            <stream>
                <action>DLSFRZQR</action>
                <userName>".self::USERNAME."</userName>
                <accountNo>".self::MAINACC."</accountNo>
                <subAccNo>{$payAccInfo['no']}</subAccNo>
                <startDate>{$starDate}</startDate>
                <endDate>{$endDate}</endDate>
            </stream>";
        $res = $this->attachAccount->curl($xml);
        return $res;
    }

    /**
     * 查询指定附属账户余额
     * @param  int $user_id 用户id
     * @return array:账户余额数组 string:错误信息
     */
    public function attachBalance($user_id){

        $payAccInfo = $this->attachAccount->attachInfo($user_id);

        $xml = self::XML_PREFIX."
            <stream>
                <action>DLSBALQR</action>
                <userName>".self::USERNAME."</userName>
                <accountNo>".self::MAINACC."</accountNo>

                <subAccNo>{$payAccInfo['no']}</subAccNo>
            </stream>";
        $res = $this->attachAccount->curl($xml);
        
        // return $res;
        return $res['row'] ? $res['row'] : array();

    }

    /**
     * 查询指定附属账户交易明细(10条/次)
     * @param  int $user_id 用户id
     * @return array:明细信息数组 string:错误信息
     */
    public function attachTransDetails($user_id,$where=array('startDate'=>'20160601','endDate'=>'20160726')){
        $payAccInfo = $this->attachAccount->attachInfo($user_id);
        if(!$payAccInfo) return array();

        $xml = self::XML_PREFIX."
            <stream>
            <action>DLSTRNDT</action>
                <userName>".self::USERNAME."</userName>
                <accountNo>".self::MAINACC."</accountNo>

                <subAccNo>{$payAccInfo['no']}</subAccNo>
                <queryType></queryType>
                <startDate>{$where['startDate']}</startDate>
                <endDate>{$where['endDate']}</endDate>
                <tranType></tranType>
                <startRecord></startRecord>
                <pageNumber></pageNumber>
            </stream>";
        $res = $this->attachAccount->curl($xml);
        return $res;
    }


    /**
     * 非登录打印账户交易明细(10条/次)
     * @param  int $user_id 用户id
     * @return array:明细信息数组 string:错误信息
     */
    public function attachOperDetails($user_id,$where=array('startDate'=>'20160601','endDate'=>'20160726')){
        $payAccInfo = $this->attachAccount->attachInfo($user_id);
        $xml = self::XML_PREFIX."
            <stream>
            <action>DLPTDTQY</action>
                <userName>".self::USERNAME."</userName>
                <mainAccNo>".self::MAINACC."</mainAccNo>
                <subAccNo>{$payAccInfo['no']}</subAccNo>
                <startDate>{$where['startDate']}</startDate>
                <endDate>{$where['endDate']}</endDate>
                <startRecord>1</startRecord>
                <pageNumber>10</pageNumber>
            </stream>";
        $res = $this->attachAccount->curl($xml);
        return $res;
    }


    /**
     * 订单交易结果查询
     * @param string $clientID 流水号
     * @return string 
     */
    public function orderRes($clientID){

    }

    /**
     * 获取交易类型
     * @param  int $type 交易类别号
     * @return string  交易类型名称
     */
    public function getTransType($type){
        $type_txt = '';
        switch ($type) {
            case 11:
                $type_txt = '普通转账';
                break;
            case 12:
                $type_txt = '资金初始化';
                break;
            case 13:
                $type_txt = '利息分配';
                break;
            case 14:
                $type_txt = '手续费分配';
                break;
            case 15:
                $type_txt = '强制转账';
                break;
            case 16:
                $type_txt = '调账';
                break;
            case 21:
                $type_txt = '公共利息收费账户转账';
                break;
            case 22:
                $type_txt = '公共调账账户外部转账';
                break;
            case 23:
                $type_txt = '普通外部转账';
                break;
            default:
                $type_txt = '未知交易类型';
                break;
        }

        return $type_txt;
    }

}