
<table id="businessRegProxyDatagrid" data-options="striped:true,
    nowrap:false,
    rownumbers:true,
    autoRowHeight:true,
    singleSelect:true,
    url:'',
    method:'post',
    pagination:true,
    pageSize:<?=DEFAULT_PAGE_ROWS?>,
    pageList:[10,20,30,50,80,100],
    border:false,
    fit:true,
    fitColumns:<?=$loginMobile?'false':'true'?>,
    title:''">
    <thead>
    <tr>
        <?php 
        foreach($datagrid['fields'] as $label=>$field){ 
            $optionStr = '';
            foreach($field as $optionLabel=>$optionValue){
                $optionStr .= $optionLabel;
                $optionStr .= ":";
                if(is_string($optionValue)){
                    if($optionLabel == 'formatter'){
                        $optionStr .= "{$optionValue}";
                        $optionStr .= ",";
                    }else{
                        $optionStr .= "'{$optionValue}'";
                        $optionStr .= ",";
                    }
                }else if(is_numeric($optionValue)){
                    $optionStr .= "{$optionValue}";
                    $optionStr .= ",";
                }else if(is_bool($optionValue)){
                    $optionStr .= json_encode($optionValue);
                    $optionStr .= ",";
                }
            }
        ?>
        <th data-options="<?=$optionStr?>">
            <?=$label?>
        </th>
        <?php } ?>
    </tr>
    </thead>
</table>
<script type="text/javascript">
var businessRegProxyModule={dialog:'#globel-dialog-div',datagrid:'#businessRegProxyDatagrid',toolbar:[{text:'添加',iconCls:iconClsDefs.add,handler:function(){businessRegProxyModule.add();}},{text:'刷新',iconCls:'fa fa-refresh',handler:function(){businessRegProxyModule.refresh();}}],operate:function(val,row,index){var btn=[];btn.push('<a href="javascript:;" onclick="businessRegProxyModule.edit('+row.id+')"><i class="fa fa-pencil-square-o fa-lg"></i></a>');btn.push('<a href="javascript:;" onclick="businessRegProxyModule.delete('+row.id+')"><i class="fa fa-trash-o fa-lg"></i></a>');return btn.join(' | ');},refresh:function(){$(this.datagrid).datagrid('reload');},reload:function(){$(this.datagrid).datagrid('reload');},load:function(){$(this.datagrid).datagrid('load');},reset:function(){var that=this;var queryParams=$(that.datagrid).datagrid('options').queryParams;for(var key in queryParams){delete queryParams[key];}
that.load();},add:function(){var that=this;var href='<?=$urlHrefs['add']?>';$(that.dialog).dialog({title:'添加工商注册代理机构',iconCls:iconClsDefs.add,width:<?=$loginMobile?"'90%'":600?>,height:'95%',cache:false,href:href,modal:true,collapsible:false,minimizable:false,resizable:false,maximizable:false,buttons:[{text:'确定',iconCls:iconClsDefs.ok,handler:function(){$(that.dialog).find('form').eq(0).form('submit',{url:href,iframe:false,onSubmit:function(){var isValid=$(this).form('validate');if(!isValid)return false;$.messager.progress({text:'处理中，请稍候...'});return true;},success:function(data){var res=eval('('+data+')');$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg,'info');$(that.dialog).dialog('close');that.reload();}}});}},{text:'取消',iconCls:iconClsDefs.cancel,handler:function(){$(that.dialog).dialog('close');}}]});$(that.dialog).dialog('center');},edit:function(id){var that=this;var href='<?=$urlHrefs['edit']?>';href+=href.indexOf('?')!=-1?'&id='+id:'?id='+id;$(that.dialog).dialog({title:'修改工商注册代理机构',iconCls:iconClsDefs.edit,width:<?=$loginMobile?"'90%'":600?>,height:'95%',cache:false,href:href,modal:true,collapsible:false,minimizable:false,resizable:false,maximizable:false,buttons:[{text:'确定',iconCls:iconClsDefs.ok,handler:function(){$(that.dialog).find('form').eq(0).form('submit',{url:href,iframe:false,onSubmit:function(){var isValid=$(this).form('validate');if(!isValid)return false;$.messager.progress({text:'处理中，请稍候...'});return true;},success:function(data){var res=eval('('+data+')');$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg,'info');$(that.dialog).dialog('close');that.reload();}}});}},{text:'取消',iconCls:iconClsDefs.cancel,handler:function(){$(that.dialog).dialog('close');}}]});$(that.dialog).dialog('center');},delete:function(id){var that=this;var href='<?=$urlHrefs['delete']?>';href+=href.indexOf('?')!=-1?'&id='+id:'?id='+id;$.messager.confirm('提示','确认删除吗?',function(result){if(!result)return false;$.messager.progress({text:'处理中，请稍候...'});$.post(href,{},function(res){$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg,'info');that.reload();}},'json');});}};var options=<?=json_encode($datagrid['options'])?>;for(var key in options){if(key=='toolbar'){options[key]=businessRegProxyModule.toolbar;}}
$('#businessRegProxyDatagrid').datagrid(options);</script>