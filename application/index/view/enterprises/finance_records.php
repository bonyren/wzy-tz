<table id="<?=DATAGRID_ID?>" class="easyui-datagrid" data-options="striped:true,
    nowrap:false,
    rownumbers:true,
    autoRowHeight:true,
    singleSelect:true,
    url:'<?=url('enterprises/financeRecords',['enterprise_id'=>$enterprise_id])?>',
    toolbar:'#<?=TOOLBAR_ID?>',
    pagination:true,
    pageSize:<?=DEFAULT_PAGE_ROWS?>,
    fit:true,
    fitColumns:<?=$loginMobile?'false':'true'?>,
    view:detailview,
    detailFormatter:<?=JVAR?>.detailFormatter,
    onExpandRow:<?=JVAR?>.onExpandRow,
    onLoadSuccess:<?=JVAR?>.convert,
    border:false">
    <thead>
    <tr>
        <th data-options="field:'title',width:100,align:'center'">事件</th>
        <th data-options="field:'when',width:100,align:'center'">时间</th>
        <th data-options="field:'amount',width:100,align:'center'">合计金额（元）</th>
        <th data-options="field:'valuation',align:'center',width:100">最新估值（元）</th>
        <th data-options="field:'files',width:100,align:'center'">投资/股转协议</th>
        <th data-options="field:'shareholders',width:100,align:'center'">股东表</th>
        <?php if (!$readonly): ?>
            <th data-options="field:'btns',width:100,align:'center'">操作</th>
        <?php endif; ?>
    </tr>
    </thead>
</table>
<?php if (!$readonly): ?>
<div id="<?=TOOLBAR_ID?>" class="p-1">
    <form>
        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="onClick:function(){<?=JVAR?>.edit(0);},iconCls:'fa fa-plus'">新增</a>
    </form>
</div>
<?php endif; ?>
<script>
var <?=JVAR?>={datagrid:'#<?=DATAGRID_ID?>',toolbar:'#<?=TOOLBAR_ID?>',convert:function(data){var that=<?=JVAR?>;data.rows.forEach(function(v,i){var btns=[];btns.push('<a href="javascript:void(0);" class="btn btn-outline-info size-MINI radius my-1" onclick="<?=JVAR?>.edit('+v.id+')" title="编辑"><i class="fa fa-pencil-square-o fa-lg"></i></a>');btns.push('<a href="javascript:void(0);" class="btn btn-outline-info size-MINI radius my-1" onclick="<?=JVAR?>.remove('+v.id+')" title="删除"><i class="fa fa-trash-o fa-lg"></i></a>');$(that.datagrid).datagrid('updateRow',{index:i,row:{amount:parseInt(v.amount).toLocaleString(),valuation:parseInt(v.valuation).toLocaleString(),stock_ratio:v.stock_ratio+'%',shareholders:v.esid=='0'?'':'<a href="javascript:void(0)" onclick="<?=JVAR?>.viewes('+v.esid+')">查看</a>',btns:btns.join(' ')}});$.get('<?=url('index/Upload/viewAttaches')?>',{attachmentType:32,externalId:v.id,uiStyle:'<?=\app\index\controller\Upload::ATTACHES_UI_LINK_STYLE?>'},function(res){$(that.datagrid).datagrid('updateRow',{index:i,row:{files:res}});});});},viewes:function(esid){var url='<?=url('enterprises/shareholdersEdit')?>?id='+esid+'&readonly=1';QT.helper.view({url:url,width:<?=$loginMobile?"'90%'":800?>,height:'80%',dialog:'view-shareholders'});},detailFormatter:function(index,row){return'<div class="ddv pd-5"></div>';},onExpandRow:function(index,row){var that=<?=JVAR?>;var ddv=$(that.datagrid).datagrid('getRowDetail',index).find('div.ddv');ddv.panel({fixed:true,border:false,cache:false,href:'<?=url('Enterprises/getFinancingDetail')?>?efid='+row.id,onLoad:function(){$(that.datagrid).datagrid('fixDetailRowHeight',index);}});$(that.datagrid).datagrid('fixDetailRowHeight',index);},reload:function(){$(this.datagrid).datagrid('reload');},search:function(){var that=this,data={};var params=$(that.toolbar).children('form').serializeArray()
$.each(params,function(){data[this['name']]=this['value'];});$(that.datagrid).datagrid('load',data);},reset:function(){var that=this;$(that.toolbar).find('.easyui-textbox').textbox('clear');$(that.datagrid).datagrid('load',{});},edit:function(id){var that=this,href='<?=url('enterprises/editFinanceRecord',['enterprise_id'=>$enterprise_id])?>&id='+id;QT.helper.dialog('股权变更',href,true,function($dialog){var $form=$dialog.find('form');if(!$form.form('validate')){return false;}
$.messager.progress({text:'处理中，请稍候...'});$.post(href,$form.serialize(),function(res){$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg,'info');$dialog.dialog('close');that.reload();$('#shareholders_datagrid').datagrid('reload');}},'json');},<?=$loginMobile?"'90%'":800?>,"90%");},remove:function(id){var that=this;var url='<?=url('enterprises/delFinanceRecord')?>';$.messager.confirm('提示','确认删除吗?',function(result){if(!result)return false;$.messager.progress({text:'处理中，请稍候...'});$.post(url,{id:id},function(res){$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg,'info');that.reload();}},'json');});}};</script>