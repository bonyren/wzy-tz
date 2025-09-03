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
use think\Controller;
use think\Session;
use think\Request;
use think\Log;
use think\Db;
use think\Cookie;
use crypt\PhpEncrypter;
use app\index\service\RequestContext;
use app\common\CommonDefs;
use app\index\logic\Admins as AdminsLogic;

class Common extends Controller
{
	protected $loginUserId = null;
	protected $loginUserName = null;
	protected $loginRealName = null;
	protected $loginUserRoleId = null;
	protected $loginSuperUser = false;
	protected $loginTime = null;
	protected $loginIp = null;
	protected $loginMobile = null;
    protected $loginUserMenuPriv = null;

	public function _initialize()
    {
		$this->loginUserId = Session::get('userid');
		$this->loginUserName = Session::get('username');
		$this->loginRealName = Session::get('realname');
		$this->loginUserRoleId = Session::get('userroleid');
		$this->loginTime = Session::get('lastlogintime');
		$this->loginIp = Session::get('lastloginip');
		$this->loginSuperUser = Session::get('super_user');
		$this->loginMobile = request()->isMobile();
		RequestContext::I()->loginUserId = $this->loginUserId;
		RequestContext::I()->loginUserName = $this->loginUserName;
		RequestContext::I()->loginUserRoleId = $this->loginUserRoleId;
		RequestContext::I()->loginTime = $this->loginTime;
		RequestContext::I()->loginIp = $this->loginIp;
		RequestContext::I()->loginSuperUser = $this->loginSuperUser;
		RequestContext::I()->loginMobile = $this->loginMobile;
		self::checkLogin();
        self::checkPriv();
		$this->assign('loginMobile', $this->loginMobile);
        $this->assign('loginUserMenuPriv', $this->loginUserMenuPriv);
        $this->assign('_request_url',$this->request->url());
	}
	public function _empty(){
		abort(404, '资源不存在或已经删除');
	}
	protected function invalidRequest(){
		abort(400, '错误的请求');
	}
	final public function checkLogin()
    {
		$controller = Request::instance()->controller();
		$action = Request::instance()->action();
		if($controller =='Index' && in_array($action, array('login', 'captcha')) ) {
			return;
		}
		if (\app\p\service\User::I()->getLoginUser()) {
		    return; //项目端
        }
        if (session('lp')) {
            return; //lp端
        }
		if($this->loginUserId){
			return;
		}
		if(request()->isAjax()){
			header('HTTP/1.1 401 Unauthorized');
			exit();
		}else if(!request()->isAjax()) {
			Log::notice('CommonController::checkLogin, please login firstly, session: ' . var_export($_SERVER, true) . ', url:' . url('index/Index/login'));
			$this->redirect('index/Index/login');
		}else{
			exit();
		}
	}
    final public function checkPriv(){
        if($this->loginSuperUser){
            $this->loginUserMenuPriv = CommonDefs::AUTHORIZE_READ_WRITE_TYPE;
            return;
        }
        if(!Request::instance()->isGet() || !Request::instance()->isAjax()){
            $this->loginUserMenuPriv = CommonDefs::AUTHORIZE_READ_WRITE_TYPE;
            return;
        }
        $module = Request::instance()->module();
        $controller = Request::instance()->controller();
        $action = Request::instance()->action();
		//如果通过params的不同来区分menu的话，会导致menuId不准确, 所以此处id存在多个
        $menuIds = Db::table('menu')->where(['m'=>$module, 'c'=>$controller, 'a'=>$action])->column('id');
        if(empty($menuIds)){
			//没有定义,默认可写
            $this->loginUserMenuPriv = CommonDefs::AUTHORIZE_READ_WRITE_TYPE;
            return;
        }
		//随机选择一个作为menu priv
        $authorizeType = Db::table('admin_role_menu')->where(['menu_id'=>['in', $menuIds], 'role_id'=>$this->loginUserRoleId])->value('type');
        if($authorizeType === null){
            //$this->loginUserMenuPriv = CommonDefs::AUTHORIZE_READ_WRITE_TYPE;
			exit('<div style="padding:6px">您没有权限操作该项</div>');
            return;
        }
		/*同上面的判断逻辑重复
        $authorizeType = Db::table('admin_role_menu')->alias('ARM')->join('menu M', 'ARM.menu_id=M.id')
            ->where(['ARM.role_id'=>$this->loginUserRoleId])
            ->where("lower(M.m)='".strtolower($module) . "'")
            ->where("lower(M.c)='".strtolower($controller) . "'")
            ->where("lower(M.a)='".strtolower($action) . "'")
            ->value('ARM.type');
        if($authorizeType === null){
            exit('<div style="padding:6px">您没有权限操作该项</div>');
        }*/
        $this->loginUserMenuPriv = intval($authorizeType);
    }
	const AUTO_LOGIN_ENCRYPT_PASS = 'hello123)(*';
	protected function autoLogin(){
		$autoLoginToken = Cookie::get('auto_login_token');
		if(!$autoLoginToken){
			return false;
		}
		$crypt = new PhpEncrypter();
		$token = $crypt->decrypt($autoLoginToken, self::AUTO_LOGIN_ENCRYPT_PASS);
		list($username, $password) = explode("#*#*#*", $token);
		try{
			AdminsLogic::I()->login($username, $password);
		}catch (\Exception $e){
			return false;
		}
		Log::notice("autoLogin success");
		return true;
	}
	protected function autoLoginToken($username, $password){
		$crypt = new PhpEncrypter();
		$autoLoginToken = $crypt->encrypt($username .'#*#*#*'.$password, self::AUTO_LOGIN_ENCRYPT_PASS);
		return $autoLoginToken;
	}
}