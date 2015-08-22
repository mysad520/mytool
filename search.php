<?php
require_once('conn.php');
//************************执行代码开始*************************
$uin=safestr($_GET['uin']);
if(!$uin || !$qqrow=$db->get_row("select * from ".C('DB_PREFIX')."qqs where qq='{$uin}' limit 1")){
	exit("<script language='javascript'>alert('QQ不存在！');history.go(-1);</script>");
}








//************************执行代码结束**************************
C('webtitle',$uin.'-秒赞认证');
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
								<form id="signup-main" action="#" class="container offset1 loginform form-horizontal">
									<div class="pad">
										<h2>秒赞认证-<?=$uin?></h2>
										<table class="table table-striped"><thead>
										<tr>
											<th><a class="btn btn-block btn-default"><?=$uin?></a></th>
											<th><a href="tencent://AddContact/?fromId=45&fromSubId=1&subcmd=all&uin=<?=$uin?>&website" class="btn btn-block btn-primary">加为好友</a></th>
											<th><a href="http://user.qzone.qq.com/<?=$uin?>" class="btn btn-block btn-primary" onClick="if(!confirm('确认删除？')){return false;}">访问空间</a></th>
										</tr>
									</thead>
									<tbody>
									<tr>
										<td rowspan=2><img src="http://q2.qlogo.cn/headimg_dl?bs=qq&dst_uin=<?=$qqrow[qq]?>&src_uin=<?=$qqrow[qq]?>&fid=<?=$qqrow[qq]?>&spec=100&url_enc=0&referer=bu_interface&term_type=PC" class="col-xs-12 col-md-12"></td>
										<td align='center' colspan=2><a class="btn btn-block btn-lg btn-default"><?=get_qqnick($uin,'')?></a>
										</td>
									</tr>
									<tr>
										<td align='center' colspan=2><a class="btn btn-block btn-lg btn-warning">通过认证</a></td>
									</tr>
									<tr>
										<td align='center' colspan=3><span style="color: #0D6407;font-weight: bold;font-size: 20px;">此QQ已通过<?=C('webname')?>权威认定为离线秒赞QQ，你们可以放心加为高质量秒赞QQ好友！</span></td>
									</tr>
									<tr>
										<td align='center' colspan=3><span style="color: red;font-size: 20px;">认证时间:<?=date("Y-m-d H:i:s")?></span></td>
									</tr>
									</tbody>
									</table>
									</div>
								</form>
			
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-5 col-sm-4 hidden-xs">
						<div class="signup-text">
							<h3><?=get_qqnick($uin,'')?>的秒赞信息</h3>
							<p>
								他在本站添加了24H离线秒赞，所以绝对是高质量秒赞QQ！
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