<form method="post" id="Form_<?=$uniqid?>" style="width: 100%;height: 100%;">
    <table class="table-form">
        <?php if($bindItems['title'] === null){ ?>
            <tr>
                <td class="field-label">名称:</td>
                <td class="field-input">
                    <input class="easyui-textbox" name="infos[title]" data-options="width:200,validType:['length[1,100]']"
                           value="<?=$bindValues['infos']['title']?>"/>
                </td>
            </tr>
        <?php }else{ ?>
            <input type="hidden" name="infos[title]" value="<?=$bindItems['ffeId']==0?$bindItems['title']:$bindValues['infos']['title']?>" />
        <?php } ?>
        <?php if($bindItems['date'] === null){ ?>
            <tr>
                <td class="field-label">日期:</td>
                <td class="field-input"><input class="easyui-datebox" name="infos[date]" data-options="required:true,width:200,editable:false"
                                               value="<?=dateFilter($bindValues['infos']['date'])?>"/></td>
            </tr>
        <?php }else{ ?>
            <input type="hidden" name="infos[date]" value="<?=$bindItems['ffeId']==0?$bindItems['date']:$bindValues['infos']['date']?>" />
        <?php } ?>
        <tr>
            <td class="field-label">金额(元):</td>
            <td class="field-input"><input class="easyui-numberbox" name="infos[amount]" data-options="required:true,width:200,min:0,precision:2,groupSeparator:','"
                                           value="<?=$bindValues['infos']['amount']?>"/></td>
        </tr>
        <input type="hidden" name="infos[enterprise_id]" value="<?=$bindItems['ffeId']==0?$bindItems['enterpriseId']:$bindValues['infos']['enterprise_id']?>" />
    </table>
</form>
<script type="text/javascript">
    var FFE_<?=$uniqid?> = {
        save:function(){
            var ffeId = 0;
            //支持同步ajax
            $('#Form_<?=$uniqid?>').form('submit', {
                onSubmit: function(){
                    var href = '<?=$urlHrefs['fundEnterprise']?>';
                    var isValid = $(this).form('validate');
                    if (!isValid) return false;
                    $.ajaxSettings.async = false;
                    $.post(href, $(this).serialize(), function(res){
                        if(!res.code){
                        }else{
                            ffeId = res.data;
                        }
                    }, 'json');
                    $.ajaxSettings.async = true;
                    return false;
                }
            });
            return ffeId;
        }
    }
</script>