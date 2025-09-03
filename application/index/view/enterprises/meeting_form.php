<table class="table-form" cellpadding="5">
    <tr>
        <td width="120" class="field-label">会议主题</td>
        <td>
            <input name="data[title]" value="<?=$bind['title']?>" class="easyui-textbox" required="true" style="width:100%">
        </td>
    </tr>
    <tr>
        <td class="field-label">开始时间</td>
        <td>
            <input name="data[date_start]" value="<?=$bind['meeting']['date_start']?>" class="easyui-datetimebox" required="true" showSeconds="false" editable="false" style="width:200px;">
        </td>
    </tr>
    <tr>
        <td class="field-label">会议内容</td>
        <td>
            <input name="data[description]" class="easyui-textbox" multiline="true"
                   data-options="value:'<?=convertLineBreakToEscapeChars($bind['meeting']['description'])?>'" style="width:100%;height:40px;">
        </td>
    </tr>
</table>