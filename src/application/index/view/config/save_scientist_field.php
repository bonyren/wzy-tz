<form method="post">
    <table class="table-form">
        <tr>
            <td class="field-label" style="width: 100px;">名称:</td>
            <td class="field-input">
                <input class="easyui-textbox" name="infos[name]"
                       data-options="required:true,width:'100%',validType:['length[1,32]']"
                       value="<?=$infos['name']?>"/>
            </td>
        </tr>
    </table>
</form>