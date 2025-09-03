<table id="partnersDatagrid" class="easyui-datagrid" data-options="striped:true,
    nowrap:false,
    rownumbers:true,
    autoRowHeight:true,
    singleSelect:true,
    url:'<?=$urlHrefs['partners']?>',
    method:'post',
    toolbar:'#partnersToolbar',
    pagination:true,
    pageSize:<?=DEFAULT_PAGE_ROWS?>,
    pageList:[10,20,30,50,80,100],
    border:false,
    fit:true,
    fitColumns:<?=$loginMobile?'false':'true'?>,
    title:'',
    onDblClickRow:function(index, row){
        partnersModule.view(row.p_id, row.name);
    }
    ">
    <thead>
    <tr>
        <th data-options="field:'operate',width:220,fixed:true,align:'center',formatter:partnersModule.operate">操作</th>
        <th data-options="field:'name',width:200,align:'center'">姓名</th>
        <th data-options="field:'title',width:200,align:'center'">职位</th>
        <th data-options="field:'tel',width:200,align:'center'">电话</th>
        <th data-options="field:'total_amount',width:200,align:'center',formatter:GLOBAL.func.moneyFormat">总认缴(元)</th>
        <th data-options="field:'total_paid_amount',width:200,align:'center',formatter:GLOBAL.func.moneyFormat">总实缴(元)</th>
        <th data-options="field:'total_fund_count',width:100,align:'center'">参与基金</th>
        <th data-options="field:'total_enterprise_count',width:100,align:'center'">参与项目</th>
        <th data-options="field:'progress_log',width:400,align:'center'">最新进展</th>
        <th data-options="field:'status',width:200,align:'center',formatter:partnersModule.formatStatus">状态</th>
    </tr>
    </thead>
</table>
<div id="partnersToolbar" class="p-1">
    <div>
        <a href="javascript:;" class="easyui-linkbutton" data-options="onClick:function(){ partnersModule.add(); },iconCls:iconClsDefs.add">添加</a>
    </div>
    <div class="line my-1"></div>
    <form id="partnersToolbarForm">
        姓名: <input name="search[name]" class="easyui-textbox" data-options="width:160" />
        <a class="easyui-linkbutton" data-options="iconCls:'fa fa-search',
                    onClick:function(){ partnersModule.search(); }">搜索
        </a>
        <a class="easyui-linkbutton" data-options="iconCls:'fa fa-reply',
                    onClick:function(){ partnersModule.reset(); }">重置
        </a>
    </form>
</div>
<script>
var partnersModule={dialog:'#globel-dialog-div',datagrid:'#partnersDatagrid',operate:function(val,row){var btns=[];btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="partnersModule.edit('+row.p_id+',\''+GLOBAL.func.htmlEncode(row.name)+'\')" title="编辑"><i class="fa fa-pencil-square-o">编辑</i></a>');btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="partnersModule.delete('+row.p_id+',\''+GLOBAL.func.htmlEncode(row.name)+'\')" title="删除"><i class="fa fa-trash-o">删除</i></a>');btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="partnersModule.changePwd('+row.p_id+',\''+GLOBAL.func.htmlEncode(row.name)+'\')" title="重置登录帐号"><i class="fa fa-key">登录帐号</i></a>');btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="partnersModule.progress('+row.p_id+',\''+GLOBAL.func.htmlEncode(row.name)+'\')" title="进展"><i class="fa fa-flag">进展</i></a>');return btns.join(' ');},formatStatus:function(val,row){return<?=json_encode(\app\index\logic\Defs::$partnerStatusHtmlDefs,JSON_UNESCAPED_UNICODE)?>[val];},reload:function(){$(this.datagrid).datagrid('reload');},load:function(){$(this.datagrid).datagrid('load');},search:function(){var that=this;var queryParams=$(that.datagrid).datagrid('options').queryParams;$.each($("#partnersToolbarForm").serializeArray(),function(){delete queryParams[this['name']];});$.each($("#partnersToolbarForm").serializeArray(),function(){queryParams[this['name']]=this['value'];});that.load();},reset:function(){var that=this;var queryParams=$(that.datagrid).datagrid('options').queryParams;for(var key in queryParams){delete queryParams[key];}
$("#partnersToolbarForm").form('reset');that.load();},add:function(){var that=this;var href='<?=$urlHrefs['add']?>';$(that.dialog).dialog({title:'添加合伙人',iconCls:iconClsDefs.add,width:<?=$loginMobile?"'90%'":800?>,height:'95%',cache:false,href:href,modal:true,collapsible:false,minimizable:false,resizable:false,maximizable:false,buttons:[{text:'确定',iconCls:iconClsDefs.ok,handler:function(){$(that.dialog).find('form').eq(0).form('submit',{onSubmit:function(){var isValid=$(this).form('validate');if(!isValid)return false;$.messager.progress({text:'处理中，请稍候...'});$.post(href,$(this).serialize(),function(res){$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg,'info');$(that.dialog).dialog('close');that.reload();}},'json');return false;}});}},{text:'取消',iconCls:iconClsDefs.cancel,handler:function(){$(that.dialog).dialog('close');}}]});$(that.dialog).dialog('center');},edit:function(pId,name){var that=this;var href='<?=$urlHrefs['edit']?>';href+=href.indexOf('?')!=-1?'&pId='+pId:'?pId='+pId;$(that.dialog).dialog({title:name+' - 修改合伙人',iconCls:iconClsDefs.edit,width:<?=$loginMobile?"'90%'":800?>,height:'95%',cache:false,href:href,modal:true,collapsible:false,minimizable:false,resizable:false,maximizable:false,buttons:[{text:'确定',iconCls:iconClsDefs.ok,handler:function(){$(that.dialog).find('form').eq(0).form('submit',{onSubmit:function(){var isValid=$(this).form('validate');if(!isValid)return false;$.messager.progress({text:'处理中，请稍候...'});$.post(href,$(this).serialize(),function(res){$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg,'info');$(that.dialog).dialog('close');that.reload();}},'json');return false;}});}},{text:'取消',iconCls:iconClsDefs.cancel,handler:function(){$(that.dialog).dialog('close');}}]});$(that.dialog).dialog('center');},delete:function(pId,name){var that=this;var href='<?=$urlHrefs['delete']?>';href+=href.indexOf('?')!=-1?'&pId='+pId:'?pId='+pId;$.messager.confirm('提示',name+' - 确认删除吗?',function(result){if(!result)return false;$.messager.progress({text:'处理中，请稍候...'});$.post(href,{},function(res){$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg,'info');that.reload();}},'json');});},view:function(pId,name){var that=this;var href='<?=$urlHrefs['view']?>';href+=href.indexOf('?')!=-1?'&pId='+pId:'?pId='+pId;$(that.dialog).dialog({title:name+' - 查看合伙人',iconCls:'fa fa-eye',width:<?=$loginMobile?"'90%'":800?>,height:'95%',cache:false,href:href,modal:true,collapsible:false,minimizable:false,resizable:false,maximizable:false,buttons:[{text:'取消',iconCls:iconClsDefs.cancel,handler:function(){$(that.dialog).dialog('close');}}]});$(that.dialog).dialog('center');},changePwd:function(pId,name){var that=this;var href='<?=$urlHrefs['password']?>';href+=href.indexOf('?')!=-1?'&pId='+pId:'?pId='+pId;$(that.dialog).dialog({title:'修改合伙人登录帐号 - '+name,iconCls:iconClsDefs.edit,width:<?=$loginMobile?"'90%'":500?>,height:'95%',cache:false,href:href,modal:true,collapsible:false,minimizable:false,resizable:false,maximizable:false,buttons:[{text:'确定',iconCls:iconClsDefs.ok,handler:function(){$(that.dialog).find('form').eq(0).form('submit',{onSubmit:function(){var isValid=$(this).form('validate');if(!isValid)return false;$.messager.progress({text:'处理中，请稍候...'});$.post(href,$(this).serialize(),function(res){$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg,'info');$(that.dialog).dialog('close');that.reload();}},'json');return false;}});}},{text:'取消',iconCls:iconClsDefs.cancel,handler:function(){$(that.dialog).dialog('close');}}]});$(that.dialog).dialog('center');},progress:function(pId,name){var that=this;var href='<?=$urlHrefs['partnersProgress']?>';href+=href.indexOf('?')!=-1?'&externalId='+pId:'?externalId='+pId;$(that.dialog).dialog({title:name+' - 合伙人进展',iconCls:'fa fa-commenting',width:<?=$loginMobile?"'90%'":800?>,height:'95%',cache:false,href:href,modal:true,collapsible:false,minimizable:false,resizable:false,maximizable:false,buttons:[{text:'取消',iconCls:iconClsDefs.cancel,handler:function(){$(that.dialog).dialog('close');that.reload();}}]});$(that.dialog).dialog('center');}};</script>