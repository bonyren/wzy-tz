<!-- IPO -->
<tr>
    <td width="120" class="field-label">售出股份</td>
    <td>
        <input class="easyui-numberbox" min="0" groupSeparator="," name="json[shares_sold]" value="<?=$json['shares_sold']?>" style="width:120px;">
    </td>
</tr>
<tr>
    <td class="field-label">退出金额（元）</td>
    <td>
        <input class="easyui-numberbox" required="true" min="0" groupSeparator="," name="data[amount]" value="<?=$row['amount']?>" style="width:120px;">
    </td>
</tr>
<tr>
    <td class="field-label">剩余股份</td>
    <td>
        <input class="easyui-numberbox" min="0" groupSeparator="," name="json[shares_surplus]" value="<?=$json['shares_surplus']?>" style="width:120px;">
    </td>
</tr>