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
use app\index\logic\Defs;
use think\Db;
/*
CREATE TABLE `milestones` (
  `milestone_id` int(11) NOT NULL AUTO_INCREMENT,
  `category` tinyint(4) NOT NULL DEFAULT '1',
  `record_id` int(11) NOT NULL DEFAULT '0',
  `occur_date` date NOT NULL DEFAULT '0000-00-00',
  `desc` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`milestone_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
*/

class Milestones extends Base
{
    const MILESTONE_FUND_CATEGORY = 1;
    public static $milestoneCategoryDefs = [
        self::MILESTONE_FUND_CATEGORY=>'基金'
    ];
    protected $pk = 'milestone_id';
    protected $table = 'milestones';
    protected static $audit_fields = [
        'category' => '里程碑名称',
        'occur_date' => '里程碑日期',
        'desc' => '里程碑描述'
    ];
    protected static $audit_field_translates = [
        'category'=>'translateCategory'
    ];
    protected static $audit_record_id_field = 'record_id';
    protected static function translateCategory($category){
        if(isset(self::$milestoneCategoryDefs[$category])){
            return self::$milestoneCategoryDefs[$category];
        }else{
            return '';
        }
    }
}