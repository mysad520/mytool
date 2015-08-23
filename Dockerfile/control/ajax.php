<?php
require_once('../conn.php');

//判断是否登录
if(!C('loginuid')){
	exit('{"saveOK":-3,"msg":"请先登录！"}');
}
if($_GET['do']=='save'){
	$uin=safestr($_POST['uin']);
	$sid=safestr($_POST['sid']);
	$skey=safestr($_POST['skey']);
	$pwd=safestr($_POST['pwd']);
	if(!$uin) exit('{"saveOK":-1,"msg":"uin不能为空"}');
	if(!$sid) exit('{"saveOK":-1,"msg":"sid不能为空"}');
	if(!$skey) exit('{"saveOK":-1,"msg":"skey不能为空"}');
	$pwd=md5($pwd);
	if($row=$db->get_row("select * from ".C('DB_PREFIX')."qqs where qq='$uin' limit 1")){
		$set="sid='{$sid}',skey='{$skey}',pwd='{$pwd}',sidzt=0,skeyzt=0";
		if($row['iszan']){
			$set.=",iszan=2";
		}
		$db->query("update ".C('DB_PREFIX')."qqs set {$set} where qq='$uin'");
		exit('{"saveOK":0,"msg":"更新成功！"}');
	}else{
		
		if(get_count('qqs',"uid='$userrow[uid]'",'qid')>=$userrow['peie']){
			exit('{"saveOK":-2,"msg":"对不起，你最大允许添加'.$userrow[peie].'个QQ!"}');
		}
		$now=date("Y-m-d H:i:s");
		if ($db->query("insert into  ".C('DB_PREFIX')."qqs (uid,qq,sid,skey,pwd,sidzt,skeyzt,addtime) values ('$userrow[uid]','$uin','$sid','$skey','$pwd',0,0,'$now')")) {
		$data['uid'] = $user[uid];
			exit('{"saveOK":0,"msg":"添加成功！"}');
		}else{
			exit('{"saveOK":-1,"msg":"保存数据库失败"}');
		}
	}
}