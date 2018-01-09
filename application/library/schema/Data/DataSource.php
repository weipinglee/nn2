<?php
namespace schema\Data;

use \Library\M;
use \Library\Query;
/**
 * Class DataSource
 *
 * This is just a simple in-memory data holder for the sake of example.
 * Data layer for real app may use Doctrine or query the database directly (e.g. in CQRS style)
 *
 * @package GraphQL\Examples\Blog
 */
class DataSource
{

    private static $userFields = array('id','email','true_name','username','type','login_time');

    private static $offerFields = array('order_no','user_id','type','pro_name','price');

    private static $userIds = array();

    private static $userArr = array();
    public static function addUser($user_id){
        if(!isset(self::$userIds[$user_id])){
            self::$userIds[] = $user_id;
        }
    }

    public static function findOffer($id,$info){
        $fields = array_keys($info->getFieldSelection());
        foreach($fields as $key=>$val){
            if(!in_array($val,self::$offerFields)){
                unset($fields[$key]);
            }
        }
        $fields = join(',',$fields);
        $userObj = new M('product_offer');
        $res = $userObj->where(array('id'=>$id))->fields($fields)->getObj();
        return $res;
    }
    public static function loadUser($info)
    {
        $user_ids = join(',',self::$userIds);

        $fields = array_keys($info->getFieldSelection());
        foreach($fields as $key=>$val){
            if(!in_array($val,self::$userFields)){
                unset($fields[$key]);
            }
        }
        $fields = join(',',$fields);
        $userObj = new M('user');
        $temp = $userObj->where(array('id'=>array('in',$user_ids)))->fields($fields)->select();
        $res = array();
        foreach($temp as $val){
             $res[$val['id']] = $val;


        }
        self::$userArr=array();
       self::$userArr = $res;
    }

    public static function findUser($id){
        if(isset(self::$userArr[$id]))
            return self::$userArr[$id];
        return array();
    }

    public static function findOfferlist($page=1,$pageSize=20,$info){
        $fields = array_keys($info->getFieldSelection());
        foreach($fields as $key=>$val){
            if(!in_array($val,self::$offerFields)){
                unset($fields[$key]);
            }
        }
        $fields = join(',',$fields);
        $offerObj = new Query('product_offer');
        $offerObj->fields = $fields;
        $offerObj->page = $page;
        $offerObj->order = 'id desc';
        $offerObj->pagesize = $pageSize;
        $res = $offerObj->find();
        return $res;
    }

    public static function type_txt($value){
        if(isset($value['type'])){
            if($value['type']==1){
                return '企业';
            }
            else return '个人';
        }
        return '未知';
    }



}
