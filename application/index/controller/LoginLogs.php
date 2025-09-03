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
namespace app\index\controller;
use think\Controller;
use think\Log;
use think\Debug;
use think\Request;
use app\index\logic\Defs;

class LoginLogs extends Common{
    public function index($search=[],$page=1,$rows=DEFAULT_PAGE_ROWS,$sort='id',$order='desc'){
        if(request()->isGet()) {
            $urlHrefs = [
                'index' => url('index/LoginLogs/index')
            ];
            $this->assign('urlHrefs', $urlHrefs);
            return $this->fetch();
        }
        $loginLogsLogic = \app\index\logic\LoginLogs::newObj();
        return json($loginLogsLogic->load($search, $page, $rows, $sort, $order));
    }
}