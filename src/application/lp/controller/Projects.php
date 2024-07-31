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
namespace app\lp\controller;
use app\index\logic\Enterprise;
use think\Db;

class Projects extends Base
{
    public function index($search=[],$page=1,$rows=DEFAULT_PAGE_ROWS)
    {
        if($this->request->isGet()){
            return $this->fetch();
        }
        $ids = $this->getMyProjectsId();
        if (empty($ids)) {
            return '[]';
        }
        $map['where']['e.id'] = ['in',$ids];
        $data = Enterprise::I()->load($search,$page,$rows,$map);
        if (empty($data)){
            return '[]';
        }
        $assigners = '';
        $founders = [];
        foreach ($data['rows'] as $k=>$v) {
            $assigners .= (empty($assigners) ? '' : ',') . $v['assigner'];
            if ($v['founder']) {
                $founders[$v['founder']] = $v['founder'];
            }
            $data['rows'][$k]['editable'] = false;
        }
        $data['founders'] = [];
        $data['assigners'] = [];
        if (!empty($founders)) {
            $data['founders'] = \app\index\model\Contacts::where('id', 'in', $founders)->column('id,name,title', 'id');
        }
        if (!empty($assigners)) {
            $data['assigners'] = \app\index\logic\Admins::I()->getAdminsByIds($assigners);
        }
        return json($data);
    }

    public function getMyProjectsId()
    {
        return Db::table('partners')->where('p_id',$this->lp_id)->value('enterprises');
    }
}