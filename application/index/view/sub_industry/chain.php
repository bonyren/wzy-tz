<div class="easyui-layout" data-options="fit:true">
    <div data-options="region:'west',minWidth:200" style="width:20%;" class="hide-tree-icon">
        <div style="margin-top:2px;margin-left:2px;height:30px;">
            <a href="javascript:;" class="easyui-linkbutton" iconCls="fa fa-plus-square-o" data-options="plain:true,
                onClick:function(){subIndustryChainModule.add();}">添加
            </a>
            <a href="javascript:;" class="easyui-linkbutton" iconCls="fa fa-pencil-square-o" data-options="plain:true,
                onClick:function(){subIndustryChainModule.edit();}">修改
            </a>
            <a href="javascript:;" class="easyui-linkbutton" iconCls="fa fa-trash-o" data-options="plain:true,
                onClick:function(){subIndustryChainModule.delete();}">删除
            </a>
        </div>
        <div class="easyui-panel" data-options="height:1">
        </div>
        <div id="subIndustryChainTree" class="easyui-tree" data-options="url:'<?=$urlHrefs['subIndustryChain']?>',
            animate:true,
            lines:true,
            border:false,
            formatter:subIndustryChainModule.formatText,
            onClick:function(node){
            },
            onSelect:function(node){
                subIndustryChainModule.onSelected(node);
            },
            onLoadSuccess:function(node,data){
               subIndustryChainModule.init();
            }">
        </div>
    </div>
    <div data-options="region:'center'">
        <table id="subIndustryEnterprisesDatagrid" class="easyui-datagrid" data-options="triped:true,
            nowrap:false,
            rownumbers:true,
            autoRowHeight:true,
            singleSelect:true,
            url:'<?=$urlHrefs['subIndustryChainEnterprises']?>',
            method:'post',
            toolbar:'#subIndustryEnterprisesToolbar',
            pagination:false,
            border:false,
            fit:true,
            fitColumns:<?=$loginMobile?'false':'true'?>
            ">
            <thead>
            <tr>
                <th data-options="field:'op',width:100,align:'center',formatter:subIndustryEnterprisesModule.operate">操作</th>
                <th data-options="field:'name',width:200,align:'center'">企业名称</th>
                <th data-options="field:'chain_position',width:200,align:'center'">产业链位置</th>
            </tr>
            </thead>
        </table>
        <div id="subIndustryEnterprisesToolbar" class="p-1">
            <div>
                <?php echo \app\index\service\View::selector([
                    'value_field'=>'id',
                    'type'=>'callback',
                    'multiple'=>true,
                    'callback'=>'subIndustryEnterprisesModule.add',
                    'btn_text'=>'添加项目',
                    'url' => url('index/Enterprises/index'),
                ]); ?>
                <a href="javascript:;" class="easyui-linkbutton" data-options="iconCls:'fa fa-object-ungroup',onClick:subIndustryChainModule.graph">图谱</a>
            </div>
        </div>
    </div>
</div>
<script>
var subIndustryChainModule={tree:'#subIndustryChainTree',currentSubIndustryChainId:0,graph:function(){QT.helper.view({title:'行业链图谱',dialog:'industries_graph',width:'100%',height:'100%',url:'<?=url('index/SubIndustry/chainGraph')?>?industry_id=<?=$subIndustryId?>',});},formatText:function(node){if(node.enterprise_count==0){return node.text;}else{return node.text+' [<span class="text-success"><strong>'+node.enterprise_count+'</strong></span>]';}},init:function(){var that=subIndustryChainModule;if(that.currentSubIndustryChainId==0){var nodes=$(that.tree).tree('getRoots');var childNodes=$(that.tree).tree('getChildren',nodes[0].target);$(that.tree).tree('select',nodes[0].target);}else{var nodes=$(that.tree).tree('getRoots');var cloneNodes=[].concat(nodes);var node=null;while(node=cloneNodes.shift()){if(node.id==that.currentSubIndustryChainId){$(that.tree).tree('select',node.target);break;}
var childNodes=$(that.tree).tree('getChildren',node.target);childNodes.forEach(function(childNode){cloneNodes.push(childNode);});}}},add:function(){var that=subIndustryChainModule;var parentNode=$(that.tree).tree('getSelected');if(!parentNode){$.app.method.tip('提示信息',"请选择上层节点",'error');return;}
var parentId=parentNode.id;var href='<?=$urlHrefs['subIndustryChainAdd']?>';href+=href.indexOf('?')!=-1?'&parentId='+parentId:'?parentId='+parentId;var prompt=$.messager.prompt({title:'提示',msg:'请输入产业链节点名称:',fn:function(name){if(name===undefined){return;}
$.messager.progress({text:'处理中，请稍候...'});$.post(href,{name:$.trim(name)},function(res){$.messager.progress('close');if(!res.code){$.app.method.tip('提示信息',res.msg,'error');}else{$.app.method.tip('提示信息',res.msg,'info');that.reload();}},'json');}});prompt.find('.messager-input').val('');},edit:function(){var that=subIndustryChainModule;var selectedNode=$(that.tree).tree('getSelected');if(!selectedNode){$.app.method.tip('提示信息',"请选择要修改的节点",'error');return;}
var subIndustryChainId=selectedNode.id;if(subIndustryChainId==0){return;}
var href='<?=$urlHrefs['subIndustryChainUpdate']?>';href+=href.indexOf('?')!=-1?'&subIndustryChainId='+subIndustryChainId:'?subIndustryChainId='+subIndustryChainId;var prompt=$.messager.prompt({title:'提示',msg:'请输入产业链节点名称:',fn:function(name){if(name===undefined){return;}
$.messager.progress({text:'处理中，请稍候...'});$.post(href,{name:$.trim(name)},function(res){$.messager.progress('close');if(!res.code){$.app.method.tip('提示信息',res.msg,'error');}else{$.app.method.tip('提示信息',res.msg,'info');that.reload();}},'json');}});var nameText=selectedNode.text.replace(/\[\d*\]/g,'');prompt.find('.messager-input').val(nameText);},delete:function(){var that=subIndustryChainModule;var selectedNode=$(that.tree).tree('getSelected');if(!selectedNode){$.app.method.tip('提示信息',"请选择要删除的节点",'error');return;}
var subIndustryChainId=selectedNode.id;if(0==subIndustryChainId){$.app.method.tip('提示信息',"不允许删除根节点",'error');return;}
var childNodes=$(that.tree).tree('getChildren',selectedNode.target);if(childNodes.length!=0){$.app.method.tip('提示信息',"请先删除该节点下的子节点",'error');return;}
var href='<?=$urlHrefs['subIndustryChainDelete']?>';href+=href.indexOf('?')!=-1?'&subIndustryChainId='+subIndustryChainId:'?subIndustryChainId='+subIndustryChainId;$.messager.confirm('提示信息','确定要删除吗？',function(result){if(!result)return false;$.messager.progress({text:'处理中，请稍候...'});$.post(href,{},function(res){$.messager.progress('close');if(!res.code){$.app.method.tip('提示信息',res.msg,'error');}else{$.app.method.tip('提示信息',res.msg,'info');that.reload();}},'json');});},reload:function(){var that=subIndustryChainModule;$(that.tree).tree('reload');},onSelected:function(node){var that=subIndustryChainModule;subIndustryChainModule.currentSubIndustryChainId=node.id;subIndustryEnterprisesModule.load(node.id);}};var subIndustryEnterprisesModule={dialog:'#globel-dialog-div',datagrid:'#subIndustryEnterprisesDatagrid',operate:function(val,row){var btns=[];btns.push('<a href="javascript:;" onclick="subIndustryEnterprisesModule.delete('+row.id+')" title="删除">删除</a>');btns.push('<a href="javascript:;" onclick="subIndustryEnterprisesModule.editEnterprise('+row.eid+')" title="编辑企业">编辑企业</a>');return btns.join(' | ');},reload:function(){$(this.datagrid).datagrid('reload');},load:function(subIndustryChainId){$(this.datagrid).datagrid('load',{subIndustryChainId:subIndustryChainId});},add:function(eids){var that=subIndustryEnterprisesModule;if($.trim(eids)==''){return;}
var currentSubIndustryChainId=subIndustryChainModule.currentSubIndustryChainId;if(currentSubIndustryChainId==0){$.app.method.alertWarning(null,'请选择产业链上的节点');return;}
var href='<?=$urlHrefs['subIndustryChainEnterpriseAdd']?>';href+=href.indexOf('?')!=-1?'&subIndustryChainId='+currentSubIndustryChainId:'?subIndustryChainId='+currentSubIndustryChainId;$.messager.progress({text:'处理中，请稍候...'});$.post(href,{eids:eids},function(res){$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg,'info');subIndustryChainModule.reload();}},'json');},delete:function(id){var that=subIndustryEnterprisesModule;var href='<?=$urlHrefs['subIndustryChainEnterpriseDelete']?>';$.messager.confirm('提示信息','确定要删除吗？',function(result){if(!result)return false;$.messager.progress({text:'处理中，请稍候...'});$.post(href,{id:id},function(res){$.messager.progress('close');if(!res.code){$.app.method.tip('提示信息',res.msg,'error');}else{$.app.method.tip('提示信息',res.msg,'info');that.reload();subIndustryChainModule.reload();}},'json');});},editEnterprise:function(eid){var href='<?=url('index/Enterprises/edit')?>?id='+(eid?eid:'');QT.helper.view({url:href,title:'编辑项目',width:'100%',height:'100%',iconCls:iconClsDefs.edit,dialog:'globel-dialog-div'});}};</script>