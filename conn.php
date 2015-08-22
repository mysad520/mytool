<?php
@error_reporting(E_ALL & ~E_NOTICE);
@date_default_timezone_set('PRC');
@header('Content-Type: text/html; charset=UTF-8');
if(!file_exists(dirname(__FILE__).'/inc/db.php')){
	@header("Location:/install");
	exit();
}

require_once "libs/360_safe3.php";
include_once "libs/functions.php";
$mysql=require("inc/db.php");
C($mysql);//加载数据库信息
include_once "libs/ez_sql_core.php";
include_once "libs/ez_sql_mysql.php";
$db=new ezSQL_mysql(C('DB_USER'),C('DB_PWD'),C('DB_NAME'),C('DB_HOST').':'.C('DB_PORT'));
$db->query("set names utf8"); 

//加载配置
if($rows=$db->get_results("select * from ".C('DB_PREFIX')."webconfigs")){
	foreach($rows as $row){
		$webconfig[$row['vkey']]=$row['value'];
	}
	C($webconfig);
}

//判断是否登录
$cookiesid=$_COOKIE['klsf_sid'];
if($cookiesid && $userrow=$db->get_row("select * from ".C('DB_PREFIX')."users where sid ='$cookiesid' limit 1")){
	C('loginuser',$userrow['user']);
	C('loginuid',$userrow['uid']);
}