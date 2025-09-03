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
use app\cli\Jobs\BackupDB;
use app\cli\Jobs\CleanServer;
use think\Log;

/**
 * 各种任务入口在此定义
 * @package app\scheduler\controller
 */
class Jobs
{
    public $_lastResultMsg = '';
    public $_lastExceptionMsg = '';
    //数据库备份
    public function backupDB() {
        Log::notice('Jobs::backupDB');
        try {
            $backup = new BackupDB();
            $this->_lastResultMsg .= $backup->cleanUp();
            $this->_lastResultMsg .= '; ';
            $this->_lastResultMsg .= $backup->backup();
            return true;
        } catch (\Exception $e) {
            $this->_lastExceptionMsg = $e->getMessage();
            Log::error("backupDB exception: " . $e->getMessage());
            return false;
        }
    }
    //清理服务器，包括数据库过期数据，系统日志文件，应用日志文件
    public function cleanServer(){
        Log::notice('Jobs::cleanServer');
        try {
            $clean = new CleanServer();
            $this->_lastResultMsg = $clean->clean();
            return true;
        } catch (\Exception $e) {
            $this->_lastExceptionMsg = $e->getMessage();
            Log::error("cleanServer exception: " . $e->getMessage());
            return false;
        }
    }
}