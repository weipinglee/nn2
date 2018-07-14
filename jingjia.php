<?php

//ÅäÖÃyaf
define('ROOT_PATH',__DIR__);
date_default_timezone_set('Asia/Shanghai');
$app = new Yaf\Application(ROOT_PATH."/conf/application.ini");
$config = Yaf\Application::app()->getConfig();
\Yaf\Registry::set('config', $config);
//require_once __DIR__."/lib/nainai/jingjiaSocket.php";


use \nainai\jingjiaSocket;

$jingjia=new jingjiaSocket();
$jingjia->receiveMessage();

$jingjia->run();
?>