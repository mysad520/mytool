<?php
require_once('../conn.php');

//判断是否登录
if(!C('loginuid')){
	exit("<script language='javascript'>alert('请先登录！');window.location.href='/login.php';</script>");
}elseif($userrow['active']!=9){
	exit("<script language='javascript'>alert('你不是管理员！');window.location.href='/';</script>");
}