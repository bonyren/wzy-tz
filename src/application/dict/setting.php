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
return array(
    /* 全站设置  */
    'general_site_title' => array(
        'name'    => '系统标题',
        'group'   => '通用',
        'editor'  => array('type'=>'textbox','options'=>array('tipPosition'=>'left', 'validType'=>array('nothtml','length[0,255]'))),
        'default' => '***投资业务系统',
    ),
    'general_site_keywords' => array(
        'name'    => '系统关键字',
        'group'   => '通用',
        'editor'  => array('type'=>'textbox','options'=>array('tipPosition'=>'left', 'validType'=>array('nothtml','length[0,255]'))),
        'default' => '***投资业务系统',
    ),
    'general_site_description' => array(
        'name'    => '系统描述',
        'group'   => '通用',
        'editor'  => array('type'=>'textbox','options'=>array('tipPosition'=>'left', 'validType'=>array('nothtml','length[0,255]'))),
        'default' => '***投资业务系统',
    ),
    'general_admin_address' => array(
        'name'    => '管理员邮箱',
        'group'   => '通用',
        'editor'  => array('type'=>'textbox','options'=>array('tipPosition'=>'left', 'validType'=>array('nothtml','email','length[0,255]'))),
        'default' => '',
    ),
    'general_organisation_name' => array(
        'name'    => '组织名字',
        'group'   => '通用',
        'editor'  => array('type'=>'textbox','options'=>array('tipPosition'=>'left', 'validType'=>array('nothtml','length[0,255]'))),
        'default' => '***投资公司',
    ),
    'general_organisation_logo' => array(
        'name'    => '系统LOGO(200x200 pixels)',
        'group'   => '通用',
        'editor'  => array('type'=>'image','options'=>array( 'handler'=>'systemSettingModule.image', 'zoom'=>false)),
        'default' => '/static/img/logo.png',
    ),
    'general_power_by_text' => array(
        'name'    => '系统版权',
        'group'   => '通用',
        'editor'  => array('type'=>'textbox','options'=>array('tipPosition'=>'left', 'validType'=>array('nothtml','length[0,255]'))),
        'default' => 'powered by ***',
    ),
    /**************************************************************************************************************/
    'LOGIN_ONLY_ONE'=>array(
        'name'    => '启用单点登录',
        'group'   => '安全设置',
        'editor'  => array('type'=>'checkbox','options'=>array('on'=>'yes','off'=>'no')),
        'default' => 'yes',
    ),
    /* 邮箱设置  */
    'EMAIL_SMTP' => array(
        'name'    => '发送服务器主机(SMTP)',
        'group'   => '邮箱设置(不支持ssl)',
        'editor'  => array('type'=>'validatebox','options'=>array('tipPosition'=>'left', 'validType'=>array('nothtml','length[0,255]'))),
        'default' => '',
        'collection' => 'email'
    ),
    'EMAIL_PORT' => array(
        'name'    => '发送服务器端口(SMTP)',
        'group'   => '邮箱设置(不支持ssl)',
        'editor'  => 'numberbox',
        'default' => 25,
        'collection' => 'email'
    ),
    'EMAIL_USER' => array(
        'name'    => '用户名',
        'group'   => '邮箱设置(不支持ssl)',
        'editor'  => array('type'=>'validatebox','options'=>array('tipPosition'=>'left', 'validType'=>array('nothtml','length[0,255]'))),
        'default' => '',
        'collection' => 'email'
    ),
    'EMAIL_PWD' => array(
        'name'    => '密码',
        'group'   => '邮箱设置(不支持ssl)',
        'editor'  => array('type'=>'validatebox','options'=>array('tipPosition'=>'left', 'validType'=>array('nothtml','length[0,255]'))),
        'default' => '',
        'collection' => 'email'
    ),
    'EMAIL_FROM_ADDRESS' => array(
        'name'    => '发信地址',
        'group'   => '邮箱设置(不支持ssl)',
        'editor'  => array('type'=>'validatebox','options'=>array('tipPosition'=>'left', 'validType'=>array('nothtml','length[0,255]'))),
        'default' => '',
        'collection' => 'email'
    ),
    'EMAIL_FROM_NAME' => array(
        'name'    => '发信名字',
        'group'   => '邮箱设置(不支持ssl)',
        'editor'  => array('type'=>'validatebox','options'=>array('tipPosition'=>'left', 'validType'=>array('nothtml','length[0,255]'))),
        'default' => '',
        'collection' => 'email'
    ),
    /**************************************************************************************************************/
    /* 数据备份  */
    'DB_BACKUP_PATH' => array(
        'name'    => '备份路径',
        'group'   => '数据备份',
        'editor'  => array('type'=>'validatebox','options'=>array('tipPosition'=>'left', 'validType'=>array('nothtml','length[0,255]'))),
        'default' => ROOT_PATH . 'db' . DS . 'backup',
        'collection' => 'DB_BACKUP'
    ),
    'DB_BACKUP_EXPIRATION' => array(
        'name'    => '保留天数',
        'group'   => '数据备份',
        'editor'  => 'numberbox',
        'default' => 30,
        'collection' => 'DB_BACKUP'
    ),
);