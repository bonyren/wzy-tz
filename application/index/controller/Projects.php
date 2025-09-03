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

class Projects extends Common
{
    public function projects($search=[],$page=1,$rows=DEFAULT_PAGE_ROWS,$sort='project_id',$order='desc'){
        if(request()->isGet()){
            $urlHrefs = [
                'projects'=>url('index/Projects/projects')
            ];
            $this->assign('urlHrefs', $urlHrefs);
            return $this->fetch();
        }
        return json([
            'total'=>0,
            'rows'=>[]
        ]);
    }
}