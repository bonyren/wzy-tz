<?php
use app\common\CommonDefs;
use app\index\controller\Dd;
?>
<table id="ddIndexDatagrid" class="easyui-datagrid" data-options="striped:true,
    nowrap:false,
    rownumbers:true,
    autoRowHeight:true,
    singleSelect:true,
    url:'<?=$urlHrefs['index']?>',
    method:'post',
    pagination:true,
    pageSize:<?=DEFAULT_PAGE_ROWS?>,
    pageList:[10,20,30,50,80,100],
    border:false,
    fit:true,
    fitColumns:<?=$loginMobile?'false':'true'?>,
    title:'',
    onDblClickRow:function(index, row){
    },
    onLoadSuccess:function(data){
    },
    <?php if(in_array($view, [Dd::GLOBAL_PARTNERS_VIEW, Dd::GLOBAL_ENTERPRISES_VIEW])){ ?>
    view: detailview,
    detailFormatter:ddIndexModule.detailFormatter,
    onExpandRow: function(index,row){
        ddIndexModule.expandDetailRow(index, row);
    }
    <?php } ?>
    ">
    <thead>
    <tr>
        <th data-options="field:'name',width:200,align:'center'" rowspan="2">基金名称</th>
        <th data-options="field:'company_name',width:200,align:'center'" rowspan="2">管理公司名称</th>
        <th data-options="field:'establish_date',width:100,align:'center',formatter:GLOBAL.func.dateFilter" rowspan="2">成立日期</th>
        <th data-options="field:'actual_size',width:100,align:'center',formatter:GLOBAL.func.moneyFormat" rowspan="2">认缴规模(元)</th>
        <th data-options="field:'actual_paid_size',width:100,align:'center',formatter:GLOBAL.func.moneyFormat" rowspan="2">实缴规模(元)</th>
        <th colspan="2">已投资项目</th>
    </tr>
    <tr>
        <th data-options="field:'project_count',width:100,align:'center'">数量</th>
        <th data-options="field:'project_amount',width:100,align:'center',formatter:GLOBAL.func.moneyFormat">金额</th>
    </tr>
    </thead>
</table>
<script>
    var ddIndexModule = {
        dialog:'#globel-dialog-div',
        datagrid:'#ddIndexDatagrid',
        detailFormatter:function(index, row){
            return '<div class="ddv" style="overflow:auto;"></div>';
        },
        expandDetailRow:function(index, row){
            var that = this;
            var ddv = $(that.datagrid).datagrid('getRowDetail',index).find('div.ddv');
            var href = "";
            var width = 600;
            <?php if($view == Dd::GLOBAL_PARTNERS_VIEW){ ?>
            href = '<?=url('index/Dd/partners')?>';
            <?php }else if($view == Dd::GLOBAL_ENTERPRISES_VIEW){ ?>
            href = '<?=url('index/Dd/enterprises')?>';
            width = '100%';
            <?php } ?>
            href += href.indexOf('?') != -1 ? '&fundId=' + row.fund_id : '?fundId='+row.fund_id;
            ddv.panel({
                width:width,
                height:250,
                border:false,
                cache:false,
                href:href,
                onResize:function(){
                },
                onLoad:function(){
                }
            });
            $(that.datagrid).datagrid('fixDetailRowHeight',index);
        },
    };
</script>