
<form id="fundsCollectPlanForm" method="post">
    <table class="table-form">
        <tr>
            <td class="field-label">
                基金方案备注：
            </td>
            <td class="field-input">
                <input id="funds-collect-plan-info-textbox" class="easyui-textbox" name="infos[plan_info]" data-options="label:'',
                width:'100%',
                height:'auto',
                multiline:true,
                disabled:<?=$readOnly?'true':'false'?>,
                validType:['length[1,255]'],
                value:'<?=convertLineBreakToEscapeChars($bindValues['infos']['plan_info'])?>'" prompt="请输入基金方案相关信息"
                />
            </td>
        </tr>
        <?php if(!$readOnly){ ?>
            <tr class="form-tools">
                <td colspan="2" align="center">
                    <a href="#" class="easyui-linkbutton" data-options="onClick:function(){ fundsCollectPlanModule.edit(); },iconCls:'fa fa-save'">保存</a>
                </td>
            </tr>
        <?php } ?>
        <tr>
            <td class="field-label" style="width:20%;">
                基金商业计划书(BP)：
            </td>
            <td class="field-input">
                <div id="planBp" data-options="attachmentType:<?=\app\index\logic\Upload::ATTACH_FUND_PARTNER_AGREEMENT?>,
                    externalId:<?=$fundId?>,
                    uiStyle:<?=\app\index\controller\Upload::ATTACHES_UI_DATAGRID_STYLE?>,
                    prompt:'',
                    readOnly:<?=$readOnly?>,
                    fit:false"></div>
            </td>
        </tr>
        <tr>
            <td class="field-label">
                其他附件：
            </td>
            <td class="field-input">
                <div id="planOther" data-options="attachmentType:<?=\app\index\logic\Upload::ATTACH_FUND_COLLECT_PLAN_OTHER?>,
                    externalId:<?=$fundId?>,
                    uiStyle:<?=\app\index\controller\Upload::ATTACHES_UI_DATAGRID_STYLE?>,
                    prompt:'',
                    readOnly:<?=$readOnly?>"></div>
            </td>
        </tr>
    </table>
</form>
<script type="text/javascript">
    var fundsCollectPlanModule = {
        edit:function(){
            var href = '<?=$urlHrefs['fundsCollectPlan']?>';
            $('#fundsCollectPlanForm').form('submit', {
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
    //$('#planBp').attaches(<?=json_encode($planBp)?>);
    $("#planBp").attaches();
    $("#planOther").attaches();
    $.parser.onComplete = function(context){
        $('#funds-collect-plan-info-textbox').textbox('autoHeight');
        $.parser.onComplete = $.noop;
    };
</script>