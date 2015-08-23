<?php
header('Content-Type: text/html; charset=UTF-8');
error_reporting(E_ALL & ~E_NOTICE);
@ignore_user_abort(true);
@set_time_limit(0);

$uin=$_REQUEST['uin']?$_REQUEST['uin']:exit('{"code":-1,"msg":"No Uin！"}');
$touin=$_REQUEST['touin']?$_REQUEST['touin']:exit('{"code":-1,"msg":"No Touin！"}');
$skey=$_REQUEST['skey']?$_REQUEST['skey']:exit('{"code":-1,"msg":"No Skey！"}');
$url="http://www.xxxz.pub/api/qqdel.php?uin={$uin}&skey={$skey}&touin={$touin}&websid=123456";
echo @file_get_contents($url);