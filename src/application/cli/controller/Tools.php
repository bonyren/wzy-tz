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
use think\Db;
use think\Log;
class Tools extends Controller
{
    public function _initialize()
    {
        parent::_initialize();
        if (!IS_CLI) {
            die('cron.php is CLI only.');
        }
    }
    public function hello(){
        echo "hello";
    }
}