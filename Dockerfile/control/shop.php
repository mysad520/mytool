<?php
require_once('common.php');
//************************执行代码开始*************************
if($do=$_POST['do']){
	if($do=='shop'){
		$shop=is_numeric($_POST['shop'])?$_POST['shop']:'0';
		if($shop==99){
			$rmb=C('price_1dvip');
			$buyms=1;$buyday=1;
		}elseif($shop==1){
			$rmb=C('price_1vip');
			$buyms=1;
		}elseif($shop==2){
			$rmb=C('price_3vip');
			$buyms=3;
		}elseif($shop==3){
			$rmb=C('price_6vip');
			$buyms=6;
		}elseif($shop==4){
			$rmb=C('price_12vip');
			$buyms=12;
		}elseif($shop==5){
			$rmb=C('price_1peie');
			$buypeie=1;
		}elseif($shop==6){
			$rmb=C('price_3peie');
			$buypeie=3;
		}elseif($shop==7){
			$rmb=C('price_5peie');
			$buypeie=5;
		}elseif($shop==8){
			$rmb=C('price_10peie');
			$buypeie=10;
		}else{
			exit("<script language='javascript'>alert('请先选择你需要购买 的商品！');history.go(-1);</script>");
		}
		if($userrow['rmb']<$rmb){
			echo"<script language='javascript'>alert('余额不足，请联系QQ".C('webqq')."充值！');</script>";
		}else{
			if($buyms){
				if(get_isvip($userrow[vip],$userrow[vipend])){
					if($buyday){
						$vipend=date("Y-m-d",strtotime("+ $buyday days",strtotime($userrow[vipend])));
						echo"<script language='javascript'>alert('成功续费{$buyms}天VIP');</script>";
					}else{
						$vipend=date("Y-m-d",strtotime("+ $buyms months",strtotime($userrow[vipend])));
						echo"<script language='javascript'>alert('成功续费{$buyms}个月VIP');</script>";
					}
					$db->query("update ".C('DB_PREFIX')."users set rmb=rmb-{$rmb},vip=1,vipend='{$vipend}' where uid='{$userrow[uid]}'");
				}else{
					if($buyday){
						$vipend=date("Y-m-d",strtotime("+ $buyday days"));
						echo"<script language='javascript'>alert('成功开通{$buyday}天VIP');</script>";
					}else{
						$vipend=date("Y-m-d",strtotime("+ $buyms months"));
						echo"<script language='javascript'>alert('成功开通{$buyms}个月VIP');</script>";
					}
					$db->query("update ".C('DB_PREFIX')."users set rmb=rmb-{$rmb},vip=1,vipstart='".date("Y-m-d")."',vipend='{$vipend}' where uid='{$userrow[uid]}'");
				}
			}elseif($buypeie){
				$db->query("update ".C('DB_PREFIX')."users set rmb=rmb-{$rmb},peie=peie+$buypeie where uid='{$userrow[uid]}'");
				echo"<script language='javascript'>alert('成功购买{$buypeie}个配额');</script>";
			}
			$userrow=$db->get_row("select * from ".C('DB_PREFIX')."users where uid='{$userrow[uid]}' limit 1");
		}
	}
}


//**************************执行代码开始*******************************

C('webtitle','自助商城');
C('pageid','shop');
include_once 'common.head.php';
?>
<div class="templatemo-content-container">
          <div class="templatemo-flex-row flex-content-row">
            <div class="templatemo-content-widget white-bg col-2">
              <i class="fa fa-times"></i>
              <div class="square"></div>
              <h2 class="templatemo-inline-block">购买说明</h2><hr>
              <p><?=stripslashes(C('web_shop_gg'))?></p>              
            </div>
           
            
          </div>
          <div class="panel panel-default">
						<div class="panel-heading" data-toggle="collapse" href="#collapseshop">
							<h3 class="panel-title">在线购买</h3>
						</div>
						<div id="collapseshop" class="panel-body">
							<form action="?" class="form-horizontal" method="post">
								<input type="hidden" name="do" value="shop">
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">当前余额</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" placeholder="<?=$userrow[rmb]?>" readonly>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">当前VIP</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" placeholder="<?php if(get_isvip($userrow[vip],$userrow[vipend])){ echo "{$userrow[vipend]}";}else{echo"不是VIP";}?>" readonly>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">当前配额</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" placeholder="<?=$userrow[peie]?>" readonly>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">购买服务</label>
									<div class="col-sm-9">
										<select class="col-sm-8 radio-inline" name="shop">
										<option value ='99'>1天试用VIP(<?=C('price_1dvip')?>元)</option>";
										<option value ='1'>1个月VIP(<?=C('price_1vip')?>元)</option>";
										<option value ='2'>3个月VIP(<?=C('price_3vip')?>元)</option>";
										<option value ='3'>6个月VIP(<?=C('price_6vip')?>元)</option>";
										<option value ='4'>12个月VIP(<?=C('price_12vip')?>元)</option>";
										<option value ='5'>1个配额(<?=C('price_1peie')?>元)</option>";
										<option value ='6'>3个配额(<?=C('price_3peie')?>元)</option>";
										<option value ='7'>5个配额(<?=C('price_5peie')?>元)</option>";
										<option value ='8'>10个配额(<?=C('price_10peie')?>元)</option>";
										</select>	
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-xs-8 "></label>
									<div class=="col-xs-4"><input type="submit" name="submit" value="确认购买" class="btn btn-primary"></div>
								</div>
							</form>
						</div>
					</div>
<?php
include_once 'common.foot.php';
?>