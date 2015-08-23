<?php
require_once('conn.php');
//************************执行代码开始*************************
if($_POST['do']=='register'){
	session_start();
	$user=safestr($_POST['user']);
	$email=safestr($_POST['email']);
	$pwd=safestr($_POST['pwd']);
	$code=safestr($_POST['code']);
	$ip=getip();
	if(!$user || !$email || !$pwd || !$code){
		$msg="每一项都必须填写";
	}elseif(strlen($user) < 5){
		$msg="用户名太短";
	}elseif(!$code || strtolower($_SESSION['klsf_code'])!=strtolower($code)){
		$msg="验证码错误";//exit("<script language='javascript'>alert('验证码错误');history.go(-1);</script>");
	}elseif(strlen($pwd) < 5){
		$msg="密码太简单";//exit("<script language='javascript'>alert('密码太简单！');history.go(-1);</script>");
	}elseif(!preg_match("/^[a-z0-9][a-z0-9\.\_\-]+@[a-z0-9]+\.[a-z]{2,4}$/i",$email)){ 
		$msg="邮箱地址不正确";//exit("<script language='javascript'>alert('邮箱地址不正确');history.go(-1);</script>");
	}elseif($db->get_row("select uid from ".C('DB_PREFIX')."users where mail='{$email}' limit 1")){
		$msg="此邮箱已经注册过";//exit("<script language='javascript'>alert('此邮箱已经注册过');history.go(-1);</script>");
	}elseif($db->get_row("select uid from ".C('DB_PREFIX')."users where user='{$user}' limit 1")){
		$msg="用户名已存在";//exit("<script language='javascript'>alert('用户名已存在！');history.go(-1);</script>");
	}else{
		$_SESSION['xiha_code'] =md5(rand(100,500).time());
		$sid=md5(uniqid().rand(1,1000));
		$pwd=md5(md5($pwd).md5('815856515'));
		$now=date("Y-m-d H:i:s");
		$city=get_ip_city($ip);
		$active=1;
		$peie=C('regpeie');
		$rmb=C('regrmb');
		if ($db->query("insert into  ".C('DB_PREFIX')."users (user,pwd,sid,active,peie,rmb,mail,city,regip,lastip,regtime,lasttime) values ('$user','$pwd','$sid','$active','$peie','$rmb','$email','$city','$ip','$ip','$now','$now')")) {
			$msg="√注册成功！<a href='login.php'>马上登录</a>";
		}else{
			$msg="注册失败，".mysql_error();
		}
	}
}








//************************执行代码结束**************************
C('webtitle','账号注册');
C('pageid','register');
include_once 'common.head.php';
?>
	<div class="login">
		<div id="signup-background">
			<div class="container books">
				<div class="row">
					<div class="col-lg-6 col-lg-offset-1 col-md-7 col-sm-8 col-xs-12">
						<div id="form-parent">
							<div id="form-slider">
								<form id="signup-main" action="?" method="post" class="container offset1 loginform form-horizontal">
									<div class="pad">
										<h2>账号注册</h2>
										<input type="hidden" name="do" value="register" class="form-control">
										<?php if($msg){?><div class="alert alert-warning alert-dismissable"><div><?=$msg?></div></div><?php }?>
										<div class="form-group">
											<label for="name" class="control-label col-sm-4">
											<div class="fa fa-user">
											</div>
											<span>用户名</span></label>
											<div class="controls col-sm-8">
												<input id="name" type="text" name="user" placeholder="用户名5-18位" value="" tabindex="1" autofocus="autofocus" data-step="1" class="form-control">
											</div>
										</div>
										<div class="form-group">
											<label for="email" class="control-label col-sm-4">
											<div class="fa fa-envelope">
											</div>
											<span>邮箱</span></label>
											<div class="controls col-sm-8">
												<input id="email" type="text" name="email" placeholder="填写真实邮箱，需要验证激活！" value="" tabindex="2" autocomplete="false" data-step="2" class="form-control">
											</div>
										</div>
										<div class="form-group">
											<label for="password" class="control-label col-sm-4">
											<div class="fa fa-asterisk">
											</div>
											<span>密码</span></label>
											<div class="controls col-sm-8">
												<input type="password" name="pwd" placeholder="密码5-18位" tabindex="3" autocomplete="false" data-step="3" class="form-control">
											</div>
										</div>
										<div class="form-group">
											<label for="password" class="control-label col-sm-4">
											<div class="fa fa-asterisk">
											</div>
											<span>验证码</span></label>
											<div class="controls col-sm-8">
												<input type="text" name="code" placeholder="输入验证码" tabindex="4" autocomplete="false" data-step="4" class="form-control">
											</div>
										</div>
										<div class="form-group">
											<label for="password" class="control-label col-sm-4">
											<span></span></label>
											<div class="controls col-sm-8">
												<img  title="点击刷新" src="/code.php" align="absbottom" onclick="this.src='/code.php?'+Math.random();">
											</div>
										</div>
									</div>
									<div class="form-actions">
										<a href="/login.php" tabindex="6" class="btn btn-link show-login text-muted">已有账号，马上登录！</a><button type="submit" tabindex="5" class="btn btn-primary">注册</button>
									</div>
								</form>
			
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-5 col-sm-4 hidden-xs">
						<div class="signup-text">
							<h3>加入我们，开启24H离线秒赞之旅！</h3>
							<p>
								这里拥有功能最全、最快、最稳定的QQ空间辅助功能！
							</p>
						</div>
					</div>
				</div>
				<div class="owl-signup">
					<div class="owl-body">
						<div class="owl-eye">
						</div>
						<div class="owl-eye right">
						</div>
					</div>
					<div class="owl-arm">
					</div>
					<div class="owl-feet">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
include_once 'common.foot.php';
?>