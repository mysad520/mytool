<?php
require_once('common.php');
//************************执行代码开始*************************
if($do=$_POST['do']){
	if($do=='update'){
		$phone=safestr($_POST['phone']);
		$set="phone='{$phone}'";
		if($_POST['pwd']){
			$pwd=md5(md5($_POST['pwd']).md5('815856515'));
			$set.=",pwd='{$pwd}'";
		}
		if($db->get_row("select * from ".C('DB_PREFIX')."users where phone='{$phone}' and uid!='{$userrow['uid']}' limit 1")){
			echo"<script language='javascript'>alert('手机号已存在！');</script>";
		}else{
			$db->query("update ".C('DB_PREFIX')."users set {$set} where uid='{$userrow['uid']}'");
			echo"<script language='javascript'>alert('修改成功');</script>";
		}
	}
	$userrow=$db->get_row("select * from ".C('DB_PREFIX')."users where uid='{$userrow['uid']}' limit 1");
}


//**************************执行代码开始*******************************

C('webtitle','添加挂机');
C('pageid','add');
include_once 'common.head.php';
?>
<script src="/public/js/qqlogin.js"></script>
<script type="text/javascript">
var xiha={
	postData: function(url, parameter, callback, dataType, ajaxType) {
		if(!dataType) dataType='JSON';
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
function login(uin,p,vcode,pt_verifysession){
	$('#load').html('正在登陆，请稍等...');
	var pwd=$('#pwd').val();
	var loginurl="/qqlogin.php?do=qqlogin";
	xiha.postData(loginurl,"uin="+uin+"&pwd="+encodeURIComponent(pwd)+"&p="+p+"&vcode="+vcode+"&pt_verifysession="+pt_verifysession+"&r="+Math.random(1), function(d) {
		if(d.saveOK ==0){
			$('#load').html('SID获取成功，请稍等...');
			save(d.uin,d.sid,d.skey);
		}else if(d.saveOK ==4){
			$('#load').html('验证码错误，请重新登录。');
			$('#submit').attr('do','submit');
			$('.code').hide();
		}else if(d.saveOK ==3){
			$('#load').html('您输入的帐号或密码不正确，请重新输入密码！');
			$('#submit').attr('do','submit');
			$('.code').hide();
		}else{
			alert(d.msg);
			$('#submit').attr('do','submit');
		}
	});
	
}
function save(uin,sid,skey){
	$('#load').html('正在存入数据库，请稍等...');
	var loginurl="ajax.php?do=save";
	var pwd=$('#pwd').val();
	xiha.postData(loginurl,"uin="+uin+"&sid="+sid+"&skey="+skey+"&pwd="+encodeURIComponent(pwd), function(d) {
		if(d.saveOK ==0){
			$('#load').html(d.msg);
		}else{
			alert(d.msg);
		}
	});
}
function getvc(uin,sig){
	$('#load').html('获取验证码，请稍等...');
	var getvcurl="/qqlogin.php?do=getvc";
	xiha.postData(getvcurl,'uin='+uin+'&sig='+sig+'&r='+Math.random(1), function(d) {
		if(d.saveOK ==0){
			$('#load').html('请输入验证码');
			$('#codeimg').attr('vc',d.vc);
			$('#codeimg').html('<img onclick="getvc(\''+uin+'\',\''+d.vc+'\')" src="/qqlogin.php?do=getvcpic&uin='+uin+'&sig='+d.vc+'&r='+Math.random(1)+'">');
			$('#submit').attr('do','code');
			$('.code').show();
		}else{
			alert(d.msg);
		}
	});

}
function dovc(uin,code,vc){
	$('#load').html('验证验证码，请稍等...');
	var getvcurl="/qqlogin.php?do=dovc";
	xiha.postData(getvcurl,'uin='+uin+'&ans='+code+'&sig='+vc+'&r='+Math.random(1), function(d) {
		if(d.rcode ==0){
			var pwd=$('#pwd').val();
			p=getmd5(uin,pwd,d.randstr.toUpperCase());
			login(uin,p,d.randstr.toUpperCase(),d.sig);
			
		}else{
			$('#load').html('验证码错误，重新生成验证码，请稍等...');
			getvc(uin,vc);
		}
	});

}
$(document).ready(function(){
	$('#submit').click(function(){
		var self=$(this);
		$('#load').html('登录中，请稍候...');
		var uin=$('#uin').val(),
			pwd=$('#pwd').val();
		if(self.attr('do') == 'code'){
			var vcode=$('#code').val(),
				vc=$('#codeimg').attr('vc');
			dovc(uin,vcode,vc);
		}else if(self.attr('do') == 'update'){
			var sid=$('#sid').val(),
				skey=$('#skey').val();
			window.location.href="{:U('qqset')}?qid={$Think.get.qid}&do=&sid="+sid+"&skey="+skey;
		}else{
		if (self.attr("data-lock") === "true") return;
			else self.attr("data-lock", "true");
		var checkvcurl="/qqlogin.php?do=checkvc";
		xiha.postData(checkvcurl,'uin='+uin+'&r='+Math.random(1), function(d) {
			if(d.saveOK ==0){
				var strs= new Array(); //定义一数组
				strs=d.data.split(",");
				if(strs[0]==0){
					pt_verifysession=strs[3];
					p=getmd5(uin,pwd,strs[2]);
					login(strs[1],p,strs[2],pt_verifysession);
				}else{
					getvc(uin,strs[2]);
				}
			}else{
				alert(d.msg);
				$('#load').html('');
			}
			self.attr("data-lock", "false");
		});
		}
	});
});
</script>
		
			<div class="templatemo-content-container">
          <div class="templatemo-flex-row flex-content-row">
            <div class="templatemo-content-widget white-bg col-2">
              <i class="fa fa-times"></i>
              <div class="square"></div>
              <h2 class="templatemo-inline-block">添加挂机</h2><hr>            
            </div>
           
            
          </div>
			<div class="table-responsive">
				<div class="col-xs-12 col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading" data-toggle="collapse" href="#collapseshop">
							<h3 class="panel-title">添加QQ</h3>
						</div>
						<div id="collapseshop" class="panel-body">
							<form action="#" class="form-horizontal" method="post">
								<input type="hidden" name="do" value="update">
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">QQ</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" id="uin" placeholder="QQ号码" value="<?=$_GET['uin']?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="field-2">密码</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" id="pwd" placeholder="QQ密码">
									</div>
								</div>
								<div class="form-group code" style="display: none;">
									<label class="col-sm-3 control-label" for="field-2">验证码</label>
									<div class="col-sm-3">
										<span id="codeimg"></span>
									</div>
									<div class="col-sm-6">
										<input type="text" class="form-control" id="code" placeholder="输入验证码">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-9 control-label" for="field-2" id="load" style="font-weight: bold;color: #CF2525;"></label>
								</div>
								<div class="form-group">
									<label class="col-xs-8 "></label>
									<div class=="col-xs-4"><input type="button" id="submit" value="确认添加" class="btn btn-primary"></div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		
<?php
include_once 'common.foot.php';
?>