<?php 

/**
 * 保证金摘牌控制器
 */
use \Library\safe;
use \Library\tool;
use \Library\JSON;
use \Library\url;
use \Library\checkRight;
use \Library\M;

class testController extends  UcenterBaseController{

	public function indexAction(){
		$xml = <<<xml
<?xml version="1.0" encoding="GB2312" standalone="yes"?>
<ApplyInfo>
	<GeneralInfo>
		<UUID>nnw</UUID>
		<PlateformCode>CPI000001</PlateformCode>
		<Md5Value>5b328774b08a56abf9b069bbe15796c2</Md5Value>
	</GeneralInfo>
	<PolicyInfos>
		<PolicyInfo>
				<SerialNo>1</SerialNo>
				<RiskCode>JAB</RiskCode>
				<OperateTimes>2015-05-06 14:41:40</OperateTimes>
				<StartDate>2015-05-07</StartDate>
				<EndDate>2016-05-06</EndDate>
				<StartHour>0</StartHour>
      	<EndHour>24</EndHour>
				<SumAmount>1600000.00</SumAmount>
				<SumPremium>368.00</SumPremium>
				<ArguSolution>1</ArguSolution>
				<HouseAddress>北京市复兴门内大街1号</HouseAddress>
				<Quantity>1</Quantity>
				<InsuredPlan>
						<RationType>JAB3100025</RationType>
						<Schemes>
							<Scheme>
								<SchemeCode>1</SchemeCode>
								<SchemeAmount>1000000.00</SchemeAmount>
								<SchemePremium>169.00</SchemePremium>
							</Scheme>
							<Scheme>
								<SchemeCode>2</SchemeCode>
								<SchemeAmount>1000000.00</SchemeAmount>
								<SchemePremium>21.00</SchemePremium>
							</Scheme>
							<Scheme>
								<SchemeCode>3</SchemeCode>
								<SchemeAmount>100000.00</SchemeAmount>
								<SchemePremium>21.00</SchemePremium>
							</Scheme>
							<Scheme>
								<SchemeCode>4</SchemeCode>
								<SchemeAmount>100000.00</SchemeAmount>
								<SchemePremium>25.00</SchemePremium>
							</Scheme>
							<Scheme>
								<SchemeCode>5</SchemeCode>
								<SchemeAmount>100000.00</SchemeAmount>
								<SchemePremium>14.00</SchemePremium>
							</Scheme>
							<Scheme>
								<SchemeCode>6</SchemeCode>
								<SchemeAmount>100000.00</SchemeAmount>
								<SchemePremium>18.00</SchemePremium>
							</Scheme>
							<Scheme>
								<SchemeCode>7</SchemeCode>
								<SchemeAmount>100000.00</SchemeAmount>
								<SchemePremium>100.00</SchemePremium>
							</Scheme>
						</Schemes>
				</InsuredPlan>
				<Applicant>
					<AppliName>李小小</AppliName>
        	<AppliSex>1</AppliSex>
					<AppliIdType>01</AppliIdType>
					<AppliIdNo>232126199110234014</AppliIdNo>
					<AppliIdMobile>18811680213</AppliIdMobile>
					<SendSMS>0</SendSMS>
					<AppliIdEmail>fangli23@picc.com.cn</AppliIdEmail>
					<AppliIdentity>01</AppliIdentity>
				</Applicant>
				<Insureds>
					<Insured>
					<InsuredSeqNo>1</InsuredSeqNo>
						<InsuredName>李小小</InsuredName>
						<InsuredIdType>01</InsuredIdType>
						<InsuredIdNo>232126199110234014</InsuredIdNo>
						<InsuredBirthday>1991-10-23</InsuredBirthday>
						<InsuredSex>1</InsuredSex>
						<Benefits>
							<Benefit>
								<BenefitName>李四</BenefitName>
								<BenefitIdType>01</BenefitIdType>
								<BenefitIdNo>232126199110244315</BenefitIdNo>
							</Benefit>
						</Benefits>
				</Insured>
			</Insureds>
		</PolicyInfo>
	</PolicyInfos>
</ApplyInfo>
xml;
		$soap = new SoapClient("http://yanshou.mypicc.com.cn/ecooperation/webservice/insure?wsdl");
		$result2 = $soap->insureService(array(
			'interfaceNo'=>'00100',
			'datas'=>$xml
		));
		var_dump($result2);

		return false;
	}

	public function uploadAction(){

	}



	public function formAction(){
		$a = 'abcdddd';
		echo substr($a,0,-2);exit;

	}


	public function accInitAction(){
		$acc = new \nainai\fund\zx();
		$res = $acc->acountInit(67,1000,'');

		var_dump($res);
	}

	public function freeAction(){
		$acc = new \nainai\fund\zx();
		$res = $acc->freezeTrans(67,date('Y-m-d H:i:s',strtotime('2016-7-21')));
		var_dump($res);
	}

}