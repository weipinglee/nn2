/*
Navicat MySQL Data Transfer

Source Server         : 127
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : nn_dev

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2018-07-16 08:46:38
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `user_pay_log`
-- ----------------------------
DROP TABLE IF EXISTS `user_pay_log`;
CREATE TABLE `user_pay_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT '付款方用户id',
  `subject` varchar(50) CHARACTER SET latin1 NOT NULL COMMENT '账户记录的用途，主题,比如：竞价保证金',
  `acc_bank` varchar(255) NOT NULL COMMENT '银行名称',
  `acc_no` varchar(100) CHARACTER SET latin1 NOT NULL COMMENT '银行账号',
  `acc_name` varchar(100) NOT NULL COMMENT '开户人的名字',
  `to_acc_no` varchar(100) CHARACTER SET latin1 NOT NULL COMMENT '耐耐的账户',
  `subject_id` int(11) NOT NULL COMMENT '主题id,比如竞价报盘的id',
  `pay_total` decimal(12,2) NOT NULL COMMENT '支付的金额',
  `bank_flow` varchar(255) NOT NULL COMMENT '银行交易流水号',
  `create_time` datetime DEFAULT NULL COMMENT '申请时间',
  `pay_time` datetime DEFAULT NULL COMMENT '流水中读取的支付时间',
  `refund_time` datetime DEFAULT NULL COMMENT '退款时间',
  `status` tinyint(2) NOT NULL COMMENT '状态，0：未缴纳，1：已缴纳，2：可退款，3：已退款',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_subject` (`user_id`,`subject`,`subject_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_pay_log
-- ----------------------------
