<table class="table-form">
    <tr class="form-caption">
        <td colspan="5">出资人名录（单位：万元）</td>
    </tr>
    <tr>
        <td class="field-label">序号</td>
        <td class="field-label">出资人名称</td>
        <td class="field-label">认缴金额</td>
        <td class="field-label">实缴金额</td>
        <td class="field-label">认缴比例(%)</td>
    </tr>
    <?php foreach($partners as $partner){ ?>
        <tr>
            <td class="field-input"><?=$partner['index']?></td>
            <td class="field-input"><?=$partner['name']?></td>
            <td class="field-input"><?=$partner['amount']?></td>
            <td class="field-input"><?=$partner['paid_amount']?></td>
            <td class="field-input"><?=$partner['percent']?></td>
        </tr>
    <?php } ?>
</table>