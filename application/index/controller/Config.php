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
use app\index\logic\Extra;
use app\index\logic\Meeting;
use app\index\logic\Tag;
use think\Controller;
use think\Db;
use think\Log;
use think\Debug;
use think\Request;
use app\index\logic\ConfigLogic;
use app\index\model\Dropdowns;

class Config extends Common{
    public function index(){
        $urlHrefs = [
            'businessRegProxy'=>url('index/Config/indexBusinessRegProxy'),
            'fundHostingAgency'=>url('index/Config/indexFundHostingAgency'),
            'dropdowns'=>url('config/dropdowns'),
            'meetings'=>url('config/meetings'),
        ];
        $this->assign('urlHrefs', $urlHrefs);
        return $this->fetch();
    }
    public function indexBusinessRegProxy($search=[],$page=1,$rows=DEFAULT_PAGE_ROWS,$sort='id',$order='desc'){
        if(request()->isGet()){
            $urlHrefs = [
                'add'=>url('index/Config/addBusinessRegProxy'),
                'edit'=>url('index/Config/editBusinessRegProxy'),
                'delete'=>url('index/Config/deleteBusinessRegProxy')
            ];
            $this->assign('urlHrefs', $urlHrefs);
            $datagrid = array(
                'options'=>array(
                    'title'=>'',
                    'url'=>url('index/Config/indexBusinessRegProxy', array('grid'=>'datagrid')),
                    'toolbar'=>'businessRegProxyModule.toolbar',
                    'fitColumns'=>$this->loginMobile?false:true
                ),
                'fields'=>array(
                    'ID'=>array('field'=>'id','width'=>100,'sortable'=>false),
                    '名称'=>array('field'=>'name','width'=>200,'sortable'=>false),
                    '联系人'=>array('field'=>'linkman','width'=>100,'sortable'=>false),
                    '电话'=>array('field'=>'tel','width'=>100,'sortable'=>false),
                    '添加时间'=>array('field'=>'entered','width'=>100,'sortable'=>false),
                    '操作'=>array('field'=>'opt','width'=>100,'sortable'=>false, 'formatter'=>'businessRegProxyModule.operate')
                )
            );
            $this->assign('datagrid', $datagrid);
            return $this->fetch();
        }
        $configLogic = ConfigLogic::newObj();
        return json($configLogic->loadBusinessRegProxys($search, $page, $rows, $sort, $order));
    }
    public function getBusinessRegProxyComboConfig(){
        $configLogic = ConfigLogic::newObj();
        return json($configLogic->loadBusinessRegProxyComboDatas());
    }
    public function addBusinessRegProxy(){
        if(request()->isGet()){
            $urlHrefs = [
            ];
            $this->assign('urlHrefs', $urlHrefs);
            return $this->fetch();
        }
        $infos = input('post.infos/a');
        $configLogic = ConfigLogic::newObj();
        $result = $configLogic->addBusinessRegProxy($infos);
        if($result){
            return ajaxSuccess('成功');
        }else{
            return ajaxError('失败');
        }
    }
    public function editBusinessRegProxy($id){
        $configLogic = ConfigLogic::newObj();
        if(request()->isGet()){
            $infos = $configLogic->getBusinessRegProxyInfos($id);
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
        $result = $configLogic->editBusinessRegProxy($id, $infos);
        if($result){
            return ajaxSuccess('成功');
        }else{
            return ajaxError('失败');
        }
    }
    public function deleteBusinessRegProxy($id){
        $result = ConfigLogic::newObj()->deleteBusinessRegProxy($id);
        if($result){
            return ajaxSuccess('成功');
        }else{
            return ajaxError('失败');
        }
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function indexFundHostingAgency($search=[],$page=1,$rows=DEFAULT_PAGE_ROWS,$sort='id',$order='desc'){
        if(request()->isGet()){
            $urlHrefs = [
                'add'=>url('index/Config/addFundHostingAgency'),
                'edit'=>url('index/Config/editFundHostingAgency'),
                'delete'=>url('index/Config/deleteFundHostingAgency')
            ];
            $this->assign('urlHrefs', $urlHrefs);
            $datagrid = array(
                'options'=>array(
                    'title'=>'',
                    'url'=>url('index/Config/indexFundHostingAgency', array('grid'=>'datagrid')),
                    'toolbar'=>'fundHostingAgencyModule.toolbar',
                    'fitColumns'=>$this->loginMobile?false:true
                ),
                'fields'=>array(
                    'ID'=>array('field'=>'id','width'=>100,'sortable'=>false),
                    '名称'=>array('field'=>'name','width'=>100,'sortable'=>false),
                    '联系人'=>array('field'=>'linkman','width'=>100,'sortable'=>false),
                    '电话'=>array('field'=>'tel','width'=>50,'sortable'=>false),
                    '添加时间'=>array('field'=>'entered','width'=>100,'sortable'=>false),
                    '操作'=>array('field'=>'opt','width'=>100,'sortable'=>false, 'formatter'=>'fundHostingAgencyModule.operate')
                )
            );
            $this->assign('datagrid', $datagrid);
            return $this->fetch();
        }
        $configLogic = ConfigLogic::newObj();
        return json($configLogic->loadFundHostingAgencies($search, $page, $rows, $sort, $order));
    }
    public function getFundHostingAgencyComboConfig(){
        $configLogic = ConfigLogic::newObj();
        return json($configLogic->loadFundHostingAgencyComboDatas());
    }
    public function addFundHostingAgency(){
        if(request()->isGet()){
            $urlHrefs = [
            ];
            $this->assign('urlHrefs', $urlHrefs);
            return $this->fetch();
        }
        $infos = input('post.infos/a');
        $configLogic = ConfigLogic::newObj();
        $result = $configLogic->addFundHostingAgency($infos);
        if($result){
            return ajaxSuccess('成功');
        }else{
            return ajaxError('失败');
        }
    }
    public function editFundHostingAgency($id){
        $configLogic = ConfigLogic::newObj();
        if(request()->isGet()){
            $infos = $configLogic->getFundHostingAgencyInfos($id);
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
        $result = $configLogic->editFundHostingAgency($id, $infos);
        if($result){
            return ajaxSuccess('成功');
        }else{
            return ajaxError('失败');
        }
    }
    public function deleteFundHostingAgency($id){
        $result = ConfigLogic::newObj()->deleteFundHostingAgency($id);
        if($result){
            return ajaxSuccess('成功');
        }else{
            return ajaxError('失败');
        }
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function dropdowns($search=[],$page=1,$rows=DEFAULT_PAGE_ROWS){
        if ($this->request->isGet()){
            return $this->fetch();
        }
        $where = [];
        $rows = db('dropdowns')->where($where)->page($page,$rows)->select();
        if (empty($rows)) {
            return json([]);
        }
        $total = db('dropdowns')->where($where)->count();
        return json(['total'=>$total,'rows'=>$rows]);
    }

    public function editDropdown($id=0)
    {
        $model = new Dropdowns();
        if ($this->request->isGet()){
            if ($id) {
                $row = $model::get($id)->toArray();
            } else {
                $row = [];
            }
            if (empty($row['items'])) {
                $row['items'] = [[]];
            }
            return $this->fetch('',[
                'row'=>$row
            ]);
        }
        try {
            $model->saveDropdown($id,$_POST);
        } catch (\Exception $e) {
            return ajaxError($e->getMessage());
        }
        return ajaxSuccess('保存成功');
    }

    public function deleteDropdown($id){
        Dropdowns::destroy($id);
        return ajaxSuccess('删除成功');
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function industries() {
        if ($this->request->isGet()){
            return $this->fetch();
        }
        $rows = Enterprise::I()->treeIndustries();
        return json(array_values($rows));
    }
    //添加/编辑行业
    public function editIndustry($id=0,$pid=0)
    {
        if ($this->request->isGet()) {
            $row = [];
            if ($id) {
                $row = Db::table('tags')->where('id',$id)->find();
            } else {
                $row['pid'] = intval($pid);
            }
            $this->assign('row', $row);
            $this->assign('parents', Enterprise::I()->treeIndustries());
            return $this->fetch();
        }
        $data = input('post.');
        $data = $data['data'];
        $data['category'] = Tag::TAG_INDUSTRY; //行业标签
        if ($data['pid']) {
            $parent = Db::table('tags')->where('id',$data['pid'])->find();
//            $data['level'] = $parent['level'] + 1;
            if ($id) {
                $childs = Db::table('tags')->where('pid',$id)->count();
                if ($childs) {
                    return ajaxError('请先移出下级数据');
                }
            }
        } else {
//            $data['level'] = 0;
        }
        try {
            if ($id) {
                Db::table('tags')->where('id',$id)->update($data);
            } else {
                Db::table('tags')->insert($data);
            }
            return ajaxSuccess('保存成功');
        } catch (\Exception $e) {
            return ajaxError($e->getMessage());
        }
    }
    //删除行业
    public function delIndustry($id) {
        Db::table('tags')->where("id={$id} or pid={$id}")->delete();
        return ajaxSuccess('删除成功');
    }
    //科学家领域
    public function indexScientistField($search=[],$page=1,$rows=DEFAULT_PAGE_ROWS,$sort='id',$order='desc'){
        if(request()->isGet()){
            $urlHrefs = [
                'save'=>url('index/Config/saveScientistField'),
                'delete'=>url('index/Config/deleteScientistField')
            ];
            $this->assign('urlHrefs', $urlHrefs);
            $datagrid = array(
                'options'=>array(
                    'title'=>'',
                    'url'=>url('index/Config/indexScientistField', array('grid'=>'datagrid')),
                    'toolbar'=>'scientistFieldModule.toolbar',
                    'fitColumns'=>$this->loginMobile?false:true
                ),
                'fields'=>array(
                    'ID'=>array('field'=>'id','width'=>100,'sortable'=>false),
                    '名称'=>array('field'=>'name','width'=>100,'sortable'=>false),
                    '添加时间'=>array('field'=>'entered','width'=>100,'sortable'=>false),
                    '操作'=>array('field'=>'opt','width'=>100,'sortable'=>false, 'formatter'=>'scientistFieldModule.operate')
                )
            );
            $this->assign('datagrid', $datagrid);
            return $this->fetch();
        }
        $configLogic = ConfigLogic::newObj();
        return json($configLogic->loadScientistFields($search, $page, $rows, $sort, $order));
    }
    public function getScientistFieldComboConfig(){
        $configLogic = ConfigLogic::newObj();
        return json($configLogic->loadScientistFieldComboDatas());
    }
    public function saveScientistField($id=0){
        $configLogic = ConfigLogic::newObj();
        if(request()->isGet()){
            if($id){
                //update
                $infos = $configLogic->getScientistFieldInfos($id);
                if (!$infos) {
                    return $this->fetch('common/error');
                }
            }else{
                //add
                $infos = ['name'=>''];
            }
            $this->assign('infos', $infos);
            return $this->fetch();
        }
        $infos = input('post.infos/a');

        $result = $configLogic->saveScientistField($id, $infos);
        if($result){
            return ajaxSuccess('成功');
        }else{
            return ajaxError('失败');
        }
    }
    public function deleteScientistField($id){
        $result = ConfigLogic::newObj()->deleteScientistField($id);
        if($result){
            return ajaxSuccess('成功');
        }else{
            return ajaxError('失败');
        }
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}