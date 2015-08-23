<?php
//error_reporting(0);
error_reporting(E_ALL & ~E_NOTICE);
date_default_timezone_set('PRC');
@header('Content-Type: text/html; charset=UTF-8');
@ignore_user_abort(true);
@set_time_limit(0);

function duo_curl($urls) { 
	$ua='Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.93 Safari/537.36';
	$queue = curl_multi_init(); 
	$map = array();
	foreach ($urls as $url) { 
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL, $url); 
		curl_setopt($ch, CURLOPT_TIMEOUT,30); 
		curl_setopt($ch, CURLOPT_USERAGENT,$ua);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_HEADER, 0); 
		curl_setopt($ch, CURLOPT_NOSIGNAL, true); 
		curl_multi_add_handle($queue, $ch); 
		$map[(string) $ch] = $url; 
	}
	$responses = array(); 
	do { 
		while (($code = curl_multi_exec($queue, $active)) == CURLM_CALL_MULTI_PERFORM) ; 
		if ($code != CURLM_OK) { break; } 
		while ($done = curl_multi_info_read($queue)) { 
			$info = curl_getinfo($done['handle']); 
			$error = curl_error($done['handle']); 
			$results = curl_multi_getcontent($done['handle']);//返回内容
			$responses[$map[(string) $done['handle']]] = compact('info', 'error', 'results'); 
			curl_multi_remove_handle($queue, $done['handle']); 
			curl_close($done['handle']); 
		}
		if ($active > 0) { 
			curl_multi_select($queue, 0.5); 
		} 
	} while ($active);
	curl_multi_close($queue); 
	return $responses; 
}
function get_con($con=0){
	$row=file('../data/content.txt');
	shuffle($row);
	if($con){
		$arr=explode('|',$con);
		shuffle($arr);
		$con=$arr[0];
		return str_replace(array('[时间]','[语录]','[表情]'),array(date("Y-m-d H:i:s"),$row[1],'[em]e'.rand(100,204).'[/em]'),$con);
	}else{
		return $row[0];
	}
}
$mysql=require("../inc/db.php");
$dbhost=$mysql['DB_HOST'].':'.$mysql['DB_PORT'];
$dbuser=$mysql['DB_USER'];
$dbpassword=$mysql['DB_PWD'];
$dbmysql=$mysql['DB_NAME'];
if($con = mysql_connect($dbhost,$dbuser,$dbpassword)){
	mysql_select_db($dbmysql, $con);
}else{
	exit('数据库链接失败！');
}
mysql_query("set names utf8"); 
$tableqz=$mysql['DB_PREFIX'];
$result=mysql_query("select * from {$tableqz}webconfigs");
while($row = mysql_fetch_array($result)){ 
	$config[$row['vkey']]=$row['value'];
}
if($_GET['cron']!=$config['cronrand']){
	exit('监控识别码不正确！');
}
