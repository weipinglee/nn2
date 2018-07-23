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

    private static $primaryKey = 'user_id';

    private static $buffer = array();

    public static function loadBuffer($val, $args, $context, $info,$buffer=array()){
        foreach($buffer as $item){
            self::$buffer[$item] = array();
        }
        $fields = array_keys($info->getFieldSelection());
        $fields = join(',',$fields);
        $obj = new M(self::$table);
        if(!empty($buffer)){
            $where = array('user_id'=>array('in',join(',',$buffer)));
        }else{
            $where = array('user_id'=>$args['user_id']);

        }
        $data = $obj->fields($fields)->where($where)->select();
        if(!empty($data)){
            foreach($data as $item){
                self::$buffer[$item[self::$primaryKey]] = $item;
            }
        }
    }

    public static function findOne($val, $args, $context, $info,$buffers=array()){
         $id = $args['user_id'];
         if(!empty($buffers)){
             if(!isset(self::$buffer[$id])){echo 1;
                 self::loadBuffer($val, $args, $context, $info,$buffers);
             }
         }
        return  isset(self::$buffer[$id]) ? self::$buffer[$id] : null;
    }







}
