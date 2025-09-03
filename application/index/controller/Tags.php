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

use app\index\logic\Tag;

class Tags extends Common
{

    public function setTags($category,$default_value='')
    {
        if ($this->request->isGet()) {
            $pools = Tag::I()->getTagsByCategory($category);
            $default_value = $default_value ? explode(',', $default_value) : [];
            $this->assign([
                'pools'=>$pools,
                'category'=>intval($category),
                'default_value'=>json_encode($default_value),
                'urls' => [
                    'add' => url('index/tags/add')
                ]
            ]);
            return $this->fetch();
        }
    }

    /**
     * 添加标签
     * @param string $name
     * @param int $category
     * @return mixed
     */
    public function add($name,$category)
    {
        try {
            $id = Tag::I()->addTag($name,$category);
            return ajaxSuccess('',['id'=>$id,'name'=>htmlspecialchars($name)]);
        } catch (\Exception $e) {
            return ajaxError($e->getMessage());
        }
    }

    public function showTagsBatch($category,$record_id){
        $rows = Tag::I()->getTagsBatch($category,$record_id);
        if (empty($rows)) {
            return json([]);
        }
        $data = [];
        foreach ($rows as $record_id=>$tags) {
            $data[$record_id] = $this->fetch('plugin/tagger_view',['tags'=>$tags]);
        }
        return json($data);
    }
}