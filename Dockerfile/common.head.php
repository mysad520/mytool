<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?=C('webname')?><?=$config['webname']?></title>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
<meta name="keywords" content="24H离线秒赞,秒赞平台,秒赞网,离线CQY">
<meta name="description" content="离线秒赞助手，可以让你24H不间断秒赞好友说说，好友更多QQ空间辅助功能！快速提高空间人气！">
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
<link href="/favicon.ico" rel="shortcut icon" type="image/x-icon">
<!-- Application styles-->
<link rel="stylesheet" href="/public/css/bundle-home.css?<?=date("Ymdhis")?>">
<!--if lt IE 9script(src="//html5shim.googlecode.com/svn/trunk/html5.js")
-->
</head>
<body id="<?=C('pageid')?>" class="unloaded">
<div class="wrapper">
	<header><nav role="navigation" class="navbar navbar-default">
	<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" class="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a href="/" class="navbar-brand">ReadMe.io</a>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div id="bs-example-navbar-collapse-1" class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li><!--a(href="/features")| Features
span--></li>
				<li><a href="/#scroll-pricing" class="scroll">价格表<span></span></a></li>
				<li><a href="/#scroll-examples" class="scroll">效果展示<span></span></a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<?php if(C('loginuid')){?>
				<li class="signup-top-parent"><a href="/control" class="signup-top">控制台
				<span></span></a></li>
				<?php }else{?>
				<li><a href="/login.php" class="login-top <?php if(C('pageid')=='login') echo 'active';?>"> 登录
				<span></span></a></li>
				<li class="signup-top-parent"><a href="/reg.php" class="signup-top <?php if(C('pageid')=='register') echo 'active';?>"> 注册
				<span></span></a></li>
				<?php }?>
			</ul>
		</div>
	</div>
	</nav></header>