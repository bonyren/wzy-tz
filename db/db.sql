/*
 Navicat Premium Dump SQL

 Source Server         : wzyer
 Source Server Type    : MySQL
 Source Server Version : 80032 (8.0.32)
 Source Host           : www.wzyer.com:3306
 Source Schema         : wzyer_daohe

 Target Server Type    : MySQL
 Target Server Version : 80032 (8.0.32)
 File Encoding         : 65001

 Date: 02/09/2025 17:11:12
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin_role
-- ----------------------------
DROP TABLE IF EXISTS `admin_role`;
CREATE TABLE `admin_role`  (
  `role_id` tinyint UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT '角色名称',
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT '描述',
  PRIMARY KEY (`role_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 35 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci COMMENT = '角色管理' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of admin_role
-- ----------------------------
INSERT INTO `admin_role` VALUES (33, '基金经理', '');
INSERT INTO `admin_role` VALUES (34, '客户测试', '线上客户测试');

-- ----------------------------
-- Table structure for admin_role_menu
-- ----------------------------
DROP TABLE IF EXISTS `admin_role_menu`;
CREATE TABLE `admin_role_menu`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `role_id` int UNSIGNED NULL DEFAULT 0 COMMENT '角色ID',
  `menu_id` int UNSIGNED NULL DEFAULT 0 COMMENT '菜单ID',
  `type` tinyint UNSIGNED NOT NULL DEFAULT 1 COMMENT '1:只读,2:读写',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `role_id`(`role_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2533 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of admin_role_menu
-- ----------------------------
INSERT INTO `admin_role_menu` VALUES (2458, 33, 16, 2);
INSERT INTO `admin_role_menu` VALUES (2459, 33, 46, 2);
INSERT INTO `admin_role_menu` VALUES (2460, 33, 57, 2);
INSERT INTO `admin_role_menu` VALUES (2461, 33, 14, 2);
INSERT INTO `admin_role_menu` VALUES (2462, 33, 22, 2);
INSERT INTO `admin_role_menu` VALUES (2463, 33, 24, 2);
INSERT INTO `admin_role_menu` VALUES (2464, 33, 27, 2);
INSERT INTO `admin_role_menu` VALUES (2465, 33, 31, 2);
INSERT INTO `admin_role_menu` VALUES (2466, 33, 10, 2);
INSERT INTO `admin_role_menu` VALUES (2467, 33, 18, 2);
INSERT INTO `admin_role_menu` VALUES (2468, 33, 19, 2);
INSERT INTO `admin_role_menu` VALUES (2469, 33, 20, 2);
INSERT INTO `admin_role_menu` VALUES (2470, 33, 37, 2);
INSERT INTO `admin_role_menu` VALUES (2471, 33, 42, 2);
INSERT INTO `admin_role_menu` VALUES (2472, 33, 11, 2);
INSERT INTO `admin_role_menu` VALUES (2473, 33, 43, 2);
INSERT INTO `admin_role_menu` VALUES (2474, 33, 29, 2);
INSERT INTO `admin_role_menu` VALUES (2475, 33, 52, 2);
INSERT INTO `admin_role_menu` VALUES (2476, 33, 59, 2);
INSERT INTO `admin_role_menu` VALUES (2477, 33, 15, 2);
INSERT INTO `admin_role_menu` VALUES (2478, 33, 44, 2);
INSERT INTO `admin_role_menu` VALUES (2479, 33, 49, 2);
INSERT INTO `admin_role_menu` VALUES (2480, 33, 34, 2);
INSERT INTO `admin_role_menu` VALUES (2481, 33, 54, 2);
INSERT INTO `admin_role_menu` VALUES (2482, 33, 48, 2);
INSERT INTO `admin_role_menu` VALUES (2483, 33, 50, 2);
INSERT INTO `admin_role_menu` VALUES (2484, 33, 51, 2);
INSERT INTO `admin_role_menu` VALUES (2485, 33, 55, 2);
INSERT INTO `admin_role_menu` VALUES (2486, 33, 3, 2);
INSERT INTO `admin_role_menu` VALUES (2487, 33, 4, 2);
INSERT INTO `admin_role_menu` VALUES (2488, 33, 5, 2);
INSERT INTO `admin_role_menu` VALUES (2489, 33, 17, 2);
INSERT INTO `admin_role_menu` VALUES (2490, 33, 30, 2);
INSERT INTO `admin_role_menu` VALUES (2491, 33, 40, 2);
INSERT INTO `admin_role_menu` VALUES (2492, 33, 36, 2);
INSERT INTO `admin_role_menu` VALUES (2493, 33, 38, 2);
INSERT INTO `admin_role_menu` VALUES (2494, 33, 41, 2);
INSERT INTO `admin_role_menu` VALUES (2496, 34, 16, 2);
INSERT INTO `admin_role_menu` VALUES (2497, 34, 46, 2);
INSERT INTO `admin_role_menu` VALUES (2498, 34, 57, 2);
INSERT INTO `admin_role_menu` VALUES (2499, 34, 14, 2);
INSERT INTO `admin_role_menu` VALUES (2500, 34, 22, 2);
INSERT INTO `admin_role_menu` VALUES (2501, 34, 24, 2);
INSERT INTO `admin_role_menu` VALUES (2502, 34, 27, 2);
INSERT INTO `admin_role_menu` VALUES (2503, 34, 31, 2);
INSERT INTO `admin_role_menu` VALUES (2504, 34, 10, 2);
INSERT INTO `admin_role_menu` VALUES (2505, 34, 18, 2);
INSERT INTO `admin_role_menu` VALUES (2506, 34, 19, 2);
INSERT INTO `admin_role_menu` VALUES (2507, 34, 20, 2);
INSERT INTO `admin_role_menu` VALUES (2508, 34, 37, 2);
INSERT INTO `admin_role_menu` VALUES (2509, 34, 42, 2);
INSERT INTO `admin_role_menu` VALUES (2510, 34, 11, 2);
INSERT INTO `admin_role_menu` VALUES (2511, 34, 43, 2);
INSERT INTO `admin_role_menu` VALUES (2512, 34, 29, 2);
INSERT INTO `admin_role_menu` VALUES (2513, 34, 52, 2);
INSERT INTO `admin_role_menu` VALUES (2514, 34, 59, 2);
INSERT INTO `admin_role_menu` VALUES (2515, 34, 15, 2);
INSERT INTO `admin_role_menu` VALUES (2516, 34, 44, 2);
INSERT INTO `admin_role_menu` VALUES (2517, 34, 49, 2);
INSERT INTO `admin_role_menu` VALUES (2518, 34, 34, 2);
INSERT INTO `admin_role_menu` VALUES (2519, 34, 54, 2);
INSERT INTO `admin_role_menu` VALUES (2520, 34, 48, 2);
INSERT INTO `admin_role_menu` VALUES (2521, 34, 50, 2);
INSERT INTO `admin_role_menu` VALUES (2522, 34, 51, 2);
INSERT INTO `admin_role_menu` VALUES (2523, 34, 55, 2);
INSERT INTO `admin_role_menu` VALUES (2524, 34, 3, 2);
INSERT INTO `admin_role_menu` VALUES (2525, 34, 4, 2);
INSERT INTO `admin_role_menu` VALUES (2526, 34, 5, 2);
INSERT INTO `admin_role_menu` VALUES (2527, 34, 17, 2);
INSERT INTO `admin_role_menu` VALUES (2528, 34, 30, 2);
INSERT INTO `admin_role_menu` VALUES (2529, 34, 40, 2);
INSERT INTO `admin_role_menu` VALUES (2530, 34, 36, 2);
INSERT INTO `admin_role_menu` VALUES (2531, 34, 38, 2);
INSERT INTO `admin_role_menu` VALUES (2532, 34, 41, 2);

-- ----------------------------
-- Table structure for admins
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins`  (
  `admin_id` int NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `login_name` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '登录名',
  `login_password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '登录密码',
  `login_encrypt` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '密码加密字符串',
  `realname` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '真实姓名',
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT 'Email',
  `disabled` tinyint NOT NULL DEFAULT 1 COMMENT '1-enabled, 2-disabled',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  `password_changed` date NOT NULL DEFAULT '0000-00-00' COMMENT '修改密码日期',
  `super_user` tinyint NOT NULL DEFAULT 2 COMMENT '是否超级用户',
  `role_id` int NOT NULL DEFAULT 0 COMMENT '角色ID',
  PRIMARY KEY (`admin_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 32 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci COMMENT = '管理员' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of admins
-- ----------------------------
INSERT INTO `admins` VALUES (25, 'admin', '67294e436f2c505efd555fef1b0f6c05', 'UkdVXc', '超级管理员', 'admin@sohu.com', 1, '2021-07-27 16:25:30', '2024-10-11 14:39:54', '0000-00-00', 1, 0);
INSERT INTO `admins` VALUES (31, 'test', '8744e7fca81d48e9dfb1b5737b089e2f', 'hCsL4w', '测试', 'test@xxx.com', 1, '2024-10-11 14:43:39', '2024-10-11 14:43:39', '2024-10-11', 2, 34);

-- ----------------------------
-- Table structure for attachment_categories
-- ----------------------------
DROP TABLE IF EXISTS `attachment_categories`;
CREATE TABLE `attachment_categories`  (
  `attachment_category_id` int NOT NULL AUTO_INCREMENT,
  `attachment_type` int NOT NULL DEFAULT 1,
  `attachment_category` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`attachment_category_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 197 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of attachment_categories
-- ----------------------------

-- ----------------------------
-- Table structure for attachments
-- ----------------------------
DROP TABLE IF EXISTS `attachments`;
CREATE TABLE `attachments`  (
  `attachment_id` int NOT NULL AUTO_INCREMENT,
  `attachment_type` int NOT NULL DEFAULT 1,
  `external_id` int NOT NULL DEFAULT 0 COMMENT '关联外键',
  `external_id2` int NOT NULL DEFAULT 0 COMMENT '关联外键2',
  `pid` int NOT NULL DEFAULT 0 COMMENT '上级id',
  `status` tinyint NOT NULL DEFAULT 1 COMMENT '1=正常，-1=删除',
  `original_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `save_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `mime_type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL,
  `size` int NOT NULL DEFAULT 0,
  `attachment_category_id` int NOT NULL DEFAULT 0,
  `isdir` tinyint NOT NULL DEFAULT 0 COMMENT '是否文件夹',
  `entered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int NOT NULL DEFAULT 0,
  `user_type` tinyint NOT NULL DEFAULT 1 COMMENT '用户类型',
  PRIMARY KEY (`attachment_id`) USING BTREE,
  INDEX `idx_eid_type`(`external_id` ASC, `attachment_type` ASC) USING BTREE,
  INDEX `idx_user`(`user_id` ASC, `user_type` ASC) USING BTREE,
  INDEX `pid`(`pid` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7658 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of attachments
-- ----------------------------
INSERT INTO `attachments` VALUES (7647, 3, 520, 0, 0, 1, '航天奴星.docx', '20250813/764c74ac21e97595dfdb38142492dcf2.docx', 'application/x-empty', '', 0, 0, 0, '2025-08-13 16:37:45', 25, 1);
INSERT INTO `attachments` VALUES (7648, 100, 32, 0, 0, 1, '华夏幸福1号基金合伙协议.docx', '20250814/8396e85500276c2616471831b912e9bb.docx', 'application/x-empty', '', 0, 0, 0, '2025-08-14 11:12:41', 25, 1);
INSERT INTO `attachments` VALUES (7649, 250, 336, 0, 0, 1, '杭州会议纪要.docx', '20250814/792f8646be6ab49f1a4e405961adf771.docx', 'application/x-empty', '', 0, 0, 0, '2025-08-14 16:07:19', 25, 1);
INSERT INTO `attachments` VALUES (7650, 3, 523, 0, 0, 1, '摩尔线程商业计划书.pptx', '20250814/35464754e885310d500ae093f91d92f1.pptx', 'application/octet-stream', '', 35791, 0, 0, '2025-08-14 18:21:29', 25, 1);
INSERT INTO `attachments` VALUES (7651, 8, 16, 0, 0, 1, '李荣浩简历.xlsx', '20250814/ddb6929b43aba497722cc4745c7aa638.xlsx', 'application/octet-stream', '', 8455, 0, 0, '2025-08-14 18:23:40', 25, 1);
INSERT INTO `attachments` VALUES (7652, 7, 523, 0, 0, 1, '创始团队', '', '', NULL, 0, 0, 1, '2025-08-14 18:25:43', 25, 1);
INSERT INTO `attachments` VALUES (7653, 28, 523, 92, 0, 1, '摩尔线程立项决策.txt', '20250814/1f0454e8da2e4848c8a75659565468f4.txt', 'application/x-empty', '', 0, 0, 0, '2025-08-14 18:27:16', 25, 1);
INSERT INTO `attachments` VALUES (7654, 300, 13, 0, 0, 1, '行业展望', '', '', NULL, 0, 0, 1, '2025-08-26 18:29:47', 25, 1);
INSERT INTO `attachments` VALUES (7655, 300, 13, 0, 7654, 1, '碳化硅半导体10年展望.xls', '20250826/ba04668f7729f243a15dd627424641b3.xls', 'application/vnd.ms-excel', '', 19456, 0, 0, '2025-08-26 18:30:40', 25, 1);
INSERT INTO `attachments` VALUES (7656, 250, 338, 0, 0, 1, '会议资料', '', '', NULL, 0, 0, 1, '2025-08-28 23:17:52', 25, 1);
INSERT INTO `attachments` VALUES (7657, 250, 338, 0, 0, 1, '意向书', '', '', NULL, 0, 0, 1, '2025-08-28 23:17:59', 25, 1);

-- ----------------------------
-- Table structure for audit_logs
-- ----------------------------
DROP TABLE IF EXISTS `audit_logs`;
CREATE TABLE `audit_logs`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `model` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `record_id` int NOT NULL DEFAULT 0,
  `fields` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `desc` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `type` tinyint NOT NULL DEFAULT 1 COMMENT '1-add, 2-update, 3-delete',
  `ip` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `device` tinyint NOT NULL DEFAULT 1 COMMENT '1-computer, 2-mobile',
  `changed_by` int NOT NULL DEFAULT 0,
  `changed_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx_m_id`(`model` ASC, `id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8239 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci COMMENT = '审计日志' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of audit_logs
-- ----------------------------
INSERT INTO `audit_logs` VALUES (8190, 'Funds', 32, '|name|reg_place|size|partnership_start_date|partnership_end_date|establish_date|invest_period|invest_fee_ratio|exit_period|exit_fee_ratio|extend_period|', '新增：{\"基金名称\":\"华夏幸福1号\",\"基金注册地\":\"\",\"认缴规模\":0,\"合伙企业设立日期\":\"2025-08-01\",\"合伙企业终止日期\":\"2030-07-31\",\"备案成立日期\":\"2025-08-01\",\"基金投资期\":\"3\",\"投资期管理费率\":\"1.00\",\"基金退出期\":\"2\",\"退出期管理费率\":\"1.00\",\"基金延长期\":\"3\"}', 1, '113.118.169.131', 1, 31, '2025-08-13 14:39:23');
INSERT INTO `audit_logs` VALUES (8191, 'Enterprises', 519, '|name|description|', '新增：{\"企业名称\":\"伯达软件\",\"企业描述\":\"国软件产业发展的推动者，国家信息基础设施的建设者，国际化软件与服务的先行者和软件商业模式创新的探索者\"}', 1, '113.118.169.131', 1, 25, '2025-08-13 16:33:10');
INSERT INTO `audit_logs` VALUES (8192, 'Attachments', 0, '|original_name|description|attachment_type|', '新增：{\"原文件名\":\"航天奴星.docx\",\"描述\":\"\",\"文件类别\":\"商业计划书\"}', 1, '113.118.169.131', 1, 25, '2025-08-13 16:37:45');
INSERT INTO `audit_logs` VALUES (8193, 'Enterprises', 520, '|name|description|', '新增：{\"企业名称\":\"航天驭星\",\"企业描述\":\"航天驭星成立于2016年，总部位于北京，在西安、郑州、中卫、七台河、精河、鹤壁、南太平洋、非洲、南美等地建立了十几个分支机构，是集商业化航天测运控技术研发、航天通信产品制造和航天器在轨运管服务于一体的综合方案提供商。\\r\\n\\r\\n公司以“让卫星更好用，让卫星更易用”为己任，致力于建设全球化的商业航天基础设施，为全球航天用户提供包含火箭发射测控、卫星测运控、载荷数据接收、遥感卫星定标、空间碰撞预警、空间碎片清理、航天数字化应用、航天科普推广等服务在内的一揽子解决方案。\\r\\n\\r\\n公司获得国家高新技术企业、国家级专精特新“小巨人”企业、北京民营中小企业百强等荣誉称号。目前，已建成了包含60余套地面站在内的全球化的卫星地面站网和综合定标场，累计服务的卫星、火箭数量超370，在国内商业航天测运控领域处于领先地位。\"}', 1, '113.118.169.131', 1, 25, '2025-08-13 16:37:46');
INSERT INTO `audit_logs` VALUES (8194, 'Enterprises', 521, '|name|description|', '新增：{\"企业名称\":\"Momenta\",\"企业描述\":\"Momenta,自动驾驶,无人驾驶,曹旭东,Robotaxi\"}', 1, '113.118.169.131', 1, 25, '2025-08-13 17:14:10');
INSERT INTO `audit_logs` VALUES (8195, 'Enterprises', 522, '|name|description|', '新增：{\"企业名称\":\"米哈游\",\"企业描述\":\"米哈游成立于2011年，致力于为用户提供美好的、超出预期的产品与内容。米哈游陆续推出了多款高品质人气产品，包括《崩坏学园2》、《崩坏3》、《未定事件簿》、《原神》、《崩坏：星穹铁道》、《绝区零》，并围绕原创IP打造了动画、音乐及周边等多元产品。\"}', 1, '113.118.169.131', 1, 25, '2025-08-13 17:16:50');
INSERT INTO `audit_logs` VALUES (8196, 'Partners', 66, '|name|tel|email|address|type|credential_type|credential_no|', '新增：{\"姓名\":\"小马哥\",\"电话\":\"\",\"电子邮箱\":\"\",\"地址\":\"\",\"类型\":\"个人有限合伙人\",\"证件类型\":\"身份证\",\"证件号码\":\"\"}', 1, '113.118.169.131', 1, 25, '2025-08-13 17:18:50');
INSERT INTO `audit_logs` VALUES (8197, 'Partners', 67, '|name|tel|email|address|type|credential_type|credential_no|', '新增：{\"姓名\":\"雷布斯\",\"电话\":\"\",\"电子邮箱\":\"\",\"地址\":\"\",\"类型\":\"个人有限合伙人\",\"证件类型\":\"身份证\",\"证件号码\":\"\"}', 1, '113.118.169.131', 1, 25, '2025-08-13 17:18:59');
INSERT INTO `audit_logs` VALUES (8198, 'Partners', 68, '|name|tel|email|address|type|credential_type|credential_no|', '新增：{\"姓名\":\"马爸爸\",\"电话\":\"\",\"电子邮箱\":\"\",\"地址\":\"\",\"类型\":\"个人有限合伙人\",\"证件类型\":\"身份证\",\"证件号码\":\"\"}', 1, '113.118.169.131', 1, 25, '2025-08-13 17:19:16');
INSERT INTO `audit_logs` VALUES (8199, 'Partners', 69, '|name|tel|email|address|type|credential_type|credential_no|', '新增：{\"姓名\":\"顺为投资\",\"电话\":\"\",\"电子邮箱\":\"\",\"地址\":\"\",\"类型\":\"机构有限合伙人\",\"证件类型\":\"营业执照\",\"证件号码\":\"\"}', 1, '113.118.169.131', 1, 25, '2025-08-13 17:21:16');
INSERT INTO `audit_logs` VALUES (8200, 'Funds', 33, '|name|reg_place|size|partnership_start_date|partnership_end_date|establish_date|invest_period|invest_fee_ratio|exit_period|exit_fee_ratio|extend_period|', '新增：{\"基金名称\":\"盛世1号\",\"基金注册地\":\"\",\"认缴规模\":0,\"合伙企业设立日期\":\"0000-00-00 00:00:00\",\"合伙企业终止日期\":\"0000-00-00 00:00:00\",\"备案成立日期\":\"0000-00-00 00:00:00\",\"基金投资期\":0,\"投资期管理费率\":0,\"基金退出期\":0,\"退出期管理费率\":0,\"基金延长期\":0}', 1, '113.118.169.131', 1, 25, '2025-08-13 17:21:48');
INSERT INTO `audit_logs` VALUES (8201, 'Funds', 32, '|size|', '更改前：{\"认缴规模\":\"0.00\"};<br />更改后：{\"认缴规模\":\"100000000.00\"}', 2, '113.118.169.131', 1, 25, '2025-08-13 17:22:43');
INSERT INTO `audit_logs` VALUES (8202, 'Funds', 33, '|size|partnership_start_date|partnership_end_date|establish_date|', '更改前：{\"认缴规模\":\"0.00\",\"合伙企业设立日期\":\"0000-00-00\",\"合伙企业终止日期\":\"0000-00-00\",\"备案成立日期\":\"0000-00-00\"};<br />更改后：{\"认缴规模\":\"20000000.00\",\"合伙企业设立日期\":\"0000-00-00 00:00:00\",\"合伙企业终止日期\":\"0000-00-00 00:00:00\",\"备案成立日期\":\"0000-00-00 00:00:00\"}', 2, '113.118.169.131', 1, 25, '2025-08-13 17:23:12');
INSERT INTO `audit_logs` VALUES (8203, 'Partners', 70, '|name|tel|email|address|type|credential_type|credential_no|', '新增：{\"姓名\":\"一带一路大基金\",\"电话\":\"\",\"电子邮箱\":\"\",\"地址\":\"\",\"类型\":\"普通合伙人\",\"证件类型\":\"身份证\",\"证件号码\":\"\"}', 1, '113.118.169.131', 1, 25, '2025-08-14 11:10:41');
INSERT INTO `audit_logs` VALUES (8204, 'Attachments', 32, '|original_name|description|attachment_type|', '新增：{\"原文件名\":\"华夏幸福1号基金合伙协议.docx\",\"描述\":\"\",\"文件类别\":\"基金合伙人协议\"}', 1, '113.118.169.131', 1, 25, '2025-08-14 11:12:41');
INSERT INTO `audit_logs` VALUES (8205, 'Scientists', 83, '|name|field|place|contact_way|brief_introduction|core_tech|', '新增：{\"姓名\":\"张某某\",\"领域\":\"\",\"工作场所\":\"\",\"联系方式\":\"\",\"简介\":\"\",\"核心技术\":\"\"}', 1, '113.118.169.131', 1, 25, '2025-08-14 11:21:12');
INSERT INTO `audit_logs` VALUES (8206, 'Scientists', 84, '|name|field|place|contact_way|brief_introduction|core_tech|', '新增：{\"姓名\":\"李菲菲\",\"领域\":\"\",\"工作场所\":\"\",\"联系方式\":\"\",\"简介\":\"\",\"核心技术\":\"\"}', 1, '113.118.169.131', 1, 25, '2025-08-14 11:21:18');
INSERT INTO `audit_logs` VALUES (8207, 'Scientists', 84, '|field|', '更改前：{\"领域\":\"\"};<br />更改后：{\"领域\":\"人工智能\"}', 2, '113.118.169.131', 1, 25, '2025-08-14 11:21:26');
INSERT INTO `audit_logs` VALUES (8208, 'Scientists', 83, '|field|', '更改前：{\"领域\":\"\"};<br />更改后：{\"领域\":\"创新医药\"}', 2, '113.118.169.131', 1, 25, '2025-08-14 11:21:35');
INSERT INTO `audit_logs` VALUES (8209, 'Funds', 34, '|name|reg_place|size|partnership_start_date|partnership_end_date|establish_date|invest_period|invest_fee_ratio|exit_period|exit_fee_ratio|extend_period|', '新增：{\"基金名称\":\"华泰人工智能1号投资合伙企业（有限合伙）\",\"基金注册地\":\"广东省深圳市\",\"认缴规模\":\"50000000.00\",\"合伙企业设立日期\":\"2024-06-01\",\"合伙企业终止日期\":\"2029-05-31\",\"备案成立日期\":\"2024-06-01\",\"基金投资期\":\"5\",\"投资期管理费率\":\"1.00\",\"基金退出期\":\"2\",\"退出期管理费率\":\"1.00\",\"基金延长期\":\"1\"}', 1, '113.118.169.131', 1, 25, '2025-08-14 11:32:22');
INSERT INTO `audit_logs` VALUES (8210, 'Milestones', 34, '|category|occur_date|desc|', '新增：{\"里程碑名称\":\"基金\",\"里程碑日期\":\"2025-08-30\",\"里程碑描述\":\"银行托管办理\"}', 1, '113.118.169.131', 1, 25, '2025-08-14 15:40:07');
INSERT INTO `audit_logs` VALUES (8211, 'Attachments', 336, '|original_name|description|attachment_type|', '新增：{\"原文件名\":\"杭州会议纪要.docx\",\"描述\":\"\",\"文件类别\":\"\"}', 1, '113.118.169.131', 1, 25, '2025-08-14 16:07:19');
INSERT INTO `audit_logs` VALUES (8212, 'Attachments', 0, '|original_name|description|attachment_type|', '新增：{\"原文件名\":\"摩尔线程商业计划书.pptx\",\"描述\":\"\",\"文件类别\":\"商业计划书\"}', 1, '113.118.169.131', 1, 25, '2025-08-14 18:21:29');
INSERT INTO `audit_logs` VALUES (8213, 'Enterprises', 523, '|name|description|', '新增：{\"企业名称\":\"摩尔线程\",\"企业描述\":\"摩尔线程成立于 2020 年 6 月，以全功能 GPU 为核心，致力于向全球提供加速计算的基础设施和一站式解决方案，为各行各业的数智化转型提供强大的 AI 计算支持。\"}', 1, '113.118.169.131', 1, 25, '2025-08-14 18:21:35');
INSERT INTO `audit_logs` VALUES (8214, 'Attachments', 0, '|original_name|description|attachment_type|', '新增：{\"原文件名\":\"李荣浩简历.xlsx\",\"描述\":\"\",\"文件类别\":\"创始人附件\"}', 1, '113.118.169.131', 1, 25, '2025-08-14 18:23:40');
INSERT INTO `audit_logs` VALUES (8215, 'Attachments', 0, '|original_name|description|attachment_type|', '新增：{\"原文件名\":\"摩尔线程立项决策.txt\",\"描述\":\"\",\"文件类别\":\"投决会资料\"}', 1, '113.118.169.131', 1, 25, '2025-08-14 18:27:16');
INSERT INTO `audit_logs` VALUES (8216, 'FundsFinanceEnterprises', 32, '|fund_id|title|amount|date|enterprise_id|', '新增：{\"基金名称\":\"华夏幸福1号\",\"标题\":\"摩尔线程-投资交割\",\"投资金额\":\"20000000.00\",\"投资日期\":\"2025-08-14\",\"投资企业\":\"摩尔线程\"}', 1, '113.118.169.131', 1, 25, '2025-08-14 18:34:35');
INSERT INTO `audit_logs` VALUES (8217, 'FundsFinanceContributes', 34, '|fund_id|title|amount|date|', '新增：{\"基金名称\":\"华泰人工智能1号投资合伙企业（有限合伙）\",\"标题\":\"小马哥合伙出资\",\"出资金额\":\"500000.00\",\"出资日期\":\"2025-08-22\"}', 1, '113.110.175.160', 1, 25, '2025-08-22 17:02:50');
INSERT INTO `audit_logs` VALUES (8218, 'FundsFinanceContributes', 34, '|fund_id|title|amount|date|', '新增：{\"基金名称\":\"华泰人工智能1号投资合伙企业（有限合伙）\",\"标题\":\"小马哥合伙出资\",\"出资金额\":\"500000.00\",\"出资日期\":\"2025-08-22\"}', 1, '120.229.76.12', 1, 25, '2025-08-22 21:37:04');
INSERT INTO `audit_logs` VALUES (8219, 'FundsFinanceTaxes', 34, '|fund_id|title|amount|date|type|', '新增：{\"基金名称\":\"华泰人工智能1号投资合伙企业（有限合伙）\",\"缴税标题\":\"小马哥合伙出资-增值税\",\"缴税金额\":\"10000.00\",\"缴税日期\":\"2025-08-22\",\"类型\":\"增值税\"}', 1, '120.229.76.12', 1, 25, '2025-08-22 21:37:04');
INSERT INTO `audit_logs` VALUES (8220, 'FundsFinanceTaxes', 34, '|title|amount|type|', '更改前：{\"缴税标题\":\"小马哥合伙出资-增值税\",\"缴税金额\":\"10000.00\",\"类型\":\"增值税\"};<br />更改后：{\"缴税标题\":\"小马哥合伙出资-个人经营所得税\",\"缴税金额\":\"20000.00\",\"类型\":\"个人经营所得税\"}', 2, '120.229.76.12', 1, 25, '2025-08-22 21:37:04');
INSERT INTO `audit_logs` VALUES (8221, 'FundsFinanceContributes', 34, '|fund_id|title|amount|date|', '新增：{\"基金名称\":\"华泰人工智能1号投资合伙企业（有限合伙）\",\"标题\":\"小马哥合伙出资\",\"出资金额\":\"500000.00\",\"出资日期\":\"2025-08-22\"}', 1, '120.229.76.12', 1, 25, '2025-08-22 21:39:02');
INSERT INTO `audit_logs` VALUES (8222, 'FundsFinanceTaxes', 34, '|fund_id|title|amount|date|type|', '新增：{\"基金名称\":\"华泰人工智能1号投资合伙企业（有限合伙）\",\"缴税标题\":\"小马哥合伙出资-增值税\",\"缴税金额\":\"10000.00\",\"缴税日期\":\"2025-08-22\",\"类型\":\"增值税\"}', 1, '120.229.76.12', 1, 25, '2025-08-22 21:39:02');
INSERT INTO `audit_logs` VALUES (8223, 'FundsFinanceTaxes', 34, '|title|amount|type|', '更改前：{\"缴税标题\":\"小马哥合伙出资-增值税\",\"缴税金额\":\"10000.00\",\"类型\":\"增值税\"};<br />更改后：{\"缴税标题\":\"小马哥合伙出资-个人经营所得税\",\"缴税金额\":\"20000.00\",\"类型\":\"个人经营所得税\"}', 2, '120.229.76.12', 1, 25, '2025-08-22 21:39:02');
INSERT INTO `audit_logs` VALUES (8224, 'FundsFinanceContributes', 34, '|fund_id|title|amount|date|', '新增：{\"基金名称\":\"华泰人工智能1号投资合伙企业（有限合伙）\",\"标题\":\"小马哥合伙出资\",\"出资金额\":\"500000.00\",\"出资日期\":\"2025-08-22\"}', 1, '120.229.76.12', 1, 25, '2025-08-22 21:39:13');
INSERT INTO `audit_logs` VALUES (8225, 'FundsFinanceTaxes', 34, '|fund_id|title|amount|date|type|', '新增：{\"基金名称\":\"华泰人工智能1号投资合伙企业（有限合伙）\",\"缴税标题\":\"小马哥合伙出资-增值税\",\"缴税金额\":\"10000.00\",\"缴税日期\":\"2025-08-22\",\"类型\":\"增值税\"}', 1, '120.229.76.12', 1, 25, '2025-08-22 21:39:13');
INSERT INTO `audit_logs` VALUES (8226, 'FundsFinanceTaxes', 34, '|title|amount|type|', '更改前：{\"缴税标题\":\"小马哥合伙出资-增值税\",\"缴税金额\":\"10000.00\",\"类型\":\"增值税\"};<br />更改后：{\"缴税标题\":\"小马哥合伙出资-个人经营所得税\",\"缴税金额\":\"20000.00\",\"类型\":\"个人经营所得税\"}', 2, '120.229.76.12', 1, 25, '2025-08-22 21:39:13');
INSERT INTO `audit_logs` VALUES (8227, 'FundsFinanceContributes', 34, '|fund_id|title|amount|date|', '新增：{\"基金名称\":\"华泰人工智能1号投资合伙企业（有限合伙）\",\"标题\":\"小马哥合伙出资\",\"出资金额\":\"5000000.00\",\"出资日期\":\"2025-08-31\"}', 1, '120.229.76.12', 1, 25, '2025-08-22 21:47:50');
INSERT INTO `audit_logs` VALUES (8228, 'FundsFinanceTaxes', 34, '|fund_id|title|amount|date|type|', '新增：{\"基金名称\":\"华泰人工智能1号投资合伙企业（有限合伙）\",\"缴税标题\":\"小马哥合伙出资-增值税\",\"缴税金额\":\"10000.00\",\"缴税日期\":\"2025-08-31\",\"类型\":\"增值税\"}', 1, '120.229.76.12', 1, 25, '2025-08-22 21:47:50');
INSERT INTO `audit_logs` VALUES (8229, 'FundsFinanceTaxes', 34, '|fund_id|title|amount|date|type|', '新增：{\"基金名称\":\"华泰人工智能1号投资合伙企业（有限合伙）\",\"缴税标题\":\"小马哥合伙出资-个人经营所得税\",\"缴税金额\":\"20000.00\",\"缴税日期\":\"2025-08-31\",\"类型\":\"个人经营所得税\"}', 1, '120.229.76.12', 1, 25, '2025-08-22 21:47:50');
INSERT INTO `audit_logs` VALUES (8230, 'FundsFinanceContributes', 32, '|fund_id|title|amount|date|', '新增：{\"基金名称\":\"华夏幸福1号\",\"标题\":\"一带一路大基金合伙出资\",\"出资金额\":\"50000000.00\",\"出资日期\":\"2025-08-22\"}', 1, '120.229.76.12', 1, 25, '2025-08-22 22:23:26');
INSERT INTO `audit_logs` VALUES (8231, 'FundsFinanceTaxes', 32, '|fund_id|title|amount|date|type|', '新增：{\"基金名称\":\"华夏幸福1号\",\"缴税标题\":\"一带一路大基金合伙出资-增值税\",\"缴税金额\":\"1000.00\",\"缴税日期\":\"2025-08-22\",\"类型\":\"增值税\"}', 1, '120.229.76.12', 1, 25, '2025-08-22 22:32:44');
INSERT INTO `audit_logs` VALUES (8232, 'FundsFinanceTaxes', 32, '|fund_id|title|amount|date|type|', '新增：{\"基金名称\":\"华夏幸福1号\",\"缴税标题\":\"一带一路大基金合伙出资-个人经营所得税\",\"缴税金额\":\"2000.00\",\"缴税日期\":\"2025-08-22\",\"类型\":\"个人经营所得税\"}', 1, '120.229.76.12', 1, 25, '2025-08-22 22:32:44');
INSERT INTO `audit_logs` VALUES (8233, 'FundsFinanceFees', 32, '|fund_id|title|amount|from_date|end_date|type|', '新增：{\"基金名称\":\"华夏幸福1号\",\"费用标题\":\"财务代理费\",\"费用金额\":\"5000.00\",\"开始日期\":\"2025-04-01\",\"结束日期\":\"2025-06-30\",\"类型\":\"管理费\"}', 1, '120.229.76.12', 1, 25, '2025-08-22 22:34:03');
INSERT INTO `audit_logs` VALUES (8234, 'FundsFinanceIncomes', 34, '|fund_id|title|amount|date|type|', '新增：{\"基金名称\":\"华泰人工智能1号投资合伙企业（有限合伙）\",\"收入标题\":\"招商资本10万股\",\"收入金额\":\"1000000.00\",\"收入日期\":\"2025-08-24\",\"类型\":\"股权转让\"}', 1, '120.229.76.99', 1, 25, '2025-08-24 22:20:45');
INSERT INTO `audit_logs` VALUES (8235, 'FundsFinanceTaxes', 32, '|fund_id|title|amount|date|type|', '新增：{\"基金名称\":\"华夏幸福1号\",\"缴税标题\":\"2025年3季度\",\"缴税金额\":\"10000.00\",\"缴税日期\":\"2025-07-01\",\"类型\":\"印花税\"}', 1, '113.118.171.147', 1, 25, '2025-08-25 17:44:00');
INSERT INTO `audit_logs` VALUES (8236, 'FundsFinanceTaxes', 32, '|fund_id|title|amount|date|type|', '新增：{\"基金名称\":\"华夏幸福1号\",\"缴税标题\":\"一带一路大基金合伙出资-印花税\",\"缴税金额\":\"20000.00\",\"缴税日期\":\"2025-08-22\",\"类型\":\"印花税\"}', 1, '113.118.171.147', 1, 25, '2025-08-25 17:45:09');
INSERT INTO `audit_logs` VALUES (8237, 'Attachments', 13, '|original_name|description|attachment_type|', '新增：{\"原文件名\":\"碳化硅半导体10年展望.xls\",\"描述\":\"\",\"文件类别\":\"行研报告\"}', 1, '113.118.171.147', 1, 25, '2025-08-26 18:30:40');
INSERT INTO `audit_logs` VALUES (8238, 'Milestones', 33, '|category|occur_date|desc|', '新增：{\"里程碑名称\":\"基金\",\"里程碑日期\":\"2025-08-28\",\"里程碑描述\":\"基金推介会成功举办\"}', 1, '120.229.76.71', 1, 25, '2025-08-28 23:17:29');

-- ----------------------------
-- Table structure for change_logs
-- ----------------------------
DROP TABLE IF EXISTS `change_logs`;
CREATE TABLE `change_logs`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `external_id` int NOT NULL DEFAULT 0,
  `category` tinyint NOT NULL DEFAULT 1,
  `desc` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `change_date` date NOT NULL DEFAULT '0000-00-00',
  `from_date` date NOT NULL DEFAULT '0000-00-00',
  `end_date` date NOT NULL DEFAULT '0000-00-00',
  `entered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 62 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci COMMENT = '变更日志' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of change_logs
-- ----------------------------

-- ----------------------------
-- Table structure for companies
-- ----------------------------
DROP TABLE IF EXISTS `companies`;
CREATE TABLE `companies`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT '公司名称',
  `province` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL COMMENT '所属省份',
  `controller` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL COMMENT '实际控制人',
  `forms` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL COMMENT '企业所有制性质',
  `introduction` varchar(400) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL COMMENT '公司简介',
  `chairman` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL COMMENT '董事长',
  `established_date` date NULL DEFAULT NULL COMMENT '成立日期',
  `reg_asset` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL COMMENT '注册资本',
  `listed_date` date NULL DEFAULT NULL COMMENT '上市日期',
  `website` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL COMMENT '公司网址',
  `assigner` int NOT NULL DEFAULT 0 COMMENT '跟进人',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `created_by` int NOT NULL COMMENT '录入人',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 76 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci COMMENT = '上市公司' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of companies
-- ----------------------------
INSERT INTO `companies` VALUES (74, '北京金山办公软件股份有限公司', '', '', '', '', '', NULL, '', NULL, '', 25, '2025-08-13 16:29:10', 25);
INSERT INTO `companies` VALUES (75, '三五互联', '', '', '', '', '', NULL, '', NULL, '', 31, '2025-08-13 16:29:25', 25);

-- ----------------------------
-- Table structure for config_business_reg_proxy
-- ----------------------------
DROP TABLE IF EXISTS `config_business_reg_proxy`;
CREATE TABLE `config_business_reg_proxy`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `linkman` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `tel` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `entered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of config_business_reg_proxy
-- ----------------------------
INSERT INTO `config_business_reg_proxy` VALUES (8, '天天向上财会代理公司', '李红', '13560601010', '2025-08-14 11:14:17');

-- ----------------------------
-- Table structure for config_fund_hosting_agency
-- ----------------------------
DROP TABLE IF EXISTS `config_fund_hosting_agency`;
CREATE TABLE `config_fund_hosting_agency`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `linkman` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `tel` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `entered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of config_fund_hosting_agency
-- ----------------------------
INSERT INTO `config_fund_hosting_agency` VALUES (4, '中国工商银行股份有限公司', '', '', '2025-08-14 11:14:45');
INSERT INTO `config_fund_hosting_agency` VALUES (5, '交通银行股份有限公司', '', '', '2025-08-14 12:10:53');

-- ----------------------------
-- Table structure for config_scientist_field
-- ----------------------------
DROP TABLE IF EXISTS `config_scientist_field`;
CREATE TABLE `config_scientist_field`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `entered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci COMMENT = '科学家研究领域' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of config_scientist_field
-- ----------------------------
INSERT INTO `config_scientist_field` VALUES (16, '人工智能', '2025-08-14 11:16:34');
INSERT INTO `config_scientist_field` VALUES (17, '具身智能', '2025-08-14 11:16:42');
INSERT INTO `config_scientist_field` VALUES (18, '创新医药', '2025-08-14 11:17:06');

-- ----------------------------
-- Table structure for contacts
-- ----------------------------
DROP TABLE IF EXISTS `contacts`;
CREATE TABLE `contacts`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '姓名',
  `username` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '登录账号',
  `password` char(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '登录密码',
  `assigner` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '主跟进人',
  `additional_assigners` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '辅助跟进人',
  `gender` char(4) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '性别',
  `photo` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '照片',
  `title` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '头衔',
  `contact` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '联系方式',
  `email` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '邮箱',
  `education` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '教育背景',
  `work_exp` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '工作经验',
  `age` tinyint UNSIGNED NULL DEFAULT NULL COMMENT '年龄',
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL COMMENT '背景',
  `deleted` tinyint(1) NOT NULL DEFAULT 0 COMMENT '删除标志',
  `created_by` char(36) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '创建人',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx_assigner`(`assigner` ASC) USING BTREE,
  INDEX `idx_username`(`username` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci COMMENT = '人才库' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of contacts
-- ----------------------------
INSERT INTO `contacts` VALUES (5, '雷布斯', '', '', '25', '31', '', '', '首席执行官', '13510101010', '', '', '', NULL, '雷军于1991年毕业于武汉大学 [11]，后被分配到北京航天部某研究所工作 [69]。1992年1月，加盟金山软件公司 [69]，8月，任金山公司北京开发部经理。1994年，任北京金山软件公司总经理 [11]。1996年11月，带领团队开发WPS 97，为金山制定新战术，先后推出了金山影霸、金山词霸、游戏《剑侠情缘》等产品 [61]。1998年，出任金山首席执行官（CEO） [59] [61]。2000年底，任北京金山软件股份有限公司总裁 [11]。2007年12月，卸任金山软件首席执行官 [81]，投身天使投资行业 [59]。2010年4月6日，创立小米公司 [63] [66]。2011年7月，时隔三年半后重回金山，出任金山软件有限公司董事长 [59-60]。2015年4月起，任金山云控股有限公司董事长 [219]。2016年5月17日，接手小米手机部 [221]。2019年5月17日，兼任中国区总裁，全面负责中国区业务开展和团队管理 [226]。2021年3月30日，任小米智能电动汽车业务首席执行官', 1, '25', '2025-08-13 16:02:18');
INSERT INTO `contacts` VALUES (6, '雷布斯', '', '', '25', '31', '', '', '首席执行官', '13510101010', '', '', '', NULL, '雷军于1991年毕业于武汉大学 [11]，后被分配到北京航天部某研究所工作 [69]。1992年1月，加盟金山软件公司 [69]，8月，任金山公司北京开发部经理。1994年，任北京金山软件公司总经理 [11]。1996年11月，带领团队开发WPS 97，为金山制定新战术，先后推出了金山影霸、金山词霸、游戏《剑侠情缘》等产品 [61]。1998年，出任金山首席执行官（CEO） [59] [61]。2000年底，任北京金山软件股份有限公司总裁 [11]。2007年12月，卸任金山软件首席执行官 [81]，投身天使投资行业 [59]。2010年4月6日，创立小米公司 [63] [66]。2011年7月，时隔三年半后重回金山，出任金山软件有限公司董事长 [59-60]。2015年4月起，任金山云控股有限公司董事长 [219]。2016年5月17日，接手小米手机部 [221]。2019年5月17日，兼任中国区总裁，全面负责中国区业务开展和团队管理 [226]。2021年3月30日，任小米智能电动汽车业务首席执行官', 1, '25', '2025-08-13 16:06:48');
INSERT INTO `contacts` VALUES (7, '雷布斯', '', '', '25', '31', '', '', '首席执行官', '13510101010', '', '', '', NULL, '雷军于1991年毕业于武汉大学 [11]，后被分配到北京航天部某研究所工作 [69]。1992年1月，加盟金山软件公司 [69]，8月，任金山公司北京开发部经理。1994年，任北京金山软件公司总经理 [11]。1996年11月，带领团队开发WPS 97，为金山制定新战术，先后推出了金山影霸、金山词霸、游戏《剑侠情缘》等产品 [61]。1998年，出任金山首席执行官（CEO） [59] [61]。2000年底，任北京金山软件股份有限公司总裁 [11]。2007年12月，卸任金山软件首席执行官 [81]，投身天使投资行业 [59]。2010年4月6日，创立小米公司 [63] [66]。2011年7月，时隔三年半后重回金山，出任金山软件有限公司董事长 [59-60]。2015年4月起，任金山云控股有限公司董事长 [219]。2016年5月17日，接手小米手机部 [221]。2019年5月17日，兼任中国区总裁，全面负责中国区业务开展和团队管理 [226]。2021年3月30日，任小米智能电动汽车业务首席执行官', 1, '25', '2025-08-13 16:09:11');
INSERT INTO `contacts` VALUES (8, '雷布斯', '', '', '25', '31', '', '', '首席执行官', '13510101010', '', '', '', NULL, '雷军于1991年毕业于武汉大学 [11]，后被分配到北京航天部某研究所工作 [69]。1992年1月，加盟金山软件公司 [69]，8月，任金山公司北京开发部经理。1994年，任北京金山软件公司总经理 [11]。1996年11月，带领团队开发WPS 97，为金山制定新战术，先后推出了金山影霸、金山词霸、游戏《剑侠情缘》等产品 [61]。1998年，出任金山首席执行官（CEO） [59] [61]。2000年底，任北京金山软件股份有限公司总裁 [11]。2007年12月，卸任金山软件首席执行官 [81]，投身天使投资行业 [59]。2010年4月6日，创立小米公司 [63] [66]。2011年7月，时隔三年半后重回金山，出任金山软件有限公司董事长 [59-60]。2015年4月起，任金山云控股有限公司董事长 [219]。2016年5月17日，接手小米手机部 [221]。2019年5月17日，兼任中国区总裁，全面负责中国区业务开展和团队管理 [226]。2021年3月30日，任小米智能电动汽车业务首席执行官', 1, '25', '2025-08-13 16:13:27');
INSERT INTO `contacts` VALUES (9, '雷布斯', '', '', '25', '31', '', '', '首席执行官', '13510101010', '', '', '', NULL, '雷军于1991年毕业于武汉大学 [11]，后被分配到北京航天部某研究所工作 [69]。1992年1月，加盟金山软件公司 [69]，8月，任金山公司北京开发部经理。1994年，任北京金山软件公司总经理 [11]。1996年11月，带领团队开发WPS 97，为金山制定新战术，先后推出了金山影霸、金山词霸、游戏《剑侠情缘》等产品 [61]。1998年，出任金山首席执行官（CEO） [59] [61]。2000年底，任北京金山软件股份有限公司总裁 [11]。2007年12月，卸任金山软件首席执行官 [81]，投身天使投资行业 [59]。2010年4月6日，创立小米公司 [63] [66]。2011年7月，时隔三年半后重回金山，出任金山软件有限公司董事长 [59-60]。2015年4月起，任金山云控股有限公司董事长 [219]。2016年5月17日，接手小米手机部 [221]。2019年5月17日，兼任中国区总裁，全面负责中国区业务开展和团队管理 [226]。2021年3月30日，任小米智能电动汽车业务首席执行官', 1, '25', '2025-08-13 16:13:50');
INSERT INTO `contacts` VALUES (10, '雷布斯', '', '', '25', '31', '', '', '首席执行官', '13510101010', '', '', '', NULL, '雷军于1991年毕业于武汉大学 [11]，后被分配到北京航天部某研究所工作 [69]。1992年1月，加盟金山软件公司 [69]，8月，任金山公司北京开发部经理。1994年，任北京金山软件公司总经理 [11]。1996年11月，带领团队开发WPS 97，为金山制定新战术，先后推出了金山影霸、金山词霸、游戏《剑侠情缘》等产品 [61]。1998年，出任金山首席执行官（CEO） [59] [61]。2000年底，任北京金山软件股份有限公司总裁 [11]。2007年12月，卸任金山软件首席执行官 [81]，投身天使投资行业 [59]。2010年4月6日，创立小米公司 [63] [66]。2011年7月，时隔三年半后重回金山，出任金山软件有限公司董事长 [59-60]。2015年4月起，任金山云控股有限公司董事长 [219]。2016年5月17日，接手小米手机部 [221]。2019年5月17日，兼任中国区总裁，全面负责中国区业务开展和团队管理 [226]。2021年3月30日，任小米智能电动汽车业务首席执行官', 0, '25', '2025-08-13 16:19:20');
INSERT INTO `contacts` VALUES (11, '李伯达', '', '', '25', '', '', '', '创始人', '', '', '', '', NULL, '', 0, '25', '2025-08-13 16:33:10');
INSERT INTO `contacts` VALUES (12, '张天一', '', '', '31', '', '', '', '创始人', '', '', '', '', NULL, NULL, 0, '25', '2025-08-13 16:37:46');
INSERT INTO `contacts` VALUES (13, '曹旭东', '', '', '31', '', '', '', '创始人', '+86 (010)82526609', '', '', '', NULL, NULL, 0, '25', '2025-08-13 17:14:10');
INSERT INTO `contacts` VALUES (14, '王欣欣', '', '', '25,31', '', '', '', '创始人', '', '', '', '', NULL, '', 0, '25', '2025-08-13 17:16:50');
INSERT INTO `contacts` VALUES (15, '司马光', '', '', '25', '', '', '', '创始人', '', '', '', '', NULL, NULL, 0, '25', '2025-08-14 18:21:35');
INSERT INTO `contacts` VALUES (16, '李荣浩', '', '', '25', '', '', '', '', '', '', '', '', NULL, '技术牛人', 0, '25', '2025-08-14 18:24:06');

-- ----------------------------
-- Table structure for dropdowns
-- ----------------------------
DROP TABLE IF EXISTS `dropdowns`;
CREATE TABLE `dropdowns`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `field` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `items` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL COMMENT 'json数据',
  `description` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `idx_unique_name`(`field` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dropdowns
-- ----------------------------
INSERT INTO `dropdowns` VALUES (6, 'enterprise_lead_source', '[{\"label\":\"现有客户\",\"value\":\"现有客户\"},{\"label\":\"产业合伙人\",\"value\":\"产业合伙人\"},{\"label\":\"产业伙伴\",\"value\":\"产业伙伴\"},{\"label\":\"投资合伙人\",\"value\":\"投资合伙人\"},{\"label\":\"市场研究\",\"value\":\"市场研究\"},{\"label\":\"美国伙伴\",\"value\":\"美国伙伴\"}]', '项目来源');
INSERT INTO `dropdowns` VALUES (7, 'financing_stage', '[{\"label\":\"种子轮\",\"value\":\"1\"},{\"label\":\"天使轮\",\"value\":\"2\"},{\"label\":\"Pre-A轮\",\"value\":\"3\"},{\"label\":\"A轮\",\"value\":\"4\"},{\"label\":\"B轮\",\"value\":\"5\"},{\"label\":\"C轮\",\"value\":\"6\"},{\"label\":\"C+轮\",\"value\":\"7\"},{\"label\":\"B+轮\",\"value\":\"8\"},{\"label\":\"A+轮\",\"value\":\"9\"},{\"label\":\"Pre-IPO\",\"value\":\"10\"},{\"label\":\"老股转让\",\"value\":\"11\"}]', '融资阶段');

-- ----------------------------
-- Table structure for enterprise_shareholder
-- ----------------------------
DROP TABLE IF EXISTS `enterprise_shareholder`;
CREATE TABLE `enterprise_shareholder`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `eid` int NOT NULL COMMENT '企业id',
  `efid` int NOT NULL DEFAULT 0 COMMENT '关联融资表id',
  `date` date NOT NULL DEFAULT '0000-00-00' COMMENT '股东表日期',
  `name` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '标题',
  `date_entered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `eid`(`eid` ASC) USING BTREE,
  INDEX `efid`(`efid` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 99 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci COMMENT = '企业股东表' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of enterprise_shareholder
-- ----------------------------

-- ----------------------------
-- Table structure for enterprise_shareholder_detail
-- ----------------------------
DROP TABLE IF EXISTS `enterprise_shareholder_detail`;
CREATE TABLE `enterprise_shareholder_detail`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `esid` int NOT NULL COMMENT '股东表id',
  `name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT '股东名称',
  `reg_asset` bigint UNSIGNED NULL DEFAULT NULL COMMENT '注册资本（元）',
  `investment` bigint UNSIGNED NULL DEFAULT NULL COMMENT '投资金额（元）',
  `stock_total` bigint UNSIGNED NULL DEFAULT NULL COMMENT '持股份数（股）',
  `stock_ratio` decimal(6, 3) UNSIGNED NOT NULL COMMENT '持股比例',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `esid`(`esid` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1490 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of enterprise_shareholder_detail
-- ----------------------------

-- ----------------------------
-- Table structure for enterprises
-- ----------------------------
DROP TABLE IF EXISTS `enterprises`;
CREATE TABLE `enterprises`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL DEFAULT 0,
  `deleted` tinyint NOT NULL DEFAULT 0,
  `step` tinyint UNSIGNED NOT NULL DEFAULT 1,
  `step_state` tinyint NOT NULL DEFAULT 0,
  `founder` int NOT NULL DEFAULT 0 COMMENT '创始人',
  `assigner` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '主跟进人',
  `additional_assigners` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '辅助跟进人',
  `name` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT '企业名称',
  `logo` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `alias` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '简称',
  `industry` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '所属行业',
  `istop` tinyint NOT NULL DEFAULT 0 COMMENT '是否置顶',
  `lead_source` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '项目来源',
  `address` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '公司地址',
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL,
  `productions_technologies` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL,
  `financing_stage` tinyint NOT NULL DEFAULT 0 COMMENT '融资阶段',
  `initial_valuation` bigint NULL DEFAULT NULL COMMENT '初始估值',
  `latest_valuation` bigint NULL DEFAULT NULL COMMENT '最新估值',
  `relate_enterprises` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '关联辅助项目',
  `scientist_id` int NOT NULL DEFAULT 0 COMMENT '关联科学家',
  `relate_companies` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '关联上市公司',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后修改时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 524 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of enterprises
-- ----------------------------
INSERT INTO `enterprises` VALUES (519, '2025-08-13 16:33:10', 25, 0, 3, 0, 11, '25', '', '伯达软件', '/upload/20250813/e034dcaa9e8489641983305e08564fbb.png', '', '', 0, '', '', '国软件产业发展的推动者，国家信息基础设施的建设者，国际化软件与服务的先行者和软件商业模式创新的探索者', NULL, 0, NULL, NULL, '', 0, '', '2025-08-14 11:09:26');
INSERT INTO `enterprises` VALUES (520, '2025-08-13 16:37:46', 25, 0, 2, 0, 12, '31', '', '航天驭星', '/upload/20250813/fda7907b3efef07c80164bc5f73dc22d.png', '', '', 0, '', '', '航天驭星成立于2016年，总部位于北京，在西安、郑州、中卫、七台河、精河、鹤壁、南太平洋、非洲、南美等地建立了十几个分支机构，是集商业化航天测运控技术研发、航天通信产品制造和航天器在轨运管服务于一体的综合方案提供商。\r\n\r\n公司以“让卫星更好用，让卫星更易用”为己任，致力于建设全球化的商业航天基础设施，为全球航天用户提供包含火箭发射测控、卫星测运控、载荷数据接收、遥感卫星定标、空间碰撞预警、空间碎片清理、航天数字化应用、航天科普推广等服务在内的一揽子解决方案。\r\n\r\n公司获得国家高新技术企业、国家级专精特新“小巨人”企业、北京民营中小企业百强等荣誉称号。目前，已建成了包含60余套地面站在内的全球化的卫星地面站网和综合定标场，累计服务的卫星、火箭数量超370，在国内商业航天测运控领域处于领先地位。', NULL, 0, NULL, NULL, '', 0, '', '2025-08-14 12:11:52');
INSERT INTO `enterprises` VALUES (521, '2025-08-13 17:14:10', 25, 0, 1, 0, 13, '31', '', 'Momenta', '/upload/20250813/7f99cc323ece8d4a207539d0d628be4b.png', '', '', 0, '', '中国北京市海淀区中关村东路8号东升大厦C座3层', 'Momenta,自动驾驶,无人驾驶,曹旭东,Robotaxi', NULL, 0, NULL, NULL, '', 0, '', '2025-08-13 17:14:10');
INSERT INTO `enterprises` VALUES (522, '2025-08-13 17:16:50', 25, 0, 1, 0, 14, '25,31', '', '米哈游', '/upload/20250813/47df2245e64da497ed34232d59cde3dc.png', '', '', 0, '', '', '米哈游成立于2011年，致力于为用户提供美好的、超出预期的产品与内容。米哈游陆续推出了多款高品质人气产品，包括《崩坏学园2》、《崩坏3》、《未定事件簿》、《原神》、《崩坏：星穹铁道》、《绝区零》，并围绕原创IP打造了动画、音乐及周边等多元产品。', NULL, 0, NULL, NULL, '', 0, '', '2025-08-13 17:16:50');
INSERT INTO `enterprises` VALUES (523, '2025-08-14 18:21:35', 25, 0, 4, 0, 15, '25', '', '摩尔线程', '/upload/20250814/2a2c7aaeb01484e3cf8cbc0c069d5b0c.png', '', '', 0, '', '', '摩尔线程成立于 2020 年 6 月，以全功能 GPU 为核心，致力于向全球提供加速计算的基础设施和一站式解决方案，为各行各业的数智化转型提供强大的 AI 计算支持。', '具备国际竞争力的 GPU 领军企业，为融合人工智能和数字孪生的数智世界打造先进的加速计算平台。', 0, NULL, NULL, '', 0, '', '2025-08-14 18:29:25');

-- ----------------------------
-- Table structure for enterprises_dividends
-- ----------------------------
DROP TABLE IF EXISTS `enterprises_dividends`;
CREATE TABLE `enterprises_dividends`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `enterprise_id` int NOT NULL COMMENT '企业ID',
  `type` tinyint NOT NULL DEFAULT 0 COMMENT '类型',
  `date` date NOT NULL COMMENT '发生时间',
  `amount` int UNSIGNED NOT NULL DEFAULT 0 COMMENT '金额',
  `remark` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '备注',
  `json` varchar(1024) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT 'json业务数据',
  `date_entered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建事件',
  `created_by` int NOT NULL DEFAULT 0 COMMENT '创建人ID',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `enterprise_id`(`enterprise_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 31 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci COMMENT = '项目分红' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of enterprises_dividends
-- ----------------------------

-- ----------------------------
-- Table structure for enterprises_dividends_partners
-- ----------------------------
DROP TABLE IF EXISTS `enterprises_dividends_partners`;
CREATE TABLE `enterprises_dividends_partners`  (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `ffi_id` int NOT NULL DEFAULT 0 COMMENT '基金收入ID',
  `p_id` int NOT NULL DEFAULT 0 COMMENT '基金合伙人ID',
  `amount` decimal(18, 2) NOT NULL COMMENT '金额',
  `fee` decimal(18, 2) NOT NULL DEFAULT 0.00 COMMENT '费用',
  `tax` decimal(18, 2) NOT NULL DEFAULT 0.00 COMMENT '缴税',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `ffi_id`(`ffi_id` ASC) USING BTREE,
  INDEX `p_id`(`p_id` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci COMMENT = '基金合伙人项目分红' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of enterprises_dividends_partners
-- ----------------------------

-- ----------------------------
-- Table structure for enterprises_financing
-- ----------------------------
DROP TABLE IF EXISTS `enterprises_financing`;
CREATE TABLE `enterprises_financing`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `enterprise_id` int NOT NULL,
  `type` tinyint NOT NULL DEFAULT 0 COMMENT '1=投资稀释，2=股权转让',
  `title` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '标题',
  `esid` int NOT NULL DEFAULT 0 COMMENT '股东表id',
  `amount` bigint NOT NULL COMMENT '金额合计（元）',
  `valuation` bigint NOT NULL COMMENT '最新估值（元）',
  `when` date NOT NULL DEFAULT '0000-00-00' COMMENT '发生时间',
  `date_entered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `enterprise_id`(`enterprise_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 62 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci COMMENT = '企业股权变更记录表' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of enterprises_financing
-- ----------------------------

-- ----------------------------
-- Table structure for enterprises_founders
-- ----------------------------
DROP TABLE IF EXISTS `enterprises_founders`;
CREATE TABLE `enterprises_founders`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `enterprise_id` int NOT NULL,
  `contact_id` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `enterprise_id`(`enterprise_id` ASC, `contact_id` ASC) USING BTREE,
  INDEX `contact_id`(`contact_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 561 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci COMMENT = '企业创始团队' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of enterprises_founders
-- ----------------------------
INSERT INTO `enterprises_founders` VALUES (555, 519, 11);
INSERT INTO `enterprises_founders` VALUES (556, 520, 12);
INSERT INTO `enterprises_founders` VALUES (557, 521, 13);
INSERT INTO `enterprises_founders` VALUES (558, 522, 14);
INSERT INTO `enterprises_founders` VALUES (559, 523, 15);
INSERT INTO `enterprises_founders` VALUES (560, 523, 16);

-- ----------------------------
-- Table structure for event_logs
-- ----------------------------
DROP TABLE IF EXISTS `event_logs`;
CREATE TABLE `event_logs`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `entity_type` tinyint NOT NULL COMMENT '对象类型',
  `entity_id` int NOT NULL COMMENT '对象id',
  `content` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL COMMENT '日志内容',
  `json` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL COMMENT '业务数据',
  `text` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL,
  `uid` int NOT NULL,
  `realname` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `ctime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `entity_id`(`entity_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1254 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of event_logs
-- ----------------------------
INSERT INTO `event_logs` VALUES (1238, 2, 32, '', '', '新增', 31, '测试', '2025-08-13 14:39:23');
INSERT INTO `event_logs` VALUES (1239, 4, 10, '<ENTITY>雷布斯</ENTITY>新增标签', '{\"tag_id\":[\"169\",\"170\"]}', NULL, 25, '超级管理员', '2025-08-13 16:19:20');
INSERT INTO `event_logs` VALUES (1240, 1, 519, '', '', '新增', 25, '超级管理员', '2025-08-13 16:33:10');
INSERT INTO `event_logs` VALUES (1241, 1, 520, '', '', '新增', 25, '超级管理员', '2025-08-13 16:37:46');
INSERT INTO `event_logs` VALUES (1242, 1, 521, '', '', '新增', 25, '超级管理员', '2025-08-13 17:14:10');
INSERT INTO `event_logs` VALUES (1243, 1, 522, '', '', '新增', 25, '超级管理员', '2025-08-13 17:16:50');
INSERT INTO `event_logs` VALUES (1244, 2, 33, '', '', '新增<br />修改', 25, '超级管理员', '2025-08-13 17:21:48');
INSERT INTO `event_logs` VALUES (1245, 2, 32, '', '', '修改', 25, '超级管理员', '2025-08-13 17:22:43');
INSERT INTO `event_logs` VALUES (1246, 2, 32, '', '', '上传基金合伙人协议 <a href=\"javascript:void(0)\" onclick=\"QT.filePreview(7648)\">华夏幸福1号基金合伙协议.docx</a>', 25, '超级管理员', '2025-08-14 11:12:41');
INSERT INTO `event_logs` VALUES (1247, 2, 34, '', '', '新增', 25, '超级管理员', '2025-08-14 11:32:22');
INSERT INTO `event_logs` VALUES (1248, 1, 523, '', '', '新增', 25, '超级管理员', '2025-08-14 18:21:35');
INSERT INTO `event_logs` VALUES (1249, 4, 16, '<ENTITY>李荣浩</ENTITY>新增标签', '{\"tag_id\":[\"162\"]}', NULL, 25, '超级管理员', '2025-08-14 18:24:06');
INSERT INTO `event_logs` VALUES (1250, 1, 523, '<ENTITY>摩尔线程</ENTITY>新增标签', '{\"tag_id\":[\"182\",\"183\",\"184\",\"185\"]}', NULL, 25, '超级管理员', '2025-08-14 18:25:19');
INSERT INTO `event_logs` VALUES (1251, 6, 13, '', '', '上传行研报告 <a href=\"javascript:void(0)\" onclick=\"QT.filePreview(7655)\">碳化硅半导体10年展望.xls</a>', 25, '超级管理员', '2025-08-26 18:30:40');
INSERT INTO `event_logs` VALUES (1252, 4, 14, '<ENTITY>王欣欣</ENTITY>新增标签', '{\"tag_id\":[\"186\"]}', NULL, 25, '超级管理员', '2025-08-28 17:37:16');
INSERT INTO `event_logs` VALUES (1253, 4, 11, '<ENTITY>李伯达</ENTITY>新增标签', '{\"tag_id\":[\"187\"]}', NULL, 25, '超级管理员', '2025-08-28 17:37:34');

-- ----------------------------
-- Table structure for extras
-- ----------------------------
DROP TABLE IF EXISTS `extras`;
CREATE TABLE `extras`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `record_id` int NOT NULL,
  `module` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `key` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `value` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL,
  `is_json` tinyint NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `idx_r_m_k`(`record_id` ASC, `module` ASC, `key` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 429 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci COMMENT = '附加数据表' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of extras
-- ----------------------------
INSERT INTO `extras` VALUES (422, 523, 'Enterprises', 'customer', '{\"description\":\"游戏玩家，大模型\"}', 1);
INSERT INTO `extras` VALUES (423, 523, 'Enterprises', 'business', '{\"description\":\"\"}', 1);
INSERT INTO `extras` VALUES (424, 523, 'Enterprises', 'industry', '{\"description\":\"\"}', 1);
INSERT INTO `extras` VALUES (425, 523, 'Enterprises', 'finance', '{\"description\":\"\"}', 1);
INSERT INTO `extras` VALUES (426, 523, 'Enterprises', 'legal', '{\"description\":\"\"}', 1);
INSERT INTO `extras` VALUES (427, 523, 'Enterprises', 'principle', '{\"q1\":\"国产替代，大势所趋\",\"q2\":\"国产替代，大势所趋\",\"q3\":\"国产替代，大势所趋\",\"q4\":\"国产替代，大势所趋\",\"q6\":\"国产替代，大势所趋\",\"q7\":\"国产替代，大势所趋\",\"q8\":\"国产替代，大势所趋\",\"q9\":\"国产替代，大势所趋\"}', 1);
INSERT INTO `extras` VALUES (428, 77, 'Investment', 'special_terms', '{\"rights\":[\"ZHIQING\",\"HUIGOU\",\"DUIDU\",\"OTHER\"],\"desc\":\"\"}', 1);

-- ----------------------------
-- Table structure for funds
-- ----------------------------
DROP TABLE IF EXISTS `funds`;
CREATE TABLE `funds`  (
  `fund_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '基金名称',
  `alias` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL COMMENT '基金别名、简称',
  `code` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL COMMENT '基金代号',
  `reg_place` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `size` decimal(18, 2) NOT NULL DEFAULT 0.00 COMMENT '认缴规模',
  `partnership_start_date` date NOT NULL DEFAULT '0000-00-00' COMMENT '合伙企业设立日期',
  `partnership_end_date` date NOT NULL DEFAULT '0000-00-00' COMMENT '合伙企业终止日期',
  `establish_date` date NOT NULL DEFAULT '0000-00-00' COMMENT '备案成立日期',
  `over_date` date NOT NULL DEFAULT '0000-00-00' COMMENT '基金结束日期',
  `invest_period` int NOT NULL DEFAULT 0 COMMENT '基金投资期（年）',
  `invest_fee_ratio` decimal(18, 2) NOT NULL DEFAULT 0.00 COMMENT '投资期管理费率',
  `exit_period` int NOT NULL DEFAULT 0 COMMENT '基金退出期（年）',
  `exit_fee_ratio` decimal(18, 2) NOT NULL DEFAULT 0.00 COMMENT '退出期管理费率',
  `extend_period` int NOT NULL DEFAULT 0 COMMENT '基金延长期（年）',
  `entered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '录入时间',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后修改时间',
  `status` tinyint NOT NULL DEFAULT 1 COMMENT '运营状态，1-pending, 2-established, 3-over',
  PRIMARY KEY (`fund_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 35 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci COMMENT = '基金基础数据' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of funds
-- ----------------------------
INSERT INTO `funds` VALUES (32, '华夏幸福1号', '', '', '', 100000000.00, '2025-08-01', '2030-07-31', '2025-08-01', '2030-07-31', 3, 1.00, 2, 1.00, 3, '0000-00-00 00:00:00', '2025-08-14 22:30:09', 3);
INSERT INTO `funds` VALUES (33, '盛世1号', '', '', '', 20000000.00, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, 0.00, 0, 0.00, 0, '0000-00-00 00:00:00', '2025-08-13 17:23:12', 1);
INSERT INTO `funds` VALUES (34, '华泰人工智能1号投资合伙企业（有限合伙）', '华泰人工智能1号', 'HT001', '广东省深圳市', 50000000.00, '2024-06-01', '2029-05-31', '2024-06-01', '2029-05-31', 5, 1.00, 2, 1.00, 1, '0000-00-00 00:00:00', '2025-08-22 22:12:46', 2);

-- ----------------------------
-- Table structure for funds_collect
-- ----------------------------
DROP TABLE IF EXISTS `funds_collect`;
CREATE TABLE `funds_collect`  (
  `fund_id` int NOT NULL DEFAULT 0,
  `plan_info` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '基金方案备注',
  `protocol_info` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '合伙协议备注',
  `business_reg_info` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '工商注册备注',
  `business_reg_proxy_id` int NOT NULL DEFAULT 0 COMMENT '代理机构',
  `business_license_no` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '营业执照号',
  `bank_basic_account` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '银行基本户',
  `hosting_plan_info` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '托管备注',
  `hosting_agency_id` int NOT NULL DEFAULT 0 COMMENT '托管机构',
  `hosting_fee_ratio` decimal(18, 2) NOT NULL DEFAULT 0.00 COMMENT '托管费率',
  `bank_collect_account` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '银行募集账户',
  `bank_hosting_account` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '银行托管账户',
  `tax_valueadded_ratio` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '增值税率',
  `tax_valueadded_discount` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '增值税优惠',
  `tax_income_type` tinyint NOT NULL DEFAULT 1 COMMENT '个人经营所得税',
  `tax_income_ratio` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '个人经营所得税-税率',
  `tax_income_discount` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '个人经营所得税-优惠',
  `tax_stamp_ratio` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '印花税率',
  `tax_stamp_discount` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '印花税优惠',
  `tax_valueadded_extra_ratio` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '增值税附加税率',
  `tax_valueadded_extra_discount` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '增值税附加优惠',
  `tax_info` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '税务备注',
  `filing_no` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '备案号',
  `filing_info` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '备案备注',
  `delivery_date` date NOT NULL DEFAULT '0000-00-00' COMMENT '交割日期',
  PRIMARY KEY (`fund_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci COMMENT = '基金募集相关数据' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of funds_collect
-- ----------------------------

-- ----------------------------
-- Table structure for funds_enterprises
-- ----------------------------
DROP TABLE IF EXISTS `funds_enterprises`;
CREATE TABLE `funds_enterprises`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `fund_id` int NOT NULL,
  `enterprise_id` int NOT NULL,
  `investment_id` int NOT NULL COMMENT '关联investment表id',
  `ffe_id` int NOT NULL COMMENT '关联funds_finance_enterprises表id',
  `stock_ratio` decimal(4, 2) UNSIGNED NULL DEFAULT NULL COMMENT '占股比例',
  `stock_ratio_new` decimal(4, 2) UNSIGNED NULL DEFAULT NULL COMMENT '最新占股比例',
  `stock_total` decimal(16, 4) NULL DEFAULT NULL COMMENT '所得份额',
  `date_delivery` date NULL DEFAULT NULL COMMENT '交割时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fund_id`(`fund_id` ASC) USING BTREE,
  INDEX `enterprise_id`(`enterprise_id` ASC) USING BTREE,
  INDEX `investment_id`(`investment_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 64 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of funds_enterprises
-- ----------------------------
INSERT INTO `funds_enterprises` VALUES (63, 32, 523, 77, 66, 20.00, 20.00, 20000000.0000, '2025-08-14');

-- ----------------------------
-- Table structure for funds_finance_contributes
-- ----------------------------
DROP TABLE IF EXISTS `funds_finance_contributes`;
CREATE TABLE `funds_finance_contributes`  (
  `ffc_id` int NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `fund_id` int NOT NULL DEFAULT 0 COMMENT '基金ID',
  `title` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '标题',
  `amount` decimal(18, 2) NOT NULL DEFAULT 0.00 COMMENT '金额',
  `date` date NOT NULL DEFAULT '0000-00-00' COMMENT '日期',
  PRIMARY KEY (`ffc_id`) USING BTREE,
  INDEX `fund_id`(`fund_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 163 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci COMMENT = '基金合伙人出资记录' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of funds_finance_contributes
-- ----------------------------
INSERT INTO `funds_finance_contributes` VALUES (157, 34, '小马哥合伙出资', 500000.00, '2025-08-22');
INSERT INTO `funds_finance_contributes` VALUES (161, 34, '小马哥合伙出资', 5000000.00, '2025-08-31');
INSERT INTO `funds_finance_contributes` VALUES (162, 32, '一带一路大基金合伙出资', 50000000.00, '2025-08-22');

-- ----------------------------
-- Table structure for funds_finance_enterprises
-- ----------------------------
DROP TABLE IF EXISTS `funds_finance_enterprises`;
CREATE TABLE `funds_finance_enterprises`  (
  `ffe_id` int NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `fund_id` int NOT NULL DEFAULT 0 COMMENT '基金ID',
  `title` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '标题',
  `amount` decimal(18, 2) NOT NULL DEFAULT 0.00 COMMENT '金额',
  `date` date NOT NULL DEFAULT '0000-00-00' COMMENT '日期',
  `enterprise_id` int NOT NULL DEFAULT 0 COMMENT '项目ID',
  PRIMARY KEY (`ffe_id`) USING BTREE,
  INDEX `fund_id`(`fund_id` ASC) USING BTREE,
  INDEX `enterprise_id`(`enterprise_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 67 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci COMMENT = '基金投资记录' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of funds_finance_enterprises
-- ----------------------------
INSERT INTO `funds_finance_enterprises` VALUES (66, 32, '摩尔线程-投资交割', 20000000.00, '2025-08-14', 523);

-- ----------------------------
-- Table structure for funds_finance_fees
-- ----------------------------
DROP TABLE IF EXISTS `funds_finance_fees`;
CREATE TABLE `funds_finance_fees`  (
  `fff_id` int NOT NULL AUTO_INCREMENT,
  `fund_id` int NOT NULL DEFAULT 0 COMMENT '基金ID',
  `title` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '标题',
  `amount` decimal(18, 2) NOT NULL DEFAULT 0.00 COMMENT '金额',
  `type` tinyint NOT NULL DEFAULT 1 COMMENT '类型',
  `from_date` date NOT NULL DEFAULT '0000-00-00' COMMENT '开始日期',
  `end_date` date NOT NULL DEFAULT '0000-00-00' COMMENT '结束日期',
  `ffi_id` int NOT NULL DEFAULT 0 COMMENT '基金收入ID',
  PRIMARY KEY (`fff_id`) USING BTREE,
  INDEX `fund_id`(`fund_id` ASC) USING BTREE,
  INDEX `ffi_id`(`ffi_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci COMMENT = '基金费用记录' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of funds_finance_fees
-- ----------------------------
INSERT INTO `funds_finance_fees` VALUES (17, 32, '财务代理费', 5000.00, 1, '2025-04-01', '2025-06-30', 0);

-- ----------------------------
-- Table structure for funds_finance_incomes
-- ----------------------------
DROP TABLE IF EXISTS `funds_finance_incomes`;
CREATE TABLE `funds_finance_incomes`  (
  `ffi_id` int NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `fund_id` int NOT NULL DEFAULT 0 COMMENT '基金ID',
  `exit_id` int NOT NULL DEFAULT 0 COMMENT '项目退出ID',
  `title` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '标记',
  `amount` decimal(18, 2) NOT NULL DEFAULT 0.00 COMMENT '金额',
  `type` tinyint NOT NULL DEFAULT 1 COMMENT '类型',
  `date` date NOT NULL DEFAULT '0000-00-00' COMMENT '日期',
  PRIMARY KEY (`ffi_id`) USING BTREE,
  INDEX `exit_id`(`exit_id` ASC) USING BTREE,
  INDEX `fund_id`(`fund_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 50 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci COMMENT = '基金收入记录' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of funds_finance_incomes
-- ----------------------------
INSERT INTO `funds_finance_incomes` VALUES (49, 34, 0, '招商资本10万股', 1000000.00, 2, '2025-08-24');

-- ----------------------------
-- Table structure for funds_finance_taxes
-- ----------------------------
DROP TABLE IF EXISTS `funds_finance_taxes`;
CREATE TABLE `funds_finance_taxes`  (
  `fft_id` int NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `fund_id` int NOT NULL DEFAULT 0 COMMENT '基金ID',
  `title` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '标题',
  `amount` decimal(18, 2) NOT NULL DEFAULT 0.00 COMMENT '金额',
  `type` tinyint NOT NULL DEFAULT 1 COMMENT '类型',
  `date` date NOT NULL DEFAULT '0000-00-00' COMMENT '日期',
  `ffi_id` int NOT NULL DEFAULT 0 COMMENT '基金收入ID',
  `ffc_id` int NOT NULL DEFAULT 0 COMMENT '基金合伙人出资ID',
  PRIMARY KEY (`fft_id`) USING BTREE,
  INDEX `fund_id`(`fund_id` ASC) USING BTREE,
  INDEX `ffi_id`(`ffi_id` ASC) USING BTREE,
  INDEX `ffc_id`(`ffc_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 37 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci COMMENT = '基金缴税记录' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of funds_finance_taxes
-- ----------------------------
INSERT INTO `funds_finance_taxes` VALUES (30, 34, '小马哥合伙出资-增值税', 10000.00, 1, '2025-08-31', 0, 161);
INSERT INTO `funds_finance_taxes` VALUES (31, 34, '小马哥合伙出资-个人经营所得税', 20000.00, 2, '2025-08-31', 0, 161);
INSERT INTO `funds_finance_taxes` VALUES (32, 32, '一带一路大基金合伙出资-增值税', 1000.00, 1, '2025-08-22', 0, 162);
INSERT INTO `funds_finance_taxes` VALUES (33, 32, '一带一路大基金合伙出资-个人经营所得税', 2000.00, 2, '2025-08-22', 0, 162);
INSERT INTO `funds_finance_taxes` VALUES (34, 34, '招商资本10万股-增值税', 5.00, 1, '2025-08-24', 49, 0);
INSERT INTO `funds_finance_taxes` VALUES (35, 32, '2025年3季度', 10000.00, 3, '2025-07-01', 0, 0);
INSERT INTO `funds_finance_taxes` VALUES (36, 32, '一带一路大基金合伙出资-印花税', 20000.00, 3, '2025-08-22', 0, 162);

-- ----------------------------
-- Table structure for funds_partners
-- ----------------------------
DROP TABLE IF EXISTS `funds_partners`;
CREATE TABLE `funds_partners`  (
  `fp_id` int NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `fund_id` int NOT NULL DEFAULT 0 COMMENT '基金ID',
  `p_id` int NOT NULL DEFAULT 0 COMMENT '合伙人ID',
  `amount` decimal(18, 2) NOT NULL DEFAULT 0.00 COMMENT '认投金额',
  `status` tinyint NOT NULL DEFAULT 1 COMMENT '状态, 1-active, 2-exit',
  PRIMARY KEY (`fp_id`) USING BTREE,
  INDEX `fund_id`(`fund_id` ASC) USING BTREE,
  INDEX `p_id`(`p_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 96 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci COMMENT = '基金合伙人' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of funds_partners
-- ----------------------------
INSERT INTO `funds_partners` VALUES (91, 32, 66, 10000000.00, 1);
INSERT INTO `funds_partners` VALUES (92, 32, 69, 20000000.00, 1);
INSERT INTO `funds_partners` VALUES (93, 32, 69, 20000000.00, 1);
INSERT INTO `funds_partners` VALUES (94, 32, 70, 50000000.00, 1);
INSERT INTO `funds_partners` VALUES (95, 34, 66, 1000000.00, 1);

-- ----------------------------
-- Table structure for funds_partners_paid
-- ----------------------------
DROP TABLE IF EXISTS `funds_partners_paid`;
CREATE TABLE `funds_partners_paid`  (
  `fp_paid_id` int NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `fp_id` int NOT NULL DEFAULT 0 COMMENT '基金合伙人ID',
  `ffc_id` int NOT NULL DEFAULT 0 COMMENT '基金合伙人出资ID',
  PRIMARY KEY (`fp_paid_id`) USING BTREE,
  INDEX `fp_id`(`fp_id` ASC) USING BTREE,
  INDEX `ffc_id`(`ffc_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 148 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci COMMENT = '基金合伙人实投记录' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of funds_partners_paid
-- ----------------------------
INSERT INTO `funds_partners_paid` VALUES (145, 95, 157);
INSERT INTO `funds_partners_paid` VALUES (146, 95, 161);
INSERT INTO `funds_partners_paid` VALUES (147, 94, 162);

-- ----------------------------
-- Table structure for industries
-- ----------------------------
DROP TABLE IF EXISTS `industries`;
CREATE TABLE `industries`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `deleted` tinyint NOT NULL DEFAULT 0,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL DEFAULT 0,
  `name` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL COMMENT '行业名称',
  `core_data` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL COMMENT '核心数据',
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL COMMENT '描述',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci COMMENT = '行业研究' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of industries
-- ----------------------------
INSERT INTO `industries` VALUES (10, 0, '2025-08-14 11:17:41', 25, '生物医药', '', '');
INSERT INTO `industries` VALUES (11, 0, '2025-08-14 11:17:52', 25, '新能源', '', '');
INSERT INTO `industries` VALUES (12, 0, '2025-08-14 11:18:08', 25, '光刻机', '', '');
INSERT INTO `industries` VALUES (13, 0, '2025-08-14 11:18:29', 25, '碳化硅半导体', '', '');

-- ----------------------------
-- Table structure for industry_graphs
-- ----------------------------
DROP TABLE IF EXISTS `industry_graphs`;
CREATE TABLE `industry_graphs`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `deleted` tinyint NOT NULL DEFAULT 0,
  `name` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT '名称',
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL COMMENT '描述',
  `data` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL COMMENT '数据',
  `date_entered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `created_by` int NOT NULL DEFAULT 0 COMMENT '创建人',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci COMMENT = '行业图谱' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of industry_graphs
-- ----------------------------

-- ----------------------------
-- Table structure for investment
-- ----------------------------
DROP TABLE IF EXISTS `investment`;
CREATE TABLE `investment`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `enterprise_id` int NOT NULL,
  `meeting_id` int NOT NULL DEFAULT 0 COMMENT '投决会id',
  `financing_stage` tinyint NOT NULL COMMENT '投后估值',
  `initial_valuation` bigint NULL DEFAULT NULL,
  `trade_plan` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT '',
  `director` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '' COMMENT '董事',
  `status` tinyint NOT NULL DEFAULT 0,
  `created_by` int NOT NULL DEFAULT 0,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 78 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci COMMENT = '投资表' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of investment
-- ----------------------------
INSERT INTO `investment` VALUES (77, 523, 93, 4, 1000000000, '', '25', 2, 0, '2025-08-14 18:32:43');

-- ----------------------------
-- Table structure for job_queue
-- ----------------------------
DROP TABLE IF EXISTS `job_queue`;
CREATE TABLE `job_queue`  (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `scheduler_id` int NOT NULL DEFAULT 0 COMMENT '计划任务ID',
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '名称',
  `target` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '执行目标',
  `execute_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '开始执行时间',
  `execute_end_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '执行结束时间',
  `status` tinyint NOT NULL DEFAULT 0 COMMENT '状态',
  `result` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '结果',
  `message` varchar(1024) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '消息',
  `client` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `entered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `deleted` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否删除',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `scheduler_id`(`scheduler_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 339206 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci COMMENT = '后台计划任务队列' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of job_queue
-- ----------------------------

-- ----------------------------
-- Table structure for knowledges
-- ----------------------------
DROP TABLE IF EXISTS `knowledges`;
CREATE TABLE `knowledges`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `deleted` tinyint NOT NULL DEFAULT 0,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `created_by` int NOT NULL DEFAULT 0 COMMENT '创建人',
  `name` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL COMMENT '名称',
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL COMMENT '描述',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci COMMENT = '智库' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of knowledges
-- ----------------------------
INSERT INTO `knowledges` VALUES (25, 0, '2025-08-14 11:20:10', 25, '清华大学', '');
INSERT INTO `knowledges` VALUES (26, 0, '2025-08-14 11:20:29', 25, '智谋天下管理咨询', '');

-- ----------------------------
-- Table structure for login_logs
-- ----------------------------
DROP TABLE IF EXISTS `login_logs`;
CREATE TABLE `login_logs`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '用户名',
  `userid` int NOT NULL DEFAULT 0 COMMENT '用ID',
  `usertype` tinyint NOT NULL DEFAULT 1 COMMENT '用户类型',
  `useragent` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '客户端',
  `device` tinyint NOT NULL DEFAULT 1 COMMENT '设备',
  `ip` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT 'IP',
  `time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2617 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci COMMENT = '登录日志' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of login_logs
-- ----------------------------
INSERT INTO `login_logs` VALUES (2587, 'test', 31, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Sa', 1, '113.118.169.131', '2025-08-13 14:25:59');
INSERT INTO `login_logs` VALUES (2588, 'test', 31, 1, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.', 1, '123.139.17.246', '2025-08-13 14:29:26');
INSERT INTO `login_logs` VALUES (2589, 'test', 31, 1, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.', 1, '123.139.17.246', '2025-08-13 14:29:27');
INSERT INTO `login_logs` VALUES (2590, 'admin', 25, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Sa', 1, '113.118.169.131', '2025-08-13 15:58:13');
INSERT INTO `login_logs` VALUES (2591, 'admin', 25, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Sa', 1, '113.118.169.131', '2025-08-13 15:58:13');
INSERT INTO `login_logs` VALUES (2592, 'test', 31, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Sa', 1, '120.238.115.195', '2025-08-14 09:19:48');
INSERT INTO `login_logs` VALUES (2593, 'admin', 25, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Sa', 1, '113.118.169.131', '2025-08-14 11:07:48');
INSERT INTO `login_logs` VALUES (2594, 'admin', 25, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Sa', 1, '113.118.169.131', '2025-08-14 11:07:49');
INSERT INTO `login_logs` VALUES (2595, 'test', 31, 1, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.', 1, '123.139.17.246', '2025-08-14 13:33:11');
INSERT INTO `login_logs` VALUES (2596, 'admin', 25, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0', 1, '120.229.76.64', '2025-08-14 22:23:38');
INSERT INTO `login_logs` VALUES (2597, 'admin', 25, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Sa', 1, '113.118.175.231', '2025-08-15 12:26:44');
INSERT INTO `login_logs` VALUES (2598, 'admin', 25, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Sa', 1, '113.118.175.231', '2025-08-15 12:26:44');
INSERT INTO `login_logs` VALUES (2599, 'test', 31, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Sa', 1, '117.69.183.210', '2025-08-17 12:19:48');
INSERT INTO `login_logs` VALUES (2600, 'admin', 25, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Sa', 1, '113.110.175.160', '2025-08-20 17:36:37');
INSERT INTO `login_logs` VALUES (2601, 'admin', 25, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Sa', 1, '113.110.175.160', '2025-08-20 17:36:37');
INSERT INTO `login_logs` VALUES (2602, 'test', 31, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Sa', 1, '120.245.115.147', '2025-08-20 23:43:30');
INSERT INTO `login_logs` VALUES (2603, 'admin', 25, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Sa', 1, '113.110.175.160', '2025-08-22 15:18:12');
INSERT INTO `login_logs` VALUES (2604, 'admin', 25, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Sa', 1, '113.110.175.160', '2025-08-22 15:18:12');
INSERT INTO `login_logs` VALUES (2605, 'admin', 25, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Sa', 1, '120.229.76.12', '2025-08-22 21:34:32');
INSERT INTO `login_logs` VALUES (2606, 'admin', 25, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Sa', 1, '120.229.76.12', '2025-08-22 21:34:32');
INSERT INTO `login_logs` VALUES (2607, 'admin', 25, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Sa', 1, '120.229.76.99', '2025-08-24 19:17:21');
INSERT INTO `login_logs` VALUES (2608, 'admin', 25, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Sa', 1, '120.229.76.99', '2025-08-24 19:17:21');
INSERT INTO `login_logs` VALUES (2609, 'admin', 25, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Sa', 1, '113.118.171.147', '2025-08-25 17:42:38');
INSERT INTO `login_logs` VALUES (2610, 'admin', 25, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Sa', 1, '113.118.171.147', '2025-08-25 17:42:38');
INSERT INTO `login_logs` VALUES (2611, 'admin', 25, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Sa', 1, '113.118.171.147', '2025-08-26 12:29:14');
INSERT INTO `login_logs` VALUES (2612, 'admin', 25, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Sa', 1, '113.118.171.147', '2025-08-28 17:36:10');
INSERT INTO `login_logs` VALUES (2613, 'admin', 25, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Sa', 1, '120.229.76.71', '2025-08-28 22:33:13');
INSERT INTO `login_logs` VALUES (2614, 'admin', 25, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Sa', 1, '120.229.76.71', '2025-08-28 22:33:13');
INSERT INTO `login_logs` VALUES (2615, 'admin', 25, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Sa', 1, '113.118.174.213', '2025-09-02 17:06:09');
INSERT INTO `login_logs` VALUES (2616, 'admin', 25, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Sa', 1, '113.118.174.213', '2025-09-02 17:06:09');

-- ----------------------------
-- Table structure for meetings
-- ----------------------------
DROP TABLE IF EXISTS `meetings`;
CREATE TABLE `meetings`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` tinyint NOT NULL DEFAULT 1 COMMENT '会议类型',
  `relate_id` int NULL DEFAULT NULL,
  `investment_id` int NOT NULL DEFAULT 0 COMMENT '关联投资轮次id',
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint NULL DEFAULT 1,
  `date_start` datetime NULL DEFAULT NULL,
  `date_end` datetime NULL DEFAULT NULL,
  `title` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL,
  `feedback` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL,
  `created_by` int NULL DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `type`(`type` ASC, `relate_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 94 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of meetings
-- ----------------------------
INSERT INTO `meetings` VALUES (91, 2, 519, 0, 0, 3, '2025-08-13 17:17:00', NULL, '伯达软件-立项会议（20250813）', '研讨进一步跟进事宜', '同意进行后续尽调', 25, '2025-08-13 17:18:09', '2025-08-14 11:09:26');
INSERT INTO `meetings` VALUES (92, 2, 523, 0, 0, 3, '2025-08-14 18:26:00', NULL, '摩尔线程-立项会议（20250814）', '立项决策', '补充资料，继续，通过', 25, '2025-08-14 18:27:18', '2025-08-14 18:28:13');
INSERT INTO `meetings` VALUES (93, 3, 523, 77, 0, 3, '2025-08-15 18:28:00', NULL, '摩尔线程-投决会议（20250814）', '确定是否下一步尽调', '同意尽调', 25, '2025-08-14 18:29:03', '2025-08-14 18:32:43');

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu`  (
  `id` smallint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '菜单名称',
  `level` tinyint NOT NULL DEFAULT 1 COMMENT '层级(1,2,3)',
  `pid` smallint NOT NULL DEFAULT 0 COMMENT '父id',
  `m` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '模块',
  `c` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '控制器',
  `a` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '方法',
  `params` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT 'url附加参数',
  `icon_cls` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT 'icon样式',
  `order_id` int NOT NULL DEFAULT 0 COMMENT '排序号',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 61 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES (2, '系统管理', 1, 0, '', '', '', '', 'fa fa-caret-right', 9999);
INSERT INTO `menu` VALUES (3, '用户管理', 2, 2, 'index', 'Admins', 'admins', '', 'icons-point', 0);
INSERT INTO `menu` VALUES (4, '角色管理', 2, 2, 'index', 'AdminRole', 'adminRole', '', 'icons-point', 0);
INSERT INTO `menu` VALUES (5, '系统设置', 2, 2, 'index', 'System', 'setting', '', 'icons-point', 0);
INSERT INTO `menu` VALUES (6, '行业', 1, 0, '', '', '', '', 'fa fa-caret-right', 700);
INSERT INTO `menu` VALUES (7, '基金池', 1, 0, '', '', '', '', 'fa fa-caret-right', 200);
INSERT INTO `menu` VALUES (8, '投资人', 1, 0, '', '', '', '', 'fa fa-caret-right', 300);
INSERT INTO `menu` VALUES (10, '总列表', 2, 7, 'index', 'Funds', 'funds', '', 'icons-point', 0);
INSERT INTO `menu` VALUES (11, '个人有限合伙人', 2, 8, 'index', 'Partners', 'partners', 'type=1&status=2', 'icons-point', 0);
INSERT INTO `menu` VALUES (13, '项目池', 1, 0, '', '', '', '', 'fa fa-caret-right', 50);
INSERT INTO `menu` VALUES (14, '项目-接触', 2, 13, 'index', 'Enterprises', 'index', 'step=1', 'icons-point', 1);
INSERT INTO `menu` VALUES (15, '行业研究', 2, 6, 'index', 'Industries', 'index', '', 'icons-point', 0);
INSERT INTO `menu` VALUES (16, '人才库', 2, 13, 'index', 'Contacts', 'index', '', 'icons-point', 0);
INSERT INTO `menu` VALUES (17, '菜单管理', 2, 2, 'index', 'Menus', 'index', '', 'icons-point', 0);
INSERT INTO `menu` VALUES (18, '募集中', 2, 7, 'index', 'Funds', 'fundsCollect', '', 'icons-point', 20);
INSERT INTO `menu` VALUES (19, '投资中', 2, 7, 'index', 'Funds', 'fundsInvest', '', 'icons-point', 30);
INSERT INTO `menu` VALUES (20, '管理中', 2, 7, 'index', 'Funds', 'fundsManage', '', 'icons-point', 40);
INSERT INTO `menu` VALUES (22, '项目-分析', 1, 13, 'index', 'Enterprises', 'index', 'step=2', 'icons-point', 2);
INSERT INTO `menu` VALUES (24, '项目-尽调', 1, 13, 'index', 'Enterprises', 'index', 'step=3', 'icons-point', 3);
INSERT INTO `menu` VALUES (25, '我的', 1, 0, '', '', '', '', 'fa fa-caret-right', 300);
INSERT INTO `menu` VALUES (27, '项目-投中', 1, 13, 'index', 'Enterprises', 'index', 'step=4', 'icons-point', 5);
INSERT INTO `menu` VALUES (29, '普通合伙人', 1, 8, 'index', 'Partners', 'partners', 'type=3&status=2', 'icons-point', 20);
INSERT INTO `menu` VALUES (30, '数据配置', 1, 2, 'index', 'Config', 'index', '', 'icons-point', 0);
INSERT INTO `menu` VALUES (31, '项目-投后', 1, 13, 'index', 'Enterprises', 'index', 'step=5', 'icons-point', 6);
INSERT INTO `menu` VALUES (33, '智库', 1, 0, '', '', '', '', 'fa fa-caret-right', 800);
INSERT INTO `menu` VALUES (34, '智库列表', 1, 33, 'index', 'Knowledges', 'index', '', 'icons-point', 0);
INSERT INTO `menu` VALUES (36, '登录日志', 1, 2, 'index', 'LoginLogs', 'index', '', 'icons-point', 100);
INSERT INTO `menu` VALUES (37, '已注销', 1, 7, 'index', 'Funds', 'FundsExit', '', 'icons-point', 100);
INSERT INTO `menu` VALUES (38, '变更日志', 1, 2, 'index', 'AuditLogs', 'index', '', 'icons-point', 200);
INSERT INTO `menu` VALUES (40, '计划任务', 1, 2, 'index', 'Schedulers', 'index', '', 'icons-point', 0);
INSERT INTO `menu` VALUES (41, '文档中心', 1, 2, 'index', 'Docs', 'index', '', 'icons-point', 1000);
INSERT INTO `menu` VALUES (42, '我的文件', 1, 25, 'index', 'Docs', 'index', 'owned=1', 'icons-point', 10);
INSERT INTO `menu` VALUES (43, '机构有限合伙人', 1, 8, 'index', 'Partners', 'partners', 'type=2&status=2', 'icons-point', 10);
INSERT INTO `menu` VALUES (44, '行业图谱', 1, 6, 'index', 'Industries', 'graphs', '', 'icons-point', 0);
INSERT INTO `menu` VALUES (46, '上市公司', 1, 13, 'index', 'Companies', 'index', '', 'icons-point', 0);
INSERT INTO `menu` VALUES (47, '对外尽调', 1, 0, '', '', '', '', 'fa fa-caret-right', 1000);
INSERT INTO `menu` VALUES (48, '总表', 1, 47, 'index', 'Dd', 'index', '', 'icons-point', 0);
INSERT INTO `menu` VALUES (49, '子行业', 1, 6, 'index', 'SubIndustry', 'index', '', 'icons-point', 0);
INSERT INTO `menu` VALUES (50, '出资人名录', 1, 47, 'index', 'Dd', 'index', 'view=2', 'icons-point', 10);
INSERT INTO `menu` VALUES (51, '投资业绩', 1, 47, 'index', 'Dd', 'index', 'view=3', 'icons-point', 20);
INSERT INTO `menu` VALUES (52, '临时访客', 1, 8, 'index', 'Partners', 'partners', 'status=1', 'icons-point', 30);
INSERT INTO `menu` VALUES (53, '科学家引擎', 1, 0, '', '', '', '', 'fa fa-caret-right', 900);
INSERT INTO `menu` VALUES (54, '科学家', 1, 53, 'index', 'Scientists', 'index', '', 'icons-point', 1);
INSERT INTO `menu` VALUES (55, '尽调记录', 1, 47, 'index', 'Notes', 'index', 'category=1', 'icons-point', 25);
INSERT INTO `menu` VALUES (57, '项目-总表', 1, 13, 'index', 'Enterprises', 'index', '', 'icons-point', 0);
INSERT INTO `menu` VALUES (58, '会议', 1, 0, '', '', '', '', 'fa fa-caret-right', 350);
INSERT INTO `menu` VALUES (59, '会议列表', 1, 58, 'Index', 'Meetings', 'index', '', 'icons-point', 1);
INSERT INTO `menu` VALUES (60, '系统异常', 1, 2, 'index', 'System', 'sysErrExp', '', 'icons-point', 10);

-- ----------------------------
-- Table structure for messages
-- ----------------------------
DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages`  (
  `message_id` int NOT NULL AUTO_INCREMENT,
  `admin_id` int NOT NULL DEFAULT 0,
  `title` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `content` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `category` tinyint NOT NULL DEFAULT 0,
  `is_read` tinyint NOT NULL DEFAULT 0,
  `read_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `entered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`message_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of messages
-- ----------------------------

-- ----------------------------
-- Table structure for milestones
-- ----------------------------
DROP TABLE IF EXISTS `milestones`;
CREATE TABLE `milestones`  (
  `milestone_id` int NOT NULL AUTO_INCREMENT,
  `category` tinyint NOT NULL DEFAULT 1,
  `record_id` int NOT NULL DEFAULT 0,
  `occur_date` date NOT NULL DEFAULT '0000-00-00',
  `desc` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`milestone_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of milestones
-- ----------------------------
INSERT INTO `milestones` VALUES (10, 1, 34, '2025-08-30', '银行托管办理');
INSERT INTO `milestones` VALUES (11, 1, 33, '2025-08-28', '基金推介会成功举办');

-- ----------------------------
-- Table structure for notes
-- ----------------------------
DROP TABLE IF EXISTS `notes`;
CREATE TABLE `notes`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `category` smallint NOT NULL COMMENT '业务分类',
  `title` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `entry` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL,
  `date` date NOT NULL COMMENT '发生日期',
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `category`(`category` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci COMMENT = '通用记录表' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of notes
-- ----------------------------

-- ----------------------------
-- Table structure for partners
-- ----------------------------
DROP TABLE IF EXISTS `partners`;
CREATE TABLE `partners`  (
  `p_id` int NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `type` tinyint NOT NULL DEFAULT 1 COMMENT '类型',
  `name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT '姓名',
  `title` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '职位',
  `tel` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT '电话',
  `entered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '录入时间',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后修改时间',
  `status` tinyint NOT NULL DEFAULT 1 COMMENT '状态,1：临时，2：有效，3：失效',
  `email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '电子邮箱',
  `address` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '地址',
  `credential_type` tinyint NOT NULL DEFAULT 1 COMMENT '证件类型',
  `credential_no` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '证件号码',
  `login_name` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '登录手机号码',
  `login_password` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '登录密码',
  `enterprises` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '可见项目',
  `note` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`p_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 71 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci COMMENT = '投资人数据' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of partners
-- ----------------------------
INSERT INTO `partners` VALUES (66, 1, '小马哥', '', '', '2025-08-13 17:18:50', '2025-08-13 17:18:50', 2, '', '', 1, '', '', '', '', '');
INSERT INTO `partners` VALUES (67, 1, '雷布斯', '', '', '2025-08-13 17:18:59', '2025-08-13 17:18:59', 2, '', '', 1, '', '', '', '', '');
INSERT INTO `partners` VALUES (68, 1, '马爸爸', '', '', '2025-08-13 17:19:16', '2025-08-13 17:19:16', 2, '', '', 1, '', '', '', '', '');
INSERT INTO `partners` VALUES (69, 2, '顺为投资', '', '', '2025-08-13 17:21:16', '2025-08-13 17:21:16', 2, '', '', 2, '', '', '', '', '顺为资本团队是由投资行业和互联网行业资深人士组成，具有丰富的风险投资，资本运作和企业经营管理经验，主导投资了超过六百家创业公司。');
INSERT INTO `partners` VALUES (70, 3, '一带一路大基金', '', '', '2025-08-14 11:10:41', '2025-08-14 11:10:41', 2, '', '', 1, '', '', '', '', '');

-- ----------------------------
-- Table structure for progress_logs
-- ----------------------------
DROP TABLE IF EXISTS `progress_logs`;
CREATE TABLE `progress_logs`  (
  `progress_log_id` int NOT NULL AUTO_INCREMENT,
  `category` tinyint NOT NULL DEFAULT 0,
  `subtype` tinyint NOT NULL DEFAULT 0 COMMENT '子类型',
  `occur_date` date NOT NULL DEFAULT '0000-00-00',
  `title` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '标题',
  `entry` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `entered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `external_id` int UNSIGNED NOT NULL DEFAULT 0,
  `show_timeline` tinyint NOT NULL DEFAULT 0 COMMENT '是否展示到时间轴',
  `admin_id` int NOT NULL DEFAULT 0,
  `contact_id` int NOT NULL DEFAULT 0 COMMENT '项目端录入人id',
  `extras` varchar(1024) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT '' COMMENT '附加业务数据',
  PRIMARY KEY (`progress_log_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 339 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of progress_logs
-- ----------------------------
INSERT INTO `progress_logs` VALUES (334, 2, 0, '2025-08-14', '合伙企业工商注册', '', '2025-08-14 15:32:58', '2025-08-14 15:32:58', 34, 0, 25, 0, '');
INSERT INTO `progress_logs` VALUES (335, 2, 0, '2025-08-30', '银行托管办理', '', '2025-08-14 15:40:07', '2025-08-14 15:40:07', 34, 1, 25, 0, '');
INSERT INTO `progress_logs` VALUES (336, 7, 0, '2025-08-14', '杭州拜访，讨论下一步战略', '', '2025-08-14 16:06:35', '2025-08-14 16:06:35', 68, 0, 25, 0, '');
INSERT INTO `progress_logs` VALUES (337, 9, 0, '2025-08-26', '中青拜访', '研讨AI发展趋势', '2025-08-26 18:19:22', '2025-08-26 18:19:22', 84, 0, 25, 0, '');
INSERT INTO `progress_logs` VALUES (338, 2, 0, '2025-08-28', '基金推介会成功举办', '深圳科技园金融孵化基地举办', '2025-08-28 23:17:29', '2025-08-28 23:17:29', 33, 1, 25, 0, '');

-- ----------------------------
-- Table structure for redis
-- ----------------------------
DROP TABLE IF EXISTS `redis`;
CREATE TABLE `redis`  (
  `key` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `value` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`key`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of redis
-- ----------------------------

-- ----------------------------
-- Table structure for schedulers
-- ----------------------------
DROP TABLE IF EXISTS `schedulers`;
CREATE TABLE `schedulers`  (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `job` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '任务',
  `name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '名称',
  `interval` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '执行间隔',
  `date_time_start` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '开始时间',
  `date_time_end` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '结束时间',
  `last_run` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '上次执行时间',
  `disabled` tinyint(1) NOT NULL DEFAULT 0 COMMENT '状态, 0-enable, 1-disabled',
  `deleted` tinyint(1) NOT NULL DEFAULT 0 COMMENT '删除状态, 0-active, 1-deleted',
  `created_by` int UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建人',
  `entered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx_schedule`(`date_time_start` ASC, `deleted` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci COMMENT = '计划任务管理' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of schedulers
-- ----------------------------

-- ----------------------------
-- Table structure for scientist_requirements
-- ----------------------------
DROP TABLE IF EXISTS `scientist_requirements`;
CREATE TABLE `scientist_requirements`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `scientist_id` int UNSIGNED NOT NULL DEFAULT 0 COMMENT '科学家id',
  `content` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT '内容',
  `entered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `scientist_id`(`scientist_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of scientist_requirements
-- ----------------------------
INSERT INTO `scientist_requirements` VALUES (20, 84, 'AI大模型的落地应用', '2025-08-26 18:15:22');

-- ----------------------------
-- Table structure for scientists
-- ----------------------------
DROP TABLE IF EXISTS `scientists`;
CREATE TABLE `scientists`  (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '姓名',
  `field` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '0' COMMENT '领域',
  `assigner` int NOT NULL DEFAULT 0 COMMENT '跟进人uid',
  `place` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '工作场所',
  `contact_way` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '联系方式',
  `core_tech` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT '核心技术',
  `entered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `brief_introduction` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL COMMENT '简介',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 85 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of scientists
-- ----------------------------
INSERT INTO `scientists` VALUES (83, '张某某', '18', 0, '', '', '', '2025-08-14 11:21:12', '');
INSERT INTO `scientists` VALUES (84, '李菲菲', '16', 0, '', '', '', '2025-08-14 11:21:18', '');

-- ----------------------------
-- Table structure for setting
-- ----------------------------
DROP TABLE IF EXISTS `setting`;
CREATE TABLE `setting`  (
  `key` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `value` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`key`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of setting
-- ----------------------------
INSERT INTO `setting` VALUES ('general_site_beian', '粤ICP备0000');

-- ----------------------------
-- Table structure for sub_industry
-- ----------------------------
DROP TABLE IF EXISTS `sub_industry`;
CREATE TABLE `sub_industry`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `deleted` tinyint NOT NULL DEFAULT 0,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `created_by` int NOT NULL DEFAULT 0 COMMENT '创建人',
  `name` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '名称',
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL COMMENT '描述',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci COMMENT = '子行业' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of sub_industry
-- ----------------------------
INSERT INTO `sub_industry` VALUES (17, 0, '2025-08-14 11:19:07', 25, '新能源汽车', '');

-- ----------------------------
-- Table structure for sub_industry_chain
-- ----------------------------
DROP TABLE IF EXISTS `sub_industry_chain`;
CREATE TABLE `sub_industry_chain`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` char(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '名字',
  `parent_id` int UNSIGNED NOT NULL DEFAULT 0 COMMENT '上级部门',
  `sub_industry_id` int UNSIGNED NOT NULL DEFAULT 0 COMMENT '子行业id',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `parent_id`(`parent_id` ASC) USING BTREE,
  INDEX `sub_industry_id`(`sub_industry_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 77 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci COMMENT = '子行业产业链' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of sub_industry_chain
-- ----------------------------
INSERT INTO `sub_industry_chain` VALUES (75, '动力电池', 0, 17);
INSERT INTO `sub_industry_chain` VALUES (76, '功率半导体', 0, 17);

-- ----------------------------
-- Table structure for sub_industry_chain_enterprise
-- ----------------------------
DROP TABLE IF EXISTS `sub_industry_chain_enterprise`;
CREATE TABLE `sub_industry_chain_enterprise`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `sub_industry_chain_id` int UNSIGNED NOT NULL DEFAULT 0 COMMENT '产业链id',
  `eid` int NOT NULL DEFAULT 0 COMMENT '企业id',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `sub_industry_chain_id`(`sub_industry_chain_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 154 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci COMMENT = '子行业产业链关联项目' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of sub_industry_chain_enterprise
-- ----------------------------

-- ----------------------------
-- Table structure for sub_industry_enterprise
-- ----------------------------
DROP TABLE IF EXISTS `sub_industry_enterprise`;
CREATE TABLE `sub_industry_enterprise`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `iid` int NOT NULL COMMENT '行业id',
  `eid` int NOT NULL COMMENT '企业id',
  `sort` smallint UNSIGNED NOT NULL DEFAULT 0 COMMENT '企业在行业中的排序',
  `position` tinyint NOT NULL DEFAULT 0 COMMENT '产业链位置：上中下游',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `uidx`(`iid` ASC, `eid` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci COMMENT = '子行业关联项目' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of sub_industry_enterprise
-- ----------------------------
INSERT INTO `sub_industry_enterprise` VALUES (14, 17, 523, 0, 0);

-- ----------------------------
-- Table structure for sys_err_exp
-- ----------------------------
DROP TABLE IF EXISTS `sys_err_exp`;
CREATE TABLE `sys_err_exp`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `severity` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '错误级别',
  `message` varchar(1024) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `file` varchar(256) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `line` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `trace` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint NOT NULL DEFAULT 1 COMMENT '1-pending, 2-fixed',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of sys_err_exp
-- ----------------------------

-- ----------------------------
-- Table structure for tags
-- ----------------------------
DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `category` int NOT NULL COMMENT '标签分类',
  `pid` int NOT NULL DEFAULT 0,
  `name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `category`(`category` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 188 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tags
-- ----------------------------
INSERT INTO `tags` VALUES (162, 4, 0, '90后', '2022-03-11 16:43:20');
INSERT INTO `tags` VALUES (163, 4, 0, '乐视系', '2022-03-11 16:45:18');
INSERT INTO `tags` VALUES (164, 6, 0, '农业', '2022-03-11 17:28:14');
INSERT INTO `tags` VALUES (165, 6, 164, '大棚种植', '2022-03-11 17:30:08');
INSERT INTO `tags` VALUES (166, 6, 0, '工业', '2022-03-11 17:30:31');
INSERT INTO `tags` VALUES (167, 6, 166, '工业4.0', '2022-03-11 17:30:40');
INSERT INTO `tags` VALUES (168, 6, 164, '生态养殖', '2022-03-11 17:48:42');
INSERT INTO `tags` VALUES (169, 4, 0, '汽车', '2025-08-13 15:58:58');
INSERT INTO `tags` VALUES (170, 4, 0, '手机', '2025-08-13 15:59:04');
INSERT INTO `tags` VALUES (171, 6, 0, '人工智能', '2025-08-14 11:15:01');
INSERT INTO `tags` VALUES (172, 6, 0, '新能源', '2025-08-14 11:15:11');
INSERT INTO `tags` VALUES (173, 6, 0, '大健康', '2025-08-14 11:15:17');
INSERT INTO `tags` VALUES (174, 6, 0, '养老', '2025-08-14 11:15:23');
INSERT INTO `tags` VALUES (175, 6, 0, '新消费', '2025-08-14 11:15:29');
INSERT INTO `tags` VALUES (176, 6, 171, '大模型', '2025-08-14 11:15:36');
INSERT INTO `tags` VALUES (177, 6, 172, '汽车', '2025-08-14 11:15:42');
INSERT INTO `tags` VALUES (178, 6, 172, '光伏', '2025-08-14 11:15:48');
INSERT INTO `tags` VALUES (179, 6, 173, '中医', '2025-08-14 11:15:57');
INSERT INTO `tags` VALUES (180, 6, 174, '养老公寓', '2025-08-14 11:16:11');
INSERT INTO `tags` VALUES (181, 6, 175, '餐饮', '2025-08-14 11:16:22');
INSERT INTO `tags` VALUES (182, 2, 0, 'GPU', '2025-08-14 18:24:23');
INSERT INTO `tags` VALUES (183, 2, 0, '国产替代', '2025-08-14 18:24:35');
INSERT INTO `tags` VALUES (184, 5, 0, '基础算力', '2025-08-14 18:24:50');
INSERT INTO `tags` VALUES (185, 5, 0, '芯片', '2025-08-14 18:25:00');
INSERT INTO `tags` VALUES (186, 4, 0, '具身智能', '2025-08-28 17:37:13');
INSERT INTO `tags` VALUES (187, 4, 0, 'saas', '2025-08-28 17:37:31');

-- ----------------------------
-- Table structure for tags_records
-- ----------------------------
DROP TABLE IF EXISTS `tags_records`;
CREATE TABLE `tags_records`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `entity_type` smallint NOT NULL,
  `entity_id` int NOT NULL,
  `tag_id` int NOT NULL,
  `category` smallint NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` tinyint NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `idx1`(`entity_type` ASC, `entity_id` ASC, `tag_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1350 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tags_records
-- ----------------------------
INSERT INTO `tags_records` VALUES (1326, 4, 5, 169, 4, '2025-08-13 16:02:18', 0);
INSERT INTO `tags_records` VALUES (1327, 4, 5, 170, 4, '2025-08-13 16:02:18', 0);
INSERT INTO `tags_records` VALUES (1328, 4, 6, 169, 4, '2025-08-13 16:06:48', 0);
INSERT INTO `tags_records` VALUES (1329, 4, 6, 170, 4, '2025-08-13 16:06:48', 0);
INSERT INTO `tags_records` VALUES (1330, 4, 7, 169, 4, '2025-08-13 16:09:11', 0);
INSERT INTO `tags_records` VALUES (1331, 4, 7, 170, 4, '2025-08-13 16:09:11', 0);
INSERT INTO `tags_records` VALUES (1332, 4, 8, 169, 4, '2025-08-13 16:13:27', 0);
INSERT INTO `tags_records` VALUES (1333, 4, 8, 170, 4, '2025-08-13 16:13:27', 0);
INSERT INTO `tags_records` VALUES (1334, 4, 9, 169, 4, '2025-08-13 16:13:50', 0);
INSERT INTO `tags_records` VALUES (1335, 4, 9, 170, 4, '2025-08-13 16:13:50', 0);
INSERT INTO `tags_records` VALUES (1336, 4, 10, 169, 4, '2025-08-13 16:19:20', 0);
INSERT INTO `tags_records` VALUES (1337, 4, 10, 170, 4, '2025-08-13 16:19:20', 0);
INSERT INTO `tags_records` VALUES (1338, 1, 521, 166, 6, '2025-08-13 17:14:10', 0);
INSERT INTO `tags_records` VALUES (1339, 1, 521, 167, 6, '2025-08-13 17:14:10', 0);
INSERT INTO `tags_records` VALUES (1340, 1, 522, 164, 6, '2025-08-13 17:16:50', 0);
INSERT INTO `tags_records` VALUES (1341, 1, 522, 165, 6, '2025-08-13 17:16:50', 0);
INSERT INTO `tags_records` VALUES (1342, 1, 522, 168, 6, '2025-08-13 17:16:50', 0);
INSERT INTO `tags_records` VALUES (1343, 4, 16, 162, 4, '2025-08-14 18:24:06', 0);
INSERT INTO `tags_records` VALUES (1344, 1, 523, 182, 2, '2025-08-14 18:25:19', 0);
INSERT INTO `tags_records` VALUES (1345, 1, 523, 183, 2, '2025-08-14 18:25:19', 0);
INSERT INTO `tags_records` VALUES (1346, 1, 523, 184, 5, '2025-08-14 18:25:19', 0);
INSERT INTO `tags_records` VALUES (1347, 1, 523, 185, 5, '2025-08-14 18:25:19', 0);
INSERT INTO `tags_records` VALUES (1348, 4, 14, 186, 4, '2025-08-28 17:37:16', 0);
INSERT INTO `tags_records` VALUES (1349, 4, 11, 187, 4, '2025-08-28 17:37:34', 0);

-- ----------------------------
-- Table structure for users_follow
-- ----------------------------
DROP TABLE IF EXISTS `users_follow`;
CREATE TABLE `users_follow`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `target_type` tinyint NOT NULL,
  `target_id` int NOT NULL,
  `ctime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `utt`(`user_id` ASC, `target_type` ASC, `target_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of users_follow
-- ----------------------------
INSERT INTO `users_follow` VALUES (1, 25, 1, 523, '2025-08-14 18:21:40');
INSERT INTO `users_follow` VALUES (2, 25, 1, 522, '2025-08-26 18:09:53');

-- ----------------------------
-- Table structure for users_records
-- ----------------------------
DROP TABLE IF EXISTS `users_records`;
CREATE TABLE `users_records`  (
  `module` char(36) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `user_id` int NOT NULL,
  `record_id` int NOT NULL,
  `primary` tinyint NOT NULL DEFAULT 0 COMMENT '是否主跟进人',
  UNIQUE INDEX `idx_m_uid_rid`(`module` ASC, `user_id` ASC, `record_id` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of users_records
-- ----------------------------
INSERT INTO `users_records` VALUES ('Contacts', 25, 5, 1);
INSERT INTO `users_records` VALUES ('Contacts', 25, 6, 1);
INSERT INTO `users_records` VALUES ('Contacts', 25, 7, 1);
INSERT INTO `users_records` VALUES ('Contacts', 25, 8, 1);
INSERT INTO `users_records` VALUES ('Contacts', 25, 9, 1);
INSERT INTO `users_records` VALUES ('Contacts', 25, 10, 1);
INSERT INTO `users_records` VALUES ('Contacts', 25, 11, 1);
INSERT INTO `users_records` VALUES ('Contacts', 25, 14, 1);
INSERT INTO `users_records` VALUES ('Contacts', 25, 15, 1);
INSERT INTO `users_records` VALUES ('Contacts', 25, 16, 1);
INSERT INTO `users_records` VALUES ('Contacts', 31, 5, 0);
INSERT INTO `users_records` VALUES ('Contacts', 31, 6, 0);
INSERT INTO `users_records` VALUES ('Contacts', 31, 7, 0);
INSERT INTO `users_records` VALUES ('Contacts', 31, 8, 0);
INSERT INTO `users_records` VALUES ('Contacts', 31, 9, 0);
INSERT INTO `users_records` VALUES ('Contacts', 31, 10, 0);
INSERT INTO `users_records` VALUES ('Contacts', 31, 12, 1);
INSERT INTO `users_records` VALUES ('Contacts', 31, 13, 1);
INSERT INTO `users_records` VALUES ('Contacts', 31, 14, 1);
INSERT INTO `users_records` VALUES ('Enterprises', 25, 519, 1);
INSERT INTO `users_records` VALUES ('Enterprises', 25, 522, 1);
INSERT INTO `users_records` VALUES ('Enterprises', 25, 523, 1);
INSERT INTO `users_records` VALUES ('Enterprises', 31, 520, 1);
INSERT INTO `users_records` VALUES ('Enterprises', 31, 521, 1);
INSERT INTO `users_records` VALUES ('Enterprises', 31, 522, 1);

-- ----------------------------
-- Table structure for work_status
-- ----------------------------
DROP TABLE IF EXISTS `work_status`;
CREATE TABLE `work_status`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `category` tinyint NOT NULL DEFAULT 1,
  `record_id` int NOT NULL DEFAULT 0,
  `workers` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `status` tinyint NOT NULL DEFAULT 1 COMMENT '1-working, 2-finished',
  `finished_date` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of work_status
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
