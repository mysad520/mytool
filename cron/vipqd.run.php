<?php
include_once "conn.php";
function get_curl($url,$post=0){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
    if($post){
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
    }
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	$ret = curl_exec($ch);
	curl_close($ch);
	return $ret;
}
$qid=is_numeric($_GET['qid'])?$_GET['qid']:exit('No Qid!');
$result = mysql_query("SELECT * FROM {$tableqz}qqs where qid='{$qid}' and (isvipqd>0 or islq>0) and sidzt=0 limit 1");
if($row=mysql_fetch_array($result)){
	$uin=$row['qq'];
	$sid=$row['sid'];
	$skey=$row['skey'];
	$now=date("Y-m-d-H:i:s");
	$next=date("Y-m-d H:i:s",time()+60*60*8-10);

	$sql='';
	if($row['isvipqd']) $sql.="lastvipqd='$now',";
	if($row['islz']) $sql.="lastlz='$now',";
	if($row['isqb']) $sql.="lastqb='$now',";
	@mysql_query("update {$tableqz}qqs set {$sql}nextvipqd='$next' where qid='$qid'");
	$url="http://www.xxxz.pub/api/dxqd.php?uin={$uin}&sid={$sid}&skey={$skey}&vip={$row[isvipqd]}&lz={$row[islz]}&qb=1";
	echo $url;
	$get=get_curl($url);
	if($_GET['get']){
		echo $get;
	}
	exit('Ok!');
}else{
	exit('Qid Error!');
}
