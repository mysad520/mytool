<?php
$qq=$_GET['qq'];
if(empty($qq)==true){
	exit('<script>
	var uin=prompt("请输入您要查询的QQ","");//将输入的内容赋给变量 uin ，
    //这里需要注意的是，prompt有两个参数，前面是提示的话，后面是当对话框出来后，在对话框里的默认值
if(!/^(\+|-)?(\d+)(\.\d*)?$/g.test(uin)){ 

                document.write("请输入正确的QQ号！如需再次查询，请刷新本页！"); 

            }else if(uin)//如果返回的有内容
    {
		var str=uin.length;
		if(str < 5 || str >10){
			document.write("请输入大于4小于10的QQ号！如需再次查询，请刷新本页！"); 
		}else{
			window.location.href="/music.php?qq="+uin;
		}
         
     }else{
		 document.write("请输入要查询的QQ！如需再次查询，请刷新本页！");
	 }
	
	</script>');
}
else{
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0,user-scalable=no,minimal-ui">
<meta name="MobileOptimized" content="320">
<meta http-equiv="cleartype" content="on">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<title>QQ空间背景音乐查询</title>
<meta name="Keywords" content="离线秒赞平台，全网最大的免费QQ秒赞网"/>
<meta name="Description" content="离线秒赞网，最好的秒赞网，最快，最稳定的秒赞网"/><link href="http://cdn.bootcss.com/bootstrap/3.2.0/css/bootstrap.css" rel="stylesheet" type="text/css"/>
<link href="/css/style.css" rel="stylesheet" type="text/css"/>
<link href="/css/user.css" rel="stylesheet" type="text/css"/>
<link href="/css/common.css" rel="stylesheet" type="text/css"/>
<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>';
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

function islogin(){
if(empty($_COOKIE['xiha_sid'])==true){
return false;
}else{
	return true;
}
}
echo '
<body>
<div class="navbar navbar-default navbar-fixed-top affix" role="navigation">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">离线秒赞网</span>
     
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="/">离线秒赞网</a>
	<p class="navbar-text pull-left text-muted hidden-xs hidden-sm"><small class="text-muted text-sm"><em></em></small></p>
  </div>
<body background="images/bg.png">
  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
	  <li class="active" ><a href="/">首页</a></li>';
       echo '           
</ul> 
</div>
    <!-- /.navbar-collapse -->
</div>
<div class="container" style="margin-top:10%;">	
	
	
	<div class="panel panel-primary">
		<div  class="panel-heading">
			<h3 class="panel-title" align="center">QQ空间背景音乐查询</h3>
		</div>
        <div class="panel-body" align="center">
  <div class="row-fluid">
    <div class="span12"> 
      <section id="dropdowns">
                <table class="table table-bordered table-striped">
       
';

echo '
          <thead>
            <tr>
              <td align="center" valign="middle"><span style="color:silver;"><b>歌曲名字</b></span></td>
              <td align="center" valign="middle"><span style="color:silver;"><b>下载链接</b></span></td>
              
            </tr>
          </thead>


               ';



	 $qqurl='http://qzone-music.qq.com/fcg-bin/cgi_playlist_xml.fcg?json=1&uin='.$qq.'&g_tk=5381';
	 $url = get_curl($qqurl);
 $url = mb_convert_encoding($url, "UTF-8", "GB2312");
							  preg_match_all('@xsong_name\:\"(.*)\"@Ui',$url,$arr);
							  preg_match_all('@xqusic_id:(.*),xctype:(.*),xexpire_time@Ui',$url,$xqusic);
							  preg_match_all('@xsong_url\:\'(.*)\'@Ui',$url,$arrurl);
							  preg_match_all('@xsinger_name\:\"(.*)\"@Ui',$url,$singger);
							  $n = count($arr[1]);
							 
/*function arrContentReplact($array)
{
        if(is_array($array))
        {
                foreach($array as $k => $v)
                {
                $array[$k] = arrContentReplact($array[$k]);
                }
        }else
        {
                $array = str_replace(array('<![CDATA[', ']]>'), array('', ''), $array);
        }
        return $array;
}
$singerarr=arrContentReplact($singer_name[1]);
$songarr=arrContentReplact($song_name[1]);
$urlarr=arrContentReplact($song_url[1]);
$con = count($urlarr); 
for($i=0;$i<$song_num[1][0];$i++){
	$j++;
$singer = iconv("GB2312","UTF-8//IGNORE",trim($singerarr[$i]));
$song = iconv("GB2312","UTF-8//IGNORE",trim($songarr[$i]));
$qqurl=trim($urlarr[$i]);
$singurl = str_replace('.wma','.mp3' ,$qqurl);*/
for($i=0;$i<$n;$i++){
echo '<thead>
            <tr>
              <td align="center" valign="middle">'.$arr[1][$i] .'-'. $singger[1][$i].'</td>'.'<td align="center" valign="middle"><a href="http://ws.stream.qqmusic.qq.com/'.$xqusic[1][$i].'.m4a?fromtag=6">下载</a></td></tr>
          </thead>';
} 


	 
 
 	echo '	
		 </table>
		</div>
	</div>
	</div>
	</div>
	<div align="center">空间背景音乐查询&copy;<a href="/" style="color:bule;">离线秒赞网</a></div>
</div>
</body>
</center>
	</ul>
</div>';
}
?>
