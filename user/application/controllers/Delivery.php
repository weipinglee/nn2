<?php 

/**
 * 提货
 */
use \Library\safe;
use \Library\tool;
use \Library\JSON;
use \Library\url;
use \Library\checkRight;

class DeliveryController extends UcenterBaseController {


    //提货页面
    public function newDeliveryAction(){
        $order_id = safe::filter($this->_request->getParam('order_id'));

        $delivery = new \nainai\delivery\Delivery();

        //获取此订单可以提取货物数量
        $left = $delivery->orderNumLeft($order_id,false);//返回数值
        if(!is_float($left)){
            //报错
            $this->error($left);exit;
        }

        $info = $delivery->deliveryStore($order_id);
        $info['left'] = $left;
        $this->getView()->assign('data',$info);
    }

    //生成提货表
    public function geneDeliveryAction(){
        $deliveryData['order_id'] = safe::filterPost('order_id','int');
        $deliveryData['num'] = safe::filterPost('num');
        $deliveryData['delivery_man'] = safe::filterPost('delivery_man');
        $deliveryData['phone'] = safe::filterPost('phone');
        $deliveryData['idcard'] = safe::filterPost('idcard');
        $deliveryData['plate_number'] = safe::filterPost('plate_number');
        $deliveryData['expect_time'] = date('Y-m-d H:i:s',strtotime(safe::filterPost('expect_time')));
        $deliveryData['remark'] = safe::filterPost('remark');

        $deliveryData['user_id'] = $this->user_id;

        $delivery = new \nainai\delivery\Delivery();
        $res = $delivery->geneDelivery($deliveryData);

        die(json::encode($res));
    }



    public function deliBuyListAction(){
        $delivery = new \nainai\delivery\Delivery();
        $page = safe::filterGet('page','int',1);
        $user = $this->user_id;
        $list = $delivery->deliveryList($user,$page,false);

        $this->getView()->assign('data',$list['data']);
        $this->getView()->assign('page',$list['bar']);
    }

    public function deliSellListAction(){
        $delivery = new \nainai\delivery\Delivery();
        $page = safe::filterGet('page','int',1);
        $user = $this->user_id;
        $list = $delivery->deliveryList($user,$page,true);

        $this->getView()->assign('data',$list['data']);
        $this->getView()->assign('page',$list['bar']);
    }

}