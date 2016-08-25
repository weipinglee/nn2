<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/10 0010
 * Time: 下午 4:43
 */
namespace Library;
return array(
    'host'=>array(//各子系统域名列表，最后不加'/'
        'deal'=>'http://124.166.246.120:8000/nn2/deal/public',
        'user'=>'http://124.166.246.120:8000/nn2/user/public',
        'admin'=>'http://124.166.246.120:8000/nn2/admin/public',
    ),
    'rootDir'=>array(//子系统根目录物理路径
        'user'=>'D:\wamp\www\nn2\user\public',
        'admin'=>'D:\wamp\www\nn2\admin\public',
        'deal'=>'D:\wamp\www\nn2\deal\public'
    ),
     'sms'=>array(
        'platform'=>'jianzhou',
        'account'=>'jzyy802',
        'password'=>'813813',
        'sign'=>'【耐耐网】',
    )
);