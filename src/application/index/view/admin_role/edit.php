<form style="width: 100%;height: 100%;">
    <table class="table-form">
        <tr class="form-caption">
            <td colspan="2">修改角色</td>
        </tr>
        <tr>
            <td class="field-label" style="width: 20%;">角色名称:</td>
            <td class="field-input"><input class="easyui-textbox" name="infos[role_name]" data-options="required:true,width:'100%',validType:['length[1,50]']"
                    value="<?=$bindValues['infos']['role_name']?>" /></td>
        </tr>
        <tr>
            <td class="field-label">描述:</td>
            <td class="field-input">
                <input class="easyui-textbox" name="infos[description]" data-options="label:'',
                    width:'100%',
                    height:100,
                    multiline:true,
                    validType:['length[1,255]'],
                    value:'<?=convertLineBreakToEscapeChars($bindValues['infos']['description'])?>'" prompt="请输入角色相关信息" />
            </td>
        </tr>
    </table>
</form>