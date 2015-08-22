<?php
require_once('conn.php');
C('webtitle','网站首页');
C('pageid','home');
?>
<html>
<head>
<title><?=C('webtitle')?><?=C('webname')?><?=C('webkey')?></title>
<link href="/template/longhun/css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- jQuery (Bootstrap's JavaScript plugins) -->
<script src="http://ajax.useso.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link href="/template/longhun/css/component.css" rel="stylesheet" type="text/css"  />
<!-- Custom Theme files -->
<link href="/template/longhun/css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Smart Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--webfont-->
<!---- start-smoth-scrolling---->
		<script type="text/javascript" src="/template/longhun/js/move-top.js"></script>
		<script type="text/javascript" src="/template/longhun/js/easing.js"></script>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},900);
				});
			});
		</script>
<!---- start-smoth-scrolling---->
</head>
<body class="cbp-spmenu-push">
<div id="home" class="banner">
	 <div class="container">
		 <div class="header">
			 <div class="logo">
				 <a href="#"><img src="/template/longhun/images/logo.png" alt=""/></a>
			 </div>	
			 <div class="top-nav">
				<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-s2">
					<h3>控制中心</h3>
				    
				<li><a href="/control" class="login-top <?php if(C('pageid')=='login') echo 'active';?>"> 用户中心
                </li>
				
									<li><a href="/login.php" class="login-top <?php if(C('pageid')=='login') echo 'active';?>"> 登陆</li>
                <li class="signup-top-parent"><a href="/reg.php" class="signup-top <?php if(C('pageid')=='register') echo 'active';?>"> 注册</li>
				
				</nav>
				<div class="main buttonset">	
						<!-- Class "cbp-spmenu-open" gets applied to menu and "cbp-spmenu-push-toleft" or "cbp-spmenu-push-toright" to the body -->
						<button id="showRightPush"><img src="/template/longhun/images/menu-icon.png" alt=""/></button>
						<!--<span class="menu"></span>-->
				</div>
				<!-- Classie - class helper functions by @desandro https://github.com/desandro/classie -->
				<script src="/template/longhun/js/classie.js"></script>
				<script>
				var menuRight = document.getElementById( 'cbp-spmenu-s2' ),
				showRightPush = document.getElementById( 'showRightPush' ),
				body = document.body;

				showRightPush.onclick = function() {
					classie.toggle( this, 'active' );
					classie.toggle( body, 'cbp-spmenu-push-toleft' );
					classie.toggle( menuRight, 'cbp-spmenu-open' );
					disableOther( 'showRightPush' );
				};

				function disableOther( button ) {
					if( button !== 'showRightPush' ) {
						classie.toggle( showRightPush, 'disabled' );
					}
				}
			 </script>
	     </div>
			<div class="clearfix"></div>
		 </div>
		 
	   <div class="banner-info">
			 <h1><?=C('webname')?><span>安全 稳定 快速</span></h1>
	   </div>
		 <div class="down">
		 <a class="scroll" href="#feature"><img src="/template/longhun/images/scroll.png" alt=""/></a>
		 </div>
	 </div>
	 <div class="hand">
		 <img src="/template/longhun/images/hand.png" alt=""/>
	 </div>
</div>
<!--features-->
<div class="copyrights">Collect from <a href="/index.php" >天高云淡</a></div>
<div id="feature" class="features">
	 <div class="container">
	   <div class="feature-info text-center">
		 <h3>总体大纲</h3>
		 <p>&nbsp;</p>
	   </div>
		 <div class="feature-grids">
			 <div class="col-md-6 feature-sec">
				 <div class="feature-grid grid1">
					 <h3>云端</h3>
					 <p>所有功能我们都能完美运行,</p>
					 <p>并且不会保存您的明文数据,我们都会通过MD5的方式加密后存储至云端！</p>
				 </div>
				 <div class="feature-grid grid2">
					 <h3>安全</h3>
					 <p>我们网站并没有被一切人泛滥,</p>
					 <p>所以我们的程序如果发现漏洞我们都会一时间修复,不会再往里上出现</p>
				 </div>
			 </div>
			 <div class="col-md-6 feature-sec">
				 <div class="feature-grid grid3">
					 <h3>触屏</h3>
					 <p>我们均采用自动适配手机端的方案,</p>
					 <p>可以让您的手机更好的使用本程序,并且会尽量减少对移动传输流量的缩小</p>
				 </div>
				 <div class="feature-grid grid4">
					 <h3>记录</h3>
					 <p>目前我不会对您的QQ进行任何记录,</p>
					 <p>如果您在网站上操作了删除本QQ账号我们服务器端会第一时间删除,不会保存</p>
				 </div>
			 </div>
			 <div class="clearfix"></div>
		 </div>
	</div>
</div>
<!--landing-->
<div class="landing">
		 <h3>分布式</h3>
		 <div class="alnding-sec">
			 <div class="col-md-6 slades">
				 <img src="/template/longhun/images/shape2.jpg" alt=""/>
			 </div>
			 <div class="col-md-6 landing-info">
				 <p>我们采用了分布式处理的概念这样会让您的QQ更好的秒赞,更好的服务器,这样也尽量的减少了对服务器的负载,我们会检测完一组在运行一组。.</p>
				 <p class="lndng-text">有人说分布式运行会不会秒赞延迟阿！答案是不会的,您的QQ会分布在多台服务器上,分开处理基本上也不会出现延迟等情况,请您放心.</p>
			 </div>
			 <div class="clearfix"></div>
	 </div>
</div>
<!--screenshots-->
<!--team-->
<div id="team" class="team">
	<div class="container">
		 <h3>人物介绍</h3>
		 <div class="team-grids">
			 <div class="col-md-4 team-grid text-center">
				 <img src="/template/longhun/images/t1.jpg" alt=""/>
				 <h4>天高云淡</h4>
				 <p>网站首席PHP开发人员,善于网站二次开发</p>
				 <div class="social-icons">
					 <a href="#"><span class="fb"></span></a>
					 <a href="#"><span class="tweet"></span></a>
					 <a href="#"><span class="drib"></span></a>
				 </div>
			 </div>
			 <div class="col-md-4 team-grid text-center">
				 <img src="/template/longhun/images/t2.jpg" alt=""/>
				 <h4>海比天蓝</h4>
				 <p>网站整体美工设计师,拥有三年的美工经验</p>
				 <div class="social-icons">
					 <a href="#"><span class="fb"></span></a>
					 <a href="#"><span class="tweet"></span></a>
					 <a href="#"><span class="drib"></span></a>
				 </div>
			 </div>
			 <div class="col-md-4 team-grid text-center">
				 <img src="/template/longhun/images/t3.jpg" alt=""/>
				 <h4>云淡风轻</h4>
				 <p>网站CEO 管理网站运行安全情况等问题</p>
				 <div class="social-icons">
					 <a href="#"><span class="fb"></span></a>
					 <a href="#"><span class="tweet"></span></a>
					 <a href="#"><span class="drib"></span></a>
				 </div>
			 </div>
			 <div class="clearfix"></div>
		 </div>
  </div>
</div>
<!--team-->
<div class="subscribe">
	 <div class="container">
		 <h3>正版查询</h3>
		 <form action="#" class="form-horizontal" method="get">
			 <input type="text" value="正在开发,下个版本开放" onFocus="this.value=''" onBlur="this.value='Subscride'">
			 <input type="submit" value="查询">
		 </form>
	 </div>
</div>
<!--footer-->
<div class="footer"></div>

</body>
</html>