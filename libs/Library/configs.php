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
        'deal'=>'http://localhost/nnzaixian/deal/public',
		'user'=>'http://localhost/nnzaixian/user/public',
		'admin'=>'http://localhost/nnzaixian/admin/public',
    ),
    'rootDir'=>array(//子系统根目录物理路径
        'user'=>'E:\wamp\wamp\www\nnzaixian\user\public',
		'admin'=>'E:\wamp\wamp\www\nnzaixian\admin\public\'',
    ),
	 'sms'=>array(
        'platform'=>'jianzhou',
        'account'=>'jzyy802',
        'password'=>'813813',
        'sign'=>'【建周科技】',
    )
);