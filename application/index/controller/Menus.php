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

use app\index\controller\Common;
use app\index\logic\Admins;
use \app\index\logic\Menu;

class Menus extends Common
{
    public function index($search=[],$page=1,$rows=20)
    {
        if($this->request->isGet()){
            $urls = [
                'list'=>url('index/Menus/index'),
                'edit'=>url('index/Menus/edit'),
                'delete'=>url('index/Menus/delete'),
            ];
            $this->assign('urls', $urls);
            return $this->fetch();
        }

        $menus = [];
        if (isset($_GET['show_empty'])) {
            $menus[] = ['id'=>0, 'text'=>''];
        }
        Admins::I()->loadLeftMenuRecursively(0, '', $menus);
        return json($menus);
    }

    //添加/编辑
    public function edit($id=0,$pid=0)
    {
        if ($this->request->isPost()) {
            //自定义filter function, 不使用默认htmlspecialchars, 防止将&转为&amp;
            $data = input('post.', null, 'trim');
            $data = $data['data'];
            try {
                Menu::I()->save($id, $data);
                return ajaxSuccess('保存成功');
            } catch (\Exception $e) {
                return ajaxError($e->getMessage());
            }
        }

        $row = [];
        if ($id) {
            $row = Menu::I()->getRow($id);
        } else {
            $row['pid'] = intval($pid);
        }
        $this->assign('row', $row);
        $this->assign('tree_data_url', url('index/Menus/index','show_empty=1'));
        return $this->fetch();
    }

    //删除
    public function delete($id)
    {
        try {
            Menu::I()->delete($id);
        } catch (\Exception $e) {
            return ajaxError($e->getMessage());
        }
        return ajaxSuccess('删除成功');
    }


}