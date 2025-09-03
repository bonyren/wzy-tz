<table id="investProjectsDatagrid" class="easyui-datagrid" data-options="striped:true,
    nowrap:false,
    rownumbers:true,
    autoRowHeight:true,
    singleSelect:true,
    url:'<?=$urlHrefs['fundsInvestProjects']?>',
    method:'post',
    toolbar:'#investProjectsToolbar',
    pagination:false,
    border:false,
    fit:true,
    fitColumns:<?=$loginMobile?'false':'true'?>,
    title:'',
    onDblClickRow:function(index, row){
        //investProjectsModule.view(row.project_id);
    }
    ">
    <thead>
    <tr>
        <th data-options="field:'name',width:200,align:'center'">项目名称</th>
        <th data-options="field:'amount',width:100,align:'center'">投资金额(元)</th>
        <th data-options="field:'date',width:100,align:'center'">投资日期</th>
        <th data-options="field:'stock_ratio',width:100,align:'center'">占股比例(%)</th>
        <th data-options="field:'stock_total',width:100,align:'center'">所占注册资本</th>
    </tr>
    </thead>
</table>
<div id="investProjectsToolbar" class="p-1">
</div>
<script>
var investProjectsModule={dialog:'#globel-dialog-div',dialog2:'#globel-dialog2-div',datagrid:'#investProjectsDatagrid',reload:function(){$(this.datagrid).datagrid('reload');},load:function(){$(this.datagrid).datagrid('load');},reset:function(){var that=this;var queryParams=$(that.datagrid).datagrid('options').queryParams;for(var key in queryParams){delete queryParams[key];}
that.load();},add:function(){var that=this;alert('add');},delete:function(projectId){var that=this;alert('delete');},view:function(projectId){var that=this;alert('view');}};</script>