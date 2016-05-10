<?php
/*
 *充值类
 * author：wzd
 * Date:2016/4/30
 */

//use Library\payments\payment;
use \Library\M;
use \Library\Payment;
use \Library\safe;
use \Library\JSON;
use \Library\Session;

class FundController extends BaseController {

	protected  $certType = 'deal';
	public function indexAction() {

		$fundObj = \nainai\fund::createFund(1);

		$active = $fundObj->getActive($this->user_id);
		$freeze = $fundObj->getFreeze($this->user_id);
		$flowData = $fundObj->getFundFlow($this->user_id);

		$this->getView()->assign('freeze',$freeze);
		$this->getView()->assign('active',$active);
		$this->getView()->assign('flow',$flowData);
		//$obj = new \nainai\fund();
	}

	protected function  getLeftArray(){
		return array(
			array('name' => '资金管理', 'list' => array()),
			array('name' => '开户信息管理'),
			array('name' => '资金账户管理', 'list' => array(
				array('url' => \Library\url::createUrl('/Fund/index'), 'title' => '市场代理账户' ,'action'=>array('tx','cz')),
				array('url' => '', 'title' => '票据账户' ),
			)),

		);
	}
	//处理充值操作
	public function doFundInAction() {

		$payment_id = safe::filterPost('payment_id', 'int');
		$recharge = safe::filterPost('recharge', 'float');

		//在线充值

		if (isset($payment_id) && $payment_id != '') {
			$paymentInstance = Payment::createPaymentInstance($payment_id);
			$paymentRow = Payment::getPaymentById($payment_id);

			//account:充值金额; paymentName:支付方式名字
			$reData = array('account' => $recharge, 'paymentName' => $paymentRow, 'payType' => $payment_id);

			$sendData = $paymentInstance->getSendData(Payment::getPaymentInfo($payment_id, 'recharge', $reData));

			$paymentInstance->doPay($sendData);
		}
		//线下支付
		else {

			$payment_id = 1;
			//处理图片

			if (!isset($recharge) || $recharge <= 0) {
				echo '金额不正确';
			}
			//var_dump($_FILES);
			if (!empty($_FILES['proot']['name'])) {
				$upload = new \Library\photoupload();
				$upload->uploadPhoto($_FILES);
				$upload->setThumbParams(array(180, 180));
				$res = $upload->uploadPhoto();
				//var_dump($res);

				$rechargeObj = new M('recharge_order');
				$reData = array(
					//'user_id' => Session::get('user_id'),
					'user_id' => $this->user_id,
					'order_no' => Payment::createOrderNum(),
					//资金
					'amount' => $recharge,
					'create_time' => Payment::getDateTime(),
					'proot' => \Library\Tool::setImgApp($res['proot']['img']),
					'status' => '0',
					//支付方式
					'pay_type' => $payment_id,
				);

				$r_id = $rechargeObj->data($reData)->add();
				if($r_id){
					echo 'success';
				}

			} else {
				echo "1";
				//请上传支付凭证

			}
		}

	}
	//充值视图
	public function czAction() {

	}

	//提现视图
	public function txAction() {
		$token =  \Library\safe::createToken();
		$this->getView()->assign('token',$token);
	}
	//提现提交处理
	public function dofundOutAction() {

		$user_id = $this->user_id;

		$token = safe::filterPost('token');
		if(!safe::checkToken($token))
			return false;
		//提现申请表
		$data = array(
			'user_id' => $user_id,
			'request_no' => self::createRefundNum(),
			'amount' => safe::filterPost('amount', 'float'),
			'acc_name' => safe::filterPost('acc_name'),
			'bank_name' => safe::filterPost('bank_name'),
			'back_card' => safe::filterPost('back_card'),

			'note' => safe::filterPost('note'),
			'create_time' => \Library\Time::getDateTime(),
		);
		$fundModel = new fundModel();
		$res = $fundModel->fundOutApply($user_id,$data);

		echo JSON::encode($res);

	}
	//退款订单
	public static function createRefundNum() {
		return 'gold_' . date('YmdHis') . rand(100000, 999999);
	}

}
?>