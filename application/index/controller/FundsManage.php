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

class FundsManage extends Common
{
    /*******************************************************************************************************************/
    public function fundsManageArchives($fundId, $readOnly=0){
        if(request()->isGet()) {
            $urlHrefs = [
                'fundsManageBusiness'=>url('index/ChangeLogs/index', ['category'=>\app\index\logic\ChangeLogs::CHANGE_LOG_FUND_MANAGE_BUSINESS_CATEGORY, 'externalId'=>$fundId, 'readOnly'=>$readOnly]),
                'fundsManageTax'=>url('index/ChangeLogs/index', ['category'=>\app\index\logic\ChangeLogs::CHANGE_LOG_FUND_MANAGE_TAX_CATEGORY, 'externalId'=>$fundId, 'readOnly'=>$readOnly]),
                'fundsManageFiling'=>url('index/ChangeLogs/index', ['category'=>\app\index\logic\ChangeLogs::CHANGE_LOG_FUND_MANAGE_FILING_CATEGORY, 'externalId'=>$fundId, 'readOnly'=>$readOnly]),
                'fundsManageReport'=>url('index/ChangeLogs/index', ['category'=>\app\index\logic\ChangeLogs::CHANGE_LOG_FUND_MANAGE_REPORT_CATEGORY, 'externalId'=>$fundId, 'readOnly'=>$readOnly]),
                'financeReport'=>url('index/ChangeLogs/index', ['category'=>\app\index\logic\ChangeLogs::CHANGE_LOG_FUND_MANAGE_FINANCE_REPORT_CATEGORY, 'externalId'=>$fundId, 'readOnly'=>$readOnly]),
                'valuationReport'=>url('index/ChangeLogs/index', ['category'=>\app\index\logic\ChangeLogs::CHANGE_LOG_FUND_MANAGE_VALUATION_REPORT_CATEGORY, 'externalId'=>$fundId, 'readOnly'=>$readOnly])
            ];
            $this->assign('urlHrefs', $urlHrefs);
            $this->assign('readOnly', $readOnly);
            $fundsManageBusinessCount = Db::table('change_logs')->where(['external_id'=>$fundId, 'category'=>\app\index\logic\ChangeLogs::CHANGE_LOG_FUND_MANAGE_BUSINESS_CATEGORY])->count();
            $fundsManageTaxCount = Db::table('change_logs')->where(['external_id'=>$fundId, 'category'=>\app\index\logic\ChangeLogs::CHANGE_LOG_FUND_MANAGE_TAX_CATEGORY])->count();
            $fundsManageFilingCount = Db::table('change_logs')->where(['external_id'=>$fundId, 'category'=>\app\index\logic\ChangeLogs::CHANGE_LOG_FUND_MANAGE_FILING_CATEGORY])->count();
            $fundsManageReportCount = Db::table('change_logs')->where(['external_id'=>$fundId, 'category'=>\app\index\logic\ChangeLogs::CHANGE_LOG_FUND_MANAGE_REPORT_CATEGORY])->count();
            $financeReportCount = Db::table('change_logs')->where(['external_id'=>$fundId, 'category'=>\app\index\logic\ChangeLogs::CHANGE_LOG_FUND_MANAGE_FINANCE_REPORT_CATEGORY])->count();
            $valuationReportCount = Db::table('change_logs')->where(['external_id'=>$fundId, 'category'=>\app\index\logic\ChangeLogs::CHANGE_LOG_FUND_MANAGE_VALUATION_REPORT_CATEGORY])->count();
            $this->assign([
                'fundsManageBusinessCount'=>$fundsManageBusinessCount,
                'fundsManageTaxCount'=>$fundsManageTaxCount,
                'fundsManageFilingCount'=>$fundsManageFilingCount,
                'fundsManageReportCount'=>$fundsManageReportCount,
                'financeReportCount'=>$financeReportCount,
                'valuationReportCount'=>$valuationReportCount
            ]);
            return $this->fetch();
        }
    }
    /******************************************************************************************************************/
}