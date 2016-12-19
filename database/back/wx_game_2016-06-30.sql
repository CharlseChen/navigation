# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.11)
# Database: wx_game
# Generation Time: 2016-06-30 00:48:46 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table game_data
# ------------------------------------------------------------

DROP TABLE IF EXISTS `game_data`;

CREATE TABLE `game_data` (
  `game_id` int(11) unsigned NOT NULL,
  `user_count` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '玩游戏的总人数',
  `view_count` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '游戏的打开次数',
  `end_count` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '游戏完成的总人数',
  PRIMARY KEY (`game_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='微游戏相关数据';

LOCK TABLES `game_data` WRITE;
/*!40000 ALTER TABLE `game_data` DISABLE KEYS */;

INSERT INTO `game_data` (`game_id`, `user_count`, `view_count`, `end_count`)
VALUES
	(1,1,41,6),
	(3,0,0,0);

/*!40000 ALTER TABLE `game_data` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table games
# ------------------------------------------------------------

DROP TABLE IF EXISTS `games`;

CREATE TABLE `games` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '名称',
  `short_name` char(10) NOT NULL DEFAULT '' COMMENT '短名',
  `max_start_game` tinyint(2) DEFAULT '1' COMMENT '每个用户可以玩次数，0为无限制',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态',
  `share_title` varchar(200) DEFAULT NULL COMMENT '分享的标题',
  `share_desc` varchar(400) DEFAULT NULL COMMENT '分享的描述',
  `share_img` varchar(400) DEFAULT NULL COMMENT '分享的图片',
  `must_follow` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否需要提前关注公众号',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_name` (`short_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='微游戏列表信息';

LOCK TABLES `games` WRITE;
/*!40000 ALTER TABLE `games` DISABLE KEYS */;

INSERT INTO `games` (`id`, `name`, `short_name`, `max_start_game`, `status`, `share_title`, `share_desc`, `share_img`, `must_follow`, `created_at`, `updated_at`)
VALUES
	(1,'重生战场','cfzc',0,1,'重生战场','我接到了一个神秘任务，请速度前往进行挑战！！！','img/share.jpg',1,'2016-06-24 10:40:33','2016-06-27 14:56:22'),
	(3,'测试','test',0,0,'我要分享的标题我来','我来微信分享的描述我来微信分享的描述我来微信分享的描述我来微信分享的描述',NULL,0,'2016-06-24 10:47:09','2016-06-24 19:01:39');

/*!40000 ALTER TABLE `games` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table permission_role
# ------------------------------------------------------------

DROP TABLE IF EXISTS `permission_role`;

CREATE TABLE `permission_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_role_permission_id_index` (`permission_id`),
  KEY `permission_role_role_id_index` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;

INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`, `created_at`, `updated_at`)
VALUES
	(15,1,1,'2016-06-22 07:52:04','2016-06-22 07:52:04'),
	(16,7,1,'2016-06-22 07:52:04','2016-06-22 07:52:04'),
	(17,9,1,'2016-06-22 07:52:04','2016-06-22 07:52:04'),
	(18,5,1,'2016-06-22 07:52:04','2016-06-22 07:52:04'),
	(19,3,1,'2016-06-22 07:52:04','2016-06-22 07:52:04'),
	(20,6,1,'2016-06-22 07:52:04','2016-06-22 07:52:04'),
	(21,8,1,'2016-06-22 07:52:04','2016-06-22 07:52:04'),
	(31,1,2,'2016-06-22 07:57:13','2016-06-22 07:57:13'),
	(32,3,2,'2016-06-22 07:57:13','2016-06-22 07:57:13'),
	(33,6,2,'2016-06-22 07:57:13','2016-06-22 07:57:13'),
	(34,8,2,'2016-06-22 07:57:13','2016-06-22 07:57:13');

/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table permission_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `permission_user`;

CREATE TABLE `permission_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_user_permission_id_index` (`permission_id`),
  KEY `permission_user_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table permissions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;

INSERT INTO `permissions` (`id`, `name`, `slug`, `description`, `model`, `created_at`, `updated_at`)
VALUES
	(1,'后台管理首页','admin.index.index','后台管理首页',NULL,'2016-02-16 17:57:51','2016-02-16 17:57:51'),
	(3,'用户管理','admin.user.index','管理用户','App\\Models\\User','2016-06-22 02:37:36','2016-06-22 02:41:19'),
	(5,'清理缓存','admin.tool.clearcache','清理缓存','','2016-06-22 07:49:18','2016-06-22 07:49:18'),
	(6,'站点设置','admin.setting.website','','','2016-06-22 07:49:41','2016-06-22 07:49:41'),
	(7,'微信公众号设置','admin.setting.wechat','','','2016-06-22 07:49:54','2016-06-22 07:49:54'),
	(8,'角色管理','admin.role.index','','','2016-06-22 07:50:09','2016-06-22 07:50:09'),
	(9,'权限管理','admin.permission.index','','','2016-06-22 07:50:22','2016-06-22 07:50:22');

/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table role_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `role_user`;

CREATE TABLE `role_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_user_role_id_index` (`role_id`),
  KEY `role_user_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`)
VALUES
	(6,1,1,'2016-06-27 08:38:10','2016-06-27 08:38:10'),
	(7,2,2,'2016-06-27 08:38:18','2016-06-27 08:38:18');

/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;

INSERT INTO `roles` (`id`, `name`, `slug`, `description`, `level`, `created_at`, `updated_at`)
VALUES
	(1,'超级管理员','admins','超级管理员。',1,'2016-02-16 09:52:13','2016-06-27 08:31:43'),
	(2,'后台管理员','admin','后台管理员。',1,'2016-06-21 01:19:55','2016-06-27 08:32:27'),
	(3,'普通管理员','general','普通管理员。一般权限。',1,'2016-06-22 02:32:40','2016-06-27 08:33:03'),
	(4,'运营','operations','运营，编辑权限。',1,'2016-06-27 08:34:47','2016-06-27 08:34:47');

/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table settings
# ------------------------------------------------------------

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;

INSERT INTO `settings` (`name`, `value`)
VALUES
	('website_admin_email','admin@qdefense.cn'),
	('website_admin_page','20'),
	('website_cache_time','1'),
	('website_footer',''),
	('website_header',''),
	('website_icp',''),
	('website_name','微游戏'),
	('website_share_code',''),
	('website_url','http://www.qdefense.cn'),
	('website_version','2.1'),
	('wechat_appid','wx1acb348506fa7352'),
	('wechat_appsecret','a83c96aca765bb308bbc1fb40012294d'),
	('wechat_encodingaeskey',''),
	('wechat_loglevel','debug'),
	('wechat_logpath','logs/wechat.log'),
	('wechat_token','');

/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`)
VALUES
	(1,'admin','admin@qdefense.cn','$2y$10$ZmxNRfpc3gH3DHzPRXgLS.13DBm6brS9XMMt9x7C.s/FjEGVxfBcS','o6KGm8z4K0Gvg8oXb34hw8rjVk92uCto7jucw9YVOdy67OKRglwjyyV1oGPY','2016-06-20 09:31:53','2016-06-27 08:38:25'),
	(2,'test','test@qdefense.cn','$2y$10$ZmxNRfpc3gH3DHzPRXgLS.13DBm6brS9XMMt9x7C.s/FjEGVxfBcS','rOYaMGWpvVQ4hIoijHfWLkyml9p7l3dZQdXn2g5vgGBONsgeC5LVwXLrMdR2','2016-06-20 09:31:53','2016-06-24 14:19:35');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table wechat_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `wechat_user`;

CREATE TABLE `wechat_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `openid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户的唯一标识',
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '用户名',
  `nickname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户昵称',
  `sex` tinyint(1) NOT NULL COMMENT '用户的性别，值为1时是男性，值为2时是女性，值为0时是未知',
  `language` char(5) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '语言，zh_CN',
  `city` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '普通用户个人资料填写的城市',
  `province` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户个人资料填写的省份',
  `country` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '国家，如中国为CN',
  `headimgurl` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户头像',
  `privilege` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '用户特权信息，json 数组',
  `unionid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'UnionID',
  `my_share_game_count` int(11) NOT NULL DEFAULT '0' COMMENT '用户分享来的数量',
  `share_parent_userid` int(11) NOT NULL COMMENT '分享自来源的UID',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_openid` (`openid`),
  KEY `index_create` (`created_at`),
  KEY `index_name` (`name`,`nickname`),
  KEY `index_pid` (`share_parent_userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='微信授权用户表';

LOCK TABLES `wechat_user` WRITE;
/*!40000 ALTER TABLE `wechat_user` DISABLE KEYS */;

INSERT INTO `wechat_user` (`id`, `openid`, `name`, `nickname`, `sex`, `language`, `city`, `province`, `country`, `headimgurl`, `privilege`, `unionid`, `my_share_game_count`, `share_parent_userid`, `status`, `created_at`, `updated_at`)
VALUES
	(1,'oTMHRs9DsKKuwzajvJd-HGn8WiYA','兴辉王?','兴辉王?',1,'zh_CN','深圳','广东','中国','http://wx.qlogo.cn/mmopen/6fnkZFq8xeb2g7T2X1ibHK1mVkP5icBdkIGBdLmxZQ75V8Cv3I83iapBTcAp9sEyBM5nY2fUo0q1yoCqfHpAreVKicib6lImM3Ocs/0','[]','',0,0,1,'2016-06-29 16:10:28','2016-06-29 16:10:28');

/*!40000 ALTER TABLE `wechat_user` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table wechat_user_data
# ------------------------------------------------------------

DROP TABLE IF EXISTS `wechat_user_data`;

CREATE TABLE `wechat_user_data` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `share_parent_userid` int(11) NOT NULL DEFAULT '0' COMMENT '来源用户id',
  `share_parent_openid` varchar(100) NOT NULL DEFAULT '' COMMENT '来源openid',
  `my_share_game_count` int(11) NOT NULL DEFAULT '0' COMMENT '用户分享过来玩家数量',
  `source` varchar(50) NOT NULL DEFAULT '' COMMENT '来源的游戏',
  `is_attention` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否关注公众号',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='微信用户信息表';

LOCK TABLES `wechat_user_data` WRITE;
/*!40000 ALTER TABLE `wechat_user_data` DISABLE KEYS */;

INSERT INTO `wechat_user_data` (`user_id`, `share_parent_userid`, `share_parent_openid`, `my_share_game_count`, `source`, `is_attention`)
VALUES
	(1,0,'',0,'cfzc',1);

/*!40000 ALTER TABLE `wechat_user_data` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table wechat_user_game
# ------------------------------------------------------------

DROP TABLE IF EXISTS `wechat_user_game`;

CREATE TABLE `wechat_user_game` (
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `game_id` int(11) NOT NULL COMMENT '游戏ID',
  `start_times` int(11) NOT NULL DEFAULT '0' COMMENT '用户已玩游戏次数',
  `share_number` int(11) NOT NULL DEFAULT '0' COMMENT '用户分享进来用户量',
  `share_start_number` int(11) NOT NULL DEFAULT '0' COMMENT '用户分享进来进行游戏的数量',
  `max_integral` double(5,2) NOT NULL DEFAULT '0.00' COMMENT '应用最高积分',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户对应微游戏数据';

LOCK TABLES `wechat_user_game` WRITE;
/*!40000 ALTER TABLE `wechat_user_game` DISABLE KEYS */;

INSERT INTO `wechat_user_game` (`user_id`, `game_id`, `start_times`, `share_number`, `share_start_number`, `max_integral`)
VALUES
	(1,1,6,0,0,60.00);

/*!40000 ALTER TABLE `wechat_user_game` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table wechat_user_game_data
# ------------------------------------------------------------

DROP TABLE IF EXISTS `wechat_user_game_data`;

CREATE TABLE `wechat_user_game_data` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `user_openid` varchar(100) NOT NULL DEFAULT '' COMMENT '用户openid',
  `game_id` int(11) NOT NULL COMMENT '微游戏的ID',
  `integral` double(5,2) NOT NULL DEFAULT '0.00' COMMENT '游戏积分',
  `share_parent_userid` int(11) NOT NULL DEFAULT '0' COMMENT '分享的来源ID',
  `share_parent_openid` varchar(100) NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_pid` (`share_parent_userid`,`user_id`,`integral`,`created_at`),
  KEY `index_userid` (`user_id`,`game_id`,`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户微游戏数据';

LOCK TABLES `wechat_user_game_data` WRITE;
/*!40000 ALTER TABLE `wechat_user_game_data` DISABLE KEYS */;

INSERT INTO `wechat_user_game_data` (`id`, `user_id`, `user_openid`, `game_id`, `integral`, `share_parent_userid`, `share_parent_openid`, `created_at`, `updated_at`)
VALUES
	(1,1,'oTMHRs9DsKKuwzajvJd-HGn8WiYA',1,60.00,0,'','2016-06-29 16:14:33','2016-06-29 16:14:33'),
	(2,1,'oTMHRs9DsKKuwzajvJd-HGn8WiYA',1,60.00,0,'','2016-06-29 17:17:07','2016-06-29 17:17:07'),
	(3,1,'oTMHRs9DsKKuwzajvJd-HGn8WiYA',1,60.00,0,'','2016-06-29 17:18:08','2016-06-29 17:18:08'),
	(4,1,'oTMHRs9DsKKuwzajvJd-HGn8WiYA',1,60.00,0,'','2016-06-29 17:18:57','2016-06-29 17:18:57'),
	(5,1,'oTMHRs9DsKKuwzajvJd-HGn8WiYA',1,0.00,0,'','2016-06-29 17:19:25','2016-06-29 17:19:25'),
	(6,1,'oTMHRs9DsKKuwzajvJd-HGn8WiYA',1,50.00,0,'','2016-06-29 17:21:32','2016-06-29 17:21:32');

/*!40000 ALTER TABLE `wechat_user_game_data` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
