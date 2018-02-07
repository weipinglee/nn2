<?php
/**
 * 交易中心不需要登录的控制器公共类
 */
use \Library\url;
use \nainai\offer\product;
use \nainai\sso\NNcas;
class TestController extends \Yaf\Controller_Abstract{


    public function indexAction(){
        $casObj = new NNcas();
        $res = $casObj->checkServerLogin();
        if($res){
            echo '已登录';
        }
        else{
            echo '未登录';
        }
        exit;
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