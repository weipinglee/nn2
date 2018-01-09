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

    private static $userFields = array('email','true_name','username','type','login_time');

    private static $offerFields = array('order_no','user_id','type','pro_name','price');


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
    public static function findUser($id,$info)
    {
        $fields = array_keys($info->getFieldSelection());
        foreach($fields as $key=>$val){
            if(!in_array($val,self::$userFields)){
                unset($fields[$key]);
            }
        }
        $fields = join(',',$fields);
        $userObj = new M('user');
        $res = $userObj->where(array('id'=>$id))->fields($fields)->getObj();
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
