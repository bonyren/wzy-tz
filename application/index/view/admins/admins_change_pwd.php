<form style="width: 100%;height: 100%;">
    <table class="table-form" cellpadding="5">
        <tr class="form-caption">
            <td colspan="2"></td>
        </tr>
        <tr>
            <td class="field-label">登录名:</td>
            <td class="field-input">
                <?=$bindValues['infos']['login_name']?>
            </td>
        </tr>
        <tr>
            <td class="field-label">新登录密码:</td>
            <td class="field-input">
                <input id="login_password" class="easyui-textbox" name="infos[login_password]"
                                           data-options="required:true,width:300,type:'password',validType:{length:[6,20]}" />
            </td>
        </tr>
        <tr>
            <td class="field-label">重复登录密码:</td>
            <td class="field-input">
                <input class="easyui-textbox" name="infos[repeat_password]"
                                           data-options="required:true,width:300,type:'password',validType:{length:[6,20],equals:['#login_password']}" />
            </td>
        </tr>
    </table>
</form>