<form method="post" style="width: 100%;height: 100%;">
    <table class="table-form" cellpadding="5">
        <tr class="form-caption">
            <td colspan="2">编辑基金托管机构</td>
        </tr>
        <tr>
            <td class="field-label" style="width: 100px;">名称:</td>
            <td class="field-input"><input class="easyui-textbox" name="infos[name]" value="<?=$bindValues['infos']['name']?>"
                                           data-options="required:true,width:'100%',validType:['length[1,100]']" /></td>
        </tr>
        <tr>
            <td class="field-label">联系人:</td>
            <td class="field-input"><input class="easyui-textbox" name="infos[linkman]" value="<?=$bindValues['infos']['linkman']?>"
                                           data-options="width:'100%',validType:['length[1,100]']" /></td>
        </tr>
        <tr>
            <td class="field-label">电话:</td>
            <td class="field-input"><input class="easyui-textbox" name="infos[tel]" value="<?=$bindValues['infos']['tel']?>"
                                           data-options="width:'100%',validType:['length[1,100]']" /></td>
        </tr>
    </table>
</form>