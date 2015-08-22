<?php
$uin=$row['qq'];
$pwd=$row['pwd'];
function klsfcurl($url,$post=0,$referer=0,$cookie=0,$header=0,$ua=0,$nobaody=0){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	if($post){
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	}
	if($header){
		curl_setopt($ch, CURLOPT_HEADER, TRUE);
	}
	if($cookie){
		curl_setopt($ch, CURLOPT_COOKIE, $cookie);
	}
	if($referer){
		curl_setopt($ch, CURLOPT_REFERER, "http://m.qzone.com/infocenter?g_f=");
	}
	if($ua){
		curl_setopt($ch, CURLOPT_USERAGENT,$ua);
	}else{
		curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.0.4; es-mx; HTC_One_X Build/IMM76D) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0');
	}
	if($nobaody){
		curl_setopt($ch, CURLOPT_NOBODY,1);//主要头部
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION,0);
	}
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_ENCODING, "gzip");
	$ret = curl_exec($ch);
	curl_close($ch);
	return $ret;
}
function checkvc($uin){
	$url='http://check.ptlogin2.qzone.com/check?pt_tea=1&uin='.$uin.'&appid=549000929&ptlang=2052&r=0.071823'.time();
	$data=klsfcurl($url);
	if(preg_match("/ptui_checkVC\('(.*?)'\);/", $data, $arr)){
		$r=explode("','",$arr[1]);
		if($r[0]==0){
			return array('0',$r[1],$r[3]);
		}else{
			return array('1');
		}
	}else{
		return array('2');
	}
}
function getsid($url,$do=0){
	$ret = klsfcurl($url,0,0,0,1);
	if(preg_match("/Location:(.*)\r\n/iU", $ret,$u)){
		$sid=explode('sid=',$u[1]);
		$sid=explode('&',$sid[1]);
		return trim($sid[0]);
	}elseif(
		preg_match("/sid=(.{24})/iU", $ret,$u)){
		return trim($u[1]);
	}else{
		$url=str_replace('http://z.qq.com/index.jsp?','http://m.qzone.com/infocenter?',$url);
		$ret = klsfcurl($url);
	if(preg_match('/\{"sid":"(.{24})"/iU', $ret,$sid)){
		return $sid[1];
		}
	}
}
function qqlogin($uin,$p,$vcode,$pt_verifysession){
	$v1=0;
	$url='http://ptlogin2.qzone.com/login?verifycode='.$vcode.'&u='.$uin.'&p='.$p.'&pt_randsalt=0&ptlang=2052&low_login_enable=0&u1=http%3A%2F%2Fm.qzone.com%2Finfocenter%3Fg_f%3D&from_ui=1&fp=loginerroralert&device=2&aid=549000929&pt_ttype=1&pt_3rd_aid=0&ptredirect=1&h=1&g=1&pt_uistyle=9&pt_vcode_v1='.$v1.'&pt_verifysession_v1='.$pt_verifysession.'&';
	$ret = klsfcurl($url,0,0,0,1);
	if(preg_match("/ptuiCB\('(.*?)'\);/", $ret, $arr)){
		$r=explode("','",$arr[1]);
		if($r[0]==0){
			preg_match('/skey=(@.{9});/',$ret,$skey);
			$array['uin']=$uin;
			$array['skey']=$skey[1];
			if($sid=getsid($r[2])){
				$array['sid']=$sid;
			}
			return $array;
		}elseif($r[0]==4){
			return 0;
		}elseif($r[0]==3){
			return 0;
		}elseif($r[0]==19){
			return 0;
		}else{
			return 0;
		}
	}else{
		return 0;
	}
}
@mysql_query("UPDATE {$tableqz}qqs SET lastauto='$now' WHERE qid='{$qid}'");
$check=checkvc($uin);
if($check[0]==0){
	$vcode=$check[1];
	$json=file_get_contents("http://qqapp.aliapp.com/?uin={$uin}&pwd=".strtoupper($pwd)."&vcode=".strtoupper($vcode)."&r=".time());
	
	$p=$json;
	if($arr=qqlogin($uin,$p,$vcode,$check[2])){
		if($sid=$arr['sid']){
			$sql="sid='{$sid}',";
		}
		@mysql_query("UPDATE {$tableqz}qqs SET {$sql}skey='{$arr['skey']}',sidzt='0',skeyzt='0' WHERE qid='{$qid}'");
		exit('Update Success!');
	}else{
		echo'Update failed!';
	}
}else{
	echo 'Need Code';
}
