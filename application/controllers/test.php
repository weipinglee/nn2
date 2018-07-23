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
        $graphql = new \nainai\graphqls();
        $offer_id = 15855;
//        $query = '{
//
//                        jingjia(id:'.$offer_id.'){
//                            id,pro_name,jingjia_deposit,
//                            baojia{
//                              price,time,user_id,offer_id,
//                              buyer{
//                                id,username
//                              }
//                            }
//                        }
//                   }';
        $query = '{
                      users{
                         username,id,mobile,
                         bank{
                           bank_name,user_id
                         }
                      }
                   }';
        $data = $graphql->query($query);
       print_r($data);exit;
    }


    public function doLoginAction(){

    }

    public function timeAction(){

    }

    public function getNowTimeAction(){
        echo time();exit;
    }



}