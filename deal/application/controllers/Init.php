<?php
use \Library\url;

class InitController extends \nainai\controller\Base{

     public function init(){
          $this->getView()->setLayout('layout');
     }


     protected function success($info = '操作成功！',$redirect = ''){
          if(isset($redirect)){
               $redirect = str_replace('%','||',urlencode($redirect));
          }
          
          $this->redirect(url::createUrl("/Oper/success?info={$info}&redirect={$redirect}"));
     }

     protected function error($info = '操作失败！',$redirect = ''){

          if(isset($redirect)){
               $redirect = str_replace('%','||',urlencode($redirect));
          }
          $this->redirect(url::createUrl("/Oper/error?info={$info}&redirect={$redirect}"));
     }

     protected function confirm($info = '确认此项操作？',$redirect = ''){

          if(isset($redirect)){
               $redirect = str_replace('%','||',urlencode($redirect));
          }
          $this->redirect(url::createUrl("/Oper/confirm?info={$info}&redirect={$redirect}"));
     }

}