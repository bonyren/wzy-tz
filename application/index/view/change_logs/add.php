<form method="post" style="width: 100%;height: 100%;">
    <table class="table-form" cellpadding="5">
        <?php if($type == \app\index\logic\ChangeLogs::CHANGE_LOG_POINT_TYPE){ ?>
        <tr>
            <td class="field-label" style="width: 120px;">时间:</td>
            <td class="field-input">
                <input class="easyui-datebox" name="infos[change_date]" data-options="required:true,editable:false" />
            </td>
        </tr>
        <?php }else{ ?>
        <tr>
            <td class="field-label" style="width: 120px;">所属区间:</td>
            <td class="field-input">
                <input class="easyui-datebox" name="infos[from_date]" data-options="required:true,editable:false" /> -
                <input class="easyui-datebox" name="infos[end_date]" data-options="required:true,editable:false" />
            </td>
        </tr>
        <?php } ?>
        <tr>
            <td class="field-label">描述:</td>
            <td class="field-input">
                <textarea id="change-logs-desc-textbox-<?=$uniqid?>" class="easyui-textbox" name="infos[desc]" data-options="label:'',
                    required:true,
                    width:'100%',
                    height:'auto',
                    multiline:true,
                    validType:['length[1,255]']" prompt="请输入描述"></textarea>
            </td>
        </tr>
        <tr>
            <td class="field-label">附件:</td>
            <td>
                <input type="hidden" id="changeLogsAttacheIds-<?=$uniqid?>" name="infos[attaches]" value=""/>
                <div id="change-logs-attaches-<?=$uniqid?>"></div>
            </td>
        </tr>
    </table>
</form>
<script type="text/javascript">
var changeLogsAttacheIds_<?=$uniqid?>=[];var changeLogsAddModule_<?=$uniqid?>={onAttachmentsUploaded:function(files){$.each(files,function(i,v){changeLogsAttacheIds_<?=$uniqid?>.push(v.attachment_id);});$('#changeLogsAttacheIds-<?=$uniqid?>').val(changeLogsAttacheIds_<?=$uniqid?>.join(','));}};$('#change-logs-attaches-<?=$uniqid?>').attaches({attachmentType:<?=\app\index\logic\Upload::ATTACH_FUND_CHANGE_LOGS?>,externalId:0,uiStyle:<?=\app\index\controller\Upload::ATTACHES_UI_DATAGRID_STYLE?>,readOnly:false,callback:'changeLogsAddModule_<?=$uniqid?>.onAttachmentsUploaded'});$.parser.onComplete=function(context){$("#change-logs-desc-textbox-<?=$uniqid?>").textbox('autoHeight');$.parser.onComplete=$.noop;};</script>