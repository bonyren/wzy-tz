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
        if($this->_user_id){
            return;
        }
        if(request()->isAjax()){
			header('HTTP/1.1 401 Unauthorized');
			exit();
		}else if(!request()->isAjax()) {
			$this->redirect('p/Index/login');
		}else{
			exit();
		}
    }
    public function _empty(){
		abort(404, '资源不存在或已经删除');
	}
	protected function invalidRequest(){
		abort(400, '错误的请求');
	}
}