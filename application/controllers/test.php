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
                       
                        jingjia(id:15886)
                        {
                         id,user_id,pro_name,price_l,start_time,end_time,max_num,
                         seller{
                           username,true_name,mobile,id
                          
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