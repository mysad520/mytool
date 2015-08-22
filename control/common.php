<?php
require_once('../conn.php');

//判断是否登录
if(!C('loginuid')){
	exit("<script language='javascript'>alert('请先登录！');window.location.href='/login.php';</script>");
}