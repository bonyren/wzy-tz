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

use app\index\model\Dropdowns;
use app\index\logic\Tag;
use think\Request;
use think\View as ThinkView;
use app\index\logic\Defs;
use think\Db;

class View
{
    const DEFAULT_SELECTOR_VALUE_FIELD = 'id';
    const DEFAULT_SELECTOR_LABEL_FIELD = 'name';

    /**
     * 选择器
     * @param $params
     * [
     *  name => 表单name,
     *  value => 表单默认值,
     *  value_field => 选择器弹窗中datagrid行数据中的字段，用于写入表单name中,
     *  label_field => 选择器弹窗中datagrid行数据中的字段，用于选择后展示预览,
     * ]
     * @return string
     * @throws \think\Exception
     */
    public static function selector(array $params=[])
    {
        if (!isset($params['value_field']) || empty($params['value_field'])) {
            $params['value_field'] = self::DEFAULT_SELECTOR_VALUE_FIELD;
        }
        if (!isset($params['label_field']) || empty($params['label_field'])) {
            $params['label_field'] = self::DEFAULT_SELECTOR_LABEL_FIELD;
        }
        $params['elem_id'] = uniqid();
        $params['data_rows'] = [];
        if (!empty($params['value']) && !empty($params['model'])) {
            if (is_array($params['value'])) {
                $value_arr = $params['value'];
                $params['value'] = join(',', $value_arr);
            } else {
                $value_arr = explode(',', $params['value']);
            }
            $where = isset($value_arr[1]) ? ['in',$value_arr] : $value_arr[0];
            $params['data_rows'] = db($params['model'])
                ->field([$params['value_field'],$params['label_field']])
                ->where([$params['value_field']=>$where])
                ->select();
        }
        $params['callback'] = isset($params['callback']) ?$params['callback']:'null';
        $params['btn_text'] = isset($params['btn_text']) ?$params['btn_text']:'选择';
        //avoid the missing parameters warning
        if(!isset($params['name'])){
            $params['name'] = '';
        }
        if(!isset($params['value'])){
            $params['value'] = '';
        }
        if(!isset($params['readonly'])){
            $params['readonly'] = false;
        }
        $view = ThinkView::instance();
        $html = $view->fetch('plugin' . DS . 'selector', $params);
        return $html;
    }

    public static function tagger($category,$entity_id=0,$module='',$params=[])
    {
        if (empty($module)) {
            $module = Request::instance()->controller();
        }
        $params['tags'] = [];
        $params['id'] = isset($params['id'])?$params['id']:strtolower($module) . '_tag_' . $category;
        $params['title'] = isset($params['title'])?$params['title']:Tag::CATEGORIES[$category]['name'];
        $params['url'] = url('index/tags/setTags') . '?' . http_build_query(['category'=>$category, 'entity_id'=>$entity_id]);
        if ($entity_id) {
            $params['tags'] = Tag::I()->getEntityTagsByCategory($entity_id,$category);
        }
        $params['value'] = empty($params['tags']) ? '' : join(',', array_keys($params['tags']));
        $view = ThinkView::instance();
        $html = $view->fetch('plugin' . DS . 'tagger', $params);
        return $html;
    }

    public static function showTags($category,$entity_id) {
        $params['tags'] = Tag::I()->getEntityTagsByCategory($entity_id,$category);
        return ThinkView::instance()->fetch('index@plugin/tagger_view', $params);
    }

    public static function dropdown($field,$options){
        return ThinkView::instance()->fetch( 'index@plugin/dropdown', [
            'items' => Dropdowns::getItems($field),
            'options' => $options,
        ]);
    }

    public static function auditLogs($model,$record_id,$field=''){
        $url = url('index/AuditLogs/view',[
            'model'=>$model,
            'record_id'=>$record_id,
            'field'=>$field,
        ]);
        return ThinkView::instance()->fetch('plugin/view_audit_logs', [
            'url' => $url,
        ]);
    }
    public static function workStatus(array $params=[], $readOnly=0){
        $params['uniqid'] = uniqid();
        $params['readOnly'] = $readOnly;
        return ThinkView::instance()->fetch('components/work_status', $params);
    }
    public static function partner($inputName, $type=Defs::PARTNER_ALL_TYPE, $pId=0){
        $params = [
            'inputName'=>$inputName,
            'uniqid'=>generateUniqid(),
            'pId'=>$pId,
            'partnerType'=>$type,
            'partnerName'=>''
        ];
        if ($pId) {
            $partnerInfos = Db::table('partners')->where('p_id', $pId)->field(true)->find();
            if($partnerInfos){
                $params['partnerName'] = $partnerInfos['name'];
            }else{
                $params['pId'] = 0;
            }
        }
        $html = ThinkView::instance()->fetch('plugin/partner', $params);
        return $html;
    }

}