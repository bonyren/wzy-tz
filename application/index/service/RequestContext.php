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

namespace app\index\service;
use think\Db;
use think\Log;
use think\Debug;

class RequestContext extends Base
{
    protected function __construct(){}
    public $loginUserId = null;
    public $loginUserName = null;
    public $loginUserRoleId = null;
    public $loginTime = null;
    public $loginIp = null;
    public $loginSuperUser = null;
    public $loginMobile = null;
}