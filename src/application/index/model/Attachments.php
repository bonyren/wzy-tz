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

/*
CREATE TABLE `attachments` (
  `attachment_id` int(11) NOT NULL AUTO_INCREMENT,
  `original_name` varchar(255) NOT NULL DEFAULT '',
  `save_name` varchar(255) NOT NULL DEFAULT '',
  `mime_type` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `size` int(11) NOT NULL DEFAULT '0',
  `attachment_type` int(11) NOT NULL DEFAULT '1',
  `external_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`attachment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=91 DEFAULT CHARSET=utf8;
*/
class Attachments extends Base
{
    protected $table = 'attachments';
    protected $pk = 'attachment_id';
    protected static $audit_fields = [
        'original_name' => '原文件名',
        'description' => '描述',
        'attachment_type' => '文件类别'
    ];
    protected static $audit_field_translates = [
        'attachment_type' => 'translateAttachmentType'
    ];

    protected static function translateAttachmentType($type)
    {
        if (isset(\app\index\logic\Upload::$attachTypeDefs[$type])) {
            return \app\index\logic\Upload::$attachTypeDefs[$type]['label'];
        }else{
            return '';
        }
    }
    protected static $audit_record_id_field = 'external_id';
}