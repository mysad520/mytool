<?php
include_once "conn.php";

$qid=is_numeric($_GET['qid'])?$_GET['qid']:exit('No Qid!');
$result = mysql_query("SELECT * FROM {$tableqz}qqs where qid='{$qid}' and (isht>0 or ists>0) and sidzt=0 limit 1");
if($row=mysql_fetch_array($result)){
	$now=date("Y-m-d-H:i:s");
	$next=date("Y-m-d H:i:s",time()+60*60*8-10);
	$sql='';
	if($row['isht']) $sql.="lastht='$now',";
	if($row['ists']) $sql.="lastts='$now',";
	@mysql_query("update {$tableqz}qqs set {$sql}nextht='$next' where qid='$qid'");

	$qq=$row['qq'];
	$sid=$row['sid'];
	if($row[ists]){
		$ts = file_get_contents('http://ebook.3g.qq.com/user/v3/normalLevel/sign?sid='.$sid.'&g_ut=2');
		if($_GET['get']){
			echo $ts;
		}
	}

	if($row[isht]){
	$ht = file_get_contents('http://wap.flower.qzone.com/cgi-bin/get_profile_page?sid=' . $sid . '&B_UID=' . $qq);
	if($_GET['get']){
		echo $ht;
	}
	if (preg_match('/浇花/', $ht)) {
		$url='http://wap.flower.qzone.com/cgi-bin/plant_flower?act=rain&B_UID=' . $qq . '&sid=' . $sid . '&g_ut=2';
		$html=file_get_contents($url);
		if($_GET['get']){
			echo $html;
		}
	}
	if (preg_match("/修剪/", $ht)) {
		$url='http://wap.flower.qzone.com/cgi-bin/plant_flower?act=love&B_UID=' . $qq . '&sid=' . $sid . '&g_ut=2';
		$html=file_get_contents($url);
		if($_GET['get']){
			echo $html;
		}
	}
	if (preg_match("/日照/", $ht)) {
		$url='http://wap.flower.qzone.com/cgi-bin/plant_flower?act=sun&B_UID=' . $qq . '&sid=' . $sid . '&g_ut=2';
		$html=file_get_contents($url);
		if($_GET['get']){
			echo $html;
		}
	}
	if (preg_match("/施肥/", $ht)) {
		$url='http://wap.flower.qzone.com/cgi-bin/plant_flower?act=nutri&B_UID=' . $qq . '&sid=' . $sid . '&g_ut=2';
		$html=file_get_contents($url);
		if($_GET['get']){
			echo $html;
		}
	}
	}
	exit('Ok!');
}else{
	exit('Qid Error!');
}
