<?php
include_once "conn.php";

$n=isset($_GET['n'])?$_GET['n']:exit('No Net!');
$nurl=str_replace('del.cron.php','','http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);//获取当前网址
$look=$_GET['get']?'&get=1':'';
$now=date("Y-m-d-H:i:s");
$result = mysql_query("SELECT qid FROM {$tableqz}qqs where isdel>0 and (nextdel<'$now' or nextdel IS NULL) and sidzt=0");

while($row = mysql_fetch_array($result)){ 
	$urls[]="{$nurl}del.run.php?cron=".$_GET['cron']."&qid={$row['qid']}{$look}";
}

if($urls){
	$get=duo_curl($urls);
}
if($_GET['get']==1){
	print_r($get);
}
exit('Ok!');

