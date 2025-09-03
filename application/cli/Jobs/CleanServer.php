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
namespace app\cli\Jobs;
use think\Log;
use app\index\service\Setting;
use think\Db;
class CleanServer
{
    public function __construct(){}
    public function clean(){
        $this->cleanWeb();
        $this->cleanSystem();
        $this->cleanDb();
    }
    //清理web日志文件
    protected function cleanWeb(){
        $nowTime = time();
        //LOG_PATH，只保留30天的日志文件
        //1608233033-single.log
        $logPath = rtrim(LOG_PATH, '/\\');
        if (is_dir($logPath) && file_exists($logPath) && $handle = opendir($logPath)) {
            while (false !== ($file = readdir($handle))) {
                if ($file == "." || $file == "..") {
                    continue;
                }
                $filePath = $logPath . DS . $file;
                if(is_dir($filePath)){
                    continue;
                }
                //文件, 文件最后修改时间超出了30天，就删除
                $lastModTime = filemtime($filePath);
                if($nowTime > $lastModTime && ($nowTime-$lastModTime) > 30*24*3600 ){
                    Log::notice("清理日志文件: {$filePath}");
                    unlink($filePath);
                }
            }
            closedir($handle);
        }
        //TEMP_PATH,删除全部文件，视图模板重新生成
        $tmpPath = rtrim(TEMP_PATH, '/\\');
        if (is_dir($tmpPath) && file_exists($tmpPath) && $handle = opendir($tmpPath)) {
            while (false !== ($file = readdir($handle))) {
                if ($file == "." || $file == "..") {
                    continue;
                }
                $filePath = $tmpPath . DS . $file;
                if(is_dir($filePath)){
                    continue;
                }
                Log::notice("清理视图文件: {$filePath}");
                unlink($filePath);
            }
            closedir($handle);
        }
        //CACHE_PATH不处理
    }
    //系统日志文件
    protected function cleanSystem(){
        $nowTime = time();
        //apache日志文件,access.log,error.log
        //php日志文件,php_error_log
        //mysql日志文件,mysql_error.log
        $logPath = ROOT_PATH . '..' . DS . 'amp' . DS . 'logs';
        if (is_dir($logPath) && file_exists($logPath) && $handle = opendir($logPath)) {
            while (false !== ($file = readdir($handle))) {
                if ($file == "." || $file == "..") {
                    continue;
                }
                $filePath = $logPath . DS . $file;
                if(is_dir($filePath)){
                    continue;
                }
                //文件, 文件创建时间超出了30天，就删除
                $fileCreateTime = filectime($filePath);
                if($nowTime > $fileCreateTime && ($nowTime-$fileCreateTime) > 30*24*3600 ){
                    Log::notice("清理日志文件: {$filePath}");
                    unlink($filePath);
                }
            }
            closedir($handle);
        }
        //过期的php session文件, php上传临时文件，mysql临时文件
        $tmpPath = ROOT_PATH . '..' . DS . 'amp' . DS . 'tmp';
        if (is_dir($tmpPath) && file_exists($tmpPath) && $handle = opendir($tmpPath)) {
            while (false !== ($file = readdir($handle))) {
                if ($file == "." || $file == "..") {
                    continue;
                }
                $filePath = $tmpPath . DS . $file;
                if(is_dir($filePath)){
                    continue;
                }
                //文件, 文件最后修改时间超出了30天，就删除
                $lastModTime = filemtime($filePath);
                if($nowTime > $lastModTime && ($nowTime-$lastModTime) > 30*24*3600 ){
                    Log::notice("清理临时文件: {$filePath}");
                    unlink($filePath);
                }
            }
            closedir($handle);
        }
    }
    //数据库过期数据
    protected function cleanDb(){
        //管理员登录日志，暂时不必要清理
        //清理定时任务日志
        $today = date('Y-m-d');
        $beginDate = date('Y-m-d', strtotime($today . ' -1 day'));
        Db::table('job_queue')->whereTime('entered', '<', $beginDate)->delete();
        //清理消息中心messages
        $beginDate = date('Y-m-d', strtotime($today . ' -1 month'));
        Db::table('messages')->whereTime('entered', '<', $beginDate)->delete();
        //清理事件event_logs
        Db::table('event_logs')->whereTime('entered', '<', $beginDate)->delete();
        //清理审计audit_logs
        Db::table('audit_logs')->whereTime('entered', '<', $beginDate)->delete();
    }
}