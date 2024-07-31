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
namespace app\lp\controller;
use app\index\logic\Contact;
use app\index\logic\Enterprise;
use think\Db;
use app\index\logic\ChangeLogs;
use app\index\logic\Upload;

class Funds extends Base
{
    public function index($project_id=0)
    {
        $funds = Db::table('funds_partners')->alias('fp')
            ->join('funds f','f.fund_id=fp.fund_id')
            ->field('fp.amount,fp.status as fp_status,f.fund_id,f.name,f.size,f.status')
            ->where(['fp.p_id'=>$this->lp_id])
            ->order('fp.fp_id desc')
            ->select();
        $invested = [];
        if ($funds) {
            $funds_id = array_column($funds,'fund_id');
            $projects = Db::table('funds_enterprises')
                ->field('fund_id,enterprise_id')
                ->where('fund_id','in',$funds_id)
                ->select();
            if ($projects) {
                foreach ($projects as $v) {
                    if(!$invested[$v['fund_id']]) {
                        $invested[$v['fund_id']] = ['total'=>0,'projects_id'=>[]];
                    }
                    $invested[$v['fund_id']]['total']++;
                    $invested[$v['fund_id']]['projects_id'][] = $v['enterprise_id'];
                }
            }
        } else {
            $funds = [];
        }
        $this->assign(['funds'=>$funds, 'invested'=>$invested, 'project_id'=>$project_id]);
        return $this->fetch();
    }

    public function fundDetail($fund_id)
    {
        $fund = Db::table('funds')->where(['fund_id'=>$fund_id])->find();
        if(empty($fund)){
            return $this->fetch('common/invalidRequest');
        }
        //基金年度报告
        $reports = Db::table('change_logs')->where(['external_id'=>$fund_id, 'category'=>ChangeLogs::CHANGE_LOG_FUND_MANAGE_REPORT_CATEGORY])
            ->field('id, from_date, end_date, desc')->select();
        foreach($reports as &$report){
            $reportId = $report['id'];
            $files = Db::table('attachments')->where(['external_id'=>$reportId, 'attachment_type'=>Upload::ATTACH_FUND_CHANGE_LOGS])
                ->field('attachment_id, original_name, save_name')->select();
            $report['files'] = $files;
        }
        $fund['reports'] = $reports;
        $this->assign(['fund'=>$fund]);
        return $this->fetch();
    }

    public function projects($fund_id=0)
    {
        if ($fund_id) {
            $where['fe.fund_id'] = $fund_id;
        } else {
            $funds_id = Db::table('funds_partners')->where(['p_id'=>$this->lp_id])->column('fund_id');
            if (empty($funds_id)) {
                $this->assign(['projects'=>[]]);
                return $this->fetch();
            }
            $where['fe.fund_id'] = ['in',$funds_id];
        }
        $rows = Db::table('funds_enterprises')->alias('fe')
            ->join('enterprises e','e.id=fe.enterprise_id')
            ->join('funds_finance_enterprises ffe','ffe.ffe_id=fe.ffe_id')
            ->field('count(*) as funds_count,fe.enterprise_id,sum(fe.stock_ratio_new) as stock_ratio,sum(fe.stock_total) as stock_total,sum(ffe.amount) as amount,e.name')
            ->where($where)
            ->group('fe.enterprise_id')
            ->order('fe.id desc')
            ->select();
        $this->assign(['projects'=>$rows,'fund_id'=>$fund_id]);
        return $this->fetch();
    }

    //潜在合伙人项目
    public function projectsLatent()
    {
        $ids = Db::table('partners')->where('p_id',$this->lp_id)->value('enterprises');
        $rows = Db::table('enterprises')->alias('e')
            ->join('funds_finance_enterprises ffe','ffe.enterprise_id=e.id','left')
            ->field('e.id,e.name,ffe.ffe_id,sum(ffe.amount) as amount')
            ->where('e.id','in',$ids)
            ->group('e.id')
            ->order('id desc')
            ->select();
        $this->assign(['projects'=>$rows]);
        return $this->fetch();
    }

    public function projectDetail($project_id)
    {
        $project = Enterprise::I()->getEnterprise($project_id);
        $founder = Contact::I()->getContact($project['founder']);
        $this->assign(['project'=>$project,'founder'=>$founder]);
        return $this->fetch();
    }


    //pc端 - 基金报告列表
    public function reports_list($search=[],$page=1,$rows=DEFAULT_PAGE_ROWS)
    {
        if($this->request->isGet()){
            return $this->fetch();
        }
        $search['p_id'] = $this->lp_id;
        $data = \app\index\logic\Funds::I()->load($search,$page,$rows);
        return json($data);
    }
}