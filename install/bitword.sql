DROP TABLE IF EXISTS `block`;
DROP TABLE IF EXISTS `content`;
DROP TABLE IF EXISTS `siteparas`;
DROP TABLE IF EXISTS `slider`;
DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `replies`;
DROP TABLE IF EXISTS `msgbook`;
DROP TABLE IF EXISTS `words`;
DROP TABLE IF EXISTS `rssfeeds`;


CREATE TABLE `words` (
  `word_id` int(11) NOT NULL auto_increment,
  `content` text NOT NULL,
  `input_tm` varchar(32) NOT NULL,
  `edit_tm` varchar(32) NOT NULL,
  `usr_id` varchar(10) NOT NULL,
  PRIMARY KEY  (`word_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE `rssfeeds` (
  `feed_id` int(11) NOT NULL auto_increment,
  `feed_title` varchar(128) NOT NULL default '',
  `url` varchar(256) NOT NULL,
  `input_tm` varchar(32) NOT NULL,
  `edit_tm` varchar(32) NOT NULL,
  `usr_id` varchar(10) NOT NULL,
  `display_num` int(11) NOT NULL default '5',
  `display_pos` int(11) NOT NULL default '0',
   PRIMARY KEY  (`feed_id`),
   UNIQUE KEY `url` (`url`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE `block` (
  `block_id` int(11) NOT NULL,
  `block_name` varchar(256) NOT NULL,
  `dsp_img` varchar(256) default NULL,
  `block_order` int(11) NOT NULL,
  `block_pos` int(11) NOT NULL default '1',
  `input_tm` varchar(32) NOT NULL,
  `edit_tm` varchar(32) NOT NULL,
  `usr_id` varchar(10) NOT NULL,
  PRIMARY KEY  (`block_id`),
  UNIQUE KEY `block_name` (`block_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

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
  `pub_tm` varchar(32) default NULL,
  `top_tm` varchar(32) default NULL,
  `sts` varchar(4) NOT NULL,
  `usr_id` varchar(10) NOT NULL,
  `link` varchar(512) default NULL,
  `visits` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE `replies` (
  `rep_id` int(11) NOT NULL auto_increment,
  `par_id` int(11) NOT NULL,
  `usr_name` varchar(64) NOT NULL,
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


INSERT INTO `block` VALUES   ( '0', 'º€÷µ ’≤ÿ', 'upload/default.png', '0', '0',  date_format(now(),'%Y%m%d%H%i%s'),  date_format(now(),'%Y%m%d%H%i%s'), '1');

INSERT INTO `siteparas` VALUES   ( 'logo', 'logo.png');
INSERT INTO `siteparas` VALUES   ( 'name', 'BitWord');
INSERT INTO `siteparas` VALUES   ( 'keywords', 'BitWord');
INSERT INTO `siteparas` VALUES   ( 'description', 'BitWord');
INSERT INTO `siteparas` VALUES   ( 'tpl_root', 'view/template/default');
INSERT INTO `siteparas` VALUES   ( 'tpl_name', 'default');
INSERT INTO `siteparas` VALUES   ( 'accstat', '');
INSERT INTO `siteparas` VALUES   ( 'notice', 'A new BitWord site is online');
INSERT INTO `siteparas` VALUES   ( 'headimg', '');
INSERT INTO `siteparas` VALUES   ( 'homemaxnum', '50');
INSERT INTO `siteparas` VALUES   ( 'newmaxnum', '10');
INSERT INTO `siteparas` VALUES   ( 'topmaxnum', '10');
INSERT INTO `siteparas` VALUES   ( 'commentswitch', '1');
INSERT INTO `siteparas` VALUES   ( 'commentdspnum', '10');


--  http://articles.csdn.net/api/rss.php?tid=1132
--  http://articles.csdn.net/api/rss.php?tid=1097
--  http://articles.csdn.net/api/rss.php?tid=1148
--  http://articles.csdn.net/api/rss.php?tid=1109

