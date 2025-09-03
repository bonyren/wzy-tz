<form method="post" id="Form_<?=$uniqid?>" style="width: 100%;height: 100%;">
    <table class="table-form" cellpadding="5">
        <?php if($bindItems['type'] === null){ ?>
        <tr>
            <td class="field-label">类型:</td>
            <td class="field-input">
                <select class="easyui-combobox" name="infos[type]" data-options="editable:false,width:200,panelHeight:'auto'">
                    <?php foreach(\app\index\logic\Defs::$fundIncomeTypeHtmlDefs as $key=>$value){ ?>
                        <option value="<?=$key?>" <?php echo $bindValues['infos']['type']==$key?'selected':''; ?>><?=$value?></option>
                    <?php }?>
                </select>
            </td>
        </tr>
        <?php }else{ ?>
            <input type="hidden" name="infos[type]" value="<?=$bindItems['ffiId']==0?$bindItems['type']:$bindValues['infos']['type']?>" />
        <?php } ?>
        <?php if($bindItems['title'] === null){ ?>
        <tr>
            <td class="field-label">名称:</td>
            <td class="field-input">
                <input class="easyui-textbox" name="infos[title]" data-options="width:200,validType:['length[1,100]']"
                       value="<?=$bindValues['infos']['title']?>"/>
            </td>
        </tr>
        <?php }else{ ?>
            <input type="hidden" name="infos[title]" value="<?=$bindItems['ffiId']==0?$bindItems['title']:$bindValues['infos']['title']?>" />
        <?php } ?>
        <?php if($bindItems['date'] === null){ ?>
        <tr>
            <td class="field-label">日期:</td>
            <td class="field-input"><input class="easyui-datebox" name="infos[date]" data-options="width:200,editable:false"
                                           value="<?=dateFilter($bindValues['infos']['date'])?>"/></td>
        </tr>
        <?php }else{ ?>
            <input type="hidden" name="infos[date]" value="<?=$bindItems['ffiId']==0?$bindItems['date']:$bindValues['infos']['date']?>" />
        <?php } ?>
        <tr>
            <td class="field-label">金额(元):</td>
            <td class="field-input">
                <input class="easyui-numberbox" name="infos[amount]" value="<?=$bindValues['infos']['amount']?>"
                       data-options="required:true,width:200,min:0,precision:2,groupSeparator:','">
            </td>
        </tr>
        <tr>
            <td class="field-label">缴税:</td>
            <td>
                <?php foreach(\app\index\logic\Defs::$fundTaxTypeDefs as $key=>$title){ ?>
                    <input class="easyui-checkbox" name="infos[tax_type][<?=$key?>]" value="<?=$key?>" data-options="onChange:function(checked){
                        if(checked){
                            $('#tax_<?=$uniqid?>_<?=$key?>').numberbox('enable');
                        }else{
                            $('#tax_<?=$uniqid?>_<?=$key?>').numberbox('disable');
                        }
                    },checked:<?=array_key_exists($key, $bindValues['infos']['tax'])?'true':'false'?>"/>
                    <input class="easyui-numberbox" id="tax_<?=$uniqid?>_<?=$key?>" name="infos[tax][<?=$key?>]" data-options="label:'<?=$title?>',labelWidth:120,width:250,min:0,precision:2,disabled:<?=array_key_exists($key, $bindValues['infos']['tax'])?'false':'true'?>"
                           value="<?=array_key_exists($key, $bindValues['infos']['tax'])?$bindValues['infos']['tax'][$key]:'0.00'?>" />元<br />
                <?php } ?>
            </td>
        </tr>
    </table>
</form>
<script type="text/javascript">
var FFI_<?=$uniqid?>={save:function(){var fffId=0;$('#Form_<?=$uniqid?>').form('submit',{onSubmit:function(){var href='<?=$urlHrefs['fundIncome']?>';var isValid=$(this).form('validate');if(!isValid)return false;$.ajaxSettings.async=false;$.post(href,$(this).serialize(),function(res){if(!res.code){}else{fffId=res.data;}},'json');$.ajaxSettings.async=true;return false;}});return fffId;}};</script>