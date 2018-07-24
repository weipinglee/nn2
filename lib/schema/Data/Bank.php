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

    public static function loadBuffer($args, $context,$ids=array(),$fields=array()){
        $obj = new M(self::$table);
        if(!empty($ids)){
            $where = array('user_id'=>array('in',join(',',$ids)));
        }else{
            $where = array('user_id'=>$args['user_id']);
        }
        foreach($ids as $id){
            self::$buffer[$id] = array();
        }
        $data = $obj->fields(join(',',$fields))->where($where)->select();
        if(!empty($data)){
            foreach($data as $item){
                self::$buffer[$item[self::$primaryKey]] = $item;
            }
        }
        
        return true;

    }

    public static function findOne($val, $args, $context, $info){
         $id = $args['user_id'];
         if(!empty( self::$buffer) && isset(self::$buffer[$id])){
             return self::$buffer[$id];
         }else{
             $fields = array_keys($info->getFieldSelection());

             $where = array('user_id'=>$id);
             $fields = join(',',$fields);
             $obj = new M(self::$table);
             $data = $obj->fields($fields)->where($where)->getObj();
             return $data;
         }
    }







}
