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
use app\index\logic\Industry;
use think\Db;

class Industries extends Common
{
    public function index($search=[],$page=1,$rows=DEFAULT_PAGE_ROWS)
    {
        if($this->request->isGet()){
            $urls = [
                'list'=>url('index/Industries/index'),
                'attaches'=>url('index/Upload/viewAttaches', ['attachmentType'=>2, 'uiStyle'=>Upload::ATTACHES_UI_TABLE_STYLE]),
                'edit'=>url('index/Industries/edit'),
                'delete'=>url('index/Industries/delete'),
            ];
            $this->assign('urls', $urls);
            return $this->fetch();
        }

        $data = Industry::I()->load($search,$page,$rows);

        return json($data);
    }

    /**
     * 添加/编辑企业
     * @param int $id
     * @return mixed
     */
    public function edit($id=0)
    {
        if ($this->request->isGet()) {
            $row = Industry::I()->getRow($id);
            if(!$row){
                $row = Industry::I()->getDefaultRow();
            }
            $this->assign('row', $row);
            return $this->fetch();
        }
        $data = input('post.');
        $data = $data['data'];
        try {
            Industry::I()->saveRow($id, $data);
        } catch (\Exception $e) {
            return ajaxError($e->getMessage());
        }
        return ajaxSuccess('保存成功');
    }

    /**
     * 删除
     * @param $id
     * @return \think\response\Json
     */
    public function delete($id)
    {
        try {
            Industry::I()->delete($id);
        } catch (\Exception $e) {
            return ajaxError($e->getMessage());
        }
        return ajaxSuccess('删除成功');
    }

    public function attachments($record_id, $attach_type, $read_only=0){
        if($read_only) {
            $attachesUrl = url('index/Upload/viewAttaches', ['attachmentType'=>$attach_type, 'externalId'=>$record_id,'uiStyle'=>Upload::ATTACHES_UI_LIGHT_STYLE]);
        }else{
            $attachesUrl = url('index/Upload/attaches', ['attachmentType'=>$attach_type, 'externalId'=>$record_id,'uiStyle'=>Upload::ATTACHES_UI_LIGHT_STYLE]);
        }
        $urls = [
            'attachments'=>$attachesUrl
        ];
        $this->assign('urls', $urls);
        $this->assign('attachmentType', $attach_type);
        $this->assign('externalId', $record_id);
        return $this->fetch();
    }


    public function graphs($search=[],$page=1,$rows=DEFAULT_PAGE_ROWS)
    {
        if($this->request->isGet()){
            return $this->fetch();
        }
        $data = ['total'=>0,'rows'=>[]];
        $where = ['deleted'=>0];
        $total = Db::table('industry_graphs')->where($where)->count();
        if (empty($total)) {
            return json($data);
        }
        $data['total'] = $total;
        $data['rows'] = Db::table('industry_graphs')
            ->field('id,name,date_entered')->where($where)->select();
        return json($data);
    }

    public function viewGraph($id)
    {
        $row = Db::table('industry_graphs')->where('id',$id)->find();
        $rows = Db::table('enterprises')->field('id,name')->where('step','egt',3)->select();
        $data = [];
        foreach ($rows as $v) {
            $data[] = [
                'x' => mt_rand(50,100),
                'y' => mt_rand(50,100),
                'z' => mt_rand(10,40),
                'name' => $v['name'],
                'full_name' => $v['name'],
            ];
        }
        $this->assign('row', $row);
        $this->assign('data', json_encode($data,JSON_UNESCAPED_UNICODE));
        return $this->fetch();
    }

    public function editGraph($id=0)
    {
        if ($this->request->isGet()) {
            $row = Db::table('industry_graphs')->where('id',$id)->find();
            $this->assign('row', $row);
            return $this->fetch();
        }
        $data = input('post.data/a');
        try {
            if ($id) {
                $data['created_by'] = $this->loginUserId;
                Db::table('industry_graphs')->where('id',$id)->update($data);
            } else {
                Db::table('industry_graphs')->insert($data);
            }
        } catch (\Exception $e) {
            return ajaxError($e->getMessage());
        }
        return ajaxSuccess('保存成功');
    }

    public function deleteGraph($id)
    {
        Db::table('industry_graphs')->where('id',$id)->setField('deleted',1);
        return ajaxSuccess('删除成功');
    }

}