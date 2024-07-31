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
use think\Db;
/*
CREATE TABLE `funds_collect` (
  `fund_id` int(11) NOT NULL DEFAULT '0',
  `plan_info` varchar(255) NOT NULL DEFAULT '',
  `protocol_info` varchar(255) NOT NULL DEFAULT '',
  `business_reg_info` varchar(255) NOT NULL DEFAULT '',
  `business_reg_proxy_id` int(11) NOT NULL DEFAULT '0',
  `business_license_no` varchar(255) NOT NULL DEFAULT '',
  `bank_basic_account` varchar(255) NOT NULL DEFAULT '',
  `hosting_plan_info` varchar(255) NOT NULL DEFAULT '',
  `hosting_agency_id` int(11) NOT NULL DEFAULT '0',
  `hosting_fee_ratio` decimal(18,2) NOT NULL DEFAULT '0.00',
  `bank_collect_account` varchar(255) NOT NULL DEFAULT '',
  `bank_hosting_account` varchar(255) NOT NULL DEFAULT '',
  `tax_valueadded_ratio` decimal(18,2) NOT NULL DEFAULT '0.00',
  `tax_valueadded_discount` decimal(18,2) NOT NULL DEFAULT '0.00',
  `tax_income_ratio` decimal(18,2) NOT NULL DEFAULT '0.00',
  `tax_income_discount` decimal(18,2) NOT NULL DEFAULT '0.00',
  `tax_stamp_ratio` decimal(18,2) NOT NULL DEFAULT '0.00',
  `tax_stamp_discount` decimal(18,2) NOT NULL DEFAULT '0.00',
  `tax_valueadded_extra_ratio` decimal(18,2) NOT NULL DEFAULT '0.00',
  `tax_valueadded_extra_discount` decimal(18,2) NOT NULL DEFAULT '0.00',
  `tax_info` varchar(255) NOT NULL DEFAULT '',
  `filing_no` varchar(255) NOT NULL DEFAULT '',
  `filing_info` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`fund_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
*/
class FundsCollect extends Base
{
    protected $table = 'funds_collect';
    protected $pk = 'fund_id';
    protected static $audit_fields = [
        'plan_info' => '基金方案备注',
        'protocol_info' => '合伙协议备注',
        'business_reg_info'=> '工商注册备注',
        'business_reg_proxy_id'=>'工商代理机构',
        'business_license_no'=>'营业执照号',
        'bank_basic_account'=>'银行基本户',
        'hosting_plan_info'=>'托管备注',
        'hosting_agency_id'=>'托管机构',
        'hosting_fee_ratio'=>'托管费率',
        'bank_collect_account'=>'银行募集账户',
        'bank_hosting_account'=>'银行托管账户',
        'tax_valueadded_ratio'=>'增值税率',
        'tax_valueadded_discount'=>'增值税优惠',
        'tax_income_ratio'=>'个人经营所得税率',
        'tax_income_discount'=>'个人经营所得优惠',
        'tax_stamp_ratio'=>'印花税率',
        'tax_stamp_discount'=>'印花税优惠',
        'tax_valueadded_extra_ratio'=>'增值税附加税率',
        'tax_valueadded_extra_discount'=>'增值税附加优惠',
        'tax_info'=>'税务备注',
        'filing_no'=>'备案号',
        'filing_info'=>'备案备注'
    ];
    protected static $audit_field_translates = [
        'business_reg_proxy_id'=>'translateBusinessRegProxyId',
        'hosting_agency_id'=>'translateHostingAgencyId'
    ];
    protected static function translateBusinessRegProxyId($id){
        $value = Db::table('config_business_reg_proxy')->where('id', $id)->value('name');
        return $value === null?'':$value;
    }
    protected static function translateHostingAgencyId($id){
        $value = Db::table('config_fund_hosting_agency')->where('id', $id)->value('name');
        return $value === null?'':$value;
    }
}