<form style="width: 100%;height: 100%;">
    <table class="table-form" cellpadding="5">
        <tr>
            <td class="field-label" style="width: 200px;">登录手机号码:</td>
            <td class="field-input"><input class="easyui-textbox" name="infos[login_name]" data-options="required:true,width:'100%',validType:['length[6,20]','mobile']"
                    value="<?=$bindValues['infos']['login_name']?>"/></td>
        </tr>
        <tr>
            <td class="field-label">登录密码:</td>
            <td class="field-input"><input id="login_password" class="easyui-passwordbox" name="infos[login_password]"
                                           data-options="required:true,width:'100%',validType:['length[6,20]']" /></td>
        </tr>
        <tr>
            <td class="field-label">重复登录密码:</td>
            <td class="field-input">
                <input class="easyui-passwordbox" name="infos[repeat_password]"
                       data-options="required:true,width:'100%',validType:{length:[6,20],equals:['#login_password']}" /></td>
        </tr>
    </table>
</form>