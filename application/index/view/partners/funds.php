<table id="partnerFundsDatagrid" class="easyui-datagrid" data-options="striped:true,
    nowrap:false,
    rownumbers:true,
    autoRowHeight:true,
    singleSelect:true,
    url:'<?=$urlHrefs['funds']?>',
    method:'post',
    toolbar:'#partnerFundsToolbar',
    pagination:false,
    border:false,
    fit:true,
    fitColumns:<?=$loginMobile?'false':'true'?>,
    title:'',
    onDblClickRow:function(index, row){
        //partnerFundsModule.view(row.project_id);
    },
    view: detailview,
    onLoadSuccess:function(data){
        //partnerFundsModule.expandAll();
    },
    detailFormatter:function(index,row){
        return partnerFundsModule.detailFormatter();
    },
    onExpandRow:function(index,row){
        var ddv = $(this).datagrid('getRowDetail',index).find('div.ddv');
        var href = '<?=$urlHrefs['fundEnterprises']?>';
        var fundId = row.fund_id;
        href += href.indexOf('?') != -1 ? '&fundId=' + fundId : '?fundId='+fundId;
        ddv.panel({
            height:200,
            border:false,
            cache:false,
            href:href,
            onLoad:function(){
                $('#partnerFundsDatagrid').datagrid('fixDetailRowHeight',index);
            }
        });
        $('#partnerFundsDatagrid').datagrid('fixDetailRowHeight',index);
    }
    ">
    <thead>
    <tr>
        <th data-options="field:'name',width:200,align:'center'">基金名称</th>
        <th data-options="field:'size',width:100,align:'center'">基金规模(元)</th>
        <th data-options="field:'amount',width:100,align:'center'">认投金额(元)</th>
        <th data-options="field:'share_proportion',width:100,align:'center'">占股比例</th>
        <th data-options="field:'actual_amount',width:100,align:'center'">实投金额(元)</th>
    </tr>
    </thead>
</table>
<div id="partnerFundsToolbar" class="p-1">
</div>
<script>
var partnerFundsModule={dialog:'#globel-dialog-div',dialog2:'#globel-dialog2-div',datagrid:'#partnerFundsDatagrid',reload:function(){$(this.datagrid).datagrid('reload');},load:function(){$(this.datagrid).datagrid('load');},reset:function(){var that=this;var queryParams=$(that.datagrid).datagrid('options').queryParams;for(var key in queryParams){delete queryParams[key];}
that.load();},detailFormatter:function(){return'<div class="ddv" style="padding:5px 0"></div>';},expandAll:function(){var that=this;var rows=$(that.datagrid).datagrid('getRows');for(var i=0,count=rows.length;i<count;i++){var row=rows[i];var index=$(that.datagrid).datagrid('getRowIndex',row);$(that.datagrid).datagrid('expandRow',index);}}};</script>