<form method="post" style="width: 100%;height: 100%;">
    <table class="table-form" cellpadding="5">
        <tr class="form-caption">
            <td colspan="2">添加应付费用 </td>
        </tr>
        <tr>
            <td class="field-label">类型:</td>
            <td class="field-input">
                <select class="easyui-combobox" name="infos[type]" data-options="editable:false,width:200,panelHeight:'auto'">
                    <?php foreach(\app\index\logic\Defs::$fundFeeTypeDefs as $key=>$value){ ?>
                        <option value="<?=$key?>"><?=$value?></option>
                    <?php }?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="field-label">名称:</td>
            <td class="field-input">
                <input class="easyui-textbox" name="infos[title]" data-options="required:true,width:200,validType:['length[1,100]']" />
            </td>
        </tr>
        <tr>
            <td class="field-label">所属区间:</td>
            <td class="field-input">
                <input class="easyui-datebox" name="infos[from_date]" data-options="required:true,editable:false" /> -
                <input class="easyui-datebox" name="infos[end_date]" data-options="required:true,editable:false" />
            </td>
        </tr>
        <tr>
            <td class="field-label">应付金额(元):</td>
            <td class="field-input"><input class="easyui-numberbox" name="infos[amount]" data-options="required:true,width:200,min:0,precision:2" /></td>
        </tr>
    </table>
</form>