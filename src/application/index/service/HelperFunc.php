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
namespace app\index\service;
use think\Request;
use think\Log;
use think\Debug;

class HelperFunc{
    public static function hostName(){
        $hostName = request()->server('HTTP_HOST');
        return $hostName;
    }
    public static function siteUrlRoot(){
        $hostName = HelperFunc::hostName();
        $urlPrefix = SCHEMA . '://' . $hostName;
        return $urlPrefix;
    }
}