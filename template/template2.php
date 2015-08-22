<?php
require_once('conn.php');
C('webtitle','网站首页');
C('pageid','home');
include_once 'common.head.php';
?>
	<div id="hero">
		<div class="inside">
			<div id="subhead">
				<div class="book-icon">
					<div class="tail">
					</div>
				</div>
				<h2><span>稳定&nbsp;</span><strong id="spinner-show"><em class="current">documentation</em>
				<div class="next">
				</div>
				</strong><span>&nbsp;实用</span>
				<ul id="spinner">
					<li>24H离线秒赞</li>
					<li><?=C('webname')?></li>
					<li>离线CQY</li>
					<li>快速增加人气</li>
				</ul>
				<div>
					<?php if(C('loginuid')){?><a href="/control" class="btn btn-primary btn-lg btn-signup"><?=C('loginuser')?></a><?php }else{?><a href="/signup.php" class="btn btn-primary btn-lg btn-signup">开始体验</a><?php }?>
				</div>
				</h2>
			</div>
			<div id="browsers-parent">
				<div id="browsers">
					<div id="ph-owl">
						<div id="ph-owl-feet">
						</div>
						<div id="ph-owl-rock">
							<div id="ph-owl-body">
							</div>
							<div class="ph-owl-eyes left">
							</div>
							<div class="ph-owl-eyes right">
							</div>
							<div id="ph-owl-arm">
							</div>
							<div id="ph-owl-arml">
							</div>
						</div>
						<div id="ph-text">
						</div>
					</div>
					<div id="left" class="browser">
					</div>
					<div id="right" class="browser">
					</div>
					<div id="main" class="browser">
						<div class="b-hero">
							<div class="b-logo">
							</div>
							<div class="b-header">
							</div>
							<div class="b-paragraph a">
							</div>
							<div class="b-paragraph b">
							</div>
							<div class="b-paragraph c">
							</div>
							<div class="b-paragraph d">
							</div>
						</div>
						<div class="b-bottom">
							<div class="b-bottom-col a">
								<div class="b-bottom-row a">
									<div class="b-bullet a">
									</div>
									<div class="b-text a">
									</div>
								</div>
								<div class="b-bottom-row b">
									<div class="b-bullet b">
									</div>
									<div class="b-text b">
									</div>
								</div>
								<div class="b-bottom-row c">
									<div class="b-bullet c">
									</div>
									<div class="b-text c">
									</div>
								</div>
								<div class="b-bottom-row d">
									<div class="b-bullet d">
									</div>
									<div class="b-text d">
									</div>
								</div>
							</div>
							<div class="b-bottom-col b">
								<div class="b-bottom-row a">
									<div class="b-bullet a">
									</div>
									<div class="b-text a">
									</div>
								</div>
								<div class="b-bottom-row b">
									<div class="b-bullet b">
									</div>
									<div class="b-text b">
									</div>
								</div>
								<div class="b-bottom-row c">
									<div class="b-bullet c">
									</div>
									<div class="b-text c">
									</div>
								</div>
								<div class="b-bottom-row d">
									<div class="b-bullet d">
									</div>
									<div class="b-text d">
									</div>
								</div>
							</div>
							<div class="b-bottom-col c">
								<div class="b-bottom-row a">
									<div class="b-bullet a">
									</div>
									<div class="b-text a">
									</div>
								</div>
								<div class="b-bottom-row b">
									<div class="b-bullet b">
									</div>
									<div class="b-text b">
									</div>
								</div>
								<div class="b-bottom-row c">
									<div class="b-bullet c">
									</div>
									<div class="b-text c">
									</div>
								</div>
								<div class="b-bottom-row d">
									<div class="b-bullet d">
									</div>
									<div class="b-text d">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="content">
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
		<div id="about" class="container">
			<h2>为什么选择我们?</h2>
			<div class="content-block">
				<div class="icon a">
					<div class="book-back">
						<div class="lines">
							<div class="line l1">
							</div>
							<div class="line l2">
							</div>
							<div class="line l3">
							</div>
							<div class="line l4">
							</div>
							<div class="line l5">
							</div>
						</div>
						<div class="book-front">
						</div>
						<div class="book-front-open">
						</div>
					</div>
				</div>
				<div class="content-text">
					<h3>功能齐全</h3>
					<p>
						功能齐全、稳定
					</p>
				</div>
			</div>
			<div class="content-block">
				<div class="icon b">
					<div class="beakers">
						<div class="liquid">
						</div>
						<div class="beakertop">
						</div>
						<div class="bubbles-top">
							<div class="bubble1">
							</div>
							<div class="bubble2">
							</div>
							<div class="bubble3">
							</div>
						</div>
						<div class="bubbles-small-top">
							<div class="bubble1">
							</div>
							<div class="bubble2">
							</div>
						</div>
						<div class="bubbles">
							<div class="bubble1">
							</div>
							<div class="bubble2">
							</div>
							<div class="bubble3">
							</div>
						</div>
					</div>
				</div>
				<div class="content-text">
					<h3>24h离线运行</h3>
					<p>
						采用服务器托管，24H不间断离线运行！
					</p>
				</div>
			</div>
			<div class="content-block">
				<div class="icon c">
					<div class="message1">
					</div>
					<div class="message2">
						<div class="dot">
						</div>
						<div class="dot">
						</div>
						<div class="dot">
						</div>
					</div>
					<div class="message3">
					</div>
					<div class="message4">
						<div class="dot">
						</div>
						<div class="dot">
						</div>
						<div class="dot">
						</div>
					</div>
					<div class="message5">
					</div>
					<div class="message6">
						<div class="dot">
						</div>
						<div class="dot">
						</div>
						<div class="dot">
						</div>
					</div>
				</div>
				<div class="content-text">
					<h3>售后服务</h3>
					<p>
						购买后有任何问题都有专人为你解答！
					</p>
				</div>
			</div>
		</div>
	</div>
	<hr class="dots">
	<div class="container">
		<div id="examples" class="show-example-1">
			<h2>功能展示</h2>
			
			
		</div>
	</div>
	<div id="testimonial">
		<div class="container">
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2">
					<div class="media">
						<div class="pull-left">
							<img src="http://q2.qlogo.cn/headimg_dl?bs=qq&dst_uin=<?=C('webqq')?>&src_uin=<?=C('webqq')?>&fid=<?=C('webqq')?>&spec=100&url_enc=0&referer=bu_interface&term_type=PC" class="imgradius" width="80" height="80">
						</div>
						<div class="media-body">
							<p>
							<?=stripslashes(C('web_index_gg'))?>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="pricing">
		<div class="container">
			<h2>Pricing</h2>
			<p>我们同样也饿提供免费服务，但是功能有很大限制！VIP卡价格表如下</p>
			<div class="row">
				<div class="col-sm-4">
					<div id="plans-company" class="table">
						<div class="tr">
							<div class="th first last">
								<strong>开通VIP</strong>
								<div class="pricing">
									￥8<sup>/月</sup><br>
									￥30<sup>/半年</sup><br>
									￥50<sup>/一年</sup>
								</div>
							</div>
						</div>
						<div class="tr">
							<div class="td start">
								<a href="http://wpa.qq.com/msgrd?v=3&uin=<?=$config['webqq']?>&site=qq&menu=yes" class="btn btn-success btn-lg plan-enterprise"> 我要购买
								<div class="fa fa-chevron-circle-right fa-left">
								</div>
								<i>联系QQ:<?=C('webqq')?></i></a>
							</div>
						</div>
						<div class="tr">
							<div class="td plan-details">
								<ul>
									<li><strong>开通VIP可以使用本站所有功能！</strong></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div id="plans-company" class="table">
						<div class="tr">
							<div class="th first last ">
								<strong>购买配额</strong>
								<div class="pricing">
									￥20<sup>/1个</sup><br>
									￥50<sup>/3个</sup><br>
									￥100<sup>/10个</sup><br>
								</div>
							</div>
						</div>
						<div class="tr">
							<div class="td start plan-details">
								<a href="http://wpa.qq.com/msgrd?v=3&uin=<?=$config['webqq']?>&site=qq&menu=yes" class="btn btn-success btn-lg plan-enterprise"> 我要购买
								<div class="fa fa-chevron-circle-right fa-left">
								</div>
								<i>联系QQ:<?=C('webqq')?></i></a>
							</div>
						</div>
						<div class="tr">
							<div class="td plan-details">
								<ul>
									<li><strong>增加的配额是永久的！</strong></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div id="plans-company" class="table">
						<div class="tr">
							<div class="th first last">
								<strong>成为代理</strong>
								<div class="pricing">
									￥100<sup>/位</sup><br><br><br>
								</div>
							</div>
						</div>
						<div class="tr">
							<div class="td start">
								<a href="http://wpa.qq.com/msgrd?v=3&uin=<?=$config['webqq']?>&site=qq&menu=yes" class="btn btn-success btn-lg plan-enterprise"> 我要购买
								<div class="fa fa-chevron-circle-right fa-left">
								</div>
								<i>联系QQ:<?=C('webqq')?></i></a>
							</div>
						</div>
						<div class="tr">
							<div class="td plan-details">
								<ul>
									<li><strong>开通代理可以5折拿卡密</strong></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				
			</div>
			<p class="free">
				<strong>如需咨询</strong>请联系站长QQ:<?=C('webqq')?>&nbsp;<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?=C('webqq')?>&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:<?=C('webqq')?>:51" alt="点击这里给我发消息" title="点击这里给我发消息"/></a>
			</p>
		</div>
	</div>
	<footer><a href="/" class="link scroll"><?=C('webdomain')?></a>
	<a href="/" class="pf scroll">
	<div class="spacer">
		<?=C('webname')?>
	</div>
	<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?=C('webqq')?>&site=qq&menu=yes" class="link">站长QQ:<?=C('webqq')?></a></footer>
<?php
include_once 'common.foot.php';
?>