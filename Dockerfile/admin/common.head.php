<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?=C('webtitle')?><?=C('webkey')?></title>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
<meta name="keywords" content="24H离线秒赞,秒赞平台,秒赞网,离线CQY">
<meta name="description" content="离线秒赞助手，可以让你24H不间断秒赞好友说说，好友更多QQ空间辅助功能！快速提高空间人气！">
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
<link href="/favicon.ico" rel="shortcut icon" type="image/x-icon">
<link href="/public/css/bootstrap.min.css" rel="stylesheet">
<link href="/public/css/dashboard.css?v=s3s" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
<div class="container-fluid">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
		<span class="sr-only"><?=C('webname')?></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="/"><?=C('webname')?></a>
	</div>
	<div id="navbar" class="navbar-collapse collapse">
		<ul class="nav navbar-nav navbar-right">
			<li><a href="/">网站首页</a></li>
			<li class="<?php if(C('pageid')=='admin'){ echo'active';}?>"><a href="/admin">后台中心</a></li>
			<li><a href="../control/logout.php">退出</a></li>
		</ul>
	</div>
</div>
</nav>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-3 col-md-2 sidebar">
			<ul class="nav nav-sidebar">
				<li class="<?php if(C('pageid')=='admin'){ echo'active';}?>"><a href="/admin">后台首页</a></li>
				<li class="<?php if(C('pageid')=='adminset'){ echo'active';}?>"><a href="set.php?xz=set">系统设置</a></li>
				<li class="<?php if(C('pageid')=='admingg'){ echo'active';}?>"><a href="set.php?xz=gg">公告设置</a></li>
				<li class="<?php if(C('pageid')=='adminmail'){ echo'active';}?>"><a href="set.php?xz=mail">邮箱设置</a></li>
				<li class="<?php if(C('pageid')=='adminuser'){ echo'active';}?>"><a href="km.php">卡密生成</a></li>
				<li class="<?php if(C('pageid')=='adminprice'){ echo'active';}?>"><a href="set.php?xz=price">价格设置</a></li>
				<li class="<?php if(C('pageid')=='admincron'){ echo'active';}?>"><a href="jk.php">监控说明</a></li>
				<li class="<?php if(C('pageid')=='adminuser'){ echo'active';}?>"><a href="ulist.php">用户列表</a></li>
				<li class="<?php if(C('pageid')=='adminqq'){ echo'active';}?>"><a href="qlist.php">Q&nbsp;Q列表</a></li>
				<li style="background: #222222;"><a href="/"><?=C('webname')?></a></li>
				<li style=""><a href="/">站长QQ:<?=C('webqq')?></a></li>
				<li style=""><a href="/"><?=date("Y-m-d H:i:s")?></a></li>
			</ul>
		</div>