<?php
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.ww78.net All rights reserved.
// +----------------------------------------------------------------------
// | Author: 快乐是福 <815856515@qq.com>
// +----------------------------------------------------------------------
// | QQ: 815856515
// +----------------------------------------------------------------------
// | 如需修改和引用，请保留此头部信息！
// +----------------------------------------------------------------------

header('Content-Type: text/html; charset=UTF-8');
error_reporting(E_ALL & ~E_NOTICE);
session_start();
$uin=$_REQUEST['uin'];
$sid=$_REQUEST['sid'];
$url="http://m.qzone.com/friend/mfriend_list?res_uin={$uin}&res_type=normal&format=json&count_per_page=10&page_index=0&page_type=0&mayknowuin=&qqmailstat=&sid={$sid}";
$json=get_curl($url,0,'http://m.qzone.com/infocenter?g_ut=3&g_f=6676');
$json=mb_convert_encoding($json, "UTF-8", "UTF-8");
$arr=json_decode($json,true);
if($arr['code']==-3000){
	exit('{"code":-1,"msg":"SID过期！"}');
}
$hycount=count($arr['data']['list']);
$dxrow[code]=0;
$dxrow[msg]='suc';
$n=1;$i=0;
foreach($arr['data']['list'] as $row){
	$touin=$row[uin];
	$i++;
	if(!isset($_SESSION["o".$uin]["$touin"])){
		$url="http://m.qzone.com/friendship/get_friendship?fromuin={$uin}&touin={$touin}&isReverse=1&res_type=4&refresh_type=1&format=json&sid={$sid}";
		$json=get_curl($url,0,'http://m.qzone.com/infocenter?g_ut=3&g_f=6676');
		$arr=json_decode($json,true);
		if($ship=$arr['data']['friendShip']){
			$addtime=$ship[0]['add_friend_time'];
			$_SESSION['o'.$uin]["$touin"]=$addtime;
			if($addtime==-1){
				$dxrow[dxrow][]=$row;
				$_SESSION['klsf_dxrow']["$uin"][]=$row;
			}
		}
		$n++;
	}
	if($n>10) break;
}
if($i==$hycount){
	$dxrow['finish']=1;
}else{
	$dxrow['finish']=0;
}
$dxrow['count']=$i;
$dxrow['dxcount']=count($_SESSION['klsf_dxrow']["$uin"]);
exit(json_encode($dxrow));



	 function get_curl($url,$post=0,$referer=0,$cookie=0,$header=0,$ua=0,$nobaody=0){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
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
			if($referer==1){
				curl_setopt($ch, CURLOPT_REFERER, "http://m.qzone.com/infocenter?g_f=");
			}else{
				curl_setopt($ch, CURLOPT_REFERER, $referer);
			}
		}
		if($ua){
			curl_setopt($ch, CURLOPT_USERAGENT,$ua);
		}else{
			curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.0.4; es-mx; HTC_One_X Build/IMM76D) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0');
		}
		if($nobaody){
			curl_setopt($ch, CURLOPT_NOBODY,1);
		}
		curl_setopt($ch, CURLOPT_ENCODING, "gzip");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		$ret = curl_exec($ch);
		curl_close($ch);
		return $ret;
	}