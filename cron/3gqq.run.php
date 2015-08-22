<?php
include_once "conn.php";
function get_curl($url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.0.4; es-mx; HTC_One_X Build/IMM76D) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0');
	curl_setopt($ch, CURLOPT_ENCODING, "gzip");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	$ret = curl_exec($ch);
	curl_close($ch);
	return $ret;
}
$qid=is_numeric($_GET['qid'])?$_GET['qid']:exit('No Qid!');
$result = mysql_query("SELECT * FROM {$tableqz}qqs where qid='{$qid}' and is3gqq>0 and sidzt=0 limit 1");
if($row=mysql_fetch_array($result)){
	$uin=$row['qq'];
	$sid=$row['sid'];
	$now=date("Y-m-d-H:i:s");
	
	$next=date("Y-m-d H:i:s",time()+60*5-10);
	@mysql_query("update {$tableqz}qqs set last3gqq='$now',next3gqq='$next' where qid='$qid'");

	@get_curl('http://pt.3g.qq.com/s?aid=nLogin3gqqbysid&3gqqsid='.$sid);
	@get_curl('http://q32.3g.qq.com/g/s?sid='.$sid.'&s=10&aid=chgStatus');
	exit('Ok!');
}else{
	exit('Qid Error!');
}
