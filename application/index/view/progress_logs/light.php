<?php
use app\common\CommonDefs;
use app\index\logic\ProgressLogs as ProgressLogsLogic;
?>
<table id="progressLogsDatagrid_<?=$uniqid?>" class="easyui-datagrid" data-options="striped:true,
            nowrap:false,
            rownumbers:true,
            singleSelect:true,
            url:'<?=$urlHrefs['index']?>',
            toolbar:'#progressLogsToolbar_<?=$uniqid?>',
            pagination:true,
            pageSize:<?=DEFAULT_PAGE_ROWS?>,
            fit:true,
            fitColumns:<?=$loginMobile?'false':'true'?>,
            onDblClickRow:function(idx,row){progressLogsModule_<?=$uniqid?>.view(row.progress_log_id)},
            onLoadSuccess:progressLogsModule_<?=$uniqid?>.onLoaded,
            border:false">
    <thead>
    <tr>
        <?php if(!$readOnly){ ?>
        <th data-options="field:'operate',width:80,fixed:true,align:'center',formatter:progressLogsModule_<?=$uniqid?>.operate">操作</th>
        <?php } ?>
        <th data-options="field:'occur_date',width:90,align:'center'">发生日期</th>
        <th data-options="field:'title',width:200">标题</th>
        <?php if ($src == CommonDefs::MODULE_ADMIN && $category == ProgressLogsLogic::PROGRESS_LOG_FUND_MANAGE_CATEGORY): ?>
        <th data-options="field:'show_timeline',width:100,align:'center',formatter:progressLogsModule_<?=$uniqid?>.formatShowTimeline">时间轴</th>
        <?php endif; ?>
<!--        <th data-options="field:'files',width:300">附件</th>-->
        <th data-options="field:'summary',width:400">内容</th>
        <th data-options="field:'realname',width:150,align:'center'">提交人</th>
    </tr>
    </thead>
</table>
<div id="progressLogsToolbar_<?=$uniqid?>" class="p-1">
    <?php if(!$readOnly){ ?>
        <div>
            <a href="javascript:void(0)" class="easyui-linkbutton" data-options="onClick:function(){ progressLogsModule_<?=$uniqid?>.add(); },iconCls:iconClsDefs.add">添加</a>
        </div>
        <div class="line my-1"></div>
    <?php } ?>
    <form id="progressLogsToolbarForm_<?=$uniqid?>">
        时间: <input class="easyui-datebox" name="search[entered]" type="text" data-options="width:120" />
        <a class="easyui-linkbutton" data-options="iconCls:'fa fa-search',
                    onClick:function(){ progressLogsModule_<?=$uniqid?>.search(); }">搜索
        </a>
        <a class="easyui-linkbutton" data-options="iconCls:'fa fa-reply',
                    onClick:function(){ progressLogsModule_<?=$uniqid?>.reset(); }">重置
        </a>
    </form>
</div>
<script type="text/javascript">
var progressLogsModule_<?=$uniqid?>={dialog:'#globel-dialog2-div',datagrid:'#progressLogsDatagrid_<?=$uniqid?>',operate:function(val,row){var btns=[];btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="progressLogsModule_<?=$uniqid?>.edit('+row.progress_log_id+')" title="编辑"><i class="fa fa-pencil-square-o fa-lg"></i></a>');btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="progressLogsModule_<?=$uniqid?>.del('+row.progress_log_id+')" title="删除"><i class="fa fa-trash-o fa-lg"></i></a>');return btns.join(' ');},formatShowTimeline:function(val,row){if(val==1){return'<span class="fa fa-check"></span>';}else{return'';}},onLoaded:function(data){var that=progressLogsModule_<?=$uniqid?>;data.rows.forEach(function(v,i){$(that.datagrid).datagrid('updateRow',{index:i,row:{title:'<a href="javascript:void(0)" onclick="progressLogsModule_<?=$uniqid?>.view('+v.progress_log_id+')">'+v.title+'</a>',summary:'<div class="desc-limiter">'+v.entry+'</div>'}});})},reload:function(){$(this.datagrid).datagrid('reload');},load:function(){$(this.datagrid).datagrid('load');},search:function(){var that=this;var queryParams=$(that.datagrid).datagrid('options').queryParams;$.each($("#progressLogsToolbarForm_<?=$uniqid?>").serializeArray(),function(){delete queryParams[this['name']];});$.each($("#progressLogsToolbarForm_<?=$uniqid?>").serializeArray(),function(){queryParams[this['name']]=this['value'];});that.load();},reset:function(){var that=this;$("#progressLogsToolbarForm_<?=$uniqid?>").form('reset');var queryParams=$(that.datagrid).datagrid('options').queryParams;for(var key in queryParams){delete queryParams[key];}
that.load();},add:function(){var that=this;var href='<?=$urlHrefs['add']?>';QT.helper.dialog('添加',href,true,function($dialog){var $form=$dialog.find('form:eq(0)');if(!$form.form('validate')){return false;}
$.messager.progress({text:'处理中，请稍候...'});$.post(href,$form.serialize(),function(res){$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg);$dialog.dialog('close');that.reload();}},'json');},<?=$loginMobile?"'90%'":800?>,450,'progress_log_edit_dialog');},edit:function(id){var that=this;var href='<?=url('ProgressLogs/edit')?>?src=<?=$src?>&id='+id;QT.helper.dialog('修改',href,true,function($dialog){var $form=$dialog.find('form:eq(0)');if(!$form.form('validate')){return false;}
$.messager.progress({text:'处理中，请稍候...'});$.post(href,$form.serialize(),function(res){$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg);$dialog.dialog('close');that.reload();}},'json');},<?=$loginMobile?"'90%'":800?>,450,'progress_log_edit_dialog');},del:function(progressLogId){var that=this;var href='<?=$urlHrefs['delete']?>';href+=href.indexOf('?')!=-1?'&progressLogId='+progressLogId:'?progressLogId='+progressLogId;$.messager.confirm('提示','确认删除吗?',function(result){if(!result)return false;$.messager.progress({text:'处理中，请稍候...'});$.post(href,{},function(res){$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg,'info');that.reload();}},'json');});},view:function(id){QT.helper.view({url:'<?=url('ProgressLogs/view')?>?id='+id,width:<?=$loginMobile?"'90%'":800?>,height:'95%',dialog:'progress_log_view_dialog'});}};</script>