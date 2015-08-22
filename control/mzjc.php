<?php
session_start();
require_once('common.php');
//************************执行代码开始*************************
$qid=is_numeric($_GET['qid'])?$_GET['qid']:'0';
if(!$qid || !$qqrow=$db->get_row("select * from ".C('DB_PREFIX')."qqs where qid='$qid' and uid='$userrow[uid]' limit 1")){
	exit("<script language='javascript'>alert('QQ不存在！');window.location.href='/control';</script>");
}
$json=file_get_contents("http://www.arxi.cn/qq/api/mzjc.php?qq={$qqrow[qq]}&sid={$qqrow['sid']}&skey={$qqrow[skey]}");
$arr=json_decode($json,true);
if($arr[code]!=0){
	exit('<script language=\'javascript\'>alert(\''.$arr[msg].'\');history.go(-1);</script>');
}


//**************************执行代码开始*******************************

C('webtitle','QQ'.$qqrow['qq'].'秒赞好友检测');
C('pageid','dxjc');
include_once 'common.head.php';
?>
<div class="templatemo-content-container">
          <div class="templatemo-flex-row flex-content-row">
            <div class="templatemo-content-widget white-bg col-2">
              <i class="fa fa-times"></i>
              <div class="square"></div>
              <h2 class="templatemo-inline-block">QQ:<?=$qqrow['qq']?>秒赞好友检测</h2><hr>     
<div class="table-responsive">
				<table class="table table-striped">
				<thead>
				<tr>
					<tr>
					<th>QQ</th>
					<th>昵称</th>
					<th>备注</th>
					<th>结果</th>
				</tr>
				</thead>
				<tbody id="content">
				<tr>
					<td colspan="4" align="center"><button class="btn btn-block btn-default">总共<?=count($arr['friend'])?>个好友,可能秒赞好友<span id="dxcount"><?=$arr['mzcount']?></span>个！</button></td></tr>
				<?php
				if($arr['friend']){
				foreach($arr['friend'] as $k=>$row){
					echo"<tr><td>{$row['uin']}</td><td>{$row['name']}</td><td>{$row['remark']}</td><td align='center' style='background: rgba(57, 110, 0,";
					echo $row['mz']/5;
					echo");'>";
					echo $row['mz']/5*100;
					echo"%</td></tr>";
				}	
				}	
				?>
				</tbody>
				</table>
			</div>			  
            </div>
           
            
          </div>
		
			
			
		
<?php
include_once 'common.foot.php';
?>