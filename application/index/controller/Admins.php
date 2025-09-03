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
use think\Log;
use think\Debug;
use think\Request;

class Admins extends Common{
	public function admins($search=[],$page=1,$rows=DEFAULT_PAGE_ROWS,$sort='admin_id',$order='desc'){
		if(request()->isGet()){
			$urlHrefs = [
				'admins'=>url('index/Admins/admins'),
				'adminsAdd'=>url('index/Admins/adminsAdd'),
				'adminsEdit'=>url('index/Admins/adminsEdit'),
				'adminsDelete'=>url('index/Admins/adminsDelete'),
				'adminsChangePwd'=>url('index/Admins/adminsChangePwd')
			];
			$this->assign('urlHrefs', $urlHrefs);
			return $this->fetch();
		}
		$adminsLogic = \app\index\logic\Admins::newObj();
		return json($adminsLogic->load($search, $page, $rows, $sort, $order));
	}
	public function adminsAdd(){
		$adminsLogic = \app\index\logic\Admins::newObj();
		if(request()->isGet()){
			$urlHrefs = [
				'checkAdminEmail'=>url('index/Admins/checkAdminEmail', ['oldValue'=>''])
			];
			$this->assign('urlHrefs', $urlHrefs);
			$bindValues = [
				'adminRolePairs'=>$adminsLogic->getAdminRolePairs()
			];
			$this->assign('bindValues', $bindValues);
			return $this->fetch();
		}
		$infos = input('post.infos/a');
		$result = $adminsLogic->addAdmin($infos);
		if($result){
			return ajaxSuccess('成功');
		}else{
			return ajaxError('失败');
		}
	}
	public function adminsEdit($adminId){
		$adminsLogic = \app\index\logic\Admins::newObj();
		if(request()->isGet()){
			$infos = $adminsLogic->getAdminInfos($adminId);
			if(!$infos){
				return $this->fetch('common/error');
			}
			$bindValues = [
				'adminRolePairs'=>$adminsLogic->getAdminRolePairs(),
				'infos'=>$infos
			];
			$this->assign('bindValues', $bindValues);

			$urlHrefs = [
				'checkAdminEmail'=>url('index/Admins/checkAdminEmail', ['oldValue'=>$infos['email']])
			];
			$this->assign('urlHrefs', $urlHrefs);
			return $this->fetch();
		}
		$infos = input('post.infos/a');
		$result = $adminsLogic->editAdmin($adminId, $infos);
		if($result){
			return ajaxSuccess('成功');
		}else{
			return ajaxError('失败');
		}
	}
	public function adminsDelete($adminId){
		$adminsLogic = \app\index\logic\Admins::newObj();
		$result = $adminsLogic->deleteAdmin($adminId);
		if($result){
			return ajaxSuccess('成功');
		}else{
			return ajaxError('失败');
		}
	}
	public function adminsChangePwd($adminId){
		$adminsLogic = \app\index\logic\Admins::newObj();
		if(request()->isGet()){
			$infos = $adminsLogic->getAdminInfos($adminId);
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
		$result = $adminsLogic->changeAdminPwd($adminId, $infos);
		if($result){
			return ajaxSuccess('成功');
		}else{
			return ajaxError('失败');
		}
	}
	public function checkAdminEmail($oldValue, $email){
		if ($oldValue == $email) {
			return 'true';
		}
		$exists = false;
		if ($exists) {
			return 'false';
		}else{
			return 'true';
		}
	}

    /**
     * 通过id批量获取用户
     * @param string|array $ids
     * @return json string
     */
	public function getUsersById($ids){
        if (!is_array($ids)) {
            $ids = explode(',', $ids);
        }
        $where['admin_id'] = isset($ids[1]) ? ['in',$ids] : $ids[0];
        $rows = db('admins')->field('admin_id,email,realname')
            ->where($where)->order('admin_id asc')->select();
        if (empty($rows)) {
            $rows = [];
        }
        return json($rows);
    }

    /**
     * 获取所有用户
     * @return json string
     */
    public function getAllUsers(){
        $rows = \app\index\logic\Admins::I()->getAllUsers(false);
        return json($rows);
    }
}