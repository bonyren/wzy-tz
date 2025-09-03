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
use app\index\logic\Enterprise;
use think\Controller;
use think\Log;
use think\Debug;
use think\Request;
use think\Db;
use app\index\logic\Defs;
use app\index\logic\Scientists as ScientistsLogic;
use app\index\logic\ProgressLogs as ProgressLogsLogic;
use app\index\logic\Admins as AdminsLogic;

class Scientists extends Common
{
    public function index($search=[],$page=1,$rows=DEFAULT_PAGE_ROWS,$sort='',$order=''){
        if(request()->isGet()){
            return $this->fetch();
        }
        $data = ScientistsLogic::I()->load($search, $page, $rows, $sort, $order);
        if (!empty($data['rows'])) {
            $users = AdminsLogic::I()->getAllUsers();
            foreach ($data['rows'] as $k=>$v) {
                $data['rows'][$k]['assigner'] = $v['assigner']?$users[$v['assigner']]['realname']:'';
            }
        }
        return json($data);
    }
    public function save($id=0){
        $logic = ScientistsLogic::I();
        if($this->request->isGet()){
            if($id){
                $infos = $logic->get($id);
                if(!$infos){
                    return $this->fetch('common/error');
                }
            }else{
                $infos = $logic->getDefault();
            }
            $this->assign('infos', $infos);
            $this->assign('id', $id);
            $this->assign('urlHrefs', [
                'projects'=>url('index/Scientists/projects', ['scientist_id'=>$id]),
                'requirements'=>url('index/Scientists/requirements', ['scientistId'=>$id]),
                'events'=>url('index/ProgressLogs/light', ['category'=>ProgressLogsLogic::PROGRESS_LOG_SCIENTIST_CATEGORY, 'externalId'=>$id])
            ]);
            return $this->fetch();
        }
        $infos = input('post.infos/a');
        try{
            $logic->save($id, $infos);
            return ajaxSuccess('成功');
        }catch (\Exception $e){
            return ajaxError('失败, message: ' . $e->getMessage());
        }
    }
    public function delete($id=0){
        $logic = ScientistsLogic::I();
        try{
            $logic->delete($id);
            return ajaxSuccess('成功');
        }catch (\Exception $e){
            return ajaxError('失败, message: ' . $e->getMessage());
        }
    }
    public function view($id){
        $logic = ScientistsLogic::I();
        $infos = $logic->get($id);
        if(!$infos){
            return $this->fetch('common/error');
        }
        $this->assign('infos', $infos);
        $this->assign('urlHrefs', [
            'projects'=>url('index/Scientists/projects', ['scientist_id'=>$id, 'readOnly'=>1]),
            'requirements'=>url('index/Scientists/requirements', ['scientistId'=>$id, 'readOnly'=>1]),
            'events'=>url('index/ProgressLogs/light', ['category'=>ProgressLogsLogic::PROGRESS_LOG_SCIENTIST_CATEGORY, 'externalId'=>$id, 'readOnly'=>1])
        ]);
        return $this->fetch();
    }

    /**
     * 核心需求
     */
    public function requirements($scientistId, $readOnly=0){
        if(request()->isGet()){
            $this->assign('urlHrefs', [
                'index'=>url('index/Scientists/requirements', ['scientistId'=>$scientistId]),
                'save'=>url('index/Scientists/requirementSave', ['scientistId'=>$scientistId])
            ]);
            $this->assign('readOnly', $readOnly);
            return $this->fetch();
        }
        if(empty($scientistId)){
            return json([]);
        }
        $rows = Db::table('scientist_requirements')->where('scientist_id', $scientistId)->field(true)->select();
        return json($rows);
    }
    public function requirementSave($scientistId, $id=0){
        $infos = input('post.infos/a');
        if($id){
            Db::table('scientist_requirements')->where('id', $id)->update([
                'content'=>$infos['content']
            ]);
        }else{
            Db::table('scientist_requirements')->insert(['scientist_id'=>$scientistId, 'content'=>$infos['content']]);
        }
        return ajaxSuccess('成功');
    }
    public function requirementDelete($id){
        Db::table('scientist_requirements')->where('id', $id)->delete();
        return ajaxSuccess('成功');
    }

    //关联项目列表
    public function projects($scientist_id, $readOnly=0, $page=1, $rows=DEFAULT_PAGE_ROWS)
    {
        if($this->request->isGet()) {
            $this->assign('scientist_id',$scientist_id);
            $this->assign('readOnly', $readOnly);
            return $this->fetch();
        }
        $sou['scientist_id'] = $scientist_id;
        $data = Enterprise::I()->load($sou,$page,$rows);
        return json($data);
    }

    //添加关联项目
    public function projectsAdd($scientist_id, $enterprise_id)
    {
        Db::table('enterprises')->where('id','in',$enterprise_id)->setField('scientist_id',$scientist_id);
        return ajaxSuccess('操作成功');
    }
}