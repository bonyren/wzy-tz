<form id="fundsCollectHostingPlanForm" method="post">
    <table class="table-form">
        <tr>
            <td class="field-label" style="width: 150px;">
                托管机构：
            </td>
            <td class="field-input">
                <select class="easyui-combobox" name="infos[hosting_agency_id]" data-options="method:'post',
                    url:'<?=$urlHrefs['hostingAgencyComboConfig']?>',
                    editable:false,
                    width:300,
                    panelHeight:'auto',
                    valueField:'id',
                    textField:'name',
                    disabled:<?=$readOnly?'true':'false'?>,
                    onLoadSuccess:function(data){
                        $(this).combobox('select', <?=$bindValues['infos']['hosting_agency_id']?>);
                    }">
                </select>
            </td>
        </tr>
        <tr>
            <td class="field-label">
                托管费率：
            </td>
            <td class="field-input">
                <input class="easyui-numberbox" name="infos[hosting_fee_ratio]" data-options="
                disabled:<?=$readOnly?'true':'false'?>,
                width:100,
                min:0,
                precision:2" prompt="如:2"
                       value="<?=$bindValues['infos']['hosting_fee_ratio']?>"/>%
            </td>
        </tr>
        <tr>
            <td class="field-label">
                银行募集账户：
            </td>
            <td class="field-input">
                <input id="funds-collect-account-textbox" class="easyui-textbox" name="infos[bank_collect_account]" data-options="label:'',
                    width:'100%',
                    height:'auto',
                    multiline:true,
                    disabled:<?=$readOnly?'true':'false'?>,
                    validType:['length[1,255]'],
                    value:'<?=convertLineBreakToEscapeChars($bindValues['infos']['bank_collect_account'])?>'" prompt="请输入账户名、帐号、开户行"
                    style="width:100%"/>
            </td>
        </tr>
        <tr>
            <td class="field-label">
                银行托管账户：
            </td>
            <td class="field-input">
                <input id="funds-collect-bank-hosting-account-textbox" class="easyui-textbox" name="infos[bank_hosting_account]" data-options="label:'',
                    width:'100%',
                    height:'auto',
                    multiline:true,
                    disabled:<?=$readOnly?'true':'false'?>,
                    validType:['length[1,255]'],
                    value:'<?=convertLineBreakToEscapeChars($bindValues['infos']['bank_hosting_account'])?>'" prompt="请输入账户名、帐号、开户行"
                    style="width:100%"/>
            </td>
        </tr>
        <tr>
            <td class="field-label">
                托管备注：
            </td>
            <td class="field-input">
                <input id="funds-collect-hosting-plan-info-textbox" class="easyui-textbox" name="infos[hosting_plan_info]" data-options="label:'',
                width:'100%',
                height:'auto',
                multiline:true,
                disabled:<?=$readOnly?'true':'false'?>,
                validType:['length[1,255]'],
                value:'<?=convertLineBreakToEscapeChars($bindValues['infos']['hosting_plan_info'])?>'" prompt="请输入托管相关信息"
                style="width:100%"/>
            </td>
        </tr>
        <?php if(!$readOnly){ ?>
            <tr class="form-tools">
                <td colspan="2" align="center">
                    <a href="#" class="easyui-linkbutton" data-options="onClick:function(){ fundsCollectHostingPlanModule.edit(); },iconCls:'fa fa-save'">保存</a>
                </td>
            </tr>
        <?php } ?>
        <tr>
            <td class="field-label">
                托管协议附件：
            </td>
            <td class="field-input">
                <div id="hostingPlanAgreementAttachments"></div>
            </td>
        </tr>
        <tr>
            <td class="field-label">
                其他附件：
            </td>
            <td class="field-input">
                <div id="hostingPlanOtherAttachments"></div>
            </td>
        </tr>
    </table>
</form>
<script type="text/javascript">
    var fundsCollectHostingPlanModule = {
        edit:function(){
            var href = '<?=$urlHrefs['fundsCollectHostingPlan']?>';
            $('#fundsCollectHostingPlanForm').form('submit', {
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
    $('#hostingPlanAgreementAttachments').attaches({
        attachmentType:<?=\app\index\logic\Upload::ATTACH_FUND_COLLECT_HOSTING_PLAN_AGREEMENT?>,
        externalId:<?=$externalId?>,
        uiStyle:<?=\app\index\controller\Upload::ATTACHES_UI_DATAGRID_STYLE?>,
        readOnly:<?=$readOnly?'true':'false'?>
    });
    $('#hostingPlanOtherAttachments').attaches({
        attachmentType:<?=\app\index\logic\Upload::ATTACH_FUND_COLLECT_HOSTING_PLAN_OTHER?>,
        externalId:<?=$externalId?>,
        uiStyle:<?=\app\index\controller\Upload::ATTACHES_UI_DATAGRID_STYLE?>,
        readOnly:<?=$readOnly?'true':'false'?>
    });
    $.parser.onComplete = function(context){
        console.log('funds_collect_hosting_plan onComplete');
        $("#funds-collect-account-textbox").textbox('autoHeight');
        $("#funds-collect-bank-hosting-account-textbox").textbox('autoHeight');
        $("#funds-collect-hosting-plan-info-textbox").textbox('autoHeight');
    }
</script>