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

use think\Db;
use think\Log;
use think\Debug;
use app\index\logic\Upload;

class Docs extends Common{
    public function _initialize(){
        parent::_initialize();
    }
    public function index($owned=0){
        $this->assign('owned', $owned);
        return $this->fetch();
    }
    /**
     * @param int $category 1-项目, 2-基金，3-LP
     */
    public function files($category = 1, $page=1, $rows=DEFAULT_PAGE_ROWS, $search=[], $owned=0){
        if($this->request->isGet()){
            $this->assign('category', $category);
            $this->assign('owned', $owned);
            return $this->fetch();
        }
        $files = [];
        if($category == 1){
            $files = $this->_loadEnterpriseFiles($page, $rows, $search, $owned);
        }else if($category == 2){
            $files = $this->_loadFundFiles($page, $rows, $search, $owned);
        }
        return json($files);
    }
    protected function _loadEnterpriseFiles($page=1, $rows=DEFAULT_PAGE_ROWS, $search=[], $owned=0){
        $conditions = [];
        if(!emptyInArray($search, 'name')){
            $conditions['E.name'] = ['like', '%' . $search['name'] . '%'];
        }
        $totalFiles = [];
        $total = Db::table('enterprises')->alias('E')
            ->join('attachments A', 'A.external_id=E.id')
            ->where('A.attachment_type', 'between', [1, 99])
            ->where('A.isdir', '=', 0)
            ->where($conditions)
            ->group('E.id')
            ->field('A.*,E.id,E.name')
            ->count();
        $enterprises = Db::table('enterprises')->alias('E')
            ->join('attachments A', 'A.external_id=E.id')
            ->where('A.attachment_type', 'between', [1, 99])
            ->where('A.isdir', '=', 0)
            ->where($conditions)
            ->group('E.id')
            ->page($page, $rows)
            ->order('E.id asc')
            ->field('A.*,E.id,E.name')
            ->select();
        //Log::notice("_loadEnterpriseFiles rows: " . var_export($rows, true));
        foreach($enterprises as $enterprise){
            //企业
            $enterpriseId = $enterprise['id'];
            $enterpriseName = $enterprise['name'];
            $enterpriseFile = [
                'id'=>$enterpriseId,
                'name'=>$enterpriseName,
                'type'=>'',
                'size'=>'',
                'entered'=>'',
                'user'=>'',
                "state"=>"closed",
                'children'=>[]
            ];
            //类型
            $categories = Db::table('attachments')->where('external_id', $enterpriseId)
                ->where('attachment_type', 'between', [1, 99])
                ->where('isdir', '=', 0)
                ->group('attachment_type')
                ->order('attachment_type asc')
                ->field('attachment_type')
                ->select();
            foreach($categories as $category){
                $categoryId = $enterpriseId . '_' . $category['attachment_type'];
                $categoryName = Upload::$attachTypeDefs[$category['attachment_type']]['label'];
                $categoryFile = [
                    'id'=>$categoryId,
                    'name'=>$categoryName,
                    'type'=>'',
                    'size'=>'',
                    'entered'=>'',
                    'user'=>'',
                    'children'=>[]
                ];
                $files = Db::table('attachments')->where('external_id', $enterpriseId)
                    ->where('attachment_type', $category['attachment_type'])
                    ->where('isdir', '=', 0)
                    ->order('attachment_id asc')
                    ->field('*')
                    ->select();
                foreach($files as $file){
                    $attachId = $categoryId . '_' . $file['attachment_id'];
                    $attachName = $file['original_name'];

                    $user = '';
                    if($file['user_type'] == 1){
                        $user = Db::table('admins')->where('admin_id', $file['user_id'])->value('realname');
                    }
                    $type = '';
                    $pathParts = pathinfo($file['save_name']);
                    if($pathParts){
                        if(isset(Upload::$attachFileTypeDefs[strtolower($pathParts['extension'])])){
                            $type = '<span class="' . Upload::$attachFileTypeDefs[strtolower($pathParts['extension'])]['icon'] . '"> ' . Upload::$attachFileTypeDefs[strtolower($pathParts['extension'])]['label'] . "</span>";
                        }
                    }
                    $categoryFile['children'][] = [
                        'id'=>$attachId,
                        'name'=>$attachName,
                        'type'=>$type,
                        'size'=>$file['size'],
                        'entered'=>$file['entered'],
                        'user'=>$user,
                    ];
                }
                $enterpriseFile['children'][] = $categoryFile;
            }
            $totalFiles[] = $enterpriseFile;
        }
        return [
            'total'=>$total,
            'rows'=>$totalFiles
        ];    
    }
    /*
    protected function _loadEnterpriseFiles($search=[]){
        $conditions = [];
        if(!emptyInArray($search, 'name')){
            $conditions['E.name'] = ['like', '%' . $search['name'] . '%'];
        }
        $files = [];
        $records = Db::table('attachments')->alias('A')
            ->join('enterprises E', 'A.external_id=E.id')
            ->where('A.attachment_type', 'between', [1, 99])
            ->where('A.isdir', '=', 0)
            ->where($conditions)
            ->order('E.id asc, A.attachment_type asc')
            ->field('A.*,E.id,E.name')
            ->select();
        foreach($records as $record){
            $enterpriseId = $record['id'];
            $enterpriseName = $record['name'];

            $categoryId = $record['id'] . '_' . $record['attachment_type'];
            $categoryName = Upload::$attachTypeDefs[$record['attachment_type']]['label'];

            $attachId = $record['id'] . '_' . $record['attachment_type'] . '_' . $record['attachment_id'];
            $attachName = $record['original_name'];
            //项目
            $bFind = false;
            foreach($files as $file){
                if($file['id'] == $enterpriseId){
                    $categoryFiles = &$file['children'];
                    $bFind = true;
                    break;
                }
            }
            if(!$bFind){
                $files[] = [
                    'id'=>$enterpriseId,
                    'name'=>$enterpriseName,
                    'type'=>'',
                    'size'=>'',
                    'entered'=>'',
                    'user'=>'',
                    "state"=>"closed",
                    'children'=>[]
                ];
                $categoryFiles = &$files[count($files) - 1]['children'];
            }
            //类型
            $bFind = false;
            foreach($categoryFiles as $file){
                if($file['id'] == $categoryId){
                    $fileFiles = &$file['children'];
                    $bFind = true;
                    break;
                }
            }
            if(!$bFind){
                $categoryFiles[] = [
                    'id'=>$categoryId,
                    'name'=>$categoryName,
                    'type'=>'',
                    'size'=>'',
                    'entered'=>'',
                    'user'=>'',
                    'children'=>[]
                ];
                $fileFiles = &$categoryFiles[count($categoryFiles) - 1]['children'];
            }
            //文件
            $user = '';
            if($record['user_type'] == 1){
                $user = Db::table('admins')->where('admin_id', $record['user_id'])->value('realname');
            }
            $type = '';
            $pathParts = pathinfo($record['save_name']);
            if($pathParts){
                if(isset(Upload::$attachFileTypeDefs[strtolower($pathParts['extension'])])){
                    $type = '<span class="' . Upload::$attachFileTypeDefs[strtolower($pathParts['extension'])]['icon'] . '"> ' . Upload::$attachFileTypeDefs[strtolower($pathParts['extension'])]['label'] . "</span>";
                }
                
            }
            $fileFiles[] = [
                'id'=>$attachId,
                'name'=>$attachName,
                'type'=>$type,
                'size'=>$record['size'],
                'entered'=>$record['entered'],
                'user'=>$user,
            ];
        }
        return $files;
    }*/

    protected function _loadFundFiles($page=1, $rows=DEFAULT_PAGE_ROWS, $search=[], $owned=0){
        $conditions = [];
        if(!emptyInArray($search, 'name')){
            $conditions['F.name'] = ['like', '%' . $search['name'] . '%'];
        }
        $totalFiles = [];
        $total = Db::table('funds')->alias('F')
            ->join('attachments A', 'A.external_id=F.fund_id')
            ->where('A.attachment_type', 'between', [100, 199])
            ->where('A.isdir', '=', 0)
            ->where($conditions)
            ->group('F.fund_id')
            ->count();
        $funds = Db::table('funds')->alias('F')
            ->join('attachments A', 'A.external_id=F.fund_id')
            ->where('A.attachment_type', 'between', [100, 199])
            ->where('A.isdir', '=', 0)
            ->where($conditions)
            ->group('F.fund_id')
            ->page($page, $rows)
            ->order('F.fund_id asc')
            ->field('A.*,F.fund_id,F.name')
            ->select();
        //Log::notice("_loadEnterpriseFiles rows: " . var_export($rows, true));
        foreach($funds as $fund){
            //企业
            $fundId = $fund['fund_id'];
            $fundName = $fund['name'];
            $fundFile = [
                'id'=>$fundId,
                'name'=>$fundName,
                'type'=>'',
                'size'=>'',
                'entered'=>'',
                'user'=>'',
                "state"=>"closed",
                'children'=>[]
            ];
            //类型
            $categories = Db::table('attachments')->where('external_id', $fundId)
                ->where('attachment_type', 'between', [100, 199])
                ->where('isdir', '=', 0)
                ->group('attachment_type')
                ->order('attachment_type asc')
                ->field('attachment_type')
                ->select();
            foreach($categories as $category){
                $categoryId = $fundId . '_' . $category['attachment_type'];
                $categoryName = Upload::$attachTypeDefs[$category['attachment_type']]['label'];
                $categoryFile = [
                    'id'=>$categoryId,
                    'name'=>$categoryName,
                    'type'=>'',
                    'size'=>'',
                    'entered'=>'',
                    'user'=>'',
                    'children'=>[]
                ];
                $files = Db::table('attachments')->where('external_id', $fundId)
                    ->where('attachment_type', $category['attachment_type'])
                    ->where('isdir', '=', 0)
                    ->order('attachment_id asc')
                    ->field('*')
                    ->select();
                foreach($files as $file){
                    $attachId = $categoryId . '_' . $file['attachment_id'];
                    $attachName = $file['original_name'];

                    $user = '';
                    if($file['user_type'] == 1){
                        $user = Db::table('admins')->where('admin_id', $file['user_id'])->value('realname');
                    }
                    $type = '';
                    $pathParts = pathinfo($file['save_name']);
                    if($pathParts){
                        if(isset(Upload::$attachFileTypeDefs[strtolower($pathParts['extension'])])){
                            $type = '<span class="' . Upload::$attachFileTypeDefs[strtolower($pathParts['extension'])]['icon'] . '"> ' . Upload::$attachFileTypeDefs[strtolower($pathParts['extension'])]['label'] . "</span>";
                        }
                    }
                    $categoryFile['children'][] = [
                        'id'=>$attachId,
                        'name'=>$attachName,
                        'type'=>$type,
                        'size'=>$file['size'],
                        'entered'=>$file['entered'],
                        'user'=>$user,
                    ];
                }
                $fundFile['children'][] = $categoryFile;
            }
            $totalFiles[] = $fundFile;
        }
        return [
            'total'=>$total,
            'rows'=>$totalFiles
        ];    
    }
    /*
    protected function _loadFundFiles($search=[]){
        $conditions = [];
        if(!emptyInArray($search, 'name')){
            $conditions['E.name'] = ['like', '%' . $search['name'] . '%'];
        }
        $files = [];
        $records = Db::table('attachments')->alias('A')
            ->join('funds F', 'A.external_id=F.fund_id')
            ->where('A.attachment_type', 'between', [100, 199])
            ->where('A.isdir', '=', 0)
            ->where($conditions)
            ->order('F.fund_id asc, A.attachment_type asc')
            ->field('A.*,F.fund_id,F.name')
            ->select();
        foreach($records as $record){
            $fundId = $record['fund_id'];
            $fundName = $record['name'];

            $categoryId = $record['fund_id'] . '_' . $record['attachment_type'];
            $categoryName = Upload::$attachTypeDefs[$record['attachment_type']]['label'];

            $attachId = $record['fund_id'] . '_' . $record['attachment_type'] . '_' . $record['attachment_id'];
            $attachName = $record['original_name'];
            //项目
            $bFind = false;
            foreach($files as $file){
                if($file['id'] == $fundId){
                    $categoryFiles = &$file['children'];
                    $bFind = true;
                    break;
                }
            }
            if(!$bFind){
                $files[] = [
                    'id'=>$fundId,
                    'name'=>$fundName,
                    'type'=>'',
                    'size'=>'',
                    'entered'=>'',
                    'user'=>'',
                    "state"=>"closed",
                    'children'=>[]
                ];
                $categoryFiles = &$files[count($files) - 1]['children'];
            }
            //类型
            $bFind = false;
            foreach($categoryFiles as $file){
                if($file['id'] == $categoryId){
                    $fileFiles = &$file['children'];
                    $bFind = true;
                    break;
                }
            }
            if(!$bFind){
                $categoryFiles[] = [
                    'id'=>$categoryId,
                    'name'=>$categoryName,
                    'type'=>'',
                    'size'=>'',
                    'entered'=>'',
                    'user'=>'',
                    'children'=>[]
                ];
                $fileFiles = &$categoryFiles[count($categoryFiles) - 1]['children'];
            }
            //文件
            $user = '';
            if($record['user_type'] == 1){
                $user = Db::table('admins')->where('admin_id', $record['user_id'])->value('realname');
            }
            $type = '';
            $pathParts = pathinfo($record['save_name']);
            if($pathParts){
                if(isset(Upload::$attachFileTypeDefs[strtolower($pathParts['extension'])])){
                    $type = '<span class="' . Upload::$attachFileTypeDefs[strtolower($pathParts['extension'])]['icon'] . '"> ' . Upload::$attachFileTypeDefs[strtolower($pathParts['extension'])]['label'] . "</span>";
                }
                
            }
            $fileFiles[] = [
                'id'=>$attachId,
                'name'=>$attachName,
                'type'=>$type,
                'size'=>$record['size'],
                'entered'=>$record['entered'],
                'user'=>$user,
            ];
        }
        return $files;
    }*/
}