<?php
use app\common\CommonDefs;
?>
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
    onDblClickRow:function(idx,row){QT.helper.view({url:'<?=url('index/enterprises/view')?>?id='+row.id,width:'100%',height:'100%',dialog:'globel-dialog-div'})},
    onLoadSuccess:EnterpriseModule.convert,
    border:false">
    <thead>
    <tr>
        <?php if(isset($_GET['dialog_call']) && $_GET['dialog_call'] && isset($_GET['multiple']) && $_GET['multiple']): ?>
        <th field="ck" checkbox="true"></th>
        <?php endif; ?>
        <?php if(!isset($_GET['dialog_call']) || !$_GET['dialog_call']): ?>
        <th data-options="field:'btns',width:150,fixed:true,align:'center'">操作</th>
        <?php endif; ?>
        <th data-options="field:'name',width:250,fixed:true,align:'center'">企业名称</th>
        <th data-options="field:'founder',width:100,fixed:true,align:'center'">创始人</th>
        <th data-options="field:'description',width:500">公司简介</th>
        <th data-options="field:'assigner',width:120,fixed:true,align:'center'">跟进人</th>
        <th data-options="field:'date_created',width:135,fixed:true,align:'center'">录入时间</th>
    </tr>
    </thead>
</table>
<div id="<?=TOOLBAR_ID?>" class="p-1">
    <form>
        企业名称<input name="search[name]" class="easyui-textbox" data-options="width:200">
        <a class="easyui-linkbutton" data-options="iconCls:'fa fa-search',onClick:function(){EnterpriseModule.search();}">搜索</a>
        <a class="easyui-linkbutton" data-options="iconCls:'fa fa-reply',onClick:function(){EnterpriseModule.reset();}">重置</a>
    </form>
</div>
<script>
var EnterpriseModule={datagrid:'#<?=DATAGRID_ID?>',toolbar:'#<?=TOOLBAR_ID?>',convert:function(data){var that=EnterpriseModule;$.each(data.rows,function(i,v){var btns=[];btns.push('<a href="javascript:void(0);" class="btn size-MINI radius" onclick="QT.helper.view({url:\'<?=url('index/enterprises/view')?>?id='+v.id+'\',width:\'100%\',height:\'100%\',dialog:\'globel-dialog-div\'})" title="查看"><i class="fa fa-eye"></i>查看</a>');btns.push('<a href="javascript:void(0);" class="btn size-MINI radius" onclick="EnterpriseModule.progress('+v.id+')" title="进展"><i class="fa fa-flag">进展</i></a>');var uids=v.assigner.split(',');var assigners=[];$.each(uids,function(_i,_uid){(_uid in data.assigners)?assigners.push(data.assigners[_uid].realname):'';});$(that.datagrid).datagrid('updateRow',{index:i,row:{name:v.alias?v.alias:v.name,founder:(v.founder in data.founders)?'<a href="javascript:void(0)" onclick="QT.helper.view({url:\'<?=url('index/contacts/view')?>?id='+data.founders[v.founder].id+'\'})">'+data.founders[v.founder].name+'</a>':'',description:'<div class="desc-limiter">'+v.description+'</div>',assigner:assigners.join(','),date_created:v.date_created.substr(0,16),btns:btns.join(' ')}});});},reload:function(){$(this.datagrid).datagrid('reload');},search:function(){var that=EnterpriseModule,data={};var params=$(that.toolbar).children('form').serializeArray()
$.each(params,function(){data[this['name']]=this['value'];});$(that.datagrid).datagrid('load',data);},reset:function(){var that=this;$(that.toolbar).find('.easyui-textbox').textbox('clear');$(that.toolbar).find('.easyui-checkbox').checkbox('reset');$(that.datagrid).datagrid('load',{});},progress:function(id){var href='<?=url('index/ProgressLogs/light', ['readOnly'=>1,'category'=>\app\index\logic\ProgressLogs::PROGRESS_LOG_INVESTED_ACTIVITY_CATEGORY])?>';href+=href.indexOf('?')==-1?'?externalId='+id:'&externalId='+id;QT.helper.view({url:href,title:'项目进展',width:'60%',height:'80%',iconCls:'fa fa-flag',dialog:'enterprise_progress_view'});}};</script>