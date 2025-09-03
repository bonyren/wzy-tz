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
use think\Db;
use app\index\logic\FundsCollect as FundsCollectLogic;
use app\index\logic\Upload as UploadLogic;
use app\index\logic\Partners as PartnersLogic;

class FundsCollect extends Common
{    
    /**
     * 基金募集
     *
     * @param  mixed $fundId
     * @param  mixed $readOnly
     * @return void
     */
    public function fundsCollect($fundId, $readOnly=0){
        $urlHrefs = [
            //基金方案
            'fundsCollectPlan'=>url('index/FundsCollect/fundsCollectPlan', ['fundId'=>$fundId, 'readOnly'=>$readOnly]),
            //工商注册
            'fundsCollectBusinessReg'=>url('index/FundsCollect/fundsCollectBusinessReg', ['fundId'=>$fundId, 'readOnly'=>$readOnly]),
            //税务方案
            'fundsCollectTax'=>url('index/FundsCollect/fundsCollectTax', ['fundId'=>$fundId, 'readOnly'=>$readOnly]),
            //合伙出资
            'fundsCollectPartners'=>url('index/FundsCollect/fundsCollectPartners', ['fundId'=>$fundId, 'readOnly'=>$readOnly]),
            //合伙协议
            'fundsCollectProtocol'=>url('index/FundsCollect/fundsCollectProtocol', ['fundId'=>$fundId, 'readOnly'=>$readOnly]),
            //托管方案
            'fundsCollectHostingPlan'=>url('index/FundsCollect/fundsCollectHostingPlan', ['fundId'=>$fundId, 'readOnly'=>$readOnly]),
            //基金备案
            'fundsCollectFiling'=>url('index/FundsCollect/fundsCollectFiling', ['fundId'=>$fundId, 'readOnly'=>$readOnly]),
            //基金交割
            'fundsCollectDelivery'=>url('index/FundsCollect/fundsCollectDelivery', ['fundId'=>$fundId, 'readOnly'=>$readOnly])
        ];
        $this->assign('urlHrefs', $urlHrefs);
        return $this->fetch();
    }    
    /**
     * 基金方案
     *
     * @param  mixed $fundId
     * @param  mixed $readOnly
     * @return void
     */
    public function fundsCollectPlan($fundId, $readOnly=0){
        $fundsCollectLogic = FundsCollectLogic::newObj();
        if(request()->isGet()){
            $urlHrefs = [
                'fundsCollectPlan'=>url('index/FundsCollect/fundsCollectPlan', ['fundId'=>$fundId]),
            ];
            $this->assign('urlHrefs', $urlHrefs);
            $this->assign('readOnly', $readOnly);
            $this->assign('fundId', $fundId);
            $infos = $fundsCollectLogic->getInfos($fundId);
            $bindValues = [
                'infos'=>$infos
            ];
            $this->assign('bindValues', $bindValues);
            return $this->fetch();
        }
        $infos = input('post.infos/a');
        $result = $fundsCollectLogic->savePlanInfos($fundId, $infos);
        if($result){
            return ajaxSuccess('成功');
        }else{
            return ajaxError('失败');
        }
    }
    /**
     * 工商注册
     *
     * @param  mixed $fundId
     * @param  mixed $readOnly
     * @return void
     */
    public function fundsCollectBusinessReg($fundId, $readOnly=0){
        $fundsCollectLogic = FundsCollectLogic::newObj();
        $workStatusLogic = \app\index\logic\WorkStatus::newObj();
        if(request()->isGet()){
            $urlHrefs = [
                'fundsCollectBusinessReg'=>url('index/FundsCollect/fundsCollectBusinessReg', ['fundId'=>$fundId]),
                'businessRegProxyComboConfig'=>url('index/Config/getBusinessRegProxyComboConfig')
            ];
            $this->assign('urlHrefs', $urlHrefs);
            $this->assign('readOnly', $readOnly);
            $this->assign('externalId', $fundId);

            $infos = $fundsCollectLogic->getInfos($fundId);
            $workStatusInfos = $workStatusLogic->getInfos(\app\index\model\WorkStatus::WORK_BUSINESS_REG_CATEGORY, $fundId);
            $bindValues = [
                'infos'=>$infos,
                'workStatusInfos'=>$workStatusInfos
            ];
            $this->assign('bindValues', $bindValues);
            return $this->fetch();
        }
        $infos = input('post.infos/a');
        $workStatusInfos = input('post.work_status/a');
        $workStatusLogic->save(\app\index\model\WorkStatus::WORK_BUSINESS_REG_CATEGORY, $fundId, $workStatusInfos);
        $result = $fundsCollectLogic->saveBusinessRegInfos($fundId, $infos);
        if($result){
            return ajaxSuccess('成功');
        }else{
            return ajaxError('失败');
        }
    }   
    /**
     * 税务方案
     *
     * @param  mixed $fundId
     * @param  mixed $readOnly
     * @return void
     */
    public function fundsCollectTax($fundId, $readOnly=0){
        $fundsCollectLogic = FundsCollectLogic::newObj();
        if(request()->isGet()){
            $urlHrefs = [
                'fundsCollectTax'=>url('index/FundsCollect/fundsCollectTax', ['fundId'=>$fundId])
            ];
            $this->assign('urlHrefs', $urlHrefs);
            $this->assign('readOnly', $readOnly);
            $this->assign('externalId', $fundId);

            $infos = $fundsCollectLogic->getInfos($fundId);
            $bindValues = [
                'infos'=>$infos
            ];
            $this->assign('bindValues', $bindValues);
            return $this->fetch();
        }
        $infos = input('post.infos/a');
        $result = $fundsCollectLogic->saveTaxInfos($fundId, $infos);
        if($result){
            return ajaxSuccess('成功');
        }else{
            return ajaxError('失败');
        }
    }       
    /**
     * 合伙出资
     *
     * @param  mixed $fundId
     * @param  mixed $readOnly
     * @return void
     */
    public function fundsCollectPartners($fundId, $readOnly=0){
        if(request()->isGet()){
            $urlHrefs = [
                'fundsCollectPartners'=>url('index/FundsCollect/fundsCollectPartners', ['fundId'=>$fundId]),
                'fundsCollectPartnersAdd'=>url('index/FundsCollect/fundsCollectPartnersAdd', ['fundId'=>$fundId]),
                'fundsCollectPartnersEdit'=>url('index/FundsCollect/fundsCollectPartnersEdit'),
                'fundsCollectPartnersExit'=>url('index/FundsCollect/fundsCollectPartnersExit'),
                'fundsCollectPartnersEnter'=>url('index/FundsCollect/fundsCollectPartnersEnter'),
                'fundsCollectPartnersDelete'=>url('index/FundsCollect/fundsCollectPartnersDelete'),
                'fundsCollectPartnersPaid'=>url('index/FundsCollect/fundsCollectPartnersPaid', ['readOnly'=>$readOnly]),
                'fundsCollectPartnersPaidAdd'=>url('index/FundsCollect/fundsCollectPartnersPaidAdd'),
            ];
            $this->assign('urlHrefs', $urlHrefs);
            $this->assign('readOnly', $readOnly);
            return $this->fetch();
        }
        $fundsCollectLogic = FundsCollectLogic::newObj();
        return json($fundsCollectLogic->loadPartners($fundId));
    }    
    /**
     * 添加合伙人
     *
     * @param  mixed $fundId
     * @param  mixed $type
     * @return void
     */
    public function fundsCollectPartnersAdd($fundId, $type){
        if(request()->isGet()){
            $ps = PartnersLogic::newObj()->getPartnerPairs($type);
            if(empty($ps)) $ps = [];
            $bindValues = [
                'type'=>$type,
                'ps'=>$ps
            ];
            $this->assign('bindValues', $bindValues);
            return $this->fetch();
        }
        $fundsCollectLogic = FundsCollectLogic::newObj();
        $infos = input('post.infos/a');
        $result = $fundsCollectLogic->addPartner($fundId, $infos);
        if($result){
            return ajaxSuccess('成功');
        }else{
            return ajaxError('失败');
        }
    }    
    /**
     * 编辑合伙人投资金额
     *
     * @param  mixed $fpId
     * @return void
     */
    public function fundsCollectPartnersEdit($fpId){
        $fundsCollectLogic = FundsCollectLogic::newObj();
        if(request()->isGet()){
            $infos = $fundsCollectLogic->getPartnerInfos($fpId);
            $bindValues = [
                'infos'=>$infos
            ];
            $this->assign('bindValues', $bindValues);
            return $this->fetch();
        }

        $infos = input('post.infos/a');
        $result = $fundsCollectLogic->editPartner($fpId, $infos);
        if($result){
            return ajaxSuccess('成功');
        }else{
            return ajaxError('失败');
        }
    }
    
    /**
     * 退伙
     *
     * @param  mixed $fpId
     * @return void
     */
    public function fundsCollectPartnersExit($fpId){
        $fundsCollectLogic = FundsCollectLogic::newObj();
        $result = $fundsCollectLogic->exitPartner($fpId);
        if($result){
            return ajaxSuccess('成功');
        }else{
            return ajaxError('失败');
        }
    }    
    /**
     * 入伙
     *
     * @param  mixed $fpId
     * @return void
     */
    public function fundsCollectPartnersEnter($fpId){
        $fundsCollectLogic = FundsCollectLogic::newObj();
        $result = $fundsCollectLogic->enterPartner($fpId);
        if($result){
            return ajaxSuccess('成功');
        }else{
            return ajaxError('失败');
        }
    }    
    /**
     * 硬删除合伙人
     *
     * @param  mixed $fpId
     * @return void
     */
    public function fundsCollectPartnersDelete($fpId){
        $fundsCollectLogic = FundsCollectLogic::newObj();
        $result = $fundsCollectLogic->deletePartner($fpId);
        if($result){
            return ajaxSuccess('成功');
        }else{
            return ajaxError('失败');
        }
    }
    public function fundsCollectPartnersPaid($fpId, $readOnly=0){
        if(request()->isGet()){
            $urlHrefs = [
                'fundsCollectPartnersPaid'=>url('index/FundsCollect/fundsCollectPartnersPaid', ['fpId'=>$fpId]),
                'fundsCollectPartnersPaidEdit'=>url('index/FundsCollect/fundsCollectPartnersPaidEdit'),
                'fundsCollectPartnersPaidDelete'=>url('index/FundsCollect/fundsCollectPartnersPaidDelete'),
            ];
            $this->assign('urlHrefs', $urlHrefs);
            $this->assign('readOnly', $readOnly);
            $this->assign('fpId', $fpId);
            return $this->fetch();
        }
        $fundsCollectLogic = FundsCollectLogic::newObj();
        return json($fundsCollectLogic->loadPartnersPaid($fpId));
    }
    public function fundsCollectPartnersPaidAdd($fpId){
        if(request()->isGet()){
            $fpInfos = Db::table('funds_partners')
                ->alias('FP')
                ->join('partners P', 'FP.p_id=P.p_id', 'LEFT')
                ->where('FP.fp_id', $fpId)
                ->field('FP.fund_id, P.name')
                ->find();
            if($fpInfos === null){
                return $this->fetch('common/error');
            }
            $bindValues = [
                'fund_id'=>$fpInfos['fund_id'],
                'title'=>$fpInfos['name']
            ];
            $this->assign('bindValues', $bindValues);
            return $this->fetch();
        }
        $fundsCollectLogic = FundsCollectLogic::newObj();
        $infos = input('post.infos/a');
        $result = $fundsCollectLogic->addPartnerPaid($fpId, $infos);
        if($result){
            return ajaxSuccess('成功');
        }else{
            return ajaxError('失败');
        }
    }
    public function fundsCollectPartnersPaidEdit($fpPaidId){
        $fundsCollectLogic = FundsCollectLogic::newObj();
        if(request()->isGet()){
            $infos = $fundsCollectLogic->getPartnerPaidInfos($fpPaidId);
            if(!$infos){
                return $this->fetch('common/error');
            }
            $fpId = $infos['fp_id'];
            $fpInfos = Db::table('funds_partners')->alias('FP')->join('partners P', 'FP.p_id=P.p_id', 'LEFT')
                ->where('FP.fp_id', $fpId)->field('FP.fund_id, P.name')->find();
            if($fpInfos === null){
                return $this->fetch('common/error');
            }
            $bindValues = [
                'infos'=>$infos,
                'fund_id'=>$fpInfos['fund_id'],
                'title'=>$fpInfos['name']
            ];
            $this->assign('bindValues', $bindValues);
            return $this->fetch();
        }
        /*
        $infos = input('post.infos/a');
        $result = $fundsCollectLogic->editPartnerPaid($fpPaidId, $infos);
        if($result){
            return ajaxSuccess('成功');
        }else{
            return ajaxError('失败');
        }*/
    }
    public function fundsCollectPartnersPaidDelete($fpPaidId){
        $fundsCollectLogic = FundsCollectLogic::newObj();
        $result = $fundsCollectLogic->deletePartnerPaid($fpPaidId);
        if($result){
            return ajaxSuccess('成功');
        }else{
            return ajaxError('失败');
        }
    }
    /**
     * 合伙协议
     *
     * @param  mixed $fundId
     * @param  mixed $readOnly
     * @return void
     */
    public function fundsCollectProtocol($fundId, $readOnly=0){
        $fundsCollectLogic = FundsCollectLogic::newObj();
        if(request()->isGet()){
            $urlHrefs = [
                'fundsCollectProtocol'=>url('index/FundsCollect/fundsCollectProtocol', ['fundId'=>$fundId])
            ];
            $this->assign('urlHrefs', $urlHrefs);
            $this->assign('readOnly', $readOnly);
            $this->assign('externalId', $fundId);

            $infos = $fundsCollectLogic->getInfos($fundId);
            $bindValues = [
                'infos'=>$infos
            ];
            $this->assign('bindValues', $bindValues);
            return $this->fetch();
        }
        $infos = input('post.infos/a');
        $result = $fundsCollectLogic->saveProtocolInfos($fundId, $infos);
        if($result){
            return ajaxSuccess('成功');
        }else{
            return ajaxError('失败');
        }
    }
    /**
     * 托管方案
     *
     * @param  mixed $fundId
     * @param  mixed $readOnly
     * @return void
     */
    public function fundsCollectHostingPlan($fundId, $readOnly=0){
        $fundsCollectLogic = FundsCollectLogic::newObj();
        if(request()->isGet()){
            $urlHrefs = [
                'fundsCollectHostingPlan'=>url('index/FundsCollect/fundsCollectHostingPlan', ['fundId'=>$fundId]),
                'hostingAgencyComboConfig'=>url('index/Config/getFundHostingAgencyComboConfig')
            ];
            $this->assign('urlHrefs', $urlHrefs);
            $this->assign('readOnly', $readOnly);
            $this->assign('externalId', $fundId);

            $infos = $fundsCollectLogic->getInfos($fundId);
            $bindValues = [
                'infos'=>$infos
            ];
            $this->assign('bindValues', $bindValues);
            return $this->fetch();
        }
        $infos = input('post.infos/a');
        $result = $fundsCollectLogic->saveHostingPlanInfos($fundId, $infos);
        if($result){
            return ajaxSuccess('成功');
        }else{
            return ajaxError('失败');
        }
    }
    /**
     * 基金备案
     *
     * @param  mixed $fundId
     * @param  mixed $readOnly
     * @return void
     */
    public function fundsCollectFiling($fundId, $readOnly=0){
        $fundsCollectLogic = FundsCollectLogic::newObj();
        if(request()->isGet()){
            $urlHrefs = [
                'fundsCollectFiling'=>url('index/FundsCollect/fundsCollectFiling', ['fundId'=>$fundId])
            ];
            $this->assign('urlHrefs', $urlHrefs);
            $this->assign('readOnly', $readOnly);
            $this->assign('externalId', $fundId);

            $infos = $fundsCollectLogic->getInfos($fundId);
            $bindValues = [
                'infos'=>$infos
            ];
            $this->assign('bindValues', $bindValues);
            return $this->fetch();
        }
        $infos = input('post.infos/a');
        $result = $fundsCollectLogic->saveFilingInfos($fundId, $infos);
        if($result){
            return ajaxSuccess('成功');
        }else{
            return ajaxError('失败');
        }
    }    
    /**
     * 基金交割
     *
     * @param  mixed $fundId
     * @param  mixed $readOnly
     * @return void
     */
    public function fundsCollectDelivery($fundId, $readOnly=0){
        $fundsCollectLogic = FundsCollectLogic::newObj();
        if(request()->isGet()){
            $urlHrefs = [
                'fundsCollectDelivery'=>url('index/FundsCollect/fundsCollectDelivery', ['fundId'=>$fundId])
            ];
            $this->assign('urlHrefs', $urlHrefs);
            $this->assign('readOnly', $readOnly);
            $this->assign('externalId', $fundId);

            $infos = $fundsCollectLogic->getInfos($fundId);
            $bindValues = [
                'infos'=>$infos
            ];
            $this->assign('bindValues', $bindValues);
            return $this->fetch();
        }
        $infos = input('post.infos/a');
        $result = $fundsCollectLogic->saveDeliveryInfos($fundId, $infos);
        if($result){
            return ajaxSuccess('成功');
        }else{
            return ajaxError('失败');
        }
    }
}