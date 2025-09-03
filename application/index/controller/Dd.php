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
use app\index\model\Dropdowns;
use think\Db;
use app\index\logic\Dd as DdLogic;
use app\index\logic\Redis as RedisLogic;

//尽职调查 due diligence
class Dd extends Common
{
    //总表
    const GLOBAL_INDEX_VIEW = 1;//总表界面
    const GLOBAL_PARTNERS_VIEW = 2;//出资人名录界面
    const GLOBAL_ENTERPRISES_VIEW = 3;//投资业绩界面
    public function index($page=1,$rows=DEFAULT_PAGE_ROWS,$sort='fund_id',$order='asc',$view=self::GLOBAL_INDEX_VIEW){
        if(request()->isGet()){
            $urlHrefs = [
                'index'=>url('index/Dd/index'),
            ];
            $this->assign('urlHrefs', $urlHrefs);
            ///////////////////////////////////////////////////////////////////////////////////////////////////////////
            $this->assign('view', $view);
            return $this->fetch();
        }
        $ddLogic = DdLogic::newObj();
        return json($ddLogic->load($page, $rows, $sort, $order));
    }
    public function partners($fundId){
        $partners = [];
        $records = Db::table('funds_partners')->alias('FP')->join('partners P', 'P.p_id=FP.p_id')->where(['FP.fund_id'=>$fundId])->field('FP.fp_id, FP.amount, P.*')->select();
        $index = 0;
        foreach($records as $record){
            $pId = $record['p_id'];
            $fpId = $record['fp_id'];
            $amount = $record['amount'];

            $paidAmount = Db::table('funds_partners')->alias('FP')->join('funds_partners_paid FPP', 'FP.fp_id=FPP.fp_id')
                ->join('funds_finance_contributes FFC', 'FPP.ffc_id=FFC.ffc_id')->where('FP.fp_id', $fpId)->sum('FFC.amount');

            //$percent = intval($amount)?(round($paidAmount/$amount*100, 2).'%'):'';
            $fundSize = Db::table('funds')->where(['fund_id'=>$fundId])->value('size');
            $percent = intval($fundSize)?(round($amount/$fundSize*100, 2).'%'):'';

            $partners[] = [
                'index'=>++$index,
                'name'=>$record['name'],
                'amount'=>round($record['amount']/10000, 2),
                'paid_amount'=>round($paidAmount/10000, 2),
                'percent'=>$percent
            ];
        }
        $this->assign('partners', $partners);
        return $this->fetch();
    }
    public function enterprises($fundId){
        $enterpriseLogic = \app\index\logic\Enterprise::I();
        $redisLogic = RedisLogic::I();
        $enterprises = [];
        $records = $enterpriseLogic->getInvestEnterprise($fundId);
        $stages = Dropdowns::getItems('financing_stage',true);
        $index = 0;
        foreach($records as $record){
            $enterprise = [];
            $enterpriseId = $record['enterprise_id'];
            $investmentId = $record['investment_id'];
            //序号
            $enterprise['index'] = ++$index;
            //公司名称
            $enterprise['name'] = $record['name'];
            //项目名称
            $enterprise['project_name'] = '';
            //投资阶段
            $enterprise['stage'] = $record['financing_stage'] ? $stages[$record['financing_stage']] : '未指定轮次';
            //投资金额(万元)
            $enterprise['amount'] = round($record['amount']/10000, 2);

            //投后估值
            $enterprise['post_investment_valuation'] = round($record['initial_valuation']/10000, 2);
            //初始占股比
            $enterprise['stock_ratio'] = round($record['stock_ratio'], 2) . '%';
            //注册地
            $enterprise['register_place'] = '';
            //是否领投
            $enterprise['is_lead_investment'] = '';
            //当轮共同投资人
            $enterprise['co_investors'] = '';

            //是否占董监高席位
            $enterprise['is_director_position'] = '';
            //后轮融资情况
            $enterprise['after_financing_info'] = '';
            //最新估值
            $enterprise['latest_valuation'] = $record['latest_valuation'] > 0 ? round($record['latest_valuation']/10000, 2) : '';
            //现在占股比
            $enterprise['now_stock_ratio'] = '';
            //现持有股权价值
            $enterprise['now_hold_stock_value'] = '';

            //退出方式
            $enterprise['exit_way'] = '';
            //是否已完全退出
            $enterprise['is_totally_exist'] = '';
            //分红/退出金额
            $enterprise['dividend_return_amount'] = '';
            //回报倍数
            $enterprise['return_multiple'] = '';
            //IRR
            $enterprise['irr'] = '';

            $redisKey = RedisLogic::genDdKey($fundId, $enterpriseId);
            $enterprise['redis_key'] = $redisKey;
            $jsonStr = $redisLogic->getData($redisKey);
            if($jsonStr){
                $jsonData = json_decode($jsonStr, true);
                //项目名称
                if(isset($jsonData['project_name'])){
                    $enterprise['project_name'] = $jsonData['project_name'];
                }
                //注册地
                if(isset($jsonData['register_place'])){
                    $enterprise['register_place'] = $jsonData['register_place'];
                }
                //是否领投
                if(isset($jsonData['is_lead_investment']) && $jsonData['is_lead_investment'] == 1){
                    $enterprise['is_lead_investment'] = '是';
                }else{
                    $enterprise['is_lead_investment'] = '否';
                }
                //当轮共同投资人
                if(isset($jsonData['co_investors'])){
                    $enterprise['co_investors'] = $jsonData['co_investors'];
                }
                //是否占董监高席位
                if(isset($jsonData['is_director_position']) && $jsonData['is_director_position'] == 1){
                    $enterprise['is_director_position'] = '是';
                }else{
                    $enterprise['is_director_position'] = '否';
                }
                //后轮融资情况
                if(isset($jsonData['after_financing_info'])){
                    $enterprise['after_financing_info'] = $jsonData['after_financing_info'];
                }
                //现在占股比
                if(isset($jsonData['now_stock_ratio'])){
                    $enterprise['now_stock_ratio'] = $jsonData['now_stock_ratio'];
                }
                //现持有股权价值
                if(isset($jsonData['now_hold_stock_value'])){
                    $enterprise['now_hold_stock_value'] = $jsonData['now_hold_stock_value'];
                }
                //退出方式
                if(isset($jsonData['exit_way'])){
                    $enterprise['exit_way'] = $jsonData['exit_way'];
                }
                //是否已完全退出
                if(isset($jsonData['is_totally_exist']) && $jsonData['is_totally_exist'] == 1){
                    $enterprise['is_totally_exist'] = '是';
                }else{
                    $enterprise['is_totally_exist'] = '否';
                }
                //分红/退出金额
                if(isset($jsonData['dividend_return_amount'])){
                    $enterprise['dividend_return_amount'] = $jsonData['dividend_return_amount'];
                }
                //回报倍数
                if(isset($jsonData['return_multiple'])){
                    $enterprise['return_multiple'] = $jsonData['return_multiple'];
                }
                //IRR
                if(isset($jsonData['irr'])){
                    $enterprise['irr'] = $jsonData['irr'];
                }
            }
            $enterprises[] = $enterprise;
        }
        $this->assign('enterprises', $enterprises);
        return $this->fetch();
    }
    public function enterpriseSave($redisKey){
        $redisLogic = RedisLogic::I();
        if($this->request->isGet()){
            $dd = $redisLogic->getData($redisKey);
            if($dd){
                $dd = json_decode($dd, true);
            }else{
                $dd = [];
            }
            $this->assign('dd', $dd);
            return $this->fetch();
        }
    }
}