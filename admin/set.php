<?php
require_once('common.php');
//************************执行代码开始*************************

if($do=$_POST['do']){
	foreach($_POST as $k=> $value){
		$db->query("insert into ".C('DB_PREFIX')."webconfigs set vkey='".safestr($k)."',value='".safestr($value)."' on duplicate key update value='".safestr($value)."'");
	}
	if($rows=$db->get_results("select * from ".C('DB_PREFIX')."webconfigs")){
		foreach($rows as $row){
			$webconfig[$row['vkey']]=$row['value'];
		}
		C($webconfig);
	}

	echo"<script language='javascript'>alert('保存成功！');</script>";
}





//**************************执行代码开始*******************************
if($_GET['xz']=='gg'){
	C('webtitle','公告设置');
	C('pageid','admingg');
}elseif($_GET['xz']=='mail'){
	C('webtitle','邮箱设置');
	C('pageid','adminmail');
}elseif($_GET['xz']=='price'){
	C('webtitle','价格设置');
	C('pageid','adminprice');
}elseif($_GET['xz']=='set'){
	C('webtitle','系统设置');
	C('pageid','adminset');
}else{
	C('webtitle','网站设置');
}
include_once 'common.head.php';
?>
		<div class="col-sm-12 col-sm-offset-10 col-md-10 col-md-offset-2 main">
			<h2 class="page-header">网站设置</h2>
			<div class="table-responsive">
				<div class="col-xs-12 col-md-4">
					<div class="panel panel-default">
						<div class="panel-heading" data-toggle="collapse" href="#collapseset">
							<h3 class="panel-title">系统设置</h3>
						</div>
						<div id="collapseset" class="panel-body <?php if($_GET['xz'] != 'set'){echo'collapse-xs';}?>">
							<form action="?xz=set" class="form-horizontal" method="post">
								<input type="hidden" name="do" value="set">
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">网站名称</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" name="webname" value="<?=C('webname')?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">网站介绍</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" name="webkey" value="<?=C('webkey')?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">网站域名</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" name="webdomain" value="<?=C('webdomain')?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">模板文件</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" name="webtemplate" value="<?=C('webtemplate')?>">
										<P>template/template1.php是当前模板</P>
										<P>template/template2.php是原来模板</P>
										<P>template/template3.php是官方最新测试模板</P>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">站长QQ</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" name="webqq" value="<?=C('webqq')?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">注册默认配额</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" name="regpeie" value="<?=C('regpeie')?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">注册赠送余额</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" name="regrmb" value="<?=C('regrmb')?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">秒赞服务器数量</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" name="zannet" value="<?=C('zannet')?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">每个服务器最多QQ数</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" name="netnum" value="<?=C('netnum')?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">不是VIP也可以使用所有功能</label>
									<div class="col-sm-9">
										<p>
											<label class="radio-inline">
												<input type="radio" name="webfree" value="0" checked="">No
											</label>
											<label class="radio-inline">
												<input type="radio" name="webfree" value="1" <?php if(C('webfree')==1) echo 'checked=""';?>>
												<font color="green">Yes</font>
											</label>
										</p>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">监控识别码</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" name="cronrand" value="<?=C('cronrand')?>">
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
						<div class="panel-heading" data-toggle="collapse" href="#collapsegg">
							<h3 class="panel-title">公告设置</h3>
						</div>
						<div id="collapsegg" class="panel-body <?php if($_GET['xz'] != 'gg'){echo'collapse-xs';}?>">
							<form action="?xz=gg" class="form-horizontal" method="post">
								<input type="hidden" name="do" value="gg">
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">首页介绍文字</label>
									<div class="col-sm-9">
										<textarea class="form-control" name="web_index_gg" rows="5"><?=stripslashes(C('web_index_gg'))?></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">个人中心公告</label>
									<div class="col-sm-9">
										<textarea class="form-control" name="web_control_gg" rows="5"><?=stripslashes(C('web_control_gg'))?></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">购买页说明</label>
									<div class="col-sm-9">
										<textarea class="form-control" name="web_shop_gg" rows="5"><?=stripslashes(C('web_shop_gg'))?></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">充值页公告(用于展示购买卡密地址)</label>
									<div class="col-sm-9">
										<textarea class="form-control" name="web_rmb_gg" rows="5"><?=stripslashes(C('web_rmb_gg'))?></textarea>
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
						<div class="panel-heading" data-toggle="collapse" href="#collapsemail">
							<h3 class="panel-title">邮箱配置</h3>
						</div>
						<div id="collapsemail" class="panel-body <?php if($_GET['xz'] != 'mail'){echo'collapse-xs';}?>">
							<form action="?xz=mail" class="form-horizontal" method="post">
								<input type="hidden" name="do" value="mail">
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">邮箱账号</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" name="mail_email" value="<?=C('mail_email')?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">邮箱密码</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" name="mail_pwd" value="<?=C('mail_pwd')?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">SMTP服务器</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" name="mail_host" value="<?=C('mail_host')?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">SMTP端口(非SSL协议)</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" name="mail_port" value="<?=C('mail_port')?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-xs-8 "></label>
									<div class=="col-xs-4"><input type="submit" name="submit" value="确认保存" class="btn btn-primary"></div>
								</div>
							</form>
						</div>
					</div>
				</div>
				
			</div>
			<h2 class="page-header">价格配置</h2>
			<div class="table-responsive">
				<div class="col-xs-12 col-md-4">
					<div class="panel panel-default">
						<div class="panel-heading" data-toggle="collapse" href="#collapseprice">
							<h3 class="panel-title">价格设置(元)</h3>
						</div>
						<div id="collapseprice" class="panel-body <?php if($_GET['xz'] != 'price'){echo'collapse-xs';}?>">
							<form action="?xz=price" class="form-horizontal" method="post">
								<input type="hidden" name="do" value="pricet">
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">1天VIP</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" name="price_1dvip" value="<?=C('price_1dvip')?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">1月VIP</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" name="price_1vip" value="<?=C('price_1vip')?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">3月VIP</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" name="price_3vip" value="<?=C('price_3vip')?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">6月VIP</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" name="price_6vip" value="<?=C('price_6vip')?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">12月VIP</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" name="price_12vip" value="<?=C('price_12vip')?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">1个配额</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" name="price_1peie" value="<?=C('price_1peie')?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">3个配额</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" name="price_3peie" value="<?=C('price_3peie')?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">5个配额</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" name="price_5peie" value="<?=C('price_5peie')?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">10个配额</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" name="price_10peie" value="<?=C('price_10peie')?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-xs-8 "></label>
									<div class=="col-xs-4"><input type="submit" name="submit" value="确认保存" class="btn btn-primary"></div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div
><?php
include_once 'common.foot.php';
?>