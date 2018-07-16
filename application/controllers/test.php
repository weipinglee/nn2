<?php
/**
 * 交易中心不需要登录的控制器公共类
 */
use \Library\url;
use \nainai\offer\product;
use \nainai\sso\NNcas;
class TestController extends \Yaf\Controller_Abstract{


    public function indexAction(){
       $obj = new \nainai\offer\jingjiaOffer();
       $obj->endNotice(15879);


    }


    public function doLoginAction(){

    }

    public function timeAction(){

    }

    public function getNowTimeAction(){
        echo time();exit;
    }


}