<form method="post" id="F<?=UNIQID?>">
    <table class="table-form" cellpadding="5">
        <tr>
            <td width="120" class="field-label">姓名</td>
            <td>
                <input class="easyui-textbox" required="true" name="name" value="<?=$row['name']??''?>" style="width:100%;">
            </td>
        </tr>
        <tr>
            <td class="field-label">职务</td>
            <td>
                <input class="easyui-textbox" name="title" value="<?=$row['title']??''?>" style="width:100%;">
            </td>
        </tr>
        <tr>
            <td class="field-label">联系方式</td>
            <td>
                <input class="easyui-textbox" name="contact" value="<?=$row['contact']??''?>" style="width:100%;">
            </td>
        </tr>
        <tr>
            <td class="field-label">标签</td>
            <td>
                <?php echo \app\index\service\View::tagger(4,$row['id']??0,'',[
                    'name'=>'tags[4]',
                    'title' => '个人标签',
                ]); ?>
            </td>
        </tr>
        <tr>
            <td class="field-label">背景</td>
            <td>
                <textarea class="easyui-textbox auto-height" name="description" data-options="
                    width:'100%',
                    multiline:true,
                    validType:['length[1,4096]']"><?=$row['description']??''?></textarea>
            </td>
        </tr>
        <tr>
            <td class="field-label">附件</td>
            <td>
                <div class="easyui-panel" data-options="
                    href:'<?=url('index/upload/attaches',['attachmentType'=>8,'externalId'=>intval($row['id']??0),'uiStyle'=>\app\index\controller\Upload::ATTACHES_UI_LIGHT_STYLE]).(($row['id']??0) ? '' : '&callback=GLOBAL.HelperDialog.uploaded')?>',
                    border:false,
                    minimizable:false,
                    maximizable:false">
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">主跟进人</td>
            <td>
                <select class="easyui-combobox" name="assigner[]" style="width:100%;"
                        data-options="required:true,multiple:true,editable:false,value:'<?=$row['assigner']??''?>'">
                    <?php foreach ($users as $v): ?>
                    <option value="<?=$v['admin_id']?>"><?=$v['realname']?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="field-label">辅助跟进人</td>
            <td>
                <select class="easyui-combobox" name="additional_assigners[]" style="width:100%;"
                        data-options="multiple:true,editable:false,value:'<?=$row['additional_assigners']??''?>'">
                    <?php foreach ($users as $v): ?>
                    <option value="<?=$v['admin_id']?>"><?=$v['realname']?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
    </table>
    <input type="hidden" id="contacts_pending_files" name="pending_files">
</form>
<script>
$.parser.onComplete=function(){var txtbox=$(".auto-height");if(txtbox.length){$.each(txtbox,function(i,v){$(v).textbox('autoHeight');})}
$.parser.onComplete=$.noop;};GLOBAL.HelperDialog={pendingFiles:[],uploaded:function(files){var that=GLOBAL.HelperDialog;$.each(files,function(i,v){that.pendingFiles.push(v.attachment_id);});$('#contacts_pending_files').val(that.pendingFiles.join(','));},submit:function(url,$dialog,success){var $form=$('#F<?=UNIQID?>');if(!$form.form('validate')){return false;}
$.messager.progress({text:'处理中，请稍候...'});$.post(url,$form.serialize(),function(res){$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg,'info');$dialog.dialog('close');if(success){success();}}},'json');}};</script>