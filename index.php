<?php
// phpinfo();exit;
date_default_timezone_set('Asia/Shanghai');
// error_reporting(E_ALL);
define('APPLICATION_PATH', __DIR__);
header("Access-Control-Allow-Origin: *");
header("Content-Type:text/html;charset=utf-8");
header('X-Frame-Options: SAMEORIGIN');
$application = new Yaf\Application( APPLICATION_PATH . "/conf/application.ini");

$application->bootstrap()->run();
?>
