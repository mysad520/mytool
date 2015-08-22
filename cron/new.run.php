<?php
include_once "conn.php";

$qid=is_numeric($_GET['qid'])?$_GET['qid']:exit('No Qid!');
$result = mysql_query("SELECT * FROM {$tableqz}qqs where qid='{$qid}' and (iszan>0 or isreply>0 or iszf >0) and sidzt=0 limit 1");
if($row=mysql_fetch_array($result)){
	$uin=$row['qq'];
	$sid=$row['sid'];
	$skey=$row['skey'];
	$now=date("Y-m-d-H:i:s");
	$next=date("Y-m-d H:i:s",time()+60*$row['zanrate']-10);
	$sql='';
	if($row['iszan']) $sql.="lastzan='$now',";
	if($row['isreply']) $sql.="lastreply='$now',";
	if($row['iszf']) $sql.="lastzf='$now',";
	@mysql_query("update {$tableqz}qqs set {$sql}nextzan='$next' where qid='$qid'");
	include_once "qzone.class.php";
	$qzone=new qzone($uin,$sid,$skey);
	if($shuos=$qzone->getnew()){
		foreach($shuos as $shuo){
			$appid=$shuo['comm']['appid'];
			$typeid=$shuo['comm']['feedstype'];
			$curkey=urlencode($shuo['comm']['curlikekey']);
			$uinkey=urlencode($shuo['comm']['orglikekey']);
			$touin=$shuo['userinfo']['user']['uin'];
			$from=$shuo['userinfo']['user']['from'];
			$abstime=$shuo['comm']['time'];
			$cellid=$shuo['id']['cellid'];
			$qzone->touin=$touin;
			if($row['iszan']){
				$like=$shuo['like']['isliked'];
				if($like==0){
					if($row['iszan']==2){
						$qzone->pclike($curkey,$uinkey,$from,$appid,$typeid,$abstime,$cellid);
						if($qzone->skeyzt) break;
					}else{
						$qzone->cplike($touin,$appid,$uinkey,$curkey);
					}
				}
			}
			if($row['iszf']){
				if(stripos('z'.$row['zfok'],$touin)){
					if($row['iszf'] == 2){
						$qzone->pczhuanfa(urlencode(get_con($row['zfcon'])),$touin,$cellid);
						if($qzone->skeyzt) break;
					}else{
						$qzone->cpzhuanfa(urlencode(get_con($row['zfcon'])),$touin,$cellid);
						if($qzone->sidzt) break;
					}
				}
			}
			if($row['isreply']){
				if($qzone->is_comment($uin,$shuo['comment']['comments'])){
					if($row['isreply']==2){
						$richval=0;
						$qzone->pcreply(urlencode(get_con($row['replycon'])),$touin,$cellid,$from,$richval);
						if($qzone->sidzt) break;
					}else{
						$param=$qzone->array_str($shuo['operation']['busi_param']);
						$qzone->cpreply(urlencode(get_con($row['replycon'])),$uin,$cellid,$appid,$param);
					}
				}
			}

		}
	}
	include_once "mail.php";
	exit('Ok!');
}else{
	exit('Qid Error!');
}
