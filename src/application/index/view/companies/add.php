<div class="form-container">
    <form id="companies_edit_form" method="post" class="form-body">
        <table class="table-form" cellpadding="5">
            <tr>
                <td width="30%" class="field-label">股票代码</td>
                <td>
                    <input id="A<?=UNIQID?>" class="easyui-textbox" name="code" style="width:80px;">
                    <a href="javascript:void(0)" class="easyui-linkbutton" onclick="<?=JVAR?>.fetch()" iconCls="fa fa-search">获取</a>
                    如：SZ002797
                </td>
            </tr>
            <tr>
                <td class="field-label">公司名称</td>
                <td>
                    <input class="easyui-textbox" required="true" name="data[name]" value="<?=$data['name']?>" style="width:100%;">
                </td>
            </tr>
            <tr>
                <td class="field-label">所属省份</td>
                <td>

                    <input class="easyui-textbox" name="data[province]" value="<?=$data['province']?>" style="width:100%;">
                </td>
            </tr>
            <tr>
                <td class="field-label">董事长</td>
                <td>
                    <input class="easyui-textbox" name="data[chairman]" value="<?=$data['chairman']?>" style="width:100%;">
                </td>
            </tr>
            <tr>
                <td class="field-label">实际控制人</td>
                <td>
                    <input class="easyui-textbox" name="data[controller]" value="<?=$data['controller']?>" style="width:100%;;">
                </td>
            </tr>
            <tr>
                <td class="field-label">所有制性质</td>
                <td>
                    <input class="easyui-textbox" name="data[forms]" value="<?=$data['forms']?>" style="width:100%;">
                </td>
            </tr>
            <tr>
                <td class="field-label">成立日期</td>
                <td>
                    <input class="easyui-datebox" validType="date" name="data[established_date]" value="<?=$data['established_date']?>" style="width:100%;">
                </td>
            </tr>
            <tr>
                <td class="field-label">注册资本</td>
                <td>
                    <input class="easyui-textbox" min="0" name="data[reg_asset]" value="<?=$data['reg_asset']?>" style="width:100%;">
                </td>
            </tr>
            <tr>
                <td class="field-label">上市日期</td>
                <td>
                    <input class="easyui-datebox" validType="date" name="data[listed_date]" value="<?=$data['listed_date']?>" style="width:100%;">
                </td>
            </tr>
            <tr>
                <td class="field-label">公司网址</td>
                <td>
                    <input class="easyui-textbox" name="data[website]" value="<?=$data['website']?>" style="width:100%;">
                </td>
            </tr>
            <tr>
                <td class="field-label">公司简介</td>
                <td>
                    <input class="easyui-textbox auto-height" multiline="true" name="data[introduction]"
                        data-options="value:'<?=convertLineBreakToEscapeChars($data['introduction'])?>'" style="width:100%;">
                </td>
            </tr>
            <tr>
                <td class="field-label">招股说明书</td>
                <td>
                    <div class="easyui-panel" data-options="border:false,href:'<?=url('upload/attaches',[
                        'attachmentType'=>29,
                        'externalId'=>intval($data['id']),
                        'uiStyle'=>\app\index\controller\Upload::ATTACHES_UI_LIGHT_STYLE])?>&callback=<?=JVAR?>.uploaded'">
                    </div>
                </td>
            </tr>
            <tr>
                <td class="field-label">研究报告</td>
                <td>
                    <div class="easyui-panel" data-options="border:false,href:'<?=url('upload/attaches',[
                        'attachmentType'=>30,
                        'externalId'=>intval($data['id']),
                        'uiStyle'=>\app\index\controller\Upload::ATTACHES_UI_LIGHT_STYLE])?>&callback=<?=JVAR?>.uploaded'">
                    </div>
                </td>
            </tr>
            <tr>
                <td class="field-label">跟进人</td>
                <td>
                    <input class="easyui-combobox" name="data[assigner]" style="width:100%;;"
                        data-options="
                            required:true,
                            editable:false,
                            value:'<?=$data['assigner']?$data['assigner']:''?>',
                            valueField:'admin_id',textField:'realname',
                            url:'<?=url('admins/getAllUsers')?>'">
                </td>
            </tr>
        </table>
        <input type="hidden" id="company_pending_files" name="pending_files">
    </form>
    <div class="form-toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icons-other-tick" onclick="<?=JVAR?>.save()">提交</a>
        &nbsp;
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icons-arrow-cross" onclick="<?=JVAR?>.cancel()">取消</a>
    </div>
</div>
<script>
var <?=JVAR?> = {
    pendingFiles:[],
    uploaded:function(files){
        <?php if (empty($data['id'])): ?>
        var that = <?=JVAR?>;
        $.each(files, function(i,v){
            that.pendingFiles.push(v.attachment_id);
        });
        $('#company_pending_files').val(that.pendingFiles.join(','));
        <?php endif; ?>
    },
    fetch:function(){
        var code = $.trim($('#A<?=UNIQID?>').textbox('getValue'));
        if (code=='') {
            return $.app.method.tip('提示', '请填写股票代码', 'error');
        }
        $('#globel-dialog-div').dialog('refresh','<?=url('companies/add')?>?id=<?=$id?>&grid=<?=$grid?>&code='+code)
    },
    save:function(){
        var $form = $('#companies_edit_form');
        if(!$form.form('validate')){
            return false;
        }
        $.messager.progress({text:'处理中，请稍候...'});
        var $data = $form.serialize();
        $.post('<?=$_request_url?>', $data, function(res){
            $.messager.progress('close');
            if(!res.code){
                $.app.method.alertError(null, res.msg);
            }else{
                $.app.method.tip('提示', res.msg);
                $('#globel-dialog-div').dialog('close');
                $('#<?=$grid?>').datagrid('reload');
            }
        }, 'json');
    },
    cancel:function(){
        $('#globel-dialog-div').dialog('close');
    }
}
$.parser.onComplete = function(){
    var txtbox = $(".auto-height");
    if (txtbox.length) {
        $.each(txtbox, function(i,v){
            $(v).textbox('autoHeight');
        })
    }
}
</script>