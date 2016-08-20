<?php
/**
 *
 * @author panduo
 * @desc 报盘列表
 * @date 2016-05-05 10:07:47
 */
use \tool\http;
use \Library\url;
use \Library\safe;
use \Library\tool;
use \nainai\order;
use \Library\json;
use \Library\M;
class tradeController extends \nainai\controller\Base {

	private $offer;

	protected $certType = 'deal';
	public function init(){
		parent::init();
		$this->offer = new OffersModel();
	}

	//付款
	public function buyerPayAction(){
		$id = safe::filterPost('id','int');
		$num = safe::filterPost('num');
		$paytype = safe::filterPost('paytype');
		$account = safe::filterPost('account');
		$invoice = safe::filterPost('invoice');

		$detail = $this->offer->offerDetail($id);
		$offer_type = intval($detail['mode']);

		switch ($offer_type) {
			case order\Order::ORDER_FREE:
				//自由报盘
				$order_mode = new order\FreeOrder($offer_type);
				break;
			case order\Order::ORDER_DEPOSIT:
				//保证金报盘
				$order_mode = new order\DepositOrder($offer_type);
				break;
			case order\Order::ORDER_STORE:
				//仓单报盘
				$order_mode = new order\StoreOrder($offer_type);
				break;
			case order\Order::ORDER_ENTRUST:
				//仓单报盘
				$order_mode = new order\EntrustOrder($offer_type);
				break;
			default:
				die(json::encode(tool::getSuccInfo(0,'无效报盘方式')));
				break;
		}



		
		//判断用户账户类型
		if(in_array($offer_type,array(\nainai\order\Order::ORDER_STORE,\nainai\order\Order::ORDER_DEPOSIT))){
			switch ($account) {
				case \nainai\order\Order::PAYMENT_AGENT:
					//代理账户 直接余额扣款
					break;
				case \nainai\order\Order::PAYMENT_BANK:
					//签约账户
					break;
				case \nainai\order\Order::PAYMENT_TICKET:
					die(json::encode(tool::getSuccInfo(0,'票据账户支付暂时未开通，请选择其他支付方式')));
					
					break;
				default:
					die(json::encode(tool::getSuccInfo(0,'无效账户类型')));
					break;
			}
		}
		$user_id = $this->user_id;
		
		$orderData['payment'] = $account;
		$orderData['offer_id'] = $id;
		$orderData['num'] = $num;
		$orderData['order_no'] = tool::create_uuid();
		$orderData['user_id'] = $user_id;
		$orderData['create_time'] = date('Y-m-d H:i:s',time());
		$orderData['mode'] = $offer_type;

		//设置保险信息到合同里面
		if ($detail['insurance'] == 1) {//投保产品
			$orderData['risk'] = $detail['risk'];
		}else {//申请投保
			$risk = new \nainai\insurance\RiskApply();
			$data = $risk->getRiskApply(array('buyer_id' => $user_id, 'offer_id' => $id, 'status' => $risk::APPLYOK), 'risk');
			if (!empty($data)) {
				$orderData['risk'] = $data['risk'];
			}
		}

		//判断是否需要开具发票
		$orderData['invoice'] = $invoice == 1 ? 1 : 0;

		//判断用户是否填写发票所需信息
		if($orderData['invoice']){
			$user_invoice = new \nainai\user\UserInvoice();
			$invoce_info = $user_invoice->userInvoiceInfo($user_id);
			if(empty($invoce_info)){
				die(json::encode(tool::getSuccInfo(0,'发票信息未完善',url::createUrl('/ucenter/invoice@user'))));
			}
		}


		$order = new M('order_sell');
		try {
			$order->beginTrans();

			$gen_res = $order_mode->geneOrder($orderData);
			if($gen_res['success'] == 1){
				$order_id = $gen_res['order_id'];
				if($offer_type == order\Order::ORDER_FREE || $offer_type == order\Order::ORDER_ENTRUST){

					$order->commit();
					
					$amount = $order->where(array('id'=>$order_id))->getfield('amount');
					$url = url::createUrl('/offers/paySuccess?id='.$order_id.'&order_no='.$orderData['order_no'].'&amount='.$amount.'&payed=0&info=等待上传线下支付凭证');
					die(json::encode(tool::getSuccInfo(1,'操作成功,稍后跳转',$url)));
				}else{
					$zhi = new \nainai\member();
					$pay_secret = safe::filterPost('pay_secret');
					if(!$zhi->validPaymentPassword($pay_secret,$this->user_id)){
						die(json::encode(tool::getSuccInfo(0,'支付密码错误')));
					}

					$pay_res = $order_mode->buyerDeposit($gen_res['order_id'],$paytype,$user_id,$account);

					if($pay_res['success'] == 1){
						$this->offer->commit();
						$url = url::createUrl('/offers/paySuccess?id='.$order_id.'&order_no='.$orderData['order_no'].'&amount='.$pay_res['amount'].'&payed='.$pay_res['pay_deposit']);
						die(json::encode(tool::getSuccInfo(1,'支付成功,稍后跳转',$url)));

					}else{
						$this->offer->rollBack();
						die(json::encode(tool::getSuccInfo(0,'预付定金失败:'.$pay_res['info'])));

					}
				}
			}else{
				die(json::encode(tool::getSuccInfo(0,'生成订单失败:'.$gen_res['info'])));
			}
		} catch (\PDOException $e) {
			$order->rollBack();
			$this->error($e->getMessage());
		}
		
		return false;
	}




	/**
	 * 处理添加报价
	 */
	public function doreportAction(){
		if($this->user_type==0)
			die(json::encode(tool::getSuccInfo(0,'个人用户不能报价'))) ;
		if (IS_POST) {
			$Model = new \nainai\offer\PurchaseReport();
			$offer_id = safe::filterPost('id', 'int');
			$obj = new \nainai\offer\PurchaseOffer();
			$data = $obj->getPurchaseOffer($offer_id);


			if(empty($data)){
				die(json::encode(tool::getSuccInfo(0,'采购不存在!')));
				exit();
			}
			else if($data['user_id']==$this->user_id){
				die(json::encode(tool::getSuccInfo(0,'不能给自己的采购报价!')));exit();
			}



			//判断是否已经添加过报价
			$res = $Model->getPurchaseReport(array('seller_id'=>$this->user_id, 'offer_id'=>$offer_id), 'id');
			if (!empty($res)) {
				die(json::encode(tool::getSuccInfo(0,'已报价，不要重复报价!')));
				exit();
			}
			$attrs = Safe::filterPost('attribute');

			$reportData = array(
				'offer_id' => $offer_id,
				'attr' => empty($attrs) ? '' : serialize($attrs),
				'produce_area' => safe::filterPost('area','int'),
				'price' => Safe::filterPost('price', 'float'),
				'create_time' => \Library\Time::getDateTime(),
				'seller_id' => $this->user_id,
				'status' => $Model::STATUS_APPLY
			);

			$res = $Model->addPurchaseReport($reportData);
			die(json::encode($res));
		}else{
			$this->error('错误的操作!');
		}
	}


}