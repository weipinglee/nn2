<?php
/**
 * @brief 前台订单管理
 * User: weipinglee
 * Date: 2018/5/9
 *
 */

use \Library\M;
use \Library\tool;
use \nainai\order;
class orderModel {

    private $offer;
    public function __construct()
    {
        $this->offer = new offersModel();
    }

    /**
     * 给某个用户下单
     * @param $id
     * @param $num
     * @param $user_id
     * @return array
     */
    public function createOneOrder($id,$num,$user_id){
        if($id<=0 || $num<=0 || $user_id<=0){
            return tool::getSuccInfo(0,'下单参数错误');
        }

        //获取用户的pid
        $userObj = new M('user');
        $pid = $userObj->where(array('id'=>$user_id))->getField('pid');
        $detail = $this->offer->offerDetail($id);
        if ($pid>0 && $detail['user_id'] == $pid) {
            return tool::getSuccInfo(0,'子账户不能购买父账户发布的商品');
        }

        $certObj=new \nainai\cert\certificate();
        $certStatus=$certObj->getCertStatus($detail['user_id'],'deal');
        if($certStatus['status']==4){
            $mess=new \nainai\message($detail['user_id']);
            $mess->send('credentials');
           return tool::getSuccInfo(0,'该商品的发布商家资质不够，暂时不能购买');
        }
        $seller_id = $detail['user_id'];
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
               return tool::getSuccInfo(0,'无效报盘方式');
                break;
        }
        $order_submode = null;

        $orderData['offer_id'] = $id;
        $orderData['num'] = $num;
        $orderData['order_no'] = tool::create_uuid();
        $orderData['user_id'] = $user_id;
        $orderData['create_time'] = date('Y-m-d H:i:s',time());
        $orderData['mode'] = $offer_type;

        //店铺id
        $shopInfo = \nainai\shop\shop::info($seller_id);
        $orderData['shop_id'] = isset($shopInfo['id']) ? $shopInfo['id'] : '';

        $order = new M('order_sell');
        try {
            $order->beginTrans();

            //交易前的预处理，竞价判断购买用户是否是胜出用户
            if($detail['sub_mode']==1){
                $subModeObj = new \nainai\offer\jingjiaOffer();
                $condition = $subModeObj->beforeTrade($detail['id'],$this->user_id);
                if($condition['success']==0){
                    $order->rollBack();
                    return $condition;
                }
                $order_submode = new \nainai\order\JingjiaOrder();
            }
            elseif($detail['sub_mode']==2){//一口价交易锁住报盘的一行，以防并发修改
                $subModeObj = new \nainai\offer\yikoujiaOffer();
                $condition = $subModeObj->beforeTrade($detail['id'],$this->user_id);
                if($condition['success']==0){
                    $order->rollBack();
                   return $condition;
                }
            }

            $order_mode->setSubmode($order_submode);
            $gen_res = $order_mode->geneOrder($orderData);

            if($gen_res['success'] == 1){
                $order_id = $gen_res['order_id'];
                $order->commit();

                $amount = $order->where(array('id'=>$order_id))->getfield('amount');
                $url = \Library\url::createUrl('/offers/paySuccess?id='.$order_id.'&order_no='.$orderData['order_no'].'&amount='.$amount.'&payed=0&info=等待支付@deal');

                return tool::getSuccInfo(1,'操作成功,稍后跳转',$url);

            }else{
               return tool::getSuccInfo(0,'生成订单失败:'.$gen_res['info']);
            }
        } catch (\PDOException $e) {
            $order->rollBack();
            return tool::getSuccInfo(0,$e->getMessage());
        }
    }



}