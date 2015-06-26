delete from block;
INSERT INTO `block` VALUES   ( '1', 'Share', 'upload/default.png', '0', '0', '20150626230913', '20150626230913', '1');
INSERT INTO `block` VALUES   ( '2', 'News', 'upload/default.png', '0', '0', '20150626230913', '20150626230913', '1');

delete from content;
INSERT INTO `content` VALUES   ( '1', '1', 'Welcome to bitcms', '', 'Welcome to bitcms', '<span style=\"font-family: \'Helvetica Neue\', Helvetica, \'Segoe UI\', Arial, freesans, sans-serif; font-size: 16px; line-height: 25.6000003814697px;\">BITCMS is a super lightweight blog software.</span>', 'BITCMS is a super lightweight blog software.', '20150626151000', '20150626151000', '20150626231002', NULL, '1', '1', '', '0');

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
INSERT INTO `siteparas` VALUES   ( 'notice', 'A new BitCMS site is online');
INSERT INTO `siteparas` VALUES   ( 'headimg', '');
INSERT INTO `siteparas` VALUES   ( 'homemaxnum', '50');
INSERT INTO `siteparas` VALUES   ( 'newmaxnum', '10');
INSERT INTO `siteparas` VALUES   ( 'topmaxnum', '10');
INSERT INTO `siteparas` VALUES   ( 'commentswitch', '1');
INSERT INTO `siteparas` VALUES   ( 'commentdspnum', '10');

delete from slider;

delete from users;
INSERT INTO `users` VALUES   ( '1', NULL, 'admin', 'Administrator', '1', NULL, 'e941e5415b04c5babd4bda73293ced93', NULL, NULL, NULL, NULL);

delete from words;

