<?php

use \tool\http;
use \Library\url;
use \Library\safe;
use \Library\tool;
use \nainai\order\Order;
use \Library\checkRight;


use \nainai\offer\product;

use \Library\JSON;
/**
 * 保险管理
 * @author maoyong
 * @copyright 2016-07-19
 */
class InsuranceController extends PublicController {

     public function init(){
          parent::init();
          if (empty($this->login)) {
               $this->error('请先登录才能申请保险');
          }
     }

     /**
      * 申请投保页面
      */
     public function applyAction(){
          $id = safe::filterGet('id');
          if (intval($id) > 0) {
               
               $offersModel = new OffersModel();
               $model = new \nainai\offer\product();

               $detail = $offersModel->offerDetail($id);
               $detail['modetext'] = $model->getMode($detail['mode']);
               
               if ($this->login['user_id'] == $detail['user_id']) {
                    $this->error('不能申请自己发布报盘的保险!');
               }
               //获取保险产品信息
               $risk = new \nainai\insurance\Risk();
               $risk_data = $risk->getCategoryRisk($detail['cate_id']);

               $this->getView()->assign('detail', $detail);
               $this->getView()->assign('risk_data', $risk_data);
          }else{
               $this->error('错误的报盘!');
          }
     }

     /**
      * 处理申请投保
      */
     public function doApplyAction(){
          if (IS_POST) {
               $model = new \nainai\insurance\RiskApply();
               $data = array(
                    'buyer_id' => $this->login['user_id'],
                    'offer_id' => safe::filterPost('id', 'int'),
                    'quantity' => safe::filterPost('quantity', 'flota'),
                    'note' => safe::filterPost('note'),
                    'risk' => implode(',', safe::filterPost('risk')),
                    'apply_time'  => \Library\Time::getDateTime(),
                    'status' => $model::APPLY
               );

               $res = $model->addRiskApply($data);
               if ($res['success'] == 1) {
                    $this->success('申请成功!');
               }else{
                    $this->error('申请失败!');
               }
          }else{
               $this->error('请走正确的流程申请保险');
          }
          exit();
     }
     
}
