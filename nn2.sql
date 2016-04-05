-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-04-05 08:15:35
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `nn2`
--

-- --------------------------------------------------------

--
-- 表的结构 `answer`
--

CREATE TABLE IF NOT EXISTS `answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text,
  `status` int(11) DEFAULT NULL COMMENT '是否被采纳',
  `question_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `bid_list`
--

CREATE TABLE IF NOT EXISTS `bid_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT '投标人id',
  `bid_id` int(11) DEFAULT NULL COMMENT '招标id',
  `cert_verify` int(11) DEFAULT NULL COMMENT '资质审核状态',
  `document_buy` int(11) DEFAULT NULL COMMENT '是否已买标书',
  `has_bid` int(11) DEFAULT NULL COMMENT '是否投标',
  `status` int(11) DEFAULT NULL COMMENT '是否审核通过',
  `sign_time` varchar(45) DEFAULT NULL COMMENT '报名时间',
  `call_bid_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`call_bid_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `bid_package`
--

CREATE TABLE IF NOT EXISTS `bid_package` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `p_no` int(11) DEFAULT NULL COMMENT '包件号码',
  `name` varchar(100) DEFAULT NULL COMMENT '货品名称',
  `brand` varchar(45) DEFAULT NULL COMMENT '品牌',
  `spec` varchar(100) DEFAULT NULL COMMENT '型号规格',
  `tech_need` varchar(100) DEFAULT NULL COMMENT '技术要求',
  `unit` varchar(10) DEFAULT NULL COMMENT '计量单位',
  `num` decimal(10,6) DEFAULT NULL COMMENT '数量',
  `deliver_date` int(11) DEFAULT NULL COMMENT '交付日期',
  `call_bid_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`call_bid_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `bid_package_price`
--

CREATE TABLE IF NOT EXISTS `bid_package_price` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bid_package_id` int(11) DEFAULT NULL COMMENT '包件id',
  `name` varchar(45) DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL COMMENT '单价',
  `other_fee` decimal(15,2) DEFAULT NULL,
  `deliver_days` int(11) DEFAULT NULL COMMENT '交货天数',
  `bid_id` int(11) DEFAULT NULL COMMENT '投标id',
  `bid_package_id1` int(11) NOT NULL,
  `bid_package_call_bid_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`bid_package_id1`,`bid_package_call_bid_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `call_bid`
--

CREATE TABLE IF NOT EXISTS `call_bid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `project_name` varchar(200) DEFAULT NULL COMMENT '项目名称',
  `province` varchar(6) DEFAULT NULL COMMENT '省份',
  `city` varchar(6) DEFAULT NULL,
  `area` varchar(6) DEFAULT NULL,
  `bid_time` date DEFAULT NULL COMMENT '投标时间',
  `open_time` date DEFAULT NULL COMMENT '开标时间',
  `cond` text COMMENT '投标条件',
  `project_intro` text COMMENT '项目概况',
  `bid_content` text COMMENT '招标内容',
  `status` int(11) DEFAULT NULL COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL COMMENT '父类id',
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `company_info`
--

CREATE TABLE IF NOT EXISTS `company_info` (
  `user_id` int(10) DEFAULT NULL,
  `area` varchar(6) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL COMMENT '详细地址',
  `company_name` varchar(100) DEFAULT NULL COMMENT '公司名称',
  `legal_person` varchar(20) NOT NULL COMMENT '法人',
  `reg_fund` decimal(9,2) NOT NULL COMMENT '注册资金',
  `category` int(4) NOT NULL COMMENT '企业分类',
  `nature` int(2) NOT NULL COMMENT '企业性质',
  `contact` varchar(20) DEFAULT NULL COMMENT '联系人',
  `contact_phone` varchar(15) NOT NULL COMMENT '联系人电话',
  `contact_duty` int(3) NOT NULL COMMENT '联系人职务',
  `check_taker` varchar(20) DEFAULT NULL COMMENT '收票人',
  `check_taker_phone` varchar(15) DEFAULT NULL COMMENT '收票人电话',
  `check_taker_add` varchar(100) DEFAULT NULL COMMENT '收票地址',
  `deposit_bank` varchar(50) DEFAULT NULL COMMENT '开户银行',
  `bank_acc` varchar(20) DEFAULT NULL COMMENT '银行账号',
  `tax_no` varchar(20) DEFAULT NULL COMMENT '税号',
  `cert_oc` varchar(100) DEFAULT NULL COMMENT '组织机构代码证',
  `cert_bl` varchar(100) DEFAULT NULL COMMENT '营业执照',
  `cert_tax` varchar(100) DEFAULT NULL COMMENT '税务登记证',
  `qq` varchar(15) DEFAULT NULL,
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `company_info`
--

INSERT INTO `company_info` (`user_id`, `area`, `address`, `company_name`, `legal_person`, `reg_fund`, `category`, `nature`, `contact`, `contact_phone`, `contact_duty`, `check_taker`, `check_taker_phone`, `check_taker_add`, `deposit_bank`, `bank_acc`, `tax_no`, `cert_oc`, `cert_bl`, `cert_tax`, `qq`) VALUES
(8, '1202', NULL, '123324', 'SDFSDF', '44.00', 0, 0, '234234', '145343434', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, '210303', NULL, '23423', '的方法', '123.00', 0, 0, '多大的', '1423343434', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, '130102', NULL, '耐耐', '玩儿', '23.00', 0, 0, '快快快', '234234', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, '130102', NULL, '耐耐', '玩儿', '23.00', 0, 0, '快快快', '234234', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, '130102', NULL, '耐耐', '玩儿', '23.00', 0, 0, '快快快', '234234', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, '130102', NULL, '耐耐', '玩儿', '23.00', 0, 0, '快快快', '234234', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, '130102', NULL, '耐耐', '玩儿', '23.00', 0, 0, '快快快', '234234', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, '130102', NULL, '耐耐', '玩儿', '23.00', 0, 0, '快快快', '234234', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, '130102', NULL, '耐耐', '玩儿', '23.00', 0, 0, '快快快', '234234', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, '140311', NULL, '白泉耐火', '赵总', '100.00', 1, 2, '张', '14323232323', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, '140303', 'sdfsdf', 'weqwe', '张小j', '100.00', 1, 1, '王', '123123123', 1, '张张', '13534343434', '水电费水电费水电费', '了看见了看见', '112342342234234234', '1234234234234', 'filefromuser/2016/03/11/20160311071634276.jpg@user@user@user@user@user@user@user@user@user@user@user', 'filefromuser/2016/03/11/20160311071631414.jpg@user@user@user@user@user@user@user@user@user@user@user', 'filefromuser/2016/03/11/20160311071637894.jpg@user@user@user@user@user@user@user@user@user@user@user', ''),
(36, '230204', 'sdfsdf', '下百强d', '水电费水电费水电费', '200.00', 1, 1, '赵', '14232323', 1, 'asdasd', '13123123123', '13123', '123123123', '123123123123', '123123123', 'filefromuser/2016/03/12/20160312165149275.png@user', 'filefromuser/2016/03/12/20160312165147148.png@user', 'filefromuser/2016/03/12/20160312165152543.png@user', '123123');

-- --------------------------------------------------------

--
-- 表的结构 `dealer`
--

CREATE TABLE IF NOT EXISTS `dealer` (
  `user_id` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `apply_time` datetime DEFAULT NULL,
  `verify_time` datetime DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `message` text NOT NULL COMMENT '驳回原因',
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `dealer`
--

INSERT INTO `dealer` (`user_id`, `status`, `apply_time`, `verify_time`, `admin_id`, `message`) VALUES
(36, 2, '2016-03-25 10:35:00', '2016-03-26 15:51:31', NULL, ''),
(42, 3, '2016-03-25 09:16:04', '2016-03-27 17:08:34', NULL, '');

-- --------------------------------------------------------

--
-- 表的结构 `editor`
--

CREATE TABLE IF NOT EXISTS `editor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `apply_time` datetime DEFAULT NULL,
  `verify_time` datetime DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `expert`
--

CREATE TABLE IF NOT EXISTS `expert` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL COMMENT '开通状态',
  `domain` varchar(100) DEFAULT NULL COMMENT '删除的领域，问题分类以，相隔',
  `answer_times` int(11) DEFAULT NULL COMMENT '回答次数',
  `accept_times` int(11) DEFAULT NULL COMMENT '被采纳次数',
  `apply_time` datetime DEFAULT NULL,
  `verify_time` datetime DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `log_operation`
--

CREATE TABLE IF NOT EXISTS `log_operation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(80) NOT NULL COMMENT '管理员',
  `action` varchar(200) NOT NULL COMMENT '动作',
  `content` text NOT NULL COMMENT '详情',
  `datetime` datetime NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `log_operation`
--

INSERT INTO `log_operation` (`id`, `author`, `action`, `content`, `datetime`) VALUES
(1, 'admin', '处理了一个申请认证', '用户id:42', '2016-03-27 17:00:58'),
(2, 'admin', '处理了一个申请认证', '用户id:42', '2016-03-27 17:01:19'),
(3, 'admin', '处理了一个申请认证', '用户id:42', '2016-03-27 17:05:55'),
(4, 'admin', '处理了一个申请认证', '用户id:42', '2016-03-27 17:06:10');

-- --------------------------------------------------------

--
-- 表的结构 `model`
--

CREATE TABLE IF NOT EXISTS `model` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL COMMENT '模型名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `model_attr`
--

CREATE TABLE IF NOT EXISTS `model_attr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL COMMENT '属性名',
  `value` text COMMENT '属性值，多个以,分割',
  `model_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`model_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_no` varchar(30) DEFAULT NULL,
  `num` decimal(15,2) DEFAULT NULL COMMENT '产品数量',
  `price` decimal(15,2) DEFAULT NULL,
  `order_amount` decimal(15,2) DEFAULT NULL COMMENT '订单总金额',
  `create_time` datetime DEFAULT NULL,
  `complate_time` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '订单状态',
  `products_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `person_info`
--

CREATE TABLE IF NOT EXISTS `person_info` (
  `user_id` int(11) NOT NULL,
  `true_name` varchar(45) DEFAULT NULL,
  `sex` int(11) DEFAULT NULL,
  `identify_no` varchar(20) DEFAULT NULL COMMENT '身份证号码',
  `identify_front` varchar(100) DEFAULT NULL COMMENT '身份证正面照',
  `identify_back` varchar(100) DEFAULT NULL COMMENT '身份证背面',
  `birth` date DEFAULT NULL,
  `education` int(11) DEFAULT NULL COMMENT '学历，不同数字代表不同学历',
  `qq` varchar(20) DEFAULT NULL,
  `zhichen` varchar(30) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `person_info`
--

INSERT INTO `person_info` (`user_id`, `true_name`, `sex`, `identify_no`, `identify_front`, `identify_back`, `birth`, `education`, `qq`, `zhichen`) VALUES
(33, '张', 0, '12323425445345345345', 'filefromuser/2016/03/11/20160311021721228.jpg@user', 'filefromuser/2016/03/11/20160311021724227.jpg@user', '2012-03-06', 0, '123123123', ''),
(37, 'sdfdf', 0, '123123123123123123', 'filefromuser/2016/03/12/20160312184419736.png@user', 'filefromuser/2016/03/12/20160312184422991.png@user', '2015-09-29', 0, '', ''),
(38, NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, ''),
(39, NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, ''),
(40, NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, ''),
(41, NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, ''),
(42, 'qwe', 0, '1232354345345', 'filefromuser/2016/03/25/20160325085343348.jpg@user', 'filefromuser/2016/03/25/20160325085352495.jpg@user', '0000-00-00', 0, '123234234', '地方');

-- --------------------------------------------------------

--
-- 表的结构 `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `sell_price` decimal(15,2) DEFAULT NULL,
  `up_time` datetime DEFAULT NULL,
  `down_time` datetime DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `store_nums` decimal(15,2) DEFAULT NULL,
  `img` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '状态：申请上架，上架，下架',
  `content` text,
  `unit` varchar(6) DEFAULT NULL COMMENT '计量单位',
  `dealer_id` int(11) DEFAULT NULL COMMENT '交易商id',
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `product_attr`
--

CREATE TABLE IF NOT EXISTS `product_attr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(45) NOT NULL,
  `products_id` int(11) NOT NULL,
  `model_attr_id` int(11) NOT NULL,
  `model_attr_model_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`model_attr_id`,`model_attr_model_id`,`products_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `product_photos`
--

CREATE TABLE IF NOT EXISTS `product_photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(100) DEFAULT NULL,
  `products_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`products_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `content` text,
  `status` varchar(45) DEFAULT NULL COMMENT '状态',
  `user_id` int(11) NOT NULL,
  `question_cate_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `question_cate`
--

CREATE TABLE IF NOT EXISTS `question_cate` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL COMMENT '父类id',
  `sort` int(11) DEFAULT NULL,
  `question_num` int(11) DEFAULT NULL COMMENT '问题数量',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ship`
--

CREATE TABLE IF NOT EXISTS `ship` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `start_add` varchar(45) DEFAULT NULL COMMENT '出发地',
  `end_add` varchar(45) DEFAULT NULL COMMENT '目的地',
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `shipper`
--

CREATE TABLE IF NOT EXISTS `shipper` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sattus` int(11) DEFAULT NULL COMMENT '开通状态',
  `user_id` int(11) NOT NULL,
  `apply_time` datetime DEFAULT NULL,
  `verify_time` datetime DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL COMMENT '审核的管理员id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ship_order`
--

CREATE TABLE IF NOT EXISTS `ship_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ship_id` int(11) DEFAULT NULL COMMENT '运输需求id',
  `create_time` datetime DEFAULT NULL,
  `order_no` varchar(20) DEFAULT NULL COMMENT '订单号',
  `shipper_id` int(11) DEFAULT NULL COMMENT '车主id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ship_order_trucks`
--

CREATE TABLE IF NOT EXISTS `ship_order_trucks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ship_order_id` varchar(45) DEFAULT NULL COMMENT '运输订单id',
  `truck_id` int(11) DEFAULT NULL,
  `ship_weight` decimal(10,5) DEFAULT NULL COMMENT '运输重量',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `store_in_out`
--

CREATE TABLE IF NOT EXISTS `store_in_out` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `num` decimal(15,2) DEFAULT NULL,
  `type` int(11) DEFAULT NULL COMMENT '类型：出或入',
  `time` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `store_list_id` int(11) NOT NULL,
  `manager` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `store_list`
--

CREATE TABLE IF NOT EXISTS `store_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `province` varchar(6) DEFAULT NULL,
  `city` varchar(6) DEFAULT NULL,
  `area` varchar(6) DEFAULT NULL,
  `address` varchar(80) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `store_manager`
--

CREATE TABLE IF NOT EXISTS `store_manager` (
  `user_id` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL COMMENT '认证状态',
  `apply_time` datetime DEFAULT NULL,
  `verify_time` datetime DEFAULT NULL COMMENT '审核时间',
  `admin_id` int(11) DEFAULT NULL COMMENT '审核管理员id',
  `store_id` int(11) DEFAULT NULL COMMENT '管理的仓库id',
  `info` text NOT NULL,
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `store_manager`
--

INSERT INTO `store_manager` (`user_id`, `status`, `apply_time`, `verify_time`, `admin_id`, `store_id`, `info`) VALUES
(36, 0, '2016-03-13 12:06:27', NULL, NULL, 1, ''),
(42, 0, '2016-03-12 23:05:44', NULL, NULL, 1, '');

-- --------------------------------------------------------

--
-- 表的结构 `store_products`
--

CREATE TABLE IF NOT EXISTS `store_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `nums` decimal(15,2) DEFAULT NULL,
  `store_list_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `subuser_right`
--

CREATE TABLE IF NOT EXISTS `subuser_right` (
  `id` int(6) NOT NULL AUTO_INCREMENT COMMENT '权限id',
  `level` int(2) NOT NULL COMMENT '权限级别：0：应用，1：模块，2：控制器，3：方法',
  `name` varchar(20) NOT NULL COMMENT '权限名',
  `pid` int(6) NOT NULL COMMENT '父类权限id',
  `note` varchar(30) NOT NULL COMMENT '中文名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `subuser_right`
--

INSERT INTO `subuser_right` (`id`, `level`, `name`, `pid`, `note`) VALUES
(1, 0, 'user', 0, '用户系统'),
(2, 2, 'ucenter', 1, '个人中心'),
(3, 3, 'index', 2, '首页'),
(4, 3, 'chgpass', 2, '修改密码'),
(5, 0, 'deal', 0, '交易系统'),
(6, 2, 'index', 5, '首页');

-- --------------------------------------------------------

--
-- 表的结构 `subuser_role`
--

CREATE TABLE IF NOT EXISTS `subuser_role` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL COMMENT '角色名',
  `status` int(2) NOT NULL COMMENT '0:关闭 1：开启',
  `note` varchar(100) NOT NULL COMMENT '角色说明',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `subuser_role_right`
--

CREATE TABLE IF NOT EXISTS `subuser_role_right` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `role_id` int(8) NOT NULL,
  `right_id` int(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `subuser_user_role`
--

CREATE TABLE IF NOT EXISTS `subuser_user_role` (
  `user_id` int(11) NOT NULL,
  `role_id` int(6) NOT NULL,
  `note` text NOT NULL COMMENT '角色说明'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `test`
--

CREATE TABLE IF NOT EXISTS `test` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `value` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `test`
--

INSERT INTO `test` (`id`, `name`, `value`) VALUES
(1, 'wplee', 7);

-- --------------------------------------------------------

--
-- 表的结构 `truck`
--

CREATE TABLE IF NOT EXISTS `truck` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `vehicle_no` varchar(12) DEFAULT NULL COMMENT '车牌号',
  `area` varchar(8) DEFAULT NULL COMMENT '车辆所属地区',
  `max_load` decimal(6,2) DEFAULT NULL COMMENT '最大载重',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) DEFAULT '0',
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `mobile` varchar(14) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `head_photo` varchar(100) DEFAULT NULL COMMENT '头像',
  `pid` int(11) DEFAULT '0' COMMENT '父账户id',
  `roles` int(5) DEFAULT NULL COMMENT '用户角色',
  `status` smallint(6) DEFAULT NULL,
  `agent` int(5) NOT NULL COMMENT '代理商id',
  `agent_pass` varchar(50) NOT NULL COMMENT '代理商密码',
  `create_time` datetime DEFAULT NULL,
  `login_time` datetime DEFAULT NULL COMMENT '最近登录时间',
  `session_id` varchar(255) NOT NULL COMMENT '用户登录后的sessionID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `type`, `username`, `password`, `mobile`, `email`, `head_photo`, `pid`, `roles`, `status`, `agent`, `agent_pass`, `create_time`, `login_time`, `session_id`) VALUES
(28, 1, 'fgertertert', '601f1889667efaebb33b8c12572835da3f027f78', '456345345345', '', NULL, NULL, NULL, NULL, 3, '12334234234', NULL, NULL, ''),
(29, 1, 'bnfghfghfh', '05fe7461c607c33229772d402505601016a7d0ea', '567456456', '', NULL, NULL, NULL, NULL, 3, '12334234234', NULL, NULL, ''),
(31, 1, 'weipinglee33', '601f1889667efaebb33b8c12572835da3f027f78', '456456456', '', NULL, NULL, NULL, NULL, 3, '12334234234', NULL, NULL, '285dnb0demflhc3n7sca0n95m2'),
(32, 0, 'adminkkk', '05fe7461c607c33229772d402505601016a7d0ea', '12323232323', '', NULL, NULL, NULL, NULL, 0, '0', NULL, NULL, '4odd8sfrcfacopn2j72c88qf64'),
(33, 0, 'wplee', '05fe7461c607c33229772d402505601016a7d0ea', '12323232328', '', '@user', NULL, NULL, NULL, 0, '0', NULL, NULL, '5buhd54rqajbajsfumkgr9ijb4'),
(34, 1, 'wplee127', '05fe7461c607c33229772d402505601016a7d0ea', '14523232323', '', NULL, NULL, NULL, NULL, 3, '123123', NULL, NULL, '8qgb5uv4h90s5vlsu1ddr8pr22'),
(35, 1, '123qwe', 'c53255317bb11707d0f614696b3ce6f221d0e2f2', '13434343434', '', 'filefromuser/2016/03/11/20160311074729915.jpg@user@user', NULL, NULL, NULL, 4, 'sdfsdfsdf', NULL, NULL, 'd6dr0opqrvgejc72khn3qoli91'),
(36, 1, 'weipinglee', '05fe7461c607c33229772d402505601016a7d0ea', '16767676767', '', 'filefromuser/2016/03/19/20160319100358393.jpg@user', 0, NULL, NULL, 4, '1233124', NULL, NULL, 'jf7uhru3pn5d7ge4r30tcubor3'),
(37, 0, 'geren', '05fe7461c607c33229772d402505601016a7d0ea', '14334343434', '', '', NULL, NULL, NULL, 0, '0', NULL, NULL, ''),
(39, 0, 'kljklj', '05fe7461c607c33229772d402505601016a7d0ea', '15454545454', '', NULL, NULL, NULL, NULL, 0, '0', NULL, NULL, 'ekp720eh5rqapk3ftfp87o3is5'),
(40, 0, 'kljlkjlkji', '05fe7461c607c33229772d402505601016a7d0ea', '14454545454', '', NULL, NULL, NULL, NULL, 0, '0', NULL, NULL, ''),
(41, 0, 'weimama', '05fe7461c607c33229772d402505601016a7d0ea', '12323232329', '', NULL, NULL, NULL, NULL, 0, '0', NULL, NULL, ''),
(42, 0, 'gerenyonghu', '7c4a8d09ca3762af61e59520943dc26494f8941b', '16767676760', '', 'filefromuser/2016/03/12/20160312193238190.png@user', 0, NULL, NULL, 0, '0', NULL, NULL, '84onn09tp27oicd5kf2mumjo77'),
(43, 0, 'weipine12', '05fe7461c607c33229772d402505601016a7d0ea', '15323232323', 'weeer@133.com', NULL, 36, NULL, NULL, 0, '', NULL, NULL, ''),
(44, 0, 'weiping12', '05fe7461c607c33229772d402505601016a7d0ea', '12345678945', '123@1234.com', NULL, 36, NULL, NULL, 0, '', NULL, NULL, ''),
(45, 0, 'weiping17', '05fe7461c607c33229772d402505601016a7d0ea', '17878654325', '123@1234.com', NULL, 36, NULL, NULL, 0, '', NULL, NULL, ''),
(46, 0, 'weipinglee1234', '601f1889667efaebb33b8c12572835da3f027f78', '13423564589', 'werewr@153.cid', NULL, 36, NULL, NULL, 0, '', NULL, NULL, ''),
(47, 0, 'weiping987', '7c4a8d09ca3762af61e59520943dc26494f8941b', '12398765439', 'werewr@153.cid', 'filefromuser/2016/03/19/20160319112602131.jpg@user', 36, NULL, 1, 0, '', NULL, NULL, '');

-- --------------------------------------------------------

--
-- 表的结构 `user_group`
--

CREATE TABLE IF NOT EXISTS `user_group` (
  `id` int(11) NOT NULL,
  `group_name` varchar(20) DEFAULT NULL COMMENT '会员组名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `user_session`
--

CREATE TABLE IF NOT EXISTS `user_session` (
  `session_id` varchar(255) NOT NULL,
  `session_expire` int(11) NOT NULL,
  `session_data` blob,
  UNIQUE KEY `session_id` (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user_session`
--

INSERT INTO `user_session` (`session_id`, `session_expire`, `session_data`) VALUES
('jf7uhru3pn5d7ge4r30tcubor3', 1459578255, 0x3a7365737344617461);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
