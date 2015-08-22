<?php
require_once('common.php');
//************************执行代码开始*************************
if($_POST['do']=='rmb'){
	$km=safestr($_POST['km']);
	if(!$row=$db->get_row("select * from ".C('DB_PREFIX')."kms where km='$km' limit 1")){
		echo"<script language='javascript'>alert('充值卡卡密不存在！');</script>";
	}elseif($row['isuse']){
		echo"<script language='javascript'>alert('该充值卡卡密已使用！');</script>";
	}else{
		$now=date("Y-m-d H:i:s");
		$db->query("update ".C('DB_PREFIX')."kms set isuse=1,uid='{$userrow[uid]}',usetime='$now' where kid='{$row['kid']}'");
		$db->query("update ".C('DB_PREFIX')."users set rmb=rmb+$row[ms] where uid='{$userrow[uid]}'");
		$userrow['rmb']=$userrow['rmb']+$row[ms];
		echo"<script language='javascript'>alert('成功充值{$row['ms']}元！');</script>";
	}
}


//**************************执行代码开始*******************************

C('webtitle','在线充值');
C('pageid','rmb');
include_once 'common.head.php';
?>
					<div class="templatemo-content-container">
          <div class="templatemo-flex-row flex-content-row">
            <div class="templatemo-content-widget white-bg col-2">
              <i class="fa fa-times"></i>
              <div class="square"></div>
              <h2 class="templatemo-inline-block">充值说明</h2><hr>
              <p><?=stripslashes(C('web_rmb_gg'))?></p>              
            </div>
           
            
          </div>
		  <div class="panel panel-default">
						<div class="panel-heading" data-toggle="collapse" href="#collapseshop">
							<h3 class="panel-title">在线充值</h3>
						</div>
						<div id="collapseshop" class="panel-body">
							<form action="?" class="form-horizontal" method="post">
								<input type="hidden" name="do" value="rmb">
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">当前余额</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" placeholder="<?=$userrow[rmb]?>" readonly>
									</div>
								</div>
							
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">充值卡卡密</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" name="km" placeholder="输入购买的充值卡卡密">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-xs-8 "></label>
									<div class=="col-xs-4"><input type="submit" name="submit" value="确认充值" class="btn btn-primary"></div>
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