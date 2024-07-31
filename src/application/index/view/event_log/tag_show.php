<?php foreach ($tags as $category => $names): ?>
    [<?php echo \app\index\logic\Tag::CATEGORIES[$category]['name']; ?>]
    <?php foreach ($names as $v): ?>
        <span class="qt-tag-label mb-0">
        <?=$v?><a href="javascript:;" class="qt-tag-tag"></a>
    </span>
    <?php endforeach; ?>
<?php endforeach; ?>