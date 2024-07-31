<form method="post" style="width: 100%;height: 100%;">
    <table class="table-form">
        <tr class="form-caption">
            <td colspan="2">添加银行账户同步</td>
        </tr>
        <tr>
            <td class="field-label">同步日期:</td>
            <td class="field-input">
                <input class="easyui-datebox" name="infos[sync_date]" data-options="required:true,editable:false,width:180" />
            </td>
        </tr>
        <tr>
            <td class="field-label">剩余现金金额(元):</td>
            <td class="field-input"><input class="easyui-numberbox" name="infos[amount]" data-options="required:true,width:180,min:0,precision:2" /></td>
        </tr>
        <tr>
            <td class="field-label">组成:</td>
            <td>
                <?php foreach(\app\index\logic\Defs::$fundBankSyncCompositionDefs as $key=>$title){ ?>
                    <input class="easyui-numberbox" name="infos[composition][<?=$key?>]" data-options="required:true,label:'<?=$title?>',width:180,min:0,precision:2" value="0.00" /><br />
                <?php } ?>
            </td>
        </tr>
    </table>
</form>