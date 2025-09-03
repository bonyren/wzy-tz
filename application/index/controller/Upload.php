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
use app\index\model\Attachments;
use think\image\Exception;
use think\Log;
use think\Db;
use think\Image;
use app\index\service\EventLogs;
use app\common\CommonDefs;
use app\index\logic\Upload as UploadLogic;
class Upload extends Common
{
    /**
     * 基于pdfjs.js, 来源于https://github.com/mozilla/pdf.js/
     * 移动端，支持安卓，但safari,微信浏览器iphone端不能正常显示pdf
     */
    public function pdf($url){
        $this->assign('url', $url);
        return $this->fetch();
    }
    /**
     * 基于pdfjs.js, 来源于https://mozilla.github.io/pdf.js/
     * pc端和移动端，但safari, 微信浏览器iphone端低版本情况下pdf显示异常
     */
    public function pdfjs($url){
        $this->assign('url', $url);
        return $this->fetch();
    }
    const ATTACHES_UI_BIG_STYLE = 1;
    const ATTACHES_UI_LIGHT_STYLE = 2;
    const ATTACHES_UI_TABLE_STYLE = 3;
    const ATTACHES_UI_DATAGRID_STYLE = 4;
    const ATTACHES_UI_LINK_STYLE = 5;

    public function upload(){
        $file = request()->file('upload');
        if($file == null){
            //if the uploading file size exceeded the allowed size, the $file is null
            uploadError('failed to get the upload file');
        }
        $uploadInfo = $file->getInfo();
        $originalName = $uploadInfo['name'];
        $originalType = $uploadInfo['type'];
        $originalSize = $uploadInfo['size'];
        $originalTmpName = $uploadInfo['tmp_name'];
        $originalError = $uploadInfo['error'];
        if($originalError != UPLOAD_ERR_OK){
            $errorDesc = "";
            if($originalError == UPLOAD_ERR_NO_FILE){
                $errorDesc = 'No file sent.';
            }else if($originalError == UPLOAD_ERR_INI_SIZE || $originalError == UPLOAD_ERR_FORM_SIZE){
                $errorDesc = 'Exceeded filesize limit ' . config('upload_max_filesize') . '.';
            }else{
                $errorDesc = 'Unknown errors.';
            }
            uploadError('failed to upload file, cause: ' . $errorDesc);
        }

        $fileInfo = $file->move(UPLOAD_DIR);
        if($fileInfo == null){
            uploadError('失败 - ' . $file->getError());
        }
        $saveName = $fileInfo->getSaveName();
        $url = convertUploadSaveName2FullUrl($saveName);
        $relativeUrl = convertUploadSaveName2RelativeUrl($saveName);
        $absoluteUrl = convertUploadSaveName2AbsoluteUrl($saveName);
        uploadSuccess('success', [
            'original_name'=>$originalName,
            'save_name'=>$saveName,
            'url'=>$url,
            'relative_url'=>$relativeUrl,
            'absolute_url'=>$absoluteUrl
        ]);
    }
    public function uploadImage(){
        $file = request()->file('upload');
        if($file == null){
            //if the uploading file size exceeded the allowed size, the $file is null
            uploadError('failed to get the upload file');
        }
        $uploadInfo = $file->getInfo();
        $originalName = $uploadInfo['name'];
        $originalType = $uploadInfo['type'];
        $originalSize = $uploadInfo['size'];
        $originalTmpName = $uploadInfo['tmp_name'];
        $originalError = $uploadInfo['error'];
        if($originalError != UPLOAD_ERR_OK){
            $errorDesc = "";
            if($originalError == UPLOAD_ERR_NO_FILE){
                $errorDesc = 'No file sent.';
            }else if($originalError == UPLOAD_ERR_INI_SIZE || $originalError == UPLOAD_ERR_FORM_SIZE){
                $errorDesc = 'Exceeded filesize limit ' . config('upload_max_filesize') . '.';
            }else{
                $errorDesc = 'Unknown errors.';
            }
            uploadError('failed to upload file, cause: ' . $errorDesc);
        }

        $fileInfo = $file->validate(['ext'=>'jpg,png,gif,jpeg'])->move(UPLOAD_DIR);
        if($fileInfo == null){
            uploadError('失败 - ' . $file->getError());
        }
        $saveName = $fileInfo->getSaveName();
        $url = convertUploadSaveName2FullUrl($saveName);
        $relativeUrl = convertUploadSaveName2RelativeUrl($saveName);
        $absoluteUrl = convertUploadSaveName2AbsoluteUrl($saveName);
        uploadSuccess('success', [
            'original_name'=>$originalName,
            'save_name'=>$saveName,
            'url'=>$url,
            'relative_url'=>$relativeUrl,
            'absolute_url'=>$absoluteUrl
        ]);
    }
    public function uploadImageFromCKEditor($CKEditorFuncNum){
        //$CKEditorFuncNum = input('get.CKEditorFuncNum');
        $file = request()->file('upload');
        if($file == null){
            //if the uploading file size exceeded the allowed size, the $file is null
            echo "<script type=\"text/javascript\">";
            echo "window.parent.CKEDITOR.tools.callFunction(" . $CKEditorFuncNum . ",''," . "'failed to receive the file');";
            echo "</script>";
            exit();
        }
        $fileName = $file->getFilename();
        $fileMime = $file->getMime();
        if($fileMime != "image/pjpeg" &&
            $fileMime != "image/jpeg" &&
            $fileMime != "image/png" &&
            $fileMime != "image/x-png" &&
            $fileMime != "image/gif" &&
            $fileMime != "image/bmp"){
            echo "<script type=\"text/javascript\">";
            echo "window.parent.CKEDITOR.tools.callFunction(" . $CKEditorFuncNum . ",''," . "'File format is incorrect（must be .jpg/.gif/.bmp/.png file）');";
            echo "</script>";
            exit();
        }
        $fileSize = $file->getSize();
        if($fileSize > 2 * 1024 * 1024){
            echo "<script type=\"text/javascript\">";
            echo "window.parent.CKEDITOR.tools.callFunction(" . $CKEditorFuncNum . ",''," . "'File size must not be greater than 2M');";
            echo "</script>";
            exit();
        }
        $uploadInfo = $file->getInfo();
        $originalName = $uploadInfo['name'];
        /******************************************************************************/
        $fileInfo = $file->move(UPLOAD_DIR);
        if($fileInfo == null){
            echo "<script type=\"text/javascript\">";
            echo "window.parent.CKEDITOR.tools.callFunction(" . $CKEditorFuncNum . ",''," . "'failed to receive the file');";
            echo "</script>";
            exit();
        }
        $saveName = $fileInfo->getSaveName();
        $url = convertUploadSaveName2AbsoluteUrl($saveName);//use the relative path to site root
        echo "<script type=\"text/javascript\">";
        echo "window.parent.CKEDITOR.tools.callFunction(" . $CKEditorFuncNum . ",'" . $url . "','');";
        echo "</script>";
        exit();
    }
    public function uploadAttach($attachmentType, $externalId, $externalId2=0, $attachmentCategoryId=0, $src=CommonDefs::MODULE_ADMIN, $pid=0)
    {
        $multi_files = request()->file('upload');
        if($multi_files == null){
            uploadError('failed to get the upload file');
        }
        $rules = config('upload');
        $uploaded = [];
        $failed = [];
        foreach ($multi_files as $idx=>$file) {
            Log::notice('uploadAttach, file info: ' . var_export($file->getInfo(), true));
            $uploadInfo = $file->getInfo();
            $originalName = $uploadInfo['name'];
            Log::notice('uploadAttach, original file name: ' . $originalName);
            /**************************************************************************/
            $fileInfo = $file->validate($rules)->move(UPLOAD_DIR);
            if($fileInfo == null){
                $failed[] = $uploadInfo['name'] . ': ' . $fileInfo->getError();
            }
            //20160820/42a79759f284b767dfcb2a0197904287.jpg
            //20160820\42a79759f284b767dfcb2a0197904287.jpg under windows
            $saveName = $fileInfo->getSaveName();
            //jpg
            $extensionName = $fileInfo->getExtension();
            //42a79759f284b767dfcb2a0197904287.jpg
            $fileName = $fileInfo->getFilename();
            $fileMime = $fileInfo->getMime();
            $fileSize = $fileInfo->getSize();
            Log::notice("uploadAttach, orginalName: {$originalName}, saveName: {$saveName}, fileName: {$fileName}, fileMine: {$fileMime}, filesize: {$fileSize}");
            //the absolute file path
            $filePath = convertUploadSaveName2DiskFullPath($fileInfo->getSaveName());
            $uploadLogic = \app\index\logic\Upload::newObj();
            $attachmentId = $uploadLogic->insertAttach($originalName, $saveName, $fileMime, $fileSize, '', $attachmentType, $externalId, $externalId2, $attachmentCategoryId, $src, $pid);
            if($attachmentId){
                if($fileMime == 'image/jpeg' || $fileMime == 'image/png' || $fileMime == 'image/gif'){
                    $thumbnail = url('Upload/thumbnailImage', ['attachmentId'=>$attachmentId]);
                }else{
                    $thumbnail = SITE_URL . '/static/img/file.png';
                }
                $uploaded[] = [
                    'attachment_id'=>$attachmentId,
                    'name'=>$originalName,
                    'size'=>round($fileSize/1024,2),
                    'href_url'=>convertUploadSaveName2FullUrl($saveName),
                    'thumbnail_url'=>$thumbnail,
                    'entered' => date('Y-m-d H:i'),
                    'download_url'=>url('Upload/downloadAttach', ['attachmentId'=>$attachmentId])
                ];
                if ($_GET['replace']) { //替换：只保留最新上传附件
                    Db::table('attachments')->where([
                        'attachment_type'=>$attachmentType,
                        'external_id'=>$externalId,
                        'attachment_id'=>['lt',$attachmentId],
                    ])->setField('status',Defs::ATTACHMENT_DEL);
                }
                if($externalId && isset(UploadLogic::$attachTypeDefs[$attachmentType])){
                    EventLogs::recordUpload(UploadLogic::$attachTypeDefs[$attachmentType]['entity_type'],
                        $externalId,
                        $attachmentId,
                        $attachmentType,
                        $originalName
                    );
                }
            } else {

            }
        }
        if (empty($uploaded)) {
            uploadError('fail');
        }
        $html = '';
        if ($failed) {
            $html .= '上传成功'.count($uploaded).'个，'.count($failed).'个失败：<br>';
            $html .= join('<br>',$failed);
        }
        uploadSuccess('success', $uploaded, $html);
    }

    public function uploadAttachZip($attachmentType, $externalId, $externalId2=0, $pid=0)
    {
        $file = request()->file('upload');
        if($file == null){
            uploadError('failed to get the upload file');
        }
        $rules = config('upload');
        Log::notice('uploadAttachZip, file info: ' . var_export($file->getInfo(), true));
        $uploadInfo = $file->getInfo();
        $originalName = $uploadInfo['name'];
        Log::notice('uploadAttachZip, original file name: ' . $originalName);
        /**************************************************************************/
        $fileInfo = $file->validate(array_merge($rules, ['ext'=>'zip']))->move(TEMP_DIR);
        if($fileInfo == null){
            uploadError('fail - ' . $fileInfo->getError());
        }
        //20160820/42a79759f284b767dfcb2a0197904287.jpg
        //20160820\42a79759f284b767dfcb2a0197904287.jpg under windows
        $saveName = $fileInfo->getSaveName();
        //jpg
        $extensionName = $fileInfo->getExtension();
        //42a79759f284b767dfcb2a0197904287.jpg
        $fileName = $fileInfo->getFilename();
        $fileMime = $fileInfo->getMime();
        $fileSize = $fileInfo->getSize();
        Log::notice("uploadAttachZip, orginalName: {$originalName}, saveName: {$saveName}, fileName: {$fileName}, fileMine: {$fileMime}, filesize: {$fileSize}");
        //the absolute file path
        $filePath = TEMP_DIR . DS . $fileInfo->getSaveName();
        $destinationPath = substr($filePath, 0, strlen($filePath)-strlen(".zip"));
        if(!mkdir($destinationPath)){
            uploadError('创建文件夹失败');
        };
        //extra files from zip
        $unzipExe = getUnzipFullPath();
        $cmdLine = sprintf("%s -o -q -d %s %s", $unzipExe, $destinationPath, $filePath);
        $result = system($cmdLine);
        if($result === FALSE){
            uploadError('解压文件失败');
        }

        $copyFolder = date("Ymd");
        $copyPath = UPLOAD_DIR . DS . $copyFolder;
        if(!file_exists($copyPath)){
            if(!mkdir($copyPath)){
                uploadError('创建文件夹失败');
            }
        }

        $this->scanAndSaveFiles($attachmentType, $externalId, $externalId2, $destinationPath, $copyFolder, $pid);
        uploadSuccess('success');

//        $files = [];
//        $this->fetchAllFilesRecursively($destinationPath, $files);
//        Log::notice("files: " . var_export($files, true));
//
//        $uploadLogic = \app\index\logic\Upload::newObj();
//        foreach($files as $file){
//			if(version_compare(PHP_VERSION, '7.0.0') < 0){
//				Log::notice("file: " . iconv('gbk', 'utf-8', $file));
//				$pathInfos = mb_pathInfo(iconv('gbk', 'utf-8', $file));
//			}else{
//				Log::notice("file: " . $file);
//				$pathInfos = mb_pathInfo($file);
//			}
//            if(!$pathInfos){
//                Log::error('failed to pathinfo, file:' . $file);
//                continue;
//            }
//            Log::notice('file path info: ' . var_export($pathInfos, true));
//            $fileOriginalName = $pathInfos['basename'];
//
//            $copyFilePath = $copyPath . DS;
//            $copyFilePath .= generateUniqid();
//            $copyFilePath .= isset($pathInfos['extension'])?'.'.$pathInfos['extension']:'';
//            Log::notice("file: $file, copyFilePath: $copyFilePath");
//            if(!copy($file, $copyFilePath)){
//                Log::error("failed to copy file from $file to $copyFilePath");
//                continue;
//            }
//            $fileMime = '';
//            $fileSize = fileSize($copyFilePath);
//            if($fileSize === FALSE){
//                Log::error('failed to fileSize, file:' . $copyFilePath);
//                continue;
//            }
//            $fileSaveName = substr($copyFilePath, strlen(UPLOAD_DIR . DS));
//
//            $categoryStr = substr($pathInfos['dirname'], strlen($destinationPath));
//            Log::notice('attachment category: ' . $categoryStr);
//            $categoryStr = trim($categoryStr, DS);
//            $attachmentCategory = str_replace(DS, '-', $categoryStr);
//            if(empty($attachmentCategory)){
//                $attachmentCategoryId = 0;
//            }else{
//                $attachmentCategoryId = Db::table('attachment_categories')->where(['attachment_type'=>$attachmentType, 'attachment_category'=>$attachmentCategory])->value('attachment_category_id');
//                if($attachmentCategoryId === null){
//                    $attachmentCategoryId = Db::table('attachment_categories')->insertGetId([
//                        'attachment_type'=>$attachmentType, 'attachment_category'=>$attachmentCategory
//                    ]);
//                }
//            }
//            $attachmentId = $uploadLogic->insertAttach($fileOriginalName, $fileSaveName, $fileMime, $fileSize, '', $attachmentType, $externalId, $externalId2, $attachmentCategoryId);
//        }
//
//        if ($externalId) {
//            logEvent(\app\index\logic\Upload::$attachTypeDefs[$attachmentType]['entity_type'],$externalId,'上传打包文件'.$originalName);
//        }
//
//        uploadSuccess('success');
    }

    protected  function fetchAllFilesRecursively($path, &$files){
        $curFiles = scandir($path);
        if(!$curFiles){
            return;
        }
        foreach($curFiles as $curFile){
            if($curFile=='.'||$curFile=='..'){
                continue;
            }
            $curFilePath = $path . DS . $curFile;
            if(is_dir($curFilePath)){
                $this->fetchAllFilesRecursively($curFilePath, $files);
            }else if(is_file($curFilePath)){
                $files[] = $curFilePath;
            }
        }
        return;
    }

    //扫描文件夹并入库（目录也存）
    protected function scanAndSaveFiles($attachmentType, $externalId, $externalId2, $path,$save_dir,$pid=0)
    {
        $files = scandir($path);
        if (empty($files)) {
            return;
        }
        foreach ($files as $file) {
            if($file=='.' || $file=='..'){
                continue;
            }
            $file = $path . DS . $file;
            $isdir = is_dir($file);

            if(version_compare(PHP_VERSION, '7.0.0') < 0){
                $file = iconv('gbk', 'utf-8', $file);
            }
            Log::notice('file: ' . $file);
            $info = pathinfo($file);
            //$info = mb_pathInfo($file);
            if(empty($info)){
                continue;
            }
            Log::notice('file pathinfo: ' . var_export($info, true));
            if ($isdir) {
                $save_name = '';
                $size = 0;
            } else {
                $save_name = $save_dir . DS . generateUniqid();
                if (isset($info['extension'])) {
                    $save_name .= '.'.$info['extension'];
                }
                $target = UPLOAD_DIR . DS . $save_name;
                if (!copy($file, $target)) {
                    continue;
                }
                $size = filesize($target);
            }
            $insert_id = Db::table('attachments')->insertGetId([
                'pid' => $pid,
                'original_name' => $info['basename'],
                'save_name' => $save_name,
                'size' => $size,
                'attachment_type' => $attachmentType,
                'external_id' => $externalId,
                'external_id2' => $externalId2,
                'isdir' => intval($isdir),
                'user_id' => $this->loginUserId,
                'user_type' => CommonDefs::MODULE_ADMIN,
            ]);
            if (empty($insert_id)) {
                continue;
            }
            if ($isdir) {
                $this->scanAndSaveFiles($attachmentType, $externalId, $externalId2, $file, $save_dir, $insert_id);
            }
        }
    }

    public function attaches($attachmentType,
                             $externalId,
                             $externalId2=0,
                             $callback='',
                             $uiStyle=self::ATTACHES_UI_BIG_STYLE,
                             $prompt='',
                             $fit=0,
                             $src=CommonDefs::MODULE_ADMIN,
                             $replace=0)
    {
        if(request()->isGet()){
            $urlHrefs = [
                'attaches'=>url('Upload/attaches', ['src'=>$src,'attachmentType'=>$attachmentType,'externalId'=>$externalId,'externalId2'=>$externalId2]),
                'uploadAttach'=>url('Upload/uploadAttach', ['src'=>$src,'attachmentType'=>$attachmentType,'externalId'=>$externalId,'externalId2'=>$externalId2,'replace'=>$replace]),
                'deleteAttaches'=>url('Upload/deleteAttaches'),
                'deleteAttach'=>url('Upload/deleteAttach'),
            ];
            $this->assign('urlHrefs', $urlHrefs);
            $uploadLogic = UploadLogic::newObj();
            $attaches = $uploadLogic->getAttaches($attachmentType, $externalId, $externalId2);
            for($i=0,$count=count($attaches); $i<$count; $i++){
                $mimeType = $attaches[$i]['mime_type'];
                if($mimeType == 'image/jpeg' || $mimeType == 'image/png' || $mimeType == 'image/gif'){
                    $attaches[$i]['thumbnail_url'] = url('Upload/thumbnailImage', ['attachmentId'=>$attaches[$i]['attachment_id']]);
                }else{
                    $attaches[$i]['thumbnail_url'] = SITE_URL . '/static/img/file.png';
                }
                $attaches[$i]['download_url'] = url('Upload/downloadAttach', ['attachmentId'=>$attaches[$i]['attachment_id']]);
            }
            $bindValues = [
                'attachmentType'=>$attachmentType,
                'externalId'=>$externalId,
                'attaches'=>$attaches,
                'replace'=>$replace, //只能传一个文件，每次上传会覆盖上一个文件
                'callback'=>$callback,
            ];
            $this->assign('bindValues', $bindValues);
            $this->assign('uniqid', generateUniqid());
            $this->assign('prompt', $prompt);
            $this->assign('fit', $fit);
            switch($uiStyle){
                case self::ATTACHES_UI_BIG_STYLE:
                    return $this->fetch();
                    break;
                case self::ATTACHES_UI_LIGHT_STYLE:
                    return $this->fetch('attaches_light');
                    break;
                case self::ATTACHES_UI_TABLE_STYLE:
                    return $this->fetch('attaches_table');
                    break;
                case self::ATTACHES_UI_DATAGRID_STYLE:
                    return $this->fetch('attaches_datagrid');
                    break;
                case self::ATTACHES_UI_LINK_STYLE:
                    return $this->fetch('attaches_link');
                    break;
                default:
                    return $this->fetch();
            }
        }
        /***************************************************************************************************************/
        $uploadLogic = UploadLogic::newObj();
        $attaches = $uploadLogic->getAttaches($attachmentType, $externalId, $externalId2, $src);
        for($i=0,$count=count($attaches); $i<$count; $i++){
            $mimeType = $attaches[$i]['mime_type'];
            if($mimeType == 'image/jpeg' || $mimeType == 'image/png' || $mimeType == 'image/gif'){
                $attaches[$i]['thumbnail_url'] = url('Upload/thumbnailImage', ['attachmentId'=>$attaches[$i]['attachment_id']]);
            }else{
                $attaches[$i]['thumbnail_url'] = SITE_URL . '/static/img/file.png';
            }
            $attaches[$i]['download_url'] = url('Upload/downloadAttach', ['attachmentId'=>$attaches[$i]['attachment_id']]);
        }
        return json($attaches);
    }

    public function viewAttaches($attachmentType, $externalId, $externalId2=0, $uiStyle=self::ATTACHES_UI_BIG_STYLE, $fit=0)
    {
        if(request()->isGet()){
            $urlHrefs = [
                'attaches'=>url('Upload/attaches', ['attachmentType'=>$attachmentType, 'externalId'=>$externalId,'externalId2'=>$externalId2]),
            ];
            $this->assign('urlHrefs', $urlHrefs);
            $uploadLogic = UploadLogic::newObj();
            $attaches = $uploadLogic->getAttaches($attachmentType, $externalId, $externalId2);
            for($i=0,$count=count($attaches); $i<$count; $i++){
                $mimeType = $attaches[$i]['mime_type'];
                if($mimeType == 'image/jpeg' || $mimeType == 'image/png' || $mimeType == 'image/gif'){
                    $attaches[$i]['thumbnail_url'] = url('Upload/thumbnailImage', ['attachmentId'=>$attaches[$i]['attachment_id']]);
                }else{
                    $attaches[$i]['thumbnail_url'] = SITE_URL . '/static/img/file.png';
                }
                $attaches[$i]['download_url'] = url('Upload/downloadAttach', ['attachmentId'=>$attaches[$i]['attachment_id']]);
            }
            $bindValues = [
                'attachmentType'=>$attachmentType,
                'externalId'=>$externalId,
                'externalId2'=>$externalId2,
                'attaches'=>$attaches
            ];
            $this->assign('bindValues', $bindValues);
            $this->assign('uniqid', generateUniqid());
            $this->assign('fit', $fit);
            $this->assign('downloadAble', session('lp') ? false : true);
            switch($uiStyle){
                case self::ATTACHES_UI_BIG_STYLE:
                    return $this->fetch();
                    break;
                case self::ATTACHES_UI_LIGHT_STYLE:
                    return $this->fetch('view_attaches_light');
                    break;
                case self::ATTACHES_UI_TABLE_STYLE:
                    return $this->fetch('view_attaches_table');
                    break;
                case self::ATTACHES_UI_DATAGRID_STYLE:
                    return $this->fetch('view_attaches_datagrid');
                    break;
                case self::ATTACHES_UI_LINK_STYLE:
                    return $this->fetch('view_attaches_link');
                    break;
                default:
                    return $this->fetch();
            }
        }
        /***************************************************************************************************************/
        $uploadLogic = UploadLogic::newObj();
        $attaches = $uploadLogic->getAttaches($attachmentType, $externalId, $externalId2);
        for($i=0,$count=count($attaches); $i<$count; $i++){
            $mimeType = $attaches[$i]['mime_type'];
            if($mimeType == 'image/jpeg' || $mimeType == 'image/png' || $mimeType == 'image/gif'){
                $attaches[$i]['thumbnail_url'] = url('Upload/thumbnailImage', ['attachmentId'=>$attaches[$i]['attachment_id']]);
            }else{
                $attaches[$i]['thumbnail_url'] = SITE_URL . '/static/img/file.png';
            }
            $attaches[$i]['download_url'] = url('Upload/downloadAttach', ['attachmentId'=>$attaches[$i]['attachment_id']]);
        }
        return json($attaches);
    }

    public function previewAttach($attachmentId, $newTab=0)
    {
        $attach = Db::table('attachments')->where('attachment_id', $attachmentId)->field('attachment_id,save_name,size')->find();
        if(!$attach){
            return $this->fetch('common/error');
        }
        $ext = explode('.',$attach['save_name']);
        $ext = $ext[count($ext)-1];
        //we must convert the \ to / in url to compatible the windows system
        $url = convertUploadSaveName2FullUrl($attach['save_name']);
        $preview_url = $url;
        switch (strtolower($ext)) {
            case 'doc':
            case 'docx':
            case 'xls':
            case 'xlsx':
            case 'ppt':
            case 'pptx':
                $attach['preview_type'] = 'office';
                $preview_url = 'https://view.officeapps.live.com/op/view.aspx?src='.$url;
                break;
            case 'pdf':
                $attach['preview_type'] = 'pdf';
                if($this->loginMobile && !isSafari()){
                    $preview_url = url('index/Upload/pdfjs', ['url'=> $url]);
                }
                break;
            case 'jpg':
            case 'png':
            case 'gif':
            case 'jpeg':
                $attach['preview_type'] = 'image';
                break;
            default:
                $attach['preview_type'] = false;
                $attach['error_msg'] = "can't support the file type to preview, please download it";
        }
        if (false != $attach['preview_type']) {
            $filePath = convertUploadSaveName2DiskFullPath($attach['save_name']);
            if(!file_exists($filePath)){
                $attach['preview_type'] = false;
                $attach['error_msg'] = 'can not find the file';
            }else {
                $filesize = filesize(iconv("UTF-8", "gb2312", $filePath));
                if ($filesize > config('upload.allow_preview_max_size')) {
                    $attach['preview_type'] = false;
                    $attach['error_msg'] = 'the file size is too large, max allowed file size: ' . config('upload.allow_preview_max_size');
                }
            }
        }
        if ($newTab) {
            if (!$attach['preview_type']) {
                return $attach['error_msg'];
            }
            $this->redirect($preview_url);
        }

        $attach['preview_url'] = $preview_url;
        $this->assign($attach);
        return $this->fetch();
    }

    public function deleteAttach($attachmentId){
        $uploadLogic = UploadLogic::newObj();
        $uploadLogic->deleteAttach($attachmentId);
        return ajaxSuccess('成功');
    }
    public function deleteAttaches($attachmentIds){
        $uploadLogic = UploadLogic::newObj();
        foreach($attachmentIds as $attachmentId){
            $uploadLogic->deleteAttach($attachmentId);
        }
        return ajaxSuccess('成功');
    }
    public function downloadAttach($attachmentId){
        $attach = Db::table('attachments')->where('attachment_id', $attachmentId)->field('attachment_id,original_name,save_name,mime_type,isdir')->find();
        if(!$attach){
            return $this->fetch('common/error');
        }
        if ($attach['isdir']) {
            exit('暂不支持下载文件夹');
        }
        $originalPath = convertUploadSaveName2DiskFullPath($attach['save_name']);
        if(!file_exists($originalPath)){
            return $this->fetch('common/error');
        }
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Content-Type: application/force-download');
        header('Content-Length: ' . filesize($originalPath));
        header("Content-Disposition: attachment; filename=" . $attach['original_name']);
        readfile($originalPath);
        exit();
    }
    public function thumbnailImage($attachmentId){
        $imagePath = STATIC_DIR . DS . 'img/no_image.jpg';
        $imageType = 'image/jpeg';
        $attach = Db::table('attachments')->where('attachment_id', $attachmentId)->field('attachment_id,save_name,mime_type')->find();
        //check if the thumbnail image exist, otherwise create it.
        if($attach){
            $thumbnailPath = convertUploadSaveNameThumbnail2DiskFullPath($attach['save_name']);
            if(file_exists($thumbnailPath)){
                $imagePath = $thumbnailPath;
                $imageType = $attach['mime_type'];
            }else{
                //create the thumbnail image
                $originalPath = convertUploadSaveName2DiskFullPath($attach['save_name']);
                if(file_exists($originalPath)){
                    try {
                        $image = Image::open($originalPath);
                        $image->thumb(100, 100);
                        $image->save($thumbnailPath);
                        $imagePath = $thumbnailPath;
                        $imageType = $attach['mime_type'];
                    }catch (Exception $e){
                        Log::error('exception occur when create thumbnail image for ' . $originalPath);
                    }
                }
            }
        }
        //output the image
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Content-Type: ' . $imageType);
        header('Content-Length: ' . filesize($imagePath));
        echo file_get_contents($imagePath);
        exit();
    }

    /*******************************************************************************************************************/
    public function attachesComplex($attachmentType,$externalId,$externalId2=0,$readOnly=0, $fit=0, $search=[], $pid=0)
    {
        if(request()->isGet()){
            $urlHrefs = [
                'attachesComplex'=>url('Upload/attachesComplex', ['attachmentType'=>$attachmentType,'externalId'=>$externalId,'externalId2'=>$externalId2]),
                'attachesCategorySave'=>url('Upload/attachesCategorySave'),
                'attachesCategoryDelete'=>url('Upload/attachesCategoryDelete'),
                'attachesCategoryChange'=>url('Upload/attachesCategoryChange'),
                'attachesCategoryDefs'=>url('Upload/attachesCategoryDefs', ['attachmentType'=>$attachmentType]),
                'uploadAttach'=>url('Upload/uploadAttach', ['attachmentType'=>$attachmentType,'externalId'=>$externalId,'externalId2'=>$externalId2]),
                'uploadAttachZip'=>url('Upload/uploadAttachZip', ['attachmentType'=>$attachmentType,'externalId'=>$externalId,'externalId2'=>$externalId2]),
                'deleteAttach'=>url('Upload/deleteAttach'),
                'deleteAttaches'=>url('Upload/deleteAttaches'),
            ];
            $this->assign('urlHrefs', $urlHrefs);
            $bindValues = [
                'attachmentType'=>$attachmentType,
                'externalId'=>$externalId,
                'externalId2'=>$externalId2
            ];
            $this->assign('bindValues', $bindValues);
            $this->assign('uniqid', generateUniqid());
            $this->assign('readOnly', $readOnly);
            $this->assign('fit', $fit);
            $categoryDefs = Db::table('attachment_categories')->where('attachment_type', $attachmentType)->column('attachment_category', 'attachment_category_id');
            if(!$categoryDefs){
                $categoryDefs = [];
            }
            $categoryDefs['0'] = '未分类';
            $this->assign('categoryDefs', $categoryDefs);
            return $this->fetch();
        }
        $conditions = ['attachment_type'=>$attachmentType,'external_id'=>$externalId,'status'=>Defs::ATTACHMENT_OK];
        if(isset($search['name']) && $search['name']){
            $conditions['original_name'] = ['like', '%' . trim($search['name']) . '%'];
        }
        if($externalId2){
            $conditions['external_id2'] = $externalId2;
        }
        $conditions['pid'] = $pid;
        $attaches = Db::table('attachments')->where($conditions)->field(true)->order('entered desc')->select();
        for($i=0,$count=count($attaches); $i<$count; $i++){
            $mimeType = $attaches[$i]['mime_type'];
            if($mimeType == 'image/jpeg' || $mimeType == 'image/png' || $mimeType == 'image/gif'){
                $attaches[$i]['thumbnail_url'] = url('Upload/thumbnailImage', ['attachmentId'=>$attaches[$i]['attachment_id']]);
            }else{
                $attaches[$i]['thumbnail_url'] = SITE_URL . '/static/img/file.png';
            }
            $attaches[$i]['download_url'] = url('Upload/downloadAttach', ['attachmentId'=>$attaches[$i]['attachment_id']]);
        }
        $additionalCategories = Db::table('attachment_categories')->where([
            'attachment_type'=>$attachmentType,
            'attachment_category_id'=>[
                'not in',
                function($query) use($attachmentType){
                    $query->table('attachments')->where('attachment_type', $attachmentType)->field('attachment_category_id');
                }
            ]
        ])->field(true)->select();
        foreach($additionalCategories as $additionalCategory){
            $attaches[] = [
                'attachment_id'=>0,
                'original_name'=>'',
                'save_name'=>'',
                'mime_type'=>'',
                'description'=>'',
                'size'=>'',
                'attachment_type'=>$attachmentType,
                'external_id'=>0,
                'attachment_category_id'=>$additionalCategory['attachment_category_id'],
                'entered'=>Defs::DEFAULT_DB_DATETIME_VALUE,
                'user_id'=>0
            ];
        }
        return json($attaches);
    }
    public function attachesCategorySave($attachmentCategoryId = 0){
        if(!input('?post.attachment_type') || !input('?post.attachment_category')){
            return ajaxError('非法参数');
        }
        $attachmentType = input('post.attachment_type');
        $attachmentCategory = input('post.attachment_category');
        if(0==$attachmentCategoryId){
            //add
            Db::table('attachment_categories')->insert([
                'attachment_type'=>$attachmentType,
                'attachment_category'=>$attachmentCategory
            ]);
        }else{
            //update
            Db::table('attachment_categories')->where('attachment_category_id', $attachmentCategoryId)->update([
                'attachment_category'=>$attachmentCategory
            ]);
        }
        $categoryDefs = Db::table('attachment_categories')->where('attachment_type', $attachmentType)->column('attachment_category', 'attachment_category_id');
        if(!$categoryDefs){
            $categoryDefs = [];
        }
        $categoryDefs['0'] = '未分类';
        $this->assign('categoryDefs', $categoryDefs);
        return ajaxSuccess('成功', $categoryDefs);
    }
    public function attachesCategoryDelete($attachmentCategoryId){
        $attachmentType = Db::table('attachment_categories')->where('attachment_category_id', $attachmentCategoryId)->value('attachment_type');
        if($attachmentType === null){
            return ajaxError('无法找到该类别');
        }
        Db::table('attachment_categories')->where('attachment_category_id', $attachmentCategoryId)->delete();
        Db::table('attachments')->where('attachment_category_id', $attachmentCategoryId)->setField('status',Defs::ATTACHMENT_DEL);

        $categoryDefs = Db::table('attachment_categories')->where('attachment_type', $attachmentType)->column('attachment_category', 'attachment_category_id');
        if(!$categoryDefs){
            $categoryDefs = [];
        }
        $categoryDefs['0'] = '未分类';
        $this->assign('categoryDefs', $categoryDefs);
        return ajaxSuccess('成功', $categoryDefs);
    }
    public function attachesCategoryChange($attachmentId, $attachmentCategoryId){
        Db::table('attachments')->where('attachment_id', $attachmentId)->update([
            'attachment_category_id'=>$attachmentCategoryId
        ]);
        return ajaxSuccess('成功');
    }
    public function attachesCategoryDefs($attachmentType){
        $categoryDefs = Db::table('attachment_categories')->where('attachment_type', $attachmentType)->column('attachment_category', 'attachment_category_id');
        if(!$categoryDefs){
            $categoryDefs = [];
        }
        $categoryDefs['0'] = '未分类';
        return ajaxSuccess('成功', $categoryDefs);
    }

    /**
     * 修改附件分类 - 单个或批量
     * @param int|string|array $attachmentId
     * @param int $entity_type
     * @param int $target_type
     * @return mixed
     */
    public function setAttachesType($attachmentId,$entity_type,$target_type=0){
        if ($this->request->isGet()) {
            $types = array_filter(UploadLogic::$attachTypeDefs,function($v) use ($entity_type){
                return $entity_type == $v['entity_type'];
            });
            return $this->fetch('',['types'=>$types]);
        }
        if (empty($target_type)) {
            return ajaxError('请选择目标分类');
        }
        if (!is_array($attachmentId)) {
            $attachmentId = explode(',', $attachmentId);
        }
        $where['attachment_id'] = count($attachmentId)>1 ? ['in',$attachmentId] : $attachmentId[0];
        Attachments::update(['attachment_type'=>$target_type,'pid'=>0],$where);
        return ajaxSuccess('修改成功');
    }

    //移动文件到指定目录下
    public function changeDir($attachment_id,$pid) {
        Attachments::update(['pid'=>$pid],['attachment_id'=>$attachment_id]);
        return ajaxSuccess('移动成功');
    }

    public function addDir($external_id, $attachment_type, $dir_name, $external_id2=0, $pid=0){
        Db::table('attachments')->insertGetId([
            'original_name' => $dir_name,
            'attachment_type' => $attachment_type,
            'external_id' => $external_id,
            'external_id2' => $external_id2,
            'pid'=>$pid,
            'isdir' => 1,
            'user_id' => $this->loginUserId,
            'user_type' => CommonDefs::MODULE_ADMIN,
        ]);
        return ajaxSuccess('成功');
    }

}
