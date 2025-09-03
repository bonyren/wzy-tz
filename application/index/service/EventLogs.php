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
use app\index\logic\Defs;
use app\index\logic\Upload;
use think\Db;
use think\View as ThinkView;

class EventLogs extends Base
{
    public static function record($entity_type,$entity_id,$content,$json=[])
    {
        if (false === strpos($content,'<ENTITY>')) {
            $def = Defs::$entityTypes[$entity_type];
            $name = Db::table($def['model'])->where($def['pk'],$entity_id)->value('name');
            $content = "<ENTITY>{$name}</ENTITY>" . $content;
        }
        Db::table('event_logs')->insert([
            'entity_type' => $entity_type,
            'entity_id' => $entity_id,
            'content' => $content,
            'json' => empty($json) ? '' : json_encode($json, JSON_UNESCAPED_UNICODE),
            'uid' => session('userid'),
            'realname' => session('realname'),
        ]);
    }
    public static function show(&$logs)
    {
        foreach ($logs as $k=>$log) {
            $def = Defs::$entityTypes[$log['entity_type']];
            $content = "【{$def['name']}】" . $log['content'];
            if (!empty($content)) {
                $url = url($def['show']['url'],[$def['show']['param']=>$log['entity_id']]);
                $click = "QT.helper.view({url:'{$url}',width:'100%',height:'100%',dialog:'show-entity'})";
                $pattern = '/<ENTITY>(.*?)<\/ENTITY>/';
                $replace = '<a href="javascript:void(0)" onclick="'.$click.'">${1}</a>';
                $content = preg_replace($pattern, $replace, $content);
            }
            $json = empty($log['json']) ? [] : json_decode($log['json'],true);
            if ($json['file_id']) {
                $pattern = '/<FILE>(.*?)<\/FILE>/';
                $replace = ' ['.Upload::$attachTypeDefs[$json['file_type']]['label'].'] <a href="javascript:void(0)" onclick="QT.filePreview('.$json['file_id'].')"><<${1}>></a>';
                $content = preg_replace($pattern, $replace, $content);
            } elseif ($json['tag_id']) {
                $rows = Db::table('tags')->where(['id'=>['in',$json['tag_id']]])
                    ->field('category,name')->order('id asc')->select();
                if ($rows) {
                    $tags = [];
                    foreach ($rows as $v) {
                        $tags[$v['category']][] = $v['name'];
                    }
                    $content .= ThinkView::instance()->fetch('index@event_log/tag_show', ['tags'=>$tags]);
                }
            }
            $logs[$k]['content'] = $content;
        }
    }
    /***********************************************************************************************/
    public static function recordUpload($entity_type,$entity_id, $file_id, $file_type, $file_name){
        $text = sprintf('上传%s <a href="javascript:void(0)" onclick="QT.filePreview(%u)">%s</a>',
            Upload::$attachTypeDefs[$file_type]['label'],
            $file_id,
            $file_name
        );
        self::persist($entity_type, $entity_id, $text);
    }
    public static function recordProject($entity_id, $text){
        //to be done
        self::persist(Defs::ENTITY_PROJECT, $entity_id, $text);
    }
    public static function recordFund($entity_id, $text){
        //to be done
        self::persist(Defs::ENTITY_FUND, $entity_id, $text);
    }
    public static function persist($entity_type,$entity_id,$text){
        if (empty($entity_type)) {
            return;
        }
        $existLog = Db::table('event_logs')->where([
            'entity_type' => $entity_type,
            'entity_id' => $entity_id,
            'uid' => session('userid'),
            //'timestampdiff(minute, ctime, now())'=> ['<=', 5]
        ])->where('timestampdiff(minute, ctime, now())<=5')->order('ctime desc')->field(true)->find();
        if($existLog){
            //update
            Db::table('event_logs')->where([
                'entity_type' => $entity_type,
                'entity_id' => $entity_id,
                'uid' => session('userid')
            ])->update([
                'text'=>$existLog['text'] . '<br />' . $text
            ]);
        }else {
            Db::table('event_logs')->insert([
                'entity_type' => $entity_type,
                'entity_id' => $entity_id,
                'content' => '',
                'json' => '',
                'text'=>$text,
                'uid' => session('userid')?:0,
                'realname' => session('realname')?:'',
            ]);
        }
    }
    public static function showLogs(&$logs){
        foreach ($logs as &$log) {
            $log['content'] = '';
            $def = Defs::$entityTypes[$log['entity_type']];
            $entityTypeName = '';
            if(isset($def['name'])){
                $entityTypeName = $def['name'];
            }else{
                continue;
            }
            if(!tableExists($def['model'])){
                continue;
            }
            $entityName = Db::table($def['model'])->where($def['pk'],$log['entity_id'])->value('name');
            if(!$entityName){
                $entityName = '';
            }
            $url = url($def['show']['url'],[$def['show']['param']=>$log['entity_id']]);
            $click = "QT.helper.view({url:'{$url}',width:'100%',height:'100%',dialog:'show-entity'})";
            $log['content'] = sprintf('%s-<a href="javascript:void(0)" onclick="%s">%s</a><br />%s', $entityTypeName, $click, $entityName, $log['text']);
        }
    }
}