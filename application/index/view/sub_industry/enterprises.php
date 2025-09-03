<table id="<?=DATAGRID_ID?>" class="easyui-datagrid" data-options="
    nowrap:false,
    rownumbers:true,
    autoRowHeight:true,
    singleSelect:true,
    url:'<?=$_request_url?>',
    toolbar:'#<?=TOOLBAR_ID?>',
    fit:true,
    remoteSort:false,
    fitColumns:<?=$loginMobile?'false':'true'?>,
    onLoadSuccess:<?=JVAR?>.convert,
    border:false">
    <thead>
    <tr>
        <th data-options="field:'btns',width:120,fixed:true,align:'center'">操作</th>
        <th data-options="field:'name',width:200,align:'center'">企业名称</th>
        <th data-options="field:'position',width:100,align:'center',sortable:true,formatter:<?=JVAR?>.hywz">行业位置</th>
        <th data-options="field:'sort',width:100,align:'center',sortable:true">排序</th>
    </tr>
    </thead>
</table>
<div id="<?=TOOLBAR_ID?>" class="p-1">
    <div>
        <?php echo \app\index\service\View::selector([
            'value_field'=>'id',
            'type'=>'callback',
            'multiple'=>true,
            'callback'=>JVAR.'.addProject',
            'btn_text'=>'添加项目',
            'url' => url('index/Enterprises/index'),
        ]); ?>
    </div>
</div>
<script>
var <?=JVAR?>={datagrid:'#<?=DATAGRID_ID?>',toolbar:'#<?=TOOLBAR_ID?>',mapPositions:<?=json_encode(\app\index\logic\Defs::INDUSTRY_POSITIONS,JSON_UNESCAPED_UNICODE)?>,convert:function(data){var that=<?=JVAR?>;$.each(data.rows,function(i,v){var btns=[];btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="<?=JVAR?>.edit('+v.id+')" title="编辑"><i class="fa fa-pencil-square-o">编辑</i></a>');btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="<?=JVAR?>.remove('+v.id+')" title="删除"><i class="fa fa-trash-o">删除</i></a>');$(that.datagrid).datagrid('updateRow',{index:i,row:{btns:btns.join(' | ')}});});},hywz:function(val,row,idx){var that=<?=JVAR?>;if(val in that.mapPositions){return that.mapPositions[val];}else{return'';}},reload:function(){$(this.datagrid).datagrid('reload');},search:function(){var that=this,data={};var params=$(that.toolbar).children('form').serializeArray()
$.each(params,function(){data[this['name']]=this['value'];});$(that.datagrid).datagrid('load',data);},reset:function(){var that=this;$(that.toolbar).find('.easyui-textbox').textbox('clear');$(that.datagrid).datagrid('load',{});},addProject:function(eids){$.messager.progress({text:'处理中，请稍候...'});$.post('<?=url('index/SubIndustry/addEnterprises')?>',{iid:'<?=$iid?>',eids:eids},function(res){$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg,'info');<?=JVAR?>.reload();}},'json');},edit:function(id){var that=this;var href='<?=url('index/SubIndustry/setEnterprise')?>?id='+id;var $dialog=QT.helper.genDialogId('set-industry-enterprise');$dialog.dialog({title:'编辑',iconCls:'fa fa-pencil-square',width:500,height:300,border:false,href:href,modal:true,buttons:[{text:'确定',iconCls:iconClsDefs.ok,handler:function(){var $form=$dialog.find('form');$.messager.progress({text:'处理中，请稍候...'});$.post(href,$form.serialize(),function(res){$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg,'info');that.reload();$dialog.dialog('close');}},'json');}},{text:'取消',iconCls:iconClsDefs.cancel,handler:function(){$dialog.dialog('close');}}]});$dialog.dialog('center');},remove:function(id){var that=this;$.messager.confirm('提示','确认删除吗?',function(result){if(!result)return false;$.messager.progress({text:'处理中，请稍候...'});$.post('<?=url('index/SubIndustry/delEnterprises')?>',{id:id},function(res){$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg,'info');that.reload();}},'json');});}};</script>