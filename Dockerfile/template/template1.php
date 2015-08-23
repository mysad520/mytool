<?php
require_once('conn.php');
C('webtitle','网站首页');
C('pageid','home');
?>
<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title><?=C('webtitle')?><?=C('webkey')?></title>
<link href="/indexs/css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<link href="/indexs/css/style.css" rel="stylesheet" type="text/css" media="all" />
<meta name="keywords" content="24H离线秒赞,秒赞平台,秒赞网,离线CQY">
<meta name="description" content="离线秒赞助手，可以让你24H不间断秒赞好友说说，好友更多QQ空间辅助功能！快速提高空间人气！">   
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
<script src="/indexs/js/jquery.min.js"></script>
<link rel="stylesheet" href="/public/css/bundle-home.css?<?=date("Ymdhis")?>">
</head>
<body>
<!-- header -->
	<div class="banner">
		<div class="header">
			<div class="container">
				<div class="logo">
					<a href="index.php"><img src="/logo.png" class="img-responsive" alt="" /></a>
				</div>
				<div class="head-nav">
						<span class="menu"> </span>
							<ul>
								<li class="active"><a href="index.php">首页</a></li>
								<?php if(C('loginuid')){?>
				<li><a href="/control">用户中心</a></li>
				<?php }else{?>
				<li><a href="/login.php">登录</a></li>
				<li><a href="/reg.php">注册</a></li>
				<?php }?>
						</ul>
				</div>
					<div class="clearfix"> </div>
					<!-- script-for-nav -->
					<script>
						$( "span.menu" ).click(function() {
						  $( ".head-nav ul" ).slideToggle(300, function() {
							// Animation complete.
						  });
						});
					</script>
				<!-- script-for-nav -->
			</div> 
		</div>
		<div class="container">
			<div class="wmuSlider example1 section" id="section-1">
			   <article style="position: absolute; width: 100%; opacity: 0;"> 
			   	   	<div class="banner-info">
						<div class="col-md-6 info1">
							<img src="/indexs/images/phone.png" class="img-responsive" alt="" />
						</div>
						<div class="col-md-6 info">
							<h1>分布式秒赞秒评 </h1>
							<p>全网最大最稳定的秒赞网 </p>
							<p>阿里云服务器强力运行 </p>
                                                        <p>站长QQ<?=C('webqq')?> </p>
							<a class="sign" href="/login.php">立即体验</a>
							<a href=""><i class=""></i></a>
						</div>
							<div class="clearfix"> </div>
					</div>
				</article>
				 <article style="position: absolute; width: 100%; opacity: 0;"> 
			   	   	<div class="banner-info">
						<div class="col-md-6 info1">
							<img src="/indexs/images/phone.png" class="img-responsive" alt="" />
						</div>
						<div class="col-md-6 info">
							<h1>我们的特点 </h1>
							<p>24H秒赞、挂Q、浇花功能免费使用 </p>
							<p>操作简单，无需安装软件，安卓/苹果通用 </p>
                                                        <p>VIP会员服务全网最低价，且功能全面 </p>
                                                        <p>为您秒赞好友说说，不漏掉每一条动态, </p>
							<a class="sign" href="">站长QQ-<?=C('webqq')?></a>
							<a href=""><i class=""></i></a>
						</div>
							<div class="clearfix"> </div>
					</div>
				</article>
				 <article style="position: absolute; width: 100%; opacity: 0;"> 
			   	   	<div class="banner-info">
						<div class="col-md-6 info1">
							<img src="/indexs/images/phone.png" class="img-responsive" alt="" />
						</div>
						<div class="col-md-6 info">
							<h1>智能邮件提醒 </h1>
							<p>SID/KEY过期后邮件自动推送，QQ秒赞网使用付费邮局进行发信 </p>
							<p>保证邮件的送达率，让您秒赞24小时正常运行一切由我们来操作 </p>
							<a class="sign" href="">站长QQ<?=C('webqq')?></a>
							
						</div>
							<div class="clearfix"> </div>
					</div>
				</article>
				<ul class="wmuSliderPagination">
                	<li><a href="#" class="">0</a></li>
                	<li><a href="#" class="">1</a></li>
                	<li><a href="#" class="">2</a></li>
                </ul>
		  </div>		
		</div>
		<!-- script -->
          <script src="/indexs/js/jquery.wmuSlider.js"></script> 
			<script>
       			$('.example1').wmuSlider();         
   		    </script>
			<!-- script -->		
	</div>
<!-- header -->
<!-- content -->
	<div class="contrary">
		<div class="container">
			<div class="col-md-4 penc">
				<i class="pencil"></i>
				<h3>平台优势</h3>
				<p>无需秒赞软件，平台一键操作！支持自动更新，完美离线秒赞，快来一起秒赞吧</p>
			</div>
			<div class="col-md-4 devc">
				<i class="device"></i>
				<h3>秒赞认证</h3>
				<p>提交QQ后，将获得离线秒赞cqy资质认证，拿着秒赞认证去cqy，高装大气上档次。</p>
			</div>
			<div class="col-md-4 cak">
				<i class="cake"></i>
				<h3>分布执行</h3>
				<p>分布多台服务器各自执行各自功能，再也无需担心因为平台QQ增多而影响到效率。</p>
			</div>
		</div>
	</div>
<!-- content -->
<!-- shopping -->


			
		
	<div class="shopping">
		<div class="container">
			<h2 style="text-align: center;">最新加入我们的伙伴</h2>
		<div id="features">
			<div class="container">
				<div class="row">
				<?php if($rows=$db->get_results("select qq,addtime from ".C('DB_PREFIX')."qqs order by qid desc limit 12")){ foreach($rows as $row){?>
					<div class="col-xs-4 col-md-2" style="text-align:center;">
						<a href="search.php?uin=<?=$row[qq]?>"><img src="http://q2.qlogo.cn/headimg_dl?bs=qq&dst_uin=<?=$row[qq]?>&src_uin=<?=$row[qq]?>&fid=<?=$row[qq]?>&spec=100&url_enc=0&referer=bu_interface&term_type=PC" class="imgradius"></a><br>
						<strong><?=$row[qq]?></strong><br>
						
					</div>
				<?php }}?>
				</div>
			</div>
		</div>
			
            </div>
        </div>
    </div>
    <div class="fourth-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
			</div>
		</div>
	</div>
<!-- shopping -->
	<div class="footer">
		<div class="container">
			<p>Copyright &copy; 2084 天高云淡. More 龙魂 站长QQ：<?=C('webqq')?></p>
		</div>	
	</div>
</body>
</html>
</ul>