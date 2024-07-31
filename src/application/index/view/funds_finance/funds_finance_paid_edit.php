<form method="post" style="width: 100%;height: 100%;">
    <table class="table-form">
        <tr>
            <td class="field-label">核销金额(元):</td>
            <td class="field-input"><input class="easyui-numberbox" name="infos[actual_amount]" data-options="required:true,width:200,min:0,precision:2"
                                           value="<?=$bindValues['infos']['actual_amount']?>"/></td>
        </tr>
        <tr>
            <td class="field-label">核销日期:</td>
            <td class="field-input"><input class="easyui-datebox" name="infos[pay_date]" data-options="required:true,width:200"
                                           value="<?=dateFilter($bindValues['infos']['pay_date'])?>"/></td>
        </tr>
    </table>
</form>