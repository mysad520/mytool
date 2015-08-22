<?php
function str_post($rows){
	foreach($rows as $k=>$row){
		$data.="$k=".urlencode($row)."&";
	}
	return rtrim($data,'&');
}

function send_active_mail($email,$do='SID',$qq,$config){
	$body="您好。你在".$config['web_name']."[".$config['web_domain']."]"."添加的QQ:{$qq}的{$do}已经过期，为了不影响你的正常使用，尽快到<a href='http://".$config['web_domain']."'>".$config['web_name']."</a>更新你的{$do}!";//邮件内容
	include "phpmailer/class.phpmailer.php";
	include "phpmailer/class.smtp.php";
	$mail             = new PHPMailer(); //PHPMailer对象
    $mail->CharSet    = 'UTF-8'; //设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
    $mail->IsSMTP();  // 设定使用SMTP服务
    $mail->SMTPDebug  = 0;                     // 关闭SMTP调试功能
                                               // 1 = errors and messages
                                               // 2 = messages only
    $mail->SMTPAuth   = true;                  // 启用 SMTP 验证功能
    $mail->SMTPSecure = 'ssl';                 // 使用安全协议
    $mail->Host       = $config['mail_host']?$config['mail_host']:'smtp.qq.com';  // SMTP 服务器
    $mail->Port       = $config['mail_port']?$config['mail_port']:'465';  // SMTP服务器的端口号
    $mail->Username   = $config['mail_email'];  // SMTP服务器用户名
    $mail->Password   = $config['mail_pwd'];  // SMTP服务器密码
    $mail->SetFrom($config['mail_email'], $config['web_name']);
    $mail->Subject    = "秒赞网{$do}过期提醒";
    $mail->MsgHTML($body);
    $mail->AddAddress($email, '快乐云邮件');
    return $mail->Send() ? true : $mail->ErrorInfo;
}
	if($qzone->sidzt){
		if($row[isauto]){
			include_once "getskey.php";
		}
		@mysql_query("UPDATE {$tableqz}qqs SET sidzt='1',skeyzt='1' WHERE qid='{$qid}'");
		$mail='SID';
	}
	if($qzone->skeyzt){
		if($row[isauto]){
			include_once "getskey.php";
		}
		$sql="skeyzt='1'";
		if($row[iszan]){
			$sql.=",iszan=1";
		}
		if($row[isreply]){
			$sql.=",isreply=1";
		}
		if($row[isshuo]){
			$sql.=",isshuo=1";
		}
		if($row[isqd]){
			$sql.=",isqd=1";
		}
		if($row[isdel]){
			$sql.=",isdel=1";
		}
		if($row[iszf]){
			$sql.=",iszf=1";
		}
		@mysql_query("UPDATE {$tableqz}qqs SET {$sql} WHERE qid='{$qid}'");
		$mail='SKEY';
	}
	if($_GET['get']){
		print_r($qzone->msg);
		print_r($qzone->error);
	}
	if($mail){
		$userresult = mysql_query("SELECT mail FROM {$tableqz}users where uid='{$row['uid']}' limit 1");
		if($user=mysql_fetch_array($userresult)){
			send_active_mail($user['mail'],$mail,$uin,$config);
		}
	}