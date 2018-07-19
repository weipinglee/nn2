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
class User
{

    private static $userFields = array('id','email','true_name','username','type','login_time');



    public static function findOne($val, $args, $context, $info){
        $fields = array_keys($info->getFieldSelection());
        foreach($fields as $key=>$val){
            if(!in_array($val,self::$userFields)){
                unset($fields[$key]);
            }
        }

        if($args['id']){
            $where['id'] = $args['id'];
        }
        if($args['mobile']){
            $where['mobile'] = $args['mobile'];
        }
        foreach($fields as $key=>$val){
            if(!in_array($val,self::$userFields)){
                unset($fields[$key]);
            }
        }
        $fields = join(',',$fields);
        $obj = new M('user');
        $data = $obj->fields($fields)->where($where)->getObj();
        return $data;
    }







}
