<?php
namespace schema\Data;

use \Library\M;
use \Library\Query;
/**
 * Class DataSource
 *

 */
class Invoice
{

    private static $fields = array('user_id','tax_no','address','phone','bank_name','bank_no');


    private static $table = 'user_invoice';


    public static function findOne($val, $args, $context, $info){
        $fields = array_keys($info->getFieldSelection());

        $where = array('user_id'=>$val['id']);
        $fields = join(',',$fields);
        $obj = new M(self::$table);
        $data = $obj->fields($fields)->where($where)->getObj();
        return $data;
    }







}
