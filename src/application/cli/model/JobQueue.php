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
namespace app\cli\model;
use app\cli\controller\Jobs;
use think\Log;
use think\Model;
use app\Defs;
/*
 * CREATE TABLE `job_queue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `scheduler_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `execute_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `execute_end_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `result` varchar(20) NOT NULL DEFAULT '',
  `message` text NOT NULL,
  `target` varchar(255) NOT NULL DEFAULT '',
  `client` varchar(100) NOT NULL DEFAULT '',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `entered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;

 */
class JobQueue extends Model{
    protected $pk = 'id';
    protected $table = 'job_queue';

    /**
     * 状态定义
     */
    const JOB_STATUS_QUEUED = 1;
    const JOB_STATUS_RUNNING = 2;
    const JOB_STATUS_DONE = 3;
    const JOB_STATUS = [
        self::JOB_STATUS_QUEUED => ['value'=>self::JOB_STATUS_QUEUED, 'label'=>'排队中', 'cls'=>'default'],
        self::JOB_STATUS_RUNNING => ['value'=>self::JOB_STATUS_RUNNING, 'label'=>'运行中', 'cls'=>'secondary'],
        self::JOB_STATUS_DONE => ['value'=>self::JOB_STATUS_DONE, 'label'=>'已完成', 'cls'=>'success'],
    ];
    /**
     * 结果定义
     */
    const JOB_RESULT_PENDING = '待定';
    const JOB_RESULT_SUCCESS = '成功';
    const JOB_RESULT_FAILURE = '失败';
    //获取器定义
    public function getExecuteTimeAttr($value){
        if($value == Defs::DEFAULT_DB_DATETIME_VALUE){
            return '';
        }
        return $value;
    }
    public function getExecuteEndTimeAttr($value){
        if($value == Defs::DEFAULT_DB_DATETIME_VALUE){
            return '';
        }
        return $value;
    }

    public function failJob($message = '') {
        return $this->resolveJob(self::JOB_RESULT_FAILURE, $message);
    }

    public function resolveJob($result, $message = ''){

        Log::record("Resolving job {$this->id} as {$result}: {$message}");
        $this->status = self::JOB_STATUS_DONE;
        $this->message = $message;
        $this->result = $result;
        $this->execute_end_time = date('Y-m-d H:i:s');
        $this->save();
        Scheduler::update(['last_run'=>date('Y-m-d H:i:s')],['id'=>$this->scheduler_id]);
        return true;
    }

    public function runJob(){
        $jobs = new Jobs();
        $func = $this->target;

        if(false == is_callable([$jobs, $func], false, $callable_name)) {
            $this->failJob('Not Callable: ' . $callable_name);
            return false;
        }
        $result = call_user_func([$jobs, $func]);
        if($this->status == self::JOB_STATUS_RUNNING) {
            if($result) {
                $this->resolveJob(self::JOB_RESULT_SUCCESS);
                return true;
            } else {
                $this->failJob();
                return false;
            }
        } else {
            return $this->result != self::JOB_RESULT_FAILURE;
        }
    }
}