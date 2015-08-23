<?php
require_once('common.php');
C('webtitle','控制台');
C('pageid','control');
include_once 'common.head.php';
?>

		
			
			<div class="col-1">
              <div class="panel panel-default templatemo-content-widget white-bg no-padding templatemo-overflow-hidden">
                <i class="fa fa-times"></i>
                <div class="panel-heading templatemo-position-relative"><h2 class="text-uppercase">我的资料</h2></div>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered">
                    <thead>
				<tr>
					<th>#</th>
					<th>详细</th>
					<th>操作</th>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td>用户名/UID</td>
					<td colspan=2><?=$userrow[user]?>[UID:<?=$userrow[uid]?>]</td>
				</tr>
				<tr>
					<td>挂机配额</td>
					<td><font color="green" size=5><?=get_count('qqs',"uid='$userrow[uid]'",'qid')?></font>/<?=$userrow[peie]?></td>
					<td><a href="shop.php" class="btn btn-primary">增加配额</a></td>
				</tr>
				<tr>
					<td>VIP身份</td>
					<td><?php if(get_isvip($userrow[vip],$userrow[vipend])){ echo "<font color='green'>{$userrow[vipend]}</font>";}else{echo"<font color='gray'>不是VIP</font>";}?></td>
					<td><a href="shop.php" class="btn btn-primary">开通会员</a></td>
				</tr>
				<tr>
					<td>余额</td>
					<td><?=$userrow['rmb']?>元</td>
					<td><a href="rmb.php" class="btn btn-primary">我要充值</a></td>
				</tr>
				<tr>
					<td>绑定邮箱</td>
					<td colspan=2><?=$userrow['mail']?></td>
				</tr>
				<tr>
					<td>手机号</td>
					<td><?=$userrow['phone']?></td>
					<td><a href="uset.php" class="btn btn-primary">资料修改</a></td>
				</tr>
				<tr>
					<td>注册时间</td>
					<td colspan=2><?=$userrow['regtime']?></td>
				</tr>
				<tr>
					<td>上次登录</td>
					<td colspan=2><?=$userrow['lasttime']?></td>
				</tr>
				<tr>
					<td>登录I&nbsp;P</td>
					<td colspan=2><?=$userrow['lastip']?></td>
				</tr>
				</tbody>
				</table>
                </div>                          
              </div>
            </div> 
		
><?php
include_once 'common.foot.php';
?>