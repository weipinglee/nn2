<?php


date_default_timezone_set('Asia/Shanghai');

define('APPLICATION_PATH', dirname(__DIR__));

if(\Library\tool::getConfig('error')){
    error_reporting(E_ALL);
}
else{
    error_reporting(0);
}

header("Content-Type:text/html;charset=utf-8");

$application = new Yaf\Application( APPLICATION_PATH . "/conf/application.ini");

$application->bootstrap()->run();
?>
