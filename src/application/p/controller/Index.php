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
namespace app\p\controller;
use app\common\CommonDefs;
use app\index\logic\Contact;
use app\index\logic\Enterprise;
use app\p\service\User;

class Index extends Base
{
    public function login()
    {
        if ($this->request->isPost()){
            $data = input('post.');
            try {
                User::I()->login($data['username'],$data['password']);
            } catch (\Exception $e) {
                //return ajaxError($e->getMessage());
                $this->error($e->getMessage(), 'p/Index/login');
            }
            //return ajaxSuccess('',url('Index/index'));
            $this->redirect('p/Index/index');
        }
        if ($this->_user_id) {
            $this->redirect('p/Index/index');
        }
        $this->assign('login_headline', '项目登录端');
        $this->assign('login_captcha_enable', false);
        $this->assign('urls', [
            'captcha'=>url('index/Index/captcha', [
                'code_len'=>4,
                'font_size'=>16,
                'width'=>130,
                'height'=>50,
                'code'=>time()
            ]),
            'login'=>url('Index/login')
        ]);
        return $this->fetch('index@index/login');
    }

    public function logout(){
        User::I()->logout();
        return ajaxSuccess('',url('Index/login'));
    }

    public function password(){
        if ($this->request->isGet()) {
            return $this->fetch();
        }
        $data = input('post.data/a');
        $contact = Contact::I()->getContact($this->_user_id);
        if ($contact['password'] != md5($data['password'])) {
            return ajaxError('密码错误');
        }
        try {
            Contact::I()->password($this->_user_id,$data['update_password']);
        } catch (\Exception $e) {
            return ajaxError($e->getMessage());
        }
        return ajaxSuccess('修改成功');
    }

    public function index(){
        $enterprise = Enterprise::I()->getEnterprise($this->_user['enterprise_id']);
        return $this->fetch('',[
            'enterprise' => $enterprise,
            'urls' => [
                'meeting'=>url('index/ProgressLogs/light',['category'=>3,'externalId'=>$enterprise['id'],'src'=>CommonDefs::MODULE_PROJECT]),
                'finance'=>url('index/Upload/attaches',['attachmentType'=>19,'externalId'=>$enterprise['id'],'uiStyle'=>4,'src'=>CommonDefs::MODULE_PROJECT]),
                'progress'=>url('index/ProgressLogs/light',['category'=>6,'externalId'=>$enterprise['id'],'src'=>CommonDefs::MODULE_PROJECT]),
            ],
        ]);
    }
}