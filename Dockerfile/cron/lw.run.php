<?php
include_once "conn.php";

function sendly($uin,$sid){
	$url = "http://m.qzone.com/gift/giftweb?g_tk=".time();
	$post="action=3&itemid=106084&struin={$uin}&content=%E9%80%81%E4%BD%A0%E4%B8%80%E9%A2%97%E5%B9%B8%E8%BF%90%E6%B0%B4%E6%99%B6%E7%90%83%EF%BC%8C%E5%AF%B9%E7%9D%80%E5%91%86%E8%90%8C%E4%BC%81%E9%B9%85%E7%9C%9F%E5%BF%83%E8%AE%B8%E6%84%BF%E5%B0%B1%E4%BC%9A%E5%AE%9E%E7%8E%B0%E5%93%A6%EF%BC%81&format=json&isprivate=0&sid={$sid}";	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	$ret = curl_exec($ch);
	curl_close($ch);
	$arr = json_decode($ret, true);
	if($_GET['get']==1){
		if($arr['code']==0){
			echo "送礼物成功！";
		}elseif($arr['code']==-3000){
			echo "请先登录";
		}else{
			echo "送礼物失败！";
			}
	echo '<br/>';
		//echo '<br/>'.$post;
	}
	
}


$qid=is_numeric($_GET['qid'])?$_GET['qid']:exit('No Qid!');
$result = mysql_query("SELECT qq FROM {$tableqz}qqs where qid='{$qid}' and islw>0 and sidzt=0 limit 1");
if($row=mysql_fetch_array($result)){
	$uin=$row['qq'];

	$now=date("Y-m-d-H:i:s");

	$next=date("Y-m-d H:i:s",time()+60*60*1-10);
	@mysql_query("update {$tableqz}qqs set lastlw='$now',nextlw='$next' where qid='$qid'");
	
	$result = mysql_query("SELECT sid FROM {$tableqz}qqs where sidzt=0 limit 10");
	while($qq=mysql_fetch_array($result)){
		$con=get_con();
		sendly($uin,$qq['sid'],$con);
	}

	exit('Ok!');
}else{
	exit('Qid Error!');
}
