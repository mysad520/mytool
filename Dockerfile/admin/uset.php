<?php
require_once('common.php');
//************************执行代码开始*************************
$uid=is_numeric($_GET['uid'])?$_GET['uid']:'0';
if(!$uid || !$user=$db->get_row("select * from ".C('DB_PREFIX')."users where uid='$uid' limit 1")){
	exit("<script language='javascript'>alert('用户不存在！');window.location.href='ulist.php';</script>");
}
if($do=$_POST['do']){
	$rmb=is_numeric($_POST['rmb'])?$_POST['rmb']:'0';
	if($do=='update'){
		$vip=is_numeric($_POST['vip'])?$_POST['vip']:'0';
		$peie=is_numeric($_POST['peie'])?$_POST['peie']:'0';
		$vipend=safestr($_POST['vipend']);
		$mail=safestr($_POST['mail']);
		$phone=safestr($_POST['phone']);
		$set="rmb='{$rmb}',vip='{$vip}',peie='{$peie}',vipend='{$vipend}',mail='{$mail}',phone='{$phone}'";
		if($_POST['pwd']){
			$pwd=md5(md5($_POST['pwd']).md5('815856515'));
			$set.=",pwd='{$pwd}'";
		}
		$db->query("update ".C('DB_PREFIX')."users set {$set} where uid='$uid'");
		echo"<script language='javascript'>alert('修改成功');</script>";
	}elseif($do=='re'){
		$db->query("update ".C('DB_PREFIX')."users set rmb=rmb+{$rmb} where uid='$uid'");
		echo"<script language='javascript'>alert('成功充值{$rmb}元');</script>";
	}elseif($do=='cut'){
		$db->query("update ".C('DB_PREFIX')."users set rmb=rmb-{$rmb} where uid='$uid'");
		echo"<script language='javascript'>alert('成功扣取{$rmb}元');</script>";
	}elseif($do=='vip'){
		$ms=is_numeric($_POST['ms'])?$_POST['ms']:'1';
		if(get_isvip($user[vip],$user[vipend])){
			$vipend=date("Y-m-d",strtotime("+ $ms months",strtotime($user[vipend])));
			$db->query("update ".C('DB_PREFIX')."users set vip=1,vipend='{$vipend}' where uid='$uid'");
			echo"<script language='javascript'>alert('成功为他续费{$ms}个月VIP');</script>";
		}else{
			$vipend=date("Y-m-d",strtotime("+ $ms months"));
			$db->query("update ".C('DB_PREFIX')."users set vip=1,vipstart='".date("Y-m-d")."',vipend='{$vipend}' where uid='$uid'");
			echo"<script language='javascript'>alert('成功为他开通{$ms}个月VIP');</script>";
		}
	}
	$user=$db->get_row("select * from ".C('DB_PREFIX')."users where uid='$uid' limit 1");
}





//**************************执行代码开始*******************************

C('webtitle',$user[user].'-用户修改');
C('pageid','adminuser');
include_once 'common.head.php';
?>
		<div class="col-sm-12 col-sm-offset-10 col-md-10 col-md-offset-2 main">
			<h2 class="page-header">用户修改-<?=$user['user']?></h2>
			<div class="table-responsive">
				<div class="col-xs-12 col-md-4">
					<div class="panel panel-default">
						<div class="panel-heading" data-toggle="collapse" href="#collapseupdate">
							<h3 class="panel-title">资料修改</h3>
						</div>
						<div id="collapseupdate" class="panel-body <?php if($_GET['xz'] != 'update'){echo'collapse-xs';}?>">
							<form action="?uid=<?=$uid?>&xz=update" class="form-horizontal" method="post">
								<input type="hidden" name="do" value="update">
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">UID</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" placeholder="<?=$user[uid]?>" readonly>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">用户名</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" placeholder="<?=$user[user]?>" readonly>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">是否VIP</label>
									<div class="col-sm-9">
										<p>
											<label class="radio-inline">
												<input type="radio" name="vip" value="0" checked="">No
											</label>
											<label class="radio-inline">
												<input type="radio" name="vip" value="1" <?php if($user[vip]==1) echo 'checked=""';?>>
												<font color="green">Yes</font>
											</label>
										</p>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">VIP到期</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" name="vipend" value="<?=$user[vipend]?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">配额</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" name="peie" value="<?=$user[peie]?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">余额</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" name="rmb" value="<?=$user[rmb]?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">邮箱</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" name="mail" value="<?=$user[mail]?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">手机号</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" name="phone" value="<?=$user[phone]?>">
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
				<div class="col-xs-12 col-md-4">
					<div class="panel panel-default">
						<div class="panel-heading" data-toggle="collapse" href="#collapsere">
							<h3 class="panel-title">账户充值</h3>
						</div>
						<div id="collapsere" class="form-horizontal panel-body <?php if($_GET['xz'] != 're'){echo'collapse-xs';}?>">
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">当前余额</label>
									<div class="input-group col-sm-8">
										<div class="input-group-addon">￥</div>
										<input type="text" class="form-control" placeholder="<?=$user[rmb]?>" readonly>
										<div class="input-group-addon">&nbsp;&nbsp;.00</div>
									 </div>
								</div>
								<form action="?uid=<?=$uid?>&xz=re" method="post">
								<input type="hidden" name="do" value="re">
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">充值</label>
									<div class="input-group col-sm-8">
										<div class="input-group-addon">￥</div>
										<input type="text" name="rmb" class="form-control" value="1">
										<div class="input-group-addon"><input type="submit" value="充值"></div>
									 </div>
								</div>
								</form>
								<form action="?uid=<?=$uid?>&xz=re" method="post">
								<input type="hidden" name="do" value="cut">
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">扣取</label>
									<div class="input-group col-sm-8">
										<div class="input-group-addon">￥</div>
										<input type="text" name="rmb" class="form-control" value="1">
										<div class="input-group-addon"><input type="submit" value="扣取"></div>
									 </div>
								</div>
								</form>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-md-4">
					<div class="panel panel-default">
						<div class="panel-heading" data-toggle="collapse" href="#collapsevip">
							<h3 class="panel-title">开通VIP</h3>
						</div>
						<div id="collapsevip" class="form-horizontal panel-body <?php if($_GET['xz'] != 'vip'){echo'collapse-xs';}?>">
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">当前VIP</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" placeholder="<?php if(get_isvip($user[vip],$user[vipend])){ echo "{$user[vipend]}";}else{echo"不是VIP";}?>" readonly>
									</div>
								</div>
							<form action="?uid=<?=$uid?>&xz=re" method="post">
								<input type="hidden" name="do" value="vip">
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">开通月数</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" name="ms" value="1">
									</div>
								</div>
								<div class="form-group">
									<label class="col-xs-8 "></label>
									<div class=="col-xs-4"><input type="submit" name="submit" value="确认开通" class="btn btn-primary"></div>
								</div>
							</form>
						</div>
					</div>
				</div>
				
			</div>
		</div
<?php
include_once 'common.foot.php';
?>