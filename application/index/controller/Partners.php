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

class Partners extends Common
{
    public function partners($type=Defs::PARTNER_ALL_TYPE, $status=Defs::PARTNER_ALL_STATUS, $search=[],$page=1,$rows=DEFAULT_PAGE_ROWS,$sort='p_id',$order='desc'){
        if(request()->isGet()){
            $urlHrefs = [
                'partners'=>url('index/Partners/partners', ['type'=>$type, 'status'=>$status]),
                'add'=>url('index/Partners/add', ['type'=>$type, 'status'=>$status]),
                'edit'=>url('index/Partners/edit'),
                'delete'=>url('index/Partners/delete'),
                'view'=>url('index/Partners/view'),
                'password'=>url('index/Partners/password'),
                'partnersProgress'=>url('index/ProgressLogs/index', ['category'=>\app\index\logic\ProgressLogs::PROGRESS_LOG_PARTNER_CATEGORY])
            ];
            $this->assign('urlHrefs', $urlHrefs);
            return $this->fetch();
        }
        $partnersLogic = \app\index\logic\Partners::newObj();
        return json($partnersLogic->load($type, $status, $search, $page, $rows, $sort, $order));
    }
    public function choosePartner($type=Defs::PARTNER_ALL_TYPE, $search=[]){
        if(request()->isGet()){
            $urlHrefs = [
                'choosePartner'=>url('index/Partners/choosePartner', ['type'=>$type])
            ];
            $this->assign('urlHrefs', $urlHrefs);
            return $this->fetch();
        }
        $partnersLogic = \app\index\logic\Partners::newObj();
        return json($partnersLogic->loadAll($type, $search));
    }
    public function add($type, $status=Defs::PARTNER_PENDING_STATUS){
        if(request()->isGet()){
            $urlHrefs = [
            ];
            $this->assign('urlHrefs', $urlHrefs);
            $this->assign('status', $status);
            return $this->fetch();
        }
        $infos = input('post.infos/a');
        $partnersLogic = \app\index\logic\Partners::newObj();
        $result = $partnersLogic->add($type, $infos);
        if($result){
            return ajaxSuccess('成功');
        }else{
            return ajaxError('失败');
        }
    }
    public function edit($pId){
        $partnersLogic = \app\index\logic\Partners::newObj();
        if(request()->isGet()){
            $infos = $partnersLogic->getInfos($pId);
            if(!$infos){
                return $this->fetch('common/error');
            }
            $bindValues = [
                'infos'=>$infos
            ];
            $this->assign('bindValues', $bindValues);

            $urlHrefs = [
                'attachments'=>url('index/Partners/attachments', ['pId'=>$pId])
            ];
            $this->assign('urlHrefs', $urlHrefs);
            return $this->fetch();
        }
        $infos = input('post.infos/a');
        $result = $partnersLogic->edit($pId, $infos);
        if($result){
            return ajaxSuccess('成功');
        }else{
            return ajaxError('失败');
        }
    }
    public function delete($pId){
        $partnersLogic = \app\index\logic\Partners::newObj();
        $result = $partnersLogic->delete($pId);
        if($result){
            return ajaxSuccess('成功');
        }else{
            return ajaxError('失败');
        }
    }
    public function view($pId){
        $partnersLogic = \app\index\logic\Partners::newObj();
        if(request()->isGet()){
            $infos = $partnersLogic->getInfos($pId);
            if(!$infos){
                return $this->fetch('common/error');
            }
            $bindValues = [
                'infos'=>$infos
            ];
            $this->assign('bindValues', $bindValues);

            $urlHrefs = [
                'attachments'=>url('index/Partners/attachments', ['pId'=>$pId, 'readOnly'=>1]),
                'funds'=>url('index/Partners/funds', ['pId'=>$pId]),
                'dividends'=>url('index/Partners/dividends', ['pId'=>$pId])
            ];
            $this->assign('urlHrefs', $urlHrefs);
            return $this->fetch();
        }
    }
    public function password($pId){
        $partnersLogic = \app\index\logic\Partners::newObj();
        if(request()->isGet()){
            $infos = $partnersLogic->getInfos($pId);
            if(!$infos){
                return $this->fetch('common/error');
            }
            $bindValues = [
                'infos'=>$infos
            ];
            $this->assign('bindValues', $bindValues);
            return $this->fetch();
        }
        $infos = input('post.infos/a');
        try {
            $partnersLogic->password($pId, $infos);
        } catch (\Exception $e) {
            return ajaxError($e->getMessage());
        }
        return ajaxSuccess('成功');
    }
    public function attachments($pId, $readOnly=0){
        if($readOnly) {
            $attachesUrl = url('index/Upload/viewAttaches', ['attachmentType'=>\app\index\logic\Upload::ATTACH_PARTNER,
                'externalId'=>$pId,
                'uiStyle'=>\app\index\controller\Upload::ATTACHES_UI_DATAGRID_STYLE]);
        }else{
            $attachesUrl = url('index/Upload/attaches', ['attachmentType'=>\app\index\logic\Upload::ATTACH_PARTNER,
                'externalId'=>$pId,
                'uiStyle'=>\app\index\controller\Upload::ATTACHES_UI_DATAGRID_STYLE]);
        }
        $urlHrefs = [
            'attachments'=>$attachesUrl
        ];
        $this->assign('urlHrefs', $urlHrefs);
        return $this->fetch();
    }
    public function funds($pId){
        if(request()->isGet()){
            $urlHrefs = [
                'funds'=>url('index/Partners/funds', ['pId'=>$pId]),
                'fundEnterprises'=>url('index/Funds/fundsInvestProjects')
            ];
            $this->assign('urlHrefs', $urlHrefs);
            return $this->fetch();
        }
        $partnersLogic = \app\index\logic\Partners::newObj();
        return json($partnersLogic->loadFunds($pId));
    }
    public function dividends($pId){
        if(request()->isGet()){
            return $this->fetch();
        }
    }
}