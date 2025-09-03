<form method="post" style="width: 100%;height: 100%;">
    <table class="table-form" cellpadding="5">
        <tr class="form-caption">
            <td colspan="2">修改合伙人出资</td>
        </tr>
        <tr>
            <td class="field-label">名称:</td>
            <td class="field-input">
                <input class="easyui-textbox" name="infos[title]" data-options="required:true,width:200,validType:['length[1,100]']"
                       value="<?=$bindValues['infos']['title']?>"/>
            </td>
        </tr>
        <tr>
            <td class="field-label">日期:</td>
            <td class="field-input"><input class="easyui-datebox" name="infos[date]" data-options="required:true,width:200,editable:false"
                                           value="<?=dateFilter($bindValues['infos']['date'])?>"/></td>
        </tr>
        <tr>
            <td class="field-label">金额(元):</td>
            <td class="field-input"><input class="easyui-numberbox" name="infos[amount]" data-options="required:true,width:200,min:0,precision:2"
                                           value="<?=$bindValues['infos']['amount']?>"/></td>
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
                    },checked:<?=array_key_exists($key, $bindValues['infos']['tax'])?'true':'false'?>"/>
                    <input class="easyui-numberbox" id="tax_<?=$key?>" name="infos[tax][<?=$key?>]" data-options="label:'<?=$title?>',labelWidth:200,width:360,min:0,precision:2,disabled:<?=array_key_exists($key, $bindValues['infos']['tax'])?'false':'true'?>"
                           value="<?=array_key_exists($key, $bindValues['infos']['tax'])?$bindValues['infos']['tax'][$key]:'0.00'?>" />元<br />
                <?php } ?>
            </td>
        </tr>
    </table>
</form>