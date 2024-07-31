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

namespace app\cli\controller;
use think\Controller;
use think\Request;
use app\index\service\RequestContext;

class Common extends Controller
{
    protected function _initialize(){
        if (!IS_CLI) {
            die('cron.php is CLI only.');
        }
    }
}