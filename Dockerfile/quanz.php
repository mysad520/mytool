<?php
date_default_timezone_set('PRC');
header("Content-type:text/html;charset=gbk");
$qq = $_GET['qq'];
//$sql=mysql_connect("IP","USER","PASS");
//$data=mysql_select_db("DB",$sql);
$now=date("Y-m-d-H:i:s");
function get_curl($url, $post = 0, $referer = 0, $cookie = 0, $header = 0, $ua = 0, $nobaody = 0)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		if ($post) {
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		}

		if ($header) {
			curl_setopt($ch, CURLOPT_HEADER, true);
		}

		if ($cookie) {
			curl_setopt($ch, CURLOPT_COOKIE, $cookie);
		}

		if ($referer) {
			curl_setopt($ch, CURLOPT_REFERER, "http://m.qzone.com/infocenter?g_f=");
		}

		if ($ua) {
			curl_setopt($ch, CURLOPT_USERAGENT, $ua);
		}
		else {
			curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Linux; U; Android 4.0.4; es-mx; HTC_One_X Build/IMM76D) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0");
		}

		if ($nobaody) {
			curl_setopt($ch, CURLOPT_NOBODY, 1);
		}
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$ret = curl_exec($ch);
		curl_close($ch);
		return $ret;
	}
				$data = get_curl("http://xstool.aliapp.com/quanquanzan/quan.php?jx=".$qq);		
				$no=date("Y-m-d-H:i:s");
				$next=date("Y-m-d H:i:s",time()+60*60*8-10);
				@mysql_query("update {$db}qqs set qqlast='$no',qqnext='$next' where qq='$qq'");
				echo "<script>alert('".$qq."ˢȦȦ�޳ɹ�')</script>";
	

	
		
		
?>