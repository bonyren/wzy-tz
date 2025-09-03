<div style="height: 100%;" class="hide-tree-icon">
<table id="<?=DATAGRID_ID?>" class="easyui-treegrid"
    data-options="
        url: '<?=url('config/industries')?>',
        fit:true,
        lines: true,
        fitColumns:<?=$loginMobile?'false':'true'?>,
        rownumbers: true,
        border:false,
        idField:'id',
        treeField:'name',
        onDblClickRow:<?=JVAR?>.edit,
        toolbar:<?=JVAR?>.toolbar">
    <thead>
    <tr>
        <th field="name" width="300">名称</th>
    </tr>
    </thead>
</table>
</div>
<div id="<?=TOOLBAR_ID?>">
    <a href="javascript:;" class="easyui-linkbutton" data-options="plain:true,iconCls:'icons-my-edit_add',onClick:function(){<?=JVAR?>.save();}">添加</a>
    <a href="javascript:;" class="easyui-linkbutton" data-options="plain:true,iconCls:'icons-my-edit_remove',onClick:function(){<?=JVAR?>.del();}">删除</a>
    <a href="javascript:;" class="easyui-linkbutton" data-options="plain:true,iconCls:'icons-my-reload',onClick:function(){<?=JVAR?>.reload();}">刷新</a>
    <span class="text-red">（双击修改）</span>
</div>
<script>
var <?=JVAR?>={treegrid:'#<?=DATAGRID_ID?>',toolbar:'#<?=TOOLBAR_ID?>',reload:function(){$(this.treegrid).treegrid('reload');},del:function(){var that=this;var node=$(that.treegrid).treegrid('getSelected');if(!node){$.app.method.tip('提示','请先选中目标数据','error');return;}
$.messager.confirm('提示','确定要删除该数据吗？',function(y){if(!y){return false;}
$.messager.progress({text:'处理中，请稍候...'});$.post('<?=url('config/delIndustry')?>',{id:node.id},function(res){$.messager.progress('close');if(res.code){$.app.method.tip('提示','删除成功');$(that.treegrid).treegrid('reload');}else{$.messager.alert('提示',res.msg,'error');}},'json');});},edit:function(row){<?=JVAR?>.save(row.id);},save:function(editId){var that=this;var id=editId?editId:0;var default_pid=0;if(!id){var selected=$(this.treegrid).treegrid('getSelected');if(selected!=null&&selected.pid=='0'){default_pid=selected.id;}}
var $dialog=QT.helper.genDialogId();var href='<?=url('config/editIndustry')?>?id='+id+'&pid='+default_pid;$dialog.dialog({title:id?'编辑节点':'添加节点',width:<?=$loginMobile?"'90%'":300?>,height:'50%',cache:false,href:href,modal:true,buttons:[{text:'确定',iconCls:iconClsDefs.ok,handler:function(){var form=$dialog.find('form');if(!form.form('validate')){return false;}
$.messager.progress({text:'处理中，请稍候...'});$.post(href,form.serialize(),function(res){$.messager.progress('close');if(res.code){$.app.method.tip('提示','保存成功');$dialog.dialog('close');$(that.treegrid).treegrid('reload');}else{$.messager.alert('提示',res.msg,'error');}},'json');}},{text:'取消',iconCls:iconClsDefs.cancel,handler:function(){$dialog.dialog('close');}}]});$dialog.dialog('center');}};</script>