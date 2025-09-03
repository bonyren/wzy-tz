<form method="post" style="width: 100%;height: 100%;">
    <table class="table-form" cellpadding="5">
        <tr class="form-caption">
            <td colspan="2">修改应付费用 </td>
        </tr>
        <tr>
            <td class="field-label">类型:</td>
            <td class="field-input">
                <select class="easyui-combobox" name="infos[type]" data-options="editable:false,width:200,panelHeight:'auto'">
                    <?php foreach(\app\index\logic\Defs::$fundFeeTypeDefs as $key=>$value){ ?>
                        <option value="<?=$key?>" <?php echo $bindValues['infos']['type']==$key?'selected':''; ?>><?=$value?></option>
                    <?php }?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="field-label">名称:</td>
            <td class="field-input">
                <input class="easyui-textbox" name="infos[title]" data-options="required:true,width:200,validType:['length[1,100]']"
                    value="<?=$bindValues['infos']['title']?>"/>
            </td>
        </tr>
        <tr>
            <td class="field-label">所属区间:</td>
            <td class="field-input">
                <input class="easyui-datebox" name="infos[from_date]" data-options="required:true,editable:false"
                       value="<?=dateFilter($bindValues['infos']['from_date'])?>"/> -
                <input class="easyui-datebox" name="infos[end_date]" data-options="required:true,editable:false"
                       value="<?=dateFilter($bindValues['infos']['end_date'])?>"/>
            </td>
        </tr>
        <tr>
            <td class="field-label">应付金额(元):</td>
            <td class="field-input"><input class="easyui-numberbox" name="infos[amount]" data-options="required:true,width:200,min:0,precision:2"
                                           value="<?=$bindValues['infos']['amount']?>"/></td>
        </tr>
    </table>
</form>