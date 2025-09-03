<?php
use app\index\logic\Upload;
?>
<form method="post" id="F<?=UNIQID?>">
    <table class="table-form" cellpadding="5">
        <tr>
            <td width="120" class="field-label">退出方式</td>
            <td>
                <select class="easyui-combobox" required="true" editable="false" name="data[type]" value="<?=$row['type']?>" style="width:120px"
                    data-options="onChange:ENTERPRISE_EXIT_EDIT.show,value:'<?=$row['type']?$row['type']:''?>'">
                    <?php foreach (\app\index\logic\Defs::ENTERPRISE_EXIT_TYPES as $k=>$v) { ?>
                    <option value="<?=$k?>"><?=$v?></option>
                    <?php } ?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="field-label">时间</td>
            <td>
                <input class="easyui-datebox" required="true" name="data[date]" value="<?=$row['date']?>" style="width:120px;">
            </td>
        </tr>
    </table>


    <?php foreach (\app\index\logic\Defs::ENTERPRISE_EXIT_TYPES as $k=>$v) { ?>
    <table id="T<?=UNIQID.'_'.$k?>" class="table-form e-types hidden" cellpadding="5">
        <?php include APP_PATH . 'index/view/enterprises/exit_type_' . $k . '.php'; ?>
    </table>
    <?php } ?>

    <table class="table-form" cellpadding="5">
        <tr>
            <td width="120" class="field-label">备注说明</td>
            <td>
                <input class="easyui-textbox auto-height" multiline="true" name="data[remark]" style="width:100%;"
                    data-options="value:'<?=convertLineBreakToEscapeChars($row['remark'])?>'">
            </td>
        </tr>
        <tr>
            <td class="field-label"><?=Upload::$attachTypeDefs[Upload::ATTACH_ENTERPRISE_EXIT_PROTOCOL]['label']?></td>
            <td>
                <div class="easyui-panel" data-options="
                    href:'<?=$url_upload.'&attachmentType='.Upload::ATTACH_ENTERPRISE_EXIT_PROTOCOL?>',
                    border:false,
                    minimizable:false,
                    maximizable:false">
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label"><?=Upload::$attachTypeDefs[Upload::ATTACH_ENTERPRISE_EXIT_DELIVERY]['label']?></td>
            <td>
                <div class="easyui-panel" data-options="
                    href:'<?=$url_upload.'&attachmentType='.Upload::ATTACH_ENTERPRISE_EXIT_DELIVERY?>',
                    border:false,
                    minimizable:false,
                    maximizable:false">
                </div>
            </td>
        </tr>
    </table>
    <input type="hidden" id="exit_pending_files" name="pending_files">
</form>
<script>
$.parser.onComplete=function(){var txtbox=$(".auto-height");if(txtbox.length){$.each(txtbox,function(i,v){$(v).textbox('autoHeight');})}
ENTERPRISE_EXIT_EDIT.init();if(ENTERPRISE_EXIT_EDIT.readonly){$('#F<?=UNIQID?>').find('.easyui-combobox').combobox('disable');$('#F<?=UNIQID?>').find('.easyui-textbox').textbox('disable');$('#F<?=UNIQID?>').find('.easyui-datebox').datebox('disable');$('#F<?=UNIQID?>').find('.easyui-numberbox').numberbox('disable');}
$.parser.onComplete=$.noop;};var ENTERPRISE_EXIT_EDIT={readonly:<?=intval($readonly)?>,pendingFiles:[],uploaded:function(files){if('<?=$row['id']?>'!=''){return;}
var that=ENTERPRISE_EXIT_EDIT;$.each(files,function(i,v){that.pendingFiles.push(v.attachment_id);});$('#exit_pending_files').val(that.pendingFiles.join(','));},init:function(){if('<?=$row['id']?>'==''){return;}
this.show('<?=$row['type']?>');},show:function(v){if(v){var $t=$('#T<?=UNIQID?>_'+v);var $s=$t.siblings('.e-types');$t.removeClass('hidden').find('.easyui-textbox').textbox('enable');$t.find('.easyui-numberbox').numberbox('enable');$s.addClass('hidden').find('.easyui-textbox').textbox('disable');$s.find('.easyui-numberbox').numberbox('disable');}}};GLOBAL.HelperDialog={submit:function(url,$dialog,success){var $form=$dialog.find('form');if(!$form.form('validate')){return false;}
$.messager.progress({text:'处理中，请稍候...'});$.post(url,$form.serialize(),function(res){$.messager.progress('close');if(res.code===0){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg,'info');$dialog.dialog('close');if(success){success();}}},'json');}};</script>