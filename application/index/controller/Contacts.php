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
use app\index\logic\Contact;
use app\index\logic\Enterprise;
use app\index\model\EFounders;

class Contacts extends Common
{
    public function index($search=[],$page=1,$rows=DEFAULT_PAGE_ROWS)
    {
        if($this->request->isGet()){
            $urls = [
                'list'=>url('index/Contacts/index'),
                'edit'=>url('index/Contacts/edit'),
                'delete'=>url('index/Contacts/delete'),
                'show_tags'=>url('index/Tags/showTagsBatch',['category'=>4]),
            ];
            $this->assign('urls', $urls);
            return $this->fetch();
        }
        $data = Contact::I()->load($search,$page,$rows);
        if (empty($data)) {
            return json(['rows'=>[],'total'=>0]);
        }
        $enterprise_ids = [];
        foreach ($data['rows'] as $v) {
            if ($v['enterprise_id']) {
                $enterprise_ids[] = $v['enterprise_id'];
            }
        }
        $data['enterprise'] = Enterprise::I()->getEnterprisePairs($enterprise_ids);
        return json($data);
    }

    /**
     * 添加/编辑联系人
     * @param int $id
     * @param int $enterprise_id
     * @return mixed
     */
    public function edit($id=0,$enterprise_id=0)
    {
        if ($this->request->isGet()) {
            $row = $id ? Contact::I()->getContact($id) : [];
            $this->assign([
                'row' => $row,
                'users' => \app\index\logic\Admins::I()->getAllUsers(),
            ]);
            return $this->fetch();
        }
        $data = input('post.');
        try {
            $contact_id = Contact::I()->saveContact($id,$data);
            if (empty($id) && $enterprise_id) { //新增联系人时检测
                Enterprise::I()->setEnterpriseFounders($enterprise_id,$contact_id);
            }
        } catch (\Exception $e) {
            return ajaxError($e->getMessage());
        }
        if (!empty($data['pending_files'])) {
            Upload::I()->relateAttaches($data['pending_files'],$contact_id);
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
            Contact::I()->delete($id);
        } catch (\Exception $e) {
            return ajaxError($e->getMessage());
        }
        return ajaxSuccess('删除成功');
    }

    /**
     * 查看详情
     * @param $id
     * @return mixed
     */
    public function view($id)
    {
        $row = Contact::I()->getContact($id);
        if (empty($row)) {
            return '记录不存在';
        }
        $this->assign('row', $row);
        return $this->fetch();
    }

    public function password($id)
    {
        if ($this->request->isGet()) {
            $contact = Contact::I()->getContact($id);
            $this->assign([
                'contact' => $contact,
            ]);
            return $this->fetch();
        }
        $data = input('post.data/a');
        try {
            Contact::I()->password($id,$data['password'],$data['username']);
        } catch (\Exception $e) {
            return ajaxError($e->getMessage());
        }
        return ajaxSuccess('设置成功');
    }

}