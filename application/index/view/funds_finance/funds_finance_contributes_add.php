<form method="post" style="width: 100%;height: 100%;">
    <table class="table-form" cellpadding="5">
        <tr class="form-caption">
            <td colspan="2">添加合伙人出资</td>
        </tr>
        <tr>
            <td class="field-label">名称:</td>
            <td class="field-input">
                <input class="easyui-textbox" name="infos[title]" data-options="required:true,width:200,validType:['length[1,100]']" />
            </td>
        </tr>
        <tr>
            <td class="field-label">日期:</td>
            <td class="field-input"><input class="easyui-datebox" name="infos[date]" data-options="required:true,width:200,editable:false"/></td>
        </tr>
        <tr>
            <td class="field-label">金额(元):</td>
            <td class="field-input"><input class="easyui-numberbox" name="infos[amount]" data-options="required:true,width:200,min:0,precision:2" /></td>
        </tr>
        <tr>
            <td class="field-label">缴税:</td>
            <td>
                <?php foreach(\app\index\logic\Defs::$fundTaxTypeDefs as $key=>$title){ ?>
                    <input class="easyui-checkbox" name="infos[tax_type][<?=$key?>]" value="<?=$key?>" data-options="onChange:function(checked){
                        if(checked){
                            $('#tax_<?=$key?>').numberbox('enable');
                        }else{
                            $('#tax_<?=$key?>').numberbox('disable');
                        }
                    }"/>
                    <input class="easyui-numberbox" id="tax_<?=$key?>" name="infos[tax][<?=$key?>]" data-options="label:'<?=$title?>',labelWidth:200,width:360,min:0,precision:2,disabled:true" value="0.00" />元<br />
                <?php } ?>
            </td>
        </tr>
    </table>
</form>