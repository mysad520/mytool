<?php
require_once('common.php');
//************************执行代码开始*************************

$uid=is_numeric($_GET['uid'])?$_GET['uid']:'0';
if($_GET['do']=='del'){
	$db->query("delete from ".C('DB_PREFIX')."users where uid='$uid'");
	echo "<script language='javascript'>alert('删除成功！');</script>";
}elseif($_GET['do']=='daili'){
	if($uid && $row=$db->get_row("select daili from ".C('DB_PREFIX')."users where uid='$uid'")){
		if($row['daili']){
			$db->query("update ".C('DB_PREFIX')."users set daili=0 where uid='{$uid}'");
			echo "<script language='javascript'>alert('取消代理成功！');</script>";
		}else{
			$db->query("update ".C('DB_PREFIX')."users set daili=1 where uid='{$uid}'");
			echo "<script language='javascript'>alert('设为代理成功！');</script>";
		}
	}
}elseif($_GET['do']=='fuzhan'){
	if($uid && $row=$db->get_row("select fuzhan from ".C('DB_PREFIX')."users where uid='$uid'")){
		if($row['fuzhan']){
			$db->query("update ".C('DB_PREFIX')."users set fuzhan=0 where uid='{$uid}'");
			echo "<script language='javascript'>alert('取消副站长成功！');</script>";
		}else{
			$db->query("update ".C('DB_PREFIX')."users set fuzhan=1 where uid='{$uid}'");
			echo "<script language='javascript'>alert('设为副站长成功！');</script>";
		}
	}
}

$p=is_numeric($_GET['p'])?$_GET['p']:'1';
$pp=$p+8;
$pagesize=10;
$start=($p-1)*$pagesize;

if($_GET['do']=='search' && $s=safestr($_GET['s'])){
	$pagedo='seach';
	$users=$db->get_results("select * from ".C('DB_PREFIX')."users where uid='{$s}' or user like'%{$s}%' or mail like'%{$s}%' or phone like'%{$s}%' order by (case when uid='{$s}' then 8 else 0 end)+(case when user like '%{$s}%' then 3 else 0 end)+(case when mail like '%{$s}%' then 2 else 0 end)+(case when phone like '%{$s}%' then 1 else 0 end) desc limit 20");
}else{
	$pages=ceil(get_count('users','1=1','uid')/$pagesize);
	$users=$db->get_results("select * from ".C('DB_PREFIX')."users order by uid desc limit $start,$pagesize");
}
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
//************************执行代码结束**************************

C('webtitle','用户列表');
C('pageid','adminuser');
include_once 'common.head.php';
?>

		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<form action="?" class="navbar-right" method="GET">
				<input type="hidden" name="do" value="search">
				<input type="text" name='s' class="navbar-right" placeholder="Search...">
				<input type="submit" class="navbar-right" value="搜素">
			</form>
			<h3 class="page-header">用户列表</h3>
			<div class="table-responsive">
				<table class="table table-striped">
				<thead>
				<tr>
					<th>#UID</th>
					<th>用户名</th>
					<th>是否代理</th>
					<th>是否副站长</th>
					<th>余额</th>
					<th>VIP信息</th>
					<th>配额</th>
					<th>邮箱</th>
					<th>手机</th>
					<th>注册时间</th>
					<th>注册IP</th>
					<th>最后登录</th>
					<th>操作</th>
				</tr>
				</thead>
				<tbody>
				<?php if($users){foreach($users as $user){?>
				<tr>
					<td><?=$user[uid]?></td>
					<td><?=$user[user]?></td>
					<td><a href="?do=daili&p=<?=$p?>&uid=<?=$user[uid]?>" onClick="if(!confirm('确认更改？')){return false;}" class="btn <?php if($user[daili]){echo'btn-danger';}else{echo'btn-success';}?>"><?php if($user[daili]){echo'取消';}else{echo'设为';}?></a></td>
					<td><a href="?do=fuzhan&p=<?=$p?>&uid=<?=$user[uid]?>" onClick="if(!confirm('确认更改？')){return false;}" class="btn <?php if($user[fuzhan]){echo'btn-danger';}else{echo'btn-success';}?>"><?php if($user[fuzhan]){echo'取消';}else{echo'设为';}?></a></td>
					<td><button class="btn btn-default" style="width:60px;"><?=$user[rmb]?></button><a href="uset.php?xz=re&uid=<?=$user[uid]?>" class="btn btn-success">充值</a></td>
					<td><?php if(get_isvip($user[vip],$user[vipend])){ echo "<font color='green'>{$user[vipend]}</font>";}else{echo"<font color='gray'>不是VIP</font>";}?></td>
					<td><font color="green" size=4><?=get_count('qqs',"uid='$user[uid]'",'qid')?></font>/<?=$user[peie]?></td>
					<td><?=$user[mail]?></td>
					<td><?=$user[phone]?></td>
					<td><?=$user[regtime]?></td>
					<td><?=$user[regip]?>[<?=$user['city']?>]</td>
					<td><?=$user[lasttime]?></td>
					<td><a href="?do=del&p=<?=$p?>&uid=<?=$user[uid]?>" class="btn btn-danger" onClick="if(!confirm('确认删除？')){return false;}">删除</a>&nbsp;<a href="uset.php?xz=update&uid=<?=$user[uid]?>" class="btn btn-success">修改</a></td>
				</tr>
				<?php }}?>
				</tbody>
				</table>
			</div>
			<? if($pagedo!='seach'){?>
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
			<?php }?>
		</div
<?php
include_once 'common.foot.php';
?>