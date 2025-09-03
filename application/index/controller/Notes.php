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
use app\index\logic\Admins;
use app\index\logic\Note;
use app\index\model\Notes as NoteModel;

class Notes extends  Common
{
    public function index($category, $search=[], $page=1, $rows=DEFAULT_PAGE_ROWS){
        if ($this->request->isGet()) {
            $this->assign('urls',[
                'edit'=>url('index/notes/edit',['category'=>$category]),
                'delete'=>url('index/notes/delete')
            ]);
            return $this->fetch();
        }
        $search['category'] = $category;
        $data = Note::I()->search($search, $page, $rows);
        if (!empty($data['total'])) {
            $data['users'] = Admins::I()->getAllUsers();
        }
        return json($data);
    }

    public function edit($id=0,$category=0){
        if ($this->request->isGet()) {
            $this->assign('row', $id ? NoteModel::get($id) : []);
            return $this->fetch();
        }
        $data = input('post.data/a');
        $model = new NoteModel();
        if ($id) {
            $model->allowField(true)->save($data,['id'=>$id]);
        } else {
            $data['category'] = $category;
            $data['created_by'] = $this->loginUserId;
            $model->allowField(true)->save($data);
        }
        return ajaxSuccess('保存成功');
    }

    public function delete($id){
        try {
            NoteModel::destroy($id);
        } catch (\Exception $e) {
            return ajaxError($e->getMessage());
        }
        return ajaxSuccess('删除成功');
    }
}