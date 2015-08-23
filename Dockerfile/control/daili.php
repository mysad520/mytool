<?php
require_once('common.php');
//************************执行代码开始*************************
function getkm($len=12){
	$str ='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
	$strlen = strlen($str);
	$randstr = '';
	for ($i = 0; $i<$len; $i++){
		$randstr .= $str[mt_rand(0, $strlen-1)];
	}
	return $randstr;
}

if($_GET['do']=='del'){
	$kid=is_numeric($_GET['kid'])?$_GET['kid']:'0';
	if($kid && $row=$db->get_row("select * from ".C('DB_PREFIX')."kms where kid='{$kid}' and daili='{$userrow[uid]}' limit 1")){
		if($db->query("delete from ".C('DB_PREFIX')."kms where kid='{$kid}' and daili='{$userrow[uid]}'")){
		if($row[isuse]==0 and $row[ms]>0){
			$db->query("delete from ".C('DB_PREFIX')."qqs where qid='$qid'");
			$db->query("update ".C('DB_PREFIX')."users set rmb=rmb+{$row[ms]} where uid='{$userrow[uid]}'");
			$userrow[rmb]=$userrow[rmb]+$row[ms];
			echo"<script language='javascript'>alert('删除卡密成功！，由于该卡密没有使用，余额{$row[ms]}元已退回至你的账户中！');</script>";
		}else{
			echo"<script language='javascript'>alert('删除卡密成功！');</script>";
		}
		}else{
			echo"<script language='javascript'>alert('删除卡密失败！');</script>";
		}
	}else{
		echo"<script language='javascript'>alert('要删除的卡密不存在！');</script>";
	}
}
if($_POST['do']=='add'){
	$num=is_numeric($_POST['num'])?$_POST['num']:'1';
	$rmb=is_numeric($_POST['rmb'])?$_POST['rmb']:'1';
	if($num>20) exit("<script language='javascript'>alert('一次性最多生成20个！');history.go(-1);</script>");
	if($rmb>100) exit("<script language='javascript'>alert('卡密最大面额为100元！');history.go(-1);</script>");
	$now = date("Y-m-d H:i:s");
	for($i=0;$i<$num;$i++){
		$km=getkm();
		$nrmb=$userrow['rmb']-$rmb;
		if($userrow[rmb]>0 && $nrmb>=0){
			if($db->query("insert into  ".C('DB_PREFIX')."kms (kind,daili,km,ms,isuse,uid,addtime) values (0,'$userrow[uid]','$km','$rmb',0,0,'$now')")){
				$db->query("update ".C('DB_PREFIX')."users set rmb=rmb-{$rmb} where uid='{$userrow[uid]}'");
				$userrow['rmb']=$nrmb;
				$kmmsg.="<li class='list-group-item'>{$km}</li>";
			}
		}else{
			$kmmsg.="<li class='list-group-item' style='color:red;'>账户余额不足！</li>";
		}
	}
}



$p=is_numeric($_GET['p'])?$_GET['p']:'1';
$pp=$p+8;
$pagesize=10;
$start=($p-1)*$pagesize;
$pages=ceil(get_count('kms',"daili='$userrow[uid]'",'kid')/$pagesize);
if(!$pages) $pages=1;
if($pp>$pages) $pp=$pages;
if($p==1){
	$prev=1;
}else{
	$prev=$p-1;
}
if($p==$pages){
	$next=$p;
}else{
	$next=$p+1;
}
$rows=$db->get_results("select * from ".C('DB_PREFIX')."kms where daili='$userrow[uid]' order by kid desc limit $start,$pagesize");
//************************执行代码结束**************************

C('webtitle','代理后台');
C('pageid','adminqq');
include_once 'common.head.php';
?>

		<div class="col-sm-12 col-sm-offset-10 col-md-10 col-md-offset-2 main">
			<h3 class="page-header">卡密生成</h3>
			<div class="table-responsive">
				<div class="col-xs-12 col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">卡密在线生成</h3>
						</div>
						<div id="collapseshop" class="panel-body">
							<form action="?" class="form-horizontal" method="post">
								<input type="hidden" name="do" value="add">
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">当前余额</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" placeholder="<?=$userrow[rmb]?>" readonly>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">生成个数</label>
									<div class="col-sm-9">
										<input class="form-control" name="num" type="text" value="1">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">卡密余额</label>
									<div class="col-sm-9">
										<input class="form-control" name="rmb" type="text" value="1">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-xs-8 "></label>
									<div class=="col-xs-4"><input type="submit" name="submit" value="确认生成" class="btn btn-primary"></div>
								</div>
							</form>
						</div>
					</div>
					<?php if($kmmsg){?>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">成功生成以下卡密</h3>
						</div>
						<div id="collapseshop" class="panel-body"><ul>
							<?=$kmmsg?>
						</ul></div>
					</div>
					<?php }?>
				</div>
			</div>
			<h3 class="page-header">卡密列表</h3>
			<div class="table-responsive">
				<table class="table table-striped">
				<thead>
				<tr>
					<th>#KID</th>
					<th>卡密</th>
					<th>余额</th>
					<th>生成时间</th>
					<th>是否使用</th>
					<th>使用者UID</th>
					<th>使用时间</th>
					<th>操作</th>
				</tr>
				</thead>
				<tbody>
				<?php if($rows){foreach($rows as $km){?>
				<tr>
					<td><?=$km[kid]?></td>
					<td><?=$km[km]?></td>
					<td><?=$km[ms]?></td>
					<td><?=$km[addtime]?></td>
					<td><?php if($km[isuse]){echo'<font color="red">已使用</font>';}else{echo'<font color="green">未使用</font>';}?></td>
					<td><?=$km[uid]?></td>
					<td><?=$km[usetime]?></td>
					<td><a href="?do=del&p=<?=$p?>&kid=<?=$km[kid]?>" class="btn btn-danger" onClick="if(!confirm('确认删除？')){return false;}">删除</a>&nbsp;</td>
				</tr>
				<?php }}?>
				</tbody>
				</table>
			</div>
			<div class="row" style="text-align:center;">
				<ul class="pagination pagination-lg">
					<li <?php if($p==1){echo'class="disabled"';}?>><a href="?p=1">首页</a></li>
					<li <?php if($prev==$p){echo'class="disabled"';}?>><a href="?p=<?=$prev?>">&laquo;</a></li>
					<?php for($i=$p;$i<=$pp;$i++){?>
					<li <?php if($i==$p){echo'class="active"';}?>><a href="?p=<?=$i?>"><?=$i?></a></li>
					<?php }?>
					<li <?php if($next==$p){echo'class="disabled"';}?>><a href="?p=<?=$next?>">&raquo;</a></li>
					<li <?php if($p==$pages){echo'class="disabled"';}?>><a href="?p=<?=$pages?>">末页</a></li>
				</ul>
			</div>
		</div
<?php
include_once 'common.foot.php';
?>