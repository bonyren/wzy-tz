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
use think\Controller;
use think\Log;
use think\Debug;
use think\Request;
use app\index\logic\Defs;

class ChangeLogs extends Common
{
    public function index($externalId,
                          $category = \app\index\logic\ChangeLogs::CHANGE_LOG_ALL_CATEGORY,
                          $readOnly=0,
                          $search=[],
                          $page=1,
                          $rows=DEFAULT_PAGE_ROWS,
                          $sort='id',
                          $order='desc'){
        if(request()->isGet()) {
            $urlHrefs = [
                'index'=>url('index/ChangeLogs/index', ['externalId'=>$externalId, 'category'=>$category]),
                'add'=>url('index/ChangeLogs/add', ['externalId'=>$externalId, 'category'=>$category]),
                'edit'=>url('index/ChangeLogs/edit'),
                'delete'=>url('index/ChangeLogs/delete'),
                'attachments'=>url('index/Upload/viewAttaches', ['attachmentType'=>\app\index\logic\Upload::ATTACH_FUND_CHANGE_LOGS,
                    'uiStyle'=>\app\index\controller\Upload::ATTACHES_UI_DATAGRID_STYLE])
            ];
            $this->assign('urlHrefs', $urlHrefs);
            $this->assign('readOnly', $readOnly);
            $this->assign('type', \app\index\logic\ChangeLogs::$changeLogCategoryTypeDefs[$category]);
            $this->assign('title', \app\index\logic\ChangeLogs::$changeLogCategoryDefs[$category]);
            $this->assign('uniqid', generateUniqid());
            return $this->fetch();
        }
        $changeLogsLogic = \app\index\logic\ChangeLogs::newObj();
        return json($changeLogsLogic->load($externalId, $category, $search, $page, $rows, $sort, $order));
    }
    public function add($externalId, $category){
        if(request()->isGet()) {
            $urlHrefs = [
                'attachments'=>url('index/Upload/attaches', ['attachmentType'=>\app\index\logic\Upload::ATTACH_FUND_CHANGE_LOGS,
                    'externalId'=>0,
                    'uiStyle'=>\app\index\controller\Upload::ATTACHES_UI_DATAGRID_STYLE,
                    'callback'=>'changeLogsAddModule.onAttachmentsUploaded'
                ])
            ];
            $this->assign('urlHrefs', $urlHrefs);
            $this->assign('type', \app\index\logic\ChangeLogs::$changeLogCategoryTypeDefs[$category]);
            $this->assign('uniqid', generateUniqid());
            return $this->fetch();
        }
        $infos = input('post.infos/a');
        $changeLogsLogic = \app\index\logic\ChangeLogs::newObj();
        $result = $changeLogsLogic->add($externalId, $category, $infos);
        if($result){
            return ajaxSuccess('成功');
        }else{
            return ajaxError('失败');
        }
    }
    public function edit($id){
        $changeLogsLogic = \app\index\logic\ChangeLogs::newObj();
        if(request()->isGet()) {
            $urlHrefs = [
                'attachments'=>url('index/Upload/attaches', ['attachmentType'=>\app\index\logic\Upload::ATTACH_FUND_CHANGE_LOGS,
                    'externalId'=>$id,
                    'uiStyle'=>\app\index\controller\Upload::ATTACHES_UI_DATAGRID_STYLE,
                ])
            ];
            $this->assign('urlHrefs', $urlHrefs);
            $infos = $changeLogsLogic->getInfos($id);
            if(!$infos){
                return $this->fetch('common/error');
            }
            $bindValues =[
                'infos'=>$infos
            ];
            $this->assign('bindValues', $bindValues);
            $this->assign('type', \app\index\logic\ChangeLogs::$changeLogCategoryTypeDefs[$infos['category']]);
            $this->assign('uniqid', generateUniqid());
            return $this->fetch();
        }
        $infos = input('post.infos/a');
        $result = $changeLogsLogic->edit($id, $infos);
        if($result){
            return ajaxSuccess('成功');
        }else{
            return ajaxError('失败');
        }
    }
    public function delete($id){
        $changeLogsLogic = \app\index\logic\ChangeLogs::newObj();
        $result = $changeLogsLogic->delete($id);
        if($result){
            return ajaxSuccess('成功');
        }else{
            return ajaxError('失败');
        }
    }
}