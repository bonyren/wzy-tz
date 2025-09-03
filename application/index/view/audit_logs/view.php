<table id="T<?=UNIQID?>" class="table-form" cellpadding="5" style="font-size:14px;">
    <tr class="field-label">
        <td height="30" width="30">&nbsp;</td>
        <td align="center" width="">描述</td>
        <td align="center" width="100">操作人</td>
        <td align="center" width="150">时间</td>
    </tr>
    <?php foreach ($rows as $i=>$v): ?>
        <tr>
            <td class="field-label row-number"><?=$i+1?></td>
            <td align="center"><?=$v['desc']?></td>
            <td align="center"><?=$v['realname']?></td>
            <td align="center"><?=substr($v['changed_date'],0,16)?></td>
        </tr>
        <?php endforeach; ?>
</table>