<?php
require_once('common.php');
//************************执行代码开始*************************
if($do=$_POST['do']){
	if($do=='update'){
		$phone=safestr($_POST['phone']);
		$mail=safestr($_POST['mail']);
		$set="phone='{$phone}'";
		if($_POST['pwd']){
			$pwd=md5(md5($_POST['pwd']).md5('815856515'));
			$set.=",pwd='{$pwd}'";
		}
		if($db->get_row("select * from ".C('DB_PREFIX')."users where phone='{$phone}' and uid!='{$userrow['uid']}' limit 1")){
			echo"<script language='javascript'>alert('手机号已存在！');</script>";
		}else{
			$db->query("update ".C('DB_PREFIX')."users set {$set} where uid='{$userrow['uid']}'");
			if($_POST['mail']){
		 $set="mail='{$mail}'";
		}
		if($db->get_row("select * from ".C('DB_PREFIX')."users where mail='{$mail}' and uid!='{$userrow['uid']}' limit 1")){
			echo"<script language='javascript'>alert('邮箱已存在！');</script>";
		}else{
			$db->query("update ".C('DB_PREFIX')."users set {$set} where uid='{$userrow['uid']}'");
			echo"<script language='javascript'>alert('修改成功');</script>";
		}
		}
		
	}
	$userrow=$db->get_row("select * from ".C('DB_PREFIX')."users where uid='{$userrow['uid']}' limit 1");
}


//**************************执行代码开始*******************************

C('webtitle',$userrow[user].'-用户修改');
C('pageid','uset');
include_once 'common.head.php';
?>
		<div class="templatemo-content-container">
          <div class="templatemo-flex-row flex-content-row">
            <div class="templatemo-content-widget white-bg col-2">
              <i class="fa fa-times"></i>
              <div class="square"></div>
              <h2 class="templatemo-inline-block">用户修改-<?=$userrow['user']?></h2><hr>           
            </div>
          </div>
			
			<div class="table-responsive">
				<div class="col-xs-12 col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading" data-toggle="collapse" href="#collapseupdate">
							<h3 class="panel-title">资料修改</h3>
						</div>
						<div id="collapseupdate" class="panel-body">
							<form action="?" class="form-horizontal" method="post">
								<input type="hidden" name="do" value="update">
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">UID</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" placeholder="<?=$userrow[uid]?>" readonly>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">用户名</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" placeholder="<?=$userrow[user]?>" readonly>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">VIP到期</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" placeholder="<?php if(get_isvip($userrow[vip],$userrow[vipend])){ echo "{$userrow[vipend]}";}else{echo"不是VIP";}?>" readonly>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">配额</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" placeholder="<?=$userrow[peie]?>" readonly>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">余额</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" placeholder="<?=$userrow[rmb]?>" readonly>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">邮箱</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" name="mail" placeholder="<?=$userrow[mail]?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">手机号</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" name="phone" value="<?=$userrow[phone]?>">
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">修改密码</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" name="pwd" placeholder="留空则不修改">
									</div>
								</div>
								<div class="form-group">
									<label class="col-xs-8 "></label>
									<div class=="col-xs-4"><input type="submit" name="submit" value="确认修改" class="btn btn-primary"></div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		
<?php
include_once 'common.foot.php';
?>