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
use think\Log;
use think\Db;
use think\Debug;

class Authorize extends Base{

    protected function __construct(){
    }
    public function check($roleId, $menuId){
        $record = Db::table('admin_role_menu')->where(array('role_id'=>$roleId, 'menu_id'=>$menuId))->find();
        return $record?$record:false;
    }
    public function editRoleAuth($roleId, $data){
        $nodeIds = $data['nodeIds'];
        if(empty($nodeIds)){
            return;
        }
        $menuDatas = [];

        foreach ($nodeIds as $nodeId){
            $nodeIdArray = explode('_', $nodeId);
            if(count($nodeIdArray) != 2){
                continue;
            }
            $menuDatas[] = ['role_id'=>$roleId,
                'menu_id'=>$nodeIdArray[0],
                'type'=>$nodeIdArray[1]
            ];
        }
        if (empty($menuDatas)) {
            return;
        }
        Db::table('admin_role_menu')->where(array('role_id'=>$roleId))->delete();
        foreach($menuDatas as $menuData) {
            Db::table('admin_role_menu')->insert($menuData);
        }
        return;
    }
}