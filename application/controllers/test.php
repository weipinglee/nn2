<?php
/**
 * 交易中心不需要登录的控制器公共类
 */
use \Library\url;
use \nainai\offer\product;
use \nainai\sso\NNcas;
class TestController extends \Yaf\Controller_Abstract{


    public function indexAction(){
         $obj = new \nainai\member();
         $obj->sendShortMessage(array('36','57'),'2134234');
    }


    public function doLoginAction(){

    }

    public function timeAction(){

    }

    public function getNowTimeAction(){
        echo time();exit;
    }


}