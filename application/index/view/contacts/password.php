<form id="contact-password-form" style="width: 100%;height: 100%;">
    <table class="table-form" cellpadding="5">
        <tr class="form-caption">
            <td colspan="2"></td>
        </tr>
        <tr>
            <td class="field-label" style="width: 20%;">登录账号:</td>
            <td class="field-input">
                <input class="easyui-textbox" name="data[username]" value="<?=$contact['username']?>"
                       data-options="required:true,width:'100%',validType:['length[6,20]']">
            </td>
        </tr>
        <tr>
            <td class="field-label">登录密码:</td>
            <td class="field-input">
                <input id="contact_password" class="easyui-passwordbox" name="data[password]"
                       data-options="required:true,width:'100%',validType:['length[6,20]']">
            </td>
        </tr>
        <tr>
            <td class="field-label">确认密码:</td>
            <td class="field-input">
                <input class="easyui-passwordbox" name="data[repeat_password]"
                       data-options="required:true,width:'100%',validType:{length:[6,20],equals:['#contact_password']}">
            </td>
        </tr>
    </table>
</form>