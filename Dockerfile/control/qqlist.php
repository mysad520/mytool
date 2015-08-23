<?php
require_once('common.php');
//************************执行代码开始*************************
$qid=is_numeric($_GET['qid'])?$_GET['qid']:'0';
if(!$qid || !$qqrow=$db->get_row("select * from ".C('DB_PREFIX')."qqs where qid='$qid' and uid='$userrow[uid]' limit 1")){
	exit("<script language='javascript'>alert('QQ不存在！');window.location.href='/control';</script>");
}
if($_GET['do']=='change'){
	if(!C('webfree') && !get_isvip($userrow[vip],$userrow[vipend])){
		echo"<script language='javascript'>alert('对不起，你不是VIP,无法开启功能！');</script>";
	}else{
		$the=$_GET['the'];
		$is=is_numeric($_GET['is'])?$_GET['is']:'0';
		if($ths=='3gqq' || $ths='ts' || $ths='ht' || $ths='qd' || $ths='vipqd' || $ths='zyzan' || $ths='del' || $ths='ly'){
			$db->query("update ".C('DB_PREFIX')."qqs set is{$the}='$is' where qid='$qid'");
			$qqrow=$db->get_row("select * from ".C('DB_PREFIX')."qqs where qid='$qid' and uid='$userrow[uid]' limit 1");
		}
	}
}elseif($_GET['do']=='del'){
	$db->query("delete from ".C('DB_PREFIX')."qqs where qid='$qid'");
	exit("<script language='javascript'>alert('删除成功！');window.location.href='/control';</script>");
}



//**************************执行代码开始*******************************

C('webtitle','QQ'.$qqrow['qq']);
C('pageid','qqlist');
include_once 'common.head.php';
?>
<div class="templatemo-content-container">
          <div class="templatemo-flex-row flex-content-row">
            <div class="templatemo-content-widget white-bg col-2">
              <i class="fa fa-times"></i>
              <div class="square"></div>
              <h2 class="templatemo-inline-block">QQ:<?=$qqrow['qq']?></h2><hr> 
<div class="table-responsive">
				<table class="table table-striped">
				<thead>
				<tr>
					<th>#QID#<?=$qqrow['qid']?></th>
					<th><a href="http://m.qzone.com/infocenter?sid=<?=$qqrow['sid']?>&g_ut=3&g_f=6676" class="btn btn-block btn-primary">访问空间</a></th>
					<th><a href="?do=del&qid=<?=$qqrow[qid]?>" class="btn btn-block btn-danger" onClick="if(!confirm('确认删除？')){return false;}">删除</a></th>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td rowspan=2><img src="http://q2.qlogo.cn/headimg_dl?bs=qq&dst_uin=<?=$qqrow[qq]?>&src_uin=<?=$qqrow[qq]?>&fid=<?=$qqrow[qq]?>&spec=100&url_enc=0&referer=bu_interface&term_type=PC" class="img-circle img-thumbnail"></td>
					<td align='center'><button class="btn btn-block btn-default">SID&nbsp;&nbsp;&nbsp;<?php if($qqrow['sidzt']){echo'<font color="red">失效</font>';}else{echo'<font color="green">正常</font>';}?>
						<br>SKEY<?php if($qqrow['skeyzt']){echo'<font color="red">失效</font>';}else{echo'<font color="green">正常</font>';}?></button>
					</td>
					<td align='center'><a href="add.php?uin=<?=$qqrow[qq]?>" class="btn btn-block btn-primary">更新</td>
				</tr>
				<tr style="background: #F9F9F9;">
					<td align='center'><a href="/search.php?uin=<?=$qqrow[qq]?>" class="btn btn-block btn-warning">秒赞认证</a></td>
					<td align='center'><a href="qqset.php?qid=<?=$qqrow[qid]?>" class="btn btn-block btn-success">配置</a></td>
				</tr>
				<tr>
					<td align='center'>运行记录</td>
					<td align='center'>功能</td>
					<td align='center'>状态</td>
				</tr>
				<tr>
					<td align='center'><button class="btn btn-block btn-default"><?=zhtime($qqrow['lastzan'])?></button></td>
					<td align='center'><button class="btn btn-block btn-default">说说秒赞</button></td>
					<td align='center'><a href="qqset.php?qid=<?=$qqrow[qid]?>&xz=zan#zan" class="btn btn-block <?=getxz($qqrow[iszan],1)?>"><?=getxz($qqrow[iszan])?></a></td>
				</tr>
				<tr>
					<td align='center'><button class="btn btn-block btn-default"><?=zhtime($qqrow['lastreply'])?></button></td>
					<td align='center'><button class="btn btn-block btn-default">说说秒评</button></td>
					<td ><a href="qqset.php?qid=<?=$qqrow[qid]?>&xz=reply#reply" class="btn btn-block <?=getxz($qqrow[isreply],1)?>"><?=getxz($qqrow[isreply])?></a></td>
				</tr>
				<tr>
					<td align='center'><button class="btn btn-block btn-default"><?=zhtime($qqrow['lastzf'])?></button></td>
					<td align='center'><button class="btn btn-block btn-default">转发说说</button></td>
					<td align='center'><a href="qqset.php?qid=<?=$qqrow[qid]?>&xz=zf#zf" class="btn btn-block <?=getxz($qqrow[iszf],1)?>"><?=getxz($qqrow[iszf])?></a></td>
				</tr>
				<tr>
					<td align='center'><button class="btn btn-block btn-default"><?=zhtime($qqrow['lastshuo'])?></button></td>
					<td align='center'><button class="btn btn-block btn-default">发布说说</button></td>
					<td ><a href="qqset.php?qid=<?=$qqrow[qid]?>&xz=shuo#shuo" class="btn btn-block <?=getxz($qqrow[isshuo],1)?>"><?=getxz($qqrow[isshuo])?></a></td>
				</tr>
				<tr>
					<td align='center'><button class="btn btn-block btn-default"><?=zhtime($qqrow['lastdel'])?></button></td>
					<td align='center'><button class="btn btn-block btn-default">删除说说</button></td>
					<td ><a href="?qid=<?=$qid?>&do=change&the=del&is=<?php if($qqrow['isdel']){echo 0;}else{echo 1;}?>" class="btn btn-block <?=getxz($qqrow[isdel],1)?>"><?=getxz($qqrow[isdel])?></a></td>
				</tr>
				<tr>
					<td align='center'><button class="btn btn-block btn-default"><?=zhtime($qqrow['lastvipqd'])?></button></td>
					<td align='center'><button class="btn btn-block btn-default">会员签到</button></td>
					<td ><a href="?qid=<?=$qid?>&do=change&the=vipqd&is=<?php if($qqrow['isvipqd']){echo 0;}else{echo 2;}?>" class="btn btn-block <?=getxz($qqrow[isvipqd],1)?>"><?=getxz($qqrow[isvipqd])?></a></td>
				</tr>
				<tr>
					<td align='center'><button class="btn btn-block btn-default"><?=zhtime($qqrow['lastly'])?></button></td>
					<td align='center'><button class="btn btn-block btn-default">互刷留言</button></td>
					<td ><a href="?qid=<?=$qid?>&do=change&the=ly&is=<?php if($qqrow['isly']){echo 0;}else{echo 1;}?>" class="btn btn-block <?=getxz($qqrow[isly],1)?>"><?=getxz($qqrow[isly])?></a></td>
				</tr>
				<tr>
					<td align='center'><button class="btn btn-block btn-default"><?=zhtime($qqrow['lastzyzan'])?></button></td>
					<td align='center'><button class="btn btn-block btn-default">互赞主页</button></td>
					<td ><a href="?qid=<?=$qid?>&do=change&the=zyzan&is=<?php if($qqrow['iszyzan']){echo 0;}else{echo 2;}?>" class="btn btn-block <?=getxz($qqrow[iszyzan],1)?>"><?=getxz($qqrow[iszyzan])?></a></td>
				</tr>
				<tr>
					<td align='center'><button class="btn btn-block btn-default"><?=zhtime($qqrow['lastts'])?></button></td>
					<td align='center'><button class="btn btn-block btn-default">图书签到</button></td>
					<td ><a href="?qid=<?=$qid?>&do=change&the=ts&is=<?php if($qqrow['ists']){echo 0;}else{echo 1;}?>" class="btn btn-block <?=getxz($qqrow[ists],1)?>"><?=getxz($qqrow[ists])?></a></td>
				</tr>
				<tr>
					<td align='center'><button class="btn btn-block btn-default"><?=zhtime($qqrow['lastht'])?></button></td>
					<td align='center'><button class="btn btn-block btn-default">花藤服务</button></td>
					<td ><a href="?qid=<?=$qid?>&do=change&the=ht&is=<?php if($qqrow['isht']){echo 0;}else{echo 1;}?>" class="btn btn-block <?=getxz($qqrow[isht],1)?>"><?=getxz($qqrow[isht])?></a></td>
				</tr>
				<tr>
					<td align='center'><button class="btn btn-block btn-default"><?=zhtime($qqrow['lastlw'])?></button></td>
					<td align='center'><button class="btn btn-block btn-default">互刷礼物</button></td>
					<td ><a href="?qid=<?=$qid?>&do=change&the=lw&is=<?php if($qqrow['islw']){echo 0;}else{echo 1;}?>" class="btn btn-block <?=getxz($qqrow[islw],1)?>"><?=getxz($qqrow[islw])?></a></td>
				</tr>
				<tr>
					<td align='center'><button class="btn btn-block btn-default"><?=zhtime($qqrow['lastlq'])?></button></td>
					<td align='center'><button class="btn btn-block btn-default">绿钻签到</button></td>
					<td ><a href="?qid=<?=$qid?>&do=change&the=lq&is=<?php if($qqrow['islq']){echo 0;}else{echo 2;}?>" class="btn btn-block <?=getxz($qqrow[islq],2)?>"><?=getxz($qqrow[islq])?></a></td>
				</tr>
				<tr>
					<td align='center'><button class="btn btn-block btn-default"><?=zhtime($qqrow['lastqb'])?></button></td>
					<td align='center'><button class="btn btn-block btn-default">钱包签到</button></td>
					<td ><a href="?qid=<?=$qid?>&do=change&the=qb&is=<?php if($qqrow['isqb']){echo 0;}else{echo 1;}?>" class="btn btn-block <?=getxz($qqrow[isqb],1)?>"><?=getxz($qqrow[isqb])?></a></td>
				</tr>
				<tr>
					<td align='center'><button class="btn btn-block btn-default"><?=zhtime($qqrow['lastzan'])?></button></td>
					<td align='center'><button class="btn btn-block btn-default">离线挂扣</button></td>
					<td ><a href="?qid=<?=$qid?>&do=change&the=3gqq&is=<?php if($qqrow['is3gqq']){echo 0;}else{echo 1;}?>" class="btn btn-block <?=getxz($qqrow[is3gqq],1)?>"><?=getxz($qqrow[is3gqq])?></a></td>
				</tr>
				<tr><td colspan="3" align='center'>其他辅助</td></tr>
				<tr>
					<td align='center' colspan="3"><a href="dxjc.php?qid=<?=$qqrow[qid]?>" class="btn btn-block btn-default">单项好友检测</a></td>
				</tr>
				<tr>
					<td align='center' colspan="3"><a href="mzjc.php?qid=<?=$qqrow[qid]?>" class="btn btn-block btn-default">秒赞好友检测</a></td>
				</tr>
				<tr>
					<td align='center' colspan="3"><a href="/music.php" class="btn btn-block btn-default">空间音乐查询</a></td>
				</tr>
				<tr>
					<td align='center' colspan="3"><a href="/quanz.php?qq=<?=$qqrow[qq]?>" class="btn btn-block btn-default">一键拉圈圈99+</a></td>
				</tr>
				<tr>
					<td align='center' colspan="3"><a href="/qzyc.php?qq=<?=$qqrow[qq]?>" class="btn btn-block btn-default">空间状态查询</a></td>
				</tr>
				</tbody>
				</table>
			</div>			  
            </div>
           
            
          </div>
			
			
		
<?php
include_once 'common.foot.php';
?>