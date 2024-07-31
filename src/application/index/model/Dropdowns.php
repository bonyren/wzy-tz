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
class Dropdowns extends Model{
    public function setItemsAttr($value){
        if (!empty($value) && is_array($value)) {
            $items = [];
            foreach ($value as $k=>$v) {
                if ($v['value'] !== '' && $v['label'] !== '') {
                    $items[$v['value']] = $v;
                }
            }
            $value = empty($items) ? '' : json_encode(array_values($items),JSON_UNESCAPED_UNICODE);
        }
        return $value;
    }

    public function getItemsAttr($value){
        if (empty($value)) {
            $value = [];
        } else {
            $value = json_decode($value,true);
        }
        return $value;
    }

    //-----------------------logic-----------------------------------
    public static function getItems($field,$index=false){
        $row = self::get(['field'=>$field]);
        if (empty($row) || empty($row->items)) {
            $items = [];
        } else {
            $items = $row->items;
            if ($index) {
                $data = [];
                foreach ($items as $v) {
                    $data[$v['value']] = $v['label'];
                }
                $items = $data;
            }
        }
        return $items;
    }

    public static function getLabel($field,$value){
        $items = self::getItems($field);
        $label = '';
        foreach ($items as $v) {
            if ($v['value'] == $value) {
                $label = $v['label'];
                break;
            }
        }
        return $label;
    }

    public function saveDropdown($id,$data){
        if ($id) {
            $this->save($data,['id'=>$id]);
        } else {
            $row = self::get(['field'=>$data['field']]);
            if ($row) {
                exception('字段重复');
            }
            $this->save($data);
        }
    }
}