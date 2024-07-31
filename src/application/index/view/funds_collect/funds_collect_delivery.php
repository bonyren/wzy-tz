<form id="fundsCollectDeliveryForm" method="post">
    <table class="table-form">
        <tr>
            <td class="field-label" style="width: 150px;">
                交割日期：
            </td>
            <td class="field-input">
                <input class="easyui-datebox" name="infos[delivery_date]" data-options="label:'',required:true,width:150,disabled:<?=$readOnly?'true':'false'?>"
                       value="<?=dateFilter($bindValues['infos']['delivery_date'])?>"/>
            </td>
        </tr>
        <?php if(!$readOnly){ ?>
            <tr class="form-tools">
                <td colspan="2" align="center">
                    <a href="#" class="easyui-linkbutton" data-options="onClick:function(){ fundsCollectDeliveryModule.edit(); },iconCls:'fa fa-save'">保存</a>
                </td>
            </tr>
        <?php } ?>
        <tr>
            <td class="field-label" style="width:20%;">交割文件:</td>
            <td class="field-input">
                <div id="deliveryAttachments"></div>
            </td>
        </tr>
    </table>
</form>
<script type="text/javascript">
    var fundsCollectDeliveryModule = {
        edit:function(){
            var href = '<?=$urlHrefs['fundsCollectDelivery']?>';
            $('#fundsCollectDeliveryForm').form('submit', {
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
    $('#deliveryAttachments').attaches({
        attachmentType:<?=\app\index\logic\Upload::ATTACH_FUND_COLLECT_DELIVERY?>,
        externalId:<?=$externalId?>,
        uiStyle:<?=\app\index\controller\Upload::ATTACHES_UI_DATAGRID_STYLE?>,
        readOnly:<?=$readOnly?'true':'false'?>
    });
    $.parser.onComplete = function(context) {
        $.parser.onComplete = $.noop;
    };
</script>