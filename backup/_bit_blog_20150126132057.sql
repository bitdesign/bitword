delete from block;
INSERT INTO `block` VALUES   ( '1', 'Defualt', 'upload/default.png', '0', '0', '20150121022817', '20150121022817', '1');

delete from content;
INSERT INTO `content` VALUES   ( '2', '1', 'Welcome', 'upload/default.png', 'Welcome', '<p>									</p><p>Welcome to bitblog world!<br/></p><p><br/></p><p>								</p>', 'Welcome to bitblog world!', '20150121022911', '20150121073417', '20150121163434', '', '1', '1', '5');

delete from msgbook;

delete from replies;

delete from siteparas;
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

delete from slider;

delete from users;
INSERT INTO `users` VALUES   ( '1', NULL, 'admin', 'Administrator', '1', NULL, '21232f297a57a5a743894a0e4a801fc3', NULL, NULL, NULL, NULL);

