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
namespace app\p\service;
use think\captcha\Captcha;
use app\index\service\Base;
use think\Db;

class User extends Base
{
    const LOGIN_SESSION_KEY = 'user_project';

    public function login($username,$password)
    {
        $contact = Db::table('contacts')->where([
                'deleted' => '0',
                'username' => $username,
                'password' => md5($password)
            ])->find();
        if (empty($contact)) {
            exception('帐号或密码错误');
        }
        $enterprise_id = Db::table('enterprises_founders')
            ->where('contact_id',$contact['id'])->value('enterprise_id');
        if (empty($enterprise_id)) {
            exception('帐号尚未关联项目');
        }
        unset($contact['password']);
        $contact['enterprise_id'] = $enterprise_id;
        session(self::LOGIN_SESSION_KEY, $contact);
    }

    public function logout(){
        session(self::LOGIN_SESSION_KEY, null);
    }

    public function getLoginUser()
    {
        $user = session(self::LOGIN_SESSION_KEY);
        return $user;
    }
}