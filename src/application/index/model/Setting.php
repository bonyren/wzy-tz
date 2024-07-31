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
use think\Cache;
use think\Log;
class Setting extends Model{
    protected $tableName = 'setting';
    protected $pk        = 'key';
    public function getSetting($field = null){
        $items = Cache::get('system_setting'); //优先读取缓存
        if ($items) {
            if($field) {
                if (!isset($items[$field])) {
                    return null;
                }
                return $items[$field]['value'];
            }else{
                return $items;
            }
        }
        $items  = dict('', 'setting'); //获取当前配置选项列表
        $fields = array_keys($items);
        $where  = "`key` in('" . implode("','", $fields) . "')";
        $data   = $this->where($where)->column('key,value');    //从数据库中获取设置信息

        foreach ($items as $key => &$arr) {
            switch ($key){
                case 'LOGIN_ONLY_ONE':
                {
                    if(isset($data[$key])){
                        $data[$key] = $data[$key]?'yes':'no';
                    }
                }break;
            }
            //如果数据库不存在该设置项则从默认值中获取
            $arr['value'] = array_key_exists($key, $data) ? $data[$key] : $arr['default'];
            $arr['key'] = $key;
        }
        Cache::set('system_setting', $items); //写入缓存
        if($field){
            if(array_key_exists($field, $items)){
                return $items[$field]['value'];
            }else{
                return null;
            }
        }else{
            return $items;
        }
    }
    public function saveSetting($datas = array()){
        if(!$datas){
            return true;
        }
        $fields = dict('', 'setting');			//获取当前配置选项列表
        $settingField = array_keys($fields);
        $this->where("`key` not in('".implode("','", $settingField)."')")->delete();	//删除多余属性
        $where = "`key` in('".implode("','", $settingField)."')";
        $allowedKeys = $this->where($where)->column('key');	//从数据库中获取设置信息
        $result = false;
        foreach ($datas as $data){
            switch ($data['key']){
                case 'LOGIN_ONLY_ONE':
                    $data['value'] = $data['value'] == 'yes'?1:0;
            }
            if(in_array($data['key'], $allowedKeys)){
                $state = $this->where(array('key'=>$data['key']))->update($data);
            }else {
                $state = $this->isUpdate(false)->data($data)->save();
            }
            if($state) $result = true;
        }
        $this->clearCache();
        return $result;
    }
    //清除设置相关缓存
    public function clearCache(){
        Cache::rm('system_setting');
    }
}