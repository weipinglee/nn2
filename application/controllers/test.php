<?php
/**
 * 交易中心不需要登录的控制器公共类
 */
use \Library\url;
use \nainai\offer\product;
use \nainai\sso\NNcas;
class TestController extends \Yaf\Controller_Abstract{


    public function indexAction(){
        echo 123;
        $this->getView()->setLayout('');
        $this->getView()->setStaticFile();
    }


    public function doLoginAction(){
        try{
            $username = 'weipinglee';
            $password = '123qwe';
            $callback = 'http://ceshi.nainaiwang.com/test/index';
            $casObj = new NNcas();
            $casObj->serverAuthentication($username,$password,$callback);

        }catch (\Exception $e){
            echo $e->getMessage();
        }

        exit;

    }


}