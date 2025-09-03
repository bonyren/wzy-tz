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

use app\index\logic\Industry;
use app\index\logic\Knowledges as KnowledgesLogic;

class Knowledges extends Common
{
    public function index($search=[],$page=1,$rows=DEFAULT_PAGE_ROWS)
    {
        if($this->request->isGet()){
            $urls = [
                'list'=>url('index/Knowledges/index'),
                'attaches'=>url('index/Upload/viewAttaches', ['attachmentType'=>\app\index\logic\Upload::ATTACH_KNOWLEDGE, 'uiStyle'=>Upload::ATTACHES_UI_TABLE_STYLE]),
                'edit'=>url('index/Knowledges/edit'),
                'delete'=>url('index/Knowledges/delete'),
            ];
            $this->assign('urls', $urls);
            return $this->fetch();
        }

        $data = KnowledgesLogic::I()->load($search,$page,$rows);

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
            $row = KnowledgesLogic::I()->getRow($id);
            if(!$row){
                $row = KnowledgesLogic::I()->getDefaultRow();
            }
            $this->assign('row', $row);
            return $this->fetch();
        }
        $data = input('post.');
        $data = $data['data'];
        try {
            KnowledgesLogic::I()->saveRow($id, $data);
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
            KnowledgesLogic::I()->delete($id);
        } catch (\Exception $e) {
            return ajaxError($e->getMessage());
        }
        return ajaxSuccess('删除成功');
    }

}