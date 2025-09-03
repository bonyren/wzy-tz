<?php
use app\common\CommonDefs;
?>
<table id="<?=DATAGRID_ID?>" class="easyui-datagrid" data-options="
    striped:true,
    nowrap:false,
    rownumbers:true,
    autoRowHeight:true,
    singleSelect:true,
    url:'<?=$urls['list']?>',
    toolbar:'#<?=TOOLBAR_ID?>',
    pagination:true,
    pageSize:<?=DEFAULT_PAGE_ROWS?>,
    pageList:[10,20,30,50,80,100],
    fit:true,
    fitColumns:<?=$loginMobile?'false':'true'?>,
    onDblClickRow:function(idx,row){QT.helper.view({url:'<?=url('contacts/view')?>?id='+row.id, width:<?=$loginMobile?"'90%'":900?>})},
    onLoadSuccess:<?=JVAR?>.convert,
    border:false">
    <thead>
    <tr>
        <th data-options="field:'btns',width:160">操作</th>
        <th data-options="field:'name',width:80">姓名</th>
        <th data-options="field:'enterprise',width:200">项目</th>
        <th data-options="field:'tags',width:150">标签</th>
        <th data-options="field:'description',width:400">背景</th>
    </tr>
    </thead>
</table>
<div id="<?=TOOLBAR_ID?>" class="p-1">
    <form id="F<?=UNIQID?>">
        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="onClick:function(){ <?=JVAR?>.edit(0); },iconCls:'fa fa-plus-circle'">添加联系人</a>
        <div class="line my-1"></div>
        姓名<input name="search[name]" class="easyui-textbox" data-options="width:200">
        <a class="easyui-linkbutton" data-options="iconCls:'fa fa-search',onClick:function(){<?=JVAR?>.search();}">搜索</a>
        <a class="easyui-linkbutton" data-options="iconCls:'fa fa-reply',onClick:function(){<?=JVAR?>.reset();}">重置</a>
        <span class="ml-1">
            <input class="easyui-checkbox" type="checkbox" name="search[mine]" value="1" data-options="label:'与我相关',labelPosition:'after',onChange:<?=JVAR?>.search">
        </span>
    </form>

</div>
<script>
var <?=JVAR?>={datagrid:'#<?=DATAGRID_ID?>',toolbar:'#<?=TOOLBAR_ID?>',convert:function(data){if(!data.rows.length){return;}
var that=<?=JVAR?>,records=[];$.each(data.rows,function(i,v){records.push(v.id);});$.post('<?=$urls['show_tags']?>',{record_id:records},function(tags){$.each(data.rows,function(i,v){var btns=[];<?php  if($loginUserMenuPriv==CommonDefs::AUTHORIZE_READ_WRITE_TYPE){?>btns.push('<a href="javascript:void(0);" class="btn btn-outline-info size-MINI radius my-1" onclick="QT.helper.view({url:\'<?=url('contacts/view')?>?id='+v.id+'\'})" title="查看"><i class="fa fa-eye"></i>查看</a>');btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="<?=JVAR?>.edit('+v.id+')" title="编辑"><i class="fa fa-pencil-square-o">编辑</i></a>');btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="<?=JVAR?>.remove('+v.id+')" title="删除"><i class="fa fa-trash-o">删除</i></a>');btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="<?=JVAR?>.password('+v.id+',\''+GLOBAL.func.htmlEncode(v.name)+'\')" title="帐号密码"><i class="fa fa-key">帐号密码</i></a>');<?php }else if($loginUserMenuPriv==CommonDefs::AUTHORIZE_READ_ONLY_TYPE){?>btns.push('<a href="javascript:void(0);" class="btn btn-outline-info size-MINI radius my-1" onclick="QT.helper.view({url:\'<?=url('contacts/view')?>?id='+v.id+'\'})" title="查看"><i class="fa fa-eye"></i>查看</a>');<?php }?>$(that.datagrid).datagrid('updateRow',{index:i,row:{name:v.gender?(v.name+' '+v.gender):v.name,enterprise:(v.enterprise_id in data.enterprise)?data.enterprise[v.enterprise_id]:'',description:v.description?'<div class="desc-limiter">'+v.description+'</div>':'',tags:typeof tags[v.id]=="undefined"?'':tags[v.id],btns:btns.join(' ')}});});},'json');},search:function(){var that=<?=JVAR?>,data={};var params=$(that.toolbar).children('form').serializeArray();$.each(params,function(){data[this['name']]=this['value'];});$(that.datagrid).datagrid('load',data);},reset:function(){var that=this;$(that.toolbar).find('.easyui-textbox').textbox('clear');$(that.toolbar).find('.easyui-checkbox').checkbox('reset');$(that.datagrid).datagrid('load',{});},reload:function(){$(this.datagrid).datagrid('reload');},edit:function(id){var that=this,href='<?=$urls['edit']?>?id='+(id?id:'');QT.helper.dialog(id?'编辑':'添加',href,true,function(){that.reload();},<?=$loginMobile?"'90%'":900?>);},remove:function(id){var that=this;$.messager.confirm('提示','确认删除吗?',function(result){if(!result)return false;$.messager.progress({text:'处理中，请稍候...'});$.post('<?=$urls['delete']?>',{id:id},function(res){$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg,'info');that.reload();}},'json');});},password:function(id,name){var that=this;var href='<?=url('contacts/password')?>?id='+id;QT.helper.dialog('设置登录帐号（'+name+'）',href,true,function($dialog){var $form=$('#contact-password-form');if(!$form.form('validate')){return false;}
$.messager.progress({text:'处理中，请稍候...'});$.post(href,$form.serialize(),function(res){$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg);$dialog.dialog('close');}},'json');},<?=$loginMobile?"'90%'":900?>,520);}};</script>