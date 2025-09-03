<?php
use app\common\CommonDefs;
?>
<script type="text/javascript" src="/static/js/funds.js?<?=STATIC_VER?>"></script>
<table id="fundsManageDatagrid" class="easyui-datagrid" data-options="striped:true,
    nowrap:false,
    rownumbers:true,
    autoRowHeight:true,
    singleSelect:true,
    url:'<?=$urlHrefs['fundsManage']?>',
    method:'post',
    toolbar:'#fundsManageToolbar',
    pagination:true,
    pageSize:<?=DEFAULT_PAGE_ROWS?>,
    pageList:[10,20,30,50,80,100],
    border:false,
    fit:true,
    fitColumns:<?=$loginMobile?'false':'true'?>,
    title:'',
    onDblClickRow:function(index, row){
        fundsManageModule.view(row.fund_id, row.name);
    }
    ">
    <thead>
    <tr>
        <th data-options="field:'operate',width:200,fixed:true,align:'center',formatter:fundsManageModule.operate">操作</th>
        <th data-options="field:'name',width:200,align:'center'">基金名</th>
        <th data-options="field:'size',width:100,align:'center',formatter:GLOBAL.func.moneyFormat">总规模(元)</th>
        <th data-options="field:'actual_size',width:100,align:'center',formatter:GLOBAL.func.moneyFormat">认缴规模(元)</th>
        <th data-options="field:'actual_paid_size',width:100,align:'center',formatter:GLOBAL.func.moneyFormat">实缴规模(元)</th>
        <th data-options="field:'invest_size',width:100,align:'center',formatter:GLOBAL.func.moneyFormat">投资金额(元)</th>
        <th data-options="field:'establish_date',width:100,align:'center',formatter:GLOBAL.func.dateFilter">成立日期</th>
        <th data-options="field:'finance_affair',width:100,align:'center',formatter:fundsManageModule.operateFinance">财务管理</th>
        <th data-options="field:'partner_affair',width:100,align:'center',formatter:fundsManageModule.operateDispatch">收益分配</th>
        <th data-options="field:'archive_affair',width:100,align:'center',formatter:fundsManageModule.operateArchive"">文件管理</th>
        <th data-options="field:'status',align:'center',formatter:fundsManageModule.formatStatus">状态</th>
    </tr>
    </thead>
</table>
<div id="fundsManageToolbar" class="p-1">
    <form id="fundsManageToolbarForm">
        基金名: <input id="fundsManageToolbarFormSearchbox" name="search[name]" class="easyui-textbox"
                    data-options="width:160" />
        <a class="easyui-linkbutton" data-options="iconCls:'fa fa-search',
                    onClick:function(){ fundsManageModule.search(); }">搜索
        </a>
        <a class="easyui-linkbutton" data-options="iconCls:'fa fa-reply',
                    onClick:function(){ fundsManageModule.reset(); }">重置
        </a>
    </form>
</div>
<script>
var fundsManageModule={dialog:'#globel-dialog-div',datagrid:'#fundsManageDatagrid',operate:function(val,row){var btns=[];<?php  if($loginUserMenuPriv==CommonDefs::AUTHORIZE_READ_WRITE_TYPE){?>btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsManageModule.view('+row.fund_id+',\''+GLOBAL.func.htmlEncode(row.name)+'\')" title="查看"><i class="fa fa-eye">查看</i></a>');btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsManageModule.progress('+row.fund_id+',\''+GLOBAL.func.htmlEncode(row.name)+'\')" title="进展"><i class="fa fa-flag">进展</i></a>');btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsManageModule.edit('+row.fund_id+',\''+GLOBAL.func.htmlEncode(row.name)+'\')" title="编辑"><i class="fa fa-pencil-square-o">编辑</i></a>');btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsManageModule.goExit('+row.fund_id+',\''+GLOBAL.func.htmlEncode(row.name)+'\')" title="注销"><i class="fa fa-window-close-o">注销</i></a>');btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsManageModule.backInvest('+row.fund_id+',\''+GLOBAL.func.htmlEncode(row.name)+'\')" title="返回投资"><i class="fa fa-arrow-up">返回投资</i></a>');<?php }else if($loginUserMenuPriv==CommonDefs::AUTHORIZE_READ_ONLY_TYPE){?>btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsManageModule.view('+row.fund_id+',\''+GLOBAL.func.htmlEncode(row.name)+'\')" title="查看"><i class="fa fa-eye">查看</i></a>');<?php }?>return btns.join(' ');},operateFinance:function(val,row,index){var btns=[];btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsManageModule.finance('+row.fund_id+',\''+GLOBAL.func.htmlEncode(row.name)+'\')" title="财务管理"><span class="fa fa-money">管理</span></a>');return btns.join(' ');},operateDispatch:function(val,row,index){var btns=[];btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsManageModule.dispatch('+row.fund_id+',\''+GLOBAL.func.htmlEncode(row.name)+'\')" title="收益分配"><span class="fa fa-share-alt">管理</span></a>');return btns.join(' ');},operateArchive:function(val,row,index){var btns=[];btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsManageModule.archive('+row.fund_id+',\''+GLOBAL.func.htmlEncode(row.name)+'\')" title="文件管理"><span class="fa fa-file">管理</span></a>');return btns.join(' ');},formatStatus:function(val,row){var statusObj=<?=json_encode(\app\index\logic\Funds::$fundStatusHtmlDefs)?>;return statusObj[val];},reload:function(){$(this.datagrid).datagrid('reload');},load:function(){$(this.datagrid).datagrid('load');},search:function(){var that=this;var queryParams=$(that.datagrid).datagrid('options').queryParams;$.each($("#fundsManageToolbarForm").serializeArray(),function(){delete queryParams[this['name']];});$.each($("#fundsManageToolbarForm").serializeArray(),function(){queryParams[this['name']]=this['value'];});that.load();},reset:function(){var that=this;var queryParams=$(that.datagrid).datagrid('options').queryParams;for(var key in queryParams){delete queryParams[key];}
that.load();},edit:function(fundId,name){var that=this;var href='<?=$urlHrefs['fundsEdit']?>';href+=href.indexOf('?')!=-1?'&fundId='+fundId:'?fundId='+fundId;fundsCommonModule.edit(href,name+' - 基金管理',function(){that.reload();});},finance:function(fundId,name){var that=this;var href='<?=$urlHrefs['fundsFinance']?>';href+=href.indexOf('?')!=-1?'&fundId='+fundId:'?fundId='+fundId;$(that.dialog).dialog({title:name+' - 财务',iconCls:iconClsDefs.edit,width:'70%',height:'100%',cache:false,href:href,modal:true,collapsible:false,minimizable:false,resizable:false,maximizable:true,buttons:[{text:'关闭',iconCls:iconClsDefs.cancel,handler:function(){$(that.dialog).dialog('close');}}]});$(that.dialog).dialog('center');},dispatch:function(fundId,name){var that=this;var href='<?=$urlHrefs['fundsDispatch']?>';href+=href.indexOf('?')!=-1?'&fundId='+fundId:'?fundId='+fundId;$(that.dialog).dialog({title:name+' - 收益分配',iconCls:iconClsDefs.edit,width:'70%',height:'100%',cache:false,href:href,modal:true,collapsible:false,minimizable:false,resizable:false,maximizable:true,buttons:[{text:'关闭',iconCls:iconClsDefs.cancel,handler:function(){$(that.dialog).dialog('close');}}]});$(that.dialog).dialog('center');},archive:function(fundId,name){var that=this;var href='<?=$urlHrefs['fundsManageArchives']?>';href+=href.indexOf('?')!=-1?'&fundId='+fundId:'?fundId='+fundId;$(that.dialog).dialog({title:name+' - 文件',iconCls:iconClsDefs.edit,width:'70%',height:'100%',cache:false,href:href,modal:true,collapsible:false,minimizable:false,resizable:false,maximizable:true,buttons:[{text:'关闭',iconCls:iconClsDefs.cancel,handler:function(){$(that.dialog).dialog('close');}}]});$(that.dialog).dialog('center');},event:function(fundId,name){var that=this;var href='<?=$urlHrefs['fundsManageEvent']?>';href+=href.indexOf('?')!=-1?'&fundId='+fundId:'?fundId='+fundId;$(that.dialog).dialog({title:name+' - 事件',iconCls:iconClsDefs.edit,width:'70%',height:'100%',cache:false,href:href,modal:true,collapsible:false,minimizable:false,resizable:false,maximizable:true,buttons:[{text:'关闭',iconCls:iconClsDefs.cancel,handler:function(){$(that.dialog).dialog('close');}}]});$(that.dialog).dialog('center');},view:function(fundId,name){var that=this;var href='<?=$urlHrefs['fundsView']?>';href+=href.indexOf('?')!=-1?'&fundId='+fundId:'?fundId='+fundId;fundsCommonModule.view(href,name+' - 基金查看');},progress:function(fundId,name){var that=this;var href='<?=$urlHrefs['fundsProgress']?>';href+=href.indexOf('?')!=-1?'&externalId='+fundId:'?externalId='+fundId;fundsCommonModule.progress(href,name+' - 基金进展事件');},goExit:function(fundId,name){var that=this;$.messager.confirm('提示','确认['+name+']进如基金退出阶段吗?',function(result){if(!result)return false;$.messager.progress({text:'处理中，请稍候...'});$.post('<?=url('index/Funds/changeStatus')?>',{fundId:fundId,fromStatus:<?=\app\index\logic\Funds::FUND_MANAGE_STATUS?>,toStatus:<?=\app\index\logic\Funds::FUND_EXIT_STATUS?>},function(res){$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg,'info');that.reload();}},'json');});},backInvest:function(fundId,name){var that=this;$.messager.confirm('提示','确认['+name+']返回投资阶段吗?',function(result){if(!result)return false;$.messager.progress({text:'处理中，请稍候...'});$.post('<?=url('index/Funds/changeStatus')?>',{fundId:fundId,fromStatus:<?=\app\index\logic\Funds::FUND_MANAGE_STATUS?>,toStatus:<?=\app\index\logic\Funds::FUND_INVEST_STATUS?>},function(res){$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg,'info');that.reload();}},'json');});}};</script>