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
use think\Log;
class Scheduler extends Controller{
    public function execute(){
        Log::notice("Scheduler-execute");
        $dispatcher = new Dispatcher();
        $dispatcher->run();
    }
}