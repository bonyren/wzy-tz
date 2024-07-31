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

/*
CREATE TABLE `partners` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT '姓名',
  `tel` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL DEFAULT '',
  `address` varchar(255) NOT NULL DEFAULT '',
  `credential_type` tinyint(4) NOT NULL DEFAULT '1',
  `credential_no` varchar(100) NOT NULL DEFAULT '',
  `entered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '录入时间',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后修改时间',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1-有限合伙人，2-普通合伙人',
  PRIMARY KEY (`p_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

*/
class Partners extends Base
{
    protected $table = 'partners';
    protected $pk = 'p_id';

    protected static $audit_fields = [
        'name' => '姓名',
        'tel' => '电话',
        'email'=> '电子邮箱',
        'address'=>'地址',
        'type'=>'类型',
        'credential_type'=>'证件类型',
        'credential_no'=>'证件号码'
    ];
    protected static $audit_field_translates = [
        'credential_type'=>'translatePartnerCredentialType',
        'type'=>'translateType'
    ];
    protected static function translatePartnerCredentialType($type)
    {
        if (isset(\app\index\logic\Defs::$partnerCredentialTypeDefs[$type])) {
            return \app\index\logic\Defs::$partnerCredentialTypeDefs[$type];
        }else{
            return '';
        }
    }
    protected static function translateType($type){
        if (isset(\app\index\logic\Defs::$partnerTypeDefs[$type])) {
            return \app\index\logic\Defs::$partnerTypeDefs[$type];
        }else{
            return '';
        }
    }
}