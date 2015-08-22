<?php
include_once "conn.php";

$qid=is_numeric($_GET['qid'])?$_GET['qid']:exit('No Qid!');
$result = mysql_query("SELECT * FROM {$tableqz}qqs where qid='{$qid}' and iszan>0 and sidzt=0 limit 1");
if($row=mysql_fetch_array($result)){
	$uin=$row['qq'];
	$sid=$row['sid'];
	$skey=$row['skey'];
	$do=$row['iszan'];
	$now=date("Y-m-d-H:i:s");
	@mysql_query("update {$tableqz}qqs set lastzan='$now',nextzan='$now' where qid='$qid'");
	include_once "qzone.class.php";
	$qzone=new qzone($uin,$sid,$skey);
	if($do==2){
		$qzone->like('pc');
	}else{
		$qzone->like();
	}
	include_once "mail.php";
	exit('Ok!');
}else{
	exit('Qid Error!');
}
