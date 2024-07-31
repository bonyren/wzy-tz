<form method="post">
    <table class="table-form">
        <tr>
            <td class="field-label" style="width: 20%;">名称:</td>
            <td class="field-input" colspan="3"><input class="easyui-textbox" name="infos[name]" data-options="required:true,width:'100%',validType:['length[1,100]']" /></td>
        </tr>
        <tr>
            <td class="field-label">简称:</td>
            <td class="field-input" colspan="3"><input class="easyui-textbox" name="infos[alias]" data-options="width:'100%',validType:['length[1,20]']" /></td>
        </tr>
        <tr>
            <td class="field-label">代号:</td>
            <td class="field-input" colspan="3"><input class="easyui-textbox" name="infos[code]" data-options="width:'100%',validType:['length[1,20]']" /></td>
        </tr>
        <tr>
            <td class="field-label">注册地:</td>
            <td class="field-input" colspan="3"><input class="easyui-textbox" name="infos[reg_place]" data-options="width:'100%',validType:['length[1,100]']" /></td>
        </tr>
        <tr>
            <td class="field-label">规模(元):</td>
            <td class="field-input" colspan="3"><input class="easyui-numberbox" name="infos[size]" data-options="width:'100%',min:0,precision:2" /></td>
        </tr>
        <tr>
            <td class="field-label">合伙企业起止日期:</td>
            <td class="field-input" colspan="3">
                <input class="easyui-datebox" name="infos[partnership_start_date]" data-options="width:120,editable:false" />
                -
                <input class="easyui-datebox" name="infos[partnership_end_date]" data-options="width:120,editable:false" />
            </td>
        </tr>
        <tr>
            <td class="field-label">基金成立结束日期:</td>
            <td class="field-input" colspan="3">
                <input class="easyui-datebox" name="infos[establish_date]" data-options="width:120,editable:false" />
                -
                <input class="easyui-datebox" name="infos[over_date]" data-options="width:120,editable:false" />
            </td>
        </tr>
        <tr>
            <td class="field-label" style="width: 20%;">基金投资期(年):</td>
            <td class="field-input" colspan="3">
                <input class="easyui-numberbox" name="infos[invest_period]" data-options="width:60,min:0,precision:0" />
                管理费率:<input class="easyui-numberbox" name="infos[invest_fee_ratio]" data-options="width:60,min:0,precision:2" />%
            </td>
        </tr>

        <tr>
            <td class="field-label" style="width: 20%;">基金退出期(年):</td>
            <td class="field-input"colspan="3">
                <input class="easyui-numberbox" name="infos[exit_period]" data-options="width:60,min:0,precision:0" />
                管理费率:<input class="easyui-numberbox" name="infos[exit_fee_ratio]" data-options="width:60,min:0,precision:2" />%
            </td>
        </tr>

        <tr>
            <td class="field-label">基金延长期(年):</td>
            <td class="field-input" colspan="3"><input class="easyui-numberbox" name="infos[extend_period]" data-options="width:60,min:0,precision:0" /></td>
        </tr>
        <tr>
            <td class="field-label">运营状态:</td>
            <td class="field-input" colspan="3">
                <select class="easyui-combobox" name="infos[status]" data-options="editable:false,width:100,panelHeight:'auto'">
                    <?php foreach(\app\index\logic\Funds::$fundStatusDefs as $key=>$value){ ?>
                        <option value="<?=$key?>"><?=$value?></option>
                    <?php }?>
                </select>
            </td>
        </tr>
    </table>
</form>