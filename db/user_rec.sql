/*
Navicat MySQL Data Transfer

Source Server         : 127
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : nn_dev

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2018-07-09 10:59:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `user_rec`
-- ----------------------------
DROP TABLE IF EXISTS `user_rec`;
CREATE TABLE `user_rec` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `subject` varchar(30) NOT NULL COMMENT '主题，比如耐火材料。。。',
  `exp` int(11) NOT NULL COMMENT '推荐指数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户推荐表，根据用户的交易记录，生成各个主题下的推荐指数';

-- ----------------------------
-- Records of user_rec
-- ----------------------------
