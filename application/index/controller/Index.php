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
use app\index\logic\UsersFollow;
use think\Log;
use think\Url;
use think\Cookie;
use think\Session;
use think\captcha\Captcha;
use app\index\logic\Defs;
use app\index\logic\Admins as AdminsLogic;
use app\index\logic\Messages as MessagesLogic;
use app\index\logic\Dashboard as DashboardLogic;
class Index extends Common
{
	public function sessionLife(){
		$loginUrl = url('index/Index/login');
		if($this->loginUserId === null){
			return ajaxError('请先登录', $loginUrl);
		}
		return ajaxSuccess('成功');
	}
	public function clearCache(){
		/*
		$tempPath = TEMP_PATH;
		if ($handle = opendir($tempPath)) {
			while (false !== ($file = readdir($handle))) {
				if ($file != "." && $file != "..") {
					unlink($tempPath . $file);
				}
			}
			closedir($handle);
		}*/
		rrmdir(TEMP_PATH);
		//开启单点登录，会引起重新登录
		//rrmdir(CACHE_PATH);
		return ajaxSuccess('操作成功');
	}

    public function index(){
		$urlHrefs = array(
			'loadLeftMenu'=>Url::build('Index/loadLeftMenu'),
			'logout'=>url('index/Index/logout'),
			'sessionLife'=>url('index/Index/sessionLife'),
			'clearCache'=>url('index/Index/clearCache'),
			'modifyPwd'=>url('index/Index/modifyPwd'),
			'main'=>url('index/Index/main')
		);
		$loginUserInfos = [
			'username'=>$this->loginUserName,
			'realname'=>$this->loginRealName,
			'lastlogintime'=>$this->loginTime,
			'lastloginip'=>$this->loginIp,
			'unreadMessageCount'=>MessagesLogic::newObj()->unreadCount($this->loginUserId)
		];
		$this->assign('loginUserInfos', $loginUserInfos);
		$this->assign('urlHrefs', $urlHrefs);

	    if (isMobile()) {
            $menus = [];
			AdminsLogic::newObj()->loadLeftMenuRecursively(0, '', $menus);
            return $this->fetch('mobile',['menus'=>$menus]);
        } else {
            return $this->fetch();
        }
    }

	/**
	 * 根据登录用户的身份设置相应的命令菜单
	 */
	public function loadLeftMenu(){
		$leftMenuDefs = array();
		AdminsLogic::newObj()->loadLeftMenuRecursively(0, '', $leftMenuDefs);
		return json($leftMenuDefs);
	}

	public function main(){
		$dashboardLogic = DashboardLogic::newObj();
		$bindValues = [
			'statistic'=>$dashboardLogic->loadStatistic()
		];
		$this->assign('bindValues', $bindValues);
		$urlHrefs = [
			'dashboard'=>url('index/Dashboard/dashboard'),
			'fundLatest'=>url('index/Dashboard/fundLatest'),
			'enterpriseLatest'=>url('index/Dashboard/enterpriseLatest'),
			'projectEvents'=>url('EventLog/globals',['entity'=>Defs::ENTITY_PROJECT]),
			'fundEvents'=>url('EventLog/globals',['entity'=>Defs::ENTITY_FUND]),
		];
		$this->assign('urlHrefs', $urlHrefs);
		return $this->fetch();
	}
	public function login(){
		if(request()->isGet()){
		    if ($this->loginUserId) {
		        $this->redirect('index/Index/index');
            }
			if($this->autoLogin()){
				$this->redirect('index/Index/index');
			}
			$this->assign('login_captcha_enable', Session::get('login_captcha_enable'));
			$this->assign('urls', [
                'captcha'=>url('index/Index/captcha', [
                    'code_len'=>4,
                    'font_size'=>16,
                    'width'=>130,
                    'height'=>50,
                    'code'=>time()
                ]),
                'login'=>url('index/Index/login')
            ]);
			return $this->fetch();
		}
		$username = input('post.username/s');
		$password = input('post.password/s');
		if(Session::get('login_captcha_enable')) {
			$captchaCode = input('post.captcha/s');
			$captcha = new Captcha();
			$captchaOk = $captcha->check($captchaCode, 'login');
			if (!$captchaOk) {
				//return ajaxError('验证码错误');
				$this->error('验证码错误');
			}
		}
		$autoLogin = input('post.auto_login', null);
		//管理员登录
		$adminsLogic = AdminsLogic::newObj();
		$adminInfos = $adminsLogic->login($username, $password);
		if(!$adminInfos){
				//return ajaxError('用户名密码错误');
				Session::set('login_captcha_enable', true);
				//$this->error('用户名密码错误');//微信浏览器history.go(-1)使用缓存导致captcha无法显示
				$this->error('用户名密码错误', 'index/Index/login');
		}
		//return ajaxSuccess('成功', url('index/Index/index'));
		Session::delete(['login_captcha_enable','lp']);
		if($autoLogin){
			//set cookie
			//set cookie
			$autoLoginToken = $this->autoLoginToken($username, $password);
			Cookie::set('auto_login_token', $autoLoginToken, 3600*24*30);//30 days
		}else{
			//clear cookie
			Cookie::delete('auto_login_token');
		}
		//$this->success('成功', 'index/Index/index');
		$this->redirect('index/Index/index');
	}
	public function logout(){
		$adminsLogic = AdminsLogic::newObj();
		$adminsLogic->logout();
		Cookie::delete('auto_login_token');
		return ajaxSuccess('成功', url('index/Index/login'));
	}
	public function captcha(){
		$captcha = new Captcha();
		$captcha->useCurve = false;
		$captcha->useNoise = false;
		$captcha->bg = array(255, 255, 255);

		if (input('get.code_len')) $captcha->length = intval(input('get.code_len'));
		if ($captcha->length > 8 || $captcha->length < 2) $captcha->length = 4;

		if (input('get.font_size')) $captcha->fontSize = intval(input('get.font_size'));

		if (input('get.width')) $captcha->imageW = intval(input('get.width'));
		if ($captcha->imageW <= 0) $captcha->imageW = 130;

		if (input('get.height')) $captcha->imageH = intval(input('get.height'));
		if ($captcha->imageH <= 0) $captcha->imageH = 50;

		return $captcha->entry('login');
	}

	public function modifyPwd(){
		if(request()->isGet()){
			$adminsLogic = AdminsLogic::newObj();
			$adminInfos = $adminsLogic->getAdminInfos($this->loginUserId);
			if(!$adminInfos){
				return $this->fetch('common/error');
			}
			$this->assign('info', [
				'username'=>$adminInfos['login_name'],
				'email'=>$adminInfos['email']
			]);
			return $this->fetch();
		}
		$oldPassword = input('post.old_password/s');
		$newPassword = input('post.new_password/s');

		$adminsLogic = AdminsLogic::newObj();
		$result = $adminsLogic->modifyAdminPwd($this->loginUserId, $oldPassword, $newPassword);
		if($result){
			$adminsLogic->logout();
			Cookie::delete('auto_login_token');
			return ajaxSuccess('成功修改密码，请重新登录', url('index/Index/login'));
		}else{
			return ajaxError('失败');
		}
	}

	public function follow($target_type,$target_id,$action){
        if ($action) {
            UsersFollow::I()->addFollow($target_type, $target_id);
        } else {
            UsersFollow::I()->cancelFollow($target_type,$target_id);
        }
        return ajaxSuccess();
    }

}