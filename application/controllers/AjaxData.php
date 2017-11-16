<?php
/**
 * 交易中心不需要登录的控制器公共类
 */
use \Library\url;
use \Library\safe;
class AjaxDataController extends \Yaf\Controller_Abstract{

     public $login;

     private $offer;
     private $order;
     public function init(){
          $this->offer = new offersModel();
          $right = new \Library\checkRight();
          $isLogin = $right->checkLogin();
          if($isLogin){
               $this->login = \Library\session::get('login');
          }
     }

     /**
      * AJax获取产品分类信息
      * @return [Json]
      */
     public function ajaxGetCategoryAction(){
          $pid = safe::filterPost('pid', 'int',0);
          $type = safe::filterPost('type', 'int',0);
          $mode = safe::filterPost('mode', 'int',0);
          $page = safe::filterPost('page','int',1);
          $order = safe::filterPost('sort');
          $area = safe::filterPost('area','int',0);
          $search = safe::filterPost('search');



          //获取这个分类下对应的产品信息
          $condition = array();
          $cate = array();
          if($pid!=0)
               $condition['pid'] = $pid;
          if($type!=0){
               $condition['type'] = $type;
          }
          if($mode!=0){
               $condition['mode'] = $mode;
          }
          if($area!=0){
               $condition['area'] = $area;
          }
          if($search!=''){
               $condition['search'] = $search;
          }

          if($order!=''){
               $orderArr = explode('_',$order);
               switch($orderArr[0]){
                    case 'price' : {
                         if(isset($orderArr[1]) && $orderArr[1]=='asc')
                              $order = 'price asc';
                         else $order = 'price desc';
                    }
                         break;
                    case 'time' : {
                         if(isset($orderArr[1]) && $orderArr[1]=='asc')
                              $order = 'apply_time asc';
                         else $order = 'apply_time desc';
                    }
                         break;
                    default : {
                         $order = '';
                    }
               }
          }
          else $order = '';
          $data = $this->offer->getList($page, $condition,$order,$this->login['user_id']);
          if ( ! empty($this->login)) {
               $data['login'] = 1;
          }else{
               $data['login'] = 0;
          }

          // var_dump($data);exit;
          echo \Library\json::encode($data);
          exit();
     }

     /**
      * 异步获取某个用户的部分商品，显示在首页
      */
     public function getSellerProductAction()
     {
          $seller_id = safe::filterGet('seller_id', 'int',1);
          $data = $this->offer->getOfferlistBySeller($seller_id);
          die(\Library\json::encode($data));

     }



}