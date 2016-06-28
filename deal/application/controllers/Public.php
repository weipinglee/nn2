<?php
/**
 * 交易中心不需要登录的控制器公共类
 */
use \Library\url;

class PublicController extends \Yaf\Controller_Abstract{

     public function init(){
          $this->getView()->setLayout('layout');
          $frdLink = new \nainai\system\friendlyLink();
          $frdData = $frdLink->getFrdLink(10);
          $this->getView()->assign('frdData',$frdData);

          $login = \Library\session::get('login');
          if($login){
               $this->getView()->assign('login',1);
               $this->getView()->assign('username',$login['username']);
          }
          else
               $this->getView()->assign('login',0);

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