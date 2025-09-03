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
use app\index\logic\Defs;
use think\Controller;
use think\Log;
use think\Debug;
use think\Request;
use app\index\logic\FundsFinance as FundsFinanceLogic;

class Components extends Common{
    public function fundContribute($uniqid, $fundId, $ffcId=0, $title=''){
        $fundsFinanceLogic = FundsFinanceLogic::newObj();
        if(request()->isGet()){
            $infos = $fundsFinanceLogic->getFinanceContributeInfos($ffcId);
            if(!$infos){
                //新增
                $infos = [
                    'fund_id'=>$fundId,
                    'title'=>$title,
                    'tax'=>[]
                ];
            }
            $bindValues = [
                'infos'=>$infos
            ];
            $this->assign('bindValues', $bindValues);
            $urlHrefs = [
                'fundContribute'=>url('index/Components/fundContribute', [
                    'uniqid'=>$uniqid,
                    'fundId'=>$fundId,
                    'ffcId'=>$ffcId
                ])
            ];
            $this->assign('urlHrefs', $urlHrefs);
            $this->assign('uniqid', $uniqid);
            return $this->fetch();
        }

        $infos = input('post.infos/a');
        if($ffcId == 0){
            $ffcId = $fundsFinanceLogic->addFinanceContribute($fundId, $infos);
            $result = $ffcId?true:false;
        }else {
            $result = $fundsFinanceLogic->editFinanceContribute($ffcId, $infos);
        }
        if($result){
            return ajaxSuccess('成功', $ffcId);
        }else{
            return ajaxError('失败');
        }
    }
    public function fundContributeView($ffcId){
        $fundsFinanceLogic = FundsFinanceLogic::newObj();
        $infos = $fundsFinanceLogic->getFinanceContributeInfos($ffcId);
        if(!$infos){
            return $this->fetch('common/error');
        }
        $bindValues = [
            'infos'=>$infos
        ];
        $this->assign('bindValues', $bindValues);
        return $this->fetch();
    }
    /******************************************************************************************************************/
    public function fundIncome($uniqid, $fundId, $ffiId=0, $type=null, $title=null, $date=null){
        $fundsFinanceLogic = FundsFinanceLogic::newObj();
        if(request()->isGet()){
            $infos = $fundsFinanceLogic->getFinanceIncomeInfos($ffiId);
            if(!$infos){
                $infos = [
                    'fund_id'=>$fundId,
                    'type'=>Defs::FUND_INCOME_OTHER_TYPE,
                    'title'=>'',
                    'date'=>Defs::DEFAULT_DB_DATE_VALUE,
                    'amount'=>0.00,
                    'tax'=>[]
                ];
            }
            $bindValues = [
                'infos'=>$infos
            ];
            $this->assign('bindValues', $bindValues);
            $urlHrefs = [
                'fundIncome'=>url('index/Components/fundIncome', [
                    'uniqid'=>$uniqid,
                    'fundId'=>$fundId,
                    'ffiId'=>$ffiId
                ])
            ];
            $this->assign('urlHrefs', $urlHrefs);
            $this->assign('bindItems', [
                'ffiId'=>$ffiId,
                'type'=>$type,
                'title'=>$title,
                'date'=>$date
            ]);
            $this->assign('uniqid', $uniqid);
            return $this->fetch();
        }

        $infos = input('post.infos/a');
        if($ffiId == 0){
            $ffiId = $fundsFinanceLogic->addFinanceIncome($fundId, $infos);
            $result = $ffiId?true:false;
        }else {
            $result = $fundsFinanceLogic->editFinanceIncome($ffiId, $infos);
        }
        if($result){
            return ajaxSuccess('成功', $ffiId);
        }else{
            return ajaxError('失败');
        }
    }
    public function fundIncomeView($ffiId){
        $fundsFinanceLogic = FundsFinanceLogic::newObj();
        $infos = $fundsFinanceLogic->getFinanceIncomeInfos($ffiId);
        if(!$infos){
            return $this->fetch('common/error');
        }
        $bindValues = [
            'infos'=>$infos
        ];
        $this->assign('bindValues', $bindValues);
        return $this->fetch();
    }
    /******************************************************************************************************************/
    public function fundEnterprise($uniqid, $fundId, $enterpriseId, $ffeId=0, $title=null, $date=null){
        $fundsFinanceLogic = FundsFinanceLogic::newObj();
        if(request()->isGet()){
            $infos = $fundsFinanceLogic->getFinanceEnterpriseInfos($ffeId);
            if(!$infos){
                $infos = [
                    'fund_id'=>$fundId,
                    'title'=>'',
                    'date'=>Defs::DEFAULT_DB_DATE_VALUE,
                    'amount'=>'',
                    'enterprise_id'=>0
                ];
            }
            $bindValues = [
                'infos'=>$infos
            ];
            $this->assign('bindValues', $bindValues);
            $urlHrefs = [
                'fundEnterprise'=>url('index/Components/fundEnterprise', [
                    'uniqid'=>$uniqid,
                    'fundId'=>$fundId,
                    'enterpriseId'=>$enterpriseId,
                    'ffeId'=>$ffeId
                ])
            ];
            $this->assign('urlHrefs', $urlHrefs);
            $this->assign('bindItems', [
                'enterpriseId'=>$enterpriseId,
                'ffeId'=>$ffeId,
                'title'=>$title,
                'date'=>$date
            ]);
            $this->assign('uniqid', $uniqid);
            return $this->fetch();
        }

        $infos = input('post.infos/a');
        if($ffeId == 0){
            $ffeId = $fundsFinanceLogic->addFinanceEnterprise($fundId, $infos);
            $result = $ffeId?true:false;
        }else {
            $result = $fundsFinanceLogic->editFinanceEnterprise($ffeId, $infos);
        }
        if($result){
            return ajaxSuccess('成功', $ffeId);
        }else{
            return ajaxError('失败');
        }
    }
    public function fundEnterpriseView($ffeId){
        $fundsFinanceLogic = FundsFinanceLogic::newObj();
        $infos = $fundsFinanceLogic->getFinanceEnterpriseInfos($ffeId);
        if(!$infos){
            return $this->fetch('common/error');
        }
        $bindValues = [
            'infos'=>$infos
        ];
        $this->assign('bindValues', $bindValues);
        return $this->fetch();
    }
}