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
use think\Db;

/*
CREATE TABLE `scientists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL DEFAULT '' COMMENT '姓名',
  `field` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '领域',
  `place` varchar(200) NOT NULL DEFAULT '' COMMENT '工作场所',
  `contact_way` varchar(200) NOT NULL DEFAULT '' COMMENT '联系方式',
  `core_tech` text NOT NULL COMMENT '核心技术',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
*/
class Scientists extends Base
{
    protected $table = 'scientists';
    protected $pk = 'id';
    protected static $audit_fields = [
        'name' => '姓名',
        'field' => '领域',
        'place'=> '工作场所',
        'contact_way'=>'联系方式',
        'brief_introduction'=>'简介',
        'core_tech'=>'核心技术',
    ];
    protected static $audit_field_translates = [
        'field'=>'translateScientistFieldId'
    ];
    protected static function translateScientistFieldId($id){
        $value = Db::table('config_scientist_field')->where('id', $id)->value('name');
        return $value === null?'':$value;
    }
}