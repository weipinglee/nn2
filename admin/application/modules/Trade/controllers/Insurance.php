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
          $risk = new \nainai\insurance\Risk();
          $list = $risk->getRiskList();

          $this->getView()->assign('company', $risk->getCompany());
          $this->getView()->assign('list', $list);
     }
     
     public function insuranceAddAction(){
          $risk = new \nainai\insurance\Risk();

          if (IS_AJAX) {
               $Data = array(
                    'company' => Safe::filterPost('company', 'int'),
                    'name' => Safe::filterPost('name'),
                    'code' => Safe::filterPost('code'),
                    'mode' => Safe::filterPost('type', 'int'),
                    'rate' => Safe::filterPost('rate'),
                    'fee' => Safe::filterPost('fee'),
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

     public function detailAction(){
          if (IS_POST) {
               $Data = array(
                    'company' => Safe::filterPost('company', 'int'),
                    'name' => Safe::filterPost('name'),
                    'code' => Safe::filterPost('code'),
                    'mode' => Safe::filterPost('type', 'int'),
                    'rate' => Safe::filterPost('rate'),
                    'fee' => Safe::filterPost('fee'),
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

}