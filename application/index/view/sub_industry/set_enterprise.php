<form method="post" style="height:100%">
    <table class="table-form" cellpadding="5">
        <tr>
            <td width="120" class="field-label">企业名称</td>
            <td><?=$row['name']?></td>
        </tr>
        <tr>
            <td class="field-label">行业位置</td>
            <td>
                <select class="easyui-combobox" name="data[position]" style="width:95%;"
                        data-options="editable:false,value:'<?=$row['position']?$row['position']:''?>'">
                    <?php foreach (\app\index\logic\Defs::INDUSTRY_POSITIONS as $k=>$v): ?>
                    <option value="<?=$k?>"><?=$v?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="field-label">排序</td>
            <td>
                <input class="easyui-numberbox" min="0" name="data[sort]" value="<?=$row['sort']?>" style="width:95%;">
            </td>
        </tr>
    </table>
</form>