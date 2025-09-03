<form method="post" style="height:100%">
    <table class="table-form" cellpadding="5">
        <tr>
            <td width="120" class="field-label">行业名称</td>
            <td>
                <input class="easyui-textbox" required="true" name="data[name]" value="<?=$row['name']?>" style="width:90%;">
            </td>
        </tr>
        <tr>
            <td class="field-label">核心数据</td>
            <td>
                <input id="core-data-description-textbox" class="easyui-textbox" width="100%" height="auto" multiline="true" name="data[core_data]"
                       data-options="value:'<?=convertLineBreakToEscapeChars($row['core_data'])?>'"
                       style="width:90%;height:85px;">
            </td>
        </tr>
        <tr>
            <td class="field-label">描述</td>
            <td>
                <input id="industry-description-textbox" class="easyui-textbox" width="100%" height="auto" multiline="true" name="data[description]"
                       data-options="value:'<?=convertLineBreakToEscapeChars($row['description'])?>'"
                       style="width:90%;height:85px;">
            </td>
        </tr>
    </table>
    <?php if ($row['id']): ?>
    <div class="easyui-tabs" data-options="fit:true">
        <div title="行研报告" data-options="
            cache:false,
            href:'<?=url('index/industries/attachments',['record_id'=>$row['id'],'attach_type'=>\app\index\logic\Upload::ATTACH_INDUSTRY])?>',
            iconCls:'fa fa-file-text',
            border:false"></div>
    </div>
    <?php endif; ?>
</form>
<script type="text/javascript">
$.parser.onComplete=function(context){$("#core-data-description-textbox").textbox('autoHeight');$("#industry-description-textbox").textbox('autoHeight');$.parser.onComplete=$.noop;};</script>