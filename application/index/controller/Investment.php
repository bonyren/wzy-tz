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

use app\index\logic\Extra;
use app\index\logic\Meeting;
use app\index\model\Dropdowns;
use think\Db;
use app\index\logic\Enterprise as EnterpriseLogic;
use app\index\logic\Defs as IndexDefs;

class Investment extends Common{
    public function invested($enterprise_id,$readonly=1){
        $rows = Db::table('investment')->field('id,financing_stage')
            ->where(['enterprise_id'=>$enterprise_id])
            ->order('id desc')->select();
        if (empty($rows)) {
            $rows = [];
        } else {
            $stages = Dropdowns::getItems('financing_stage',true);
            $rows = array_map(function($v)use($stages){
                $v['title'] = $v['financing_stage'] ? $stages[$v['financing_stage']] : '未指定轮次';
                return $v;
            },$rows);
        }
        $this->assign('rows',$rows);
        $this->assign('readonly',$readonly);
        $this->assign('enterprise_id',$enterprise_id);
        return $this->fetch();
    }

    public function getPendingRow($enterprise_id){
        $id = Db::table('investment')
            ->where(['enterprise_id'=>$enterprise_id, 'status'=>IndexDefs::INVESTMENT_PENDING_STATUS])
            ->order('id desc')->value('id');
        return intval($id);
    }

    //新增投资
    public function add($enterprise_id=0,$id=0){
        if ($this->request->isGet()) {
            return $this->fetch();
        }
        $data = input('post.data/a');
        //董事
        if(!isset($data['director'])){
            $data['director'] = '';
        }
        if (empty($id)) {
            $e = Db::table('enterprises')->field('step,step_state')->where('id',$enterprise_id)->find();
            if ($e['step'] == EnterpriseLogic::STEP_INVESTING) {
                $meeting_id = Db::table('meetings')->where(['type'=>Meeting::MEETING_INVEST_DECISION_TYPE,
                    'relate_id'=>$enterprise_id,
                    'investment_id'=>0]
                )->order('id DESC')->value('id');
                if ($meeting_id) {
                    $data['meeting_id'] = $meeting_id; //关联投决会ID
                }
            }
            $data['status'] = IndexDefs::INVESTMENT_PENDING_STATUS;//未完成
            $data['enterprise_id'] = $enterprise_id;
            $id = Db::table('investment')->insertGetId($data);
            if ($data['meeting_id']) {
                Db::table('meetings')->where(['id'=>$data['meeting_id']])->setField('investment_id',$id);
            }
        } else {
            Db::table('investment')->where('id',$id)->update($data);
        }
        $extra = input('post.extra/a'); //特殊条款等
        if ($extra) {
            Extra::I()->setValue('Investment',$id,$extra);
        }
        return ajaxSuccess('保存成功',$id);
    }

    public function remove($id){
        $row = Db::table('investment')->where('id',$id)->find();
        if (empty($row)) {
            return ajaxError('无法找到该投资交割');
        }
        Db::table('investment')->where('id',$id)->delete();
        if ($row['meeting_id']) {
            Db::table('meetings')->where(['id'=>$row['meeting_id']])->setField('investment_id',0);
        }
        //清理基金投资表和基金投资财务表
        $sql = <<<SQL
            delete fe,ffe from funds_enterprises fe inner join funds_finance_enterprises ffe on fe.`ffe_id`=ffe.`ffe_id` 
            where fe.`investment_id`=?
        SQL;
        Db::query($sql, [$id]);
        return ajaxSuccess('删除成功');
    }
    //投资交割
    public function delivery($id,$readonly=0){
        $row = Db::table('investment')->where('id',$id)->find();
        $this->assign('row',$row);
        $this->assign('users', \app\index\logic\Admins::I()->getAllUsers());
        $this->assign('enterprise_id',$row['enterprise_id']);
        $this->assign('readonly',$row['status'] < 0 ? 1 : intval($readonly));
        $this->assign('attaches',$readonly ? 'viewAttaches' : 'attaches');
        return $this->fetch();
    }
    //投资交割基本信息
    public function basic($id,$readonly=0){
        $row = Db::table('investment')->where('id',$id)->find();
        $row['extra_special_terms'] = array_merge(['rights'=>[], 'desc'=>''], Extra::I()->getValue('Investment',$id,'special_terms'));
        $this->assign('row',$row);
        $this->assign('users', \app\index\logic\Admins::I()->getAllUsers());
        $this->assign('enterprise_id',$row['enterprise_id']);
        $this->assign('readonly',intval($readonly));
        return $this->fetch();
    }
}