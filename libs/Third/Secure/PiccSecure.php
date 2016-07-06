<?php

namespace Third\Secure;

class PiccSecure extends Secures {

     private $insure;
     private $quit;
     private $claim;
     private $visa;
     private $key;

     private $t_key = 'Picc37mu63ht38mw';
     private $t_insure = 'http://yanshou.mypicc.com.cn/ecooperation/webservice/insure?wsdl';
     private $t_quit = 'http://yanshou.mypicc.com.cn/ecooperation/webservice/insure?wsdl';
     private $t_visa = 'http//yanshou.mypicc.com.cn/ecooperation/webservice/visa?wsdl';
     private $t_claim = 'http://yanshou.mypicc.com.cn/ecooperation/webservice/claim?wsdl';

     private $test = true;

     private $request = array();
     private $response = array();

     public function __construct(){
          if ($this->test) {
               $this->key = $this->t_key;
               $this->insure = $this->t_insure;
               $this->quit = $this->t_quit;
               $this->claim = $this->t_claim;
               $this->visa = $this->t_visa;
          }
     }

     public  $identityType = array(
          '01'=>'身份证',
          '02'=>'户口薄',
          '03'=>'护照',
          '04'=>'军官证',
          '07'=>'港澳居民身份证',
          '25'=>'港澳居民来往内地通行证',
          '26'=>'台湾居民往来内地通行证',
          '99'=>'其它'
     );

     public  $identity = array(
          '01'=> '本人',
          '10'=> '配偶',
          '40'=> '儿女',
          '50'=> '父母',
          '99'=> '其它'
     );

     public function insure(){
          $this->request['interfaceN'] = '001001';
          $this->request['datas'] = $this->getInsureXml( $data);
          var_dump($this->request);
     }

     public function getInsureXml(& $data){
          $xmlArray = array( 'standalone'=>'yes');
          $xmlArray['GeneralInfo'] = array('UUID'=>'nn'.\Library\Time::getDateTime('yyyyMMddhhmmssyyy'), 'PlateformCode'=>'CPI000001');
          $xmlArray['PlicyInfo'] = array('SerialNo' => 1, 'RiskCode' => 'JAB', 'OperateTimes' => \Library\Time::getDateTime());
          $xmlArray['PlicyInfo']['StartDate'] = \Library\Time::getDateTime('yyyy-MM-dd', strtotime('+5days'));
          $xmlArray['PlicyInfo']['EndDate'] = \Library\Time::getDateTime('yyyy-MM-dd', strtotime('+10days'));
          $xmlArray['PlicyInfo']['StartHour'] = 0;
          $xmlArray['PlicyInfo']['EndHour'] = 24;
          $xmlArray['PlicyInfo']['SumAmount'] = 24;
          $xmlArray['PlicyInfo']['SumPremium'] = 24;
          $xmlArray['PlicyInfo']['ArguSolution'] = 1;
          $xmlArray['PlicyInfo']['RationType'] = 1;
          $xmlArray['PlicyInfo']['ArguSolution'] = 1;
          //投保人信息
          $xmlArray['PlicyInfo']['Applicant'] = array();
          $xmlArray['PlicyInfo']['Applicant']['AppliName'] = '毛勇';
          $xmlArray['PlicyInfo']['Applicant']['AppliIdType'] = '01';
          $xmlArray['PlicyInfo']['Applicant']['AppliIdNo'] = '360481199107280034';
          $xmlArray['PlicyInfo']['Applicant']['AppliIdMobile'] = '18810194461';
          $xmlArray['PlicyInfo']['Applicant']['SendSMS'] = 'Y';
          $xmlArray['PlicyInfo']['Applicant']['AppliIdEmail'] = 'zengmaoyong@126.com';
          $xmlArray['PlicyInfo']['Applicant']['AppliAddress'] = '林肯公园';
          $xmlArray['PlicyInfo']['Applicant']['AppliIdentity'] = '50';
          //联系人信息
          $xmlArray['PlicyInfo']['Linker'] = array('LinkerName' => '毛勇', 'LinkerPhone' => '18810194461');
          //被保人信息
          $xmlArray['PlicyInfo']['Insureds'] = array();
          $xmlArray['PlicyInfo']['Insureds']['InsuredSeqNo'] = 1;
          $xmlArray['PlicyInfo']['Insureds']['InsuredName'] = '毛勇';
          $xmlArray['PlicyInfo']['Insureds']['InsuredIdType'] = '01';
          $xmlArray['PlicyInfo']['Insureds']['InsuredIdNo'] = '360481199107280034';
          $xmlArray['PlicyInfo']['Insureds']['InsuredBirthday'] = '1991-07-28';
          $xmlArray['PlicyInfo']['Insureds']['InsuredIdMobile'] = '18810194461';
          $xmlArray['PlicyInfo']['Insureds']['InsuredEmail'] = 'zengmaoyong@126.com';
          $xmlArray['PlicyInfo']['Insureds']['InsuredAddress'] = '林肯公园';

          return  $this->ArrayToXml($xmlArray, 'ApplyInfo');
     }

     public function commonOperate(){
          try {
               $client = new SoapClient($this->insure);
               print_r($client->__getFunctions());
          } catch (SOAPFault $e) {
               var_dump($e);exit();
          }
     }



}