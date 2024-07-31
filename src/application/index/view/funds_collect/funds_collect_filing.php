<form id="fundsCollectFilingForm" method="post">
    <table class="table-form">
        <tr>
            <td class="field-label" style="width: 200px;">
                备案号：
            </td>
            <td class="field-input">
                <input class="easyui-textbox" name="infos[filing_no]" data-options="label:'',
                disabled:<?=$readOnly?'true':'false'?>,
                validType:['length[1,255]']" value="<?=$bindValues['infos']['filing_no']?>" />
            </td>
        </tr>
        <tr>
            <td class="field-label">
                备案备注：
            </td>
            <td class="field-input">
                <input id="funds-collect-filing-info-textbox" class="easyui-textbox" name="infos[filing_info]" data-options="label:'',
                    width:'100%',
                    height:'auto',
                    multiline:true,
                    disabled:<?=$readOnly?'true':'false'?>,
                    validType:['length[1,255]'],
                    value:'<?=convertLineBreakToEscapeChars($bindValues['infos']['filing_info'])?>'" prompt="请输入备案相关信息" />
            </td>
        </tr>
        <?php if(!$readOnly){ ?>
            <tr class="form-tools">
                <td colspan="2" align="center">
                    <a href="#" class="easyui-linkbutton" data-options="onClick:function(){ fundsCollectFilingModule.edit(); },iconCls:'fa fa-save'">保存</a>
                </td>
            </tr>
        <?php } ?>
        <tr>
            <td class="field-label" style="width:20%;">备案函:</td>
            <td class="field-input">
                <div id="filingLetterAttachments"></div>
            </td>
        </tr>
        <tr>
            <td class="field-label">
                其他附件：
            </td>
            <td class="field-input">
                <div id="filingOtherAttachments"></div>
            </td>
        </tr>
    </table>
</form>
<script type="text/javascript">
    var fundsCollectFilingModule = {
        edit:function(){
            var href = '<?=$urlHrefs['fundsCollectFiling']?>';
            $('#fundsCollectFilingForm').form('submit', {
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
    $('#filingLetterAttachments').attaches({
        attachmentType:<?=\app\index\logic\Upload::ATTACH_FUND_FILING_LETTER?>,
        externalId:<?=$externalId?>,
        uiStyle:<?=\app\index\controller\Upload::ATTACHES_UI_DATAGRID_STYLE?>,
        readOnly:<?=$readOnly?'true':'false'?>
    });
    $('#filingOtherAttachments').attaches({
        attachmentType:<?=\app\index\logic\Upload::ATTACH_FUND_COLLECT_FILING_OTHER?>,
        externalId:<?=$externalId?>,
        uiStyle:<?=\app\index\controller\Upload::ATTACHES_UI_DATAGRID_STYLE?>,
        readOnly:<?=$readOnly?'true':'false'?>
    });
    $.parser.onComplete = function(context){
        $("#funds-collect-filing-info-textbox").textbox('autoHeight');
    }
</script>