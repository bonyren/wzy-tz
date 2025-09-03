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
use app\index\logic\SubIndustryLogic;
use think\Db;

class SubIndustry extends Common
{
    public function index($search=[],$page=1,$rows=DEFAULT_PAGE_ROWS)
    {
        if($this->request->isGet()){
            return $this->fetch();
        }
        $data = SubIndustryLogic::I()->load($search,$page,$rows);
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
            if (empty($id)) {
                return $this->fetch('add');
            } else {
                $row = SubIndustryLogic::I()->getRow($id);
                $this->assign('row', $row);
                return $this->fetch();
            }
        }
        $data = input('post.data/a');
        try {
            SubIndustryLogic::I()->saveRow($id, $data);
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
            SubIndustryLogic::I()->delete($id);
        } catch (\Exception $e) {
            return ajaxError($e->getMessage());
        }
        return ajaxSuccess('删除成功');
    }


    public function enterprises($iid,$readonly=0)
    {
        if($this->request->isGet()){
            $this->assign('iid',$iid);
            $this->assign('readonly',$readonly);
            return $this->fetch();
        }
        $rows = Db::table('sub_industry_enterprise')->alias('ie')
            ->join('enterprises e','e.id=ie.eid')
            ->field('ie.*,e.name')
            ->where(['ie.iid'=>$iid])->order('ie.sort asc,ie.id asc')->select();
        return json($rows ? $rows : []);
    }

    public function addEnterprises($iid,$eids)
    {
        SubIndustryLogic::I()->addEnterprises($iid,$eids);
        return ajaxSuccess('添加成功');
    }

    public function setEnterprise($id)
    {
        if($this->request->isGet()){
            $row = Db::table('sub_industry_enterprise')->alias('ie')
                ->join('enterprises e','e.id=ie.eid')
                ->field('ie.*,e.name')->where(['ie.id'=>$id])->find();
            $this->assign('row',$row);
            return $this->fetch();
        }
        $data = input('post.data/a');
        Db::table('sub_industry_enterprise')->where(['id'=>$id])->update($data);
        return ajaxSuccess('保存成功');
    }

    public function delEnterprises($id)
    {
        Db::table('sub_industry_enterprise')->where(['id'=>$id])->delete();
        return ajaxSuccess('删除成功');
    }
    /***********************子行业产业链************************************************************/
    public function chain($subIndustryId){
        if(request()->isGet()) {
            $urlHref = [
                'subIndustryChain'=>url('index/SubIndustry/chain', ['subIndustryId'=>$subIndustryId]),
                'subIndustryChainAdd'=>url('index/SubIndustry/chainAdd', ['subIndustryId'=>$subIndustryId]),
                'subIndustryChainUpdate'=>url('index/SubIndustry/chainUpdate'),
                'subIndustryChainDelete'=>url('index/SubIndustry/chainDelete'),
                'subIndustryChainEnterprises'=>url('index/SubIndustry/chainEnterprises', ['subIndustryId'=>$subIndustryId]),
                'subIndustryChainEnterpriseAdd'=>url('index/SubIndustry/chainEnterpriseAdd'),
                'subIndustryChainEnterpriseDelete'=>url('index/SubIndustry/chainEnterpriseDelete'),
            ];
            $this->assign('urlHrefs', $urlHref);
            $this->assign('subIndustryId', $subIndustryId);
            return $this->fetch();
        }
        return json(SubIndustryLogic::I()->loadChainTreeDatas($subIndustryId, 0, false));
    }
    public function chainAdd($subIndustryId, $parentId){
        $name = input('post.name');
        $result = SubIndustryLogic::I()->addChain($subIndustryId, $name, $parentId);
        if($result){
            return ajaxSuccess('添加成功');
        }else{
            return ajaxError('添加失败');
        }
    }
    public function chainUpdate($subIndustryChainId){
        $name = input('post.name');
        $result = SubIndustryLogic::I()->updateChain($subIndustryChainId, $name);
        if($result){
            return ajaxSuccess('修改成功');
        }else{
            return ajaxError('修改失败');
        }
    }
    public function chainDelete($subIndustryChainId){
        $result = SubIndustryLogic::I()->deleteChain($subIndustryChainId);
        if($result){
            return ajaxSuccess('删除成功');
        }else{
            return ajaxError('删除失败，请先删除该节点下的关联企业');
        }
    }
    public function chainEnterprises($subIndustryId, $subIndustryChainId=0){
        if($subIndustryChainId == 0){
            $rows = Db::table('sub_industry_chain_enterprise')->alias('ie')
                ->join('sub_industry_chain si', 'ie.sub_industry_chain_id=si.id')
                ->join('enterprises e','e.id=ie.eid')
                ->field('ie.*,e.name')
                ->where(['si.sub_industry_id'=>$subIndustryId])->order('ie.id asc')->select();
        }else{
            $rows = Db::table('sub_industry_chain_enterprise')->alias('ie')
                ->join('enterprises e','e.id=ie.eid')
                ->field('ie.*,e.name')
                ->where(['ie.sub_industry_chain_id'=>$subIndustryChainId])->order('ie.id asc')->select();
        }
        foreach($rows as &$row){
            $chainId = $row['sub_industry_chain_id'];
            $chainPositionName = '';
            while($chainId){
                $chain = Db::table('sub_industry_chain')->where(['id'=>$chainId])->field(true)->find();
                if(!$chain){
                    break;
                }
                if(!$chainPositionName){
                    $chainPositionName = $chain['name'];
                }else {
                    $chainPositionName = $chain['name'] . '->' . $chainPositionName;
                }
                $chainId = $chain['parent_id'];
            }
            $row['chain_position'] = $chainPositionName;
        }
        return json($rows);
    }
    public function chainEnterpriseAdd($subIndustryChainId, $eids){
        if(empty($eids)){
            return ajaxError('非法参数');
        }
        $eids = explode(',', $eids);
        foreach ($eids as $eid) {
            $record = Db::table('sub_industry_chain_enterprise')->where(['sub_industry_chain_id'=>$subIndustryChainId, 'eid'=>$eid])->find();
            if(!$record){
                Db::table('sub_industry_chain_enterprise')->insert([
                    'sub_industry_chain_id'=>$subIndustryChainId,
                    'eid'=>$eid
                ]);
            }
        }
        return ajaxSuccess('添加成功');
    }
    public function chainEnterpriseDelete($id){
        Db::table('sub_industry_chain_enterprise')->where('id', $id)->delete();
        return ajaxSuccess('删除成功');
    }

    public function chainGraph($industry_id)
    {
        if ($this->request->isGet()) {
            return $this->fetch();
        }
        $top = SubIndustryLogic::I()->getRow($industry_id);
        $this->treeData($industry_id,$top['children'], 1);
        return json($top);
    }

    private function treeData($industry_id,&$rows=[],$init=0)
    {
        if ($init) {
            $rows = Db::table('sub_industry_chain')->where(['sub_industry_id'=>$industry_id,'parent_id'=>0])
                ->field('id,name')->order('id asc')->select();
            if (empty($rows)) {
                $rows = [];
                return;
            }
        }
        foreach ($rows as $k=>$v) {
            $rows[$k]['type'] = 'industry';
            $childs = Db::table('sub_industry_chain')->where(['sub_industry_id'=>$industry_id,'parent_id'=>$v['id']])
                ->field('id,name')->order('id asc')->select();
            if (empty($childs)) {
                $companies = Db::table('sub_industry_chain_enterprise')->alias('c')
                    ->join('enterprises e','e.id=c.eid')
                    ->where(['c.sub_industry_chain_id'=>$v['id']])->column('name');
                if (empty($companies)) {
                    $rows[$k]['children'] = [];
                } else {
                    $txt = array_slice($companies,0,4);
                    $txt = join('、',$txt) . (isset($companies[4]) ? '...' : '');
                    $rows[$k]['children'] = [['id'=>$v['id'].'-companies','type'=>'company','name'=>$txt]];
                }
            } else {
                $rows[$k]['children'] = $childs;
                $this->treeData($industry_id,$rows[$k]['children']);
            }
        }
    }
}