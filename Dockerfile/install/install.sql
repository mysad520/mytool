DROP TABLE IF EXISTS `klmz_kms`;
CREATE TABLE `klmz_kms` (
  `kid` int(11) NOT NULL AUTO_INCREMENT,
  `kind` tinyint(1) NOT NULL DEFAULT '0',
  `daili` int(11) NOT NULL DEFAULT '0',
  `km` varchar(50) NOT NULL,
  `ms` int(2) NOT NULL DEFAULT '1',
  `isuse` tinyint(1) DEFAULT '0',
  `uid` int(11) DEFAULT NULL,
  `usetime` datetime DEFAULT NULL,
  `addtime` datetime DEFAULT NULL,
  PRIMARY KEY (`kid`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `klmz_qqs`;
CREATE TABLE `klmz_qqs` (
  `qid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0',
  `usedate` datetime DEFAULT NULL,
  `qq` decimal(10,0) NOT NULL,
  `pwd` varchar(80) DEFAULT NULL,
  `sid` varchar(80) NOT NULL,
  `skey` varchar(20) NOT NULL,
  `sidzt` tinyint(1) DEFAULT '0',
  `skeyzt` tinyint(1) DEFAULT '0',
  `qqzt` tinyint(1) NOT NULL DEFAULT '0',
  `iszan` tinyint(1) DEFAULT '0',
  `zanrate` int(3) DEFAULT '15',
  `zannet` tinyint(1) DEFAULT '0',
  `lastzan` datetime DEFAULT NULL,
  `nextzan` datetime DEFAULT NULL,
  `isreply` tinyint(1) DEFAULT '0',
  `replycon` varchar(1000) DEFAULT NULL,
  `replypic` varchar(1000) DEFAULT NULL,
  `replyrate` int(3) DEFAULT '15',
  `replynet` tinyint(1) DEFAULT '0',
  `lastreply` datetime DEFAULT NULL,
  `nextreply` datetime DEFAULT NULL,
  `isshuo` tinyint(1) DEFAULT '0',
  `shuotype` tinyint(1) DEFAULT '0',
  `shuorate` int(3) DEFAULT '30',
  `shuonet` tinyint(1) DEFAULT '0',
  `shuoshuo` text,
  `shuopic` text,
  `shuophone` varchar(200) DEFAULT NULL,
  `lastshuo` datetime DEFAULT NULL,
  `nextshuo` datetime DEFAULT NULL,
  `isdel` tinyint(1) DEFAULT '0',
  `delnet` tinyint(1) DEFAULT '0',
  `lastdel` datetime DEFAULT NULL,
  `nextdel` datetime DEFAULT NULL,
  `isqd` tinyint(1) DEFAULT NULL,
  `qdcon` varchar(1000) DEFAULT NULL,
  `qdnet` tinyint(1) DEFAULT '0',
  `lastqd` datetime DEFAULT NULL,
  `nextqd` datetime DEFAULT NULL,
  `is3gqq` tinyint(1) DEFAULT '0',
  `3gqqnet` tinyint(1) DEFAULT '0',
  `last3gqq` datetime DEFAULT NULL,
  `next3gqq` datetime DEFAULT NULL,
  `isly` tinyint(1) NOT NULL DEFAULT '0',
  `lastly` datetime DEFAULT NULL,
  `nextly` datetime DEFAULT NULL,
  `isfw` tinyint(1) NOT NULL DEFAULT '0',
  `lastfw` datetime DEFAULT NULL,
  `nextfw` datetime DEFAULT NULL,
  `isvipqd` tinyint(1) NOT NULL DEFAULT '0',
  `lastvipqd` datetime DEFAULT NULL,
  `nextvipqd` datetime DEFAULT NULL,
  `iszyzan` tinyint(1) NOT NULL DEFAULT '0',
  `lastzyzan` datetime DEFAULT NULL,
  `nextzyzan` datetime DEFAULT NULL,
  `iszf` tinyint(4) NOT NULL DEFAULT '0',
  `zfok` text,
  `zfcon` text,
  `zfrate` tinyint(1) NOT NULL DEFAULT '15',
  `zfnet` tinyint(1) NOT NULL DEFAULT '0',
  `lastzf` datetime DEFAULT NULL,
  `nextzf` datetime DEFAULT NULL,
  `isht` tinyint(1) NOT NULL DEFAULT '0',
  `lastht` datetime DEFAULT NULL,
  `nextht` datetime DEFAULT NULL,
  `ists` tinyint(1) NOT NULL DEFAULT '0',
  `lastts` datetime DEFAULT NULL,
  `nextts` datetime DEFAULT NULL,
  `islw` tinyint(1) NOT NULL DEFAULT '0',
  `lastlw` datetime DEFAULT NULL,
  `nextlw` datetime DEFAULT NULL,
  `islq` tinyint(1) NOT NULL DEFAULT '0',
  `lastlq` datetime DEFAULT NULL,
  `nextlq` datetime DEFAULT NULL,
  `isqb` tinyint(1) NOT NULL DEFAULT '0',
  `lastqb` datetime DEFAULT NULL,
  `nextqb` datetime DEFAULT NULL,
  `isauto` tinyint(1) NOT NULL DEFAULT '0',
  `lastauto` datetime DEFAULT NULL,
  `addtime` datetime DEFAULT NULL,
  PRIMARY KEY (`qid`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `klmz_users`;
CREATE TABLE `klmz_users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL,
  `daili` tinyint(1) DEFAULT '0',
  `vip` tinyint(1) DEFAULT '0',
  `vipstart` date DEFAULT NULL,
  `vipend` date DEFAULT NULL,
  `rmb` int(5) DEFAULT '0',
  `peie` tinyint(2) DEFAULT '1',
  `pwd` varchar(40) NOT NULL,
  `sid` varchar(50) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '0',
  `fuzhan` tinyint(1) DEFAULT '0',
  `login` tinyint(255) DEFAULT '1',
  `mail` varchar(100) DEFAULT NULL,
  `qq` varchar(255) DEFAULT '0',
  `phone` varchar(255) DEFAULT '0',
  `city` varchar(50) DEFAULT NULL,
  `regip` varchar(50) DEFAULT NULL,
  `lastip` varchar(50) DEFAULT NULL,
  `regtime` datetime DEFAULT NULL,
  `lasttime` datetime DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `klmz_webconfigs`;
CREATE TABLE `klmz_webconfigs` (
  `vkey` varchar(255) NOT NULL,
  `value` text,
  PRIMARY KEY (`vkey`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `klmz_users` VALUES ('1', 'admin', '0', '1', null, '2020-12-30', '9999', '127', '4d3ea8f0d1aa6fa07b6c0a5375645c48', '0b484609853c70cd87c8d1e3b2f5f34a', '9','1','1', 'admin@admin.cn', null, null, '', '127.0.0.1', '127.0.0.1', '2015-06-04 10:33:39', '2015-06-04 10:33:44');
INSERT INTO `klmz_webconfigs` VALUES ('cronrand', '1234');
INSERT INTO `klmz_webconfigs` VALUES ('regpeie', '1');
INSERT INTO `klmz_webconfigs` VALUES ('zannet', '10');
INSERT INTO `klmz_webconfigs` VALUES ('netnum', '10');
INSERT INTO `klmz_webconfigs` VALUES ('mail_email', '');
INSERT INTO `klmz_webconfigs` VALUES ('mail_pwd', '');
INSERT INTO `klmz_webconfigs` VALUES ('mail_host', '');
INSERT INTO `klmz_webconfigs` VALUES ('mail_port', '');
INSERT INTO `klmz_webconfigs` VALUES ('do', 'set');
INSERT INTO `klmz_webconfigs` VALUES ('price_1vip', '8');
INSERT INTO `klmz_webconfigs` VALUES ('price_3vip', '20');
INSERT INTO `klmz_webconfigs` VALUES ('price_6vip', '30');
INSERT INTO `klmz_webconfigs` VALUES ('price_12vip', '50');
INSERT INTO `klmz_webconfigs` VALUES ('price_1peie', '20');
INSERT INTO `klmz_webconfigs` VALUES ('price_3peie', '40');
INSERT INTO `klmz_webconfigs` VALUES ('price_5peie', '50');
INSERT INTO `klmz_webconfigs` VALUES ('price_10peie', '66');
INSERT INTO `klmz_webconfigs` VALUES ('submit', '确认修改');
INSERT INTO `klmz_webconfigs` VALUES ('webkey', '最好用的秒赞网');
INSERT INTO `klmz_webconfigs` VALUES ('webtemplate', 'template/template1.php');
INSERT INTO `klmz_webconfigs` VALUES ('webname', '天高云淡');
INSERT INTO `klmz_webconfigs` VALUES ('webdomain', '');
INSERT INTO `klmz_webconfigs` VALUES ('webqq', '123456');
INSERT INTO `klmz_webconfigs` VALUES ('web_index_gg', '<font color=\"red\">欢迎使用本离线秒赞网</font>');
INSERT INTO `klmz_webconfigs` VALUES ('web_control_gg', '');
INSERT INTO `klmz_webconfigs` VALUES ('web_shop_gg', '');
INSERT INTO `klmz_webconfigs` VALUES ('webfree', '1');
INSERT INTO `klmz_webconfigs` VALUES ('price_1dvip', '1');
INSERT INTO `klmz_webconfigs` VALUES ('regrmb', '1');
INSERT INTO `klmz_webconfigs` VALUES ('web_rmb_gg', '<font color=\"red\">欢迎使用</font>');