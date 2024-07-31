<form id="my-password-form">
    <table class="table-form" cellpadding="5">
        <tr>
            <td class="field-label" width="120">姓名</td>
            <td class="field-input"><?=$_user['name']?></td>
        </tr>
        <tr>
            <td class="field-label">账号</td>
            <td class="field-input"><?=$_user['username']?></td>
        </tr>
        <tr>
            <td class="field-label">旧登录密码</td>
            <td class="field-input">
                <input class="easyui-passwordbox" name="data[password]" data-options="required:true,width:250,validType:['length[6,20]']">
            </td>
        </tr>
        <tr>
            <td class="field-label">新登录密码</td>
            <td class="field-input">
                <input id="new_password" class="easyui-passwordbox" name="data[update_password]"
                       data-options="required:true,width:250,validType:['length[6,20]']">
            </td>
        </tr>
        <tr>
            <td class="field-label">重复新密码</td>
            <td class="field-input">
                <input class="easyui-passwordbox" name="data[repeat_password]"
                       data-options="required:true,width:250,validType:{length:[6,20],equals:['#new_password']}">
            </td>
        </tr>
    </table>
</form>