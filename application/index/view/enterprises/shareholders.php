<table id="shareholders_datagrid" class="easyui-datagrid" data-options="
    nowrap:false,
    rownumbers:true,
    autoRowHeight:true,
    singleSelect:true,
    url:'<?=url('enterprises/shareholders',['enterprise_id'=>$enterprise_id])?>',
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
        <th data-options="field:'name',width:200">标题</th>
        <th data-options="field:'date',width:100,align:'center'">更新日期</th>
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
var <?=JVAR?>={datagrid:'#shareholders_datagrid',toolbar:'#<?=TOOLBAR_ID?>',convert:function(data){var that=<?=JVAR?>;$.each(data.rows,function(i,v){var btns=[];btns.push('<a href="javascript:void(0);" class="btn btn-outline-info size-MINI radius my-1" onclick="<?=JVAR?>.edit('+v.id+')" title="编辑"><i class="fa fa-pencil-square-o fa-lg"></i></a>');btns.push('<a href="javascript:void(0);" class="btn btn-outline-info size-MINI radius my-1" onclick="<?=JVAR?>.remove('+v.id+')" title="删除"><i class="fa fa-trash-o fa-lg"></i></a>');$(that.datagrid).datagrid('updateRow',{index:i,row:{btns:btns.join(' ')}});});},detailFormatter:function(index,row){return'<div class="ddv pd-5"></div>';},onExpandRow:function(index,row){var that=<?=JVAR?>;var ddv=$(that.datagrid).datagrid('getRowDetail',index).find('div.ddv');ddv.panel({fixed:true,border:false,cache:false,href:'<?=url('Enterprises/getShareholderDetail')?>?esid='+row.id,onLoad:function(){$(that.datagrid).datagrid('fixDetailRowHeight',index);}});$(that.datagrid).datagrid('fixDetailRowHeight',index);},reload:function(){$(this.datagrid).datagrid('reload');},edit:function(id){var that=this,href='<?=url('Enterprises/shareholdersEdit',['enterprise_id'=>$enterprise_id])?>&id='+id;QT.helper.dialog('股东表',href,true,function($dialog){var $form=$dialog.find('form');if(!$form.form('validate')){return false;}
$.messager.progress({text:'处理中，请稍候...'});$.post(href,$form.serialize(),function(res){$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg,'info');$dialog.dialog('close');that.reload();}},'json');},<?=$loginMobile?"'90%'":600?>,"80%");},remove:function(id){var that=this;$.messager.confirm('提示','确认删除吗?',function(result){if(!result)return false;$.messager.progress({text:'处理中，请稍候...'});$.post('<?=url('Enterprises/shareholdersRemove')?>',{id:id},function(res){$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg,'info');that.reload();}},'json');});}};</script>