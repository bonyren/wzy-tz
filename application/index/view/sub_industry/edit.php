<div class="easyui-layout" fit="true" border="false">
    <div data-options="region:'north',collapsible:false,border:false" style="height:120px">
        <form method="post" style="height:100%">
            <table class="table-form" cellpadding="5">
                <tr>
                    <td width="120" class="field-label">行业名称</td>
                    <td>
                        <input class="easyui-textbox" required="true" name="data[name]" value="<?=$row['name']?>" style="width:95%;">
                    </td>
                </tr>
                <tr>
                    <td class="field-label">行业描述</td>
                    <td>
                        <input id="D<?=UNIQID?>" class="easyui-textbox" width="100%" height="auto" multiline="true" name="data[description]"
                               data-options="value:'<?=convertLineBreakToEscapeChars($row['description'])?>'"
                               style="width:95%;height:85px;">
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <div data-options="region:'center',border:false">
        <div class="easyui-tabs" data-options="fit:true">
            <div title="产业链" data-options="
                href:'<?=url('index/SubIndustry/chain',['subIndustryId'=>$row['id']])?>',
                iconCls:'fa fa-chain',
                border:false"></div>
            <div title="关联项目" data-options="
                href:'<?=url('index/SubIndustry/enterprises',['iid'=>$row['id']])?>',
                iconCls:'fa fa-file-text',
                border:false"></div>
            <div title="行业研究" data-options="
                href:'<?=url('ProgressLogs/light',['category'=>\app\index\logic\ProgressLogs::PROGRESS_LOG_SUB_INDUSTRY,'externalId'=>$row['id']])?>',
                iconCls:'fa fa-file-text',
                border:false"></div>
    </div>
</div>

<script type="text/javascript">
$.parser.onComplete=function(context){if($("#D<?=UNIQID?>").length){$("#D<?=UNIQID?>").textbox('autoHeight');}
$.parser.onComplete=$.noop;};</script>