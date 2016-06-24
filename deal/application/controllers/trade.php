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

		$offer_type = $this->offer->offerType($id);

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
				die('无效报盘方式');
				break;
		}

		
		//判断用户账户类型
		if(in_array($offer_type,array(\nainai\order\Order::ORDER_STORE,\nainai\order\Order::ORDER_DEPOSIT))){
			switch ($account) {
				case 1:
					//代理账户 直接余额扣款
					$payment = 1;
					break;
				case 2:
					die('票据账户支付暂时未开通，请选择代理账户');
					//票据账户
					break;
				case 3:
					die('签约账户支付暂时未开通，请选择代理账户');
					//签约账户
					break;
				default:
					die('无效账户类型');
					break;
			}
		}
		$user_id = $this->user_id;
		$orderData['offer_id'] = $id;
		$orderData['num'] = $num;
		$orderData['order_no'] = tool::create_uuid();
		$orderData['user_id'] = $user_id;
		$orderData['create_time'] = date('Y-m-d H:i:s',time());
		$orderData['mode'] = $offer_type;
		try {
			$this->offer->beginTrans();
			$gen_res = $order_mode->geneOrder($orderData);

			if($gen_res['success'] == 1){
				if($order_mode instanceof order\FreeOrder || $order_mode instanceof order\EntrustOrder){
					$this->offer->commit();
					$this->redirect(url::createUrl('/trade/paySuccess?order_no='.$orderData['order_no'].'&amount=111&payed=0&info=等待上传线下支付凭证'));
				}else{		
					$pay_res = $order_mode->buyerDeposit($gen_res['order_id'],$paytype,$user_id);
					if($pay_res['success'] == 1){
						$this->offer->commit();
						$this->redirect(url::createUrl('/trade/paySuccess?order_no='.$orderData['order_no'].'&amount='.$pay_res['amount'].'&payed='.$pay_res['pay_deposit']));
					}else{
						$this->offer->rollBack();
						$this->error('预付定金失败:'.$pay_res['info']);
					}
				}
			}else{
				$this->error('生成订单失败:'.$gen_res['info']);
			}
		} catch (\PDOException $e) {
			$this->offer->rollBack();
			$this->error($e->getMessage());
		}
		
		return false;
	}

	//支付成功页面
	public function paySuccessAction(){
		$order_no = safe::filter($this->_request->getParam('order_no'));
		$amount = safe::filter($this->_request->getParam('amount'));
		$pay_deposit = safe::filter($this->_request->getParam('payed'));
		$info = safe::filter($this->_request->getParam('info'));

		$this->getView()->assign('order_no',$order_no);
		$this->getView()->assign('amount',$amount);
		$this->getView()->assign('info',$info);
		$this->getView()->assign('pay_deposit',$pay_deposit);
	}


	/**
	 * 处理添加报价
	 */
	public function doreportAction(){
		if (IS_POST) {
			$Model = new \nainai\offer\PurchaseReport();
			$offer_id = safe::filterPost('id', 'int');
			$obj = new \nainai\offer\PurchaseOffer();
			$data = $obj->getPurchaseOffer($offer_id);


			if(empty($data)){
				$this->error('采购不存在!');exit();
			}
			else if($data['user_id']==$this->user_id){
				$this->error('不能给自己的采购报价!');exit();
			}



			//判断是否已经添加过报价
			$res = $Model->getPurchaseReport(array('seller_id'=>$this->user_id, 'offer_id'=>$offer_id), 'id');
			if (!empty($res)) {
				$this->error('已经报价过了，不能在报价!');exit();
			}
			$attrs = Safe::filterPost('attribute');

			$reportData = array(
				'offer_id' => $offer_id,
				'attr' => empty($attrs) ? '' : serialize($attrs),
				'price' => Safe::filterPost('price', 'float'),
				'create_time' => \Library\Time::getDateTime(),
				'seller_id' => $this->user_id,
				'status' => $Model::STATUS_APPLY
			);

			$res = $Model->addPurchaseReport($reportData);
			if ($res['success'] == 1) {
				$this->success('报价成功!');
			}else{
				$this->error('报价失败!');
			}
		}else{
			$this->error('错误的操作!');
		}
	}


}