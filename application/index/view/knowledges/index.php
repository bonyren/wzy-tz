<?php
use app\common\CommonDefs;
?>
<table id="<?=DATAGRID_ID?>" class="easyui-datagrid" data-options="striped:true,
    nowrap:false,
    rownumbers:true,
    autoRowHeight:true,
    singleSelect:true,
    url:'<?=$urls['list']?>',
    toolbar:'#<?=TOOLBAR_ID?>',
    pagination:true,
    pageSize:<?=DEFAULT_PAGE_ROWS?>,
    pageList:[10,20,30,50,80,100],
    fit:true,
    fitColumns:<?=$loginMobile?'false':'true'?>,
    onLoadSuccess:<?=JVAR?>.convert,
    border:false">
    <thead>
    <tr>
        <th data-options="field:'btns',width:120,fixed:true">操作</th>
        <th data-options="field:'name',width:200,fixed:true">智库名称</th>
        <th data-options="field:'description',width:400">描述</th>
    </tr>
    </thead>
</table>
<div id="<?=TOOLBAR_ID?>" class="p-1">
    <div>
        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="onClick:function(){ <?=JVAR?>.edit(0); },iconCls:'fa fa-plus'">新增智库</a>
    </div>
    <div class="line my-1"></div>
    <form id="knowledgesToolbarForm">
        智库名称: <input name="search[name]" class="easyui-textbox" data-options="width:160" />
        <a class="easyui-linkbutton" data-options="iconCls:'fa fa-search',
                    onClick:function(){ <?=JVAR?>.search(); }">搜索
        </a>
        <a class="easyui-linkbutton" data-options="iconCls:'fa fa-reply',
                    onClick:function(){ <?=JVAR?>.reset(); }">重置
        </a>
    </form>
</div>
<script>
var <?=JVAR?>={datagrid:'#<?=DATAGRID_ID?>',form:'#knowledgesToolbarForm',convert:function(data){var that=<?=JVAR?>;$.each(data.rows,function(i,v){var btns=[];btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="<?=JVAR?>.edit('+v.id+')" title="编辑"><i class="fa fa-pencil-square-o">编辑</i></a>');btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="<?=JVAR?>.remove('+v.id+')" title="删除"><i class="fa fa-trash-o">删除</i></a>');$(that.datagrid).datagrid('updateRow',{index:i,row:{name:'<button type="button" class="btn btn-link" onclick="<?=JVAR?>.edit('+v.id+')">'+v.name+'</button>',btns:btns.join(' | ')}});});},reload:function(){$(this.datagrid).datagrid('reload');},load:function(){$(this.datagrid).datagrid('load');},search:function(){var that=this;var queryParams=$(that.datagrid).datagrid('options').queryParams;$.each($(that.form).serializeArray(),function(){delete queryParams[this['name']];});$.each($(that.form).serializeArray(),function(){queryParams[this['name']]=this['value'];});that.load();},reset:function(){var that=this;var queryParams=$(that.datagrid).datagrid('options').queryParams;for(var key in queryParams){delete queryParams[key];}
$(that.form).form('reset');that.load();},edit:function(id){var that=this;var href='<?=$urls['edit']?>?id='+(id?id:'');var $dialog=QT.helper.genDialogId('knowledges');$dialog.dialog({title:id?'编辑':'添加',iconCls:'fa fa-pencil-square',width:<?=$loginMobile?"'90%'":800?>,height:'95%',border:false,href:href,modal:true,buttons:[{text:'确定',iconCls:iconClsDefs.ok,handler:function(){$dialog.find('form').eq(0).form('submit',{url:href,iframe:false,onSubmit:function(){var isValid=$(this).form('validate');if(!isValid)return false;$.messager.progress({text:'处理中，请稍候...'});return true;},success:function(data){var res=eval('('+data+')');$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg);$dialog.dialog('close');that.reload();}}});}},{text:'取消',iconCls:iconClsDefs.cancel,handler:function(){$dialog.dialog('close');}}]});$dialog.dialog('center');},remove:function(id){var that=this;$.messager.confirm('提示','确认删除吗?',function(result){if(!result)return false;$.messager.progress({text:'处理中，请稍候...'});$.post('<?=$urls['delete']?>',{id:id},function(res){$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg,'info');that.reload();}},'json');});}};</script>