<?php

date_default_timezone_set('Asia/Shanghai');

header("Content-Type:text/html;charset=utf-8");

if(\Library\tool::getConfig('error')){
    error_reporting(E_ALL);
}
else{
    error_reporting(0);
}
define('APPLICATION_PATH', dirname(__DIR__));
$application = new \Yaf\Application( APPLICATION_PATH . "/conf/application.ini");

$application->bootstrap()->run();
?>
