<form class="pd-15">
    目标分类: <select class="easyui-combobox" editable="false" required="true" name="target_type" style="width:330px">
        <option value=""></option>
        <?php foreach ($types as $k=>$v): ?>
        <option value="<?=$k?>"><?=$v['label']?></option>
        <?php endforeach; ?>
    </select>
</form>