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
use app\index\logic\Dashboard as DashboardLogic;

class Dashboard extends Common{
	public function dashboard() {
        $dashboardLogic = DashboardLogic::newObj();
        $bindValues = [
            'statistic'=>$dashboardLogic->loadStatistic()
        ];
        $this->assign('bindValues', $bindValues);
        return $this->fetch();
    }
	public function fundLatest(){
		if(request()->isGet()){
			$urlHrefs = [
				'fundLatest'=>url('index/Dashboard/fundLatest')
			];
			$this->assign('urlHrefs', $urlHrefs);
			return $this->fetch();
		}
		$dashboardLogic = \app\index\logic\Dashboard::newObj();
		return json($dashboardLogic->loadFundLatest());
	}
	public function enterpriseLatest(){
		if(request()->isGet()){
			$urlHrefs = [
				'enterpriseLatest'=>url('index/Dashboard/enterpriseLatest')
			];
			$this->assign('urlHrefs', $urlHrefs);
			return $this->fetch();
		}
		$dashboardLogic = \app\index\logic\Dashboard::newObj();
		return json($dashboardLogic->loadEnterpriseLatest());
	}
}
?>