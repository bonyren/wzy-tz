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

class FundsFinance extends Common
{
    public function fundsFinance($fundId, $readOnly=0){
        if(request()->isGet()) {
            $urlHrefs = [
                'statistic'=>url('index/FundsFinance/fundsFinanceStatistic', ['fundId'=>$fundId]),
                'contribute'=>url('index/FundsFinance/fundsFinanceContributes', ['fundId'=>$fundId, 'readOnly'=>$readOnly]),
                'fee'=>url('index/FundsFinance/fundsFinanceFees', ['fundId'=>$fundId, 'readOnly'=>$readOnly]),
                'income'=>url('index/FundsFinance/fundsFinanceIncomes', ['fundId'=>$fundId, 'readOnly'=>$readOnly]),
                'tax'=>url('index/FundsFinance/fundsFinanceTaxes', ['fundId'=>$fundId, 'readOnly'=>$readOnly]),
                'enterprise'=>url('index/FundsFinance/fundsFinanceEnterprises', ['fundId'=>$fundId, 'readOnly'=>$readOnly])
            ];
            $this->assign('urlHrefs', $urlHrefs);
            $this->assign('readOnly', $readOnly);
            return $this->fetch();
        }
    }
    public function fundsFinanceStatistic($fundId){
        $fundsFinanceLogic = \app\index\logic\FundsFinance::newObj();
        $infos = $fundsFinanceLogic->getFinanceInfos($fundId);
        $bindValues = [
            'infos'=>$infos
        ];
        $this->assign('bindValues', $bindValues);
        return $this->fetch();
    }
    public function fundsFinanceContributes($fundId, $readOnly=0){
        if(request()->isGet()){
            $urlHrefs = [
                'fundsFinanceContributes'=>url('index/FundsFinance/fundsFinanceContributes', ['fundId'=>$fundId]),
                'fundsFinanceContributesAdd'=>url('index/FundsFinance/fundsFinanceContributesAdd', ['fundId'=>$fundId]),
                'fundsFinanceContributesEdit'=>url('index/FundsFinance/fundsFinanceContributesEdit'),
                'fundsFinanceContributesDelete'=>url('index/FundsFinance/fundsFinanceContributesDelete'),
            ];
            $this->assign('urlHrefs', $urlHrefs);
            $this->assign('readOnly', $readOnly);
            return $this->fetch();
        }
        $fundsFinanceLogic = \app\index\logic\FundsFinance::newObj();
        return json($fundsFinanceLogic->loadFinanceContributes($fundId));
    }
    public function fundsFinanceContributesAdd($fundId){
        if(request()->isGet()){
            return $this->fetch();
        }
        $fundsFinanceLogic = \app\index\logic\FundsFinance::newObj();
        $infos = input('post.infos/a');
        $result = $fundsFinanceLogic->addFinanceContribute($fundId, $infos);
        if($result){
            return ajaxSuccess('成功');
        }else{
            return ajaxError('失败');
        }
    }
    public function fundsFinanceContributesEdit($ffcId){
        $fundsFinanceLogic = \app\index\logic\FundsFinance::newObj();
        if(request()->isGet()){
            $infos = $fundsFinanceLogic->getFinanceContributeInfos($ffcId);
            $bindValues = [
                'infos'=>$infos
            ];
            $this->assign('bindValues', $bindValues);
            return $this->fetch();
        }

        $infos = input('post.infos/a');
        $result = $fundsFinanceLogic->editFinanceContribute($ffcId, $infos);
        if($result){
            return ajaxSuccess('成功');
        }else{
            return ajaxError('失败');
        }
    }
    public function fundsFinanceContributesDelete($ffcId){
        $fundsFinanceLogic = \app\index\logic\FundsFinance::newObj();
        $result = $fundsFinanceLogic->deleteFinanceContribute($ffcId);
        if($result){
            return ajaxSuccess('成功');
        }else{
            return ajaxError('失败');
        }
    }
    /*******************************************************************************************************************/
    public function fundsFinanceFees($fundId, $readOnly=0){
        if(request()->isGet()){
            $urlHrefs = [
                'fundsFinanceFees'=>url('index/FundsFinance/fundsFinanceFees', ['fundId'=>$fundId]),
                'fundsFinanceFeesAdd'=>url('index/FundsFinance/fundsFinanceFeesAdd', ['fundId'=>$fundId]),
                'fundsFinanceFeesEdit'=>url('index/FundsFinance/fundsFinanceFeesEdit'),
                'fundsFinanceFeesDelete'=>url('index/FundsFinance/fundsFinanceFeesDelete'),
            ];
            $this->assign('urlHrefs', $urlHrefs);
            $this->assign('readOnly', $readOnly);
            return $this->fetch();
        }
        $fundsFinanceLogic = \app\index\logic\FundsFinance::newObj();
        return json($fundsFinanceLogic->loadFinanceFees($fundId));
    }
    public function fundsFinanceFeesAdd($fundId){
        if(request()->isGet()){
            return $this->fetch();
        }
        $fundsFinanceLogic = \app\index\logic\FundsFinance::newObj();
        $infos = input('post.infos/a');
        $result = $fundsFinanceLogic->addFinanceFee($fundId, $infos);
        if($result){
            return ajaxSuccess('成功');
        }else{
            return ajaxError('失败');
        }
    }
    public function fundsFinanceFeesEdit($fffId){
        $fundsFinanceLogic = \app\index\logic\FundsFinance::newObj();
        if(request()->isGet()){
            $infos = $fundsFinanceLogic->getFinanceFeeInfos($fffId);
            $bindValues = [
                'infos'=>$infos
            ];
            $this->assign('bindValues', $bindValues);
            return $this->fetch();
        }

        $infos = input('post.infos/a');
        $result = $fundsFinanceLogic->editFinanceFee($fffId, $infos);
        if($result){
            return ajaxSuccess('成功');
        }else{
            return ajaxError('失败');
        }
    }
    public function fundsFinanceFeesDelete($fffId){
        $fundsFinanceLogic = \app\index\logic\FundsFinance::newObj();
        $result = $fundsFinanceLogic->deleteFinanceFee($fffId);
        if($result){
            return ajaxSuccess('成功');
        }else{
            return ajaxError('失败');
        }
    }
    /******************************************************************************************************************/
    public function fundsFinanceIncomes($fundId, $readOnly=0){
        if(request()->isGet()){
            $urlHrefs = [
                'fundsFinanceIncomes'=>url('index/FundsFinance/fundsFinanceIncomes', ['fundId'=>$fundId]),
                'fundsFinanceIncomesAdd'=>url('index/FundsFinance/fundsFinanceIncomesAdd', ['fundId'=>$fundId]),
                'fundsFinanceIncomesEdit'=>url('index/FundsFinance/fundsFinanceIncomesEdit'),
                'fundsFinanceIncomesDelete'=>url('index/FundsFinance/fundsFinanceIncomesDelete'),
            ];
            $this->assign('urlHrefs', $urlHrefs);
            $this->assign('readOnly', $readOnly);
            return $this->fetch();
        }
        $fundsFinanceLogic = \app\index\logic\FundsFinance::newObj();
        return json($fundsFinanceLogic->loadFinanceIncomes($fundId));
    }
    public function fundsFinanceIncomesAdd($fundId){
        if(request()->isGet()){
            return $this->fetch();
        }
        $fundsFinanceLogic = \app\index\logic\FundsFinance::newObj();
        $infos = input('post.infos/a');
        $result = $fundsFinanceLogic->addFinanceIncome($fundId, $infos);
        if($result){
            return ajaxSuccess('成功');
        }else{
            return ajaxError('失败');
        }
    }
    public function fundsFinanceIncomesEdit($ffiId){
        $fundsFinanceLogic = \app\index\logic\FundsFinance::newObj();
        if(request()->isGet()){
            $infos = $fundsFinanceLogic->getFinanceIncomeInfos($ffiId);
            $bindValues = [
                'infos'=>$infos
            ];
            $this->assign('bindValues', $bindValues);
            return $this->fetch();
        }

        $infos = input('post.infos/a');
        $result = $fundsFinanceLogic->editFinanceIncome($ffiId, $infos);
        if($result){
            return ajaxSuccess('成功');
        }else{
            return ajaxError('失败');
        }
    }
    public function fundsFinanceIncomesDelete($ffiId){
        $fundsFinanceLogic = \app\index\logic\FundsFinance::newObj();
        $result = $fundsFinanceLogic->deleteFinanceIncome($ffiId);
        if($result){
            return ajaxSuccess('成功');
        }else{
            return ajaxError('失败');
        }
    }
    /*******************************************************************************************************************/
    public function fundsFinanceTaxes($fundId, $readOnly=0){
        if(request()->isGet()){
            $urlHrefs = [
                'fundsFinanceTaxes'=>url('index/FundsFinance/fundsFinanceTaxes', ['fundId'=>$fundId]),
                'fundsFinanceTaxesAdd'=>url('index/FundsFinance/fundsFinanceTaxesAdd', ['fundId'=>$fundId]),
                'fundsFinanceTaxesEdit'=>url('index/FundsFinance/fundsFinanceTaxesEdit'),
                'fundsFinanceTaxesDelete'=>url('index/FundsFinance/fundsFinanceTaxesDelete'),
            ];
            $this->assign('urlHrefs', $urlHrefs);
            $this->assign('readOnly', $readOnly);
            return $this->fetch();
        }
        $fundsFinanceLogic = \app\index\logic\FundsFinance::newObj();
        return json($fundsFinanceLogic->loadFinanceTaxes($fundId));
    }
    public function fundsFinanceTaxesAdd($fundId){
        if(request()->isGet()){
            return $this->fetch();
        }
        $fundsFinanceLogic = \app\index\logic\FundsFinance::newObj();
        $infos = input('post.infos/a');
        $result = $fundsFinanceLogic->addFinanceTax($fundId, $infos);
        if($result){
            return ajaxSuccess('成功');
        }else{
            return ajaxError('失败');
        }
    }
    public function fundsFinanceTaxesEdit($fftId){
        $fundsFinanceLogic = \app\index\logic\FundsFinance::newObj();
        if(request()->isGet()){
            $infos = $fundsFinanceLogic->getFinanceTaxInfos($fftId);
            $bindValues = [
                'infos'=>$infos
            ];
            $this->assign('bindValues', $bindValues);
            return $this->fetch();
        }

        $infos = input('post.infos/a');
        $result = $fundsFinanceLogic->editFinanceTax($fftId, $infos);
        if($result){
            return ajaxSuccess('成功');
        }else{
            return ajaxError('失败');
        }
    }
    public function fundsFinanceTaxesDelete($fftId){
        $fundsFinanceLogic = \app\index\logic\FundsFinance::newObj();
        $result = $fundsFinanceLogic->deleteFinanceTax($fftId);
        if($result){
            return ajaxSuccess('成功');
        }else{
            return ajaxError('失败');
        }
    }
    /*******************************************************************************************************************/
    public function fundsFinanceEnterprises($fundId, $readOnly=0){
        if(request()->isGet()){
            $urlHrefs = [
                'fundsFinanceEnterprises'=>url('index/FundsFinance/fundsFinanceEnterprises', ['fundId'=>$fundId]),
                'fundsFinanceEnterprisesAdd'=>url('index/FundsFinance/fundsFinanceEnterprisesAdd', ['fundId'=>$fundId]),
                'fundsFinanceEnterprisesEdit'=>url('index/FundsFinance/fundsFinanceEnterprisesEdit'),
                'fundsFinanceEnterprisesDelete'=>url('index/FundsFinance/fundsFinanceEnterprisesDelete'),
            ];
            $this->assign('urlHrefs', $urlHrefs);
            $this->assign('readOnly', $readOnly);
            return $this->fetch();
        }
        $fundsFinanceLogic = \app\index\logic\FundsFinance::newObj();
        return json($fundsFinanceLogic->loadFinanceEnterprises($fundId));
    }
    public function fundsFinanceEnterprisesAdd($fundId){
        if(request()->isGet()){
            $enterprisePairs = \app\index\logic\Enterprise::I()->getEnterprisePairs();
            $this->assign('enterprisePairs', $enterprisePairs);
            return $this->fetch();
        }
        $fundsFinanceLogic = \app\index\logic\FundsFinance::newObj();
        $infos = input('post.infos/a');
        $result = $fundsFinanceLogic->addFinanceEnterprise($fundId, $infos);
        if($result){
            return ajaxSuccess('成功');
        }else{
            return ajaxError('失败');
        }
    }
    public function fundsFinanceEnterprisesEdit($ffeId){
        $fundsFinanceLogic = \app\index\logic\FundsFinance::newObj();
        if(request()->isGet()){
            $enterprisePairs = \app\index\logic\Enterprise::I()->getEnterprisePairs();
            $this->assign('enterprisePairs', $enterprisePairs);

            $infos = $fundsFinanceLogic->getFinanceEnterpriseInfos($ffeId);
            $bindValues = [
                'infos'=>$infos
            ];
            $this->assign('bindValues', $bindValues);
            return $this->fetch();
        }

        $infos = input('post.infos/a');
        $result = $fundsFinanceLogic->editFinanceEnterprise($ffeId, $infos);
        if($result){
            return ajaxSuccess('成功');
        }else{
            return ajaxError('失败');
        }
    }
    public function fundsFinanceEnterprisesDelete($ffeId){
        $fundsFinanceLogic = \app\index\logic\FundsFinance::newObj();
        $result = $fundsFinanceLogic->deleteFinanceEnterprise($ffeId);
        if($result){
            return ajaxSuccess('成功');
        }else{
            return ajaxError('失败');
        }
    }
    /*******************************************************************************************************************/
}