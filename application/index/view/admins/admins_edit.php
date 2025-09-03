<form style="width: 100%;height: 100%;">
    <table class="table-form" cellpadding="5">
        <tr class="form-caption">
            <td colspan="2">修改用户</td>
        </tr>
        <tr>
            <td class="field-label" style="width:20%;">登录名:</td>
            <td class="field-input"><input class="easyui-textbox" name="infos[login_name]" value="<?=$bindValues['infos']['login_name']?>"
                                           data-options="required:true,width:'100%',validType:['length[1,60]']"></td>
        </tr>
        <tr>
            <td class="field-label">姓名:</td>
            <td class="field-input">
                <input class="easyui-textbox" name="infos[realname]" value="<?=$bindValues['infos']['realname']?>"
                    data-options="required:true,width:'100%',validType:['length[1,20]']">
            </td>
        </tr>
        <tr>
            <td class="field-label">Email:</td>
            <td class="field-input">
                <input class="easyui-textbox" name="infos[email]" value="<?=$bindValues['infos']['email']?>"
                    data-options="required:true,width:'100%',validType:['length[1,60]', 'email', 'remote[\'<?=$urlHrefs['checkAdminEmail']?>\', \'email\']']">
            </td>
        </tr>
        <tr>
            <td class="field-label">是否超级管理员?</td>
            <td class="field-input">
                <input id="adminSuperUserCheckbox" class="easyui-checkbox" name="infos[super_user]" value="<?=\app\index\model\Admins::eAdminSuperRole?>"
                       data-options="onChange:adminEditModule.onSuperUserChange,checked:<?php if($bindValues['infos']['super_user'] == \app\index\model\Admins::eAdminSuperRole){
                           echo "true";
                       }else{
                           echo "false";
                       }?>"/>
            </td>
        </tr>
        <tr id="adminRoleRow">
            <td class="field-label">角色</td>
            <td class="field-input">
                <select class="easyui-combobox" name="infos[role_id]" data-options="editable:false,panelHeight:'auto',width:'100%'">
                    <?php foreach($bindValues['adminRolePairs'] as $key=>$value){ ?>
                        <option value="<?=$key?>" <?=$bindValues['infos']['role_id']==$key?'selected':''?>><?=$value?></option>
                    <?php } ?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="field-label">是否帐号禁用?</td>
            <td class="field-input">
                <input class="easyui-checkbox" name="infos[disabled]" value="<?=\app\index\model\Admins::eAdminDisabledStatus?>"
                    <?php if($bindValues['infos']['disabled'] == \app\index\model\Admins::eAdminDisabledStatus){
                        echo "checked";
                    }?>/>
            </td>
        </tr>
    </table>
</form>
<script type="text/javascript">
var adminEditModule={onSuperUserChange:function(checked){if(checked){$('#adminRoleRow').hide();}else{$('#adminRoleRow').show();}}};$.parser.onComplete=function(context){if($('#adminSuperUserCheckbox').length>0){if($('#adminSuperUserCheckbox').checkbox('options').checked==true){$('#adminRoleRow').hide();}else{$('#adminRoleRow').show();}}
$.parser.onComplete=$.noop;};</script>