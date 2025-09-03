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
use app\index\service\Setting;

use think\Log;
/**
 * 数据库备份任务
 * @package app\scheduler\Jobs
 */
class BackupDB
{
    //mysqldump.exe
    public $mysql_dump = ROOT_PATH . 'bin' . DS . 'mysqldump.exe';
    //7z
    public $compressor = ROOT_PATH . 'bin' . DS . '7z.exe';
    //备份文件存储目录
    public $backup_path = ROOT_PATH . 'db' . DS . 'backup';
    //备份文件保留天数
    public $expiration = 30 * 86400;
    public $error = null;

    public function  __construct() {
        $config = [
            'DB_BACKUP_PATH'=>systemSetting('DB_BACKUP_PATH'),
            'DB_BACKUP_EXPIRATION'=>systemSetting('DB_BACKUP_EXPIRATION')
        ];
        if ($config['DB_BACKUP_PATH']) {
            $this->backup_path = $config['DB_BACKUP_PATH'];
        }
        if ($config['DB_BACKUP_EXPIRATION']) {
            $this->expiration = $config['DB_BACKUP_EXPIRATION']  * 86400;
        }
        $this->backup_path = rtrim($this->backup_path, '/\\');
        if (!file_exists($this->backup_path)) {
            mkdir($this->backup_path, 0775);
        }
        if (!file_exists($this->backup_path) || !is_writable($this->backup_path)) {
            exception('备份目录：'.$this->backup_path.'无法写入，请检查权限');
        }
    }

    /**
     * 清理过期备份文件
     */
    public function cleanUp()
    {
        $conf = config('database');
        //保持同样的文件命名规则
        $filenamePrefix = sprintf("%s#", $conf['database']);
        if (is_dir($this->backup_path) && file_exists($this->backup_path) && $handle = opendir($this->backup_path)) {
            $t_now = time();
            $unlinkCount = 0;
            while (false !== ($file = readdir($handle))) {
                if($file == "." || $file == ".."){
                    continue;
                }
                if(0 !== strpos($file, $filenamePrefix)){
                    continue;
                }
                $path_parts = pathinfo($file);
                $backupDate = explode('#', $path_parts['filename'])[1];
                if(empty($backupDate)){
                    continue;
                }
                if(false === strtotime($backupDate)){
                    continue;
                }
                $time = $t_now - strtotime($backupDate);
                if ($time >= $this->expiration) {
                    echo $file . '已过期: ' . floor($time / 86400) . "天\r\n";
                    unlink($this->backup_path . DS . $file);
                    $unlinkCount++;
                }
            }
            closedir($handle);
            return "清理备份文件{$unlinkCount}个";
        }else{
            exception("failed to find {$this->backup_path}");
        }
    }

    /**
     * 执行备份
     */
    public function backup()
    {
        //导出sql
        $conf = config('database');
        $filename = sprintf("%s#%s", $conf['database'], date("Ymd"));
        $file_sql = $this->backup_path . DS . $filename . '.sql';
        //$cmd = sprintf("\"{$this->mysql_dump}\" --skip-lock-tables -h%s -u%s -p%s %s > %s", $conf['hostname'], $conf['username'], $conf['password'], $conf['database'], $file_sql);
        $cmd = sprintf("mysqldump --skip-lock-tables -h%s -u%s -p%s %s > %s", $conf['hostname'], $conf['username'], $conf['password'], $conf['database'], $file_sql);
        $result = system($cmd);
        if($result === false){
            exception("failed to system {$cmd}");
        }
        //压缩sql
        $file_zip = $this->backup_path . DS . $filename . '.zip';
        //$cmd = "\"{$this->compressor}\" a {$file_zip} {$file_sql}";
        $cmd = "zip -r {$file_zip} {$file_sql}";
        $result = system($cmd);
        if($result === false){
            exception("failed to system {$cmd}");
        }
        unlink($file_sql);
        return "备份成功{$filename}";
    }
}