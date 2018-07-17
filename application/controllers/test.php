<?php
/**
 * 交易中心不需要登录的控制器公共类
 */
use \Library\url;
use \nainai\offer\product;
use \nainai\sso\NNcas;
use \Library\tool;
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

    public function areaAction(){
       // print_r($_POST);
        $json = $_POST['json'];
        $json = json_decode($json,true);
        print_r($json);

exit;
        $obj = new \Library\M('area');
        $obj->data($json)->adds();
        die(json_encode(tool::getSuccInfo()));


    }

}