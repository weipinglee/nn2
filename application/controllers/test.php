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

//        $graphql = new \nainai\graphqls();
//        $query = '{
//                        user(id:57)
//                        {
//                        id,
//                        email,
//                        username,
//                        type,
//                          invoice{
//                             tax_no
//                          }
//                        }
//                   }';
//
//
//        $graphql->query($query);exit;
    }


    public function doLoginAction(){

    }

    public function timeAction(){

    }

    public function getNowTimeAction(){
        echo time();exit;
    }



}