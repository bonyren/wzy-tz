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

class Milestones extends Common
{
    public function index($category, $recordId){
        $milestones = [];
        $records = \app\index\logic\Milestones::newObj()->load($category, $recordId);
        foreach($records as $record){
            $milestones[] = [
                'name'=>$record['desc'],
                'label' => $record['occur_date'],
                'description' => $record['desc']
            ];
        }
        if($category == \app\index\model\Milestones::MILESTONE_FUND_CATEGORY) {
            $fundInfos = \app\index\logic\Funds::newObj()->getFundInfos($recordId);
            if (!$fundInfos) {
                return $this->fetch('common/error');
            }
            $milestones[] = [
                'name'=>'基金成立',
                'label' => $fundInfos['establish_date'],
                'description' => '注册地：' . $fundInfos['reg_place']
            ];
            $title = $fundInfos['name'];
        }
        //按照时间排序
        $labels = array_column($milestones,'label');
        array_multisort($labels, SORT_ASC, $milestones);

        $this->assign('uniqid', generateUniqid());
        $this->assign('title', $title);
        $this->assign('milestones', $milestones);
        return $this->fetch();
    }
}