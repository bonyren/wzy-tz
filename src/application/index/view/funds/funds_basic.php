<form id="fundsBasicForm" method="post">
    <table class="table-form">
        <tr class="form-caption">
            <td colspan="4">基金基本信息</td>
        </tr>
        <tr>
            <td class="field-label" style="width:20%;">名称:</td>
            <td class="field-input" colspan="3">
                <input class="easyui-textbox" name="infos[name]" value="<?=$bindValues['infos']['name']?>"
                       data-options="required:true,width:'100%',validType:['length[1,100]'],disabled:<?=$readOnly?'true':'false'?>">
            </td>
        </tr>
        <tr>
            <td class="field-label">简称:</td>
            <td class="field-input" colspan="3">
                <input class="easyui-textbox" name="infos[alias]" value="<?=$bindValues['infos']['alias']?>"
                       data-options="width:'100%',validType:['length[1,20]'],disabled:<?=$readOnly?'true':'false'?>">
            </td>
        </tr>
        <tr>
            <td class="field-label">代号:</td>
            <td class="field-input" colspan="3">
                <input class="easyui-textbox" name="infos[code]" value="<?=$bindValues['infos']['code']?>"
                       data-options="width:'100%',validType:['length[1,20]'],disabled:<?=$readOnly?'true':'false'?>">
            </td>
        </tr>
        <tr>
            <td class="field-label">注册地:</td>
            <td class="field-input" colspan="3"><input class="easyui-textbox" name="infos[reg_place]" data-options="width:'100%',validType:['length[1,100]'],disabled:<?=$readOnly?'true':'false'?>"
                                                       value="<?=$bindValues['infos']['reg_place']?>" /></td>
        </tr>
        <tr>
            <td class="field-label">规模(元):</td>
            <td class="field-input" colspan="3"><input class="easyui-numberbox" name="infos[size]" data-options="width:'100%',min:0,precision:2,disabled:<?=$readOnly?'true':'false'?>"
                                                       value="<?=$bindValues['infos']['size']?>"/></td>
        </tr>
        <tr>
            <td class="field-label">合伙企业起止日期:</td>
            <td class="field-input" colspan="3">
                <input class="easyui-datebox" name="infos[partnership_start_date]" data-options="editable:false,disabled:<?=$readOnly?'true':'false'?>" value="<?=dateFilter($bindValues['infos']['partnership_start_date'])?>"/>-
                <input class="easyui-datebox" name="infos[partnership_end_date]" data-options="editable:false,disabled:<?=$readOnly?'true':'false'?>" value="<?=dateFilter($bindValues['infos']['partnership_end_date'])?>"/>
            </td>
        </tr>
        <tr>
            <td class="field-label">基金成立结束日期:</td>
            <td class="field-input" colspan="3">
                <input class="easyui-datebox" name="infos[establish_date]" data-options="editable:false,disabled:<?=$readOnly?'true':'false'?>"
                                                       value="<?=dateFilter($bindValues['infos']['establish_date'])?>"/>-
                <input class="easyui-datebox" name="infos[over_date]" data-options="editable:false,disabled:<?=$readOnly?'true':'false'?>"
                       value="<?=dateFilter($bindValues['infos']['over_date'])?>"/>
            </td>
        </tr>

        <tr>
            <td class="field-label">基金投资期(年):</td>
            <td class="field-input"><input class="easyui-numberbox" name="infos[invest_period]" data-options="min:0,precision:0,disabled:<?=$readOnly?'true':'false'?>"
                                           value="<?=$bindValues['infos']['invest_period']?>"/></td>
            <td class="field-label">投资期管理费率:</td>
            <td class="field-input"><input class="easyui-numberbox" name="infos[invest_fee_ratio]" data-options="min:0,precision:2,disabled:<?=$readOnly?'true':'false'?>"
                                           value="<?=$bindValues['infos']['invest_fee_ratio']?>"/>%</td>
        </tr>

        <tr>
            <td class="field-label">基金退出期(年):</td>
            <td class="field-input"><input class="easyui-numberbox" name="infos[exit_period]" data-options="min:0,precision:0,disabled:<?=$readOnly?'true':'false'?>"
                                           value="<?=$bindValues['infos']['exit_period']?>"/></td>
            <td class="field-label">退出期管理费率:</td>
            <td class="field-input"><input class="easyui-numberbox" name="infos[exit_fee_ratio]" data-options="min:0,precision:2,disabled:<?=$readOnly?'true':'false'?>"
                                           value="<?=$bindValues['infos']['exit_fee_ratio']?>"/>%</td>
        </tr>

        <tr>
            <td class="field-label">基金延长期(年):</td>
            <td class="field-input" colspan="3"><input class="easyui-numberbox" name="infos[extend_period]" data-options="min:0,precision:0,disabled:<?=$readOnly?'true':'false'?>"
                                                       value="<?=$bindValues['infos']['extend_period']?>"/></td>
        </tr>
        <tr>
            <td class="field-label">运营状态:</td>
            <td class="field-input" colspan="3">
                <select class="easyui-combobox" name="infos[status]" data-options="editable:false,width:100,panelHeight:'auto',disabled:<?=$readOnly?'true':'false'?>">
                    <?php foreach(\app\index\logic\Funds::$fundStatusDefs as $key=>$value){ ?>
                        <option value="<?=$key?>" <?php echo $bindValues['infos']['status']==$key?'selected':''; ?>><?=$value?></option>
                    <?php }?>
                </select>
            </td>
        </tr>
        <?php if(!$readOnly){ ?>
            <tr class="form-tools">
                <td colspan="4" align="center">
                    <a href="#" class="easyui-linkbutton" data-options="onClick:function(){ fundsBasicModule.save(); },iconCls:'fa fa-save'">保存</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</form>
<script type="text/javascript">
    var fundsBasicModule = {
        save:function(){
            var href = '<?=$urlHrefs['fundsBasic']?>';
            $('#fundsBasicForm').form('submit', {
                onSubmit: function(){
                    var isValid = $(this).form('validate');
                    if (!isValid) return false;
                    $.messager.progress({text:'处理中，请稍候...'});
                    $.post(href, $(this).serialize(), function(res){
                        $.messager.progress('close');
                        if(!res.code){
                            $.app.method.alertError(null, res.msg);
                        }else{
                            $.app.method.tip('提示', res.msg, 'info');
                        }
                    }, 'json');
                    return false;
                }
            });
        }
    };
</script>