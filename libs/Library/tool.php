<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/18 0018
 * Time: 上午 9:28
 */
namespace Library;
class tool{

    //全局配置
    private static $globalConfigs = array();
    /**
     * 获取application.ini中的配置项，并转化为数组
     * @param string $name 配置名称
     * @return mix 如果没有改配置信息则返回null
     */
    public static function getConfig($name=null){
        $configObj = \Yaf\Registry::get("config");
        if($configObj===false){
            $configObj = Yaf\Application::app()->getConfig();
        }
        if($name!=null){
            if(!is_array($name)){
                $configObj = isset($configObj->$name) ? $configObj->$name : null;
            }
            else{
                foreach($name as $v){
                    if($configObj==null)break;
                    $configObj = isset($configObj->$v) ? $configObj->$v : null;
                }
            }

        }
        if(is_object($configObj))
            return $configObj->toArray();
        else if(is_null($configObj))
            return array();
        else return $configObj;
    }

    public static function getBasePath(){
        return APPLICATION_PATH.'/public/';
    }

    /**
     * 将图片路径加上@当前系统名
     * @param string $imgSrc 图片相对路径
     * @return string
     */
    public static function setImgApp($imgSrc){
        $name = self::getConfig(array('application','name'));
        if(!is_string($name)){
            $name = '';
        }
        return ($imgSrc!='' && strpos($imgSrc,'@')===false) ? $imgSrc.'@'.$name : $imgSrc;

    }

    //获取全局配置信息
    public static function getGlobalConfig($name=null){
        if(empty(self::$globalConfigs)){
            self::$globalConfigs = require 'configs.php';
        }

        if($name==null)
            return self::$globalConfigs;
        elseif(is_string($name))
            return isset(self::$globalConfigs[$name]) ?self::$globalConfigs[$name] : null ;
        else if(is_array($name)){
            $temp = self::$globalConfigs;
            foreach($name as $v){
                if(isset($temp[$v])){
                    $temp = $temp[$v];
                }
                else return null;
            }
            return $temp;
        }
    }

    public static function getSuccInfo($res=1,$info='',$url=''){
        return array('success'=>$res,'info'=>$info,'return'=>$url);
    }


}