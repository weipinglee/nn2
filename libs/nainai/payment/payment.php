<?php
namespace nainai\payment;

/**
 * @file payment.php
 * @brief 支付业务相关接口类
 * @author
 * @date 2011-01-20
 * @version 0.6
 * @note
 */

/**
 * @class Payment
 * @brief 支付方式 操作类
 */
//支付状态：支付失败
define("PAY_FAILED", -1);
//支付状态：支付超时
define("PAY_TIMEOUT", 0);
//支付状态：支付成功
define("PAY_SUCCESS", 1);
//支付状态：支付取消
define("PAY_CANCEL", 2);
//支付状态：支付错误
define("PAY_ERROR", 3);
//支付状态：支付进行
define("PAY_PROGRESS", 4);
//支付状态：支付无效
define("PAY_INVALID", 5);

abstract class Payment {

	public $payObj = null;

	protected $callbackUrl = '';

	protected $serverCallback = '';

	public function __construct($pay=null)
	{
		$this->payObj = $pay;
	}


	//调用前的操作
	abstract public function payBefore(Array $argument=array());

	//调用后第三方同步或异步的业务操作
	abstract public function payAfter(Array $argument=array());

	/**
	 * @brief 记录支付平台的交易号
	 * @param $orderNo string 订单编号
	 * @param $tradeNo string 交易流水号
	 * @return boolean
	 */
	protected function recordTradeNo($orderNo,$tradeNo)
	{

		$orderDB = new \Library\M('recharge_order');
		return $orderDB->data(array('proot' => $tradeNo))->where(array('order_no'=>$orderNo))->update();

	}

	/**
	 * 添加一条交易记录
	 * @$tradeData array 插入的记录
	 * @$orderNo 订单号
	 */
	public static function addTrade($tradeData){
		$orderNo = $tradeData['order_no'];
		if(stripos($orderNo,'recharge') !== false){
			$tradeData['order_type'] = 0;//充值
			$tradeData['order_no']   = str_replace('recharge','',$orderNo);

		}else{
			$tradeData['order_type'] = 1;//消费
			$tradeData['order_no']   = $orderNo;
		}

		$tradeDB = new \Library\M('recharge_record');

		$tradeDB->data($tradeData);
		if(!$tradeData['pay_type'] || !$tradeData['trade_no'])return false;
		$where = 'pay_type='.$tradeData['pay_type'].' and trade_no = "'.$tradeData['trade_no'].'"';
		if($tradeDB->where($where)->getObj()){
			if($tradeData['trade_status']==1){
				$tradeDB->where($where)->update();
			}
			return true;
		}
		if($tradeDB->add())return true;
		return false;
	}

	public static function createOrderNum() {
		return  date('YmdHis') . rand(100000, 999999);
	}
	public static function getDateTime($format = '', $time = '') {
		$time = $time ? $time : time();
		$format = $format ? $format : 'Y-m-d H:i:s';
		return date($format, $time);
	}
}