<form method="post" style="width: 100%;height: 100%;">
    <table class="table-form">
        <tr class="form-caption">
            <td colspan="2">修改银行账户流水</td>
        </tr>
        <tr>
            <td class="field-label">交易流水号:</td>
            <td class="field-input">
                <input class="easyui-textbox" name="infos[serial_number]" data-options="required:true,width:180,validType:['length[1,100]']"
                    value="<?=$bindValues['infos']['serial_number']?>"/>
            </td>
        </tr>
        <tr>
            <td class="field-label">记账日期:</td>
            <td class="field-input">
                <input class="easyui-datebox" name="infos[entry_date]" data-options="required:true,editable:false,width:180"
                       value="<?=dateFilter($bindValues['infos']['entry_date'])?>"/>
            </td>
        </tr>
        <tr>
            <td class="field-label">入账金额(元):</td>
            <td class="field-input"><input class="easyui-numberbox" name="infos[entry_amount]" data-options="required:true,width:180,min:0,precision:2"
                                           value="<?=$bindValues['infos']['entry_amount']?>"/></td>
        </tr>
        <tr>
            <td class="field-label">类型:</td>
            <td>
                <?php foreach(\app\index\logic\Defs::$fundBankSyncFlowTypeDefs as $key=>$value){ ?>
                    <input class="easyui-radiobutton" name="infos[entry_type]" value="<?=$key?>" data-options="label:'<?=$value?>',checked:<?=$key==$bindValues['infos']['entry_type']?'true':'false'?>"/><br />
                <?php } ?>
            </td>
        </tr>
        <tr>
            <td class="field-label">摘要:</td>
            <td>
                <input class="easyui-textbox" name="infos[entry_summary]" data-options="label:'',
                    width:'100%',
                    height:50,
                    multiline:true,
                    validType:['length[1,200]'],
                    value:'<?=convertLineBreakToEscapeChars($bindValues['infos']['entry_summary'])?>'" prompt="请输入摘要" />
            </td>
        </tr>
    </table>
</form>