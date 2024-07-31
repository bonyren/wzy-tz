<?php
use app\index\controller\Upload;
?>
<table id="<?=DATAGRID_ID?>" class="easyui-datagrid" data-options="
    striped:true,
    nowrap:false,
    rownumbers:true,
    autoRowHeight:true,
    singleSelect:true,
    url:'<?=$_request_url?>',
    toolbar:'#<?=TOOLBAR_ID?>',
    fit:true,
    fitColumns:<?=$loginMobile?'false':'true'?>,
    onLoadSuccess:<?=JVAR?>.convert,
    border:false">
    <thead>
    <tr>
        <?php if (!$readonly): ?>
        <th data-options="field:'btns',width:70">操作</th>
        <?php endif; ?>
        <th data-options="field:'name',width:250">基金名称</th>
        <th data-options="field:'amount',width:100">投资金额</th>
        <th data-options="field:'stock_ratio',width:100">占股比例</th>
        <th data-options="field:'stock_total',width:100">所占注册资本</th>
        <th data-options="field:'date_delivery',width:100">交割时间</th>
        <th data-options="field:'files',width:250">划款指令</th>
    </tr>
    </thead>
</table>
<?php if (!$readonly): ?>
    <div id="<?=TOOLBAR_ID?>" class="p-1" style="background:#fff">
        <?php echo \app\index\service\View::selector([
            'multiple'=>true,
            'value_field'=>'fund_id',
            'url' => url('funds/funds'),
            'type' => 'callback',
            'btn_text' => '新增交割',
            'callback' => JVAR.'.setFunds'
        ]); ?>
    </div>
<?php endif; ?>
<script>
var <?=JVAR?> = {
    datagrid:'#<?=DATAGRID_ID?>',
    convert:function(data){
        var that = <?=JVAR?>;
        data.rows.forEach(function(v,i){
            var btns = [];
            btns.push('<a href="javascript:void(0);" class="btn btn-outline-info size-MINI radius my-1" onclick="<?=JVAR?>.edit(' + v.id + ')" title="编辑"><i class="fa fa-pencil-square-o fa-lg"></i></a>');
            btns.push('<a href="javascript:void(0);" class="btn btn-outline-info size-MINI radius my-1" onclick="<?=JVAR?>.remove(' + v.id + ')" title="删除"><i class="fa fa-trash-o fa-lg"></i></a>');
            $.get('<?=url('upload/viewAttaches')?>',{attachmentType:20,uiStyle:<?=Upload::ATTACHES_UI_LINK_STYLE?>,externalId:v.enterprise_id,externalId2:v.id},function(res){
                $(that.datagrid).datagrid('updateRow',{
                    index: i,
                    row: {
                        stock_ratio:v.stock_ratio + '%',
                        files:res,
                        btns:btns.join(' ')
                    }
                });
            })
        });
    },
    setFunds:function(funds_id){
        var that = <?=JVAR?>;
        var href = '<?=url('Enterprises/investFundsSet')?>?enterprise_id=<?=$enterprise_id?>&investment_id=<?=$investment_id?>&funds_id='+funds_id;
        QT.helper.dialog('交割基金设置',href,true,function($dialog){
            $(that.datagrid).datagrid('reload');
        },800,"80%",'invest_funds_set');
    },
    edit:function(id){
        var that = this;
        var href = '<?=url('enterprises/investFundEdit')?>?id='+id;
        QT.helper.dialog('编辑基金',href,true,function($dialog){
            var $form = $dialog.find('form');
            if(!$form.form('validate')){
                return false;
            }
            $.messager.progress({text:'处理中，请稍候...'});
            InvestFundEdit.saveAmount();
            $.post(href, $form.serialize(), function(res){
                    $.messager.progress('close');
                    if(!res.code){
                        $.app.method.alertError(null, res.msg);
                    }else{
                        $.app.method.tip('提示', res.msg);
                        $dialog.dialog('close');
                        $(that.datagrid).datagrid('reload');
                    }
                }, 'json'
            );
        },800,"80%",'invest_fund_edit');
    },
    remove:function(id){
        var that = this;
        $.messager.confirm('提示', '确认删除吗?', function(result){
            if(!result) return false;
            $.messager.progress({text:'处理中，请稍候...'});
            $.post('<?=url('enterprises/investFundRemove')?>', {id:id}, function(res){
                $.messager.progress('close');
                if(!res.code){
                    $.app.method.alertError(null, res.msg);
                }else{
                    $.app.method.tip('提示', res.msg, 'info');
                    $(that.datagrid).datagrid('reload');
                }
            }, 'json');
        });
    }
}
</script>
