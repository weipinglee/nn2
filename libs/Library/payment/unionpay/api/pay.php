<?php
namespace Library\payment\unionpay\api;
use \Library\payment\paymentplugin;
use \Library\payment\unionpay\common;
/**
 * 银联网关支付子类
 * User: Administrator
 * Date: 2017/4/11 0011
 * Time: 下午 3:28
 */
include_once dirname(dirname(__FILE__)) . "/common.php";
include_once dirname(dirname(__FILE__)) . "/httpClient.php";
include_once dirname(dirname(__FILE__)) . "/SDKConfig.php";

class pay extends paymentplugin{

    protected $paymentId = 3;
    public $name = '银联在线支付';//插件名称

    /**
     * @see paymentplugin::getSubmitUrl()
     */
    public function getSubmitUrl() {
        return SDK_FRONT_TRANS_URL;//提交地址
    }

    /**
     * @see paymentplugin::notifyStop()
     */
    public function notifyStop() {
        echo "success";
    }


    /**
     * @see paymentplugin::callback()
     */
    public function callback($callbackData, &$paymentId, &$money, &$message, &$orderNo) {
        if (isset($callbackData['signature'])) {
            if (Common::verify ( $callbackData )) {
                $orderNo = $callbackData['orderId'];//订单号


                return 1;
            } else {
                $message = '签名不正确';
            }
        } else {
            $message = '签名为空';
        }
        return 0;
    }

    /**
     * @see paymentplugin::serverCallback()
     */
    public function serverCallback($callbackData, &$paymentId, &$money, &$message, &$orderNo) {
        if (isset($callbackData['signature'])) {
            if (Common::verify($callbackData)) {
                $orderNo = $callbackData['orderId'];//订单号

                return 1;
            } else {
                $message = '签名不正确';
            }
        } else {
            $message = '签名为空';
        }
        return 0;
    }


    /**
     * @see paymentplugin::getSendData()
     */
    public function getSendData($argument) {
        if(!$argument)
            return false;
        $payment = $this->getPaymentInfo();

        Common::setCertPwd($payment['M_certPwd']);
        $return = array(
            'version' => '5.0.0', //版本号
            'encoding' => 'utf-8', //编码方式
            'certId' => Common::getSignCertId(), //证书ID

            'txnType' => '01', //交易类型     //可能是活的
            'txnSubType' => '01', //交易子类 01消费
            'bizType' => '000201', //业务类型
            'frontUrl' => $argument['frontUrl'], //SDK_FRONT_NOTIFY_URL,  		//前台通知地址
            'backUrl' => $argument['backUrl'], //SDK_BACK_NOTIFY_URL,		//后台通知地址
            'signMethod' => '01', //签名方法
            'channelType' => '07', //渠道类型，07-PC，08-手机
            'accessType' => '0', //接入类型
            'merId' => $payment['M_merId'], //商户代码，请改自己的测试商户号
            'currencyCode' => '156', //交易币种
            'defaultPayType' => '0001', //默认支付方式
            'txnTime' => date('YmdHis'), //订单发送时间
            //'orderDesc' => '订单描述',  //订单描述，网关支付和wap支付暂时不起作用
        );
        /*if (IClient::getDevice() == 'mobile') {
        $return['channelType'] = '08';
        }*/
        $return['orderId'] = $argument['M_OrderNO'];//商户订单号
        $return['txnAmt'] = $argument['M_Amount'] * 100;//交易金额，单位分
        $return['reqReserved'] = $argument['M_OrderId'] . ":" . $payment['M_Remark'];//订单发送时间'透传信息'; //请求方保留域，透传字段，查询、通知、对账文件中均会原样出现

        // 签名
        Common::sign($return);

        return $return;
    }


    /**
     * @see paymentplugin::getPaymentId()
     */
    public function getPaymentId(){
        return $this->paymentId;
    }

    /*
     * @param 获取配置参数
     */
    public function configParam() {
        $result = array(
            'M_merId' => '777290058118388',
            'M_certPwd' => '000000',
        );
        return $result;
    }
}