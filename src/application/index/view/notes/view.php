<table class="table-form" cellpadding="5">
    <tr>
        <td width="120" class="field-label">标题</td>
        <td><?=$row['title']?></td>
    </tr>
    <tr>
        <td class="field-label">日期</td>
        <td ><?=$row['occur_date']?></td>
    </tr>
    <?php if ($row['subtype']): ?>
    <tr>
        <td class="field-label">类型</td>
        <td class="field-input">
            <?=\app\index\logic\ProgressLogs::$subtypes[$row['subtype']]['name']?>
        </td>
    </tr>
    <?php endif; ?>
    <tr>
        <td class="field-label">内容</td>
        <td class="field-input">
            <?=str_replace("\r\n","<br>",$row['entry'])?>
        </td>
    </tr>
</table>
<div id="F6<?=UNIQID?>" style="width:100%;height:100%"></div>
<script>
    $('#F6<?=UNIQID?>').attachesComplex({
        attachmentType:<?=\app\index\logic\Upload::ATTACH_PROGRESS_LOGS?>,
        externalId:'<?=$row['progress_log_id']?>',
        readOnly:true,
        fit:true,
        title:'附件列表'
    });
</script>