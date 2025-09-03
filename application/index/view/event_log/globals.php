<table id="<?=DATAGRID_ID?>" class="easyui-datagrid" data-options="
    striped:true,
    rownumbers:true,
    nowrap:false,
    autoRowHeight:true,
    singleSelect:true,
    url:'<?=$_request_url?>',
    toolbar:'#<?=TOOLBAR_ID?>',
    pagination:true,
    pageSize:<?=DEFAULT_PAGE_ROWS?>,
    pageList:[10,20,30,50,80,100],
    fit:true,
    fitColumns:<?=$loginMobile?'false':'true'?>,
    onLoadSuccess:EventLogs_<?=DATAGRID_ID?>.convert,
    border:false">
    <thead>
    <tr>
        <th data-options="field:'ctime',width:140,fixed:true">时间</th>
        <th data-options="field:'realname',width:80,fixed:true">操作人</th>
        <th data-options="field:'content',width:300">事件</th>
    </tr>
    </thead>
</table>
<script>
var EventLogs_<?=DATAGRID_ID?>={datagrid:'#<?=DATAGRID_ID?>',toolbar:'#<?=TOOLBAR_ID?>',convert:function(data){var that=EventLogs_<?=DATAGRID_ID?>;$.each(data.rows,function(i,v){$(that.datagrid).datagrid('updateRow',{index:i,row:{ctime:v.ctime.substr(0,16)}});});},reload:function(){$(this.datagrid).datagrid('reload');},search:function(){var that=this,data={};var params=$(that.toolbar).children('form').serializeArray()
$.each(params,function(){data[this['name']]=this['value'];});$(that.datagrid).datagrid('load',data);},reset:function(){var that=this;$(that.toolbar).find('.easyui-textbox').textbox('clear');$(that.toolbar).find('.easyui-checkbox').checkbox('reset');$(that.datagrid).datagrid('load',{});}};</script>