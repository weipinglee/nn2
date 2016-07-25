<?php

/**
 * 保证金摘牌控制器
 */
use \Library\Safe;
use \Library\tool;
use \Library\JSON;
use \Library\url;

class InsuranceController extends InitController{

     public function insuranceListAction(){
          $page = Safe::filterGet('page', 'int', 0);
          $risk = new \nainai\insurance\Risk();
          $list = $risk->getRiskList($page);

          $this->getView()->assign('company', $risk->getCompany());
          $this->getView()->assign('list', $list['lists']);
          $this->getView()->assign('bar', $list['bar']);
     }
     
     public function insuranceAddAction(){
          $risk = new \nainai\insurance\Risk();

          if (IS_AJAX) {
               $Data = array(
                    'company' => Safe::filterPost('company', 'int'),
                    'name' => Safe::filterPost('name'),
                    'code' => Safe::filterPost('code'),
                    'project_code' => Safe::filterPost('projectCode'),
                    'mode' => Safe::filterPost('type', 'int'),
                    'rate' => Safe::filterPost('rate'),
                    'fee' => Safe::filterPost('fee'),
                    'limit' => Safe::filterPost('limit'),
                    'note' => Safe::filterPost('note'),
                    'status' => Safe::filterPost('status', 'int'),
                    'create_time' => \Library\Time::getDateTime()
               );

               $res = $risk->addRisk($Data);
               exit(JSON::encode($res));
          }

          $this->getView()->assign('company', $risk->getCompany());
     }

     public function ajaxUpdateStatusAction(){
          $id = $this->getRequest()->getParam('id');
          $status = safe::filterPost('status','int',0);
          $id = Safe::filter($id, 'int', 0);

          $Data = array(
               'status' => $status
          );

          $risk = new \nainai\insurance\Risk();
          $res = $risk->updateRisk($Data, $id);

          die(JSON::encode($res));

     }

     /**
      * 保险产品详情
      */
     public function detailAction(){
          if (IS_POST) {
               $Data = array(
                    'company' => Safe::filterPost('company', 'int'),
                    'name' => Safe::filterPost('name'),
                    'code' => Safe::filterPost('code'),
                    'project_code' => Safe::filterPost('projectCode'),
                    'mode' => Safe::filterPost('type', 'int'),
                    'rate' => Safe::filterPost('rate'),
                    'fee' => Safe::filterPost('fee'),
                     'limit' => Safe::filterPost('limit'),
                    'note' => Safe::filterPost('note'),
                    'status' => Safe::filterPost('status', 'int')
               );

               $id = Safe::filterPost('id', 'int');
               $risk = new \nainai\insurance\Risk();
               $returnData = $risk->updateRisk($Data, $id);

               die(JSON::encode($returnData));
          }else{
               $id = $this->getRequest()->getParam('id');
               $id = Safe::filter($id, 'int', 0);

               if (intval($id) > 0) {
                    $risk = new \nainai\insurance\Risk();
                    $Data = $risk->getRisk($id);
                  
                    $this->getView()->assign('data', $Data);
                    $this->getView()->assign('company', $risk->getCompany());
               }
          }

     }

     /**
      * 删除代理商
      */
     public function deleteAction(){
          $id = $this->getRequest()->getParam('id');
          $id = Safe::filter($id, 'int', 0);

          $risk = new \nainai\insurance\Risk();
          $res = $risk->deleteRisk($id);

          die(JSON::encode($res));

     }

     public function rateListAction(){
                  $productModel = new productModel();
                  $cateTree = $productModel->getCateTree();
                  $attrs    = $productModel->getAttr();

                    $risk = new \nainai\insurance\Risk();
                    $list = $risk->getRiskList(-1, array('status' => 1));
                  foreach($cateTree as $key=>&$val){
                      $temp = '';
                      $attr = explode(',',$val['attrs']);
                      foreach($attr as $k=>$v){
                          $temp .= isset($attrs[$attr[$k]]['name']) ? $attrs[$attr[$k]]['name'] .',' : '';
                      }
                      $temp = rtrim($temp,',');
                      $cateTree[$key]['attrs'] =$temp;

                      if (!empty($val['risk_data'])) {
                          $risk = explode(',', $val['risk_data']);
                          $val['risk_data'] = array();
                          //组成列表中保险显示数据
                          foreach ($risk as $value) {
                               $val['risk_data'][$value]['name'] = $list[$value]['name'];
                               $val['risk_data'][$value]['company'] = $list[$value]['company'];
                               $val['risk_data'][$value]['mode'] = $list[$value]['mode'];
                               $val['risk_data'][$value]['fee'] = $list[$value]['fee'];
                          }
                      }
                  }
                  $this->getView()->assign('cate',$cateTree);
     }

     public function ajaxGetCateAction(){
          $cate_id = Safe::filterPost('cate_id', 'int');

          $cateData = array();
          if (intval($cate_id) > 0) {
              $productModel = new productModel();
               $cateData = $productModel->getCateInfo($cate_id, 'id, risk_data');

               if (!empty($cateData['risk_data'])) {
                    $cateData['risk_data'] = explode(',', $cateData['risk_data']);
               }
          }
          
          die(JSON::encode($cateData));
     }

     /**
      * 费率添加修改
      */
     public function rateAddAction(){
          $productModel = new productModel();

          if (IS_POST) {
              $cate_id = Safe::filterPost('id', 'int');
              if (intval($cate_id) <= 0) {
                die(JSON::encode(tool::getSuccInfo(0, '请选择分类!')));
              }
               $data = array(
                    'id' => $cate_id
               );
               
               $ids = Safe::filterPost('bid', 'int');
               $data['risk_data'] = implode(',', $ids);
               $res = $productModel->updateCate($data);
               die(JSON::encode($res));
          }
          
          $cate_id  = $this->getRequest()->getParam('cid',0);
          $cate_id = safe::filter($cate_id,'int');

          if (intval($cate_id) > 0) { //修改
               $cateData = $productModel->getCateInfo($cate_id);
                if (!empty($cateData['risk_data'])) {
                            $cateData['risk_data'] = explode(',', $cateData['risk_data']);
                        }
                    $this->getView()->assign('cate',$cateData);
          }else{ //add
               $cateTree = $productModel->getCateTree();//获取分类树
               $this->getView()->assign('tree',$cateTree);
          }
          
          $risk = new \nainai\insurance\Risk();
          $list = $risk->getRiskList(-1, array('status' => 1));
          
          $this->getView()->assign('list', $list);
     }

}