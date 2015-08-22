<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?=C('webname')?><?=C('webkey')?></title>
    <meta name="keywords" content="24H离线秒赞,秒赞平台,秒赞网,离线CQY">
    <meta name="description" content="离线秒赞助手，可以让你24H不间断秒赞好友说说，好友更多QQ空间辅助功能！快速提高空间人气！"> 
    <link href='http://fonts.useso.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
    <link href="/style/css/font-awesome.min.css" rel="stylesheet">
    <link href="/style/css/bootstrap.min.css" rel="stylesheet">
	<link href="/style/css/templatemo-style.css" rel="stylesheet">
    <script src="http://cdn.bootcss.com/jquery/1.11.2/jquery.min.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>
  <body>  
    <!-- Left column -->
    <div class="templatemo-flex-row">
      <div class="templatemo-sidebar">
        <header class="templatemo-site-header">
          <div class="square"></div>
          <h1><?=C('webname')?></h1>
        </header>
        <div class="profile-photo-container">
          <img src="/style/images/profile-photo.jpg" alt="Profile Photo" class="img-responsive">  
          <div class="profile-photo-overlay"></div>
        </div>      

        <div class="mobile-menu-icon">
            <i class="fa fa-bars"></i>
        </div>
        <nav class="templatemo-left-nav">          
          <ul>
		    <?php if($userrow[active]==9){echo'<li><a href="/admin"><i class="fa fa-home fa-fw"></i>管理后台</a></li>';}?>
			<?php if($userrow[daili]){echo'<li><a href="daili.php"><i class="fa fa-home fa-fw"></i>代理后台</a></li>';}?>
			<?php if($userrow[fuzhan]){echo'<li><a href="/vice"><i class="fa fa-home fa-fw"></i>副站长后台</a></li>';}?>
			<li class="<?php if(C('pageid')=='control'){ echo'active';}?>"><a href="/control"><i class="fa fa-home fa-fw"></i>用户中心</a></li>
			<li class="<?php if(C('pageid')=='shop'){ echo'active';}?>"><a href="shop.php"><i class="fa fa-bar-chart fa-fw"></i>自助商城</a></li>
			<li class="<?php if(C('pageid')=='rmb'){ echo'active';}?>"><a href="rmb.php"><i class="fa fa-database fa-fw"></i>在线充值</a></li>
			<li class="<?php if(C('pageid')=='uset'){ echo'active';}?>"><a href="uset.php"><i class="fa fa-map-marker fa-fw"></i>资料修改</a></li>
			<li class="<?php if(C('pageid')=='vipifmt'){ echo'active';}?>"><a href="vipifmt.php"><i class="fa fa-sliders fa-fw"></i>我的资料</a></li>
			<li class="<?php if(C('pageid')=='qq'){ echo'active';}?>"><a href="qq.php"><i class="fa fa-eject fa-fw"></i>我的QQ</a></li>
			<li class="<?php if(C('pageid')=='qq'){ echo'active';}?>"><a href="add.php"><i class="fa fa-eject fa-fw"></i>添加QQ</a></li>
			<li><a href="logout.php"><i class="fa fa-eject fa-fw"></i>退出</a></li>
          </ul>  
        </nav>
      </div>
	        <div class="templatemo-content col-1 light-gray-bg">
        <div class="templatemo-top-nav-container">
          <div class="row">
            <nav class="templatemo-top-nav col-lg-12 col-md-12">
              <ul class="text-uppercase">
		    <?php if($userrow[active]==9){echo'<li><a href="/admin"><i class="fa fa-home fa-fw"></i>管理后台</a></li>';}?>
			<?php if($userrow[daili]){echo'<li><a href="daili.php"><i class="fa fa-home fa-fw"></i>代理后台</a></li>';}?>
			<?php if($userrow[fuzhan]){echo'<li><a href="/vice"><i class="fa fa-home fa-fw"></i>副站后台</a></li>';}?>
			<li class="<?php if(C('pageid')=='control'){ echo'active';}?>"><a href="/control"><i class="fa fa-home fa-fw"></i>用户中心</a></li>
			<li class="<?php if(C('pageid')=='shop'){ echo'active';}?>"><a href="shop.php"><i class="fa fa-bar-chart fa-fw"></i>自助商城</a></li>
			<li class="<?php if(C('pageid')=='rmb'){ echo'active';}?>"><a href="rmb.php"><i class="fa fa-database fa-fw"></i>在线充值</a></li>
			<li class="<?php if(C('pageid')=='uset'){ echo'active';}?>"><a href="uset.php"><i class="fa fa-map-marker fa-fw"></i>资料修改</a></li>
			<li class="<?php if(C('pageid')=='vipifmt'){ echo'active';}?>"><a href="vipifmt.php"><i class="fa fa-sliders fa-fw"></i>我的资料</a></li>
			<li class="<?php if(C('pageid')=='qq'){ echo'active';}?>"><a href="qq.php"><i class="fa fa-eject fa-fw"></i>我的挂机</a></li>
			<li><a href="add.php"><i class="fa fa-eject fa-fw"></i>添加挂机</a></li>
			<li><a href="logout.php"><i class="fa fa-eject fa-fw"></i>退出登录</a></li>
              </ul>  
            </nav> 
          </div>
        </div>