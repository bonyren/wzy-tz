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
use app\index\logic\Funds as FundsLogic;
use app\common\service\WException;

class Funds extends Common
{
    public function funds($search=[],$page=1,$rows=DEFAULT_PAGE_ROWS,$sort='fund_id',$order='asc'){
        if(request()->isGet()){
            $urlHrefs = [
                'funds'=>url('index/Funds/funds'),
                'fundsSave'=>url('index/Funds/fundsSave'),
                'fundsEdit'=>url('index/Funds/fundsEdit'),
                'fundsDelete'=>url('index/Funds/fundsDelete'),
                'fundsProgress'=>url('index/ProgressLogs/index', ['category'=>\app\index\logic\ProgressLogs::PROGRESS_LOG_FUND_MANAGE_CATEGORY]),
                'fundsView'=>url('index/Funds/fundsView')
            ];
            $this->assign('urlHrefs', $urlHrefs);
            return $this->fetch();
        }
        $fundsLogic = \app\index\logic\Funds::newObj();
        return json($fundsLogic->load($search, $page, $rows, $sort, $order));
    }
    public function fundsSave($fundId=0, $readOnly=0){
        if(request()->isGet()){
            $urlHrefs = [
                'save'=>url('index/Funds/fundsSave', ['fundId'=>$fundId])
            ];
            $this->assign('urlHrefs', $urlHrefs);
            $formData = [];
            if($fundId){
                //编辑
                $fundsLogic = FundsLogic::newObj();
                $formData = $fundsLogic->getFundInfos($fundId);
                if(!$formData){
                    return $this->fetch('common/missing');
                }
            }
            $this->assign('fundId', $fundId);
            $this->assign('formData', $formData);
            $this->assign('readOnly', $readOnly);
            return $this->fetch();
        }
        $infos = input('post.infos/a');
        $fundsLogic = FundsLogic::newObj();
        try{
            if(empty($fundId)){
                $fundsLogic->addFund($infos);
            }else{
                $fundsLogic->editFund($fundId, $infos);
            }
            return ajaxSuccess();
        }catch(WException $e){
            return ajaxError($e->getMessage());
        }
    }
    public function fundsEdit($fundId, $status=\app\index\logic\Funds::FUND_ALL_STATUS){
        $fundsLogic = \app\index\logic\Funds::newObj();
        if(request()->isGet()){
            $infos = $fundsLogic->getFundInfos($fundId);
            if(!$infos){
                return $this->fetch('common/error');
            }
            $bindValues = [
                'statusFilter'=>$status
            ];
            $this->assign('bindValues', $bindValues);
            $urlHrefs = [
                'fundsSave'=>url('index/Funds/fundsSave', ['fundId'=>$fundId]),
                'fundsOverview'=>url('index/Funds/fundsOverview', ['fundId'=>$fundId]),
                'fundsProgressEvent'=>url('index/ProgressLogs/light', ['category'=>\app\index\logic\ProgressLogs::PROGRESS_LOG_FUND_MANAGE_CATEGORY, 'externalId'=>$fundId]),
                //募集
                'fundsCollect'=>url('index/FundsCollect/fundsCollect', ['fundId'=>$fundId]),
                //投资
                'fundsInvestProjects'=>url('index/Funds/fundsInvestProjects', ['fundId'=>$fundId]),
                //管理
                'fundsFinance'=>url('index/fundsFinance/fundsFinance', ['fundId'=>$fundId]),
                'fundsDispatch'=>url('index/fundsDispatch/fundsDispatch', ['fundId'=>$fundId]),
                'fundsManageArchives'=>url('index/fundsManage/fundsManageArchives', ['fundId'=>$fundId]),
            ];
            $this->assign('urlHrefs', $urlHrefs);
            return $this->fetch();
        }
    }
    public function fundsDelete($fundId){
        $fundsLogic = \app\index\logic\Funds::newObj();
        try {
             $fundsLogic->deleteFund($fundId);
        }catch (\Exception $e){
            return ajaxError($e->getMessage());
        }
        return ajaxSuccess('成功');
    }
    public function fundsView($fundId, $status=\app\index\logic\Funds::FUND_ALL_STATUS){
        $fundsLogic = \app\index\logic\Funds::newObj();
        if(request()->isGet()){
            $infos = $fundsLogic->getFundInfos($fundId);
            if(!$infos){
                return $this->fetch('common/error');
            }
            $bindValues = [
                'statusFilter'=>$status
            ];
            $this->assign('bindValues', $bindValues);
            $urlHrefs = [
                'fundsLog'=>url('index/AuditLogs/index', ['models'=>implode('_', ['Funds', 'FundsCollect', 'FundsFinanceContributes', 'FundsFinanceEnterprises', 'FundsFinanceFees', 'FundsFinanceIncomes', 'FundsFinanceTaxes', 'FundsPartners', 'Attachments', 'WorkStatus']), 'recordId'=>$fundId]),
                'fundsSave'=>url('index/Funds/fundsSave', ['fundId'=>$fundId, 'readOnly'=>1]),
                'fundsOverview'=>url('index/Funds/fundsOverview', ['fundId'=>$fundId, 'readOnly'=>1]),
                'fundsProgressEvent'=>url('index/ProgressLogs/light', ['category'=>\app\index\logic\ProgressLogs::PROGRESS_LOG_FUND_MANAGE_CATEGORY, 'externalId'=>$fundId, 'readOnly'=>1]),
                //募集
                'fundsCollect'=>url('index/FundsCollect/fundsCollect', ['fundId'=>$fundId, 'readOnly'=>1]),
                //投资
                'fundsInvestProjects'=>url('index/Funds/fundsInvestProjects', ['fundId'=>$fundId, 'readOnly'=>1]),
                //管理
                'fundsFinance'=>url('index/fundsFinance/fundsFinance', ['fundId'=>$fundId, 'readOnly'=>1]),
                'fundsDispatch'=>url('index/fundsDispatch/fundsDispatch', ['fundId'=>$fundId, 'readOnly'=>1]),
                'fundsManageArchives'=>url('index/fundsManage/fundsManageArchives', ['fundId'=>$fundId, 'readOnly'=>1]),
            ];
            $this->assign('urlHrefs', $urlHrefs);
            return $this->fetch();
        }
    }
    public function fundsOverview($fundId, $readOnly=0){
        $urlHrefs = [
            'milestones'=>url('index/Milestones/index', ['category'=>\app\index\model\Milestones::MILESTONE_FUND_CATEGORY, 'recordId'=>$fundId])
        ];
        $this->assign('urlHrefs', $urlHrefs);
        return $this->fetch();
    }
    /******************************************************************************************************************/
    public function fundsCollect($search=[],$page=1,$rows=DEFAULT_PAGE_ROWS,$sort='fund_id',$order='desc'){
        if(request()->isGet()){
            $urlHrefs = [
                'fundsCollect'=>url('index/Funds/fundsCollect', ['status'=>\app\index\logic\Funds::FUND_COLLECT_STATUS]),
                'fundsSave'=>url('index/Funds/fundsSave'),
                'fundsEdit'=>url('index/Funds/fundsEdit', ['status'=>\app\index\logic\Funds::FUND_COLLECT_STATUS]),
                'fundsDelete'=>url('index/Funds/fundsDelete'),
                'fundsProgress'=>url('index/ProgressLogs/index', ['category'=>\app\index\logic\ProgressLogs::PROGRESS_LOG_FUND_MANAGE_CATEGORY]),
                'fundsPartners'=>url('index/FundsCollect/fundsCollectPartners'),
                'fundsView'=>url('index/Funds/fundsView', ['status'=>\app\index\logic\Funds::FUND_COLLECT_STATUS])
            ];
            $this->assign('urlHrefs', $urlHrefs);
            return $this->fetch();
        }
        $fundsLogic = \app\index\logic\Funds::newObj();
        return json($fundsLogic->load($search, $page, $rows, $sort, $order, \app\index\logic\Funds::FUND_COLLECT_STATUS));
    }
    public function fundsInvest($search=[],$page=1,$rows=DEFAULT_PAGE_ROWS,$sort='fund_id',$order='desc'){
        if(request()->isGet()){
            $urlHrefs = [
                'fundsInvest'=>url('index/Funds/fundsInvest', ['status'=>\app\index\logic\Funds::FUND_INVEST_STATUS]),
                'fundsView'=>url('index/Funds/fundsView', ['status'=>\app\index\logic\Funds::FUND_INVEST_STATUS]),
                'fundsProgress'=>url('index/ProgressLogs/index', ['category'=>\app\index\logic\ProgressLogs::PROGRESS_LOG_FUND_MANAGE_CATEGORY]),
                'fundsEdit'=>url('index/Funds/fundsEdit', ['status'=>\app\index\logic\Funds::FUND_INVEST_STATUS])
            ];
            $this->assign('urlHrefs', $urlHrefs);
            return $this->fetch();
        }
        $fundsLogic = \app\index\logic\Funds::newObj();
        return json($fundsLogic->load($search, $page, $rows, $sort, $order, \app\index\logic\Funds::FUND_INVEST_STATUS));
    }
    public function fundsManage($search=[],$page=1,$rows=DEFAULT_PAGE_ROWS,$sort='fund_id',$order='desc'){
        if(request()->isGet()){
            $urlHrefs = [
                'fundsManage'=>url('index/Funds/fundsManage', ['status'=>\app\index\logic\Funds::FUND_MANAGE_STATUS]),
                'fundsEdit'=>url('index/Funds/fundsEdit', ['status'=>\app\index\logic\Funds::FUND_MANAGE_STATUS]),
                'fundsView'=>url('index/Funds/fundsView', ['status'=>\app\index\logic\Funds::FUND_MANAGE_STATUS]),
                'fundsProgress'=>url('index/ProgressLogs/index', ['category'=>\app\index\logic\ProgressLogs::PROGRESS_LOG_FUND_MANAGE_CATEGORY]),
                'fundsFinance'=>url('index/fundsFinance/fundsFinance'),
                'fundsDispatch'=>url('index/fundsDispatch/fundsDispatch'),
                'fundsManageArchives'=>url('index/FundsManage/fundsManageArchives'),
                'fundsManageEvent'=>url('index/ProgressLogs/index', ['category'=>\app\index\logic\ProgressLogs::PROGRESS_LOG_FUND_MANAGE_CATEGORY])
            ];
            $this->assign('urlHrefs', $urlHrefs);
            return $this->fetch();
        }
        $fundsLogic = \app\index\logic\Funds::newObj();
        return json($fundsLogic->load($search, $page, $rows, $sort, $order, \app\index\logic\Funds::FUND_MANAGE_STATUS));
    }
    public function fundsExit($search=[],$page=1,$rows=DEFAULT_PAGE_ROWS,$sort='fund_id',$order='desc'){
        if(request()->isGet()){
            $urlHrefs = [
                'fundsExit'=>url('index/Funds/fundsExit', ['status'=>\app\index\logic\Funds::FUND_EXIT_STATUS]),
                'fundsView'=>url('index/Funds/fundsView')
            ];
            $this->assign('urlHrefs', $urlHrefs);
            return $this->fetch();
        }
        $fundsLogic = \app\index\logic\Funds::newObj();
        return json($fundsLogic->load($search, $page, $rows, $sort, $order, \app\index\logic\Funds::FUND_EXIT_STATUS));
    }
    public function changeStatus($fundId, $fromStatus, $toStatus){
        $fundsLogic = \app\index\logic\Funds::newObj();
        $fundsLogic->changeStatus($fundId, $fromStatus, $toStatus);
        return ajaxSuccess('成功');
    }
    /******************************************************************************************************************/
    public function fundsInvestProjects($fundId, $readOnly=0){
        if(request()->isGet()){
            $urlHrefs = [
                'fundsInvestProjects'=>url('index/Funds/fundsInvestProjects', ['fundId'=>$fundId])
            ];
            $this->assign('urlHrefs', $urlHrefs);
            $this->assign('readOnly', $readOnly);
            return $this->fetch();
        }
        $enterpriseLogic = \app\index\logic\Enterprise::I();
        $enterprises = $enterpriseLogic->getInvestEnterprise($fundId);
        return json([
            'total'=>count($enterprises),
            'rows'=>$enterprises
        ]);
    }
}