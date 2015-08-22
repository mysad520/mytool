<?php
error_reporting(E_ALL & ~E_NOTICE);
	@header('Content-Type: text/html; charset=UTF-8');
	if(file_exists('install.lock')){
		exit('已经安装完成！如需重新安装，请删除install目录下的install.lock!');
	}
	$step=is_numeric($_GET['step'])?$_GET['step']:'1';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0,user-scalable=no,minimal-ui">
<meta name="MobileOptimized" content="320">
<meta http-equiv="cleartype" content="on">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<link href="http://cdn.bootcss.com/bootstrap/3.2.0/css/bootstrap.css" rel="stylesheet" type="text/css"/>
<link href="/css/style.css" rel="stylesheet" type="text/css"/>
<style>
.container {
	max-width: 580px;
	padding: 10px;
    margin: 0 auto;
	border: 1px solid rgba(33,123,198,0.3);
}
.header{
height:50px;
}
.logo {
	width: 150px;
	float: left;
	background: url(images/logo.png) no-repeat;
	height: 45px;
	display: inline;
}
.logo span{
	float: right;
line-height: 45px;
font-size: 18px;
font-weight: bold;
}
.formrow{
	padding:10px;
}
</style>
<style type="text/css">
	body { background: #f1f1f1; font-family: "Microsoft Yahei",tahoma,arial,sans-serif; }
	#error { background: #91a1b1; width: 330px; position:absolute; left:50%; top:45%; margin-left:-165px;margin-top:-60px; color: #fff; padding: 10px; -moz-border-radius: 4px; -webkit-border-radius: 4px; border-radius: 4px; }
	#error p { padding: 5px 0px 5px 0px; margin: 0; font-size: 16px; letter-spacing:5px; text-indent:5px; text-align: center; }
	#beian { position:absolute; bottom: 10%; left:50%; width: 200px; margin-left: -100px; }
	#beian p, #beian p a, #beian p a:hover { font-size: 12px; text-align:center; color:#bbb; text-decoration: none; }
	</style>
</head>
<body>
<?php if($step=='1'){?>
<script> alert("欢迎安装天高云淡秒赞程序 By：龙魂"); </script>
	<div id="error">
	<h3 class="panel-title" align="center">数据库配置</h3>
	<form action="?step=2" class="form-sign" method="post">
		<label for="name">数据库地址:</label>
		<input type="text" class="form-control" name="DB_HOST" value="localhost">
		<label for="name">数据库端口:</label>
		<input type="text" class="form-control" name="DB_PORT" value="3306">
		<label for="name">数据库库名:</label>
		<input type="text" class="form-control" name="DB_NAME" placeholder="输入数据库库名">
		<label for="name">数据库用户名:</label>
		<input type="text" class="form-control" name="DB_USER" placeholder="输入数据库用户名">
		<label for="name">数据库密码:</label>
		<input type="password" class="form-control" name="DB_PWD" placeholder="输入数据库密码">
		<br><input type="submit" class="btn btn-primary btn-block" name="submit" value="确认，下一步">
		</form></div>
</body>
</html>
<?php }elseif($step=='2'){
	if($_POST['submit']){
		if(!$_POST['DB_HOST'] || !$_POST['DB_PORT'] || !$_POST['DB_NAME'] || !$_POST['DB_USER'] || !$_POST['DB_PWD']){
			echo'<script language=\'javascript\'>alert(\'所有项都不能为空\');history.go(-1);</script>';
		}else{
			if(!$con=mysql_connect($_POST['DB_HOST'].':'.$_POST['DB_PORT'],$_POST['DB_USER'],$_POST['DB_PWD'])){
				echo'<script language=\'javascript\'>alert("连接数据库失败，'.mysql_error().'");history.go(-1);</script>';
			}elseif(!mysql_select_db($_POST['DB_NAME'],$con)){
				echo'<script language=\'javascript\'>alert("选择的数据库不存在，'.mysql_error().'");history.go(-1);</script>';
			}else{
				$data="<?php
return array(
	'DB_HOST'               =>  '{$_POST['DB_HOST']}',
    'DB_NAME'               =>  '{$_POST['DB_NAME']}',
    'DB_USER'               =>  '{$_POST['DB_USER']}',
    'DB_PWD'                =>  '{$_POST['DB_PWD']}',
    'DB_PORT'               =>  '{$_POST['DB_PORT']}',
    'DB_PREFIX'             =>  'klmz_',
);";
				if(file_put_contents('../inc/db.php',$data)){
					$sqls=file_get_contents("install.sql");
					$explode = explode(";",$sqls);
					$num = count($explode);
					foreach($explode as $sql){
						if($sql=trim($sql)){
							mysql_query($sql);
						}
					}
					if(mysql_error()){
						echo'<script language=\'javascript\'>alert("导入数据表时错误，'.mysql_error().'");history.go(-1);</script>';
					}else{
						@file_put_contents('install.lock','');
				?>
				<div id="error"><p>网站安装成功</p><p>共导入<?php echo $num;?>条数据，网站安装成功</p><p>1、管理员账号admin，密码123456，请尽快修改密码。</p></div>
		</ul>
	</div>
</div>
				<?php
					}
				}else{
					echo'<script language=\'javascript\'>alert("保存数据库配置文件失败，请检查网站是否有写入权限！");history.go(-1);</script>';
				}
			}
		}
	}
}elseif($step=='4'){


?>


<?php }?>
</div>
</body>
</html>