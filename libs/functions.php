<?php

function C($name=null, $value=null,$default=null) {
    static $_config = array();
    // 无参数时获取所有
    if (empty($name)) {
        return $_config;
    }
    // 优先执行设置获取或赋值
    if (is_string($name)) {
        if (!strpos($name, '.')) {
            $name = strtoupper($name);
            if (is_null($value))
                return isset($_config[$name]) ? $_config[$name] : $default;
            $_config[$name] = $value;
            return;
        }
        // 二维数组设置和获取支持
        $name = explode('.', $name);
        $name[0]   =  strtoupper($name[0]);
        if (is_null($value))
            return isset($_config[$name[0]][$name[1]]) ? $_config[$name[0]][$name[1]] : $default;
        $_config[$name[0]][$name[1]] = $value;
        return;
    }
    // 批量设置
    if (is_array($name)){
        $_config = array_merge($_config, array_change_key_case($name,CASE_UPPER));
        return;
    }
    return null; // 避免非法参数
}


function load_config($table){
	$rows=$db->get_results("select * from {$table} where $tj limit $limit");
}

function safestr($str){
	if(!get_magic_quotes_gpc()){
		return addslashes($str);
	}else{
		return $str;
	}
}

function getip(){
	if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) 
    	$ip = getenv("HTTP_CLIENT_IP"); 
	else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) 
    	$ip = getenv("HTTP_X_FORWARDED_FOR"); 
	else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) 
    	$ip = getenv("REMOTE_ADDR"); 
	else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) 
		$ip = $_SERVER['REMOTE_ADDR']; 
	else 
		$ip = "unknown";
	$ips=explode(', ',$ip);
	return $ip; 
}

function get_ip_city($ip)
{
    $url = 'http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip=';
    @$city = file_get_contents($url . $ip);
    $city = str_replace(array('var remote_ip_info = ', '};'), array('', '}'), $city);
    $city = json_decode($city, true);
    if ($city['city']) {
        $location = $city['city'];
    } else {
        $location = $city['province'];
    }
	if($location){
		return $location;
	}else{
		return;
	}
}

function get_count($table,$where='1=1',$key='*'){
	Global $db;
	$row=$db->get_row("select count($key) as count from ".C('DB_PREFIX')."{$table} where {$where}");
	$count = $row['count'];
    return $count;
}

function get_isvip($vip,$end){
	if($vip){
		if(strtotime($end)>time()){
			return 1;
		}else{
			return 0;
		}
	}else{
		return 0;
	}
}

function getxz($do,$did=0){
	if($do==1){
		if($did){
			return 'btn-success';
		}else{
			return '触屏版';
		}
	}elseif($do==2){
		if($did){
			return 'btn-success';
		}else{
			return 'P&nbsp;C版';
		}
	}else{
		if($did){
			return 'btn-default';
		}else{
			return '已关闭';
		}
	}
}

function getzt($do){
	if($do==2){
		return "<font color=green>P&nbsp;C版</font>";
	}elseif($do==0){
		return "<font color=red>已关闭</font>";
	}else{
		return "<font color=green>触屏版</font>";
	}
}

function zhtime($time=''){
	if($time){
		return str_replace(array('2015-','0000-'),array('',''),$time);
	}else{
		return'00-00 00:00:00';
	}
}

function get_curl($url,$post=0,$referer=0,$cookie=0,$header=0,$ua=0,$nobaody=0){
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
		//curl_setopt($ch, CURLOPT_FOLLOWLOCATION,0);
	}
	curl_setopt($ch, CURLOPT_ENCODING, "gzip");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	$ret = curl_exec($ch);
	curl_close($ch);
	return $ret;
}

function uploadimg($uin,$sid,$image,$image_size=array()){
	$url="http://up.qzone.com/cgi-bin/upload/cgi_upload_pic_v2";
    $post="picture=".urlencode(base64_encode($image))."&base64=1&hd_height=".$image_size[1]."&hd_width=".$image_size[0]."&hd_quality=90&output_type=json&preupload=1&charset=utf-8&output_charset=utf-8&logintype=sid&Exif_CameraMaker=&Exif_CameraModel=&Exif_Time=&uin=".$uin."&sid=".$sid;
    $data=preg_replace("/\s/","",get_curl($url,$post));
	preg_match('/_Callback\((.*)\);/',$data,$arr);
	$data=json_decode($arr[1],true);
    if($data && array_key_exists('filemd5',$data)){
		$post="output_type=json&preupload=2&md5=".$data['filemd5']."&filelen=".$data['filelen']."&batchid=".time().rand(100000,999999)."&currnum=0&uploadNum=1&uploadtime=".time()."&uploadtype=1&upload_hd=0&albumtype=7&big_style=1&op_src=15003&charset=utf-8&output_charset=utf-8&uin=".$uin."&sid=".$sid."&logintype=sid&refer=shuoshuo";
		$img=preg_replace("/\s/","",get_curl($url,$post));
		preg_match('/_Callback\(\[(.*)\]\);/',$img,$arr);
		$data=json_decode($arr[1],true);
        if($data && array_key_exists('picinfo',$data)){
			if($data[picinfo][albumid]!=""){
				return "{$data['picinfo']['albumid']},{$data['picinfo']['lloc']},{$data['picinfo']['sloc']},{$data['picinfo']['type']},{$data['picinfo']['height']},{$data['picinfo']['width']},,,";
			}else{
				return'图片信息获取失败！';
			}
        }else{
            return'图片信息获取失败！';
        }
	}else{
		return'图片上传失败！原因：'.$data['msg'];
    }
}



function get_qqnick($uin,$sid){
    if($data=file_get_contents("http://users.qzone.qq.com/fcg-bin/cgi_get_portrait.fcg?get_nick=1&uins=".$uin)){
		$data=str_replace(array('portraitCallBack(',')'),array('',''),$data);
		$data=mb_convert_encoding($data, "UTF-8", "GBK");
		$row=json_decode($data,true);;
		return $row[$uin][6];
	}
}