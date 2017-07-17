<?php
/**
 * 搜索配置项
 * User: weipinglee
 * Date: 2016/7/21
 * Time: 上午 11:13
 */

namespace conf;
class searchConfig {

    private static $config_arr = array(
        'user' => array(
            'time' => array('create_time','创建时间'),
            'like' => array('username','用户名'),
        ),

    );

    public static function config($tableName=''){
        return isset(self::$config_arr[$tableName]) ? self::$config_arr[$tableName] : array() ;
    }
}