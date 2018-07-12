<?php
/**
 * User: weipinglee
 * Date: 2018/7/11
 * Time: 15:11
 */

namespace tests;

require_once "start.php";

use nainai\user\UserPaylog;
use nainai\user\UserBank;
use tests\mock\testAccount;

class UserPaylogTest extends base
{


    protected $Obj = null;
    protected $dbObj = null;
    protected $initData = array();

    public static  function setUpBeforeClass(){

    }
    protected $bankLog = array(
        array(
            'TX_DT'=>'20180510',
            'TX_TM'=>'091005123',
            'RMRK'=>'pay deposit',
            'DSCRP'=>'保证金支付',
            'TX_AMT_TYP'=>'1',
            'CRDR_IDEN'=>'1',
            'TX_AMT'=>2000,
            'ACCT_BAL'=>0,
            'OP_ACCT_NO_32'=>'62262645632145666666',//账号
            'OP_CUST_NAME'=>'李卫平',
            'TX_LOG_NO'=>'1234567890001',
            'CTRT_NO'=>'',
            'SIT_NO'=>'',
            'MBR_NAME'=>'',
            'CURR_COD'=>'01',
            'CURR_IDEN'=>'0'
        ),
        array(
            'TX_DT'=>'20180610',//交易日期
            'TX_TM'=>'171005123',
            'RMRK'=>'pay another',
            'DSCRP'=>'其他业务支付',
            'TX_AMT_TYP'=>'1',
            'CRDR_IDEN'=>'1',
            'TX_AMT'=>350,
            'ACCT_BAL'=>0,
            'OP_ACCT_NO_32'=>'62262645632145222222',//账号
            'OP_CUST_NAME'=>'李卫平',
            'TX_LOG_NO'=>'1234567890002',
            'CTRT_NO'=>'',
            'SIT_NO'=>'',
            'MBR_NAME'=>'',
            'CURR_COD'=>'01',
            'CURR_IDEN'=>'0'
        )
    );
    public function __construct()
    {
        parent::__construct();

//        $userBankStub = $this->createMock(UserBank::class);
//        $userBankStub->method("getActiveBankInfo")->willReturn(array('acc_no'=>$this->initData['acc_no']));
//
//        //银行类的桩件，方法marketFlow返回设定好的流水
//        $bankObjStub = $this->createMock(testAccount::class);
//        $bankObjStub->method("marketFlow")->willReturn($this->bankLog);
//
//        $this->Obj = new \nainai\user\UserPaylog($bankObjStub,$userBankStub);
//        $this->dbObj = new \Library\M('');
//
//        $this->initData = array('acc_no'=>'62262645632145666666');


    }

    public function testCreateMatchLog()
    {
       // $bankData =  $this->Obj->userBankObj->getActiveBankInfo(1);
        $bankData = array('acc_no'=>'34234');
       // $this->assertArrayHasKey('acc_no',$bankData);
        $this->assertEquals('34234',$bankData['acc_no']);
        //$flow = $this->Obj->bankObj->marketFlow();
        //print_r($flow);
//        $this->Obj->subject = 'jingjia';
//        $this->Obj->subject_id = 1;
//        $this->Obj->user_id = 36;
//
//        $amount = 2000;
//        $start = '2018-04-01';
//        $end = '2018-05-20';//第一组记录在该时间之间
//        $res = $this->Obj->createMatchLog($start,$end,$amount);
//
//        //期望在数据库中出现的数据
//        $expectData = array(
//            'user_id'=>36,
//            'subject'=>'jingjia',
//            'subject_id'=>1,
//            'acc_no'=>'62262645632145666666',
//            'acc_name'=>'李卫平',
//            'pay_total'=>$amount,
//            'bank_flow'=>'1234567890001',
//            'status'=>1
//        );
//        $this->seeInDatabase('user_pay_log',$expectData);

    }














    public static  function tearDownAfterClass(){
        self::clearTable('product_offer');

    }

}
