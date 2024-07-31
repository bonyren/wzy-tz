<form id="fundsCollectProtocolForm" method="post">
    <table class="table-form">
        <tr>
            <td class="field-label" style="width: 150px;">
                合伙协议备注：
            </td>
            <td class="field-input">
                <input id="funds-collect-protocol-info-textbox" class="easyui-textbox" name="infos[protocol_info]" data-options="label:'',
                width:'100%',
                height:'auto',
                multiline:true,
                disabled:<?=$readOnly?'true':'false'?>,
                validType:['length[1,255]'],
                value:'<?=convertLineBreakToEscapeChars($bindValues['infos']['protocol_info'])?>'" prompt="请输入合伙协议相关信息"
                />
            </td>
        </tr>
        <?php if(!$readOnly){ ?>
            <tr class="form-tools">
                <td colspan="2" align="center">
                    <a href="#" class="easyui-linkbutton" data-options="onClick:function(){ fundsCollectProtocolModule.edit(); },iconCls:'fa fa-save'">保存</a>
                </td>
            </tr>
        <?php } ?>
        <tr>
            <td class="field-label" style="width:20%;">合伙协议：</td>
            <td class="field-input">
                <div id="partnerProtocolAttachments"></div>
            </td>
        </tr>
    </table>
</form>
<script type="text/javascript">
    var fundsCollectProtocolModule = {
        edit:function(){
            var href = '<?=$urlHrefs['fundsCollectProtocol']?>';
            $('#fundsCollectProtocolForm').form('submit', {
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
    $('#partnerProtocolAttachments').attaches({
        attachmentType:<?=\app\index\logic\Upload::ATTACH_FUND_PARTNER_AGREEMENT?>,
        externalId:<?=$externalId?>,
        uiStyle:<?=\app\index\controller\Upload::ATTACHES_UI_DATAGRID_STYLE?>,
        readOnly:<?=$readOnly?'true':'false'?>
    });
    $.parser.onComplete = function(context){
        $("#funds-collect-protocol-info-textbox").textbox('autoHeight');
    }
</script>