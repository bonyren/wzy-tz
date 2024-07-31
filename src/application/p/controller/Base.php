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
use app\p\service\User;
use think\Controller;

class Base extends Controller
{
    protected $_user;
    protected $_user_id; //当前登录用户id

    public function _initialize()
    {
        $this->checkLogin();
        $this->assign('_user',$this->_user);
    }

    public function checkLogin()
    {
        $action = $this->request->action();
        if (in_array($action,['login','logout'])) {
            return;
        }
        $this->_user = User::I()->getLoginUser();
        $this->_user_id = $this->_user['id'];
        if (empty($this->_user_id)) {
            $this->redirect('index/login');
        }
    }
}