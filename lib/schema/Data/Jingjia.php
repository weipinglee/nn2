<?php
namespace schema\Data;

use \Library\M;
use \Library\Query;
/**
 * Class DataSource
 *

 */
class Jingjia
{

    private static $fields = array('user_id','bank_name','card_no','true_name','proof','status');

    private static $except = array('seller');//ÅÅ³ıµÄ×Ö¶Î

    private static $table = 'product_offer';


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







}
