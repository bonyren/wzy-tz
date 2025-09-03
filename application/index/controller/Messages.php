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
use app\index\logic\Defs;

class Messages extends Common{
    public function index($search=[],$page=1,$rows=DEFAULT_PAGE_ROWS,$sort='message_id',$order='desc'){
        if(request()->isGet()){
            $urlHrefs = [
                'index'=>url('index/Messages/index'),
                'content'=>url('index/Messages/content')
            ];
            $this->assign('urlHrefs', $urlHrefs);
            return $this->fetch();
        }
        $messagesLogic = \app\index\logic\Messages::newObj();
        return json($messagesLogic->load($this->loginUserId, $search, $page, $rows, $sort, $order));
    }
    public function markRead($messageId){
        $messagesLogic = \app\index\logic\Messages::newObj();
        $messagesLogic->markRead($messageId);
        return ajaxSuccess('成功');
    }
    public function markAllRead(){
        $messagesLogic = \app\index\logic\Messages::newObj();
        $messagesLogic->markAllRead($this->loginUserId);
        return ajaxSuccess('成功');
    }
    public function markSelectedRead(){
        $messagesLogic = \app\index\logic\Messages::newObj();
        $messageIds = input('post.messageIds/a');
        if(empty($messageIds)){
            return ajaxSuccess('成功');
        }
        $messagesLogic->markSelectedRead($messageIds);
        return ajaxSuccess('成功');
    }
    public function content($messageId){
        $messagesLogic = \app\index\logic\Messages::newObj();
        $infos = $messagesLogic->getInfos($messageId);
        if(empty($infos)){
            return $this->fetch('common/error');
        }
        $this->assign('content', $infos['content']);
        return $this->fetch();
    }
}