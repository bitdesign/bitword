delete from block;
INSERT INTO `block` VALUES   ( '1', 'Share', 'upload/default.png', '0', '0', '20150625124305', '20150625124305', '1');
INSERT INTO `block` VALUES   ( '2', 'News', 'upload/default.png', '0', '0', '20150625124305', '20150625124305', '1');

delete from content;
INSERT INTO `content` VALUES   ( '1', '1', 'Welcome to BitCMS', '', 'Welcome to BitCMS', 'BitCMS is a super lightweight blog software &nbsp;for minimalist paranoia.', 'BitCMS is a super lightweight blog software for minimalist paranoia.', '20150626032258', '20150626033124', '20150626142837', '', '1', '1', '', '0');

delete from msgbook;

delete from replies;

delete from rssfeeds;

delete from siteparas;
INSERT INTO `siteparas` VALUES   ( 'logo', 'logo.png');
INSERT INTO `siteparas` VALUES   ( 'name', 'BitCMS');
INSERT INTO `siteparas` VALUES   ( 'keywords', 'BitCMS');
INSERT INTO `siteparas` VALUES   ( 'description', 'BitCMS');
INSERT INTO `siteparas` VALUES   ( 'tpl_root', 'view/template/default');
INSERT INTO `siteparas` VALUES   ( 'tpl_name', 'default');
INSERT INTO `siteparas` VALUES   ( 'accstat', '');
INSERT INTO `siteparas` VALUES   ( 'notice', '');
INSERT INTO `siteparas` VALUES   ( 'headimg', '');
INSERT INTO `siteparas` VALUES   ( 'homemaxnum', '50');
INSERT INTO `siteparas` VALUES   ( 'newmaxnum', '10');
INSERT INTO `siteparas` VALUES   ( 'topmaxnum', '');
INSERT INTO `siteparas` VALUES   ( 'commentswitch', '1');
INSERT INTO `siteparas` VALUES   ( 'commentdspnum', '10');

delete from slider;

delete from users;
INSERT INTO `users` VALUES   ( '1', NULL, 'admin', 'Administrator', '1', NULL, 'e941e5415b04c5babd4bda73293ced93', NULL, NULL, NULL, NULL);

delete from words;

