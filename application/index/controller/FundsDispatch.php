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
use app\index\logic\Defs;

class FundsDispatch extends Common
{
    public function fundsDispatch($fundId, $readOnly=0, $search=[],$page=1,$rows=DEFAULT_PAGE_ROWS,$sort='id',$order='desc'){
        if(request()->isGet()) {
            $urlHrefs = [
                'index'=>url('index/fundsDispatch/fundsDispatch', ['fundId'=>$fundId]),
                'fundsDispatchDetail'=>url('index/fundsDispatch/fundsDispatchDetail'),
                'fundsDispatchPartners'=>url('index/fundsDispatch/fundsDispatchPartners')
            ];
            $this->assign('urlHrefs', $urlHrefs);
            $this->assign('readOnly', $readOnly);
            return $this->fetch();
        }
        $enterpriseLogic = \app\index\logic\Enterprise::I();
        return json($enterpriseLogic->loadDividends($fundId, $search, $page, $rows, $sort, $order));
    }
    public function fundsDispatchPartners($ffiId, $enterpriseId){
        if(request()->isGet()){
            $urlHrefs = [
                'fundsDispatchPartnersSave'=>url('index/fundsDispatch/fundsDispatchPartnersSave', ['ffiId'=>$ffiId])
            ];
            $this->assign('urlHrefs', $urlHrefs);
            $this->assign('ffiId', $ffiId);
            $this->assign('enterpriseId', $enterpriseId);
            return $this->fetch();
        }
        $enterpriseLogic = \app\index\logic\Enterprise::I();
        return json($enterpriseLogic->loadDividendDispatchPartners($ffiId));
    }
    public function fundsDispatchPartnersSave($ffiId){
        $pId = input('post.p_id/d');
        $amount = input('post.amount/f');
        $fee = input('post.fee/f');
        $tax = input('post.tax/f');
        $enterpriseLogic = \app\index\logic\Enterprise::I();
        $enterpriseLogic->saveDividendDispatchPartner($ffiId, $pId, $amount, $fee, $tax);
        return ajaxSuccess('Success');
    }
    //根据基金出资比例默认分配分红
    public function fundsDispatchPartnersDefault($ffiId){
        Enterprise::I()->setDividendDispatchDefault($ffiId);
        return ajaxSuccess('操作成功');
    }
    public function fundsDispatchDetail($ffiId){
        $enterpriseLogic = \app\index\logic\Enterprise::I();
        if(request()->isGet()){
            $records = $enterpriseLogic->loadDividendPartners($ffiId);
            $this->assign('records', $records);
            return $this->fetch();
        }
    }
}