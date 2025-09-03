<table id="auditLogsDatagrid" class="easyui-datagrid" data-options="striped:true,
    nowrap:false,
    rownumbers:true,
    autoRowHeight:true,
    singleSelect:true,
    selectOnCheck:false,
    checkOnSelect:false,
    url:'<?=$urlHrefs['index']?>',
    method:'post',
    toolbar:'#auditLogsToolbar',
    pagination:true,
    pageSize:<?=DEFAULT_PAGE_ROWS?>,
    pageList:[10,20,30,50,80,100],
    border:false,
    fit:true,
    fitColumns:<?=$loginMobile?'false':'true'?>,
    title:''">
    <thead>
    <tr>
        <th data-options="field:'type',width:80,align:'center',formatter:auditLogsModule.formatType">类型</th>
        <th data-options="field:'changed_date',width:100,fixed:true,align:'center'">时间</th>
        <th data-options="field:'desc',width:600,align:'left'">描述</th>
        <th data-options="field:'realname',width:100,align:'center'">操作人</th>
        <th data-options="field:'device',width:60,align:'center',formatter:auditLogsModule.formatDevice">设备</th>
        <th data-options="field:'ip',width:100,align:'center'">Ip</th>
    </tr>
    </thead>
</table>
<div id="auditLogsToolbar">
</div>
<script>
var auditLogsModule={dialog:'#globel-dialog-div',datagrid:'#auditLogsDatagrid',formatType:function(val,row){var typeObj=<?=json_encode(\app\index\model\Base::$auditLogTypeHtmlDefs)?>;return typeObj[val];},formatDevice:function(val,row){var deviceObj=<?=json_encode(\app\index\model\Base::$auditLogDeviceHtmlDefs)?>;return deviceObj[val];},reload:function(){$(this.datagrid).datagrid('reload');},load:function(){$(this.datagrid).datagrid('load');},reset:function(){var that=this;var queryParams=$(that.datagrid).datagrid('options').queryParams;for(var key in queryParams){delete queryParams[key];}
that.load();}};</script>