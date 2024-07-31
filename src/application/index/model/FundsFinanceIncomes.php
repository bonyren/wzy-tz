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
use app\index\logic\Defs;
/*
 * CREATE TABLE `funds_finance_incomes` (
  `ffi_id` int(11) NOT NULL AUTO_INCREMENT,
  `fund_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT '',
  `amount` decimal(18,2) NOT NULL DEFAULT '0.00',
  `type` tinyint(4) NOT NULL DEFAULT '1',
  `date` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`ffi_id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;
 */

class FundsFinanceIncomes extends Base
{
    protected $table = 'funds_finance_incomes';
    protected $pk = 'ffi_id';
    protected static $audit_fields = [
        'fund_id' => '基金名称',
        'title' => '收入标题',
        'amount'=> '收入金额',
        'date'=>'收入日期',
        'type'=>'类型'
    ];
    protected static $audit_field_translates = [
        'fund_id'=>'translateFundId',
        'type'=>'translateIncomeType'
    ];
    protected static $audit_record_id_field = 'fund_id';
    protected static function translateFundId($fundId){
        $value = Db::table('funds')->where('fund_id', $fundId)->value('name');
        return $value === null?'':$value;
    }
    protected static function translateIncomeType($type){
        if (isset(\app\index\logic\Defs::$fundIncomeTypeDefs[$type])) {
            return \app\index\logic\Defs::$fundIncomeTypeDefs[$type];
        }else{
            return '';
        }
    }
}