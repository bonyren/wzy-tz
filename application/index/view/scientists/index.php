<?php
use app\common\CommonDefs;
use app\index\logic\ProgressLogs;
?>
<table id="scientistsDatagrid" class="easyui-datagrid" data-options="striped:true,
    nowrap:false,
    rownumbers:true,
    autoRowHeight:true,
    singleSelect:true,
    url:'<?=url('index/Scientists/index')?>',
    method:'post',
    toolbar:'#scientistsToolbar',
    pagination:true,
    pageSize:<?=DEFAULT_PAGE_ROWS?>,
    pageList:[10,20,30,50,80,100],
    border:false,
    fit:true,
    fitColumns:<?=$loginMobile?'false':'true'?>,
    title:'',
    onDblClickRow:function(index, row){
        scientistsModule.view(row.id, GLOBAL.func.htmlEncode(row.name));
    },
    onLoadSuccess:function(data){
        $.each(data.rows, function(i, row){
        });
    }
    ">
    <thead>
    <tr>
        <?php if(empty($_GET['dialog_call'])): ?>
        <th data-options="field:'operate',width:250,fixed:true,formatter:scientistsModule.operate,align:'center'">操作</th>
        <?php endif; ?>
<!--        <th data-options="field:'id',width:100,align:'center'">ID</th>-->
        <th data-options="field:'name',width:150,align:'center'">姓名</th>
        <th data-options="field:'field_text',width:200,align:'center'">领域</th>
        <th data-options="field:'place',width:200,align:'center'">工作场所</th>
        <th data-options="field:'assigner',width:200,align:'center'">跟进人</th>
        <th data-options="field:'entered',width:200,align:'center'">录入时间</th>
    </tr>
    </thead>
</table>
<div id="scientistsToolbar" class="p-1">
    <?php if(empty($_GET['dialog_call'])): ?>
    <div>
        <a href="javascript:;" class="easyui-linkbutton" data-options="onClick:function(){ scientistsModule.save(); },iconCls:iconClsDefs.add">新增</a>
    </div>
    <div class="line my-1"></div>
    <?php endif; ?>
    <form id="scientistsToolbarForm">
        姓名: <input name="search[name]" class="easyui-textbox"
                   data-options="width:160" />
        <a class="easyui-linkbutton" data-options="iconCls:'fa fa-search',
                    onClick:function(){ scientistsModule.search(); }">搜索
        </a>
        <a class="easyui-linkbutton" data-options="iconCls:'fa fa-reply',
                    onClick:function(){ scientistsModule.reset(); }">重置
        </a>
    </form>
</div>
<script>
var scientistsModule={dialog:'#globel-dialog-div',datagrid:'#scientistsDatagrid',searchForm:'#scientistsToolbarForm',operate:function(val,row){var btns=[];btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="scientistsModule.view('+row.id+',\''+HtmlUtil.htmlEncode(row.name)+'\')" title="查看"><i class="fa fa-eye">查看</i></a>');<?php  if($loginUserMenuPriv==CommonDefs::AUTHORIZE_READ_WRITE_TYPE){?>btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="scientistsModule.save('+row.id+',\''+HtmlUtil.htmlEncode(row.name)+'\')" title="编辑"><i class="fa fa-pencil-square-o">编辑</i></a>');btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="scientistsModule.requirements('+row.id+',\''+HtmlUtil.htmlEncode(row.name)+'\')" title="需求"><i class="fa fa-diamond">需求</i></a>');btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="scientistsModule.events('+row.id+',\''+HtmlUtil.htmlEncode(row.name)+'\')" title="事件"><i class="fa fa-th-list">事件</i></a>');btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="scientistsModule.delete('+row.id+',\''+HtmlUtil.htmlEncode(row.name)+'\')" title="删除"><i class="fa fa-trash-o">删除</i></a>');<?php }?>return btns.join(' ');},reload:function(){$(this.datagrid).datagrid('reload');},search:function(){var that=this;var paramObj={};$.each($(that.searchForm).serializeArray(),function(){paramObj[this['name']]=this['value'];});$(that.datagrid).datagrid('load',paramObj);},reset:function(){var that=this;$(that.searchForm).form('reset');$(that.datagrid).datagrid('load',{});},save:function(id,title){var that=this;var href='<?=url('index/Scientists/save')?>';if(id){href=GLOBAL.func.addUrlParam(href,'id',id);var title=title+' - 科学家编辑';}else{var title='新增科学家';}
$(that.dialog).dialog({title:title,iconCls:id?'fa fa-pencil-square':'fa fa-plus-circle',width:<?=$loginMobile?"'90%'":"800"?>,height:'95%',cache:false,href:href,modal:true,collapsible:false,minimizable:false,resizable:false,maximizable:true,buttons:[{text:'保存',iconCls:iconClsDefs.ok,handler:function(){var $form=$('#scientist-save-form');var isValid=$form.form('validate');if(!isValid)return;$.messager.progress({text:'处理中，请稍候...'});$.post(href,$form.serialize(),function(res){$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg,'info');$(that.dialog).dialog('close');that.reload();}},'json');}},{text:'取消',iconCls:iconClsDefs.cancel,handler:function(){$(that.dialog).dialog('close');}}]});$(that.dialog).dialog('center');},requirements:function(id,title){var that=this;var href='<?=url('index/Scientists/requirements')?>';href=GLOBAL.func.addUrlParam(href,'scientistId',id);var title=title+' - 科学家需求';$(that.dialog).dialog({title:title,iconCls:'fa fa-diamond',width:<?=$loginMobile?"'90%'":"800"?>,height:'95%',cache:false,href:href,modal:true,collapsible:false,minimizable:false,resizable:false,maximizable:true,buttons:[{text:'关闭',iconCls:iconClsDefs.cancel,handler:function(){$(that.dialog).dialog('close');}}]});$(that.dialog).dialog('center');},events:function(id,title){var that=this;var href='<?=url('index/ProgressLogs/light', ['category'=>ProgressLogs::PROGRESS_LOG_SCIENTIST_CATEGORY])?>';href=GLOBAL.func.addUrlParam(href,'externalId',id);var title=title+' - 科学家事件';$(that.dialog).dialog({title:title,iconCls:'fa fa-diamond',width:<?=$loginMobile?"'90%'":"800"?>,height:'95%',cache:false,href:href,modal:true,collapsible:false,minimizable:false,resizable:false,maximizable:true,buttons:[{text:'关闭',iconCls:iconClsDefs.cancel,handler:function(){$(that.dialog).dialog('close');}}]});$(that.dialog).dialog('center');},delete:function(id,title){var that=this;var href='<?=url('index/Scientists/delete')?>';href=GLOBAL.func.addUrlParam(href,'id',id);$.messager.confirm('提示','确认删除['+title+']吗?',function(result){if(!result)return false;$.messager.progress({text:'处理中，请稍候...'});$.post(href,{},function(res){$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg,'info');that.reload();}},'json');});},view:function(id,title){var that=this;var href='<?=url('index/Scientists/view')?>';href+=href.indexOf('?')!=-1?'&id='+id:'?id='+id;$(that.dialog).dialog({title:title+' - 科学家查看',iconCls:'fa fa-eye',width:<?=$loginMobile?"'90%'":"800"?>,height:'95%',cache:false,href:href,modal:true,collapsible:false,minimizable:false,resizable:false,maximizable:true,buttons:[{text:'关闭',iconCls:iconClsDefs.cancel,handler:function(){$(that.dialog).dialog('close');}}]});$(that.dialog).dialog('center');}};</script>