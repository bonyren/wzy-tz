<form id="fundsCollectBusinessRegForm" method="post">
    <table class="table-form">
        <tr>
            <td class="field-label" width="150">
                代理机构：
            </td>
            <td class="field-input">
                <select class="easyui-combobox" name="infos[business_reg_proxy_id]" data-options="method:'post',
                    url:'<?=$urlHrefs['businessRegProxyComboConfig']?>',
                    editable:false,
                    width:300,
                    panelHeight:'auto',
                    valueField:'id',
                    textField:'name',
                    disabled:<?=$readOnly?'true':'false'?>,
                    onLoadSuccess:function(data){
                        $(this).combobox('select', <?=$bindValues['infos']['business_reg_proxy_id']?>);
                    }">
                </select>
            </td>
        </tr>
        <tr>
            <td class="field-label">
                营业执照号：
            </td>
            <td class="field-input">
                <input class="easyui-textbox" name="infos[business_license_no]" data-options="label:'',
                width:300,
                disabled:<?=$readOnly?'true':'false'?>,
                validType:['length[1,255]']" value="<?=$bindValues['infos']['business_license_no']?>" />
            </td>
        </tr>
        <tr>
            <td class="field-label">
                银行基本户：
            </td>
            <td class="field-input">
                <input id="funds-collect-bank-basic-account-textbox" class="easyui-textbox" name="infos[bank_basic_account]" data-options="label:'',
                    width:'100%',
                    height:'auto',
                    multiline:true,
                    disabled:<?=$readOnly?'true':'false'?>,
                    validType:['length[1,255]'],
                    value:'<?=convertLineBreakToEscapeChars($bindValues['infos']['bank_basic_account'])?>'" prompt="请输入账户名、帐号、开户行"
                    />
            </td>
        </tr>
        <tr>
            <td class="field-label">
                工商注册备注：
            </td>
            <td class="field-input">
                <input id="funds-collect-business-reg-info-textbox" class="easyui-textbox" name="infos[business_reg_info]" data-options="label:'',
                    width:'100%',
                    height:'auto',
                    multiline:true,
                    disabled:<?=$readOnly?'true':'false'?>,
                    validType:['length[1,255]'],
                    value:'<?=convertLineBreakToEscapeChars($bindValues['infos']['business_reg_info'])?>'" prompt="请输入工商注册相关信息"
                    />
            </td>
        </tr>
        <tr>
            <td class="field-label">
                完成人：
            </td>
            <td>
                <?php echo \app\index\service\View::workStatus($bindValues['infos']['work_status'], $readOnly); ?>
            </td>
        </tr>
        <?php if(!$readOnly){ ?>
            <tr class="form-tools">
                <td colspan="2" align="center">
                    <a href="#" class="easyui-linkbutton" data-options="onClick:function(){ fundsCollectBusinessRegModule.edit(); },iconCls:'fa fa-save'">保存</a>
                </td>
            </tr>
        <?php } ?>
        <tr>
            <td class="field-label">
                代理协议附件：
            </td>
            <td class="field-input">
                <div id="businessRegProxyAttachments"></div>
            </td>
        </tr>
        <tr>
            <td class="field-label">
                营业执照附件：
            </td>
            <td class="field-input">
                <div id="businessRegLicenseAttachments"></div>
            </td>
        </tr>
        <tr>
            <td class="field-label">
                其他附件：
            </td>
            <td class="field-input">
                <div id="businessRegOtherAttachments"></div>
            </td>
        </tr>
    </table>
</form>
<script type="text/javascript">
    var fundsCollectBusinessRegModule = {
        edit:function(){
            var href = '<?=$urlHrefs['fundsCollectBusinessReg']?>';
            $('#fundsCollectBusinessRegForm').form('submit', {
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
    $('#businessRegProxyAttachments').attaches({
        attachmentType:<?=\app\index\logic\Upload::ATTACH_FUND_COLLECT_BUSINESS_REG_PROXY_AGREEMENT?>,
        externalId:<?=$externalId?>,
        uiStyle:<?=\app\index\controller\Upload::ATTACHES_UI_DATAGRID_STYLE?>,
        readOnly:<?=$readOnly?'true':'false'?>
    });
    $('#businessRegLicenseAttachments').attaches({
        attachmentType:<?=\app\index\logic\Upload::ATTACH_FUND_COLLECT_BUSINESS_REG_BUSINESS_LICENSE?>,
        externalId:<?=$externalId?>,
        uiStyle:<?=\app\index\controller\Upload::ATTACHES_UI_DATAGRID_STYLE?>,
        readOnly:<?=$readOnly?'true':'false'?>
    });
    $('#businessRegOtherAttachments').attaches({
        attachmentType:<?=\app\index\logic\Upload::ATTACH_FUND_COLLECT_BUSINESS_REG_OTHER?>,
        externalId:<?=$externalId?>,
        uiStyle:<?=\app\index\controller\Upload::ATTACHES_UI_DATAGRID_STYLE?>,
        readOnly:<?=$readOnly?'true':'false'?>
    });
    $.parser.onComplete = function(context){
        console.log('funds_collect_business_reg onComplete');
        $('#funds-collect-bank-basic-account-textbox').textbox('autoHeight');
        $('#funds-collect-business-reg-info-textbox').textbox('autoHeight');
    };
</script>