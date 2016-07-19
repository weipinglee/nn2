<?php

use \Library\json;
use \Library\url;
use \Library\Safe;
use \Library\Thumb;
use \Library\tool;
use \Library\PlUpload;
use \nainai\offer\product;
use \nainai\offer\PurchaseOffer;
/**
 * 保险管理
 * @author maoyong
 * @copyright 2016-07-19
 */
class InsuranceController extends UcenterBaseController{

     /**
      * 申请列表
      */
     public function applyListAction(){
          $condition = array('buyer_id' => $this->user_id);
          $this->listData($condition);
     }

     /**
      * 投保列表
      */
     public function insuranceListAction(){
          $condition = array('user_id' => $this->user_id);
          $this->listData($condition);
     }

     /**
      * 列表数据获取
      * @param  array  $condition 
      */
     public function listData($condition = array()){
          $page = Safe::filterGet('page', 'int', 0);
          $name = Safe::filterGet('name');
          $beginDate = Safe::filterGet('beginDate');
          $endDate = Safe::filterGet('endDate');
          $status = Safe::filterGet('status', 'int', 9);

          if (!empty($name)) {
               $condition['name'] = $name;
              $this->getView()->assign('name', $name);
          }

          if ($status != 9) {
               $condition['status'] = $status;
              $this->getView()->assign('s', $status);
          }

          if (!empty($beginDate)) {
               $condition['beginDate'] = $beginDate . ' 00:00:00';
              $this->getView()->assign('beginDate', $beginDate);
          }

          if (!empty($endDate)) {
               $condition['endDate'] = $endDate . ' 23:59:59';
              $this->getView()->assign('endDate', $endDate);
          }    

          $model = new \nainai\insurance\RiskApply();
          $lists = $model->getApplyList($page, $this->pagesize, $condition);
          
          $this->getView()->assign('status', $model->getStatus());
          $this->getView()->assign('lists', $lists['lists']);
          $this->getView()->assign('bar', $lists['bar']);
     }

     /**
      * 查看申请投保详情
      */
     public function insurancedetailAction(){
          if (IS_POST) {
               $model = new \nainai\insurance\RiskApply();
               $id = Safe::filterPost('id', 'int');
               if (intval($id) > 0) {
                    $data = array(
                         'status' => (Safe::filterPost('status', 'int') == 1) ? $model::APPLYOK : $model::APPLYNO
                    );

                    $res = $model->updateRiskApply($data, $id);
                    exit(JSON::encode($res));
               }
               exit(JSON::encode(tool::getSuccInfo(0, '错误的申请信息')));
          }
               $this->detailData();
     }

     /**
      * 个人申请投保信息
      */
     public function applydetailAction(){
          $this->detailData();
     }

     /**
      * 获取投保信息
      */
     public function detailData(){
          $id = $this->getRequest()->getParam('id');
          $id = Safe::filter($id, 'int');

          if (intval($id) > 0) {
               $model = new \nainai\insurance\RiskApply();
               $detail = $model->getDetail($id);

               $detail['risk'] = explode(',', $detail['risk']);
               foreach ($detail['risk_data'] as $key => $value) {
                    if (!in_array($value['risk_id'], $detail['risk'])) {
                        unset($detail['risk_data'][$key]);
                    }
               }

               $this->getView()->assign('detail', $detail);
               $this->getView()->assign('status', $model->getStatus());
          }else{
               $this->error('错误的申请信息!');
          }
     }

}
