<form method="post" style="width: 100%;height: 100%;">
    <table class="table-form" cellpadding="5">
        <?php if($type == \app\index\logic\ChangeLogs::CHANGE_LOG_POINT_TYPE){ ?>
            <tr>
                <td class="field-label" style="width: 120px;">时间:</td>
                <td class="field-input">
                    <input class="easyui-datebox" name="infos[change_date]" data-options="required:true,editable:false"
                           value="<?=dateFilter($bindValues['infos']['change_date'])?>"/>
                </td>
            </tr>
        <?php }else{ ?>
        <tr>
            <td class="field-label" style="width: 120px;">所属区间:</td>
            <td class="field-input">
                <input class="easyui-datebox" name="infos[from_date]" data-options="required:true,editable:false"
                    value="<?=dateFilter($bindValues['infos']['from_date'])?>"/> -
                <input class="easyui-datebox" name="infos[end_date]" data-options="required:true,editable:false"
                       value="<?=dateFilter($bindValues['infos']['end_date'])?>"/>
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
                    validType:['length[1,255]']" prompt="请输入记录描述"><?=$bindValues['infos']['desc']?></textarea>
            </td>
        </tr>
        <tr>
            <td class="field-label">附件:</td>
            <td>
                <div id="change-logs-attaches-<?=$uniqid?>"></div>
            </td>
        </tr>
    </table>
</form>
<script>
$('#change-logs-attaches-<?=$uniqid?>').attaches({attachmentType:<?=\app\index\logic\Upload::ATTACH_FUND_CHANGE_LOGS?>,externalId:<?=$bindValues['infos']['id']?>,uiStyle:<?=\app\index\controller\Upload::ATTACHES_UI_DATAGRID_STYLE?>,readOnly:false});$.parser.onComplete=function(context){$("#change-logs-desc-textbox-<?=$uniqid?>").textbox('autoHeight');$.parser.onComplete=$.noop;};</script>