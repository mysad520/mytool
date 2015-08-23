<?php
include_once "conn.php";

$qid=is_numeric($_GET['qid'])?$_GET['qid']:exit('No Qid!');
$result = mysql_query("SELECT * FROM {$tableqz}qqs where qid='{$qid}' and isdel>0 and sidzt=0 limit 1");
if($row=mysql_fetch_array($result)){
	$uin=$row['qq'];
	$sid=$row['sid'];
	$skey=$row['skey'];
	$do=$row['isdel'];
	$now=date("Y-m-d-H:i:s");
	
	$next=date("Y-m-d H:i:s",time()+60*60-10);
	@mysql_query("update {$tableqz}qqs set lastdel='$now',nextdel='$next' where qid='$qid'");
	include_once "qzone.class.php";
	$qzone=new qzone($uin,$sid,$skey);
	if($do==2){
		$qzone->shuodel('pc');
	}else{
		$qzone->shuodel();
	}
	include_once "mail.php";
	exit('Ok!');
}else{
	exit('Qid Error!');
}
