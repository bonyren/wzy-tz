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

use app\index\logic\Upload;
use think\Db;
use think\Log;
use app\index\logic\Admins as AdminsLogic;

class Companies extends Common
{
    public function index($search=[],$page=1, $rows=DEFAULT_PAGE_ROWS){
        if($this->request->isGet()){
            return $this->fetch();
        }
        $where = [];
        if(!emptyInArray($search, 'name')){
            $where['name'] = ['like',"%{$search['name']}%"];
        }
        $total = Db::table('companies')->where($where)->count();
        if (empty($total)) {
            return json([]);
        }
        $rows = Db::table('companies')->field('id,name,controller,introduction,assigner')
            ->where($where)
            ->page($page, $rows)
            ->order('id desc')
            ->select();
        return json([
            'total'=>$total,
            'rows'=>$rows,
            'users'=>AdminsLogic::I()->getAllUsers()
        ]);
    }
    public function add($id=0){
        if($this->request->isPost()){
            $data = input('post.data/a');
            if (empty($data['established_date'])) {
                $data['established_date'] = null;
            }
            if (empty($data['listed_date'])) {
                $data['listed_date'] = null;
            }
            if ($id) {
                Db::table('companies')->where(['id'=>$id])->update($data);
            } else {
                $data['created_by'] = $this->loginUserId;
                $id = Db::table('companies')->insertGetId($data);
                if ($_POST['pending_files']) {
                    Upload::I()->relateAttaches($_POST['pending_files'],$id);
                }
            }
            return ajaxSuccess('保存成功');
        }
        if ($id) {
            //修改
            $data = Db::table('companies')->where(['id'=>$id])->find();
        }else {
            //新增
            $data = [];
        }
        $this->assign('id',intval($id));
        $this->assign('data',$data);
        $this->assign('grid',$_GET['grid']);
        return $this->fetch();
    }

    public function view($id) {
        $data = Db::table('companies')->where(['id'=>$id])->find();
        $this->assign('data',$data);
        return $this->fetch();
    }

    public function remove($id) {
        Db::table('companies')->where(['id'=>$id])->delete();
        return ajaxSuccess('操作成功');
    }
}