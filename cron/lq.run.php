<?php
include_once "conn.php";

$qid=is_numeric($_GET['qid'])?$_GET['qid']:exit('No Qid!');
$result = mysql_query("SELECT * FROM {$tableqz}qqs where qid='{$qid}' and islq>0 and sidzt=0 limit 1");
if($row=mysql_fetch_array($result)){
	$uin=$row['qq'];
	$sid=$row['sid'];
	$skey=$row['skey'];
	$gtk=$row['sgtk'];
	$now=date("Y-m-d-H:i:s");
	$next=date("Y-m-d H:i:s",time()+60*60*8-10);
	@mysql_query("update {$tableqz}qqs set lastlq='$now',nextlq='$next' where qid='$qid'");
	include_once "qzone.class.php";
	$qzone=new qzone($uin,$sid,$skey);
	$qzone->lzqd();
	include_once "mail.php";
	exit('Ok!');
	$qzone->error[1];
}else{
	exit('Qid Error!');
}
