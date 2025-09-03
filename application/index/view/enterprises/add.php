<form id="enterprise_edit_form" method="post">
    <table class="table-form" cellpadding="5">
        <tr>
            <td width="150" class="field-label">企业名称</td>
            <td>
                <input class="easyui-textbox" required="true" name="enterprise[name]" value="<?=$external['name']?>" 
                    data-options="validType:['length[1,60]']" style="width:100%;">
            </td>
        </tr>
        <tr>
            <td class="field-label">企业Logo</td>
            <td>
                <div>
                    <img id="enterprise_logo_preview" src="/static/img/image_upload.png" class="img-thumbnail" style="width: 120px;">
                    <a href="javascript:;" class="easyui-linkbutton" data-options="iconCls:'fa fa-upload',onClick:function(){
                        EnterpriseModule.uploadLogo(function(obj){
                            if(obj.code){
                                $('#enterprise_logo_preview').attr('src', obj.data.absolute_url);
                                $('#enterprise_logo_path').val(obj.data.absolute_url);
                            }else{
                                $.app.method.alertError(null, obj.msg);
                            }
                        });
                    }"></a>
                </div>
                <input id="enterprise_logo_path" type="hidden" name="enterprise[logo]" value="">
            </td>
        </tr>
        <tr>
            <td class="field-label">创始人</td>
            <td>

                <input class="easyui-textbox" required="true" name="founder[name]" value="<?=$external['boss']?>" 
                    data-options="validType:['length[1,100]']" style="width:100%;">
            </td>
        </tr>
        <tr>
            <td class="field-label">公司简介</td>
            <td>
                <textarea class="easyui-textbox auto-height" name="enterprise[description]" data-options="
                    width:'100%',
                    multiline:true,
                    validType:['length[1,1024]']"></textarea>
            </td>
        </tr>
        <tr>
            <td class="field-label">地址</td>
            <td>
                <input class="easyui-textbox" name="enterprise[address]" value="<?=$external['address']?>" 
                    data-options="validType:['length[1,100]']" style="width:100%;">
            </td>
        </tr>
        <tr>
            <td class="field-label">联系方式</td>
            <td>
                <input class="easyui-textbox" name="founder[contact]" value="<?=$external['phone']?>" 
                    data-options="validType:['length[1,100]']" style="width:100%;">
            </td>
        </tr>

        <tr>
            <td class="field-label">行业</td>
            <td>
                <input class="easyui-combotree" name="enterprise[tags][<?=\app\index\logic\Tag::TAG_INDUSTRY?>]" data-options="
                        url:'<?=url('enterprises/getIndustriesTree')?>',
                        multivalue:false,
                        multiple:true" style="width:100%;">
            </td>
        </tr>
        <tr>
            <td class="field-label">项目来源</td>
            <td>
                <input class="easyui-textbox" name="enterprise[lead_source]" 
                    data-options="validType:['length[1,20]']" style="width:100%;">
            </td>
        </tr>
        <tr>
            <td class="field-label">企业简称</td>
            <td>
                <input class="easyui-textbox" name="enterprise[alias]" style="width:100%;" data-options="validType:['length[1,20]']">
            </td>
        </tr>
        <tr>
            <td class="field-label">BP</td>
            <td>
                <div class="easyui-panel" data-options="
                    href:'<?=url('upload/attaches',['attachmentType'=>3,'externalId'=>0,'uiStyle'=>\app\index\controller\Upload::ATTACHES_UI_TABLE_STYLE])?>&callback=<?=JVAR?>.uploaded',
                    border:false,
                    minimizable:false,
                    maximizable:false">
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">辅助项目</td>
            <td>
                <?php echo \app\index\service\View::selector([
                    'name'=>'enterprise[relate_enterprises]',
                    'model'=>'enterprises',
                    'value_field'=>'id',
                    'label_field'=>'name',
                    'multiple'=>1,
                    'url' => url('enterprises/index')
                ]); ?>
            </td>
        </tr>
        <tr>
            <td class="field-label">关联科学家</td>
            <td>
                <?php echo \app\index\service\View::selector([
                    'name'=>'enterprise[scientist_id]',
                    'model'=>'scientists',
                    'value_field'=>'id',
                    'label_field'=>'name',
                    'url' => url('scientists/index')
                ]); ?>
            </td>
        </tr>
        <tr>
            <td class="field-label">主跟进人</td>
            <td>
                <select class="easyui-combobox" required="true" editable="false" multiple="true" multivalue="false" name="enterprise[assigner]" style="width:100%;">
                    <?php foreach ($users as $v): ?>
                    <option value="<?=$v['admin_id']?>"><?=$v['realname']?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="field-label">辅助跟进人</td>
            <td>
                <select class="easyui-combobox" editable="false" multiple="true" multivalue="false" name="enterprise[additional_assigners]" style="width:100%;">
                    <?php foreach ($users as $v): ?>
                    <option value="<?=$v['admin_id']?>"><?=$v['realname']?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
    </table>
    <input type="hidden" id="enterprise_pending_files" name="pending_files">
</form>
<script>
var <?=JVAR?>={pendingFiles:[],uploaded:function(files){var that=<?=JVAR?>;$.each(files,function(i,v){that.pendingFiles.push(v.attachment_id);});$('#enterprise_pending_files').val(that.pendingFiles.join(','));}};</script>