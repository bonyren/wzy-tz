<table class="table-form" cellpadding="20">
    <?php if ($data['type'] == 1): ?>
        <tr class="field-label">
            <td align="center" width="25%">投资方</td>
            <td align="center" width="25%">投资金额(元)</td>
            <td align="center" width="25%">持股份数(股)</td>
            <td align="center" width="25%">持股比例(%)</td>
        </tr>
        <?php foreach ($data['detail'] as $v): ?>
        <tr>
            <td align="center"><?=$v['who']?></td>
            <td align="center"><?=number_format($v['amount'])?></td>
            <td align="center"><?=number_format($v['stock_total'])?></td>
            <td align="center"><?=$v['stock_ratio']?>%</td>
        </tr>
        <?php endforeach; ?>
    <?php  else: ?>
        <tr class="field-label">
            <td align="center" width="20%">转让方</td>
            <td align="center" width="20%">受让方</td>
            <td align="center" width="20%">转让金额(元)</td>
            <td align="center" width="20%">转让股份(股)</td>
            <td align="center" width="20%">转让后股比(%)</td>
        </tr>
        <?php foreach ($data['detail'] as $v): ?>
            <tr>
                <td align="center"><?=$v['from']?></td>
                <td align="center"><?=$v['to']?></td>
                <td align="center"><?=number_format($v['amount'])?></td>
                <td align="center"><?=number_format($v['stock_total'])?></td>
                <td align="center"><?=$v['stock_ratio']?>%</td>
            </tr>
        <?php endforeach; ?>
    <?php  endif; ?>
</table>