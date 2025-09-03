<form style="width: 100%;height: 100%;">
    <table class="table-form" cellpadding="5">
        <tr class="form-caption">
            <td colspan="2">添加新用户</td>
        </tr>
        <tr>
            <td class="field-label" style="width: 20%;">登录名:</td>
            <td class="field-input"><input class="easyui-textbox" name="infos[login_name]" data-options="required:true,width:'100%',validType:['length[1,60]']" /></td>
        </tr>
        <tr>
            <td class="field-label">登录密码:</td>
            <td class="field-input"><input class="easyui-textbox" name="infos[login_password]" data-options="required:true,width:'100%',type:'password',validType:{length:[6,20]}" /></td>
        </tr>
        <tr>
            <td class="field-label">姓名:</td>
            <td class="field-input"><input class="easyui-textbox" name="infos[realname]" data-options="required:true,width:'100%',validType:['length[1,20]']" /></td>
        </tr>
        <tr>
            <td class="field-label">Email:</td>
            <td class="field-input"><input class="easyui-textbox" name="infos[email]" data-options="required:true,width:'100%',validType:['length[1,60]', 'email', 'remote[\'<?=$urlHrefs['checkAdminEmail']?>\', \'email\']']" /></td>
        </tr>
        <tr>
            <td class="field-label">是否超级管理员?</td>
            <td class="field-input">
                <input class="easyui-checkbox" name="infos[super_user]" value="<?=\app\index\model\Admins::eAdminSuperRole?>"
                       data-options="onChange:adminAddModule.onSuperUserChange"/>
            </td>
        </tr>
        <tr id="adminRoleRow">
            <td class="field-label">角色</td>
            <td class="field-input">
                <select class="easyui-combobox" name="infos[role_id]" data-options="editable:false,panelHeight:'auto',width:'100%'">
                    <?php foreach($bindValues['adminRolePairs'] as $key=>$value){ ?>
                        <option value="<?=$key?>"><?=$value?></option>
                    <?php } ?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="field-label">是否帐号禁用?</td>
            <td class="field-input">
                <input class="easyui-checkbox" name="infos[disabled]" value="<?=\app\index\model\Admins::eAdminDisabledStatus?>"/>
            </td>
        </tr>
    </table>
</form>
<script type="text/javascript">
var adminAddModule={onSuperUserChange:function(checked){if(checked){$('#adminRoleRow').hide();}else{$('#adminRoleRow').show();}}};</script>