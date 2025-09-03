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
use think\Db;
use app\common\CommonDefs;
use app\index\service\RequestContext;
use think\Request;

function checkMenuPriv($menuModule, $menuController, $menuAction){
    if(RequestContext::I()->loginSuperUser){
        return CommonDefs::AUTHORIZE_READ_WRITE_TYPE;
    }
    if(!Request::instance()->isGet()){
        return CommonDefs::AUTHORIZE_READ_WRITE_TYPE;
    }
    //如果通过params的不同来区分menu的话，会导致menuId不准确
    $menuIds = Db::table('menu')->where(['m'=>$menuModule, 'c'=>$menuController, 'a'=>$menuAction])->column('id');
    if(empty($menuIds)){
        //没有定义,默认可写
        return CommonDefs::AUTHORIZE_READ_WRITE_TYPE;
    }
    //随机选择一个作为menu priv
    $authorizeType = Db::table('admin_role_menu')->where(['menu_id'=>['in', $menuIds], 'role_id'=>RequestContext::I()->loginUserRoleId])->value('type');
    if($authorizeType === null){
        return CommonDefs::AUTHORIZE_FORBIDDEN_TYPE;
    }
    return intval($authorizeType);
}