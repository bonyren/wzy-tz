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
CREATE TABLE `funds_finance_contributes` (
  `ffc_id` int(11) NOT NULL AUTO_INCREMENT,
  `fund_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT '',
  `amount` decimal(18,2) NOT NULL DEFAULT '0.00',
  `date` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`ffc_id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;
*/
class FundsFinanceContributes extends Base
{
    protected $table = 'funds_finance_contributes';
    protected $pk = 'ffc_id';
    protected static $audit_fields = [
        'fund_id' => '基金名称',
        'title' => '标题',
        'amount'=> '出资金额',
        'date'=>'出资日期'
    ];
    protected static $audit_field_translates = [
        'fund_id'=>'translateFundId'
    ];
    protected static $audit_record_id_field = 'fund_id';
    protected static function translateFundId($fundId){
        $value = Db::table('funds')->where('fund_id', $fundId)->value('name');
        return $value === null?'':$value;
    }
}