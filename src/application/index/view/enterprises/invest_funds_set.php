<form id="invest_funds_set_form">
    <table class="table-form" cellpadding="5">
        <?php foreach ($funds as $i=>$v): ?>
        <tr>
            <td class="form-tip" colspan="2"><?=($i+1) .'. '. $v['name']?></td>
        </tr>
        <tr>
            <td width="120" class="field-label">投资金额</td>
            <td>
                <input type="hidden" name="funds[<?=$v['fund_id']?>][fund_id]" value="<?=$v['fund_id']?>">
                <input id="fund_enterprise_amount_<?=$v['fund_id']?>_input" type="hidden" name="funds[<?=$v['fund_id']?>][ffe_id]" value="">
                <div id="fund_enterprise_amount_<?=$v['fund_id']?>"></div>
            </td>
        </tr>
        <tr>
            <td class="field-label">占股比例</td>
            <td>
                <input class="easyui-numberbox" name="funds[<?=$v['fund_id']?>][stock_ratio]"
                       suffix="%" required="true" min="0" max="100" precision="2">
            </td>
        </tr>
        <tr>
            <td class="field-label">所占注册资本</td>
            <td>
                <input class="easyui-numberbox" required="true" min="0" precision="4" groupSeparator="," name="funds[<?=$v['fund_id']?>][stock_total]">
            </td>
        </tr>
        <tr>
            <td class="field-label">交割时间</td>
            <td>
                <input class="easyui-datebox" required="true" name="funds[<?=$v['fund_id']?>][date_delivery]">
            </td>
        </tr>
        <tr>
            <td class="field-label">划款指令</td>
            <td>
                <input type="hidden" id="transfer_directive_fund_<?=$v['fund_id']?>" name="funds[<?=$v['fund_id']?>][transfer_directive]" value="">
                <div class="easyui-panel" data-options="
                    href:'<?=url('upload/attaches',['attachmentType'=>20,'externalId'=>0,'uiStyle'=>\app\index\controller\Upload::ATTACHES_UI_TABLE_STYLE])?>&callback=GLOBAL.HelperDialog.uploaded&fund_id=<?=$v['fund_id']?>',
                    border:false,
                    minimizable:false,
                    maximizable:false">
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</form>
<script type="text/javascript">
GLOBAL.HelperDialog = {
    init:function(){
        <?php foreach ($funds as $i=>$v): ?>
        $('#fund_enterprise_amount_<?=$v['fund_id']?>').fundEnterprise({
            fundId:'<?=$v['fund_id']?>',
            ffeId:0,
            enterpriseId:'<?=$enterprise_id?>',
            title:'<?=$enterprise['name']?>-投资交割',
            uniqid:md5('#fund_enterprise_amount_<?=$v['fund_id']?>')
        });
        <?php endforeach; ?>
    },
    saveAmount:function(){
        <?php foreach ($funds as $i=>$v): ?>
        var theId = '#fund_enterprise_amount_<?=$v['fund_id']?>';
        var ffiId = $(theId).fundEnterprise('save');
        $(theId+'_input').val(ffiId);
        <?php endforeach; ?>
    },
    submit:function(url,$dialog,success){
        var $form = $('#invest_funds_set_form');
        if(!$form.form('validate')){
            return false;
        }
        GLOBAL.HelperDialog.saveAmount();
        $.messager.progress({text:'处理中，请稍候...'});
        $.post(url, $form.serialize(), function(res){
                $.messager.progress('close');
                if(!res.code){
                    $.app.method.alertError(null, res.msg);
                }else{
                    $.app.method.tip('提示', res.msg, 'info');
                    $dialog.dialog('close');
                    if (success) {
                        success();
                    }
                }
            }, 'json'
        );
    },
    uploaded:function(files,queries){
        var input = $('#transfer_directive_fund_'+queries.fund_id);
        var fids = [];
        $.each(files,function(i,v){
            fids.push(v.attachment_id);
        });
        fids = fids.join(',');
        var old = input.val();
        var ids = old ? (old + ',' + fids) : fids;
        input.val(ids);
    }
}
GLOBAL.HelperDialog.init();
</script>