<select <?=$options['id']?('id="'.$options['id'].'"'):''?> class="easyui-combobox" name="<?=$options['name']?>" style="width:<?=$options['width']?$options['width']:'90%'?>;"
    data-options="
        editable:false,
        value:'<?=$options['value']?>',
        required:<?=$options['required']?'true':'false'?>">
    <option value=""></option>
    <?php foreach ($items as $v): ?>
    <option value="<?=$v['value']?>"><?=$v['label']?></option>
    <?php endforeach; ?>
</select>