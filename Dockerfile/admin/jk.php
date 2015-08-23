<?php
require_once('common.php');
//************************执行代码开始*************************

//************************执行代码结束**************************

C('webtitle','监控说明');
C('pageid','admincron');
include_once 'common.head.php';
?>

		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<form action="?" class="navbar-right" method="GET">
				<input type="hidden" name="do" value="search">
				<input type="text" name='s' class="navbar-right" placeholder="Search...">
				<input type="submit" class="navbar-right" value="搜素">
			</form>
			<h3 class="page-header">监控列表</h3>
			<div class="table-responsive">
				<table class="table table-striped">
				<thead>
				
				<tr>
					<th width="343">赞、评、转发[1分钟]</th>
			      </tr>
				  
				  <?php for($i=1;$i<=C('zannet');$i++){?>
				<tr>
				  <th>http://<?=$_SERVER['HTTP_HOST']?>/cron/new.cron.php?cron=<?=C('cronrand')?>&n=<?=$i?></th>
				  </tr>
				  <?php }?>
				<tr>
				  <th>发说说监控[1分钟]</th>
				  </tr>
				<tr>
				  <th>http://<?=$_SERVER['HTTP_HOST']?>/cron/shuo.cron.php?cron=<?=C('cronrand')?>&amp;n=1</th>
				  </tr>
				<tr>
				  <th>挂扣监控[1分钟]</th>
				  </tr>
				<tr>
				  <th>http://<?=$_SERVER['HTTP_HOST']?>/cron/3gqq.cron.php?cron=<?=C('cronrand')?>&amp;n=1</th>
				  </tr>
				<tr>
				  <th>互刷留言监控[5分钟]</th>
				  </tr>
				<tr>
				  <th>http://<?=$_SERVER['HTTP_HOST']?>/cron/ly.cron.php?cron=<?=C('cronrand')?>&amp;n=1</th>
				  </tr>
				<tr>
				  <th>删说说监控[15分钟]</th>
				  </tr>
				<tr>
				  <th>http://<?=$_SERVER['HTTP_HOST']?>/cron/del.cron.php?cron= <?=C('cronrand')?>&amp;n=1</th>
				  </tr>
				<tr>
				  <th>空间签到监控[15分钟]</th>
				  </tr>
				<tr>
				  <th>http://<?=$_SERVER['HTTP_HOST']?>/cron/qd.cron.php?cron=<?=C('cronrand')?>&amp;n=1</th>
				  </tr>
				<tr>
				  <th>会员签到监控[15分钟]</th>
				  </tr>
				<tr>
				  <th>http://<?=$_SERVER['HTTP_HOST']?>/cron/vipqd.cron.php?cron= <?=C('cronrand')?>&amp;n=1</th>
				  </tr>
				<tr>
				  <th>互赞主页监控[15分钟]</th>
				  </tr>
				<tr>
				  <th>http://
				    <?=$_SERVER['HTTP_HOST']?>/cron/zyzan.cron.php?cron=<?=C('cronrand')?>&amp;n=1</th>
				  </tr>
				<tr>
				  <th>图书签到监控[15分钟]</th>
				  </tr>
				<tr>
				  <th>http://<?=$_SERVER['HTTP_HOST']?>/cron/ts.cron.php?cron=<?=C('cronrand')?>&amp;n=1</th>
				  </tr>
				<tr>
				  <th>花藤服务监控[15分钟]</th>
				  </tr>
				<tr>
				  <th>http://<?=$_SERVER['HTTP_HOST']?>/cron/ht.cron.php?cron=<?=C('cronrand')?>&amp;n=1</th>
				  </tr>
				<tr>
				  <th>互刷礼物监控[15分钟]</th>
				  </tr>
				<tr>
				  <th>http://<?=$_SERVER['HTTP_HOST']?>/cron/lw.cron.php?cron=<?=C('cronrand')?>&amp;n=1</th>
				  </tr>
				<tr>
				  <th>绿钻签到监控[15分钟]</th>
				  </tr>
				<tr>
				  <th>http://
				    <?=$_SERVER['HTTP_HOST']?>/cron/lq.cron.php?cron=<?=C('cronrand')?>&amp;n=1</th>
				  </tr>
				</thead>
				<tbody>
				
				</tbody>
				</table>
			</div>
		</div
><?php
include_once 'common.foot.php';
?>