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

use think\Controller;

class Base extends Controller
{
    protected $lp;
    protected $lp_id; //当前登录合伙人id
    protected $loginMobile;

    public function _initialize()
    {
        $this->loginMobile = $this->request->isMobile();
        $this->assign('loginMobile', $this->loginMobile);
        $this->checkLogin();
        $this->assign('_lp',$this->lp);
        if ($this->request->isGet()) {
            $this->assign('_request_url',$this->request->url());
        }
    }

    public function checkLogin()
    {
        $this->lp = session('lp');
        $this->lp_id = $this->lp['p_id'];
        $action = $this->request->action();
        if (in_array($action,['login','logout'])) {
            return;
        }
        if (empty($this->lp['p_id'])) {
            if (request()->isAjax()) {
                header('HTTP/1.1 401 Unauthorized');
                exit();
            }else{
                $this->redirect('lp/index/login');
            }
        }
    }
}