<form method="post" style="width: 100%;height: 100%;">
    <table class="table-form">
        <tr>
            <td class="field-label">认投金额(元):</td>
            <td class="field-input"><input class="easyui-numberbox" name="infos[amount]" data-options="required:true,width:200,min:0,precision:2"
                                           value="<?=$bindValues['infos']['amount']?>"/></td>
        </tr>
    </table>
</form>