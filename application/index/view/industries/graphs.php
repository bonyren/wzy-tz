<table id="<?=DATAGRID_ID?>" class="easyui-datagrid" data-options="striped:true,
    nowrap:false,
    rownumbers:true,
    autoRowHeight:true,
    singleSelect:true,
    url:'<?=url('industries/graphs')?>',
    toolbar:'#<?=TOOLBAR_ID?>',
    pagination:true,
    pageSize:<?=DEFAULT_PAGE_ROWS?>,
    fit:true,
    fitColumns:<?=$loginMobile?'false':'true'?>,
    onLoadSuccess:<?=JVAR?>.convert,
    onDblClickRow:<?=JVAR?>.view,
    border:false">
    <thead>
    <tr>
        <th data-options="field:'btns',width:100,align:'center'">操作</th>
        <th data-options="field:'name',width:200,align:'center'">标题</th>
        <th data-options="field:'date_entered',width:200,align:'center'">创建时间</th>
    </tr>
    </thead>
</table>
<div id="<?=TOOLBAR_ID?>" class="p-1">
    <div>
        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="onClick:function(){ <?=JVAR?>.edit(0); },iconCls:'fa fa-plus'">添加图谱</a>
    </div>
</div>
<script>
var <?=JVAR?>={datagrid:'#<?=DATAGRID_ID?>',form:'#industriesToolbarForm',convert:function(data){var that=<?=JVAR?>;$.each(data.rows,function(i,v){var btns=[];btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="<?=JVAR?>.edit('+v.id+')" title="编辑"><i class="fa fa-pencil-square-o fa-lg"></i></a>');btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="<?=JVAR?>.remove('+v.id+')" title="删除"><i class="fa fa-trash-o fa-lg"></i></a>');$(that.datagrid).datagrid('updateRow',{index:i,row:{btns:btns.join(' | ')}});});},reload:function(){$(this.datagrid).datagrid('reload');},search:function(){var that=this;var queryParams=$(that.datagrid).datagrid('options').queryParams;$.each($(that.form).serializeArray(),function(){delete queryParams[this['name']];});$.each($(that.form).serializeArray(),function(){queryParams[this['name']]=this['value'];});that.load();},reset:function(){var that=this;var queryParams=$(that.datagrid).datagrid('options').queryParams;for(var key in queryParams){delete queryParams[key];}
$(that.form).form('reset');that.load();},view:function(idx,row){var url='<?=url('industries/viewGraph')?>?id='+row.id;QT.helper.view({url:url,});},edit:function(id){var that=this;var href='<?=url('industries/editGraph')?>?id='+(id?id:'');var $dialog=QT.helper.genDialogId('industries');$dialog.dialog({title:(id?'编辑':'添加')+'行业图谱',iconCls:'fa fa-pencil-square',width:<?=$loginMobile?"'90%'":800?>,height:'95%',border:false,href:href,modal:true,buttons:[{text:'确定',iconCls:iconClsDefs.ok,handler:function(){$dialog.find('form').eq(0).form('submit',{url:href,iframe:false,onSubmit:function(){var isValid=$(this).form('validate');if(!isValid)return false;$.messager.progress({text:'处理中，请稍候...'});return true;},success:function(data){var res=eval('('+data+')');$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg);$dialog.dialog('close');that.reload();}}});}},{text:'取消',iconCls:iconClsDefs.cancel,handler:function(){$dialog.dialog('close');}}]});$dialog.dialog('center');},remove:function(id){var that=this;$.messager.confirm('提示','确认删除吗?',function(result){if(!result)return false;$.messager.progress({text:'处理中，请稍候...'});$.post('<?=url('industries/deleteGraph')?>',{id:id},function(res){$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg,'info');that.reload();}},'json');});}};</script>