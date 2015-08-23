<?php


function charCodeAt($str, $index)
{
    $char = mb_substr($str, $index, 1, 'UTF-8');
 
    if (mb_check_encoding($char, 'UTF-8'))
    {
        $ret = mb_convert_encoding($char, 'UTF-32BE', 'UTF-8');
        return hexdec(bin2hex($ret));
    }
    else
    {
        return null;
    }
}
function getcurl($url,$post=0,$referer=0,$cookie=0,$header=0,$ua=0,$nobaody=0){
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
			curl_setopt($ch, CURLOPT_NOBODY,1);//主要头部
			//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);//跟随重定向
		}
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		$ret = curl_exec($ch);
		curl_close($ch);
		return $ret;
}

function get_gtk($skey){
	$salt='5381';
	$md5key='tencentQQVIP123443safde&!%^%1282';
	$hash=array();
	$hash[]=$salt << 5;
	for($i=0;$i<strlen($skey);++$i){
		$asc= charCodeAt($skey[$i],0);
		$new=$salt << 5;
		$hash[]= $new + $asc;
		$salt=$asc;
    }
    $gtk=md5(join('',$hash).$md5key);
    return $gtk;
}
$cookie='uin=o0'.$uin.'; skey='.$skey.';';
$gtk=get_gtk($skey);

$qdurl="http://iyouxi.vip.qq.com/ams3.0.php?_c=page&actid=23314&callback=vipSignNew.signCb&g_tk={$gtk}&_=".time()."241";
$get=getcurl($qdurl,0,0,$cookie);
$jfqdurl="http://iyouxi.vip.qq.com/jsonp.php?_c=page&actid=5474&isLoadUserInfo=1&callback=page.signInCb&g_tk={$gtk}&_=".time()."241";
$jfget=getcurl($jfqdurl,0,0,$cookie);

if(preg_match('/signInCb\((.*?)\)\;/',$jfget,$jfjson)){
	$arr=json_decode($jfjson[1],true);
	if($arr[ret]==0){
		exit('{"ret":0,"msg":"'.$uin.'会员积分签到成功！"}');
	}elseif($arr[ret]==10601){
		exit('{"ret":1,"msg":"'.$uin.'今天已经积分签到！"}');
	}elseif($arr[ret]==10002){
		exit('{"ret":-1,"msg":"'.$uin.'积分签到失败！SKEY过期！"}');
	}else{
		exit('{"ret":-1,"msg":"'.$uin.'积分签到失败！原因:'.$arr[msg].'"}');
	}
}

if(preg_match('/signCb\((.*?)\)\;/',$get,$json)){
	$arr=json_decode($json[1],true);
	if($arr[ret]==0){
		exit('{"ret":0,"msg":"'.$uin.'会员签到成功！"}');
	}elseif($arr[ret]==10601){
		exit('{"ret":1,"msg":"'.$uin.'今天已经签到！"}');
	}elseif($arr[ret]==20101){
		exit('{"ret":2,"msg":"'.$uin.'不是QQ会员！"}');
	}elseif($arr[ret]==10002){
		exit('{"ret":-1,"msg":"'.$uin.'会员签到失败！SKEY过期！"}');
	}else{
		exit('{"ret":-1,"msg":"'.$uin.'会员签到失败！原因:'.$arr[msg].'"}');
	}
}