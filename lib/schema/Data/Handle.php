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
     public static function findOne($val, $args, $context, $info)
     {
         $class = '\schema\Data\\'.ucfirst($info->fieldName);
         $file = __DIR__.'/'.ucfirst($info->fieldName).'.php';
         if(file_exists($file) && class_exists($class)){
             return call_user_func_array(array($class,'findOne'),array($val, $args, $context, $info));
         }elseif(isset($val[$info->fieldName])){
             return $val[$info->fieldName];
         }else{
             return false;
         }

     }
}