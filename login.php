<?php
require_once('conn.php');

//************************执行代码开始*************************
if($_POST['do']=='login'){
	$user=safestr($_POST['user']);
	$pwd=safestr($_POST['pwd']);
	$ip=getip();
	if(!$user || !$pwd){
		$msg="账号密码不能为空";
	}elseif(strlen($user) < 5){
		$msg="用户名太短";
	}elseif(strlen($pwd) < 5){
		$msg="密码太简单";//exit("<script language='javascript'>alert('密码太简单！');history.go(-1);</script>");
	}else{
		$pwd=md5(md5($pwd).md5('815856515'));
		if(is_numeric($user)){
			$where="(user='$user' or phone='$user') and pwd='$pwd'";
		}else{
			$where="(user='$user' or mail='$user') and pwd='$pwd'";
		}
		if($row=$db->get_row("select uid,user from ".C('DB_PREFIX')."users where {$where} limit 1")){
			$sid=md5(uniqid().rand(1,1000));
			$now=date("Y-m-d H:i:s");
			$ip=getip();
			$db->query("update ".C('DB_PREFIX')."users set sid='$sid',lasttime='$now',lastip='$ip' where uid='{$row[uid]}'");
			setcookie("klsf_sid",$sid,time()+3600*24*14,'/');
			exit("<script language='javascript'>alert('{$row[user]}，欢迎你回来!');window.location.href='/control';</script>");
		}else{
			$msg="Email/用户名/手机号与密码不匹配";
		}
	}
}










//************************执行代码结束**************************

C('webtitle','会员登录');
C('pageid','login');
?>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="renderer" content="webkit">

    <title>登录-<?=C('webname')?></title>
    <meta name="Keywords" content="<?=C('webname')?>,秒赞平台,秒赞网,秒赞,离线秒赞,免费24h秒赞,秒赞吧,爱空间app"/>
    <meta name="Description" content="<?=C('webname')?>帐号登陆，24小时不间断离线秒赞空间说说！"/>

    <link href="/indexs/cxs/bootstrap.min.css?v=3.4.0" rel="stylesheet">
    <link href="/indexs/cxs/font-awesome/css/font-awesome.css?v=4.3.0" rel="stylesheet">

    <link href="/indexs/cxs/animate.css" rel="stylesheet">
    <link href="/indexs/cxs/style.css?v=2.2.0" rel="stylesheet">
</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">Mz</h1>

            </div>
            <h3><?=C('webname')?></h3>
			<?php if($msg){?><div class="alert alert-warning alert-dismissable"><div><?=$msg?></div></div><?php }?>
			<form action="?" method="post" >
                <div class="form-group">
					<input type="hidden" name="do" value="login"/>
					<input type="hidden" name="type" value="1"/>
                    <input type="text" maxlength="16" name="user" id="inputEmail" class="form-control" placeholder="用户名/手机号/邮箱" required autofocus>
                </div>
                <div class="form-group">
                    <input type="password" name="pwd" maxlength="16" id="inputPassword" class="form-control" placeholder="输入密码" required>
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">登 录</button>


                <p class="text-muted text-center"> <a href="reg.php">注册一个新账号</a>
                </p>

            </form>
        </div>
    </div>
<br/>
    <!-- Mainly scripts -->


</body>

</html>