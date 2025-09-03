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
use think\Db;

class EnterpriseInvest extends Common
{
    //参与项目投资的基金列表
    public function joinedFunds($enterprise_id,$investment_id='',$readonly=1,$style='')
    {
        if($this->request->isPost()){
            $where['fe.enterprise_id'] = $enterprise_id;
            if ($investment_id) {
                $where['fe.investment_id'] = $investment_id;
            }
            $rows = Db::table('funds_enterprises')->alias('fe')
                ->join('funds f', 'f.fund_id=fe.fund_id')
                ->join('funds_finance_enterprises ffe', 'ffe.ffe_id=fe.ffe_id')
                ->field('fe.*,ffe.amount,f.name,f.size')
                ->where($where)
                ->order('fe.date_delivery desc,fe.id desc')->select();
            return json(['rows'=>$rows]);
        }
        $tpl = 'joined_funds';
        if ($style) {
            $tpl .= '_' . $style;
        }
        return $this->fetch($tpl,[
            'enterprise_id'=>$enterprise_id,
            'investment_id'=>$investment_id,
            'readonly'=>$readonly,
        ]);
    }

    //投后概览主页
    public function investedOverview($enterprise_id)
    {
        $this->assign('urls',[
            'timeline' => url('EnterpriseInvest/timeline',['enterprise_id'=>$enterprise_id]),
            'funds' => url('EnterpriseInvest/joinedFunds',['enterprise_id'=>$enterprise_id,'style'=>'light']),
        ]);
        return $this->fetch();
    }

    //投后概览时间轴
    public function timeline($enterprise_id)
    {
        $data = [];
        $rows = Db::table('meetings')->field('type,date_start')
            ->where(['relate_id'=>$enterprise_id])
            ->order('id DESC')->column('date_start','type');
        if ($rows[2]) {
            $time = substr($rows[2],0,10);
            $data[] = ['label'=>$time, 'name'=>'立项', 'time'=>$time];
        }
        if ($rows[3]) {
            $time = substr($rows[3],0,10);
            $data[] = ['label'=>$time, 'name'=>'投决', 'time'=>$time];
        }
        $date_delivery = Db::table('funds_enterprises')->where(['enterprise_id'=>$enterprise_id])
            ->order('id ASC')->limit(1)->value('date_delivery');
        if ($date_delivery) {
            $data[] = ['label'=>$date_delivery, 'name'=>'交割', 'time'=>$date_delivery];
        }
        $rows = Db::table('progress_logs')->field('category,entered,entry,admin_id')
            ->where(['external_id'=>$enterprise_id,'category'=>['in','3,5,6'],'show_timeline'=>1])
            ->order('progress_log_id ASC')->select();
        if ($rows) {
            $admins = \app\index\logic\Admins::I()->getAllUsers();
            foreach ($rows as $v) {
                $time = substr($v['entered'],0,10);
                $data[] = [
                    'name'=>\app\index\logic\ProgressLogs::$progressLogCategoryDefs[$v['category']],
                    'label'=> substr($v['entered'],0,16) .'，'.$admins[$v['admin_id']]['realname'] .'：<br>'. $v['entry'],
                    'time' => $time
                ];
            }
        }
        if ($data) {
//            $times = array_column($data,'time');
//            array_multisort($times, SORT_ASC, $data);
//            $data = array_merge($data,$data);
        }
        foreach ($data as $k=>$v) {
            $data[$k]['name'] = ($k+1) .'.'. $v['name'];
            $data[$k]['description'] = $v['label'];
            if (50 < mb_strlen($v['label'],'utf-8')) {
                $data[$k]['label'] = mb_substr($v['label'],0,50) . '...';
            }
        }
        $this->assign('bind',[
            'chart_data' => $data,
            'enterprise' => Enterprise::I()->getEnterprise($enterprise_id),
        ]);
        return $this->fetch();
    }
}