<?php
header('Content-Type: text/html; charset=UTF-8');
error_reporting(0);
@ini_set("short_open_tag", "on");
date_default_timezone_set('PRC');
$mysql=require("inc/db.php");
$dbhost=$mysql['DB_HOST'].':'.$mysql['DB_PORT'];
$dbuser=$mysql['DB_USER'];
$dbpassword=$mysql['DB_PWD'];
$dbmysql=$mysql['DB_NAME'];
if($con = mysql_connect($dbhost,$dbuser,$dbpassword)){
	mysql_select_db($dbmysql, $con);
}else{
	exit('数据库链接失败！');
}
mysql_query("set names utf8"); 
$tableqz=$mysql['DB_PREFIX'];
$result=mysql_query("select * from {$tableqz}webconfigs");
while($row = mysql_fetch_array($result)){ 
	$config[$row['vkey']]=$row['value'];
}
function get_qqnick($uin){
    if($data=file_get_contents("http://users.qzone.qq.com/fcg-bin/cgi_get_portrait.fcg?get_nick=1&uins=".$uin)){
		$data=str_replace(array('portraitCallBack(',')'),array('',''),$data);
		$data=mb_convert_encoding($data, "UTF-8", "GBK");
		$row=json_decode($data,true);;
		return $row[$uin][6];
	}
}
function get_curl($url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.89 Safari/537.36');
	curl_setopt($ch, CURLOPT_ENCODING, "gzip");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	$ret = curl_exec($ch);
	curl_close($ch);
	return $ret;
}

function get_zt($uin){
	$url = get_curl("http://".$uin.".qzone.qq.com/");
if(preg_match('@不符合互联网相关安全规范@',$url)){
	$qzone = '您的QQ空间已被永久封闭';
}elseif(preg_match('@您访问的空间需要权限@',$url)){
	$qzone = '您的空间设置了好友权限<br>如果设置好友访问,可以不用管本提示';
}elseif(preg_match('@\[http\:\/\/'.$uin.'\.qzone\.qq\.com\]@',$url)){
	$qzone = '您的空间一切正常';
}elseif(preg_match('@您需要登录才可以访问QQ空间@',$url)){
	$qzone = '您的空间,被强制需要登录QQ号才能正常访问<br>具体错误原因是：空间设置或腾讯限制';
}elseif(preg_match('@暂不支持非好友访问@',$url)){
	$qzone = '您的QQ空间已被封单项,非互相好友不能访问';
}else{
	$qzone = '您的空间一切正常';
}
return $qzone;
	}
$qq=$_GET['qq'];
$uin=$qq;
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
			window.location.href="/qzyc.php?qq="+uin;
		}
         
     }else{
		 document.write("请输入要查询的QQ！如需再次查询，请刷新本页！");
	 }
	
	</script>');
}
else{
?>
<!DOCTYPE HTML>
<html>
<head>
<title><?=$uin?>-空间异常检测-<?=$config['web_name']?></title>
<meta name="keywords" content="<?=$uin?>,<?=$uin?>空间异常检测"/>
<meta name="description" content="<?=$config['web_name']?>"/>
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
<link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="/public/css/x.css" rel="stylesheet" type="text/css">
<style type="text/css">
   	body,td,th {
	font-family: Raleway-Light;
}
</style>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
</head>

<body data-focus="1">
<div class="container mm-page">
	<div class="content">
		<div class="user-profile1 text-center">
			<img src="http://q1.qlogo.cn/g?b=qq&nk=<?=$uin?>&s=100&t=<?=date("Ymd")?>" title="【<?=$uin?>】">
			<h3><?=get_qqnick($uin)?></h3>
			<ul class="list-unstyled list-inline">
				<li><a href="/" target="_blank" title="该QQ来自<?=$config['web_name']?>"><span><i class="fa"></i></span></a></li>
			</ul>
			<p>
				<?=get_zt($uin)?>
			</p>
			<a class="p-btn" href="http://wpa.qq.com/msgrd?v=3&uin=<?=$uin?>&site=qq&menu=yes" target="_blank">点击与TA聊天</a>
            <a class="p-btn" href="http://<?=$uin?>.qzone.qq.com" target="_blank">进入TA的空间</a>
		</div>
		
			
		
		
		<div class="copy-right">
			<p>
				©2015 <a href="/"><?=$config['web_name']?></a>
			</p>
		</div>
	</div>
</div>
</body>

</html>
<?php
}
?>

