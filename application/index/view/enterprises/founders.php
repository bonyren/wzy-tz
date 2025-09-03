<?php
use app\index\controller\Upload;
?>
<div class="easyui-layout" data-options="fit:true">
    <div data-options="region:'north',title:'团队成员',border:false" style="height:50%;border-bottom:1px solid #95B8E7">
        <table id="<?=DATAGRID_ID?>" class="easyui-datagrid" data-options="striped:true,
            nowrap:false,
            rownumbers:true,
            singleSelect:true,
            url:'<?=url('enterprises/founders',['enterprise_id'=>$enterprise_id])?>',
            toolbar:'#<?=TOOLBAR_ID?>',
            fit:true,
            fitColumns:<?=$loginMobile?'false':'true'?>,
            onDblClickRow:function(idx,row){QT.helper.view({url:'<?=url('contacts/view')?>?id='+row.contact_id,width:650,height:500})},
            onLoadSuccess:<?=JVAR?>.convert,
            border:false">
            <thead>
            <tr>
                <?php if (!$readonly): ?>
                <th data-options="field:'btns',width:60">操作</th>
                <?php endif; ?>
                <th data-options="field:'name',width:80">姓名</th>
                <th data-options="field:'title',width:100">职务</th>
                <th data-options="field:'tags',width:150">标签</th>
                <th data-options="field:'description',width:300">背景</th>
                <th data-options="field:'files',width:300,align:'left'">附件</th>
            </tr>
            </thead>
        </table>
        <?php if (!$readonly): ?>
        <div id="<?=TOOLBAR_ID?>" class="p-1">
            <div>
                <a href="javascript:void(0)" class="easyui-linkbutton" data-options="onClick:function(){<?=JVAR?>.edit(0);},iconCls:'fa fa-plus'">新增</a>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <div data-options="
        href:'<?=url('index/upload/'.($readonly?'viewAttaches':'attaches'),['attachmentType'=>21,'externalId'=>$enterprise_id,'uiStyle'=>Upload::ATTACHES_UI_DATAGRID_STYLE,'fit'=>true])?>',
        region:'center',
        title:'团队资料',
        border:false"></div>
</div>
<script>
var <?=JVAR?>={datagrid:'#<?=DATAGRID_ID?>',toolbar:'#<?=TOOLBAR_ID?>',convert:function(data){var that=<?=JVAR?>,records=[];$.each(data.rows,function(i,v){records.push(v.contact_id);$.get('<?=url('index/Upload/viewAttaches')?>',{attachmentType:8,externalId:v.contact_id,uiStyle:'<?=\app\index\controller\Upload::ATTACHES_UI_LINK_STYLE?>'},function(res){$(that.datagrid).datagrid('updateRow',{index:i,row:{files:res}});});});$.post('<?=$tag_url?>',{record_id:records},function(tags){$.each(data.rows,function(i,v){var btns=[];btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="<?=JVAR?>.edit('+v.contact_id+')" title="编辑"><i class="fa fa-pencil-square-o fa-lg"></i></a>');btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="<?=JVAR?>.remove('+v.id+')" title="删除"><i class="fa fa-trash-o fa-lg"></i></a>');$(that.datagrid).datagrid('updateRow',{index:i,row:{tags:typeof tags[v.contact_id]=="undefined"?'':tags[v.contact_id],description:v.description?'<div class="desc-limiter">'+v.description+'</div>':'',btns:btns.join(' ')}});});},'json');},reload:function(){$(this.datagrid).datagrid('reload');},search:function(){var that=this,data={};var params=$(that.toolbar).children('form').serializeArray()
$.each(params,function(){data[this['name']]=this['value'];});$(that.datagrid).datagrid('load',data);},reset:function(){var that=this;$(that.toolbar).find('.easyui-textbox').textbox('clear');$(that.datagrid).datagrid('load',{});},edit:function(id){var that=this,href='<?=url('Contacts/edit')?>?enterprise_id=<?=$enterprise_id?>&id='+id;QT.helper.dialog('团队成员',href,true,function(){that.reload();},900,"90%");},remove:function(id){var that=this;var url='<?=url('enterprises/founderRemove')?>';$.messager.confirm('提示','确认从创始团队中删除该成员吗?',function(result){if(!result)return false;$.messager.progress({text:'处理中，请稍候...'});$.post(url,{id:id},function(res){$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg,'info');that.reload();}},'json');});}};</script>