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

namespace app\index\service;
use think\Log;
use think\Debug;
use think\Db;


class Messages extends Base
{
    public function __construct(){

    }
    public function sendApproval($adminId, $title='', $content=''){
        $messagesLogic = \app\index\logic\Messages::newObj();
        $messageId = $messagesLogic->add($adminId,
            \app\index\logic\Messages::MESSAGE_APPROVAL_CATEGORY,
            empty($title)?\app\index\logic\Messages::$messageCategoryDefs[\app\index\logic\Messages::MESSAGE_APPROVAL_CATEGORY]:'',
            empty($content)?\app\index\logic\Messages::$messageCategoryDefs[\app\index\logic\Messages::MESSAGE_APPROVAL_CATEGORY]:'');
        if(!$messageId){
            Log::error("failed to add message to $adminId");
        }
        return true;
    }
}