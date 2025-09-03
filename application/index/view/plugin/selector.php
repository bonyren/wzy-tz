<input type="hidden" id="<?=$elem_id?>" name="<?=$name?>" value="<?=$value?>">
<div style="display:inline-block" class="qt-plug-selector-preview <?=$readonly?'selector-readonly':''?>">
<?php foreach ($data_rows as $v): ?>
    <span class="i-act-btn">
        <?php echo $v[$label_field]; ?>
        <?php if (!$readonly): ?>
        <a href="javascript:void(0)" class="qt-plug-selector-remove" target-elem="#<?=$elem_id?>" target-val="<?=$v[$value_field]?>"></a>
        <?php endif; ?>
    </span>
<?php endforeach; ?>
</div>
<?php if (!$readonly): ?>
<a class="easyui-linkbutton qt-plug-selector-btn" iconCls="fa fa-search-plus"
   qt-plug-options="
        valElem:'#<?=$elem_id?>',
        valField:'<?=$value_field?>',
        txtField:'<?=$label_field?>',
        multiple:<?=$multiple?'true':'false'?>,
        type:'<?=$type?>',
        onSelected:<?=$callback?>,
        url:'<?=$url?>'"><?=$btn_text?></a>
<?php endif; ?>