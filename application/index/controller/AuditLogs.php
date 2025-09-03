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
namespace app\index\controller;
use app\index\service\View;
use think\Db;
use think\Log;

class AuditLogs extends Common{
    public function index($models='',
                          $recordId='',
                          $field='',
                          $search=[],
                          $page=1,
                          $rows=DEFAULT_PAGE_ROWS,
                          $sort='id',
                          $order='desc'
    ){
        if(request()->isGet()){
            $urlHrefs = [
                'index'=>url('index/AuditLogs/index',[
                    'models'=>$models,
                    'recordId'=>$recordId,
                    'field'=>$field
                ]),
            ];
            $this->assign('urlHrefs', $urlHrefs);
            return $this->fetch();
        }
        $limit = ($page - 1) * $rows . "," . $rows;
        if($sort == 'id'){
            $order = 'id ' . $order;
        }else{
            $order = 'id desc';
        }
        $conditions = [];
        if($models){
            $conditions['model'] = ['in', explode('_', $models)];
        }
        if($recordId){
            $conditions['record_id'] = $recordId;
        }
        if($field){
            $conditions['fields'] = ['like', '%|' . $field . '|%'];
        }
        $totalCount = Db::table('audit_logs')->where($conditions)->count();
        $records = Db::table('audit_logs')->alias('L')->join('admins A', 'L.changed_by=A.admin_id', 'LEFT')->where($conditions)
            ->limit($limit)->order($order)->field('L.*, A.realname')->select();
        return json([
            'total'=>$totalCount,
            'rows'=>$records
        ]);
    }
    public function view($model,$record_id,$field=''){
        View::auditLogs('test','20','*');
        $where = [
            'l.model' => $model,
            'l.record_id' => $record_id,
        ];
        if($field){
            $where['l.fields'] = ['like', '%|' . $field . '|%'];;
        }
        $rows = db('audit_logs')->alias('l')
            ->join('admins a','a.admin_id=l.changed_by')
            ->field('l.*,a.realname')->where($where)->order('l.id desc')->select();
        if(empty($rows)){
            $rows = [];
        }
        return $this->fetch('',['rows'=>$rows]);
    }
}