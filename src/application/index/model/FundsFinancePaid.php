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
CREATE TABLE `funds_finance_paid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL DEFAULT '0',
  `item_type` tinyint(4) NOT NULL DEFAULT '1',
  `actual_amount` decimal(18,2) NOT NULL,
  `pay_date` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
*/
class FundsFinancePaid extends Base
{
    protected $table = 'funds_finance_paid';
    protected $pk = 'id';

    protected static $audit_fields = [
        'item_id' => '基金财务名称',
        'item_type' => '基金财务类型',
        'actual_amount'=> '核销金额',
        'pay_date'=>'核销日期'
    ];
    protected static $audit_field_translates = [
        'item_id'=>'translateItemId',
        'item_type'=>'translateItemType'
    ];
    protected static $audit_record_id_field = 'item_id';
    protected static function translateItemId($itemId){
        return $itemId;
    }
    protected static function translateItemType($type){
        if (isset(\app\index\logic\FundsFinance::$fundFinancePaidItemTypeDefs[$type])) {
            return \app\index\logic\FundsFinance::$fundFinancePaidItemTypeDefs[$type];
        }else{
            return '';
        }
    }
}