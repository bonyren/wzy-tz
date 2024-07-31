<table class="table-form" cellpadding="5">
    <tr class="field-label">
        <td width="20%" align="center">股东名称</td>
        <td width="20%" align="center">认缴注册资本(元)</td>
        <td width="20%" align="center">投资金额(元)</td>
        <td width="20%" align="center">持股比例(%)</td>
        <td width="20%" align="center">持股份数(股)</td>
    </tr>
    <?php
    $total = ['reg_asset'=>0,'investment'=>0,'stock_ratio'=>0,'stock_total'=>0];
    foreach ($rows as $v) :
        $total['reg_asset'] += $v['reg_asset'];
        $total['investment'] += $v['investment'];
        $total['stock_ratio'] += $v['stock_ratio'];
        $total['stock_total'] += $v['stock_total'];
        if ($readonly) :
    ?>
        <tr>
            <td align="center"><?=$v['name']?></td>
            <td align="center"><?=$v['reg_asset'] > 0 ? number_format($v['reg_asset']) : ''?></td>
            <td align="center"><?=$v['investment'] > 0 ? number_format($v['investment']) : ''?></td>
            <td align="center"><?=$v['stock_ratio'] > 0 ? round($v['stock_ratio'],3).'%' : ''?></td>
            <td align="center"><?=$v['stock_total'] > 0 ? number_format($v['stock_total']) : ''?></td>
        </tr>
        <?php else: ?>
        <tr>
            <td align="center">
                <input class="easyui-textbox" required="true" name="detail[<?=$v['id']?>][name]" value="<?=$v['name']?>">
            </td>
            <td align="center">
                <input class="easyui-numberbox" name="detail[<?=$v['id']?>][reg_asset]" value="<?=$v['reg_asset']?>" data-options="min:0,groupSeparator:','" style="width:100px">
            </td>
            <td align="center">
                <input class="easyui-numberbox" name="detail[<?=$v['id']?>][investment]" value="<?=$v['investment']?>" data-options="min:0,groupSeparator:','" style="width:100px">
            <td align="center">
                <input class="easyui-numberbox" name="detail[<?=$v['id']?>][stock_ratio]" value="<?=$v['stock_ratio']?>" data-options="min:0,max:100,precision:3,suffix:'%'" style="width:100px">
            </td>
            <td align="center">
                <input class="easyui-numberbox" name="detail[<?=$v['id']?>][stock_total]" value="<?=$v['stock_total']?>" data-options="min:0,groupSeparator:','" style="width:100px">
            </td>
        </tr>
    <?php endif; endforeach; ?>
    <tr class="text-red">
        <td align="center">合计</td>
        <td align="center"><?=number_format($total['reg_asset'])?></td>
        <td align="center"><?=number_format($total['investment'])?></td>
        <td align="center"><?=round($total['stock_ratio'],3)?>%</td>
        <td align="center"><?=number_format($total['stock_total'])?></td>
    </tr>
</table>