<table id="<?=DATAGRID_ID?>" class="easyui-datagrid" data-options="striped:true,
    nowrap:false,
    rownumbers:true,
    autoRowHeight:true,
    singleSelect:true,
    url:'<?=url('enterprises/dividends',['enterprise_id'=>$enterprise_id])?>',
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
        <?php if (!$readonly): ?>
        <th data-options="field:'btns',width:80,align:'center'">操作</th>
        <?php endif; ?>
        <th data-options="field:'fund_name',width:250,align:'center'">基金名称</th>
        <th data-options="field:'amount',width:100,align:'center'">分红金额</th>
        <th data-options="field:'date',width:100,align:'center'">分红时间</th>
        <th data-options="field:'description',width:200,align:'center'">备注说明</th>
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
var <?=JVAR?>={datagrid:'#<?=DATAGRID_ID?>',toolbar:'#<?=TOOLBAR_ID?>',convert:function(data){var that=<?=JVAR?>;$.each(data.rows,function(i,v){var btns=[];btns.push('<a href="javascript:void(0);" class="btn btn-outline-info size-MINI radius my-1" onclick="<?=JVAR?>.edit('+v.id+')" title="编辑"><i class="fa fa-pencil-square-o fa-lg"></i></a>');btns.push('<a href="javascript:void(0);" class="btn btn-outline-info size-MINI radius my-1" onclick="<?=JVAR?>.remove('+v.id+')" title="删除"><i class="fa fa-trash-o fa-lg"></i></a>');$(that.datagrid).datagrid('updateRow',{index:i,row:{stock_ratio:v.stock_ratio+'%',btns:btns.join(' ')}});});},reload:function(){$(this.datagrid).datagrid('reload');},search:function(){var that=this,data={};var params=$(that.toolbar).children('form').serializeArray()
$.each(params,function(){data[this['name']]=this['value'];});$(that.datagrid).datagrid('load',data);},reset:function(){var that=this;$(that.toolbar).find('.easyui-textbox').textbox('clear');$(that.datagrid).datagrid('load',{});},edit:function(id){var that=this,href='<?=url('enterprises/editDividends',['enterprise_id'=>$enterprise_id])?>&id='+id;QT.helper.dialog('项目分红',href,true,function(){that.reload();},1000,"80%");},remove:function(id){var that=this;var url='<?=url('enterprises/delDividends')?>';$.messager.confirm('提示','确认删除吗?',function(result){if(!result)return false;$.messager.progress({text:'处理中，请稍候...'});$.post(url,{id:id},function(res){$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg,'info');that.reload();}},'json');});}};</script>