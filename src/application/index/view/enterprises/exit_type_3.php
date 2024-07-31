<!-- 转让 -->
<tr>
    <td width="120" class="field-label">轮次</td>
    <td>
        <input class="easyui-textbox" name="json[round]" value="<?=$json['round']?>" style="width:120px;">
    </td>
</tr>
<tr>
    <td class="field-label">退出基金</td>
    <td>
        <?php echo \app\index\service\View::selector([
            'name'=>'json[fund_id]',
            'value'=>$json['fund_id'],
            'model'=>'funds',
            'value_field'=>'fund_id',
            'multiple'=>false,
            'url' => url('index/Funds/funds'),
        ]); ?>
    </td>
</tr>
<tr>
    <td class="field-label">受让方</td>
    <td>
        <input class="easyui-textbox" name="json[transferee]" value="<?=$json['transferee']?>" style="width:240px;">
    </td>
</tr>
<tr>
    <td class="field-label">估值（元）</td>
    <td>
        <input class="easyui-numberbox" min="0" groupSeparator="," name="json[valuation]" value="<?=$json['valuation']?>" style="width:120px;">
    </td>
</tr>
<tr>
    <td class="field-label">转让金额（元）</td>
    <td>
        <input class="easyui-numberbox" required="true" min="0" groupSeparator="," name="data[amount]" value="<?=$row['amount']?>" style="width:120px;">
    </td>
</tr>
<tr>
    <td class="field-label">转让注册资本数</td>
    <td>
        <input class="easyui-numberbox" min="0" groupSeparator="," name="json[transfer_registered_capital]" value="<?=$json['transfer_registered_capital']?>" style="width:120px;">
    </td>
</tr>
<tr>
    <td class="field-label">转让比例</td>
    <td>
        <input class="easyui-numberbox" min="0" max="100" precision="4" name="json[transfer_ratio]" value="<?=$json['transfer_ratio']?>" style="width:120px;">
    </td>
</tr>
<tr>
    <td class="field-label">剩余注册资本数</td>
    <td>
        <input class="easyui-numberbox" min="0" groupSeparator="," name="json[surplus_registered_capital]" value="<?=$json['surplus_registered_capital']?>" style="width:120px;">
    </td>
</tr>
<tr>
    <td class="field-label">剩余占股比例</td>
    <td>
        <input class="easyui-numberbox" min="0" max="100" precision="4" name="json[remaining_shareholding_ratio]" value="<?=$json['remaining_shareholding_ratio']?>" style="width:120px;">
    </td>
</tr>