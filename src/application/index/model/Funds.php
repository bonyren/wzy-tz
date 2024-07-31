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
/*
 * CREATE TABLE `funds` (
  `fund_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '基金名称',
  `reg_place` varchar(100) NOT NULL DEFAULT '',
  `size` decimal(18,2) NOT NULL DEFAULT '0.00' COMMENT '认缴规模',
  `partnership_start_date` date NOT NULL DEFAULT '0000-00-00' COMMENT '合伙企业设立日期',
  `partnership_end_date` date NOT NULL DEFAULT '0000-00-00' COMMENT '合伙企业终止日期',
  `establish_date` date NOT NULL DEFAULT '0000-00-00' COMMENT '备案成立日期',
  `invest_period` int(11) NOT NULL DEFAULT '0' COMMENT '基金投资期（年）',
  `invest_fee_ratio` decimal(18,2) NOT NULL DEFAULT '0.00' COMMENT '投资期管理费率',
  `exit_period` int(11) NOT NULL DEFAULT '0' COMMENT '基金退出期（年）',
  `exit_fee_ratio` decimal(18,2) NOT NULL DEFAULT '0.00' COMMENT '退出期管理费率',
  `extend_period` int(11) NOT NULL DEFAULT '0' COMMENT '基金延长期（年）',
  `entered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '录入时间',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后修改时间',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '运营状态，1-pending, 2-established, 3-over',
  PRIMARY KEY (`fund_id`,`partnership_end_date`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
 */
class Funds extends Base{
    protected $table = 'funds';
    protected $pk = 'fund_id';
    protected static $audit_fields = [
        'name' => '基金名称',
        'reg_place' => '基金注册地',
        'size'=> '认缴规模',
        'partnership_start_date'=>'合伙企业设立日期',
        'partnership_end_date'=>'合伙企业终止日期',
        'establish_date'=>'备案成立日期',
        'invest_period'=>'基金投资期',
        'invest_fee_ratio'=>'投资期管理费率',
        'exit_period'=>'基金退出期',
        'exit_fee_ratio'=>'退出期管理费率',
        'extend_period'=>'基金延长期'
    ];
    protected static $audit_field_translates = [

    ];
}