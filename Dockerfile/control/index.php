<?php
require_once('common.php');
C('webtitle','控制台');
C('pageid','control');
include_once 'common.head.php';
?>

       <div class="templatemo-content-container">
          <div class="templatemo-flex-row flex-content-row">
            <div class="templatemo-content-widget white-bg col-2">
              <i class="fa fa-times"></i>
              <div class="square"></div>
              <h2 class="templatemo-inline-block">网站最新公告</h2><hr>
              <p><?=stripslashes(C('web_control_gg'))?></p>              
            </div>
           
            
          </div>
          <div class="templatemo-flex-row flex-content-row">
            <div class="col-1">            
             <div class="templatemo-content-widget white-bg col-1 text-center">
              <i class="fa fa-times"></i>
              <h2 class="text-uppercase">Hello,<?=$userrow[user]?></h2>
              <h3 class="text-uppercase margin-bottom-10"><?php if(get_isvip($userrow[vip],$userrow[vipend])){ echo "<font color='green'>{$userrow[vipend]}</font>";}else{echo"<font color='gray'>普通用户</font>";}?></h3>
              <img src="/style/images/bicycle.jpg" alt="Bicycle" class="img-circle img-thumbnail">
            </div>	
<div class="templatemo-content-widget orange-bg">			
			<?php if($rows=$db->get_results("select * from ".C('DB_PREFIX')."qqs where uid='$userrow[uid]' order by qid desc")){ foreach($rows as $row){?>
				
                <i class="fa fa-times"></i>                
                <div class="media">
                  <div class="media-left">
                    <a href="#">
                      <a href="qqlist.php?qid=<?=$row[qid]?>"><img class="media-object img-circle" src="http://q2.qlogo.cn/headimg_dl?bs=qq&dst_uin=<?=$row[qq]?>&src_uin=<?=$row[qq]?>&fid=<?=$row[qq]?>&spec=100&url_enc=0&referer=bu_interface&term_type=PC" alt="<?=$row[qq]?>"></a>
					                    </a>
                  </div>
                  <div class="media-body">
					<h2 class="media-heading text-uppercase"><?=$row[qq]?></h2>
					<p>SID<?php if($row[sidzt]){echo"<font color='red'>失效</font>";}else{echo"<font color='green'>正常</font>";}?>/SKEY<?php if($row[skeyzt]){echo"<font color='red'>失效</font>";}else{echo"<font color='green'>正常</font>";}?>.</p>
				</div>        
                </div>                
                                 
            
				<?php }}?>    
				</div>
</div>				
            <div class="col-1">
              <div class="panel panel-default templatemo-content-widget white-bg no-padding templatemo-overflow-hidden">
                <i class="fa fa-times"></i>
                <div class="panel-heading templatemo-position-relative"><h2 class="text-uppercase">User Table</h2></div>
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
          </div> <!-- Second row ends -->
<?php
include_once 'common.foot.php';
?>