<?php
use app\common\CommonDefs;
?>
<script type="text/javascript" src="/static/js/funds.js?<?=STATIC_VER?>"></script>
<table id="fundsInvestDatagrid" class="easyui-datagrid" data-options="striped:true,
    nowrap:false,
    rownumbers:true,
    autoRowHeight:true,
    singleSelect:true,
    url:'<?=$urlHrefs['fundsInvest']?>',
    method:'post',
    toolbar:'#fundsInvestToolbar',
    pagination:true,
    pageSize:<?=DEFAULT_PAGE_ROWS?>,
    pageList:[10,20,30,50,80,100],
    border:false,
    fit:true,
    fitColumns:<?=$loginMobile?'false':'true'?>,
    title:'',
    onDblClickRow:function(index, row){
        fundsInvestModule.view(row.fund_id, row.name);
    },
    onLoadSuccess:function(data){
        $.each(data.rows, function(i, row){
            $('#invest-progressbar-' + i).progressbar();
        });
    }
    ">
    <thead>
    <tr>
        <th data-options="field:'operate',width:250,fixed:true,align:'center',formatter:fundsInvestModule.operate">操作</th>
        <th data-options="field:'name',width:200,align:'center'">基金名</th>
        <th data-options="field:'size',width:100,align:'center',formatter:GLOBAL.func.moneyFormat">总规模(元)</th>
        <th data-options="field:'actual_size',width:100,align:'center',formatter:GLOBAL.func.moneyFormat">认缴规模(元)</th>
        <th data-options="field:'actual_paid_size',width:100,align:'center',formatter:GLOBAL.func.moneyFormat">实缴规模(元)</th>
        <th data-options="field:'invest_size',width:100,align:'center',formatter:GLOBAL.func.moneyFormat">投资金额(元)</th>
        <th data-options="field:'invest_progress_value',fixed:true,width:80,align:'center',formatter:fundsInvestModule.formatInvestProgressBar">投资进度</th>
        <th data-options="field:'establish_date',width:100,align:'center',formatter:GLOBAL.func.dateFilter">成立日期</th>
        <th data-options="field:'status',align:'center',formatter:fundsInvestModule.formatStatus">状态</th>
    </tr>
    </thead>
</table>
<div id="fundsInvestToolbar" class="p-1">
    <form id="fundsInvestToolbarForm">
        基金名: <input id="fundsInvestToolbarFormSearchbox" name="search[name]" class="easyui-textbox"
                    data-options="width:160" />
        <a class="easyui-linkbutton" data-options="iconCls:'fa fa-search',
                    onClick:function(){ fundsInvestModule.search(); }">搜索
        </a>
        <a class="easyui-linkbutton" data-options="iconCls:'fa fa-reply',
                    onClick:function(){ fundsInvestModule.reset(); }">重置
        </a>
    </form>
</div>
<script>
var fundsInvestModule={dialog:'#globel-dialog-div',datagrid:'#fundsInvestDatagrid',operate:function(val,row){var btns=[];<?php  if($loginUserMenuPriv==CommonDefs::AUTHORIZE_READ_WRITE_TYPE){?>btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsInvestModule.view('+row.fund_id+',\''+GLOBAL.func.htmlEncode(row.name)+'\')" title="查看"><i class="fa fa-eye">查看</i></a>');btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsInvestModule.progress('+row.fund_id+',\''+GLOBAL.func.htmlEncode(row.name)+'\')" title="进展"><i class="fa fa-flag">进展</i></a>');btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsInvestModule.goManage('+row.fund_id+',\''+GLOBAL.func.htmlEncode(row.name)+'\')" title="进入管理"><i class="fa fa-arrow-down">进入管理</i></a>');btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsInvestModule.backCollect('+row.fund_id+',\''+GLOBAL.func.htmlEncode(row.name)+'\')" title="返回募集"><i class="fa fa-arrow-up">返回募集</i></a>');btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsInvestModule.manageInvest('+row.fund_id+',\''+GLOBAL.func.htmlEncode(row.name)+'\')" title="投资管理"><i class="fa fa-share-alt">投资管理</i></a>');<?php }else if($loginUserMenuPriv==CommonDefs::AUTHORIZE_READ_ONLY_TYPE){?>btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsInvestModule.view('+row.fund_id+',\''+GLOBAL.func.htmlEncode(row.name)+'\')" title="查看"><i class="fa fa-eye">查看</i></a>');<?php }?>return btns.join(' ');},formatStatus:function(val,row){var statusObj=<?=json_encode(\app\index\logic\Funds::$fundStatusHtmlDefs)?>;return statusObj[val];},formatInvestProgressBar:function(val,row,index){return'<div id="invest-progressbar-'+index+'" class="easyui-progressbar" data-options="value:'+val+'"></div>';},reload:function(){$(this.datagrid).datagrid('reload');},load:function(){$(this.datagrid).datagrid('load');},search:function(){var that=this;var queryParams=$(that.datagrid).datagrid('options').queryParams;$.each($("#fundsInvestToolbarForm").serializeArray(),function(){delete queryParams[this['name']];});$.each($("#fundsInvestToolbarForm").serializeArray(),function(){queryParams[this['name']]=this['value'];});that.load();},reset:function(){var that=this;var queryParams=$(that.datagrid).datagrid('options').queryParams;for(var key in queryParams){delete queryParams[key];}
that.load();},view:function(fundId,name){var that=this;var href='<?=$urlHrefs['fundsView']?>';href+=href.indexOf('?')!=-1?'&fundId='+fundId:'?fundId='+fundId;fundsCommonModule.view(href,name+' - 基金查看');},progress:function(fundId,name){var that=this;var href='<?=$urlHrefs['fundsProgress']?>';href+=href.indexOf('?')!=-1?'&externalId='+fundId:'?externalId='+fundId;fundsCommonModule.progress(href,name+' - 基金进展事件');},manageInvest:function(fundId,name){var that=this;var href='<?=$urlHrefs['fundsEdit']?>';href+=href.indexOf('?')!=-1?'&fundId='+fundId:'?fundId='+fundId;$(that.dialog).dialog({title:name+' - 基金投资管理',iconCls:'fa fa-share-alt-square',width:'70%',height:'100%',cache:false,href:href,modal:true,collapsible:false,minimizable:false,resizable:false,maximizable:true,buttons:[{text:'关闭',iconCls:iconClsDefs.cancel,handler:function(){$(that.dialog).dialog('close');}}]});$(that.dialog).dialog('center');},goManage:function(fundId,name){var that=this;$.messager.confirm('提示','确认['+name+']投资完成，进如基金管理阶段吗?',function(result){if(!result)return false;$.messager.progress({text:'处理中，请稍候...'});$.post('<?=url('index/Funds/changeStatus')?>',{fundId:fundId,fromStatus:<?=\app\index\logic\Funds::FUND_INVEST_STATUS?>,toStatus:<?=\app\index\logic\Funds::FUND_MANAGE_STATUS?>},function(res){$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg,'info');that.reload();}},'json');});},backCollect:function(fundId,name){var that=this;$.messager.confirm('提示','确认['+name+']返回募集阶段吗?',function(result){if(!result)return false;$.messager.progress({text:'处理中，请稍候...'});$.post('<?=url('index/Funds/changeStatus')?>',{fundId:fundId,fromStatus:<?=\app\index\logic\Funds::FUND_INVEST_STATUS?>,toStatus:<?=\app\index\logic\Funds::FUND_COLLECT_STATUS?>},function(res){$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg,'info');that.reload();}},'json');});}};</script>