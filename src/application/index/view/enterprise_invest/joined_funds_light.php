<table id="<?=DATAGRID_ID?>" class="easyui-datagrid" data-options="
    striped:true,
    nowrap:false,
    rownumbers:true,
    autoRowHeight:true,
    singleSelect:true,
    url:'<?=$_request_url?>',
    fit:true,
    fitColumns:<?=$loginMobile?'false':'true'?>,
    onLoadSuccess:<?=JVAR?>.convert,
    border:false">
    <thead>
    <tr>
        <th data-options="field:'name',width:250">基金名称</th>
        <th data-options="field:'amount',width:100">投资金额</th>
        <th data-options="field:'stock_ratio',width:100">占股比例</th>
        <th data-options="field:'stock_total',width:100">所占注册资本</th>
    </tr>
    </thead>
</table>
<script>
var <?=JVAR?> = {
    datagrid:'#<?=DATAGRID_ID?>',
    convert:function(data){
        var that = <?=JVAR?>;
        data.rows.forEach(function(v,i){
            $(that.datagrid).datagrid('updateRow',{
                index: i,
                row: {
                    stock_ratio:v.stock_ratio + '%',
                }
            });
        });
    }
}
</script>
