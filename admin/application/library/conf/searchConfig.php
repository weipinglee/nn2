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
        'user_bank' => array(
            'time'=>array('b.apply_time','申请时间'),
            'like' => array('u.username,b.identify_no','用户名，身份证号'),
            'down' => 1
        ),

        'recharge_order' => array(
            'time'=>array('r.create_time','申请时间'),
            'like' => array('r.order_no,u.username','用户名，订单号'),
            'down' => 1
        ),
        'withdraw_request' => array(
            'time'=>array('w.create_time','申请时间'),
            'like' => array('w.request_no,u.username','用户名，订单号'),
            'down' => 1
        ),
        'user_account' => array(
            'like' => array('u.mobile,u.username','用户名，手机号'),
            'between' => array('a.credit','信誉保证金'),
            'down' => 1
        ),
        'configs_general' => array(
            'like'=>array('c.name,c.name_zh','英文名，中文名'),
            'select'=> array('c.type','配置类型')
        ),
        'order_sell' => array(
            'like'=>array('o.order_no,o.order_no','订单号'),
            'time'=>array('o.create_time','创建时间'),
        ),
        'product_offer' => array(
            'time'=>array('o.apply_time','创建时间'),
            'select' => array('o.mode','报盘类型'),
            'like'=>array('o.id,p.name','报盘id,商品名称')

        ),
        'user'       => array(
            'like' => array('u.username,u.email,u.mobile','用户名、手机号、邮箱'),
        ),
        'dealer' => array(
            'time' => array('c.apply_time','申请时间'),
            'like' => array('u.username,u.mobile','用户名，手机号'),
            'select' => array('u.type','用户类型')
        ),
        'store_manager' => array(
            'time' => array('c.apply_time','申请时间'),
            'like' => array('u.username,u.mobile','用户名，手机号'),
            'select' => array('u.type','用户类型')
        ),


    );

    public static function config($tableName=''){
        return isset(self::$config_arr[$tableName]) ? self::$config_arr[$tableName] : array() ;
    }
}