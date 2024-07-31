<input type="hidden" id="<?=$id?>" name="<?=$name?>" value="<?=$value?>">
<div style="display:inline-block" class="qt-tagger-preview">
<?php foreach ($tags as $v): ?>
    <span class="qt-tag-label" tag-id="<?=$v['tag_id']?>">
        <?=$v['name']?><a href="javascript:;" class="qt-tag-remove" onclick="QT.tagger.remove(this,'<?=$id?>')"></a>
    </span>
<?php endforeach; ?>
</div>
<a class="easyui-linkbutton" iconCls="fa fa-plus" onclick="QT.tagger.work('<?=$url?>','<?=$title?>','<?=$id?>')">添加</a>