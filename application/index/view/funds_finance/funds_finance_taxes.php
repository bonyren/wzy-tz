<table id="fundsFinanceTaxesDatagrid" class="easyui-datagrid" data-options="striped:true,
    nowrap:false,
    rownumbers:true,
    autoRowHeight:true,
    singleSelect:true,
    selectOnCheck:false,
    checkOnSelect:false,
    url:'<?=$urlHrefs['fundsFinanceTaxes']?>',
    method:'post',
    toolbar:'#fundsFinanceTaxesToolbar',
    pagination:true,
    pageSize:<?=DEFAULT_PAGE_ROWS?>,
    pageList:[10,20,30,50,80,100],
    border:false,
    fit:true,
    fitColumns:<?=$loginMobile?'false':'true'?>,
    title:'',
    onDblClickRow:function(index, row){
        //fundsFinanceTaxesModule.view(row.id);
    },
    rowStyler:fundsFinanceTaxesModule.rowStyler,
    showFooter:true
    ">
    <thead>
    <tr>
        <?php if(!$readOnly){ ?>
            <th data-options="field:'operate',width:100,fixed:true,align:'center',formatter:fundsFinanceTaxesModule.operate">操作</th>
        <?php } ?>
        <th data-options="field:'title',width:200,align:'center'">名称</th>
        <th data-options="field:'date',width:100,align:'center'">日期</th>
        <th data-options="field:'amount',width:100,align:'center',formatter:GLOBAL.func.moneyFormat">应付税费</th>
        <th data-options="field:'type',width:100,align:'center',formatter:fundsFinanceTaxesModule.formatType">类型</th>
    </tr>
    </thead>
</table>
<div id="fundsFinanceTaxesToolbar" class="p-1">
    <div>
        <?php if(!$readOnly){ ?>
            <a href="javascript:;" class="easyui-linkbutton" data-options="onClick:function(){ fundsFinanceTaxesModule.add(); },iconCls:iconClsDefs.add">添加应付税费</a>
        <?php } ?>
    </div>
    <div class="line my-1"></div>
</div>
<script>
var fundsFinanceTaxesModule={dialog:'#globel-dialog2-div',dialog2:'#globel-dialog2-div',datagrid:'#fundsFinanceTaxesDatagrid',operate:function(val,row){if(row.fft_id==0){return'';}
var btns=[];btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsFinanceTaxesModule.edit('+row.fft_id+')" title="编辑"><i class="fa fa-pencil-square-o fa-lg"></i></a>');btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsFinanceTaxesModule.delete('+row.fft_id+')" title="删除"><i class="fa fa-trash-o fa-lg"></i></a>');return btns.join(' ');},reload:function(){$(this.datagrid).datagrid('reload');},load:function(){$(this.datagrid).datagrid('load');},reset:function(){var that=this;var queryParams=$(that.datagrid).datagrid('options').queryParams;for(var key in queryParams){delete queryParams[key];}
that.load();},formatType:function(val,row,index){return<?=json_encode(\app\index\logic\Defs::$fundTaxTypeHtmlDefs)?>[val];},rowStyler:function(index,row){row.belong_interval=row.from_date+' - '+row.end_date;},add:function(){var that=this;var href='<?=$urlHrefs['fundsFinanceTaxesAdd']?>';$(that.dialog).dialog({title:'添加应付税费',iconCls:iconClsDefs.add,width:600,height:450,cache:false,href:href,modal:true,collapsible:false,minimizable:false,resizable:false,maximizable:false,buttons:[{text:'确定',iconCls:iconClsDefs.ok,handler:function(){$(that.dialog).find('form').eq(0).form('submit',{onSubmit:function(){var isValid=$(this).form('validate');if(!isValid)return false;$.messager.progress({text:'处理中，请稍候...'});$.post(href,$(this).serialize(),function(res){$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg,'info');$(that.dialog).dialog('close');that.reload();}},'json');return false;}});}},{text:'取消',iconCls:iconClsDefs.cancel,handler:function(){$(that.dialog).dialog('close');}}]});$(that.dialog).dialog('center');},edit:function(fftId){var that=this;var href='<?=$urlHrefs['fundsFinanceTaxesEdit']?>';href+=href.indexOf('?')!=-1?'&fftId='+fftId:'?fftId='+fftId;$(that.dialog).dialog({title:'修改应付税费',iconCls:iconClsDefs.edit,width:600,height:450,cache:false,href:href,modal:true,collapsible:false,minimizable:false,resizable:false,maximizable:false,buttons:[{text:'确定',iconCls:iconClsDefs.ok,handler:function(){$(that.dialog).find('form').eq(0).form('submit',{onSubmit:function(){var isValid=$(this).form('validate');if(!isValid)return false;$.messager.progress({text:'处理中，请稍候...'});$.post(href,$(this).serialize(),function(res){$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg,'info');$(that.dialog).dialog('close');that.reload();}},'json');return false;}});}},{text:'取消',iconCls:iconClsDefs.cancel,handler:function(){$(that.dialog).dialog('close');}}]});$(that.dialog).dialog('center');},delete:function(fftId){var that=this;var href='<?=$urlHrefs['fundsFinanceTaxesDelete']?>';href+=href.indexOf('?')!=-1?'&fftId='+fftId:'?fftId='+fftId;$.messager.confirm('提示','确认删除吗?',function(result){if(!result)return false;$.messager.progress({text:'处理中，请稍候...'});$.post(href,{},function(res){$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg,'info');that.reload();}},'json');});}};</script>