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
        'deal'=>'http://localhost/nnbug/deal/public',
		'user'=>'http://localhost/nnbug/user/public',
		'admin'=>'http://localhost/nnbug/admin/public',
    ),
    'rootDir'=>array(//子系统根目录物理路径
        'user'=>'E:\wamp\wamp\www\nnbug\user\public',
		'admin'=>'D:\wamp\wamp\www\nnbug\admin\public',
    ),
	 'sms'=>array(
        'platform'=>'jianzhou',
        'account'=>'jzyy802',
        'password'=>'813813',
        'sign'=>'【建周科技】',
    )
);