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
use app\index\service\Authorize;
use think\Controller;
use think\Log;
use think\Debug;
use think\Request;
use think\Db;
use app\common\CommonDefs;

class AdminRole extends Common
{
    public function adminRole($search=[],$page=1,$rows=DEFAULT_PAGE_ROWS,$sort='role_id',$order='desc'){
        if(request()->isGet()){
            $urlHrefs = [
                'adminRole'=>url('index/AdminRole/adminRole'),
                'add'=>url('index/AdminRole/add'),
                'edit'=>url('index/AdminRole/edit'),
                'delete'=>url('index/AdminRole/delete'),
                'authorize'=>url('index/AdminRole/authorize')
            ];
            $this->assign('urlHrefs', $urlHrefs);
            return $this->fetch();
        }

        $limit = ($page - 1) * $rows . "," . $rows;
        if($sort == 'role_id'){
            $order = 'role_id ' . $order;
        }else{
            $order = 'role_id desc';
        }

        $totalCount = Db::table('admin_role')->count();
        $records = Db::table('admin_role')->order($order)->limit($limit)->field(true)->select();
        return json([
            'total'=>$totalCount,
            'rows'=>$records
        ]);
    }
    public function add(){
        if(request()->isGet()){
            return $this->fetch();
        }
        $infos = input('post.infos/a');
        Db::table('admin_role')->insert($infos);
        return ajaxSuccess('成功');
    }
    public function edit($roleId){
        if(request()->isGet()){
            $infos = Db::table('admin_role')->where('role_id', $roleId)->field(true)->find();
            if(!$infos){
                return $this->fetch('common/error');
            }
            $bindValues = [
                'infos'=>$infos
            ];
            $this->assign('bindValues', $bindValues);
            return $this->fetch();
        }
        $infos = input('post.infos/a');
        Db::table('admin_role')->where('role_id', $roleId)->update($infos);
        return ajaxSuccess('成功');
    }
    public function delete($roleId){
        Db::table('admin_role')->where('role_id', $roleId)->delete();
        return ajaxSuccess('成功');
    }
    public function authorize($roleId){
        if(request()->isGet()){
            $urlHrefs = [
                'roleNodes'=>url('index/AdminRole/roleAuthTreeNodes', ['roleId'=>$roleId])
            ];
            $this->assign('urlHrefs', $urlHrefs);
            $infos = Db::table('admin_role')->where('role_id', $roleId)->field(true)->find();
            if(!$infos){
                return $this->fetch('common/error');
            }
            $bindValues = [
                'infos'=>$infos
            ];
            $this->assign('bindValues', $bindValues);
            return $this->fetch();
        }
        \app\index\service\Authorize::I()->editRoleAuth($roleId,input('post.'));
        return ajaxSuccess('成功');
    }
    protected function loadLeftMenuRecursively($roleId, $pid, &$nodes){
        $rows = Db::table('menu')->where(array('pid'=>$pid))->field("id,pid,level,name,icon_cls,c,a,params")->order('order_id ASC')->select();
        if(empty($rows)){
            return;
        }
        foreach ($rows as $key => $value) {
            $id = $value['id'];

            $node = array();
            $node['id'] = $id;
            $node['name'] = $value['name'];
            $node['text'] = $value['name'];
            $node['iconCls'] = $value['icon_cls'];

            $subNodes = array();
            $this->loadLeftMenuRecursively($roleId, $id, $subNodes);
            if(!empty($subNodes)){
                $node['children'] = $subNodes;
            }else{
                $roleMenu = \app\index\service\Authorize::I()->check($roleId, $id);
                $node['id'] = '';
                if($roleMenu) {
                    $finalNode = array(
                        array('id'=>$id.'_'.CommonDefs::AUTHORIZE_READ_ONLY_TYPE,'text'=>'只读','iconCls'=>'fa fa-eye','checked'=>$roleMenu['type']==CommonDefs::AUTHORIZE_READ_ONLY_TYPE?true:false),
                        array('id'=>$id.'_'.CommonDefs::AUTHORIZE_READ_WRITE_TYPE,'text'=>'读写','iconCls'=>'fa fa-pencil','checked'=>$roleMenu['type']==CommonDefs::AUTHORIZE_READ_WRITE_TYPE?true:false),
                        array('id'=>$id.'_'.CommonDefs::AUTHORIZE_LIST_ONLY_TYPE,'text'=>'列表','iconCls'=>'fa fa-list-ul','checked'=>$roleMenu['type']==CommonDefs::AUTHORIZE_LIST_ONLY_TYPE?true:false)
                    );
                    $node['children'] = $finalNode;
                }else{
                    $node['children'] = array(
                        array('id'=>$id.'_'.CommonDefs::AUTHORIZE_READ_ONLY_TYPE,'text'=>'只读','iconCls'=>'fa fa-eye'),
                        array('id'=>$id.'_'.CommonDefs::AUTHORIZE_READ_WRITE_TYPE,'text'=>'读写','iconCls'=>'fa fa-pencil'),
                        array('id'=>$id.'_'.CommonDefs::AUTHORIZE_LIST_ONLY_TYPE,'text'=>'列表','iconCls'=>'fa fa-list-ul')
                    );
                }
            }
            $nodes[] = $node;
        }
    }
    public function roleAuthTreeNodes($roleId){
        $nodes = array();
        $this->loadLeftMenuRecursively($roleId, 0, $nodes);
        $returnRows = [['id'=>'0', 'text'=>'根节点', 'iconCls'=>'fa fa-navicon', 'children'=>$nodes]];
        return json($returnRows);
    }
}