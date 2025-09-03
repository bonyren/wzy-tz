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
use app\index\service\EventLogs;
use think\Controller;
use think\Db;
use think\Log;

class EventLog extends Common
{
    public function getList($entity=0, $search=[], $page=1, $rows=DEFAULT_PAGE_ROWS)
    {
        $where = [];
        if($entity){
            $where['entity_type'] = $entity;
        }
        $total = Db::table('event_logs')->where($where)->count();
        if (empty($total)) {
            return [];
        }
        $rows = Db::table('event_logs')->where($where)->page($page,$rows)->order('id desc')->select();
        EventLogs::showLogs($rows);
        return [
            'total'=>$total,
            'rows'=>$rows
        ];
    }

    public function globals($entity=0, $search=[],$page=1,$rows=DEFAULT_PAGE_ROWS)
    {
        if($this->request->isPost()) {
            return json($this->getList($entity, $search, $page, $rows));
        }
        return $this->fetch();
    }
}