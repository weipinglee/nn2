<?php
namespace Library\unionpayb2b\sdk;
use \Library\payment;
use \Library\payment\paymentplugin;

/**
 * @brief 银联b2b
 * @note
 */

class DirectAlipay extends paymentPlugin {
	//支付插件名称
	public $name = '银联支付b2b';

	/**
	 * @see paymentplugin::getSubmitUrl()
	 */
	public function getSubmitUrl() {
		
	}

	/**
	 * @see paymentplugin::notifyStop()
	 */
	public function notifyStop() {
		echo "success";
	}
	public function refund($payment) {
		
	}
	/**
	 * 获取退款提交地址
	 */
	public function getRefundUrl() {

	}
	/**
	 * @see paymentplugin::callback()
	 */
	public function callback($callbackData, &$paymentId, &$money, &$message, &$orderNo) {
		if (isset ( $_POST ['signature'] )) {
			
			$status = Library\unionpayb2b\sdk\AcpService::validate ( $_POST ) ? true : false;
			$orderId = $_POST ['orderId']; //其他字段也可用类似方式获取
			$respCode = $_POST ['respCode']; //判断respCode=00或A6即可认为交易成功
			return $respCode;
		} else {
			return false;
		}
	}

	/**
	 * @see paymentplugin::serverCallback()
	 */
	public function serverCallback($callbackData, &$paymentId, &$money, &$message, &$orderNo) {
		return $this->callback($callbackData, $paymentId, $money, $message, $orderNo);
	}

	/**
	 * @see paymentplugin::getSendData()
	 */
	public function getSendData($payment) {
		
	}

	/**
	 * 除去数组中的空值和签名参数
	 * @param $para 签名参数组
	 * return 去掉空值与签名参数后的新签名参数组
	 */
	private function paraFilter($para) {
		$para_filter = array();
		foreach ($para as $key => $val) {
			if ($key == "sign" || $key == "sign_type" || $val == "") {
				continue;
			} else {
				$para_filter[$key] = $para[$key];
			}
		}
		return $para_filter;
	}

	/**
	 * 对数组排序
	 * @param $para 排序前的数组
	 * return 排序后的数组
	 */
	private function argSort($para) {
		ksort($para);
		reset($para);
		return $para;
	}

	/**
	 * 生成签名结果
	 * @param $sort_para 要签名的数组
	 * @param $key 支付宝交易安全校验码
	 * @param $sign_type 签名类型 默认值：MD5
	 * return 签名结果字符串
	 */
	private function buildMysign($sort_para, $key, $sign_type = "MD5") {
		//把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
		$prestr = $this->createLinkstring($sort_para);
		//把拼接后的字符串再与安全校验码直接连接起来
		$prestr = $prestr . $key;
		//把最终的字符串签名，获得签名结果
		$mysgin = md5($prestr);
		return $mysgin;
	}

	/**
	 * 把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
	 * @param $para 需要拼接的数组
	 * return 拼接完成以后的字符串
	 */
	private function createLinkstring($para) {
		$arg = "";
		foreach ($para as $key => $val) {
			$arg .= $key . "=" . $val . "&";
		}

		//去掉最后一个&字符
		$arg = trim($arg, '&');

		//如果存在转义字符，那么去掉转义
		if (get_magic_quotes_gpc()) {
			$arg = stripslashes($arg);
		}

		return $arg;
	}

	/**
	 * @param 获取配置参数
	 */
	public function configParam() {
	}
}