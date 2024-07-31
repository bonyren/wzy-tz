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
CREATE TABLE `change_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `external_id` int(11) NOT NULL DEFAULT '0',
  `category` tinyint(4) NOT NULL DEFAULT '1',
  `desc` text NOT NULL,
  `change_date` date NOT NULL DEFAULT '0000-00-00',
  `from_date` date NOT NULL DEFAULT '0000-00-00',
  `end_date` date NOT NULL DEFAULT '0000-00-00',
  `entered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
*/

class ChangeLogs extends Base
{
    protected $id = "id";
    protected $table = "change_logs";
    protected static $audit_fields = [
        'desc' => '描述',
        'category'=> '类别',
        'change_date'=> '日期',
        'from_date'=>'所属开始日期',
        'end_date'=>'所属结束日期'
    ];
    protected static $audit_field_translates = [
        'category'=>'translateCategory',
        'type'=>'translateType'
    ];
    protected static $audit_record_id_field = 'external_id';

    protected static function translateCategory($id){
        return \app\index\logic\ChangeLogs::$changeLogCategoryDefs[$id];
    }
}