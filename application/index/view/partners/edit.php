<form method="post" style="width: 100%;height: 100%;">
    <table class="table-form" cellpadding="5">
        <tr class="form-caption">
            <td colspan="2">修改合伙人</td>
        </tr>
        <tr>
            <td class="field-label" style="width: 20%;">姓名:</td>
            <td class="field-input"><input class="easyui-textbox" name="infos[name]" value="<?=$bindValues['infos']['name']?>"
                                           data-options="required:true,width:'100%',validType:['length[1,100]']" /></td>
        </tr>
        <tr>
            <td class="field-label">职位:</td>
            <td class="field-input"><input class="easyui-textbox" name="infos[title]" value="<?=$bindValues['infos']['title']?>"
                                           data-options="width:'100%',validType:['length[1,100]']" /></td>
        </tr>
        <tr>
            <td class="field-label">电话:</td>
            <td class="field-input"><input class="easyui-textbox" name="infos[tel]" value="<?=$bindValues['infos']['tel']?>"
                                           data-options="width:'100%',validType:['length[1,100]']" /></td>
        </tr>
        <tr>
            <td class="field-label">电子邮箱:</td>
            <td class="field-input"><input class="easyui-textbox" name="infos[email]" value="<?=$bindValues['infos']['email']?>"
                                           data-options="width:'100%',validType:['length[1,100]','email']" /></td>
        </tr>
        <tr>
            <td class="field-label">地址:</td>
            <td class="field-input"><input class="easyui-textbox" name="infos[address]" value="<?=$bindValues['infos']['address']?>"
                                           data-options="width:'100%',validType:['length[1,255]']" /></td>
        </tr>
        <tr>
            <td class="field-label">证件类型:</td>
            <td class="field-input">
                <select class="easyui-combobox" name="infos[credential_type]" data-options="editable:false, panelHeight:'auto', width:100">
                    <?php foreach(\app\index\logic\Defs::$partnerCredentialTypeDefs as $key=>$value){ ?>
                        <option value="<?=$key?>" <?php echo $bindValues['infos']['credential_type']==$key?'selected':''; ?>><?=$value?></option>
                    <?php }?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="field-label">证件号码:</td>
            <td class="field-input"><input class="easyui-textbox" name="infos[credential_no]" value="<?=$bindValues['infos']['credential_no']?>"
                                           data-options="width:'100%',validType:['length[1,100]']" /></td>
        </tr>
        <tr>
            <td class="field-label">状态:</td>
            <td class="field-input">
                <select class="easyui-combobox" name="infos[status]" data-options="editable:false, panelHeight:'auto', width:100">
                    <?php foreach(\app\index\logic\Defs::$partnerStatusDefs as $key=>$value){ ?>
                        <option value="<?=$key?>" <?php echo $bindValues['infos']['status']==$key?'selected':''; ?>><?=$value?></option>
                    <?php }?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="field-label">可见项目:</td>
            <td class="field-input">
                <?=\app\index\service\View::selector([
                    'name'=>'infos[enterprises]',
                    'value'=>$bindValues['infos']['enterprises'],
                    'model'=>'enterprises',
                    'multiple'=>1,
                    'url' => url('enterprises/index'),
                ])?>
            </td>
        </tr>
        <tr>
            <td class="field-label" valign="top">备注</td>
            <td class="field-input">
                <textarea class="easyui-textbox auto-height" name="infos[note]" data-options="
                    width:'100%',
                    multiline:true,
                    validType:['length[1,200]']"><?=$bindValues['infos']['note']?></textarea>
            </td>
        </tr>
    </table>
    <div class="easyui-tabs" data-options="fit:true">
        <div title="附件" data-options="cache:false,href:'<?=$urlHrefs['attachments']?>',iconCls:'fa fa-file-text',border:false"></div>
    </div>
</form>
<script type="text/javascript">
$.parser.onComplete=function(context){var txtbox=$(".auto-height");if(txtbox.length){$.each(txtbox,function(i,v){$(v).textbox('autoHeight');})}
$.parser.onComplete=$.noop;};</script>