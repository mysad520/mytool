<?php
require_once('common.php');
//************************执行代码开始*************************
$qid=is_numeric($_GET['qid'])?$_GET['qid']:'0';
if($_GET['do']=='del'){
	$db->query("delete from ".C('DB_PREFIX')."qqs where qid='$qid'");
	echo "<script language='javascript'>alert('删除成功！');</script>";
}

$p=is_numeric($_GET['p'])?$_GET['p']:'1';
$pp=$p+8;
$pagesize=10;
$start=($p-1)*$pagesize;
$pages=ceil(get_count('qqs','1=1','qid')/$pagesize);
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
function getkq($row){
	$str='';
	if($row[iszan]==2) $str.="赞[P],";
	if($row[iszan]==1) $str.="赞[C],";
	if($row[isreply]==2) $str.="评[P],";
	if($row[isreply]==1) $str.="评[C],";
	if($row[iszf]==2) $str.="转[P],";
	if($row[iszf]==1) $str.="转[C],";
	if($row[isshuo]==2) $str.="说[P],";
	if($row[isshuo]==1) $str.="说[C],";
	if($row[isqd]==2) $str.="签[P],";
	if($row[isqd]==1) $str.="签[C],";
	if($row[isdel]) $str.="删,";
	if($row[isvipqd]) $str.="会签,";
	if($row[ists]) $str.="图签,";
	if($row[isht]) $str.="花藤,";
	if($row[isly]) $str.="留言,";
	if($row[iszyzan]) $str.="主页赞,";
	if($row[is3gqq]) $str.="挂扣,";
	return rtrim($str,',');
}
$qqs=$db->get_results("select * from ".C('DB_PREFIX')."qqs order by qid desc limit $start,$pagesize");
//************************执行代码结束**************************

C('webtitle','QQ列表');
C('pageid','adminqq');
include_once 'common.head.php';
?>

		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<h3 class="page-header">QQ列表</h3>
			<div class="table-responsive">
				<table class="table table-striped">
				<thead>
				<tr>
					<th>#QID</th>
					<th>QQ</th>
					<th>SID/SKEY</th>
					<th>所属用户</th>
					<th>添加时间</th>
					<th>开启功能</th>
					<th>操作</th>
				</tr>
				</thead>
				<tbody>
				<?php if($qqs){foreach($qqs as $qq){?>
				<tr>
					<td><?=$qq[qid]?></td>
					<td><?=$qq[qq]?></td>
					<td><?php if($qq[sidzt]){echo"<font color='red'>失效</font>";}else{echo"<font color='green'>正常</font>";}?>/<?php if($qq[skeyzt]){echo"<font color='red'>失效</font>";}else{echo"<font color='green'>正常</font>";}?></td>
					<td>UID:<?=$qq[uid]?></td>
					<td><?=$qq[addtime]?></td>
					<td><?=getkq($qq)?></td>
					<td><a href="?do=del&p=<?=$p?>&qid=<?=$qq[qid]?>" class="btn btn-danger" onClick="if(!confirm('确认删除？')){return false;}">删除</a>&nbsp;</td>
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