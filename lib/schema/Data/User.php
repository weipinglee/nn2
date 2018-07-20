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


    private static function getFields($info){
        $fields = array_keys($info->getFieldSelection());
        foreach($fields as $key=>$val){
            if(!in_array($val,self::$userFields)){
                unset($fields[$key]);
            }
        }
        $fields = join(',',$fields);
        return $fields;
    }

    public static function findOne($val, $args, $context, $info){
        $fields = self::getFields($info);
        $where = array();
        if(isset($args['id']) && $args['id']){
            $where['id'] = $args['id'];
        }
        if(isset($args['mobile']) && $args['mobile']){
            $where['mobile'] = $args['mobile'];
        }

        $obj = new M('user');
        if(empty($where)){
            return array();
        }
        $data = $obj->fields($fields)->where($where)->getObj();
        return $data;
    }

    public static function findList($val, $args, $context, $info){
        $fields = self::getFields($info);

        $obj = new Query('user');
        $obj->page = isset($args['page']) ? $args['page'] : 1;
        $obj->pagesize = isset($args['pagesize']) ? $args['pagesize'] : 20;
        $obj->fields = $fields;
        $list = $obj->find();
        return $list;

    }







}
