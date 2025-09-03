<?php foreach ($tags as $v): ?>
    <span class="qt-tag-label mb-0" tag-id="<?=$v['tag_id']?>">
        <?=$v['name']?><a href="javascript:;" class="qt-tag-tag"></a>
    </span>
<?php endforeach; ?>