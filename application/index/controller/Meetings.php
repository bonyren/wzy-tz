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

use app\index\logic\Extra;
use app\index\logic\Meeting;
use app\index\logic\Enterprise as EnterpriseLogic;
use think\Log;

class Meetings extends Common{
    /**
     * 列表
     */
    public function index($search = [], 
        $page = 1, 
        $rows = DEFAULT_PAGE_ROWS,
        $sort='m.id',
        $order='desc',
        $filters = [],
        $readOnly=0
        ){
        if ($this->request->isGet()) {
            $bind = [
                'urls' => [
                    'list' => url('index/Meetings/index', ['filters'=>$filters]),
                ]
            ];
            $this->assign('bind', $bind);
            $this->assign('readOnly', $readOnly);
            return $this->fetch();
        }
        Log::notice("meeting index " . var_export($filters, true));
        $data = Meeting::I()->load($search, $page, $rows, $sort, $order, $filters);
        return json($data);
    }
    /**
     * 反馈
     */
    public function feedback($meeting_id){
        if($this->request->isGet()){
            $meeting = Meeting::I()->getMeeting($meeting_id);
            if(empty($meeting)){
                return $this->fetch('common/missing');
            }
            $enterprise = EnterpriseLogic::I()->getEnterprise($meeting['relate_id']);
            if(empty($enterprise)){
                return $this->fetch('common/missing');
            }
            $meeting['relate_item'] = $enterprise['name'];
            $principle = $enterprise['extra']['principle'];
            $this->assign([
                'meeting'=>$meeting,
                'principle'=>$principle,
                'urls'=>[
                    'feedback'=>url('index/Meetings/feedback', ['meeting_id'=>$meeting_id])
                ]
            ]);
            return $this->fetch();
        }
        $formData = input('post.formData/a');
        Meeting::I()->feedbackMeeting($meeting_id, $formData);
        return ajaxSuccess('反馈成功');
    }
    public function view($meeting_id){
        $meeting = Meeting::I()->getMeeting($meeting_id);
        if(empty($meeting)){
            return $this->fetch('common/missing');
        }
        $enterprise = EnterpriseLogic::I()->getEnterprise($meeting['relate_id']);
        if(empty($enterprise)){
            return $this->fetch('common/missing');
        }
        $meeting['relate_item'] = $enterprise['name'];
        $principle = $enterprise['extra']['principle'];
        $this->assign('readonly',true);
        $this->assign('meeting',$meeting);
        $this->assign('principle', $principle);
        return $this->fetch();
    }

}