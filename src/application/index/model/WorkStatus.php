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
 * CREATE TABLE `work_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` tinyint(4) NOT NULL DEFAULT '1',
  `external_id` int(11) NOT NULL DEFAULT '0',
  `workers` varchar(255) NOT NULL DEFAULT '',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1-working, 2-finished',
  `finished_date` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
 */
class WorkStatus extends Base
{
    const WORK_BUSINESS_REG_CATEGORY = 1;

    public static $workCategoryDefs = [
        self::WORK_BUSINESS_REG_CATEGORY=>'基金合伙企业工商注册'
    ];
    const WORK_WORKING_STATUS = 1;
    const WORK_FINISHED_STATUS = 2;
    public static $workStatusDefs = [
        self::WORK_WORKING_STATUS=>'进行中',
        self::WORK_FINISHED_STATUS=>'已完成'
    ];

    protected $pk="id";
    protected $table="work_status";
    protected static $audit_fields = [
        'category' => '工作名称',
        'workers' => '完成人',
        'status' => '完成状态',
        'finished_date' => '完成日期',
    ];
    protected static $audit_field_translates = [
        'workers'=>'translateWorkers',
        'category'=>'translateCategory',
        'status'=>'translateStatus'
    ];
    protected static $audit_record_id_field = 'record_id';
    protected static function translateWorkers($workers){
        $names = Db::table('admins')->where('admin_id', 'in', $workers)->column('realname');
        return join(',', $names);
    }
    protected static function translateCategory($category){
        if(isset(self::$workCategoryDefs[$category])){
            return self::$workCategoryDefs[$category];
        }else{
            return '';
        }
    }
    protected static function translateStatus($status){
        if(isset(self::$workStatusDefs[$status])){
            return self::$workStatusDefs[$status];
        }else{
            return '';
        }
    }
}