<?php
require_once('common.php');
//************************执行代码开始*************************
$qid=is_numeric($_GET['qid'])?$_GET['qid']:'0';
if(!$qid || !$qqrow=$db->get_row("select * from ".C('DB_PREFIX')."qqs where qid='$qid' and uid='$userrow[uid]' limit 1")){
	exit("<script language='javascript'>alert('QQ不存在！');window.location.href='/control';</script>");
}elseif(!C('webfree') && !get_isvip($userrow[vip],$userrow[vipend])){
	exit("<script language='javascript'>alert('对不起，你不是VIP,无法开启功能！');window.location.href='/control';</script>");
}
if($do=$_POST['do']){
	$is=is_numeric($_POST['is'])?$_POST['is']:'0';
	$net=is_numeric($_POST['net'])?$_POST['net']:'0';
	if($do=='3gqq'){
		$db->query("update ".C('DB_PREFIX')."qqs set is3gqq='$is' where qid='$qid'");
		echo"<script language='javascript'>alert('离线挂扣修改成功');window.location.href='/control/qqlist.php?qid=$qid';</script>";
	}elseif($do=='reply'){
		$con=safestr($_POST['content']);
		$db->query("update ".C('DB_PREFIX')."qqs set isreply='$is',replycon='$con' where qid='$qid'");
		echo"<script language='javascript'>alert('说说秒评修改成功');window.location.href='/control/qqlist.php?qid=$qid';</script>";
	}elseif($do=='zf'){
		$con=safestr($_POST['content']);
		$zfok=safestr($_POST['zfok']);
		$db->query("update ".C('DB_PREFIX')."qqs set iszf='$is',zfcon='$con',zfok='$zfok' where qid='$qid'");
		echo"<script language='javascript'>alert('转发说说修改成功');window.location.href='/control/qqlist.php?qid=$qid';</script>";
	}elseif($do=='zan'){
		if($is && !$net){
			echo"<script language='javascript'>alert('请选择个合适的服务器');window.location.href='/control/qqlist.php?qid=$qid';</script>";	
		}elseif($net && $qqrow['zannet']!=$net && get_count('qqs',"zannet='$net'",'qid')>=C('netnum')){
			echo"<script language='javascript'>alert('{$net}号服务器已满，请换一个服务器！');window.location.href='/control/qqlist.php?qid=$qid';</script>";	
		}else{
			$db->query("update ".C('DB_PREFIX')."qqs set iszan='$is',zannet='$net' where qid='$qid'");
			echo"<script language='javascript'>alert('说说秒赞修改成功');window.location.href='/control/qqlist.php?qid=$qid';</script>";
		}	
	}elseif($do=='shuo'){
		$con=safestr($_POST['content']);
		$url=safestr($_POST['shuopic']);
		$phone=safestr($_POST['shuophone']);
		$rate=is_numeric($_POST['rate'])?$_POST['rate']:'90';
		$db->query("update ".C('DB_PREFIX')."qqs set isshuo='$is',shuoshuo='$con',shuopic='$url',shuophone='$phone' where qid='$qid'");
		echo"<script language='javascript'>alert('自动说说修改成功');window.location.href='/control/qqlist.php?qid=$qid';</script>";
	}elseif($do=='del'){
		$db->query("update ".C('DB_PREFIX')."qqs set isdel='$is' where qid='$qid'");
		echo"<script language='javascript'>alert('删除说说修改成功');window.location.href='/control/qqlist.php?qid=$qid';</script>";
	}elseif($do=='qd'){
		$con=safestr($_POST['content']);
		$db->query("update ".C('DB_PREFIX')."qqs set isqd='$is',qdcon='$con' where qid='$qid'");
		echo"<script language='javascript'>alert('空间签到修改成功');window.location.href='/control/qqlist.php?qid=$qid';</script>";	
	}elseif($do=='upload'){
		if(($_FILES["file"]["type"] == "image/gif") || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/pjpeg") || ($_FILES["file"]["type"] == "image/png")){
			if ($_FILES["file"]["error"] > 0){
				echo'<script language=\'javascript\'>alert(\'图片上传失败。'.$_FILES["file"]["error"].'\');</script>';
			}else{
				$image=file_get_contents($_FILES["file"]["tmp_name"]);
				$upload=uploadimg($qqrow['qq'],$qqrow['sid'],$image);
				if(!stripos('z'.$upload,'图片')){
					$uploadimg=$upload;
					echo '<script language=\'javascript\'>alert(\'图片上传成功，请点击保存！\');</script>';
				}else{
					exit('<script language=\'javascript\'>alert(\'上传QQ空间失败！'.$upload.'\');</script>');
				}
			}
		}else{
			exit('<script language=\'javascript\'>alert(\'图片格式不正确！\');history.go(-1);</script>');
		}
	}elseif($do=='ly'){
		$db->query("update ".C('DB_PREFIX')."qqs set isly='$is' where qid='$qid'");
		echo"<script language='javascript'>alert('互刷留言修改成功');window.location.href='/control/qqlist.php?qid=$qid';</script>";
	}elseif($do=='zyzan'){
		$db->query("update ".C('DB_PREFIX')."qqs set iszyzan='$is' where qid='$qid'");
		echo"<script language='javascript'>alert('互赞主页修改成功');window.location.href='/control/qqlist.php?qid=$qid';</script>";
	}elseif($do=='ht'){
		$db->query("update ".C('DB_PREFIX')."qqs set isly='$is' where qid='$qid'");
		echo"<script language='javascript'>alert('花藤服务修改成功');window.location.href='/control/qqlist.php?qid=$qid';</script>";
	}elseif($do=='vipqd'){
		$db->query("update ".C('DB_PREFIX')."qqs set isvipqd='$is' where qid='$qid'");
		echo"<script language='javascript'>alert('会员签到成功');window.location.href='/control/qqlist.php?qid=$qid';</script>";
	}elseif($do=='ts'){
		$db->query("update ".C('DB_PREFIX')."qqs set ists='$is' where qid='$qid'");
		echo"<script language='javascript'>alert('图书签到修改成功');window.location.href='/control/qqlist.php?qid=$qid';</script>";
	}
	$qqrow=$db->get_row("select * from ".C('DB_PREFIX')."qqs where qid='$qid' and uid='$userrow[uid]' limit 1");
	if($uploadimg) $qqrow['shuopic']=$uploadimg;
}





//**************************执行代码开始*******************************

C('webtitle','QQ'.$qqrow['qq']);
C('pageid','qqset');
include_once 'common.head.php';
?>
<div class="templatemo-content-container">
          <div class="templatemo-flex-row flex-content-row">
            <div class="templatemo-content-widget white-bg col-2">
              <i class="fa fa-times"></i>
              <div class="square"></div>
              <h2 class="templatemo-inline-block">配置-<?=$qqrow['qq']?></h2><hr>     
<div class="table-responsive">
				<div class="col-xs-12 col-md-12 <?php if($_GET['xz'] != 'zan'){echo'collapse-md';}?>">
					<a name="zan"></a>
					<div class="panel panel-default">
						<div class="panel-heading" data-toggle="collapse" href="#collapsezan">
							<h3 class="panel-title">秒赞配置【<?=getzt($qqrow[iszan])?>】</h3>
						</div>
						<div id="collapsezan" class="panel-body <?php if($_GET['xz'] != 'zan'){echo'collapse-xs';}?>">
							<form action="?qid=<?=$qid?>&xz=zan#zan" class="form-horizontal" method="post">
								<input type="hidden" name="do" value="zan">
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">选择</label>
									
									<div class="col-sm-9">
										<p>
											<label class="radio-inline">
												<input type="radio" name="is" value="0" checked="">
												关闭
											</label>
											<label class="radio-inline">
												<input type="radio" name="is" value="1" <?php if($qqrow[iszan]==1) echo 'checked=""';?>>
												<font color="green">触屏版</font>
											</label>
											<label class="radio-inline">
												<input type="radio" name="is" value="2" <?php if($qqrow[iszan]==2) echo 'checked=""';?>>
												<font color="green">P&nbsp;C版(推荐)</font>
											</label>
										</p>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">选择服务器</label>
									<select class="col-sm-8 radio-inline" name="net">
										<?php 
										$str="";
										for($i=1;$i<=C('zannet');$i++){
											$str.="<option value ='{$i}' ";
											if($qqrow['zannet'] == $i){
												$str.="selected='selected'";
											}
											$str.=">{$i}号服务器(";
											$num=get_count('qqs',"zannet='$i'",'qid');
											if($num>=C('netnum')){
												$str.="已满";
											}else{
												$str.="{$num}个";
											}
											$str.=")</option>";
										}
										echo $str;
										?>
									</select>	
								</div>
								<div class="form-group">
									<label class="col-xs-8 "></label>
									<div class=="col-xs-4"><input type="submit" name="submit" value="保存配置" class="btn btn-primary"></div>
								</div>
							</form>
						</div>
					</div>
				</div>
				
				<div class="col-xs-12 col-md-12 <?php if($_GET['xz'] != 'reply'){echo'collapse-md';}?>">
					<a name="reply"></a>
					<div class="panel panel-default">
						<div class="panel-heading" data-toggle="collapse" href="#collapsereply">
							<h3 class="panel-title">秒评配置【<?=getzt($qqrow[isreply])?>】</h3>
						</div>
						<div id="collapsereply" class="panel-body <?php if($_GET['xz'] != 'reply'){echo'collapse-xs';}?>">
							<form action="?qid=<?=$qid?>&xz=reply#reply" class="form-horizontal" method="post">
								<input type="hidden" name="do" value="reply">
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">选择</label>
									
									<div class="col-sm-9">
										<p>
											<label class="radio-inline">
												<input type="radio" name="is" value="0" checked="">
												关闭(推荐)
											</label>
											<label class="radio-inline">
												<input type="radio" name="is" value="1" <?php if($qqrow[isreply]==1) echo 'checked=""';?>>
												<font color="green">触屏版</font>
											</label>
											<label class="radio-inline">
												<input type="radio" name="is" value="2" <?php if($qqrow[isreply]==2) echo 'checked=""';?>>
												<font color="green">P&nbsp;C版</font>
											</label>
										</p>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-5">评论内容</label>
									
									<div class="col-sm-9">
										<textarea class="form-control" name="content" cols="12" placeholder="输入内容,留空系统随机语录"><?=$qqrow['replycon']?></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-5">内容可用标签</label>
									<div class="col-sm-9"><p style="color:green;">[表情]&nbsp;&nbsp;随机表情;<br>[语录]&nbsp;&nbsp;随机语录;<br>[时间]&nbsp;&nbsp;当前时间; </p></div>
								</div>
								<div class="form-group">
									<label class="col-xs-8 "></label>
									<div class=="col-xs-4"><input type="submit" name="submit" value="保存配置" class="btn btn-primary"></div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-md-12 <?php if($_GET['xz'] != 'zf'){echo'collapse-md';}?>">
					<a name="zf"></a>
					<div class="panel panel-default">
						<div class="panel-heading" data-toggle="collapse" href="#collapsereply">
							<h3 class="panel-title">转发说说【<?=getzt($qqrow[iszf])?>】</h3>
						</div>
						<div id="collapsezf" class="panel-body <?php if($_GET['xz'] != 'zf'){echo'collapse-xs';}?>">
							<form action="?qid=<?=$qid?>&xz=zf#zf" class="form-horizontal" method="post">
								<input type="hidden" name="do" value="zf">
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">选择</label>
									
									<div class="col-sm-9">
										<p>
											<label class="radio-inline">
												<input type="radio" name="is" value="0" checked="">
												关闭
											</label>
											<label class="radio-inline">
												<input type="radio" name="is" value="1" <?php if($qqrow[iszf]==1) echo 'checked=""';?>>
												<font color="green">触屏版(推荐)</font>
											</label>
											<label class="radio-inline">
												<input type="radio" name="is" value="2" <?php if($qqrow[iszf]==2) echo 'checked=""';?>>
												<font color="green">P&nbsp;C版</font>
											</label>
										</p>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-5">转发内容</label>
									<div class="col-sm-9">
										<textarea class="form-control" name="content" cols="12"><?=$qqrow['zfcon']?></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-5">白名单QQ</label>
									<div class="col-sm-9">
										<textarea class="form-control" name="zfok" cols="12" placeholder="输入你要转发的人的QQ,多个用,隔开！"><?=$qqrow['zfok']?></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-xs-8 "></label>
									<div class=="col-xs-4"><input type="submit" name="submit" value="保存配置" class="btn btn-primary"></div>
								</div>
							</form>
						</div>
					</div>
				</div>
	
				<div class="col-xs-12 col-md-12 <?php if($_GET['xz'] != 'shuo'){echo'collapse-md';}?>">
					<a name="shuo"></a>
					<div class="panel panel-default">
						<div class="panel-heading" data-toggle="collapse" href="#collapseshuo">
							<h3 class="panel-title">自动说说【<?=getzt($qqrow[isshuo])?>】</h3>
						</div>
						<div id="collapseshuo" class="panel-body <?php if($_GET['xz'] != 'shuo'){echo'collapse-xs';}?>">
								<form action="?qid=<?=$qid?>&xz=shuo#shuo" method="post" enctype="multipart/form-data" class="form-horizontal">
								<input type="hidden" name="do" value="upload">
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-4">上传说说图片</label>
									<div class="col-sm-7">
										<input type="file" name="file" class="form-control">
									</div>
									<div class="col-sm-2">
										<input type="submit" value="上传">
									</div>
								</div>
								</form>
								<form action="?qid=<?=$qid?>&xz=shuo#shuo" class="form-horizontal" method="post">
								<input type="hidden" name="do" value="shuo">
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">选择</label>
									
									<div class="col-sm-9">
										<p>
											<label class="radio-inline">
												<input type="radio" name="is" value="0" checked="">
												关闭
											</label>
											<label class="radio-inline">
												<input type="radio" name="is" value="1" <?php if($qqrow[isshuo]==1) echo 'checked=""';?>>
												<font color="green">触屏版(推荐)</font>
											</label>
											<label class="radio-inline">
												<input type="radio" name="is" value="2" <?php if($qqrow[isshuo]==2) echo 'checked=""';?>>
												<font color="green">P&nbsp;C版</font>
											</label>
										</p>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">发说说频率</label>
									<select class="col-sm-8 radio-inline" name="rate">
										<?php 
										$str="";
										for($i=15;$i<=90;$i=$i+5){
											$str.="<option value ='{$i}' ";
											if($qqrow['shuonet'] == $i){
												$str.="selected='selected'";
											}
											$str.=">{$i}分钟</option>";
										}
										echo $str;
										?>
									</select>	
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-5">说说内容</label>
									<div class="col-sm-9">
										<textarea class="form-control" name="content" cols="12"><?=$qqrow['shuoshuo']?></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-5">内容可用标签</label>
									<div class="col-sm-9"><p style="color:green;">[表情]&nbsp;&nbsp;随机表情;<br>[语录]&nbsp;&nbsp;随机语录;<br>[时间]&nbsp;&nbsp;当前时间; </p></div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-5">说说图片</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" name="shuopic" value="<?=$qqrow['shuopic']?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-5">图片提示</label>
									<div class="col-sm-9">
										上传图片，这里自动生成的内容，请不要修改！填写 1 将发布随机图片！
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-5">设置机型</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" name="shuophone" value="<?=$qqrow['shuophone']?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-xs-8 "></label>
									<div class=="col-xs-4"><input type="submit" name="submit" value="保存配置" class="btn btn-primary"></div>
								</div>
							</form>
						</div>
					</div>
				</div>
				
				<div class="col-xs-12 col-md-12 <?php if($_GET['xz'] != 'qd'){echo'collapse-md';}?>">
					<a name="qd"></a>
					<div class="panel panel-default">
						<div class="panel-heading" data-toggle="collapse" href="#collapseqd">
							<h3 class="panel-title">空间签到【<?=getzt($qqrow[isqd])?>】</h3>
						</div>
						<div id="collapseqd" class="panel-body <?php if($_GET['xz'] != 'qd'){echo'collapse-xs';}?>">
							<form action="?qid=<?=$qid?>&xz=qd#qd" class="form-horizontal" method="post">
								<input type="hidden" name="do" value="qd">
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">选择</label>
									
									<div class="col-sm-9">
										<p>
											<label class="radio-inline">
												<input type="radio" name="is" value="0" checked="">
												关闭(推荐)
											</label>
											<label class="radio-inline">
												<input type="radio" name="is" value="1" <?php if($qqrow[isqd]==1) echo 'checked=""';?>>
												<font color="green">触屏版</font>
											</label>
											<label class="radio-inline">
												<input type="radio" name="is" value="2" <?php if($qqrow[isqd]==2) echo 'checked=""';?>>
												<font color="green">P&nbsp;C版</font>
											</label>
										</p>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-5">签到内容</label>
									
									<div class="col-sm-9">
										<textarea class="form-control" name="content" cols="12" placeholder="输入内容,留空系统随机语录"><?=$qqrow['qdcon']?></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-5">内容可用标签</label>
									<div class="col-sm-9"><p style="color:green;">[表情]&nbsp;&nbsp;随机表情;<br>[语录]&nbsp;&nbsp;随机语录;<br>[时间]&nbsp;&nbsp;当前时间; </p></div>
								</div>
								<div class="form-group">
									<label class="col-xs-8 "></label>
									<div class=="col-xs-4"><input type="submit" name="submit" value="保存配置" class="btn btn-primary"></div>
								</div>
							</form>
						</div>
					</div>
				</div>

				<div class="col-xs-12 col-md-12 <?php if($_GET['xz'] != 'del'){echo'collapse-md';}?>">
					<a name="del"></a>
					<div class="panel panel-default">
						<div class="panel-heading" data-toggle="collapse" href="#collapsedel">
							<h3 class="panel-title">删除说说【<?=getzt($qqrow[isdel])?>】</h3>
						</div>
						<div id="collapsedel" class="panel-body <?php if($_GET['xz'] != 'del'){echo'collapse-xs';}?>">
							<form action="?qid=<?=$qid?>&xz=del#del" class="form-horizontal" method="post">
								<input type="hidden" name="do" value="del">
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">选择</label>
									
									<div class="col-sm-9">
										<p>
											<label class="radio-inline">
												<input type="radio" name="is" value="0" checked="">
												关闭(推荐)
											</label>
											<label class="radio-inline">
												<input type="radio" name="is" value="1" <?php if($qqrow[isdel]==1) echo 'checked=""';?>>
												<font color="green">触屏版</font>
											</label>
											<label class="radio-inline">
												<input type="radio" name="is" value="2" <?php if($qqrow[isdel]==2) echo 'checked=""';?>>
												<font color="green">P&nbsp;C版</font>
											</label>
										</p>
									</div>
								</div>
								<div class="form-group">
									<label class="col-xs-8 "></label>
									<div class=="col-xs-4"><input type="submit" name="submit" value="保存配置" class="btn btn-primary"></div>
								</div>
							</form>
						</div>
					</div>
				</div>
				
				<?php
				/************************************************以下内容展示隐藏
				<div class="col-xs-12 col-md-4">
					<a name="vipqd"></a>
					<div class="panel panel-default">
						<div class="panel-heading" data-toggle="collapse" href="#collapsevipqd">
							<h3 class="panel-title">会员签到【<?=getzt($qqrow[isvipqd])?>】</h3>
						</div>
						<div id="collapsevipqd" class="panel-body <?php if($_GET['xz'] != 'vipqd'){echo'collapse-xs';}?>">
							<form action="?qid=<?=$qid?>&xz=vipqd#vipqd" class="form-horizontal" method="post">
								<input type="hidden" name="do" value="vipqd">
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">选择</label>
									
									<div class="col-sm-9">
										<p>
											<label class="radio-inline">
												<input type="radio" name="is" value="0" checked="">
												关闭(推荐)
											</label>
											<label class="radio-inline">
												<input type="radio" name="is" value="1" <?php if($qqrow[isvipqd]==1) echo 'checked=""';?>>
												<font color="green">触屏版</font>
											</label>
											<label class="radio-inline">
												<input type="radio" name="is" value="2" <?php if($qqrow[isvipqd]==2) echo 'checked=""';?>>
												<font color="green">P&nbsp;C版</font>
											</label>
										</p>
									</div>
								</div>
								<div class="form-group">
									<label class="col-xs-8 "></label>
									<div class=="col-xs-4"><input type="submit" name="submit" value="保存配置" class="btn btn-primary"></div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-md-4">
					<a name="ly"></a>
					<div class="panel panel-default">
						<div class="panel-heading" data-toggle="collapse" href="#collapsely">
							<h3 class="panel-title">互刷留言【<?=getzt($qqrow[isly])?>】</h3>
						</div>
						<div id="collapsely" class="panel-body <?php if($_GET['xz'] != 'ly'){echo'collapse-xs';}?>">
							<form action="?qid=<?=$qid?>&xz=ly#ly" class="form-horizontal" method="post">
								<input type="hidden" name="do" value="ly">
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">选择</label>
									
									<div class="col-sm-9">
										<p>
											<label class="radio-inline">
												<input type="radio" name="is" value="0" checked="">
												关闭(推荐)
											</label>
											<label class="radio-inline">
												<input type="radio" name="is" value="1" <?php if($qqrow[isly]==1) echo 'checked=""';?>>
												<font color="green">触屏版</font>
											</label>
											<label class="radio-inline">
												<input type="radio" name="is" value="2" <?php if($qqrow[isly]==2) echo 'checked=""';?>>
												<font color="green">P&nbsp;C版</font>
											</label>
										</p>
									</div>
								</div>
								<div class="form-group">
									<label class="col-xs-8 "></label>
									<div class=="col-xs-4"><input type="submit" name="submit" value="保存配置" class="btn btn-primary"></div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-md-4">
					<a name="zyzan"></a>
					<div class="panel panel-default">
						<div class="panel-heading" data-toggle="collapse" href="#collapsezyzan">
							<h3 class="panel-title">互赞主页【<?=getzt($qqrow[iszyzan])?>】</h3>
						</div>
						<div id="collapsezyzan" class="panel-body <?php if($_GET['xz'] != 'zyzan'){echo'collapse-xs';}?>">
							<form action="?qid=<?=$qid?>&xz=zyzan#zyzan" class="form-horizontal" method="post">
								<input type="hidden" name="do" value="zyzan">
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">选择</label>
									
									<div class="col-sm-9">
										<p>
											<label class="radio-inline">
												<input type="radio" name="is" value="0" checked="">
												关闭(推荐)
											</label>
											<label class="radio-inline">
												<input type="radio" name="is" value="1" <?php if($qqrow[iszyzan]==1) echo 'checked=""';?>>
												<font color="green">触屏版</font>
											</label>
											<label class="radio-inline">
												<input type="radio" name="is" value="2" <?php if($qqrow[iszyzan]==2) echo 'checked=""';?>>
												<font color="green">P&nbsp;C版</font>
											</label>
										</p>
									</div>
								</div>
								<div class="form-group">
									<label class="col-xs-8 "></label>
									<div class=="col-xs-4"><input type="submit" name="submit" value="保存配置" class="btn btn-primary"></div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-md-4">
					<a name="ts"></a>
					<div class="panel panel-default">
						<div class="panel-heading" data-toggle="collapse" href="#collapsets">
							<h3 class="panel-title">图书签到【<?=getzt($qqrow[ists])?>】</h3>
						</div>
						<div id="collapsets" class="panel-body <?php if($_GET['xz'] != 'ts'){echo'collapse-xs';}?>">
							<form action="?qid=<?=$qid?>&xz=ts#ts" class="form-horizontal" method="post">
								<input type="hidden" name="do" value="ts">
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">选择</label>
									
									<div class="col-sm-9">
										<p>
											<label class="radio-inline">
												<input type="radio" name="is" value="0" checked="">
												关闭(推荐)
											</label>
											<label class="radio-inline">
												<input type="radio" name="is" value="1" <?php if($qqrow[ists]==1) echo 'checked=""';?>>
												<font color="green">触屏版</font>
											</label>
											<label class="radio-inline">
												<input type="radio" name="is" value="2" <?php if($qqrow[ists]==2) echo 'checked=""';?>>
												<font color="green">P&nbsp;C版</font>
											</label>
										</p>
									</div>
								</div>
								<div class="form-group">
									<label class="col-xs-8 "></label>
									<div class=="col-xs-4"><input type="submit" name="submit" value="保存配置" class="btn btn-primary"></div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-md-4">
					<a name="3gqq"></a>
					<div class="panel panel-default">
						<div class="panel-heading" data-toggle="collapse" href="#collapse3gqq">
							<h3 class="panel-title">离线挂扣【<?=getzt($qqrow[is3gqq])?>】</h3>
						</div>
						<div id="collapse3gqq" class="panel-body <?php if($_GET['xz'] != '3gqq'){echo'collapse-xs';}?>">
							<form action="?qid=<?=$qid?>&xz=3gqq#3gqq" class="form-horizontal" method="post">
								<input type="hidden" name="do" value="3gqq">
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">选择</label>
									
									<div class="col-sm-9">
										<p>
											<label class="radio-inline">
												<input type="radio" name="is" value="0" checked="">
												关闭(推荐)
											</label>
											<label class="radio-inline">
												<input type="radio" name="is" value="1" <?php if($qqrow[is3gqq]==1) echo 'checked=""';?>>
												<font color="green">触屏版</font>
											</label>
											<label class="radio-inline">
												<input type="radio" name="is" value="2" <?php if($qqrow[is3gqq]==2) echo 'checked=""';?>>
												<font color="green">P&nbsp;C版</font>
											</label>
										</p>
									</div>
								</div>
								<div class="form-group">
									<label class="col-xs-8 "></label>
									<div class=="col-xs-4"><input type="submit" name="submit" value="保存配置" class="btn btn-primary"></div>
								</div>
							</form>
						</div>
					</div>
				</div>
				**************************************************************/
				?>
			</div>			  
            </div>
           
            
          </div>
		
			
			
		
<?php
include_once 'common.foot.php';
?>