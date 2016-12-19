/*
 Navicat Premium Data Transfer

 Source Server         : localdb
 Source Server Type    : MySQL
 Source Server Version : 50713
 Source Host           : localhost
 Source Database       : wx_game

 Target Server Type    : MySQL
 Target Server Version : 50713
 File Encoding         : utf-8

 Date: 07/26/2016 11:07:08 AM
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `wxairs`
-- ----------------------------
DROP TABLE IF EXISTS `wxairs`;
CREATE TABLE `wxairs` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(20) NOT NULL,
  `date` int(20) NOT NULL,
  `company` varchar(90) DEFAULT NULL,
  `postion` varchar(50) DEFAULT '',
  `contact` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;
