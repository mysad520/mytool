<?php
require_once('common.php');
C('webtitle','副站长管理后台');
C('pageid','vice');
include_once 'common.head.php';
?>

		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<h1 class="page-header" style="text-align: center;color: #6C0505;">后台中心</h1>
			<h3 class="page-header">网站配置</h3>
			<div class="row placeholders">

			<h3 class="page-header">用户管理</h3>
			<div class="row placeholders">
				<div class="col-xs-4 col-sm-2 placeholder">
					<a href="ulist.php"><img src="/public/adminpage/user.jpg" class="img-responsive" style="width:60%;">
					<h4>用户列表</h4></a>
				</div>
				<div class="col-xs-4 col-sm-2 placeholder">
					<a href="qlist.php"><img src="/public/adminpage/qq.jpg" class="img-responsive" style="width:60%;">
					<h4>QQ列表</h4></a>
				</div>
			</div>
		</div>
<?php
include_once 'common.foot.php';
?>