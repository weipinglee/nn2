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
        'deal'=>'http://deal.test.com',
		'user'=>'http://user.test.com',
		'admin'=>'http://admin.test.com',
    ),
    'rootDir'=>array(//子系统根目录物理路径
        'user'=>'E:\wamp\www\nn2\user\public',
		'admin'=>'E:\wamp\www\nn2\admin\public',
    ),
	 'sms'=>array(
        'platform'=>'jianzhou',
        'account'=>'jzyy802',
        'password'=>'813813',
        'sign'=>'【建周科技】',
    )
);