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
        $query = '{
                        user(id:36)
                        {
                        id,
                        email,
                        username,
                        type,
                         bank{
                           bank_name,card_no,true_name
                         },
                         invoice{
                            tax_no,address
                         }
                        }
                   }';


        $data = $graphql->query($query);
print_r($data);
        exit;

    }


    public function doLoginAction(){

    }

    public function timeAction(){

    }

    public function getNowTimeAction(){
        echo time();exit;
    }



}