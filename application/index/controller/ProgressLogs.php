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
use think\Db;
use app\common\CommonDefs;
use app\index\logic\ProgressLogs as ProgressLogsLogic;
use app\index\logic\Upload as UploadLogic;

class ProgressLogs extends  Common{
    public function index($search=[],
                          $page=1,
                          $rows=DEFAULT_PAGE_ROWS,
                          $sort='progress_log_id',
                          $order='desc',
                          $category=ProgressLogsLogic::PROGRESS_LOG_ALL_CATEGORY,
                          $externalId=0,
                          $readOnly=0,
                          $src=CommonDefs::MODULE_ADMIN)
    {
        if (request()->isPost()) {
            $search['src'] = $src;
            $progressLogsLogic = ProgressLogsLogic::newObj();
            return json($progressLogsLogic->load($search, $page, $rows, $sort, $order, $category, $externalId));
        }

        $uniqid = generateUniqid();
        $urlHrefs = [
            'index'=>url('index/ProgressLogs/index', ['category'=>$category,'externalId'=>$externalId,'src'=>$src]),
            'add'=>url('index/ProgressLogs/add', ['category'=>$category,'externalId'=>$externalId,'src'=>$src]),
            'delete'=>url('index/ProgressLogs/delete'),
            'attachments'=>url('index/Upload/attaches', [
                'src'=>$src,
                'attachmentType'=>UploadLogic::ATTACH_PROGRESS_LOGS,
                'externalId'=>0,
                'uiStyle'=>\app\index\controller\Upload::ATTACHES_UI_LIGHT_STYLE,
                'callback'=>'progressLogsModule_' . $uniqid . '.onAttachmentsUploaded'
            ])
        ];
        $this->assign('urlHrefs', $urlHrefs);
        $this->assign('uniqid', $uniqid);
        $this->assign('readOnly', $readOnly);
        $this->assign('category', $category);
        $this->assign('src', $src);
        $bindValues = [
            'curDate'=>date('Y-m-d'),
        ];
        $this->assign('bindValues', $bindValues);
        return $this->fetch();
    }
    public function light($search=[],
                          $page=1,
                          $rows=DEFAULT_PAGE_ROWS,
                          $sort='progress_log_id',
                          $order='desc',
                          $category=ProgressLogsLogic::PROGRESS_LOG_ALL_CATEGORY,
                          $externalId=0,
                          $readOnly=0,
                          $src=CommonDefs::MODULE_ADMIN)
    {
        $uniqid = generateUniqid();
        $urlHrefs = [
            'index'=>url('index/ProgressLogs/index', ['category'=>$category,'externalId'=>$externalId,'src'=>$src]),
            'add'=>url('index/ProgressLogs/add', ['category'=>$category,'externalId'=>$externalId,'src'=>$src]),
            'delete'=>url('index/ProgressLogs/delete'),
        ];
        $this->assign('category', $category);
        $this->assign('src', $src);
        $this->assign('urlHrefs', $urlHrefs);
        $this->assign('uniqid', $uniqid);
        $this->assign('readOnly', $readOnly);
        return $this->fetch();
    }

    public function add($category, $externalId, $src=CommonDefs::MODULE_ADMIN)
    {
        if($this->request->isPost()){
            $infos = input('post.infos/a');
            $infos['src'] = $src;
            $progressLogsLogic = ProgressLogsLogic::newObj();
            $result = $progressLogsLogic->add($category, $externalId, $infos);
            if($result){
                return ajaxSuccess('成功');
            }else{
                return ajaxError('失败');
            }
        }
        $uniqid = generateUniqid();
        $this->assign('uniqid', $uniqid);
        $urlHrefs = [
            'attachments'=>url('index/Upload/attaches', ['attachmentType'=>UploadLogic::ATTACH_PROGRESS_LOGS,
                'src'=>$src,
                'externalId'=>0,
                'uiStyle'=>\app\index\controller\Upload::ATTACHES_UI_LIGHT_STYLE,
                'callback'=> JVAR . '.onAttachmentsUploaded'
            ])
        ];
        $subtypes = array_filter(ProgressLogsLogic::$subtypes,function($v)use($category){
            if ($v['category'] == $category) {
                return true;
            }
        });
        $this->assign('urlHrefs', $urlHrefs);
        $this->assign('category', $category);
        $this->assign('src', $src);
        $this->assign('subtypes', $subtypes);
        $bindValues = [
            'curDate'=>date('Y-m-d')
        ];
        $this->assign('bindValues', $bindValues);
        return $this->fetch();
    }

    public function edit($id, $src=CommonDefs::MODULE_ADMIN) {
        if ($this->request->isPost()) {
            $data = input('post.infos/a');
            $data['extras'] = empty($data['extras']) ? '' : json_encode($data['extras'],JSON_UNESCAPED_UNICODE);
            Db::table('progress_logs')->where('progress_log_id',$id)->update($data);
            return ajaxSuccess('修改成功');
        }
        $row = ProgressLogsLogic::I()->get($id);
        $category = $row['category'];
        $subtypes = array_filter(ProgressLogsLogic::$subtypes,function($v)use($category){
            if ($v['category'] == $category) {
                return true;
            }
        });
        $this->assign('row', $row);
        $this->assign('subtypes', $subtypes);
        $this->assign('attachment_url', url('index/Upload/attaches', [
            'src'=>$src,
            'attachmentType'=>UploadLogic::ATTACH_PROGRESS_LOGS,
            'externalId'=>$id,
            'uiStyle'=>\app\index\controller\Upload::ATTACHES_UI_LIGHT_STYLE
        ]));
        return $this->fetch();
    }

    public function view($id)
    {
        $row = ProgressLogsLogic::I()->get($id);
        $this->assign('row', $row);
        $this->assign('attachment_url', url('index/Upload/viewAttaches', [
            'attachmentType'=>UploadLogic::ATTACH_PROGRESS_LOGS,
            'externalId'=>$id,
            'uiStyle'=>\app\index\controller\Upload::ATTACHES_UI_LINK_STYLE
        ]));
        return $this->fetch();
    }

    public function delete($progressLogId){
        $progressLogsLogic = ProgressLogsLogic::newObj();
        $result = $progressLogsLogic->delete($progressLogId);
        if($result){
            return ajaxSuccess('成功');
        }else{
            return ajaxError('失败');
        }
    }
}