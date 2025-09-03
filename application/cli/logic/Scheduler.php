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
namespace app\cli\logic;
use app\index\logic\Base;
use app\cli\model\Scheduler as SchedulerModel;
use app\index\service\RequestContext;
use app\index\logic\Defs as IndexDefs;

class Scheduler extends Base
{
    const STATUS = [
        0 => ['value'=>0,'label'=>'正常'],
        1 => ['value'=>1,'label'=>'禁用'],
    ];
    const JOBS = [
        'backupDB'=>'数据库备份',
        'cleanServer'=>'清理服务器'
    ];
    public function getScheduler($id){
        $row = SchedulerModel::get($id);
        return $row;
    }

    public function saveScheduler($data){
        $data['date_time_end'] = dateTimeDbConverter($data['date_time_end']);
        if(isset($data['id']) && $data['id']) {
            $scheduler = SchedulerModel::update($data, ['id'=>$data['id']], true);
        } else {
            $data['created_by'] = RequestContext::I()->loginUserId;
            $scheduler = SchedulerModel::create($data,true);
        }
        return $scheduler;
    }
}