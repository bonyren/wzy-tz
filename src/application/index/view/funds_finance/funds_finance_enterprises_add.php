<form method="post" style="width: 100%;height: 100%;">
    <table class="table-form">
        <tr class="form-caption">
            <td colspan="2">添加应付投资</td>
        </tr>
        <tr>
            <td class="field-label">项目:</td>
            <td class="field-input">
                <select class="easyui-combobox" name="infos[enterprise_id]" data-options="editable:false,width:200,panelHeight:'auto'">
                    <?php foreach($enterprisePairs as $key=>$value){ ?>
                        <option value="<?=$key?>"><?=$value?></option>
                    <?php }?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="field-label">名称:</td>
            <td class="field-input">
                <input class="easyui-textbox" name="infos[title]" data-options="width:200,validType:['length[1,100]']" />
            </td>
        </tr>
        <tr>
            <td class="field-label">日期:</td>
            <td class="field-input"><input class="easyui-datebox" name="infos[date]" data-options="required:true,width:200,editable:false"/></td>
        </tr>
        <tr>
            <td class="field-label">应付金额(元):</td>
            <td class="field-input"><input class="easyui-numberbox" name="infos[amount]" data-options="required:true,width:200,min:0,precision:2" /></td>
        </tr>
    </table>
</form>