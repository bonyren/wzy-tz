<form method="post" style="height:100%">
    <table class="table-form" cellpadding="5">
        <tr>
            <td width="120" class="field-label">智库名称</td>
            <td>
                <input class="easyui-textbox" required="true" name="data[name]" value="<?=$row['name']?>" style="width:90%;">
            </td>
        </tr>
        <tr>
            <td class="field-label">描述</td>
            <td>
                <input id="knowledge-description-textbox" class="easyui-textbox" multiline="true" width="100%" height="auto" name="data[description]"
                       data-options="value:'<?=convertLineBreakToEscapeChars($row['description'])?>'"
                       style="width:90%;height:85px;">
            </td>
        </tr>
    </table>
    <?php if ($row['id']): ?>
        <div class="easyui-tabs" data-options="fit:true">
            <div title="智库文章" data-options="
                cache:false,
                iconCls:'fa fa-file-text',
                border:false">
                <div id="knowledge-attachments" style="width: 100%;height: 100%;"></div>
            </div>
        </div>
    <?php endif; ?>
</form>
<script type="text/javascript">
$.parser.onComplete=function(context){var $el=$('#knowledge-description-textbox');if($el.length){$el.textbox('autoHeight');}
$.parser.onComplete=$.noop;};$('#knowledge-attachments').attaches({attachmentType:<?=\app\index\logic\Upload::ATTACH_KNOWLEDGE?>,externalId:'<?=$row['id']?>',uiStyle:<?=\app\index\controller\Upload::ATTACHES_UI_DATAGRID_STYLE?>,readOnly:false});</script>