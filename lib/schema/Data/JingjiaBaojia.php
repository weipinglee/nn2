<?php
namespace schema\Data;

use \Library\M;
use \Library\Query;
/**
 * Class DataSource
 *

 */
class JingjiaBaojia
{

    private static $except = array('buyer');//ÅÅ³ıµÄ×Ö¶Î

    private static $table = 'product_jingjia';


    public static function findOne($val, $args, $context, $info){
        $fields = array_keys($info->getFieldSelection());
        foreach($fields as $key=>$val){
            if(in_array($val,self::$except)){
                unset($fields[$key]);
            }
        }
        $where = array('id'=>$args['id']);
        $fields = join(',',$fields);
        $obj = new M(self::$table);
        $data = $obj->fields($fields)->where($where)->getObj();
        return $data;
    }

    public static function findList($val, $args, $context, $info){
        $fields = array_keys($info->getFieldSelection());
        foreach($fields as $key=>$val){
            if(in_array($val,self::$except)){
                unset($fields[$key]);
            }
        }
        $where = array('offer_id'=>$args['offer_id']);
        $fields = join(',',$fields);
        $obj = new M(self::$table);
        $data = $obj->fields($fields)->where($where)->select();
        return $data;
    }







}
