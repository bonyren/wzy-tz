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
namespace app\common;
class CommonDefs
{
    const MODULE_ADMIN = 1; //管理端
    const MODULE_PARTNER = 2; //LP端
    const MODULE_PROJECT = 3; //项目端
    //界面授权权限
    const AUTHORIZE_FORBIDDEN_TYPE = 0;//禁止访问
    const AUTHORIZE_READ_ONLY_TYPE = 1;//只读
    const AUTHORIZE_READ_WRITE_TYPE = 2;//读写
    const AUTHORIZE_LIST_ONLY_TYPE = 3;//只读列表
}