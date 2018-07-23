<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/19
 * Time: 15:11
 */

namespace schema\Data;


class Handle
{

    public static $buffer = array();

    public static function bufferAdd($name,$value){
        if(!isset(self::$buffer[$name])){
            self::$buffer[$name] = array();
        }
        self::$buffer[$name][] = $value;
    }

    public static function bufferClear($name){
        unset(self::$buffer[$name]);
    }


     public static function findOne($val, $args, $context, $info,$bufferName='')
     {
         $class = '\schema\Data\\'.ucfirst($info->returnType);
         $file = __DIR__.'/'.ucfirst($info->returnType).'.php';
         if(file_exists($file) && class_exists($class)){
             $buffer = $bufferName ? self::$buffer[$bufferName] : '';
             return call_user_func_array(array($class,'findOne'),array($val, $args, $context, $info,$buffer));
         }elseif(isset($val[$info->fieldName])){
             return $val[$info->fieldName];
         }else{
             return false;
         }

     }

     public static function findList($val, $args, $context, $info){
         if(strpos($info->returnType,'[',0)!==false){
             $returnType = substr($info->returnType,1,strlen($info->returnType)-2);
             $class = '\schema\Data\\'.ucfirst($returnType);
             $file = __DIR__.'/'.ucfirst($returnType).'.php';
             if(file_exists($file) && class_exists($class)){
                 return call_user_func_array(array($class,'findList'),array($val, $args, $context, $info));
             }elseif(isset($val[$info->fieldName])){
                 return $val[$info->fieldName];
             }else{
                 return false;
             }
         }else{
             return false;
         }
     }

}