<form id="F<?=UNIQID?>" method="post" style="height:100%">
    <table class="table-form" cellpadding="5">
        <tr>
            <td width="120" class="field-label">发生日期</td>
            <td class="field-input">
                <input class="easyui-datebox" name="infos[occur_date]" data-options="editable:false,width:'100%'" value="<?=$row['occur_date']?>" />
            </td>
        </tr>
        <?php if (!empty($subtypes)): ?>
            <tr>
                <td class="field-label">类型</td>
                <td class="field-input">
                    <select class="easyui-combobox" name="infos[subtype]" style="width:100%;" data-options="
                        editable:false,
                        value:'<?=$row['subtype']?$row['subtype']:''?>',
                        onSelect:<?=JVAR?>.onSubtypeSelect">
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
                <input class="easyui-textbox" name="infos[title]" value="<?=$row['title']?>" data-options="
                            width:'100%',
                            required:true,
                            prompt:'不超过100个字',
                            validType:['length[1,100]']" />
            </td>
        </tr>
        <tr>
            <td class="field-label" valign="top">内容</td>
            <td class="field-input">
                <textarea class="easyui-textbox auto-height" name="infos[entry]" data-options="
                    width:'100%',
                    multiline:true,
                    validType:['length[1,60000]']"><?=$row['entry']?></textarea>
            </td>
        </tr>
    </table>
    <div id="A<?=UNIQID?>" style="width:100%;height:100%"></div>
</form>
<script>
$('#A<?=UNIQID?>').attachesComplex({attachmentType:<?=\app\index\logic\Upload::ATTACH_PROGRESS_LOGS?>,externalId:'<?=$row['progress_log_id']?>',fit:true,title:'附件列表'});var <?=JVAR?>={init:0,subtypes:<?=json_encode($subtypes,JSON_UNESCAPED_UNICODE)?>,onSubtypeSelect:function(row){var that=<?=JVAR?>;$('#F<?=UNIQID?>').find('.progress_logs_extra_inputs').each(function(){if(row.value!=''&&that.subtypes[row.value].flag==$(this).attr('flag')){$(this).removeClass('hidden');}else{$(this).addClass('hidden');}});if(row.value==''||that.subtypes[row.value].flag!='meeting_res'){if(that.init){$('#MR<?=JVAR?>').combobox('clear');}}
that.init=1;}};$.parser.onComplete=function(context){var txtbox=$(".auto-height");if(txtbox.length){$.each(txtbox,function(i,v){$(v).textbox('autoHeight');})}
$.parser.onComplete=$.noop;};</script>