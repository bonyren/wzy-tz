<form method="post" style="width: 100%;height: 100%;">
    <table class="table-form" cellpadding="5">
        <tr class="form-caption">
            <td colspan="2">添加新合伙人</td>
        </tr>
        <tr>
            <td class="field-label" style="width: 150px;">合伙人:</td>
            <td class="field-input">
                <select class="easyui-combobox" name="infos[p_id]" data-options="required:true,editable:false,width:200,panelHeight:300,value:''">
                    <?php foreach($bindValues['ps'] as $key=>$value){ ?>
                        <option value="<?=$key?>"><?=$value?></option>
                    <?php }?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="field-label">认投金额(元):</td>
            <td class="field-input"><input class="easyui-numberbox" name="infos[amount]" data-options="required:true,width:200,min:0,precision:2" /></td>
        </tr>
    </table>
</form>