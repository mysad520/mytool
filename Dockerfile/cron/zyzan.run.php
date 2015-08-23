<?php
include_once "conn.php";

$qid=is_numeric($_GET['qid'])?$_GET['qid']:exit('No Qid!');
$result = mysql_query("SELECT qq FROM {$tableqz}qqs where qid='{$qid}' and iszyzan>0 and sidzt=0 limit 1");
if($row=mysql_fetch_array($result)){
	$uin=$row['qq'];
	$now=date("Y-m-d-H:i:s");
	$next=date("Y-m-d H:i:s",time()+60*60*8-10);
	@mysql_query("update {$tableqz}qqs set lastzyzan='$now',nextzyzan='$next' where qid='$qid'");
	include_once "qzone.class.php";
	$result = mysql_query("SELECT * FROM {$tableqz}qqs where skeyzt=0 and sidzt=0 order by rand()");
	while($qq=mysql_fetch_array($result)){
		$qid=$qq['qid'];
		$qzone=new qzone($qq['qq'],$qq['sid'],$qq['skey']);
		$qzone->zyzan($uin);
		$row=$qq;
		include_once "mail.php";
	}

	exit('Ok!');
}else{
	exit('Qid Error!');
}
