<table class="table-form" cellpadding="5" style="width: 100%;">
    <tr>
        <td class="field-label">日期:</td>
        <td class="field-input"><?=dateFilter($bindValues['infos']['date'])?></td>
        <td class="field-label">金额:</td>
        <td class="field-input"><?=dateFilter($bindValues['infos']['amount'])?>元</td>
        <td class="field-label">缴税:</td>
        <td>
            <?php foreach($bindValues['infos']['tax'] as $type=>$amount){ ?>
                <?=\app\index\logic\Defs::$fundTaxTypeDefs[$type]?>: <?=$amount?>元<br />
            <?php } ?>
        </td>
    </tr>
</table>