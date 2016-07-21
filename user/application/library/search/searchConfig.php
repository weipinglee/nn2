<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/14 0014
 * Time: 上午 11:13
 */

namespace search;
class searchConfig {

    private static $config_arr = array(
        'order_sell' => array(
            'time'=>array('do.create_time','生成时间'),
            'like' => array('do.order_no','合同号'),
        ),

    );

    public static function config($tableName=''){
        return isset(self::$config_arr[$tableName]) ? self::$config_arr[$tableName] : array() ;
    }
}