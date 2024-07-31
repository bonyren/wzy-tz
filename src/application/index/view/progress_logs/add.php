<?php
use app\common\CommonDefs;
use app\index\logic\ProgressLogs as ProgressLogsLogic;
?>
<form id="progressLogsAddForm_<?=$uniqid?>" method="post">
    <table class="table-form" cellpadding="5">
        <tr>
            <td width="120" class="field-label">发生日期</td>
            <td class="field-input">
                <input class="easyui-datebox" name="infos[occur_date]" data-options="editable:false,width:'100%'" value="<?=dateFilter($bindValues['curDate'])?>" />
                <?php if ($src == CommonDefs::MODULE_ADMIN && $category == ProgressLogsLogic::EVENT_LOG_FUND_MANAGE_CATEGORY): ?>
                <span class="ml-10">
                    <input class="easyui-checkbox" name="infos[show_timeline]" value="1">
                    显示到时间轴
                </span>
                <?php endif; ?>
            </td>
        </tr>
        <?php if (!empty($subtypes)): ?>
        <tr>
            <td class="field-label">类型</td>
            <td class="field-input">
                <select class="easyui-combobox" name="infos[subtype]" style="width:100%;"
                        data-options="editable:false,onChange:<?=JVAR?>.onSubtypeSelected">
                    <option value=""></option>
                    <?php foreach ($subtypes as $k=>$v): ?>
                    <option value="<?=$k?>"><?=$v['name']?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <?php endif; ?>
        <tr>
            <td class="field-label">标题</td>
            <td class="field-input">
                <input class="easyui-textbox" name="infos[title]" data-options="
                            width:'100%',
                            required:true,
                            prompt:'不超过100个字',
                            validType:['length[1,100]']" />
            </td>
        </tr>
        <tr>
            <td class="field-label">内容</td>
            <td class="field-input">
                <input class="easyui-textbox auto-height" name="infos[entry]" data-options="
                    width:'100%',
                    multiline:true,
                    validType:['length[1,60000]']">
            </td>
        </tr>
        <tr>
            <td class="field-label">附件</td>
            <td>
                <input type="hidden" id="progressLogsAttacheIds_<?=$uniqid?>" name="infos[attaches]" value=""/>
                <div id="progressLogsAttachsPanel_<?=$uniqid?>" style="width:100%" class="easyui-panel" data-options="border:false,
                    minimizable:false,
                    maximizable:false,
                    href:'<?=$urlHrefs['attachments']?>'">
                </div>
            </td>
        </tr>
    </table>
</form>
<script>
var <?=JVAR?> = {
    progressLogsAttacheIds:[],
    subtypes:<?=json_encode($subtypes,JSON_UNESCAPED_UNICODE)?>,
    onAttachmentsUploaded:function(files){
        $.each(files, function(i,v){
            <?=JVAR?>.progressLogsAttacheIds.push(v.attachment_id);
        });
        $('#progressLogsAttacheIds_<?=$uniqid?>').val(<?=JVAR?>.progressLogsAttacheIds.join(','));
    },
    onSubtypeSelected:function(value){
        var that = <?=JVAR?>;
        $('#progressLogsAddForm_<?=$uniqid?>').find('.progress_logs_extra_inputs').each(function(){
            if (value != '' && that.subtypes[value].flag == $(this).attr('flag')) {
                $(this).removeClass('hidden');
            } else {
                $(this).addClass('hidden');
            }
        });
        if (value == '' || that.subtypes[value].flag != 'meeting_res') {
            $('#MR<?=JVAR?>').combobox('reset');
        }
    }
};
$.parser.onComplete = function(context){
    var txtbox = $(".auto-height");
    if (txtbox.length) {
        $.each(txtbox, function(i,v){
            $(v).textbox('autoHeight');
        })
    }
}
</script>