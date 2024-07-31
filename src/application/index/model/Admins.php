<?php
// +----------------------------------------------------------------------
// | WZYCODING [ SIMPLE SOFTWARE IS THE BEST ]
// +----------------------------------------------------------------------
// | Copyright (c) 2018~2025 wzycoding All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://license.coscl.org.cn/MulanPSL2 )
// +----------------------------------------------------------------------
// | Author: wzycoding <wzycoding@qq.com>
// +----------------------------------------------------------------------
namespace app\index\model;
use think\Model;

/*
 * CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `login_name` varchar(25) NOT NULL DEFAULT '',
  `login_password` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `super_user` tinyint(4) NOT NULL DEFAULT '2',
  `disabled` tinyint(4) NOT NULL DEFAULT '2',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `password_changed` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
 */
class Admins extends Model{
    protected $pk = 'admin_id';
    protected $table = 'admins';
    const eAdminSuperRole = 1;
    const eAdminCommonRole = 2;
    public static $eAdminRoleDefs = array(
        self::eAdminSuperRole=>'超级用户',
        self::eAdminCommonRole=>'普通用户'
    );
    const eAdminEnableStatus = 1;
    const eAdminDisabledStatus = 2;
    public static $eAdminStatusDefs = array(
        self::eAdminEnableStatus=>'有效',
        self::eAdminDisabledStatus=>'无效'
    );
}