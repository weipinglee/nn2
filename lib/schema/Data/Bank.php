<?php
namespace schema\Data;

use \Library\M;
use \Library\Query;
/**
 * Class DataSource
 *

 */
class Bank
{

    private static $fields = array('user_id','bank_name','card_no','true_name','proof','status');


    private static $table = 'user_bank';


    public static function findOne($val, $args, $context, $info){
        $fields = array_keys($info->getFieldSelection());

        $where = array('user_id'=>$args['user_id']);
        $fields = join(',',$fields);
        $obj = new M(self::$table);
        $data = $obj->fields($fields)->where($where)->getObj();
        return $data;
    }







}
