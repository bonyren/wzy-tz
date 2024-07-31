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
use think\Session;
use think\Db;
use think\Request;
use app\Defs;
function logEvent($entity_type,$entity_id,$content,$json=[]){
    \app\index\service\EventLogs::record($entity_type,$entity_id,$content,$json);
}
/**递归删除文件和目录
 * @param $dir
 */
function rrmdir($dir) {
    if (is_dir($dir)) {
        $objects = scandir($dir);
        foreach ($objects as $object) {
            if ($object != "." && $object != "..") {
                if (is_dir($dir. DS .$object) && !is_link($dir."/".$object))
                    rrmdir($dir. DS .$object);
                else
                    unlink($dir. DS .$object);
            }
        }
        rmdir($dir);
    }
}
function dict($key = '', $fileName = 'setting') {
    static $_dictFileCache  =   array();
    $file = APP_PATH . 'dict' . DS  . $fileName . '.php';
    if (!file_exists($file)){
        unset($_dictFileCache);
        return null;
    }
    if(!$key && !empty($_dictFileCache)) return $_dictFileCache;
    if ($key && isset($_dictFileCache[$key])) return $_dictFileCache[$key];
    $data = require_once $file;
    $_dictFileCache = $data;
    return $key ? $data[$key] : $data;
}
function systemSetting($field){
    $settingModel = new \app\index\model\Setting();
    $value = $settingModel->getSetting($field);
    return $value;
}
/*************************************************************************/
function convertUploadSaveName2FullUrl($saveName){
    $urlFilePath = str_replace(DS, '/' , $saveName);
    $url = UPLOAD_URL_ROOT . $urlFilePath;
    return $url;
}
function convertUploadSaveName2RelativeUrl($saveName){
    $urlFilePath = str_replace(DS, '/' , $saveName);
    $url = UPLOAD_FOLDER . '/' . $urlFilePath;
    return $url;
}
function convertUploadSaveName2AbsoluteUrl($saveName){
    $urlFilePath = str_replace(DS, '/' , $saveName);
    $url = SCRIPT_DIR . '/' . UPLOAD_FOLDER . '/' . $urlFilePath;
    return $url;
}
function convertUploadSaveName2DiskFullPath($saveName){
    $diskPath = UPLOAD_DIR . DS . $saveName;
    return $diskPath;
}
function convertUploadRelativeUrl2DiskFullPath($relativeUrl){
    $localRelativePath = str_replace('/', DS , $relativeUrl);
    return SITE_DIR . DIRECTORY_SEPARATOR . $localRelativePath;
}
function convertUploadSaveNameThumbnail2DiskFullPath($saveName){
    $thumbnailPath = UPLOAD_DIR . DS . 'thumbnails' . DS . basename($saveName);
    return $thumbnailPath;
}
/**
 * 生成上传文件的完整url
 * @param $url
 */
function generateUploadFullUrl($url){
    if(startsWith($url, SCHEMA)){
        return $url;
    }
    if(startsWith($url, '/')){
        return SITE_URL . $url;
    }
    return SITE_URL . '/' . $url;
}
/*************************************************************************/
function getUnzipFullPath(){
    return BIN_DIR . DIRECTORY_SEPARATOR . 'unzip.exe';
}
function getMysqldumpFullPath(){
    return BIN_DIR . DIRECTORY_SEPARATOR . 'mysqldump.exe';
}
/*************************************************************************/
function emptyInArray(&$arr, $key){
    if(!isset($arr[$key])){
        return true;
    }
    return empty($arr[$key]);
}
function emptyStringInArray(&$arr, $key){
    if(!isset($arr[$key])){
        return true;
    }
    return $arr[$key] === '';
}
/*************************************************************************/
function generateUniqid(){
    if(version_compare(PHP_VERSION, '7.0.0') >= 0) {
        $id = bin2hex(random_bytes(16));
    }else{
        $id = md5(uniqid());
    }
    return $id;
}
/**********************************************************************************************************************/
function createFormToken(){
    $token = generateUniqid();
    Session::set('form-token', $token);
    return $token;
}
function verifyFormToken($formToken){
    $token = Session::get('form-token');
    if($token && $token == $formToken){
        Session::set('form-token', '');
        return true;
    }else{
        return false;
    }
}
/****************************************************************************************/
function password($password, $encrypt='') {
    $pwd = array();
    $pwd['encrypt'] =  $encrypt ? $encrypt : \think\helper\Str::random(6);
    $pwd['password'] = md5(md5(trim($password)).$pwd['encrypt']);
    return $encrypt ? $pwd['password'] : $pwd;
}
function moneyFormat($input){
    return number_format($input, 2);
}

/**日期过滤
 * @param $input
 * @return string
 */
function dateFilter($input){
    if($input == Defs::DEFAULT_DB_DATE_VALUE){
        return '';
    }
    return $input;
}
function dateTimeFilter($input){
    if($input == Defs::DEFAULT_DB_DATETIME_VALUE){
        return '';
    }
    return $input;
}
function dateDbConverter($input){
    if(empty($input)){
        return Defs::DEFAULT_DB_DATE_VALUE;
    }
    return $input;
}
function dateTimeDbConverter($input){
    if(empty($input)){
        return Defs::DEFAULT_DB_DATETIME_VALUE;
    }
    return $input;
}
/****************************************************************************************/
function tableExists($table) {
    $sql = "SHOW TABLES LIKE '" . $table . "'";
    $info = Db::table($table)->query($sql);
    if (!empty($info)) {
        return true;
    } else {
        return false;
    }
}
function isWeixinVisit(){
    $userAgent = Request::instance()->header('user-agent');
    if (stripos($userAgent, 'MicroMessenger') !== false) {
        return true;
    } else {
        return false;
    }
}
function convertLineBreakToEscapeChars($str){
    return str_replace("'", "\'", str_replace("\n", "\\n", str_replace("\r\n", "\\r\\n", $str)));
}
function isSafari(){
    $userAgent = Request::instance()->header('user-agent');
    if(preg_match('/MSIE/i', $userAgent)) { 
        return false;
     }
     if(preg_match('/Firefox/i', $userAgent)) { 
        return false;
     }
     if(strpos( $userAgent, 'Chrome') !== false){
        return false;
     }
     if(preg_match('/Opera/i', $userAgent)) { 
        return false;
     }
     if(stripos($userAgent, 'MicroMessenger') !== false) {
        if(preg_match('/iPhone/i', $userAgent) || preg_match('/iPad/i', $userAgent)){
            return true;
        }else{
            return false;
        }
     } 
     if(strpos($userAgent, 'Safari') !== false){
        return true;
     }
     /**
      * iphone: Mozilla/5.0 (iPhone; CPU iPhone OS 13_3_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 MicroMessenger/8.0.9(0x18000931) NetType/4G Language/zh_CN
      * android: Mozilla/5.0 (Linux; Android 11; 21091116C Build/RP1A.200720.011; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/86.0.4240.99 XWEB/3225 MMWEBSDK/20220204 Mobile Safari/537.36 MMWEBID/9929 MicroMessenger/8.0.20.2100(0x28001455) Process/toolsmp WeChat/arm64 Weixin NetType/WIFI Language/zh_CN ABI/arm64
      */
     return false;
}