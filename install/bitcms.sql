DROP TABLE IF EXISTS `block`;
DROP TABLE IF EXISTS `content`;
DROP TABLE IF EXISTS `siteparas`;
DROP TABLE IF EXISTS `slider`;
DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `replies`;
DROP TABLE IF EXISTS `msgbook`;

CREATE TABLE `block` (
  `block_id` int(11) NOT NULL auto_increment,
  `block_name` varchar(256) NOT NULL,
  `dsp_img` varchar(256) default NULL,
  `block_order` int(11) NOT NULL,
  `block_pos` int(11) NOT NULL default '1',
  `input_tm` varchar(32) NOT NULL,
  `edit_tm` varchar(32) NOT NULL,
  `usr_id` varchar(10) NOT NULL,
  PRIMARY KEY  (`block_id`),
  UNIQUE KEY `block_name` (`block_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE `content` (
  `id` int(11) NOT NULL auto_increment,
  `block_id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `dsp_img` varchar(256) default NULL,
  `keyword` text NOT NULL,
  `content` text NOT NULL,
  `content_short` text NOT NULL,
  `input_tm` varchar(32) NOT NULL,
  `edit_tm` varchar(32) NOT NULL,
  `pub_tm` varchar(32) NOT NULL,
  `top_tm` varchar(32) NOT NULL,
  `sts` varchar(4) NOT NULL,
  `usr_id` varchar(10) NOT NULL,
  `visits` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE `replies` (
  `rep_id` int(11) NOT NULL auto_increment,
  `par_id` int(11) NOT NULL,
  `usr_name` varchar(10) NOT NULL,
  `rep_ctx` text NOT NULL,
  `input_tm` varchar(32) NOT NULL,
  `top_count` int(11) NOT NULL default 0,
  `sts` varchar(4) NOT NULL default '1',
   PRIMARY KEY  (`rep_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE `msgbook` (
  `msg_id` int(11) NOT NULL auto_increment,
  `usr_name` varchar(10) NOT NULL,
  `msg_ctx` text NOT NULL,
  `input_tm` varchar(32) NOT NULL,
  `msg_lvl` int(11) NOT NULL default 0,
  `sts` varchar(4) NOT NULL default '1',
   PRIMARY KEY  (`msg_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE `siteparas` (
  `name` varchar(256) NOT NULL,
  `value` varchar(1024) NOT NULL,
  PRIMARY KEY  (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `slider` (
  `img_src` varchar(512) NOT NULL,
  `img_url` varchar(512) NOT NULL,
  `img_order` int(2) NOT NULL,
  UNIQUE KEY `img_order` (`img_order`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `users` (
  `usr_id` int(11) NOT NULL auto_increment,
  `rol_id` int(11) default NULL,
  `usr_nm` varchar(32) NOT NULL,
  `usr_rnm` varchar(32) default NULL,
  `usr_sts` char(1) NOT NULL,
  `usr_email` varchar(64) default NULL,
  `usr_pwd` varchar(32) NOT NULL,
  `tm_stmp` varchar(32) default NULL,
  `info1` varchar(256) default NULL,
  `info2` varchar(256) default NULL,
  `info3` varchar(256) default NULL,
  PRIMARY KEY  (`usr_id`),
  UNIQUE KEY `usr_nm` (`usr_nm`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


INSERT INTO `block` VALUES   ( '1', 'Defualt', 'upload/default.png', '0', '0', '20150121022817', '20150121022817', '1');
INSERT INTO `content` VALUES   ( '2', '1', 'Welcome', 'upload/default.png', 'Welcome', '<p>									</p><p>Welcome to bitblog world!<br/></p><p><br/></p><p>								</p>', 'Welcome to bitblog world!', '20150121022911', '20150121073417', '20150121163434', '', '1', '1', '5');
INSERT INTO `siteparas` VALUES   ( 'logo', 'logo.png');
INSERT INTO `siteparas` VALUES   ( 'name', 'BITBLOG');
INSERT INTO `siteparas` VALUES   ( 'keywords', 'BITBLOG');
INSERT INTO `siteparas` VALUES   ( 'description', 'This is a BITBLOG website !');
INSERT INTO `siteparas` VALUES   ( 'tpl_root', 'view/template/base');
INSERT INTO `siteparas` VALUES   ( 'tpl_name', 'base');
INSERT INTO `siteparas` VALUES   ( 'accstat', '<script src=\"http://s96.cnzz.com/stat.php?id=5602675&web_id=5602675&show=pic\" language=\"JavaScript\"></script>');
INSERT INTO `siteparas` VALUES   ( 'notice', 'A new bitblog website is online ! !');
INSERT INTO `siteparas` VALUES   ( 'headimg', '');
INSERT INTO `siteparas` VALUES   ( 'homemaxnum', '50');
INSERT INTO `siteparas` VALUES   ( 'newmaxnum', '10');
INSERT INTO `siteparas` VALUES   ( 'topmaxnum', '10');
INSERT INTO `siteparas` VALUES   ( 'commentswitch', '1');
INSERT INTO `siteparas` VALUES   ( 'commentdspnum', '10');
