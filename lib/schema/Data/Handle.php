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

    public static $instances = array();

    public static function getInstance($type){
        $type = strval($type);
        if(isset(self::$instances[$type])){
            return self::$instances[$type];
        }else{
            $class = '\schema\Data\\'.ucfirst($type);
            $file = __DIR__.'/'.ucfirst($type).'.php';
            if(file_exists($file) && class_exists($class)){
                self::$instances[$type] = new $class();
                return self::$instances[$type];
            }
        }
        return null;

    }

    public static function bufferAdd($id,$info){
        $name = strval($info->returnType);

        if(!isset(self::$buffer[$name])){
            self::$buffer[$name] = array();
            self::$buffer[$name]['id'] = array();
            self::$buffer[$name]['field'] = array();
        }

        if(!in_array($id,self::$buffer[$name]['id'])){
            self::$buffer[$name]['id'][] = $id;
        }

        self::$buffer[$name]['field'] =
            array_merge(self::$buffer[$name]['field'],$info->getFieldSelection());
        self::$buffer[$name]['data'] = false;


    }

    public static function loadBuffer($args, $context, $info){
        $name = strval($info->returnType);
        if(!self::$buffer[$name]['data']){//不存在缓存
            $class = self::getInstance($info->returnType);
            $fields = array_keys(self::$buffer[$name]['field']);
            //如果class未实例化，下面的式子返回false
            self::$buffer[$name]['data'] = call_user_func_array(array($class,'loadBuffer'),array($args, $context,
                self::$buffer[$name]['id'],$fields));
        }
        return true;

    }

     public static function findOne($val, $args, $context, $info)
     {
         $class = self::getInstance($info->returnType);
         if($class){
             return call_user_func_array(array($class,'findOne'),array($val, $args, $context, $info));
         }elseif(isset($val[$info->fieldName])){
             return $val[$info->fieldName];
         }else{
             return false;
         }

     }

     public static function findList($val, $args, $context, $info){
         if(strpos($info->returnType,'[',0)!==false){
             $returnType = substr($info->returnType,1,strlen($info->returnType)-2);
             $class = self::getInstance($returnType);
             if($class){
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