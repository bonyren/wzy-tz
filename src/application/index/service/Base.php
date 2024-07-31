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


class Base{
    protected function __construct(){
    }
    protected static $_instances = [];
    /**
     * @return static
     */
    public static function I() {
        $called_class = get_called_class();
        if (!isset(self::$_instances[$called_class])) {
            self::$_instances[$called_class] = new $called_class();
        }
        return self::$_instances[$called_class];
    }
}