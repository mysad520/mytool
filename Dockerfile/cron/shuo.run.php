<?php
include_once "conn.php";

$qid=is_numeric($_GET['qid'])?$_GET['qid']:exit('No Qid!');
$result = mysql_query("SELECT * FROM {$tableqz}qqs where qid='{$qid}' and isshuo>0 and sidzt=0 limit 1");
if($row=mysql_fetch_array($result)){

	$uin=$row['qq'];
	$sid=$row['sid'];
	$skey=$row['skey'];
	$do=$row['isshuo'];
	$now=date("Y-m-d-H:i:s");
	$next=date("Y-m-d H:i:s",time()+60*$row['shuorate']-10);
	@mysql_query("update {$tableqz}qqs set lastshuo='$now',nextshuo='$next' where qid='$qid'");

	$sname=$row['shuophone'];
	$con=urlencode(get_con($row['shuoshuo']));
	$pic=urlencode($row['shuopic']);
	if($pic==1){
		$row=file('../data/pic.txt');
		shuffle($row);
		$pic=$row[0];
		$type=0;
	}else{
		$type=stripos('z'.$pic,'http')?0:1;
	}
	$pic=trim($pic);
	include_once "qzone.class.php";
	$qzone=new qzone($uin,$sid,$skey);
	if($do==2 && $row['skeyzt']==0){
		$qzone->shuo('pc',$con,$pic,$type,$sname);
	}else{
		$qzone->shuo(0,$con,$pic,$type,$sname);
	}
	include_once "mail.php";
	exit('Ok!');
}else{
	exit('Qid Error!');
}
