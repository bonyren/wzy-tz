<table class="table-form">
    <?php foreach($bindValues['infos']['composition'] as $key=>$value){ ?>
    <tr>
        <td class="field-label"><?=\app\index\logic\Defs::$fundBankSyncCompositionDefs[$key]?></td>
        <td class="field-input"><?=$value?></td>
    </tr>
    <?php } ?>
</table>