<div class="form-compact-container">
    <form id="fundsCollectPlanForm" method="post" class="form-compact-body">
        <table class="table-form" cellpadding="5">
            <tr>
                <td class="field-label">
                    基金方案备注：
                </td>
                <td class="field-input">
                    <textarea id="funds-collect-plan-info-textbox" class="easyui-textbox" name="infos[plan_info]" data-options="label:'',
                    width:'100%',
                    height:'auto',
                    multiline:true,
                    disabled:<?=$readOnly?'true':'false'?>,
                    validType:['length[1,255]']" prompt="请输入基金方案相关信息"
                    ><?=$bindValues['infos']['plan_info']??''?></textarea>
                </td>
            </tr>
        </table>
    </form>
<?php if(!$readOnly){ ?>
    <div class="form-compact-toolbar">
        <a href="javascript:;" class="easyui-linkbutton" data-options="onClick:function(){ fundsCollectPlanModule.edit(); },iconCls:iconClsDefs.save">保存</a>
    </div>
<?php } ?>
</div>
<table class="table-form" cellpadding="5">
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

<script type="text/javascript">
var fundsCollectPlanModule={edit:function(){var href='<?=$urlHrefs['fundsCollectPlan']?>';$('#fundsCollectPlanForm').form('submit',{onSubmit:function(){var isValid=$(this).form('validate');if(!isValid)return false;$.messager.progress({text:'处理中，请稍候...'});$.post(href,$(this).serialize(),function(res){$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg,'info');}},'json');return false;}});}};$("#planBp").attaches();$("#planOther").attaches();$.parser.onComplete=function(context){$('#funds-collect-plan-info-textbox').textbox('autoHeight');$.parser.onComplete=$.noop;};</script>