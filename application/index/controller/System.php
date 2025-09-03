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
use app\index\logic\Defs;
use think\Controller;
use think\Db;
use think\Log;
use think\Debug;
use app\index\model\Setting;
class System extends Common{
    public function setting(){
        if(request()->isPost()){
            $settingModel = model('Setting');
            if(input('get.dosubmit')){
                //保存
                $state = $settingModel->saveSetting(input('post.data/a'));
                if($state){
                    $settingModel->clearCache();
                    return ajaxSuccess('操作成功');
                }else{
                    return ajaxError('失败');
                }
            }else{
                $data = array_values($settingModel->getSetting());
                return json($data);
            }
        }else {
            $urlHrefs = [
                'setting'=>url('setting'),
                'settingSave'=>url('setting', ['dosubmit'=>1]),
                'settingDefault'=>url('settingDefault'),
                'settingExport'=>url('settingExport'),
                'settingImport'=>url('settingImport'),
                'importUpload'=>url('Import/import'),
                'fileUpload'=>url('Upload/upload')
            ];
            $this->assign('urlHrefs', $urlHrefs);
            return $this->fetch();
        }
    }
    public function settingDefault(){
        if(request()->isPost()){
            $settingModel = model('Setting');
            if($settingModel->count()){
                $state = $settingModel->where("`key` <> ''")->delete();
                if($state){
                    $settingModel->clearCache();
                    return ajaxSuccess('操作成功');
                }else{
                    return ajaxError('失败');
                }
            }
            return ajaxSuccess('操作成功');
        }
    }
    public function settingExport($filename = ''){
        if(request()->isPost()) {
            $settingModel = model('Setting');
            $data = array('type'=>'setting');
            //$data['data'] = $settingModel->select();
            $data['data'] = Db::table('setting')->select();
            $data['verify'] = md5(var_export($data['data'], true) . $data['type']);
            //数据进行多次加密，防止数据泄露
            $data = base64_encode(gzdeflate(json_encode($data)));
            $uniqid = uniqid();
            $filename = EXPORT_DIR . DS . $uniqid . '.data';
            if(file_put_contents($filename, $data)){
                return ajaxSuccess('成功', url('System/settingExport', array('filename'=>$uniqid)));
            }
            return ajaxError('失败');
        }else{
            //过滤特殊字符，防止非法下载文件
            $filename = str_replace(array('.', '/', '\\'), '', $filename);
            $filename = EXPORT_DIR . DS . $filename . '.data';
            if(!file_exists($filename)) {
                return $this->fetch('common/error');
            }
            header('Content-type: application/octet-stream');
            header('Content-Disposition: attachment; filename="system_setting.data"');
            readfile($filename);
            unlink($filename);
            exit();
        }
    }
    public function settingImport($filename = ''){
        if(request()->isPost()) {
            //过滤特殊字符，防止非法下载文件
            //$filename = str_replace(array('.', '/', '\\'), '', $filename);
            $filePath = IMPORT_DIR . DS . $filename;
            //$filename = UPLOAD_PATH . 'import/' . $filename . '.data';
            if(!file_exists($filePath)){
                Log::error("file: {$filePath} is not exist");
                return ajaxError('失败');
            }
            $content = file_get_contents($filePath);
            //解密
            try {
                $data  = gzinflate(base64_decode($content));
            }catch (\Exception $e){};
            if(!isset($data)){
                Log::error("file: {$filePath}, failed to decrypt it");
                unlink($filePath);
                return ajaxError('失败');
            }
            //防止非法数据
            try {
                $data = json_decode($data, true);
            }catch (\Exception $e){};
            if(!is_array($data) || !isset($data['type']) || $data['type'] != 'setting' || !isset($data['verify']) || !isset($data['data'])){
                unlink($filePath);
                Log::error("file: {$filePath}, failed to decode it");
                return ajaxError('失败');
            }
            if($data['verify'] != md5(var_export($data['data'], true) . $data['type'])){
                unlink($filePath);
                Log::error("settingImport, file: {$filePath}, failed to verify it, verify: {$data['verify']}");
                return ajaxError('失败');
            }
            $settingModel = model('Setting');
            //先清空数据再导入
            $settingModel->where("`key` <> ''")->delete();
            $settingModel->clearCache();
            //开始导入
            asort($data['data']);
            foreach($data['data'] as $add) {
                $settingModel->key = $add['key'];
                $settingModel->value = $add['value'];
                $settingModel->isUpdate(false)->save();
            }
            unlink($filePath);
            return ajaxSuccess('操作成功');
        }else{
            return ajaxError('失败');
        }
    }
    /******************************************************************************************************************/
    public function dbBackups(){
        if($this->request->isGet()){
            return $this->fetch();
        }
        $backupPath = ROOT_PATH . 'db' . DS . 'backup';
        if(systemSetting('DB_BACKUP_PATH')){
            $backupPath = systemSetting('DB_BACKUP_PATH');
        }
        $backupFiles = [];
        if (is_dir($backupPath) && file_exists($backupPath) && $handle = opendir($backupPath)) {
            //xinling_own_new_20211105.zip
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != "..") {
                    $slices = explode('.',$file);
                    $backupDate = explode('#',$slices[0])[1];
                    $backupFiles[] = [
                        'name'=>$file,
                        'date'=>date('Y-m-d', strtotime($backupDate))
                    ];
                }
            }
            closedir($handle);
        }
        //排序
        $dates = array_column($backupFiles, 'date');
        array_multisort($dates, SORT_DESC, $backupFiles);
        return json($backupFiles);
    }
    /**
     * 系统异常
     *
     * @param  mixed $page
     * @return void
     */
    public function sysErrExp($page=1,
        $rows=DEFAULT_PAGE_ROWS,
        $sort='',
        $order=''){
        if(request()->isGet()){
            $urlHrefs = [
                'index'=>url('index/System/sysErrExp'),
            ];
            $this->assign('urlHrefs', $urlHrefs);
            return $this->fetch();
        }
        if($sort == 'time'){
            $order = 'time ' . $order;
        }else{
            $order = 'id desc';
        }
        $conditions = [];
        $totalCount = Db::table('sys_err_exp')->where($conditions)->count();
        $records = Db::table('sys_err_exp')
            ->where($conditions)
            ->page($page, $rows)
            ->order($order)
            ->field('*')
            ->select();
        return json([
            'total'=>$totalCount,
            'rows'=>$records
        ]);
    }
    public function clearSysErrExp(){
        Db::execute("truncate table sys_err_exp");
        return ajaxSuccess();
    }
    public function docs($search=[],$page=1,$rows=DEFAULT_PAGE_ROWS,$sort='external_id',$order='desc',$owned=0){
        if(request()->isGet()){
            $urlHrefs = [
                'docs'=>url('index/System/docs', ['owned'=>$owned]),
                'delete'=>url('index/System/docsDelete')
            ];
            $this->assign('urlHrefs', $urlHrefs);
            return $this->fetch();
        }
        $limit = ($page - 1) * $rows . "," . $rows;
        if($sort == 'external_id'){
            $order = 'external_id ' . $order;
        }else{
            $order = 'external_id desc';
        }
        $conditions = ['status'=>Defs::ATTACHMENT_OK];
        if($owned){
            $conditions['user_id'] = \app\index\service\RequestContext::I()->loginUserId;
        }
        if(!emptyInArray($search, 'attachment_type')){
            $conditions['attachment_type'] = $search['attachment_type'];
        }
        $total = Db::table('attachments')->where($conditions)->group('attachment_type, external_id')->count();
        $records = Db::table('attachments')->where($conditions)->group('attachment_type, external_id')->limit($limit)->order($order)->field('attachment_type, external_id')->select();
        foreach($records as &$record){
            if($record['attachment_type'] < \app\index\logic\Upload::ATTACH_FUND_PARTNER_AGREEMENT){
                $record['external_name'] = Db::table('enterprises')->where(['id'=>$record['external_id']])->value('name');
            }else if($record['attachment_type'] == \app\index\logic\Upload::ATTACH_FUND_CHANGE_LOGS) {
                $record['external_name'] = Db::table('change_logs')->alias('CL')->join('funds F', 'CL.external_id=F.fund_id', 'LEFT')
                    ->where(['CL.id'=>$record['external_id']])->value('concat(F.name, \' - \', CL.desc)');
            }else {
                $record['external_name'] = Db::table('funds')->where(['fund_id'=>$record['external_id']])->value('name');
            }
            if($record['external_name'] === null){
                $record['external_name'] = '未定义';
            }
        }
        return json([
            'total'=>$total,
            'rows'=>$records
        ]);
    }
    public function docsDelete($attachmentType, $externalId){
        return ajaxSuccess('成功');
    }
}