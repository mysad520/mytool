<?php
include_once "conn.php";

$qid=is_numeric($_GET['qid'])?$_GET['qid']:exit('No Qid!');
$result = mysql_query("SELECT * FROM {$tableqz}qqs where qid='{$qid}' and isqd>0 and sidzt=0 limit 1");
if($row=mysql_fetch_array($result)){
	$uin=$row['qq'];
	$sid=$row['sid'];
	$skey=$row['skey'];
	$do=$row['isqd'];
	$now=date("Y-m-d-H:i:s");
	
	$con=urlencode(get_con($row['qdcon']));
	$lid=10319;
	$next=date("Y-m-d H:i:s",time()+60*60*8-10);
	@mysql_query("update {$tableqz}qqs set lastqd='$now',nextqd='$next' where qid='$qid'");
	include_once "qzone.class.php";
	$qzone=new qzone($uin,$sid,$skey);
	if($do==2){
		$qzone->qiandao('pc',$con,$lid);
	}else{
		$qzone->qiandao(0,$con,$lid);
	}
	include_once "mail.php";
	exit('Ok!');
}else{
	exit('Qid Error!');
}
