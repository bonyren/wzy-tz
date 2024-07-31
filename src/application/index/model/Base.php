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

namespace app\index\model;
use think\Model;
use think\Db;
use think\Request;
use app\index\service\RequestContext;
use think\Log;
class Base extends Model
{
    const AUDIT_LOG_ADD_TYPE = 1;
    const AUDIT_LOG_UPDATE_TYPE = 2;
    const AUDIT_LOG_DELETE_TYPE = 3;
    public static $auditLogTypeDefs = [
        self::AUDIT_LOG_ADD_TYPE=>'添加',
        self::AUDIT_LOG_UPDATE_TYPE=>'修改',
        self::AUDIT_LOG_DELETE_TYPE=>'删除'
    ];
    public static $auditLogTypeHtmlDefs = [
        self::AUDIT_LOG_ADD_TYPE=>'<span class="badge badge-primary">添加</span>',
        self::AUDIT_LOG_UPDATE_TYPE=>'<span class="badge badge-secondary">修改</span>',
        self::AUDIT_LOG_DELETE_TYPE=>'<span class="badge badge-warning">删除</span>'
    ];
    const AUDIT_LOG_DESKTOP_DEVICE = 1;
    const AUDIT_LOG_MOBILE_DEVICE = 2;

    public static $auditLogDeviceHtmlDefs = [
        self::AUDIT_LOG_DESKTOP_DEVICE=>'<span class="fa fa-desktop"></span>',
        self::AUDIT_LOG_MOBILE_DEVICE=>'<span class="fa fa-mobile"></span>'
    ];

    protected function initialize(){
        parent::initialize();
    }
    protected static function init(){
        $model = static::class;
        if(!isset($model::$audit_fields)){
            return;
        }
        if (empty($model::$audit_fields)) {
            return;
        }
        $model::event('after_insert', function($row) use ($model){
            $pk = $row->getPk();
            $changed_by = (int)RequestContext::I()->loginUserId;

            $addedFields = [];
            $addChanges = [];
            foreach ($model::$audit_fields as $field=>$fieldName){
                if (isset($row->data[$field])){
                    $addedFields[] = $field;
                    if(isset($model::$audit_field_translates) && isset($model::$audit_field_translates[$field]) &&  $model::$audit_field_translates[$field]){
                        $funcName = $model::$audit_field_translates[$field];
                        $addChanges[$fieldName] = $model::$funcName($row->data[$field]);
                    }else {
                        $addChanges[$fieldName] = $row->data[$field];
                    }
                }
            }
            if($addedFields){
                $desc = '';
                $desc .= "新增：";
                $desc .= json_encode($addChanges, JSON_UNESCAPED_UNICODE);
                Db::table('audit_logs')->insert([
                    'model'=>$row->name,
                    'record_id'=>isset($model::$audit_record_id_field)?$row->data[$model::$audit_record_id_field]:$row->data[$pk],
                    'fields'=>'|' . implode('|', $addedFields) . '|',
                    'ip'=>Request::instance()->ip(),
                    'desc'=>$desc,
                    'type'=>self::AUDIT_LOG_ADD_TYPE,
                    'device'=>Request::instance()->isMobile()?self::AUDIT_LOG_MOBILE_DEVICE:self::AUDIT_LOG_DESKTOP_DEVICE,
                    'changed_by'=>$changed_by
                ]);
            }
        });
        $model::event('before_update',function($row) use ($model){
            $pk = $row->getPk();
            $fields = array_keys($model::$audit_fields);
            $fields[] = $pk; //必须获取主键值
            if(isset($model::$audit_record_id_field) && !in_array($model::$audit_record_id_field, $fields)){
                $fields[] = $model::$audit_record_id_field;
            }
            $old = $model::where($row->updateWhere)->field($fields)->find();
            if(empty($old)){
                return;
            }
            $changedFields = [];
            $beforeChanges = [];
            $afterChanges = [];

            $changed_by = (int)RequestContext::I()->loginUserId;
            foreach ($model::$audit_fields as $field=>$fieldName){
                if (isset($row->data[$field]) && $row->data[$field] != $old->data[$field]) {
                    $changedFields[] = $field;
                    if(isset($model::$audit_field_translates) && isset($model::$audit_field_translates[$field]) &&  $model::$audit_field_translates[$field]){
                        $funcName = $model::$audit_field_translates[$field];
                        $beforeChanges[$fieldName] = $model::$funcName($old->data[$field]);
                        $afterChanges[$fieldName] = $model::$funcName($row->data[$field]);
                    }else{
                        $beforeChanges[$fieldName] = $old->data[$field];
                        $afterChanges[$fieldName] = $row->data[$field];
                    }
                }
            }
            if ($changedFields) {
                $desc = '';
                $desc .= "更改前：";
                $desc .= json_encode($beforeChanges, JSON_UNESCAPED_UNICODE);
                $desc .= ";<br />更改后：";
                $desc .= json_encode($afterChanges, JSON_UNESCAPED_UNICODE);
                Db::table('audit_logs')->insert([
                    'model'=>$row->name,
                    'record_id'=>isset($model::$audit_record_id_field)?$old->data[$model::$audit_record_id_field]:$old->data[$pk],
                    'fields'=>'|' . implode('|', $changedFields) . '|',
                    'ip'=>Request::instance()->ip(),
                    'desc'=>$desc,
                    'type'=>self::AUDIT_LOG_UPDATE_TYPE,
                    'device'=>Request::instance()->isMobile()?self::AUDIT_LOG_MOBILE_DEVICE:self::AUDIT_LOG_DESKTOP_DEVICE,
                    'changed_by'=>$changed_by
                ]);
            }
        });
        $model::event('before_delete', function($row) use ($model){
            $pk = $row->getPk();
            $fields = array_keys($model::$audit_fields);
            $fields[] = $pk; //必须获取主键值
            $old = $model::where($pk, $row->data[$pk])->field($fields)->find();

            $deletedFields = [];
            $deletedChanges = [];
            foreach ($model::$audit_fields as $field=>$fieldName){
                if (isset($old->data[$field])){
                    $deletedFields[] = $field;
                    if(isset($model::$audit_field_translates) && isset($model::$audit_field_translates[$field]) &&  $model::$audit_field_translates[$field]){
                        $funcName = $model::$audit_field_translates[$field];
                        $deletedChanges[$fieldName] = $model::$funcName($old->data[$field]);
                    }else {
                        $deletedChanges[$fieldName] = $old->data[$field];
                    }
                }
            }
            $changed_by = (int)RequestContext::I()->loginUserId;
            if($deletedFields){
                $desc = '';
                $desc .= "删除：";
                $desc .= json_encode($deletedChanges, JSON_UNESCAPED_UNICODE);
                Db::table('audit_logs')->insert([
                    'model'=>$row->name,
                    'record_id'=>isset($model::$audit_record_id_field)?$row->data[$model::$audit_record_id_field]:$row->data[$pk],
                    'fields'=>'|' . implode('|', $deletedFields) . '|',
                    'ip'=>Request::instance()->ip(),
                    'desc'=>$desc,
                    'type'=>self::AUDIT_LOG_DELETE_TYPE,
                    'device'=>Request::instance()->isMobile()?self::AUDIT_LOG_MOBILE_DEVICE:self::AUDIT_LOG_DESKTOP_DEVICE,
                    'changed_by'=>$changed_by
                ]);
            }
        });
    }
}