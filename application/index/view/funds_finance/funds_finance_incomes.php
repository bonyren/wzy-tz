<table id="fundsFinanceIncomesDatagrid" class="easyui-datagrid" data-options="striped:true,
    nowrap:false,
    rownumbers:true,
    autoRowHeight:true,
    singleSelect:true,
    selectOnCheck:false,
    checkOnSelect:false,
    url:'<?=$urlHrefs['fundsFinanceIncomes']?>',
    method:'post',
    toolbar:'#fundsFinanceIncomesToolbar',
    pagination:true,
    pageSize:<?=DEFAULT_PAGE_ROWS?>,
    pageList:[10,20,30,50,80,100],
    border:false,
    fit:true,
    fitColumns:<?=$loginMobile?'false':'true'?>,
    title:'',
    onDblClickRow:function(index, row){
        //fundsFinanceIncomesModule.view(row.id);
    },
    showFooter:true
    ">
    <thead>
    <tr>
        <?php if(!$readOnly){ ?>
        <th data-options="field:'operate',width:100,fixed:true,align:'center',formatter:fundsFinanceIncomesModule.operate">操作</th>
        <?php } ?>
        <th data-options="field:'title',width:200,align:'center'">名称</th>
        <th data-options="field:'date',width:100,align:'center'">日期</th>
        <th data-options="field:'amount',width:100,align:'center',formatter:GLOBAL.func.moneyFormat">金额</th>
        <th data-options="field:'type',width:100,align:'center',formatter:fundsFinanceIncomesModule.formatType">类型</th>
    </tr>
    </thead>
</table>
<div id="fundsFinanceIncomesToolbar" class="p-1">
    <div>
        <?php if(!$readOnly){ ?>
            <a href="javascript:;" class="easyui-linkbutton" data-options="onClick:function(){ fundsFinanceIncomesModule.add(); },iconCls:iconClsDefs.add">添加收入</a>
        <?php } ?>
    </div>
    <div class="line my-1"></div>
</div>
<script>
var fundsFinanceIncomesModule={dialog:'#globel-dialog2-div',dialog2:'#globel-dialog2-div',datagrid:'#fundsFinanceIncomesDatagrid',operate:function(val,row){if(row.ffi_id==0){return'';}
var btns=[];btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsFinanceIncomesModule.edit('+row.ffi_id+')" title="编辑"><i class="fa fa-pencil-square-o fa-lg"></i></a>');btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsFinanceIncomesModule.delete('+row.ffi_id+')" title="删除"><i class="fa fa-trash-o fa-lg"></i></a>');return btns.join(' ');},reload:function(){$(this.datagrid).datagrid('reload');},load:function(){$(this.datagrid).datagrid('load');},reset:function(){var that=this;var queryParams=$(that.datagrid).datagrid('options').queryParams;for(var key in queryParams){delete queryParams[key];}
that.load();},formatType:function(val,row,index){return<?=json_encode(\app\index\logic\Defs::$fundIncomeTypeHtmlDefs)?>[val];},add:function(){var that=this;var href='<?=$urlHrefs['fundsFinanceIncomesAdd']?>';$(that.dialog).dialog({title:'添加基金收入',iconCls:iconClsDefs.add,width:600,height:450,cache:false,href:href,modal:true,collapsible:false,minimizable:false,resizable:false,maximizable:false,buttons:[{text:'确定',iconCls:iconClsDefs.ok,handler:function(){$(that.dialog).find('form').eq(0).form('submit',{onSubmit:function(){var isValid=$(this).form('validate');if(!isValid)return false;$.messager.progress({text:'处理中，请稍候...'});$.post(href,$(this).serialize(),function(res){$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg,'info');$(that.dialog).dialog('close');that.reload();}},'json');return false;}});}},{text:'取消',iconCls:iconClsDefs.cancel,handler:function(){$(that.dialog).dialog('close');}}]});$(that.dialog).dialog('center');},edit:function(ffiId){var that=this;var href='<?=$urlHrefs['fundsFinanceIncomesEdit']?>';href+=href.indexOf('?')!=-1?'&ffiId='+ffiId:'?ffiId='+ffiId;$(that.dialog).dialog({title:'修改基金收入',iconCls:iconClsDefs.edit,width:600,height:450,cache:false,href:href,modal:true,collapsible:false,minimizable:false,resizable:false,maximizable:false,buttons:[{text:'确定',iconCls:iconClsDefs.ok,handler:function(){$(that.dialog).find('form').eq(0).form('submit',{onSubmit:function(){var isValid=$(this).form('validate');if(!isValid)return false;$.messager.progress({text:'处理中，请稍候...'});$.post(href,$(this).serialize(),function(res){$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg,'info');$(that.dialog).dialog('close');that.reload();}},'json');return false;}});}},{text:'取消',iconCls:iconClsDefs.cancel,handler:function(){$(that.dialog).dialog('close');}}]});$(that.dialog).dialog('center');},delete:function(ffiId){var that=this;var href='<?=$urlHrefs['fundsFinanceIncomesDelete']?>';href+=href.indexOf('?')!=-1?'&ffiId='+ffiId:'?ffiId='+ffiId;$.messager.confirm('提示','确认删除吗?',function(result){if(!result)return false;$.messager.progress({text:'处理中，请稍候...'});$.post(href,{},function(res){$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg,'info');that.reload();}},'json');});}};</script>