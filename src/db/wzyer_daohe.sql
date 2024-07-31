/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : wzyer_daohe

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2024-07-31 15:06:12
*/

SET FOREIGN_KEY_CHECKS=0;
CREATE DATABASE IF NOT EXISTS wzyer_daohe DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;
use wzyer_daohe;
-- ----------------------------
-- Table structure for admins
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `login_name` varchar(25) NOT NULL DEFAULT '',
  `login_password` varchar(255) NOT NULL DEFAULT '',
  `login_encrypt` varchar(10) NOT NULL DEFAULT '',
  `realname` varchar(20) NOT NULL DEFAULT '' COMMENT '真实姓名',
  `email` varchar(255) NOT NULL DEFAULT '',
  `disabled` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-enabled, 2-disabled',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `password_changed` date NOT NULL DEFAULT '0000-00-00',
  `super_user` tinyint(4) NOT NULL DEFAULT 2,
  `role_id` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of admins
-- ----------------------------
INSERT INTO `admins` VALUES ('25', 'admin', 'c32dade41b102edfb3f5746cc8179f7b', 'xkvulT', '超级管理员', 'admin@sohu.com', '1', '2021-07-27 16:25:30', '2024-07-31 11:40:49', '0000-00-00', '1', '0');

-- ----------------------------
-- Table structure for admin_role
-- ----------------------------
DROP TABLE IF EXISTS `admin_role`;
CREATE TABLE `admin_role` (
  `role_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of admin_role
-- ----------------------------
INSERT INTO `admin_role` VALUES ('33', '基金经理', '');

-- ----------------------------
-- Table structure for admin_role_menu
-- ----------------------------
DROP TABLE IF EXISTS `admin_role_menu`;
CREATE TABLE `admin_role_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned DEFAULT 0,
  `menu_id` int(10) unsigned DEFAULT 0,
  `type` tinyint(3) unsigned NOT NULL DEFAULT 1 COMMENT '1:只读,2:读写',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2458 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of admin_role_menu
-- ----------------------------

-- ----------------------------
-- Table structure for attachments
-- ----------------------------
DROP TABLE IF EXISTS `attachments`;
CREATE TABLE `attachments` (
  `attachment_id` int(11) NOT NULL AUTO_INCREMENT,
  `attachment_type` int(11) NOT NULL DEFAULT 1,
  `external_id` int(11) NOT NULL DEFAULT 0 COMMENT '关联外键',
  `external_id2` int(11) NOT NULL DEFAULT 0 COMMENT '关联外键2',
  `pid` int(11) NOT NULL DEFAULT 0 COMMENT '上级id',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=正常，-1=删除',
  `original_name` varchar(255) NOT NULL DEFAULT '',
  `save_name` varchar(255) NOT NULL DEFAULT '',
  `mime_type` varchar(255) NOT NULL DEFAULT '',
  `description` text DEFAULT NULL,
  `size` int(11) NOT NULL DEFAULT 0,
  `attachment_category_id` int(11) NOT NULL DEFAULT 0,
  `isdir` tinyint(4) NOT NULL DEFAULT 0 COMMENT '是否文件夹',
  `entered` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL DEFAULT 0,
  `user_type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '用户类型',
  PRIMARY KEY (`attachment_id`),
  KEY `idx_eid_type` (`external_id`,`attachment_type`),
  KEY `idx_user` (`user_id`,`user_type`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=7647 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of attachments
-- ----------------------------
INSERT INTO `attachments` VALUES ('7629', '8', '2', '0', '0', '1', '浙江精劲机械有限公司二期_2020_04.docx', '20220311\\67f61cad4a6e9c21e2b782415807ba54.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', '', '1562888', '0', '0', '2022-03-11 16:46:04', '25', '1');
INSERT INTO `attachments` VALUES ('7630', '29', '73', '0', '0', '1', 'gzh.pdf.doc', '20220311\\61f9468f6c826bff0d5dbe022e38b0e1.doc', 'application/msword', '', '12288', '0', '0', '2022-03-11 17:23:58', '25', '1');
INSERT INTO `attachments` VALUES ('7631', '30', '73', '0', '0', '1', 'gzh.pdf (1).doc', '20220311\\60260a2f49fc164fe70faf18c919e42a.doc', 'application/msword', '', '12288', '0', '0', '2022-03-11 17:24:04', '25', '1');
INSERT INTO `attachments` VALUES ('7632', '3', '517', '0', '0', '1', '深圳市为之易文化传播有限公司租赁合同.docx', '20220311\\5115c0a386d4af4600f788945e29d88f.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', '', '22394', '0', '0', '2022-03-11 17:33:01', '25', '1');
INSERT INTO `attachments` VALUES ('7633', '3', '518', '0', '0', '1', 'TB2YM_OaVXXXXbpXXXXXXXXXXXX-2048829272.jpg', '20220428\\1d8fd17c69c63842895193e9a96ec053.jpg', 'image/jpeg', '', '224497', '0', '0', '2022-04-28 15:46:02', '25', '1');
INSERT INTO `attachments` VALUES ('7634', '21', '518', '0', '0', '1', 'TB2jg_MaVXXXXXtXpXXXXXXXXXX-2048829272.jpg', '20220428\\6480f71543f1312ecc7780550cec3db8.jpg', 'image/jpeg', '', '177776', '0', '0', '2022-04-28 15:46:14', '25', '1');
INSERT INTO `attachments` VALUES ('7635', '4', '518', '0', '0', '1', 'TB2jg_MaVXXXXXtXpXXXXXXXXXX-2048829272.jpg', '20220428\\db66802af2c94aaa84e73956902acc0d.jpg', 'image/jpeg', '', '177776', '0', '0', '2022-04-28 15:46:37', '25', '1');
INSERT INTO `attachments` VALUES ('7636', '100', '31', '0', '0', '1', 'TB2YM_OaVXXXXbpXXXXXXXXXXXX-2048829272.jpg', '20220428\\a8d6634a11791de6581178edc5bd50b9.jpg', 'image/jpeg', '', '224497', '0', '0', '2022-04-28 16:53:03', '25', '1');
INSERT INTO `attachments` VALUES ('7637', '8', '3', '0', '0', '1', '20170112 储能项目讨论（晴天）.pdf', '20220504\\abba0f68ca17d9ecc45ef216fc1b6283.pdf', 'application/pdf', '', '3389489', '0', '0', '2022-05-04 14:03:20', '25', '1');
INSERT INTO `attachments` VALUES ('7638', '8', '3', '0', '0', '1', 'DTU AT指令.pdf', '20220504\\bff2e867e6af9ea3be3c890bd68c84a4.pdf', 'application/pdf', '', '2524716', '0', '0', '2022-05-04 14:21:34', '25', '1');
INSERT INTO `attachments` VALUES ('7639', '8', '3', '0', '0', '1', 'api2.png', '20220504\\f8e55c32d94c18392c23cede3246ac6c.png', 'image/png', '', '53749', '0', '0', '2022-05-04 14:22:15', '25', '1');
INSERT INTO `attachments` VALUES ('7640', '29', '0', '0', '0', '1', 'DTU技术资料.pdf', '20220504\\06297f6d5126260c3412a40553e5484f.pdf', 'application/pdf', '', '548688', '0', '0', '2022-05-04 14:30:41', '25', '1');
INSERT INTO `attachments` VALUES ('7641', '30', '0', '0', '0', '1', 'sms.xlsx', '20220504\\634e33f1ac033fef12387968db1c499f.xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', '', '11129', '0', '0', '2022-05-04 14:30:51', '25', '1');
INSERT INTO `attachments` VALUES ('7642', '145', '60', '0', '0', '1', '20170112 储能项目讨论（晴天）.pdf', '20220516\\d0fc48c0a5149d26b2edcec7c8797530.pdf', 'application/pdf', '', '3389489', '0', '0', '2022-05-16 11:15:33', '25', '1');
INSERT INTO `attachments` VALUES ('7643', '145', '61', '0', '0', '1', '小微电站02月运维报告-嘉兴市华虹.docx', '20220516\\d9d47b7f2b5eb81d474a12e7db0a1fdd.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', '', '46821', '0', '0', '2022-05-16 11:15:53', '25', '1');
INSERT INTO `attachments` VALUES ('7644', '145', '61', '0', '0', '1', 'sms.xlsx', '20220516\\4d5792bec5a51dfb9918af4ae4f72970.xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', '', '11129', '0', '0', '2022-05-16 14:19:23', '25', '1');
INSERT INTO `attachments` VALUES ('7645', '28', '518', '88', '0', '1', '20180721.jpg', '20220527\\a0eb6c02abcf84cd0563a9f41d91f37f.jpg', 'image/jpeg', '', '3842127', '0', '0', '2022-05-27 15:09:01', '25', '1');
INSERT INTO `attachments` VALUES ('7646', '250', '333', '0', '0', '1', 'app_welcome.png', '20220530\\2d3fd03c8f908547be2bd8fc30547168.png', 'image/png', '', '686175', '0', '0', '2022-05-30 18:29:20', '25', '1');

-- ----------------------------
-- Table structure for attachment_categories
-- ----------------------------
DROP TABLE IF EXISTS `attachment_categories`;
CREATE TABLE `attachment_categories` (
  `attachment_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `attachment_type` int(11) NOT NULL DEFAULT 1,
  `attachment_category` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`attachment_category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=197 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of attachment_categories
-- ----------------------------

-- ----------------------------
-- Table structure for audit_logs
-- ----------------------------
DROP TABLE IF EXISTS `audit_logs`;
CREATE TABLE `audit_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `model` varchar(40) NOT NULL DEFAULT '',
  `record_id` int(11) NOT NULL DEFAULT 0,
  `fields` varchar(255) NOT NULL DEFAULT '',
  `desc` text NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-add, 2-update, 3-delete',
  `ip` varchar(20) NOT NULL DEFAULT '',
  `device` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-computer, 2-mobile',
  `changed_by` int(11) NOT NULL DEFAULT 0,
  `changed_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `idx_m_id` (`model`,`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8190 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of audit_logs
-- ----------------------------
INSERT INTO `audit_logs` VALUES ('8165', 'Attachments', '0', '|original_name|description|attachment_type|', '新增：{\"原文件名\":\"浙江精劲机械有限公司二期_2020_04.docx\",\"描述\":\"\",\"文件类别\":\"创始人附件\"}', '1', '127.0.0.1', '1', '25', '2022-03-11 16:46:04');
INSERT INTO `audit_logs` VALUES ('8166', 'Attachments', '73', '|original_name|description|attachment_type|', '新增：{\"原文件名\":\"gzh.pdf.doc\",\"描述\":\"\",\"文件类别\":\"招股说明书\"}', '1', '127.0.0.1', '1', '25', '2022-03-11 17:23:58');
INSERT INTO `audit_logs` VALUES ('8167', 'Attachments', '73', '|original_name|description|attachment_type|', '新增：{\"原文件名\":\"gzh.pdf (1).doc\",\"描述\":\"\",\"文件类别\":\"研究报告\"}', '1', '127.0.0.1', '1', '25', '2022-03-11 17:24:05');
INSERT INTO `audit_logs` VALUES ('8168', 'Enterprises', '517', '|name|description|', '新增：{\"企业名称\":\"小数点科技\",\"企业描述\":\"小数点科技股份有限公司是2004年成立的一家依靠自主研发的应用软件系统公司，重点面向中国中小企业客户，提供企业邮箱、电子商务网站建设、网络域名、办公自动化系统（OA）、客户关系管理系统（CRM）、云办公系统等软件产品及服务的专业\"}', '1', '127.0.0.1', '1', '25', '2022-03-11 17:27:26');
INSERT INTO `audit_logs` VALUES ('8169', 'Attachments', '517', '|original_name|description|attachment_type|', '新增：{\"原文件名\":\"深圳市为之易文化传播有限公司租赁合同.docx\",\"描述\":\"\",\"文件类别\":\"商业计划书\"}', '1', '127.0.0.1', '1', '25', '2022-03-11 17:33:01');
INSERT INTO `audit_logs` VALUES ('8170', 'Enterprises', '518', '|name|description|', '新增：{\"企业名称\":\"金钥匙大数据公司\",\"企业描述\":\"金钥匙集团是一家以金融投资为核心,战略布局实业、金融、互联网科技、文化传媒四大产业,投资涵盖房地产、市政工程、新能源、大健康、阳光私募、量化投资、FOF基金、供应链金融、股权投资.\"}', '1', '127.0.0.1', '1', '25', '2022-04-22 12:20:31');
INSERT INTO `audit_logs` VALUES ('8171', 'Attachments', '518', '|original_name|description|attachment_type|', '新增：{\"原文件名\":\"TB2YM_OaVXXXXbpXXXXXXXXXXXX-2048829272.jpg\",\"描述\":\"\",\"文件类别\":\"商业计划书\"}', '1', '127.0.0.1', '1', '25', '2022-04-28 15:46:02');
INSERT INTO `audit_logs` VALUES ('8172', 'Attachments', '518', '|original_name|description|attachment_type|', '新增：{\"原文件名\":\"TB2jg_MaVXXXXXtXpXXXXXXXXXX-2048829272.jpg\",\"描述\":\"\",\"文件类别\":\"创始团队\"}', '1', '127.0.0.1', '1', '25', '2022-04-28 15:46:14');
INSERT INTO `audit_logs` VALUES ('8173', 'Attachments', '518', '|original_name|description|attachment_type|', '新增：{\"原文件名\":\"TB2jg_MaVXXXXXtXpXXXXXXXXXX-2048829272.jpg\",\"描述\":\"\",\"文件类别\":\"财务\"}', '1', '127.0.0.1', '1', '25', '2022-04-28 15:46:37');
INSERT INTO `audit_logs` VALUES ('8174', 'Funds', '31', '|name|reg_place|size|partnership_start_date|partnership_end_date|establish_date|invest_period|invest_fee_ratio|exit_period|exit_fee_ratio|extend_period|', '新增：{\"基金名称\":\"幸福1号\",\"基金注册地\":\"zzzzzz\",\"认缴规模\":0,\"合伙企业设立日期\":\"0000-00-00 00:00:00\",\"合伙企业终止日期\":\"0000-00-00 00:00:00\",\"备案成立日期\":\"0000-00-00 00:00:00\",\"基金投资期\":0,\"投资期管理费率\":0,\"基金退出期\":0,\"退出期管理费率\":0,\"基金延长期\":0}', '1', '127.0.0.1', '1', '25', '2022-04-28 16:52:25');
INSERT INTO `audit_logs` VALUES ('8175', 'Attachments', '31', '|original_name|description|attachment_type|', '新增：{\"原文件名\":\"TB2YM_OaVXXXXbpXXXXXXXXXXXX-2048829272.jpg\",\"描述\":\"\",\"文件类别\":\"基金合伙人协议\"}', '1', '127.0.0.1', '1', '25', '2022-04-28 16:53:03');
INSERT INTO `audit_logs` VALUES ('8176', 'Attachments', '3', '|original_name|description|attachment_type|', '新增：{\"原文件名\":\"20170112 储能项目讨论（晴天）.pdf\",\"描述\":\"\",\"文件类别\":\"创始人附件\"}', '1', '127.0.0.1', '2', '25', '2022-05-04 14:03:20');
INSERT INTO `audit_logs` VALUES ('8177', 'Attachments', '3', '|original_name|description|attachment_type|', '新增：{\"原文件名\":\"DTU AT指令.pdf\",\"描述\":\"\",\"文件类别\":\"创始人附件\"}', '1', '127.0.0.1', '2', '25', '2022-05-04 14:21:34');
INSERT INTO `audit_logs` VALUES ('8178', 'Attachments', '3', '|original_name|description|attachment_type|', '新增：{\"原文件名\":\"api2.png\",\"描述\":\"\",\"文件类别\":\"创始人附件\"}', '1', '127.0.0.1', '2', '25', '2022-05-04 14:22:15');
INSERT INTO `audit_logs` VALUES ('8179', 'Attachments', '0', '|original_name|description|attachment_type|', '新增：{\"原文件名\":\"DTU技术资料.pdf\",\"描述\":\"\",\"文件类别\":\"招股说明书\"}', '1', '127.0.0.1', '2', '25', '2022-05-04 14:30:41');
INSERT INTO `audit_logs` VALUES ('8180', 'Attachments', '0', '|original_name|description|attachment_type|', '新增：{\"原文件名\":\"sms.xlsx\",\"描述\":\"\",\"文件类别\":\"研究报告\"}', '1', '127.0.0.1', '2', '25', '2022-05-04 14:30:51');
INSERT INTO `audit_logs` VALUES ('8181', 'Partners', '65', '|name|tel|email|address|type|credential_type|credential_no|', '新增：{\"姓名\":\"马化腾\",\"电话\":\"13530531212\",\"电子邮箱\":\"\",\"地址\":\"\",\"类型\":\"个人有限合伙人\",\"证件类型\":\"身份证\",\"证件号码\":\"\"}', '1', '127.0.0.1', '1', '25', '2022-05-16 10:59:28');
INSERT INTO `audit_logs` VALUES ('8182', 'Attachments', '0', '|original_name|description|attachment_type|', '新增：{\"原文件名\":\"20170112 储能项目讨论（晴天）.pdf\",\"描述\":\"\",\"文件类别\":\"基金日常维护附件\"}', '1', '127.0.0.1', '1', '25', '2022-05-16 11:15:33');
INSERT INTO `audit_logs` VALUES ('8183', 'ChangeLogs', '31', '|desc|category|change_date|from_date|end_date|', '新增：{\"描述\":\"zzzzzzzzzz\",\"类别\":\"基金管理-报告\",\"日期\":\"0000-00-00\",\"所属开始日期\":\"2022-01-01\",\"所属结束日期\":\"2022-03-01\"}', '1', '127.0.0.1', '1', '25', '2022-05-16 11:15:35');
INSERT INTO `audit_logs` VALUES ('8184', 'Attachments', '0', '|original_name|description|attachment_type|', '新增：{\"原文件名\":\"小微电站02月运维报告-嘉兴市华虹.docx\",\"描述\":\"\",\"文件类别\":\"基金日常维护附件\"}', '1', '127.0.0.1', '1', '25', '2022-05-16 11:15:53');
INSERT INTO `audit_logs` VALUES ('8185', 'ChangeLogs', '31', '|desc|category|change_date|from_date|end_date|', '新增：{\"描述\":\"aaaaaaa\",\"类别\":\"基金管理-报告\",\"日期\":\"0000-00-00\",\"所属开始日期\":\"2022-05-01\",\"所属结束日期\":\"2022-05-31\"}', '1', '127.0.0.1', '1', '25', '2022-05-16 11:15:56');
INSERT INTO `audit_logs` VALUES ('8186', 'Attachments', '61', '|original_name|description|attachment_type|', '新增：{\"原文件名\":\"sms.xlsx\",\"描述\":\"\",\"文件类别\":\"基金日常维护附件\"}', '1', '127.0.0.1', '1', '25', '2022-05-16 14:19:24');
INSERT INTO `audit_logs` VALUES ('8187', 'Attachments', '518', '|original_name|description|attachment_type|', '新增：{\"原文件名\":\"20180721.jpg\",\"描述\":\"\",\"文件类别\":\"投决会资料\"}', '1', '127.0.0.1', '1', '25', '2022-05-27 15:09:01');
INSERT INTO `audit_logs` VALUES ('8188', 'Attachments', '0', '|original_name|description|attachment_type|', '新增：{\"原文件名\":\"app_welcome.png\",\"描述\":\"\",\"文件类别\":\"\"}', '1', '127.0.0.1', '1', '25', '2022-05-30 18:29:20');
INSERT INTO `audit_logs` VALUES ('8189', 'FundsCollect', '31', '|filing_no|filing_info|', '新增：{\"备案号\":\"\",\"备案备注\":\"\"}', '1', '127.0.0.1', '1', '25', '2022-05-31 16:57:42');

-- ----------------------------
-- Table structure for change_logs
-- ----------------------------
DROP TABLE IF EXISTS `change_logs`;
CREATE TABLE `change_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `external_id` int(11) NOT NULL DEFAULT 0,
  `category` tinyint(4) NOT NULL DEFAULT 1,
  `desc` text NOT NULL,
  `change_date` date NOT NULL DEFAULT '0000-00-00',
  `from_date` date NOT NULL DEFAULT '0000-00-00',
  `end_date` date NOT NULL DEFAULT '0000-00-00',
  `entered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of change_logs
-- ----------------------------
INSERT INTO `change_logs` VALUES ('60', '31', '4', 'zzzzzzzzzz', '0000-00-00', '2022-01-01', '2022-03-01', '2022-05-16 11:15:35', '2022-05-16 11:15:35');
INSERT INTO `change_logs` VALUES ('61', '31', '4', 'aaaaaaa', '0000-00-00', '2022-05-01', '2022-05-31', '2022-05-16 11:15:56', '2022-05-16 11:15:56');

-- ----------------------------
-- Table structure for companies
-- ----------------------------
DROP TABLE IF EXISTS `companies`;
CREATE TABLE `companies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `province` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `controller` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '实际控制人',
  `forms` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '企业所有制性质',
  `introduction` varchar(400) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '公司简介',
  `chairman` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '董事长',
  `established_date` date DEFAULT NULL COMMENT '成立日期',
  `reg_asset` varchar(20) DEFAULT NULL COMMENT '注册资本',
  `listed_date` date DEFAULT NULL COMMENT '上市日期',
  `website` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '公司网址',
  `assigner` int(11) NOT NULL DEFAULT 0 COMMENT '跟进人',
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL COMMENT '录入人',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=74 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of companies
-- ----------------------------
INSERT INTO `companies` VALUES ('73', '三五互联', '福建', '王五', '私企', '三五互联科技股份有限公司是2004年成立的一家依靠自主研发的应用软件系统公司，重点面向中国中小企业客户，提供企业邮箱、电子商务网站建设、网络域名、办公自动化系统（OA）、客户关系管理系统（CRM）、云办公系统等软件产品及服务的专业公司', '王五', '2010-03-01', '1000万', '2022-03-01', '', '25', '2022-03-11 17:23:32', '25');

-- ----------------------------
-- Table structure for config_business_reg_proxy
-- ----------------------------
DROP TABLE IF EXISTS `config_business_reg_proxy`;
CREATE TABLE `config_business_reg_proxy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `linkman` varchar(255) NOT NULL DEFAULT '',
  `tel` varchar(255) NOT NULL DEFAULT '',
  `entered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of config_business_reg_proxy
-- ----------------------------

-- ----------------------------
-- Table structure for config_fund_hosting_agency
-- ----------------------------
DROP TABLE IF EXISTS `config_fund_hosting_agency`;
CREATE TABLE `config_fund_hosting_agency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `linkman` varchar(255) NOT NULL DEFAULT '',
  `tel` varchar(255) NOT NULL DEFAULT '',
  `entered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of config_fund_hosting_agency
-- ----------------------------

-- ----------------------------
-- Table structure for config_scientist_field
-- ----------------------------
DROP TABLE IF EXISTS `config_scientist_field`;
CREATE TABLE `config_scientist_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `entered` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of config_scientist_field
-- ----------------------------
INSERT INTO `config_scientist_field` VALUES ('14', '人工智能', '2022-03-11 17:28:30');
INSERT INTO `config_scientist_field` VALUES ('15', '汽车', '2022-03-11 17:28:37');

-- ----------------------------
-- Table structure for contacts
-- ----------------------------
DROP TABLE IF EXISTS `contacts`;
CREATE TABLE `contacts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `username` varchar(20) NOT NULL DEFAULT '' COMMENT '登录账号',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '登录密码',
  `assigner` varchar(60) NOT NULL DEFAULT '' COMMENT '主跟进人',
  `additional_assigners` varchar(60) NOT NULL DEFAULT '' COMMENT '辅助跟进人',
  `gender` char(4) NOT NULL DEFAULT '',
  `photo` varchar(100) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
  `contact` varchar(100) NOT NULL DEFAULT '' COMMENT '联系方式',
  `email` varchar(60) NOT NULL DEFAULT '',
  `education` varchar(200) NOT NULL DEFAULT '',
  `work_exp` varchar(200) NOT NULL DEFAULT '',
  `age` tinyint(3) unsigned DEFAULT NULL,
  `description` text DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` char(36) NOT NULL DEFAULT '',
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_del_id_user` (`deleted`,`id`,`assigner`),
  KEY `idx_cont_assigned` (`assigner`),
  KEY `idx_username` (`deleted`,`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='联系人';

-- ----------------------------
-- Records of contacts
-- ----------------------------
INSERT INTO `contacts` VALUES ('2', '贾跃亭', '', '', '25', '', '', '', '法拉第汽车', '13500000000', '', '', '', null, '乐视创始人', '0', '25', '2022-03-11 16:46:06');
INSERT INTO `contacts` VALUES ('3', '逍遥', '', '', '25', '', '', '', '创始人', '13252632563', '', '', '', null, 'dddddddddddddddddddddddddddss\r\nds\r\n\r\nsdd', '0', '25', '2022-03-11 17:27:25');
INSERT INTO `contacts` VALUES ('4', '马花花', '', '', '25', '', '', '', '创始人', '13500000000', '', '', '', null, null, '0', '25', '2022-04-22 12:20:30');

-- ----------------------------
-- Table structure for dropdowns
-- ----------------------------
DROP TABLE IF EXISTS `dropdowns`;
CREATE TABLE `dropdowns` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `field` varchar(40) NOT NULL,
  `items` text DEFAULT NULL COMMENT 'json数据',
  `description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_unique_name` (`field`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of dropdowns
-- ----------------------------
INSERT INTO `dropdowns` VALUES ('6', 'enterprise_lead_source', '[{\"label\":\"现有客户\",\"value\":\"现有客户\"},{\"label\":\"产业合伙人\",\"value\":\"产业合伙人\"},{\"label\":\"产业伙伴\",\"value\":\"产业伙伴\"},{\"label\":\"投资合伙人\",\"value\":\"投资合伙人\"},{\"label\":\"市场研究\",\"value\":\"市场研究\"},{\"label\":\"美国伙伴\",\"value\":\"美国伙伴\"}]', '项目来源');
INSERT INTO `dropdowns` VALUES ('7', 'financing_stage', '[{\"label\":\"种子轮\",\"value\":\"1\"},{\"label\":\"天使轮\",\"value\":\"2\"},{\"label\":\"Pre-A轮\",\"value\":\"3\"},{\"label\":\"A轮\",\"value\":\"4\"},{\"label\":\"B轮\",\"value\":\"5\"},{\"label\":\"C轮\",\"value\":\"6\"},{\"label\":\"C+轮\",\"value\":\"7\"},{\"label\":\"B+轮\",\"value\":\"8\"},{\"label\":\"A+轮\",\"value\":\"9\"},{\"label\":\"Pre-IPO\",\"value\":\"10\"},{\"label\":\"老股转让\",\"value\":\"11\"}]', '融资阶段');

-- ----------------------------
-- Table structure for enterprises
-- ----------------------------
DROP TABLE IF EXISTS `enterprises`;
CREATE TABLE `enterprises` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL DEFAULT 0,
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  `step` tinyint(3) unsigned NOT NULL DEFAULT 1,
  `step_state` tinyint(4) NOT NULL DEFAULT 0,
  `founder` int(11) NOT NULL DEFAULT 0 COMMENT '创始人',
  `assigner` varchar(60) NOT NULL DEFAULT '' COMMENT '主跟进人',
  `additional_assigners` varchar(60) NOT NULL DEFAULT '' COMMENT '辅助跟进人',
  `name` varchar(60) NOT NULL COMMENT '企业名称',
  `logo` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(20) NOT NULL DEFAULT '' COMMENT '简称',
  `industry` varchar(100) NOT NULL DEFAULT '' COMMENT '所属行业',
  `istop` tinyint(4) NOT NULL DEFAULT 0 COMMENT '是否置顶',
  `lead_source` varchar(20) NOT NULL DEFAULT '' COMMENT '项目来源',
  `address` varchar(100) NOT NULL DEFAULT '' COMMENT '公司地址',
  `description` text DEFAULT NULL,
  `productions_technologies` text DEFAULT NULL,
  `financing_stage` tinyint(4) NOT NULL DEFAULT 0 COMMENT '融资阶段',
  `initial_valuation` bigint(20) DEFAULT NULL COMMENT '初始估值',
  `latest_valuation` bigint(20) DEFAULT NULL COMMENT '最新估值',
  `relate_enterprises` varchar(100) NOT NULL DEFAULT '' COMMENT '关联辅助项目',
  `scientist_id` int(11) NOT NULL DEFAULT 0 COMMENT '关联科学家',
  `relate_companies` varchar(100) NOT NULL DEFAULT '' COMMENT '关联上市公司',
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '最后修改时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=519 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of enterprises
-- ----------------------------
INSERT INTO `enterprises` VALUES ('517', '2022-03-11 17:27:26', '25', '0', '5', '0', '3', '25', '', '小数点科技', '', '', '', '0', '', '山东省济南市', '小数点科技股份有限公司是2004年成立的一家依靠自主研发的应用软件系统公司，重点面向中国中小企业客户，提供企业邮箱、电子商务网站建设、网络域名、办公自动化系统（OA）、客户关系管理系统（CRM）、云办公系统等软件产品及服务的专业', null, '0', null, null, '', '0', '73', '2022-05-30 18:12:02');
INSERT INTO `enterprises` VALUES ('518', '2022-04-22 12:20:31', '25', '0', '3', '-1', '4', '25', '', '金钥匙大数据公司', '/upload/20220422/362fc98c285e1ff397f62b1eb62cd4e2.jpeg', '金钥匙', '', '-1', '', '中国北京', '金钥匙集团是一家以金融投资为核心,战略布局实业、金融、互联网科技、文化传媒四大产业,投资涵盖房地产、市政工程、新能源、大健康、阳光私募、量化投资、FOF基金、供应链金融、股权投资.', null, '0', null, null, '517,518', '0', '', '2022-05-13 16:48:04');

-- ----------------------------
-- Table structure for enterprises_dividends
-- ----------------------------
DROP TABLE IF EXISTS `enterprises_dividends`;
CREATE TABLE `enterprises_dividends` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `enterprise_id` int(11) NOT NULL COMMENT '企业ID',
  `type` tinyint(4) NOT NULL DEFAULT 0,
  `date` date NOT NULL COMMENT '发生时间',
  `amount` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '金额',
  `remark` varchar(200) DEFAULT '',
  `json` varchar(1024) DEFAULT '' COMMENT 'json业务数据',
  `date_entered` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `enterprise_id` (`enterprise_id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='项目分红';

-- ----------------------------
-- Records of enterprises_dividends
-- ----------------------------

-- ----------------------------
-- Table structure for enterprises_dividends_partners
-- ----------------------------
DROP TABLE IF EXISTS `enterprises_dividends_partners`;
CREATE TABLE `enterprises_dividends_partners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ffi_id` int(11) NOT NULL DEFAULT 0,
  `p_id` int(11) NOT NULL DEFAULT 0,
  `amount` decimal(18,2) NOT NULL,
  `fee` decimal(18,2) NOT NULL DEFAULT 0.00,
  `tax` decimal(18,2) NOT NULL DEFAULT 0.00,
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `ffi_id` (`ffi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of enterprises_dividends_partners
-- ----------------------------

-- ----------------------------
-- Table structure for enterprises_financing
-- ----------------------------
DROP TABLE IF EXISTS `enterprises_financing`;
CREATE TABLE `enterprises_financing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `enterprise_id` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1=投资稀释，2=股权转让',
  `title` varchar(128) NOT NULL DEFAULT '' COMMENT '标题',
  `esid` int(11) NOT NULL DEFAULT 0 COMMENT '股东表id',
  `amount` bigint(20) NOT NULL COMMENT '金额合计（元）',
  `valuation` bigint(20) NOT NULL COMMENT '最新估值（元）',
  `when` date NOT NULL DEFAULT '0000-00-00' COMMENT '发生时间',
  `date_entered` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `enterprise_id` (`enterprise_id`)
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='企业股权变更记录表';

-- ----------------------------
-- Records of enterprises_financing
-- ----------------------------

-- ----------------------------
-- Table structure for enterprises_founders
-- ----------------------------
DROP TABLE IF EXISTS `enterprises_founders`;
CREATE TABLE `enterprises_founders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `enterprise_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `enterprise_id` (`enterprise_id`,`contact_id`),
  KEY `contact_id` (`contact_id`)
) ENGINE=MyISAM AUTO_INCREMENT=555 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='企业创始团队';

-- ----------------------------
-- Records of enterprises_founders
-- ----------------------------
INSERT INTO `enterprises_founders` VALUES ('553', '517', '3');
INSERT INTO `enterprises_founders` VALUES ('554', '518', '4');

-- ----------------------------
-- Table structure for enterprise_shareholder
-- ----------------------------
DROP TABLE IF EXISTS `enterprise_shareholder`;
CREATE TABLE `enterprise_shareholder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eid` int(11) NOT NULL COMMENT '企业id',
  `efid` int(11) NOT NULL DEFAULT 0 COMMENT '关联融资表id',
  `date` date NOT NULL DEFAULT '0000-00-00' COMMENT '股东表日期',
  `name` varchar(40) NOT NULL DEFAULT '' COMMENT '标题',
  `date_entered` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `eid` (`eid`)
) ENGINE=MyISAM AUTO_INCREMENT=99 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='企业股东表';

-- ----------------------------
-- Records of enterprise_shareholder
-- ----------------------------

-- ----------------------------
-- Table structure for enterprise_shareholder_detail
-- ----------------------------
DROP TABLE IF EXISTS `enterprise_shareholder_detail`;
CREATE TABLE `enterprise_shareholder_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `esid` int(11) NOT NULL COMMENT '股东表id',
  `name` varchar(100) NOT NULL COMMENT '股东名称',
  `reg_asset` bigint(20) unsigned DEFAULT NULL COMMENT '注册资本（元）',
  `investment` bigint(20) unsigned DEFAULT NULL COMMENT '投资金额（元）',
  `stock_total` bigint(20) unsigned DEFAULT NULL COMMENT '持股份数（股）',
  `stock_ratio` decimal(6,3) unsigned NOT NULL COMMENT '持股比例',
  PRIMARY KEY (`id`),
  KEY `esid` (`esid`)
) ENGINE=MyISAM AUTO_INCREMENT=1490 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of enterprise_shareholder_detail
-- ----------------------------

-- ----------------------------
-- Table structure for event_logs
-- ----------------------------
DROP TABLE IF EXISTS `event_logs`;
CREATE TABLE `event_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_type` tinyint(4) NOT NULL COMMENT '对象类型',
  `entity_id` int(11) NOT NULL COMMENT '对象id',
  `content` text NOT NULL COMMENT '日志内容',
  `json` text DEFAULT NULL COMMENT '业务数据',
  `text` text NOT NULL,
  `uid` int(11) NOT NULL,
  `realname` varchar(20) DEFAULT NULL,
  `ctime` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1238 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of event_logs
-- ----------------------------
INSERT INTO `event_logs` VALUES ('1225', '4', '2', '<ENTITY>贾跃亭</ENTITY>新增标签', '{\"tag_id\":[\"163\"]}', '', '25', '超级管理员', '2022-03-11 16:46:06');
INSERT INTO `event_logs` VALUES ('1226', '7', '73', '', '', '上传招股说明书 <a href=\"javascript:void(0)\" onclick=\"QT.filePreview(7630)\">gzh.pdf.doc</a><br />上传研究报告 <a href=\"javascript:void(0)\" onclick=\"QT.filePreview(7631)\">gzh.pdf (1).doc</a>', '25', '超级管理员', '2022-03-11 17:23:58');
INSERT INTO `event_logs` VALUES ('1227', '1', '517', '', '', '新增<br />上传商业计划书 <a href=\"javascript:void(0)\" onclick=\"QT.filePreview(7632)\">深圳市为之易文化传播有限公司租赁合同.docx</a>', '25', '超级管理员', '2022-03-11 17:27:26');
INSERT INTO `event_logs` VALUES ('1228', '1', '517', '<ENTITY>小数点科技</ENTITY>新增标签', '{\"tag_id\":[\"168\"]}', '', '25', '超级管理员', '2022-03-11 17:49:07');
INSERT INTO `event_logs` VALUES ('1229', '1', '517', '<ENTITY>小数点科技</ENTITY>新增标签', '{\"tag_id\":[\"164\",\"165\",\"166\",\"167\"]}', '', '25', '超级管理员', '2022-03-11 17:49:17');
INSERT INTO `event_logs` VALUES ('1230', '1', '518', '', '', '上传商业计划书 <a href=\"javascript:void(0)\" onclick=\"QT.filePreview(7633)\">TB2YM_OaVXXXXbpXXXXXXXXXXXX-2048829272.jpg</a><br />上传创始团队 <a href=\"javascript:void(0)\" onclick=\"QT.filePreview(7634)\">TB2jg_MaVXXXXXtXpXXXXXXXXXX-2048829272.jpg</a><br />上传财务 <a href=\"javascript:void(0)\" onclick=\"QT.filePreview(7635)\">TB2jg_MaVXXXXXtXpXXXXXXXXXX-2048829272.jpg</a>', '25', '超级管理员', '2022-04-22 12:20:31');
INSERT INTO `event_logs` VALUES ('1231', '1', '518', '', '', '上传商业计划书 <a href=\"javascript:void(0)\" onclick=\"QT.filePreview(7633)\">TB2YM_OaVXXXXbpXXXXXXXXXXXX-2048829272.jpg</a><br />上传创始团队 <a href=\"javascript:void(0)\" onclick=\"QT.filePreview(7634)\">TB2jg_MaVXXXXXtXpXXXXXXXXXX-2048829272.jpg</a><br />上传财务 <a href=\"javascript:void(0)\" onclick=\"QT.filePreview(7635)\">TB2jg_MaVXXXXXtXpXXXXXXXXXX-2048829272.jpg</a>', '25', '超级管理员', '2022-04-28 15:46:02');
INSERT INTO `event_logs` VALUES ('1232', '2', '31', '', '', '新增<br />上传基金合伙人协议 <a href=\"javascript:void(0)\" onclick=\"QT.filePreview(7636)\">TB2YM_OaVXXXXbpXXXXXXXXXXXX-2048829272.jpg</a>', '25', '超级管理员', '2022-04-28 16:52:25');
INSERT INTO `event_logs` VALUES ('1233', '4', '3', '', '', '上传创始人附件 <a href=\"javascript:void(0)\" onclick=\"QT.filePreview(7638)\">DTU AT指令.pdf</a><br />上传创始人附件 <a href=\"javascript:void(0)\" onclick=\"QT.filePreview(7639)\">api2.png</a>', '25', '超级管理员', '2022-05-04 14:03:20');
INSERT INTO `event_logs` VALUES ('1234', '4', '3', '', '', '上传创始人附件 <a href=\"javascript:void(0)\" onclick=\"QT.filePreview(7638)\">DTU AT指令.pdf</a><br />上传创始人附件 <a href=\"javascript:void(0)\" onclick=\"QT.filePreview(7639)\">api2.png</a>', '25', '超级管理员', '2022-05-04 14:21:34');
INSERT INTO `event_logs` VALUES ('1235', '4', '3', '<ENTITY>逍遥子</ENTITY>新增标签', '{\"tag_id\":[\"162\"]}', '', '25', '超级管理员', '2022-05-04 14:23:12');
INSERT INTO `event_logs` VALUES ('1236', '2', '61', '', '', '上传基金日常维护附件 <a href=\"javascript:void(0)\" onclick=\"QT.filePreview(7644)\">sms.xlsx</a>', '25', '超级管理员', '2022-05-16 14:19:24');
INSERT INTO `event_logs` VALUES ('1237', '1', '518', '', '', '上传投决会资料 <a href=\"javascript:void(0)\" onclick=\"QT.filePreview(7645)\">20180721.jpg</a>', '25', '超级管理员', '2022-05-27 15:09:02');

-- ----------------------------
-- Table structure for extras
-- ----------------------------
DROP TABLE IF EXISTS `extras`;
CREATE TABLE `extras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `module` varchar(40) NOT NULL,
  `key` varchar(60) NOT NULL,
  `value` text DEFAULT NULL,
  `is_json` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_r_m_k` (`record_id`,`module`,`key`),
  KEY `idx_r_m` (`record_id`,`module`)
) ENGINE=MyISAM AUTO_INCREMENT=422 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='附加数据表';

-- ----------------------------
-- Records of extras
-- ----------------------------
INSERT INTO `extras` VALUES ('419', '3', 'meeting_type', 'config', '{\"condition\":\"3\",\"decider\":\"25\"}', '1');
INSERT INTO `extras` VALUES ('420', '2', 'meeting_type', 'config', '{\"condition\":\"1\",\"decider\":\"25\"}', '1');
INSERT INTO `extras` VALUES ('421', '75', 'Investment', 'special_terms', '{\"rights\":[\"ZHIQING\",\"HUIGOU\",\"DUIDU\",\"OTHER\"],\"desc\":\"bbbbbb\"}', '1');

-- ----------------------------
-- Table structure for funds
-- ----------------------------
DROP TABLE IF EXISTS `funds`;
CREATE TABLE `funds` (
  `fund_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '基金名称',
  `alias` varchar(20) DEFAULT NULL COMMENT '基金别名、简称',
  `code` varchar(20) DEFAULT NULL COMMENT '基金代号',
  `reg_place` varchar(100) NOT NULL DEFAULT '',
  `size` decimal(18,2) NOT NULL DEFAULT 0.00 COMMENT '认缴规模',
  `partnership_start_date` date NOT NULL DEFAULT '0000-00-00' COMMENT '合伙企业设立日期',
  `partnership_end_date` date NOT NULL DEFAULT '0000-00-00' COMMENT '合伙企业终止日期',
  `establish_date` date NOT NULL DEFAULT '0000-00-00' COMMENT '备案成立日期',
  `over_date` date NOT NULL DEFAULT '0000-00-00' COMMENT '基金结束日期',
  `invest_period` int(11) NOT NULL DEFAULT 0 COMMENT '基金投资期（年）',
  `invest_fee_ratio` decimal(18,2) NOT NULL DEFAULT 0.00 COMMENT '投资期管理费率',
  `exit_period` int(11) NOT NULL DEFAULT 0 COMMENT '基金退出期（年）',
  `exit_fee_ratio` decimal(18,2) NOT NULL DEFAULT 0.00 COMMENT '退出期管理费率',
  `extend_period` int(11) NOT NULL DEFAULT 0 COMMENT '基金延长期（年）',
  `entered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '录入时间',
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '最后修改时间',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '运营状态，1-pending, 2-established, 3-over',
  PRIMARY KEY (`fund_id`,`partnership_end_date`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of funds
-- ----------------------------
INSERT INTO `funds` VALUES ('31', '幸福1号', '幸福1号', '111211', 'zzzzzz', '0.00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0', '0.00', '0', '0.00', '0', '0000-00-00 00:00:00', '2022-05-16 10:42:05', '3');

-- ----------------------------
-- Table structure for funds_collect
-- ----------------------------
DROP TABLE IF EXISTS `funds_collect`;
CREATE TABLE `funds_collect` (
  `fund_id` int(11) NOT NULL DEFAULT 0,
  `plan_info` varchar(255) NOT NULL DEFAULT '',
  `protocol_info` varchar(255) NOT NULL DEFAULT '',
  `business_reg_info` varchar(255) NOT NULL DEFAULT '',
  `business_reg_proxy_id` int(11) NOT NULL DEFAULT 0,
  `business_license_no` varchar(255) NOT NULL DEFAULT '',
  `bank_basic_account` varchar(255) NOT NULL DEFAULT '',
  `hosting_plan_info` varchar(255) NOT NULL DEFAULT '',
  `hosting_agency_id` int(11) NOT NULL DEFAULT 0,
  `hosting_fee_ratio` decimal(18,2) NOT NULL DEFAULT 0.00,
  `bank_collect_account` varchar(255) NOT NULL DEFAULT '',
  `bank_hosting_account` varchar(255) NOT NULL DEFAULT '',
  `tax_valueadded_ratio` varchar(100) NOT NULL DEFAULT '',
  `tax_valueadded_discount` varchar(100) NOT NULL DEFAULT '',
  `tax_income_type` tinyint(4) NOT NULL DEFAULT 1,
  `tax_income_ratio` varchar(100) NOT NULL DEFAULT '',
  `tax_income_discount` varchar(100) NOT NULL DEFAULT '',
  `tax_stamp_ratio` varchar(100) NOT NULL DEFAULT '',
  `tax_stamp_discount` varchar(100) NOT NULL DEFAULT '',
  `tax_valueadded_extra_ratio` varchar(100) NOT NULL DEFAULT '',
  `tax_valueadded_extra_discount` varchar(100) NOT NULL DEFAULT '',
  `tax_info` varchar(255) NOT NULL DEFAULT '',
  `filing_no` varchar(255) NOT NULL DEFAULT '',
  `filing_info` varchar(255) NOT NULL DEFAULT '',
  `delivery_date` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`fund_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of funds_collect
-- ----------------------------
INSERT INTO `funds_collect` VALUES ('31', '', '', '', '0', '', '', '', '0', '0.00', '', '', '', '', '1', '', '', '', '', '', '', '', '', '', '0000-00-00');

-- ----------------------------
-- Table structure for funds_enterprises
-- ----------------------------
DROP TABLE IF EXISTS `funds_enterprises`;
CREATE TABLE `funds_enterprises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fund_id` int(11) NOT NULL,
  `enterprise_id` int(11) NOT NULL,
  `investment_id` int(11) NOT NULL COMMENT '关联investment表id',
  `ffe_id` int(11) NOT NULL COMMENT '关联funds_finance_enterprises表id',
  `stock_ratio` decimal(4,2) unsigned DEFAULT NULL COMMENT '占股比例',
  `stock_ratio_new` decimal(4,2) unsigned DEFAULT NULL COMMENT '最新占股比例',
  `stock_total` decimal(16,4) DEFAULT NULL COMMENT '所得份额',
  `date_delivery` date DEFAULT NULL COMMENT '交割时间',
  PRIMARY KEY (`id`),
  KEY `fund_id` (`fund_id`),
  KEY `enterprise_id` (`enterprise_id`),
  KEY `investment_id` (`investment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of funds_enterprises
-- ----------------------------

-- ----------------------------
-- Table structure for funds_finance_contributes
-- ----------------------------
DROP TABLE IF EXISTS `funds_finance_contributes`;
CREATE TABLE `funds_finance_contributes` (
  `ffc_id` int(11) NOT NULL AUTO_INCREMENT,
  `fund_id` int(11) NOT NULL DEFAULT 0,
  `title` varchar(100) NOT NULL DEFAULT '',
  `amount` decimal(18,2) NOT NULL DEFAULT 0.00,
  `date` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`ffc_id`)
) ENGINE=MyISAM AUTO_INCREMENT=157 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of funds_finance_contributes
-- ----------------------------

-- ----------------------------
-- Table structure for funds_finance_enterprises
-- ----------------------------
DROP TABLE IF EXISTS `funds_finance_enterprises`;
CREATE TABLE `funds_finance_enterprises` (
  `ffe_id` int(11) NOT NULL AUTO_INCREMENT,
  `fund_id` int(11) NOT NULL DEFAULT 0,
  `title` varchar(100) NOT NULL DEFAULT '',
  `amount` decimal(18,2) NOT NULL DEFAULT 0.00,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `enterprise_id` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`ffe_id`)
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of funds_finance_enterprises
-- ----------------------------

-- ----------------------------
-- Table structure for funds_finance_fees
-- ----------------------------
DROP TABLE IF EXISTS `funds_finance_fees`;
CREATE TABLE `funds_finance_fees` (
  `fff_id` int(11) NOT NULL AUTO_INCREMENT,
  `fund_id` int(11) NOT NULL DEFAULT 0,
  `title` varchar(100) NOT NULL DEFAULT '',
  `amount` decimal(18,2) NOT NULL DEFAULT 0.00,
  `type` tinyint(4) NOT NULL DEFAULT 1,
  `from_date` date NOT NULL DEFAULT '0000-00-00',
  `end_date` date NOT NULL DEFAULT '0000-00-00',
  `ffi_id` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`fff_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of funds_finance_fees
-- ----------------------------

-- ----------------------------
-- Table structure for funds_finance_incomes
-- ----------------------------
DROP TABLE IF EXISTS `funds_finance_incomes`;
CREATE TABLE `funds_finance_incomes` (
  `ffi_id` int(11) NOT NULL AUTO_INCREMENT,
  `fund_id` int(11) NOT NULL DEFAULT 0,
  `exit_id` int(11) NOT NULL DEFAULT 0 COMMENT '项目退出id',
  `title` varchar(100) NOT NULL DEFAULT '',
  `amount` decimal(18,2) NOT NULL DEFAULT 0.00,
  `type` tinyint(4) NOT NULL DEFAULT 1,
  `date` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`ffi_id`),
  KEY `exit_id` (`exit_id`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of funds_finance_incomes
-- ----------------------------

-- ----------------------------
-- Table structure for funds_finance_paid
-- ----------------------------
DROP TABLE IF EXISTS `funds_finance_paid`;
CREATE TABLE `funds_finance_paid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL DEFAULT 0,
  `item_type` tinyint(4) NOT NULL DEFAULT 1,
  `actual_amount` decimal(18,2) NOT NULL,
  `pay_date` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of funds_finance_paid
-- ----------------------------

-- ----------------------------
-- Table structure for funds_finance_sync_flow
-- ----------------------------
DROP TABLE IF EXISTS `funds_finance_sync_flow`;
CREATE TABLE `funds_finance_sync_flow` (
  `fff_id` int(11) NOT NULL AUTO_INCREMENT,
  `fund_id` int(11) NOT NULL DEFAULT 0,
  `serial_number` varchar(100) NOT NULL DEFAULT '',
  `entry_date` date NOT NULL DEFAULT '0000-00-00',
  `entry_amount` decimal(18,2) NOT NULL DEFAULT 0.00,
  `entry_type` tinyint(4) NOT NULL DEFAULT 1,
  `entry_summary` varchar(200) NOT NULL DEFAULT '',
  `entered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`fff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of funds_finance_sync_flow
-- ----------------------------

-- ----------------------------
-- Table structure for funds_finance_sync_summary
-- ----------------------------
DROP TABLE IF EXISTS `funds_finance_sync_summary`;
CREATE TABLE `funds_finance_sync_summary` (
  `ffs_id` int(11) NOT NULL AUTO_INCREMENT,
  `fund_id` int(11) NOT NULL DEFAULT 0,
  `sync_date` date NOT NULL DEFAULT '0000-00-00',
  `amount` decimal(18,2) NOT NULL DEFAULT 0.00,
  `composition` text NOT NULL,
  `entered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ffs_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of funds_finance_sync_summary
-- ----------------------------

-- ----------------------------
-- Table structure for funds_finance_taxes
-- ----------------------------
DROP TABLE IF EXISTS `funds_finance_taxes`;
CREATE TABLE `funds_finance_taxes` (
  `fft_id` int(11) NOT NULL AUTO_INCREMENT,
  `fund_id` int(11) NOT NULL DEFAULT 0,
  `title` varchar(100) NOT NULL DEFAULT '',
  `amount` decimal(18,2) NOT NULL DEFAULT 0.00,
  `type` tinyint(4) NOT NULL DEFAULT 1,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `ffi_id` int(11) NOT NULL DEFAULT 0,
  `ffc_id` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`fft_id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of funds_finance_taxes
-- ----------------------------

-- ----------------------------
-- Table structure for funds_partners
-- ----------------------------
DROP TABLE IF EXISTS `funds_partners`;
CREATE TABLE `funds_partners` (
  `fp_id` int(11) NOT NULL AUTO_INCREMENT,
  `fund_id` int(11) NOT NULL DEFAULT 0,
  `p_id` int(11) NOT NULL DEFAULT 0,
  `amount` decimal(18,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-active, 2-exit',
  PRIMARY KEY (`fp_id`)
) ENGINE=MyISAM AUTO_INCREMENT=91 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of funds_partners
-- ----------------------------
INSERT INTO `funds_partners` VALUES ('90', '31', '65', '1000000.00', '1');

-- ----------------------------
-- Table structure for funds_partners_paid
-- ----------------------------
DROP TABLE IF EXISTS `funds_partners_paid`;
CREATE TABLE `funds_partners_paid` (
  `fp_paid_id` int(11) NOT NULL AUTO_INCREMENT,
  `fp_id` int(11) NOT NULL DEFAULT 0,
  `ffc_id` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`fp_paid_id`)
) ENGINE=MyISAM AUTO_INCREMENT=145 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of funds_partners_paid
-- ----------------------------

-- ----------------------------
-- Table structure for industries
-- ----------------------------
DROP TABLE IF EXISTS `industries`;
CREATE TABLE `industries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL DEFAULT 0,
  `name` varchar(40) DEFAULT NULL,
  `core_data` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of industries
-- ----------------------------

-- ----------------------------
-- Table structure for industry_graphs
-- ----------------------------
DROP TABLE IF EXISTS `industry_graphs`;
CREATE TABLE `industry_graphs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  `name` varchar(40) NOT NULL,
  `description` text DEFAULT NULL,
  `data` text DEFAULT NULL,
  `date_entered` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of industry_graphs
-- ----------------------------

-- ----------------------------
-- Table structure for investment
-- ----------------------------
DROP TABLE IF EXISTS `investment`;
CREATE TABLE `investment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `enterprise_id` int(11) NOT NULL,
  `meeting_id` int(11) NOT NULL DEFAULT 0 COMMENT '投决会id',
  `financing_stage` tinyint(4) NOT NULL COMMENT '投后估值',
  `initial_valuation` bigint(20) DEFAULT NULL,
  `trade_plan` varchar(200) DEFAULT '',
  `director` varchar(60) NOT NULL DEFAULT '' COMMENT '董事',
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=77 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='投资表';

-- ----------------------------
-- Records of investment
-- ----------------------------
INSERT INTO `investment` VALUES ('75', '517', '90', '3', '10000000', 'aaaaaaaa', '25', '2', '0', '2022-05-30 14:23:33');

-- ----------------------------
-- Table structure for job_queue
-- ----------------------------
DROP TABLE IF EXISTS `job_queue`;
CREATE TABLE `job_queue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `scheduler_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL DEFAULT '',
  `target` varchar(255) NOT NULL DEFAULT '',
  `execute_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `execute_end_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `result` varchar(20) NOT NULL DEFAULT '',
  `message` varchar(1024) NOT NULL DEFAULT '',
  `client` varchar(100) NOT NULL DEFAULT '',
  `entered` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1737 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of job_queue
-- ----------------------------

-- ----------------------------
-- Table structure for knowledges
-- ----------------------------
DROP TABLE IF EXISTS `knowledges`;
CREATE TABLE `knowledges` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL DEFAULT 0,
  `name` varchar(40) DEFAULT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of knowledges
-- ----------------------------

-- ----------------------------
-- Table structure for login_logs
-- ----------------------------
DROP TABLE IF EXISTS `login_logs`;
CREATE TABLE `login_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL DEFAULT '',
  `userid` int(11) NOT NULL DEFAULT 0,
  `usertype` tinyint(4) NOT NULL DEFAULT 1,
  `useragent` varchar(200) NOT NULL DEFAULT '',
  `device` tinyint(4) NOT NULL DEFAULT 1,
  `ip` varchar(100) NOT NULL DEFAULT '',
  `time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2575 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of login_logs
-- ----------------------------
INSERT INTO `login_logs` VALUES ('2551', 'admin', '25', '1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safa', '1', '127.0.0.1', '2022-03-11 16:10:39');
INSERT INTO `login_logs` VALUES ('2552', 'admin', '25', '1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safa', '1', '127.0.0.1', '2022-04-22 09:53:47');
INSERT INTO `login_logs` VALUES ('2553', 'admin', '25', '1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safa', '1', '127.0.0.1', '2022-04-22 09:53:47');
INSERT INTO `login_logs` VALUES ('2554', 'admin', '25', '1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safa', '1', '127.0.0.1', '2022-04-24 11:42:18');
INSERT INTO `login_logs` VALUES ('2555', 'admin', '25', '1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safa', '1', '127.0.0.1', '2022-04-26 18:00:33');
INSERT INTO `login_logs` VALUES ('2556', 'admin', '25', '1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safa', '1', '127.0.0.1', '2022-04-27 14:40:15');
INSERT INTO `login_logs` VALUES ('2557', 'admin', '25', '1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safa', '1', '127.0.0.1', '2022-04-29 09:38:52');
INSERT INTO `login_logs` VALUES ('2558', 'admin', '25', '1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safa', '1', '127.0.0.1', '2022-05-04 13:56:14');
INSERT INTO `login_logs` VALUES ('2559', 'admin', '25', '1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safa', '1', '127.0.0.1', '2022-05-07 17:49:44');
INSERT INTO `login_logs` VALUES ('2560', 'admin', '25', '1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safa', '1', '127.0.0.1', '2022-05-11 10:48:06');
INSERT INTO `login_logs` VALUES ('2561', 'admin', '25', '1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safa', '1', '127.0.0.1', '2022-05-12 10:36:20');
INSERT INTO `login_logs` VALUES ('2562', 'admin', '25', '1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safa', '1', '127.0.0.1', '2022-05-13 16:07:07');
INSERT INTO `login_logs` VALUES ('2563', 'admin', '25', '1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safa', '1', '127.0.0.1', '2022-05-16 10:41:03');
INSERT INTO `login_logs` VALUES ('2564', 'admin', '25', '1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safa', '1', '127.0.0.1', '2022-05-18 11:14:41');
INSERT INTO `login_logs` VALUES ('2565', 'admin', '25', '1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safa', '1', '127.0.0.1', '2022-05-23 11:43:24');
INSERT INTO `login_logs` VALUES ('2566', 'admin', '25', '1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safa', '1', '127.0.0.1', '2022-05-25 11:22:00');
INSERT INTO `login_logs` VALUES ('2567', 'admin', '25', '1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safa', '1', '127.0.0.1', '2022-05-26 15:55:10');
INSERT INTO `login_logs` VALUES ('2568', 'admin', '25', '1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safa', '1', '127.0.0.1', '2022-05-27 12:22:38');
INSERT INTO `login_logs` VALUES ('2569', 'admin', '25', '1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safa', '1', '127.0.0.1', '2022-05-31 12:17:52');
INSERT INTO `login_logs` VALUES ('2570', 'admin', '25', '1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safa', '1', '127.0.0.1', '2022-06-01 09:55:58');
INSERT INTO `login_logs` VALUES ('2571', 'admin', '25', '1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safa', '1', '127.0.0.1', '2022-06-01 14:23:40');
INSERT INTO `login_logs` VALUES ('2572', 'admin', '25', '1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safa', '1', '127.0.0.1', '2022-06-02 17:46:59');
INSERT INTO `login_logs` VALUES ('2573', 'admin', '25', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Sa', '1', '127.0.0.1', '2024-07-31 11:41:24');
INSERT INTO `login_logs` VALUES ('2574', 'admin', '25', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Sa', '1', '127.0.0.1', '2024-07-31 11:41:24');

-- ----------------------------
-- Table structure for meetings
-- ----------------------------
DROP TABLE IF EXISTS `meetings`;
CREATE TABLE `meetings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '会议类型',
  `relate_id` int(11) DEFAULT NULL,
  `investment_id` int(11) NOT NULL DEFAULT 0 COMMENT '关联投资轮次id',
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(4) DEFAULT 1,
  `date_start` datetime DEFAULT NULL,
  `date_end` datetime DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `feedback` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT current_timestamp(),
  `date_modified` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `type` (`type`,`relate_id`)
) ENGINE=MyISAM AUTO_INCREMENT=91 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of meetings
-- ----------------------------
INSERT INTO `meetings` VALUES ('87', '2', '518', '0', '0', '1', '2022-04-22 12:20:00', null, '金钥匙金融投资为核心,战略布局实业、金融-立项会议（20220422）', '是否尽调了解', 'zzzzzzzzzzz', '25', '2022-04-22 12:21:15', '2022-05-27 17:21:20');
INSERT INTO `meetings` VALUES ('88', '3', '518', '0', '0', '2', '2022-04-22 12:21:00', null, '金钥匙金融投资为核心,战略布局实业、金融-投决会议（20220422）', '是否投资', 'zzzzzzzz', '25', '2022-04-22 12:22:09', '2022-05-27 17:33:57');
INSERT INTO `meetings` VALUES ('89', '2', '517', '0', '0', '3', '2022-05-25 12:05:00', null, '小数点科技-立项会议（20220525）', '', 'aaaaa', '25', '2022-05-25 12:06:02', '2022-05-27 17:46:53');
INSERT INTO `meetings` VALUES ('90', '3', '517', '75', '0', '3', '2022-05-30 14:05:00', null, '小数点科技-投决会议（20220530）', '决策小数点科技是否投资', '决策投资', '25', '2022-05-30 14:05:47', '2022-05-30 14:23:33');

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '菜单名称',
  `level` tinyint(4) NOT NULL DEFAULT 1 COMMENT '层级(1,2,3)',
  `pid` smallint(6) NOT NULL DEFAULT 0 COMMENT '父id',
  `m` varchar(20) NOT NULL DEFAULT '' COMMENT '模块',
  `c` varchar(20) NOT NULL DEFAULT '' COMMENT '控制器',
  `a` varchar(20) NOT NULL DEFAULT '' COMMENT '方法',
  `params` varchar(64) NOT NULL DEFAULT '' COMMENT 'url附加参数',
  `icon_cls` varchar(100) NOT NULL DEFAULT '' COMMENT 'icon样式',
  `order_id` int(11) NOT NULL DEFAULT 0 COMMENT '排序号',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('47', '对外尽调', '1', '0', '', '', '', '', 'fa fa-square', '1000');
INSERT INTO `menu` VALUES ('2', '系统管理', '1', '0', '', '', '', '', 'fa fa-gears', '9999');
INSERT INTO `menu` VALUES ('3', '用户管理', '2', '2', 'index', 'Admins', 'admins', '', 'fa fa-circle', '0');
INSERT INTO `menu` VALUES ('4', '角色管理', '2', '2', 'index', 'AdminRole', 'adminRole', '', 'fa fa-circle', '0');
INSERT INTO `menu` VALUES ('5', '系统设置', '2', '2', 'index', 'System', 'setting', '', 'fa fa-circle', '0');
INSERT INTO `menu` VALUES ('6', '行业', '1', '0', '', '', '', '', 'fa fa-square', '700');
INSERT INTO `menu` VALUES ('7', '基金池', '1', '0', '', '', '', '', 'fa fa-square', '200');
INSERT INTO `menu` VALUES ('8', '投资人', '1', '0', '', '', '', '', 'fa fa-square', '300');
INSERT INTO `menu` VALUES ('10', '总列表', '2', '7', 'index', 'Funds', 'funds', '', 'fa fa-circle', '0');
INSERT INTO `menu` VALUES ('11', '个人有限合伙人', '2', '8', 'index', 'Partners', 'partners', 'type=1&status=2', 'fa fa-circle', '0');
INSERT INTO `menu` VALUES ('13', '项目池', '1', '0', '', '', '', '', 'fa fa-square', '50');
INSERT INTO `menu` VALUES ('14', '项目-接触', '2', '13', 'index', 'Enterprises', 'index', 'step=1', 'fa fa-circle', '1');
INSERT INTO `menu` VALUES ('15', '行业研究', '2', '6', 'index', 'Industries', 'index', '', 'fa fa-circle', '0');
INSERT INTO `menu` VALUES ('16', '人才库', '2', '13', 'index', 'Contacts', 'index', '', 'fa fa-circle', '0');
INSERT INTO `menu` VALUES ('17', '菜单管理', '2', '2', 'index', 'Menus', 'index', '', 'fa fa-circle', '0');
INSERT INTO `menu` VALUES ('18', '募集中', '2', '7', 'index', 'Funds', 'fundsCollect', '', 'fa fa-circle', '20');
INSERT INTO `menu` VALUES ('19', '投资中', '2', '7', 'index', 'Funds', 'fundsInvest', '', 'fa fa-circle', '30');
INSERT INTO `menu` VALUES ('20', '管理中', '2', '7', 'index', 'Funds', 'fundsManage', '', 'fa fa-circle', '40');
INSERT INTO `menu` VALUES ('22', '项目-分析', '1', '13', 'index', 'Enterprises', 'index', 'step=2', 'fa fa-circle', '2');
INSERT INTO `menu` VALUES ('24', '项目-尽调', '1', '13', 'index', 'Enterprises', 'index', 'step=3', 'fa fa-circle', '3');
INSERT INTO `menu` VALUES ('25', '我的', '1', '0', '', '', '', '', 'fa fa-user', '300');
INSERT INTO `menu` VALUES ('27', '项目-投中', '1', '13', 'index', 'Enterprises', 'index', 'step=4', 'fa fa-circle', '5');
INSERT INTO `menu` VALUES ('34', '智库列表', '1', '33', 'index', 'Knowledges', 'index', '', 'fa fa-circle', '0');
INSERT INTO `menu` VALUES ('29', '普通合伙人', '1', '8', 'index', 'Partners', 'partners', 'type=3&status=2', 'fa fa-circle', '20');
INSERT INTO `menu` VALUES ('30', '数据配置', '1', '2', 'index', 'Config', 'index', '', 'fa fa-circle', '0');
INSERT INTO `menu` VALUES ('31', '项目-投后', '1', '13', 'index', 'Enterprises', 'index', 'step=5', 'fa fa-circle', '6');
INSERT INTO `menu` VALUES ('33', '智库', '1', '0', '', '', '', '', 'fa fa-square', '800');
INSERT INTO `menu` VALUES ('40', '计划任务', '1', '2', 'index', 'Schedulers', 'index', '', 'fa fa-circle', '0');
INSERT INTO `menu` VALUES ('36', '登录日志', '1', '2', 'index', 'LoginLogs', 'index', '', 'fa fa-circle', '100');
INSERT INTO `menu` VALUES ('37', '已注销', '1', '7', 'index', 'Funds', 'FundsExit', '', 'fa fa-circle', '100');
INSERT INTO `menu` VALUES ('38', '变更日志', '1', '2', 'index', 'AuditLogs', 'index', '', 'fa fa-circle', '200');
INSERT INTO `menu` VALUES ('46', '上市公司', '1', '13', 'index', 'Companies', 'index', '', 'fa fa-circle', '0');
INSERT INTO `menu` VALUES ('41', '文档中心', '1', '2', 'index', 'Docs', 'index', '', 'fa fa-circle', '1000');
INSERT INTO `menu` VALUES ('42', '我的文件', '1', '25', 'index', 'Docs', 'index', 'owned=1', 'fa fa-circle', '10');
INSERT INTO `menu` VALUES ('43', '机构有限合伙人', '1', '8', 'index', 'Partners', 'partners', 'type=2&status=2', 'fa fa-circle', '10');
INSERT INTO `menu` VALUES ('44', '行业图谱', '1', '6', 'index', 'Industries', 'graphs', '', 'fa fa-circle', '0');
INSERT INTO `menu` VALUES ('49', '子行业', '1', '6', 'index', 'SubIndustry', 'index', '', 'fa fa-circle', '0');
INSERT INTO `menu` VALUES ('48', '总表', '1', '47', 'index', 'Dd', 'index', '', 'fa fa-circle', '0');
INSERT INTO `menu` VALUES ('50', '出资人名录', '1', '47', 'index', 'Dd', 'index', 'view=2', 'fa fa-circle', '10');
INSERT INTO `menu` VALUES ('51', '投资业绩', '1', '47', 'index', 'Dd', 'index', 'view=3', 'fa fa-circle', '20');
INSERT INTO `menu` VALUES ('52', '临时访客', '1', '8', 'index', 'Partners', 'partners', 'status=1', 'fa fa-circle', '30');
INSERT INTO `menu` VALUES ('53', '科学家引擎', '1', '0', '', '', '', '', 'fa fa-square', '900');
INSERT INTO `menu` VALUES ('54', '科学家', '1', '53', 'index', 'Scientists', 'index', '', 'fa fa-circle', '1');
INSERT INTO `menu` VALUES ('55', '尽调记录', '1', '47', 'index', 'Notes', 'index', 'category=1', 'fa fa-circle', '25');
INSERT INTO `menu` VALUES ('57', '项目-总表', '1', '13', 'index', 'Enterprises', 'index', '', 'fa fa-circle', '0');
INSERT INTO `menu` VALUES ('58', '会议', '1', '0', '', '', '', '', 'fa fa-square', '350');
INSERT INTO `menu` VALUES ('59', '会议列表', '1', '58', 'Index', 'Meetings', 'index', '', 'fa fa-circle', '1');

-- ----------------------------
-- Table structure for messages
-- ----------------------------
DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL DEFAULT 0,
  `title` varchar(200) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `category` tinyint(4) NOT NULL DEFAULT 0,
  `is_read` tinyint(4) NOT NULL DEFAULT 0,
  `read_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `entered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`message_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of messages
-- ----------------------------

-- ----------------------------
-- Table structure for milestones
-- ----------------------------
DROP TABLE IF EXISTS `milestones`;
CREATE TABLE `milestones` (
  `milestone_id` int(11) NOT NULL AUTO_INCREMENT,
  `category` tinyint(4) NOT NULL DEFAULT 1,
  `record_id` int(11) NOT NULL DEFAULT 0,
  `occur_date` date NOT NULL DEFAULT '0000-00-00',
  `desc` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`milestone_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of milestones
-- ----------------------------

-- ----------------------------
-- Table structure for notes
-- ----------------------------
DROP TABLE IF EXISTS `notes`;
CREATE TABLE `notes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category` smallint(6) NOT NULL COMMENT '业务分类',
  `title` varchar(100) NOT NULL DEFAULT '',
  `entry` text DEFAULT NULL,
  `date` date NOT NULL COMMENT '发生日期',
  `created_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category` (`category`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='通用记录表';

-- ----------------------------
-- Records of notes
-- ----------------------------

-- ----------------------------
-- Table structure for partners
-- ----------------------------
DROP TABLE IF EXISTS `partners`;
CREATE TABLE `partners` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) NOT NULL DEFAULT 1,
  `name` varchar(100) NOT NULL COMMENT '姓名',
  `title` varchar(100) NOT NULL DEFAULT '',
  `tel` varchar(100) NOT NULL,
  `entered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '录入时间',
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '最后修改时间',
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `email` varchar(100) NOT NULL DEFAULT '',
  `address` varchar(255) NOT NULL DEFAULT '',
  `credential_type` tinyint(4) NOT NULL DEFAULT 1,
  `credential_no` varchar(100) NOT NULL DEFAULT '',
  `login_name` varchar(60) NOT NULL DEFAULT '',
  `login_password` varchar(60) NOT NULL DEFAULT '',
  `enterprises` varchar(60) NOT NULL DEFAULT '' COMMENT '可见项目',
  `note` varchar(200) NOT NULL DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`p_id`)
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of partners
-- ----------------------------
INSERT INTO `partners` VALUES ('65', '1', '马化腾', 'CEO', '13530531212', '2022-05-16 10:59:28', '2022-05-16 10:59:28', '2', '', '', '1', '', '13530531212', 'e10adc3949ba59abbe56e057f20f883e', '', '');

-- ----------------------------
-- Table structure for progress_logs
-- ----------------------------
DROP TABLE IF EXISTS `progress_logs`;
CREATE TABLE `progress_logs` (
  `progress_log_id` int(11) NOT NULL AUTO_INCREMENT,
  `category` tinyint(4) NOT NULL DEFAULT 0,
  `subtype` tinyint(4) NOT NULL DEFAULT 0 COMMENT '子类型',
  `occur_date` date NOT NULL DEFAULT '0000-00-00',
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '标题',
  `entry` text NOT NULL,
  `entered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `external_id` int(10) unsigned NOT NULL DEFAULT 0,
  `show_timeline` tinyint(4) NOT NULL DEFAULT 0 COMMENT '是否展示到时间轴',
  `admin_id` int(11) NOT NULL DEFAULT 0,
  `contact_id` int(11) NOT NULL DEFAULT 0 COMMENT '项目端录入人id',
  `extras` varchar(1024) DEFAULT '' COMMENT '附加业务数据',
  PRIMARY KEY (`progress_log_id`)
) ENGINE=MyISAM AUTO_INCREMENT=334 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of progress_logs
-- ----------------------------
INSERT INTO `progress_logs` VALUES ('333', '5', '0', '2022-05-30', 'zzzzzzzzzz', 'aaaaaaaaaaaa', '2022-05-30 18:29:22', '2022-05-30 18:29:28', '517', '0', '25', '0', '');

-- ----------------------------
-- Table structure for redis
-- ----------------------------
DROP TABLE IF EXISTS `redis`;
CREATE TABLE `redis` (
  `key` varchar(100) NOT NULL DEFAULT '',
  `value` text NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of redis
-- ----------------------------

-- ----------------------------
-- Table structure for schedulers
-- ----------------------------
DROP TABLE IF EXISTS `schedulers`;
CREATE TABLE `schedulers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job` varchar(100) NOT NULL DEFAULT '',
  `name` varchar(100) NOT NULL DEFAULT '',
  `interval` varchar(100) NOT NULL DEFAULT '',
  `date_time_start` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_time_end` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_run` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `disabled` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0-enable, 1-disabled',
  `deleted` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0-active, 1-deleted',
  `created_by` int(10) unsigned NOT NULL DEFAULT 0,
  `entered` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_schedule` (`date_time_start`,`deleted`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of schedulers
-- ----------------------------

-- ----------------------------
-- Table structure for scientists
-- ----------------------------
DROP TABLE IF EXISTS `scientists`;
CREATE TABLE `scientists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL DEFAULT '' COMMENT '姓名',
  `field` varchar(60) NOT NULL DEFAULT '0' COMMENT '领域',
  `assigner` int(11) NOT NULL DEFAULT 0 COMMENT '跟进人uid',
  `place` varchar(200) NOT NULL DEFAULT '' COMMENT '工作场所',
  `contact_way` varchar(200) NOT NULL DEFAULT '' COMMENT '联系方式',
  `core_tech` text NOT NULL COMMENT '核心技术',
  `entered` timestamp NOT NULL DEFAULT current_timestamp(),
  `brief_introduction` text DEFAULT NULL COMMENT '简介',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=83 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of scientists
-- ----------------------------

-- ----------------------------
-- Table structure for scientist_requirements
-- ----------------------------
DROP TABLE IF EXISTS `scientist_requirements`;
CREATE TABLE `scientist_requirements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `scientist_id` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '科学家id',
  `content` text NOT NULL COMMENT '内容',
  `entered` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of scientist_requirements
-- ----------------------------

-- ----------------------------
-- Table structure for setting
-- ----------------------------
DROP TABLE IF EXISTS `setting`;
CREATE TABLE `setting` (
  `key` varchar(50) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of setting
-- ----------------------------

-- ----------------------------
-- Table structure for sub_industry
-- ----------------------------
DROP TABLE IF EXISTS `sub_industry`;
CREATE TABLE `sub_industry` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL DEFAULT 0,
  `name` varchar(40) DEFAULT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of sub_industry
-- ----------------------------

-- ----------------------------
-- Table structure for sub_industry_chain
-- ----------------------------
DROP TABLE IF EXISTS `sub_industry_chain`;
CREATE TABLE `sub_industry_chain` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` char(60) NOT NULL DEFAULT '' COMMENT '名字',
  `parent_id` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '上级部门',
  `sub_industry_id` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '子行业id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=75 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of sub_industry_chain
-- ----------------------------

-- ----------------------------
-- Table structure for sub_industry_chain_enterprise
-- ----------------------------
DROP TABLE IF EXISTS `sub_industry_chain_enterprise`;
CREATE TABLE `sub_industry_chain_enterprise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_industry_chain_id` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '产业链id',
  `eid` int(11) NOT NULL DEFAULT 0 COMMENT '企业id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=154 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of sub_industry_chain_enterprise
-- ----------------------------

-- ----------------------------
-- Table structure for sub_industry_enterprise
-- ----------------------------
DROP TABLE IF EXISTS `sub_industry_enterprise`;
CREATE TABLE `sub_industry_enterprise` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iid` int(11) NOT NULL COMMENT '行业id',
  `eid` int(11) NOT NULL COMMENT '企业id',
  `sort` smallint(5) unsigned NOT NULL DEFAULT 0 COMMENT '企业在行业中的排序',
  `position` tinyint(4) NOT NULL DEFAULT 0 COMMENT '产业链位置：上中下游',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uidx` (`iid`,`eid`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of sub_industry_enterprise
-- ----------------------------

-- ----------------------------
-- Table structure for tags
-- ----------------------------
DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category` int(11) NOT NULL COMMENT '标签分类',
  `pid` int(11) NOT NULL DEFAULT 0,
  `name` varchar(100) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `category` (`category`)
) ENGINE=MyISAM AUTO_INCREMENT=169 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of tags
-- ----------------------------
INSERT INTO `tags` VALUES ('162', '4', '0', '90后', '2022-03-11 16:43:20');
INSERT INTO `tags` VALUES ('163', '4', '0', '乐视系', '2022-03-11 16:45:18');
INSERT INTO `tags` VALUES ('164', '6', '0', '农业', '2022-03-11 17:28:14');
INSERT INTO `tags` VALUES ('165', '6', '164', '大棚种植', '2022-03-11 17:30:08');
INSERT INTO `tags` VALUES ('166', '6', '0', '工业', '2022-03-11 17:30:31');
INSERT INTO `tags` VALUES ('167', '6', '166', '工业4.0', '2022-03-11 17:30:40');
INSERT INTO `tags` VALUES ('168', '6', '164', '生态养殖', '2022-03-11 17:48:42');

-- ----------------------------
-- Table structure for tags_records
-- ----------------------------
DROP TABLE IF EXISTS `tags_records`;
CREATE TABLE `tags_records` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `entity_type` smallint(6) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `category` smallint(6) NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx1` (`entity_type`,`entity_id`,`tag_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1326 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of tags_records
-- ----------------------------
INSERT INTO `tags_records` VALUES ('1317', '4', '2', '163', '4', '2022-03-11 16:46:06', '0');
INSERT INTO `tags_records` VALUES ('1325', '4', '3', '162', '4', '2022-05-04 14:23:12', '0');
INSERT INTO `tags_records` VALUES ('1320', '1', '517', '165', '6', '2022-03-11 17:49:17', '0');
INSERT INTO `tags_records` VALUES ('1324', '1', '518', '167', '6', '2022-04-22 12:20:31', '0');
INSERT INTO `tags_records` VALUES ('1323', '1', '518', '166', '6', '2022-04-22 12:20:31', '0');

-- ----------------------------
-- Table structure for users_follow
-- ----------------------------
DROP TABLE IF EXISTS `users_follow`;
CREATE TABLE `users_follow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `target_type` tinyint(4) NOT NULL,
  `target_id` int(11) NOT NULL,
  `ctime` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `utt` (`user_id`,`target_type`,`target_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of users_follow
-- ----------------------------

-- ----------------------------
-- Table structure for users_records
-- ----------------------------
DROP TABLE IF EXISTS `users_records`;
CREATE TABLE `users_records` (
  `module` char(36) NOT NULL,
  `user_id` int(11) NOT NULL,
  `record_id` int(11) NOT NULL,
  `primary` tinyint(4) NOT NULL DEFAULT 0 COMMENT '是否主跟进人',
  UNIQUE KEY `idx_m_uid_rid` (`module`,`user_id`,`record_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of users_records
-- ----------------------------
INSERT INTO `users_records` VALUES ('Contacts', '25', '2', '1');
INSERT INTO `users_records` VALUES ('Contacts', '25', '3', '1');
INSERT INTO `users_records` VALUES ('Contacts', '25', '4', '1');
INSERT INTO `users_records` VALUES ('Enterprises', '25', '517', '1');
INSERT INTO `users_records` VALUES ('Enterprises', '25', '518', '1');

-- ----------------------------
-- Table structure for work_status
-- ----------------------------
DROP TABLE IF EXISTS `work_status`;
CREATE TABLE `work_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` tinyint(4) NOT NULL DEFAULT 1,
  `record_id` int(11) NOT NULL DEFAULT 0,
  `workers` varchar(255) NOT NULL DEFAULT '',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-working, 2-finished',
  `finished_date` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of work_status
-- ----------------------------
