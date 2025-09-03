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
class Help extends Common{
    public function help($topicId){
        $helpLogic = \app\index\logic\Help::newObj();
        $tpl = $helpLogic->getTpl($topicId);
        if(!$tpl){
            return $this->fetch('common/error');
        }
        return $this->fetch($tpl);
    }
}