<table id="loginLogsDatagrid" class="easyui-datagrid" data-options="striped:true,
    nowrap:false,
    rownumbers:true,
    autoRowHeight:true,
    singleSelect:true,
    url:'<?=$urlHrefs['index']?>',
    method:'post',
    toolbar:'#loginLogsToolbar',
    pagination:true,
    pageSize:<?=DEFAULT_PAGE_ROWS?>,
    pageList:[10,20,30,50,80,100],
    border:false,
    fit:true,
    fitColumns:<?=$loginMobile?'false':'true'?>,
    title:''
    ">
    <thead>
    <tr>
        <th data-options="field:'username',width:200,align:'center'">用户名</th>
        <th data-options="field:'usertype',width:100,align:'center',formatter:loginLogsModule.formatUserType">用户类型</th>
        <th data-options="field:'useragent',width:300,align:'center'">客户端</th>
        <th data-options="field:'device',width:60,align:'center',formatter:loginLogsModule.formatDevice">设备</th>
        <th data-options="field:'ip',width:100,align:'center'">IP</th>
        <th data-options="field:'time',width:200,align:'center',sortable:true">时间</th>
    </tr>
    </thead>
</table>
<div id="loginLogsToolbar" class="p-1">
    <form id="loginLogsToolbarForm">
        用户名: <input name="search[username]" class="easyui-textbox" data-options="width:160" />
        <a class="easyui-linkbutton" data-options="iconCls:'fa fa-search',
                    onClick:function(){ loginLogsModule.search(); }">搜索
        </a>
        <a class="easyui-linkbutton" data-options="iconCls:'fa fa-reply',
                    onClick:function(){ loginLogsModule.reset(); }">重置
        </a>
    </form>
</div>
<script>
var loginLogsModule={dialog:'#globel-dialog-div',datagrid:'#loginLogsDatagrid',formatUserType:function(val,row){var typeObj=<?=json_encode(\app\index\logic\LoginLogs::$loginUserTypeHtmlDefs)?>;return typeObj[val];},formatDevice:function(val,row){var deviceObj=<?=json_encode(\app\index\model\Base::$auditLogDeviceHtmlDefs)?>;return deviceObj[val];},reload:function(){$(this.datagrid).datagrid('reload');},load:function(){$(this.datagrid).datagrid('load');},search:function(){var that=this;var queryParams=$(that.datagrid).datagrid('options').queryParams;$.each($("#loginLogsToolbarForm").serializeArray(),function(){delete queryParams[this['name']];});$.each($("#loginLogsToolbarForm").serializeArray(),function(){queryParams[this['name']]=this['value'];});that.load();},reset:function(){var that=this;$("#loginLogsToolbarForm").form('reset');var queryParams=$(that.datagrid).datagrid('options').queryParams;for(var key in queryParams){delete queryParams[key];}
that.load();}};</script>