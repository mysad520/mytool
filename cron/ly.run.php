<?php
include_once "conn.php";
function sendly($uin,$sid,$con){
	$url = "http://m.qzone.com/msgb/fcg_add_msg";
	$post = "res_uin={$uin}&format=json&content={$con}&opr_type=add_comment&sid={$sid}";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
	curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.0.4; es-mx; HTC_One_X Build/IMM76D) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	$ret = curl_exec($ch);
	curl_close($ch);
	if($_GET['get']==1){
		echo $ret;
	}
}


$qid=is_numeric($_GET['qid'])?$_GET['qid']:exit('No Qid!');
$result = mysql_query("SELECT qq FROM {$tableqz}qqs where qid='{$qid}' and isly>0 and sidzt=0 limit 1");
if($row=mysql_fetch_array($result)){
	$uin=$row['qq'];

	$now=date("Y-m-d-H:i:s");

	$next=date("Y-m-d H:i:s",time()+60*10-10);
	@mysql_query("update {$tableqz}qqs set lastly='$now',nextly='$next' where qid='$qid'");
	
	$result = mysql_query("SELECT sid FROM {$tableqz}qqs where sidzt=0 order by rand() limit 2");
	while($qq=mysql_fetch_array($result)){
		$con=get_con();
		sendly($uin,$qq['sid'],$con);
	}
	exit('Ok!');
}else{
	exit('Qid Error!');
}
