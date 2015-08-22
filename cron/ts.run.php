<?php
include_once "conn.php";

$qid=is_numeric($_GET['qid'])?$_GET['qid']:exit('No Qid!');
$result = mysql_query("SELECT * FROM {$tableqz}qqs where qid='{$qid}' and ists>0 and sidzt=0 limit 1");
if($row=mysql_fetch_array($result)){
	$now=date("Y-m-d-H:i:s");
	$next=date("Y-m-d H:i:s",time()+60*60*8-10);
	@mysql_query("update {$tableqz}qqs set lastts='$now',nextts='$next' where qid='$qid'");

	$sid=$row['sid'];
	$ts = file_get_contents('http://ebook.3g.qq.com/user/v3/normalLevel/sign?sid='.$sid.'&g_ut=2');
	if($_GET['get']){
		echo $ts;
	}
	exit('Ok!');
}else{
	exit('Qid Error!');
}
