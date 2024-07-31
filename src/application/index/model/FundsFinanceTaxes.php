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
 * CREATE TABLE `funds_finance_taxes` (
  `fft_id` int(11) NOT NULL AUTO_INCREMENT,
  `fund_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT '',
  `amount` decimal(18,2) NOT NULL DEFAULT '0.00',
  `type` tinyint(4) NOT NULL DEFAULT '1',
  `date` date NOT NULL DEFAULT '0000-00-00',
  `ffi_id` int(11) NOT NULL DEFAULT '0',
  `ffc_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`fft_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

 */

class FundsFinanceTaxes extends Base
{
    protected $table = 'funds_finance_taxes';
    protected $pk = 'fft_id';
    protected static $audit_fields = [
        'fund_id' => '基金名称',
        'title' => '缴税标题',
        'amount'=> '缴税金额',
        'date'=>'缴税日期',
        'type'=>'类型'
    ];
    protected static $audit_field_translates = [
        'fund_id'=>'translateFundId',
        'type'=>'translateTaxType'
    ];
    protected static $audit_record_id_field = 'fund_id';
    protected static function translateFundId($fundId){
        $value = Db::table('funds')->where('fund_id', $fundId)->value('name');
        return $value === null?'':$value;
    }
    protected static function translateTaxType($type){
        if (isset(\app\index\logic\Defs::$fundTaxTypeDefs[$type])) {
            return \app\index\logic\Defs::$fundTaxTypeDefs[$type];
        }else{
            return '';
        }
    }
}