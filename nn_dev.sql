-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2017-06-16 05:15:28
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `nn_dev`
--

DELIMITER $$
--
-- 函数
--
CREATE DEFINER=`root`@`localhost` FUNCTION `getChildLists`(`rootId` INT) RETURNS varchar(1000) CHARSET utf8
BEGIN 
                   DECLARE sTemp VARCHAR(1000); 
                   DECLARE sTempChd VARCHAR(1000); 
                 
                   SET sTemp = '$'; 
                   SET sTempChd =cast(rootId as CHAR); 
                 
                   WHILE sTempChd is not null DO 
                     SET sTemp = concat(sTemp,',',sTempChd); 
                     SELECT group_concat(id) INTO sTempChd FROM nn_dev.product_category where FIND_IN_SET(pid,sTempChd)>0; 
                   END WHILE; 
                   RETURN sTemp; 
                 END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- 表的结构 `bid`
--

CREATE TABLE IF NOT EXISTS `bid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no` varchar(100) NOT NULL COMMENT '序号',
  `mode` varchar(10) NOT NULL COMMENT '招标类型：gk:公开，yq:邀请',
  `user_id` int(11) NOT NULL COMMENT '发布招标用户id',
  `yq_user` text NOT NULL COMMENT '邀请会员，用户id,用户名序列号',
  `doc` varchar(100) NOT NULL COMMENT '标书地址',
  `top_cate` int(11) NOT NULL COMMENT '市场类型',
  `pro_name` varchar(100) NOT NULL COMMENT '项目名称',
  `pro_address` varchar(255) NOT NULL COMMENT '项目地址',
  `begin_time` datetime NOT NULL COMMENT '开始投保时间',
  `end_time` datetime NOT NULL COMMENT '结束投保时间',
  `open_time` datetime DEFAULT NULL COMMENT '开标时间',
  `bid_require` text NOT NULL COMMENT '投标条件',
  `pro_brief` text NOT NULL COMMENT '项目概况',
  `bid_content` text NOT NULL COMMENT '项目内容',
  `pack_type` int(2) NOT NULL COMMENT '包件类型，1：分包，2：总包',
  `eq` text NOT NULL COMMENT '企业资质',
  `doc_begin` datetime DEFAULT NULL COMMENT '标书销售开始时间',
  `doc_price` decimal(15,2) NOT NULL COMMENT '标书价格',
  `supply_bail` decimal(15,2) NOT NULL COMMENT '供方保证金',
  `open_way` int(2) NOT NULL COMMENT '开标方式：1线上、2：线下',
  `pay_way` varchar(100) NOT NULL COMMENT '支付方式',
  `other` text NOT NULL COMMENT '其他内容',
  `bid_person` varchar(50) NOT NULL COMMENT '招标人',
  `cont_person` varchar(50) NOT NULL COMMENT '联系人',
  `cont_address` varchar(255) NOT NULL COMMENT '联系地址',
  `cont_email` varchar(100) NOT NULL COMMENT '邮箱',
  `cont_phone` varchar(20) NOT NULL COMMENT '电话',
  `cont_tax` varchar(20) NOT NULL COMMENT '传真',
  `agent` varchar(50) NOT NULL COMMENT '代理机构',
  `agent_person` varchar(50) NOT NULL COMMENT '代理人姓名',
  `agent_address` varchar(255) NOT NULL COMMENT '代理地址',
  `agent_email` varchar(100) NOT NULL COMMENT '代理邮箱',
  `agent_phone` varchar(20) NOT NULL COMMENT '代理电话',
  `agent_tax` varchar(20) NOT NULL COMMENT '代理传真',
  `bail` decimal(15,2) NOT NULL COMMENT '发布招标方保证金',
  `bail_pay_way` varchar(10) NOT NULL COMMENT '保证金支付方式',
  `bail_is_refund` int(2) NOT NULL DEFAULT '0' COMMENT '1:保证金已退，0：未退',
  `status` int(2) NOT NULL COMMENT '招投标状态',
  `create_time` datetime DEFAULT NULL COMMENT '发布时间',
  `admin` int(11) NOT NULL COMMENT '后台审核管理员id',
  `admin_message` varchar(255) NOT NULL COMMENT '审核意见',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

-- --------------------------------------------------------

--
-- 表的结构 `bid_notice`
--

CREATE TABLE IF NOT EXISTS `bid_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bid_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL COMMENT '标题',
  `content` text NOT NULL,
  `create_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `bid_package`
--

CREATE TABLE IF NOT EXISTS `bid_package` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bid_id` int(11) NOT NULL COMMENT '招标id',
  `pack_no` varchar(100) NOT NULL COMMENT '包件号',
  `product_name` varchar(100) NOT NULL COMMENT '商品名称',
  `brand` varchar(100) NOT NULL COMMENT '品牌',
  `spec` varchar(255) NOT NULL COMMENT '规格型号',
  `tech_need` varchar(255) NOT NULL COMMENT '技术要求',
  `unit` varchar(100) NOT NULL COMMENT '单位',
  `num` decimal(15,2) NOT NULL COMMENT '数量',
  `tran_date` date NOT NULL COMMENT '交付日期',
  `tran_days` int(5) NOT NULL,
  `win_user_id` int(11) NOT NULL COMMENT '胜出用户',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- 表的结构 `bid_reply`
--

CREATE TABLE IF NOT EXISTS `bid_reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reply_user_id` int(11) NOT NULL COMMENT '投保用户',
  `bid_user_id` int(11) NOT NULL COMMENT '招标用户',
  `bid_id` int(11) NOT NULL COMMENT '招标id',
  `bid_doc` varchar(100) NOT NULL COMMENT '投标书',
  `doc_fee` decimal(15,2) NOT NULL COMMENT '购买标书支付费用',
  `doc_pay_way` varchar(10) NOT NULL COMMENT '标书支付方式',
  `doc_fee_refund` int(1) NOT NULL COMMENT '1:已退，0：未退',
  `bail_fee` decimal(15,2) NOT NULL COMMENT '供方保证金支付费用',
  `bail_pay_way` decimal(15,2) NOT NULL COMMENT '供方保证金支付方式',
  `bail_fee_refund` int(2) NOT NULL DEFAULT '0' COMMENT '1:已退，2：未退',
  `bail_djcode` varchar(100) NOT NULL COMMENT '支付保证金的冻结编号',
  `status` int(2) NOT NULL COMMENT '状态',
  `create_time` datetime NOT NULL COMMENT '投标时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- 表的结构 `bid_reply_cert`
--

CREATE TABLE IF NOT EXISTS `bid_reply_cert` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reply_id` int(11) NOT NULL COMMENT '投标id',
  `cert_name` varchar(100) NOT NULL COMMENT '证书内容',
  `cert_type` varchar(20) NOT NULL COMMENT '证书类型',
  `cert_des` varchar(100) NOT NULL COMMENT '证书描述',
  `cert_pic` varchar(100) NOT NULL COMMENT '证书图片',
  `create_time` datetime DEFAULT NULL COMMENT '提交时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- 表的结构 `bid_reply_package`
--

CREATE TABLE IF NOT EXISTS `bid_reply_package` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reply_id` int(11) NOT NULL COMMENT '投标id',
  `pack_id` int(11) NOT NULL COMMENT '包件id',
  `pack_no` varchar(100) NOT NULL,
  `brand` varchar(100) NOT NULL COMMENT '品牌',
  `deliver` int(2) NOT NULL COMMENT '1：送货到厂，0：不',
  `unit_price` decimal(15,2) NOT NULL COMMENT '单价',
  `freight_fee` decimal(15,2) NOT NULL COMMENT '运费',
  `tran_days` int(5) NOT NULL COMMENT '交货天数',
  `quanlity` text NOT NULL COMMENT '质量标准',
  `note` varchar(255) NOT NULL COMMENT '备注',
  `zz` int(5) NOT NULL COMMENT '资质分数',
  `js` int(5) NOT NULL COMMENT '技术分数',
  `sw` int(5) NOT NULL COMMENT '商务分数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

DELIMITER $$
--
-- 事件
--
CREATE DEFINER=`root`@`localhost` EVENT `test` ON SCHEDULE AT '2017-06-12 16:20:00' ON COMPLETION PRESERVE ENABLE DO begin 
insert into test (`name`,`value`) values ('weiping',6);

end$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
