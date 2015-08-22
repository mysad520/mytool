<?php
session_start();
require_once('common.php');
//************************执行代码开始*************************
$qid=is_numeric($_GET['qid'])?$_GET['qid']:'0';
if(!$qid || !$qqrow=$db->get_row("select * from ".C('DB_PREFIX')."qqs where qid='$qid' and uid='$userrow[uid]' limit 1")){
	exit("<script language='javascript'>alert('QQ不存在！');window.location.href='/control';</script>");
}
$url="http://m.qzone.com/friend/mfriend_list?res_uin={$qqrow[qq]}&res_type=normal&format=json&count_per_page=10&page_index=0&page_type=0&mayknowuin=&qqmailstat=&sid={$qqrow['sid']}";
$json=get_curl($url,0,1);
$arr=json_decode($json,true);
if($arr['code']==-3000){
	exit('<script language=\'javascript\'>alert(\'SID已过期\');history.go(-1);</script>');
}
$dxrow=$_SESSION['klsf_dxrow']["$qqrow[qq]"];
$arr=$arr['data']['list'];


//**************************执行代码开始*******************************

C('webtitle','QQ'.$qqrow['qq'].'单项好友检测');
C('pageid','dxjc');
include_once 'common.head.php';
?>
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
<script>
$(document).ready(function() {
	$('#startcheck').click(function(){
		self=$(this);
		if (self.attr("data-lock") === "true") return;
			else self.attr("data-lock", "true");
		$('#load').html('检测中<img src="/public/img/load.gif" height=25>');
		var url="dx.php";
		xiha.postData(url,'uin=<?=$qqrow['qq']?>&sid=<?=$qqrow['sid']?>', function(d) {
			if(d.code ==0){
				$('#load').html('这一组检测完成，3秒后进行下一组，请稍等！');
				$('#count').html(d.count);
				$('#dxcount').html(d.dxcount);
				if(d.dxrow){
					$.each(d.dxrow, function(i, item){
						$("#content").append('<tr><td>'+item.uin+'</td><td>'+item.nick+'</td><td>'+item.remark+'</td><td align="center"><button class="btn btn-large btn-block qqdel" uin="'+item.uin+'">删除</button></td></tr>'); 
					});  
				}
				if(d.finish==1){
					$('#load').html('好友全部检测完毕！');
				}else{
					 setTimeout(function () {
						$('#startcheck').click()
					 }, 3000);
					//$('#startcheck').click();
				}
			}else{
				alert(d.msg);
			}
		});
		self.attr("data-lock", "false");
	});
	$(document).on("click",".qqdel",function(){
		var checkself=$(this),
			touin=checkself.attr('uin');
		checkself.html('<Iframe src="qqdel.php?uin=<?=$qqrow['qq']?>&skey=<?=$qqrow['skey']?>&touin='+touin+'" width="50px" height="30px" scrolling="no" frameborder="0"></iframe>');
	});
});
var xiha={
	postData: function(url, parameter, callback, dataType, ajaxType) {
		if(!dataType) dataType='json';
		$.ajax({
			type: "POST",
			url: url,
			async: true,
			dataType: dataType,
			json: "callback",
			data: parameter,
			success: function(data) {
				if (callback == null) {
					return;
				} 
				callback(data);
			},
			error: function(error) {
				alert('创建连接失败');
			}
		});
	}
}
</script>
<div class="templatemo-content-container">
          <div class="templatemo-flex-row flex-content-row">
            <div class="templatemo-content-widget white-bg col-2">
              <i class="fa fa-times"></i>
              <div class="square"></div>
              <h2 class="templatemo-inline-block">QQ:<?=$qqrow['qq']?>单项检测</h2><hr>  
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
					<td align="center"><button class="btn btn-block btn-default" id="startcheck">开始检测</button></td>
					<td colspan="3" align="center"><button class="btn btn-block btn-default">总共<?=count($arr)?>个好友,已检测<span id="count"><?=count($_SESSION["o".$qqrow[qq]])?></span>个，单项<span id="dxcount"><?=count($dxrow)?></span>个！</button></td></tr>
				<tr><td colspan="4" align="center"><span style="color:red;text-align: center;font-weight: bold;" id="load">等待检测</span></td></tr>
				<tr><td colspan="4" align="center"><button class="btn btn-block btn-default" style="background-image:url(/css/images/bj.gif);">单项好友列表</button></td></tr>
				<?php
				if($dxrow){
				foreach($dxrow as $k=>$row){
					if(stripos($json,"uin\":".$row[uin])){
					echo"<tr><td>{$row[uin]}</td><td>{$row[nick]}</td><td>{$row[remark]}</td><td uin='{$row[uin]}' class='qqdel' align='center'><button class='btn btn-large btn-block'>删除</button></td></tr>";
					}else{
					unset($_SESSION['klsf_dxrow']["$qqrow[qq]"][$k]);
					}
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