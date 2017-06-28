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
        'deal'=>'http://124.166.246.120:8000/nn2',
		'user'=>'http://124.166.246.120:8000/nn2/user',
		'admin'=>'http://124.166.246.120:8000/nn2/nnys-admin',
    ),
    'rootDir'=>array(//子系统根目录物理路径
        'user'=>'D:\wamp\www\nn2\user',
		'admin'=>'D:\wamp\www\nn2\nnys-admin',
    ),
	 'sms'=>array(
        'platform'=>'jianzhou',
        'account'=>'sdk_nnyskj',
        'password'=>'nnys882#8k&(npu',
        'sign'=>'【耐耐云商】',
    ),
	 'signBank'=>array(
        'zx'=>array(
            'mainacc'=>8110201013700188144,
            'username'=>'NNYS',
            'ip'=>'192.168.2.46',
            'port'=>'6789',
        ),
    ),
);