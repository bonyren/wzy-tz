<?php
use app\common\CommonDefs;
use app\index\logic\Enterprise as EnterpriseLogic;
use app\index\logic\Meeting as MeetingLogic;
?>
<table id="<?=DATAGRID_ID?>" class="easyui-datagrid" data-options="
    striped:true,
    rownumbers:true,
    nowrap:false,
    autoRowHeight:true,
    singleSelect:true,
    <?php if(isset($_GET['dialog_call']) && $_GET['dialog_call'] && isset($_GET['multiple']) && $_GET['multiple']): ?>
    selectOnCheck:false,
    checkOnSelect:false,
    <?php endif; ?>
    url:'<?=$_request_url?>',
    toolbar:'#<?=TOOLBAR_ID?>',
    pagination:true,
    pageSize:<?=DEFAULT_PAGE_ROWS?>,
    pageList:[10,20,30,50,80,100],
    fit:true,
    fitColumns:<?=$loginMobile?'false':'true'?>,
    onDblClickRow:function(idx,row){QT.helper.view({url:'<?=url('enterprises/view')?>?id='+row.id,width:'100%',height:'100%',dialog:'globel-dialog-div'})},
    onLoadSuccess:EnterpriseModule.convert,
    border:false">
    <thead>
    <tr>
        <?php if(isset($_GET['dialog_call']) && $_GET['dialog_call'] && isset($_GET['multiple']) && $_GET['multiple']): ?>
        <th field="ck" checkbox="true"></th>
        <?php endif; ?>
        <?php if(!isset($_GET['dialog_call']) || !$_GET['dialog_call']): ?>
        <th data-options="field:'btns',width:200">操作</th>
        <?php if($step){ ?>
        <th data-options="field:'btns_flow',width:200">流程控制</th>
        <?php } ?>
        <?php endif; ?>
        <th data-options="field:'name',width:250">企业名称</th>
        <th data-options="field:'founder',width:100">创始人</th>
        <th data-options="field:'description',width:500">公司简介</th>
        <th data-options="field:'assigner',width:120">跟进人</th>
        <th data-options="field:'date_created',width:135">录入时间</th>
        <th data-options="field:'step',width:135">业务阶段</th>
    </tr>
    </thead>
</table>
<div id="<?=TOOLBAR_ID?>" class="p-1">
    <form>
        <?php if(!isset($_GET['dialog_call']) && (empty($step) || $step==1)): ?>
        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="onClick:function(){EnterpriseModule.add();},iconCls:'fa fa-plus-circle'">添加企业</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="onClick:function(){EnterpriseModule.creditSearch();},iconCls:'fa fa-plus-circle'">快捷添加</a>
        <div class="line my-1"></div>
        <?php endif; ?>
        企业名称<input name="search[name]" class="easyui-textbox" data-options="width:160">
        <a class="easyui-linkbutton" data-options="iconCls:'fa fa-search',onClick:function(){EnterpriseModule.search();}">搜索</a>
        <a class="easyui-linkbutton" data-options="iconCls:'fa fa-reply',onClick:function(){EnterpriseModule.reset();}">重置</a>
        <span class="ml-1">
            <input class="easyui-checkbox" type="checkbox" name="search[mine]" value="1" data-options="label:'与我相关',labelPosition:'after',onChange:EnterpriseModule.search">
        </span>
    </form>
</div>
<script>
var EnterpriseModule={datagrid:'#<?=DATAGRID_ID?>',toolbar:'#<?=TOOLBAR_ID?>',step:<?=intval($step)?>,meetingTypes:<?=json_encode(\app\index\logic\Meeting::TYPES,JSON_UNESCAPED_UNICODE)?>,convert:function(data){var that=EnterpriseModule;$.each(data.rows,function(i,v){var btns=[];var btns_flow=[];<?php  if($loginUserMenuPriv==CommonDefs::AUTHORIZE_READ_WRITE_TYPE){?>btns.push('<a href="javascript:void(0);" class="btn btn-outline-info size-MINI radius my-1" onclick="QT.helper.view({url:\'<?=url('enterprises/view')?>?id='+v.id+'\',width:\'100%\',height:\'100%\',dialog:\'globel-dialog-div\'})" title="查看"><i class="fa fa-eye"></i>查看</a>');btns.push('<a href="javascript:void(0);" class="btn btn-outline-info size-MINI radius my-1" onclick="EnterpriseModule.progress('+v.id+')" title="进展"><i class="fa fa-flag">进展</i></a>');btns.push('<a href="javascript:void(0);" class="btn btn-outline-info size-MINI radius my-1" onclick="EnterpriseModule.edit('+v.id+')" title="编辑"><i class="fa fa-pencil-square-o">编辑</i></a>');if(v.is_follow){btns.push('<a href="javascript:void(0);" class="btn btn-outline-success size-MINI radius my-1" data-action="0" onclick="QT.follow(this,1,'+v.id+')" title="已关注"><i class="fa fa-star">已关注</i></a>');}else{btns.push('<a href="javascript:void(0);" class="btn btn-outline-info size-MINI radius my-1" data-action="1" onclick="QT.follow(this,1,'+v.id+')" title="未关注"><i class="fa fa-star-o">未关注</i></a>');}
if(that.step<<?=EnterpriseLogic::STEP_TOUCH?>){btns.push('<a href="javascript:void(0);" class="btn btn-outline-info size-MINI radius my-1" onclick="EnterpriseModule.remove('+v.id+')" title="删除"><i class="fa fa-trash-o">删除</i></a>');}
if(v.step==<?=EnterpriseLogic::STEP_TOUCH?>){btns_flow.push('<a href="javascript:void(0);" class="btn btn-outline-info size-MINI radius my-1" onclick="EnterpriseModule.goStep('+v.id+',\'forward\')" title="进入分析"><i class="fa fa-arrow-down">进入分析</i></a>');}else if(that.step><?=EnterpriseLogic::STEP_TOUCH?>){btns_flow.push('<a href="javascript:void(0);" class="btn btn-outline-info size-MINI radius my-1" onclick="EnterpriseModule.goStep('+v.id+',\'backward\')" title="退回上一步"><i class="fa fa-arrow-up">退回上一步</i></a>');switch(that.step){case <?=EnterpriseLogic::STEP_LEARN?>:case <?=EnterpriseLogic::STEP_DD?>:var maps={<?=EnterpriseLogic::STEP_LEARN?>:{title:'发起立项会议',titleUpdate:'修改立项会议',titleReopen:'重开立项会议',type:<?=MeetingLogic::MEETING_DD_OPEN_TYPE?>},<?=EnterpriseLogic::STEP_DD?>:{title:'发起投决会议',titleUpdate:'修改投决会议',titleReopen:'重开投决会议',type:<?=MeetingLogic::MEETING_INVEST_DECISION_TYPE?>}};if(v.step_state!='0'){var cls=(v.step_state=='-1')?'text-muted':'text-red';var title=(v.step_state=='-1')?maps[that.step].titleReopen:maps[that.step].titleUpdate;}else{var cls='';var title=maps[that.step].title;}
btns_flow.push('<a href="javascript:void(0);" class="btn btn-outline-info size-MINI radius my-1" '+'onclick="EnterpriseModule.meeting('+v.id+','+maps[that.step].type+')" title="'+title+'">'+'<i class="fa fa-hand-paper-o '+cls+'">'+title+'</i></a>');break;case <?=EnterpriseLogic::STEP_INVESTING?>:var cls=v.step_state!='0'?'text-red':'';btns_flow.push('<a href="javascript:void(0);" class="btn btn-outline-info size-MINI radius my-1" onclick="EnterpriseModule.goStep('+v.id+',\'forward\')" title="进入投后"><i class="fa fa-arrow-down">进入投后</i></a>');btns_flow.push('<a href="javascript:void(0);" class="btn btn-outline-info size-MINI radius my-1" '+'onclick="EnterpriseModule.invest('+v.id+')" title="投资交割">'+'<i class="fa fa-exchange '+cls+'">投资交割</i></a>');break;case <?=EnterpriseLogic::STEP_POST_INVESTED?>:break;}}<?php }else if($loginUserMenuPriv==CommonDefs::AUTHORIZE_READ_ONLY_TYPE){?>btns.push('<a href="javascript:void(0);" class="btn btn-outline-info size-MINI radius my-1" onclick="QT.helper.view({url:\'<?=url('enterprises/view')?>?id='+v.id+'\',width:\'100%\',height:\'100%\',dialog:\'globel-dialog-div\'})" title="查看"><i class="fa fa-eye"></i>查看</a>');<?php }?>var uids=v.assigner.split(',');var assigners=[];$.each(uids,function(_i,_uid){(_uid in data.assigners)?assigners.push(data.assigners[_uid].realname):'';});$(that.datagrid).datagrid('updateRow',{index:i,row:{name:v.alias?v.alias:v.name,founder:(v.founder in data.founders)?'<a href="javascript:void(0)" onclick="QT.helper.view({url:\'<?=url('contacts/view')?>?id='+data.founders[v.founder].id+'\'})">'+data.founders[v.founder].name+'</a>':'',description:'<div class="desc-limiter">'+v.description+'</div>',assigner:assigners.join(','),date_created:v.date_created.substr(0,16),btns:v.editable?btns.join(' '):'---',btns_flow:v.editable?btns_flow.join(' '):'---',step:<?=json_encode(EnterpriseLogic::STEPS_HTML)?>[v.step]}});});},reload:function(){$(EnterpriseModule.datagrid).datagrid('reload');},search:function(){var that=EnterpriseModule,data={};var params=$(that.toolbar).children('form').serializeArray()
$.each(params,function(){data[this['name']]=this['value'];});$(that.datagrid).datagrid('load',data);},reset:function(){var that=this;$(that.toolbar).find('.easyui-textbox').textbox('clear');$(that.toolbar).find('.easyui-checkbox').checkbox('reset');$(that.datagrid).datagrid('load',{});},progress:function(id){var href='<?=url('index/ProgressLogs/light', ['category'=>\app\index\logic\ProgressLogs::PROGRESS_LOG_INVESTED_ACTIVITY_CATEGORY])?>';href=GLOBAL.func.addUrlParam(href,'externalId',id);QT.helper.view({url:href,title:'项目进展',width:<?=$loginMobile?"'90%'":800?>,height:'80%',iconCls:'fa fa-flag',dialog:'enterprise_progress_view'});},creditSearch:function(){var href='<?=url('Enterprises/creditSearch')?>';QT.helper.view({href:href,title:'快捷添加企业',width:<?=$loginMobile?"'90%'":800?>,height:'80%',iconCls:'fa fa-search',});},add:function(params){var that=this;var href='<?=$urls['edit']?>';if(params){if(typeof params=='object'){params=$.param(params);}
href+='?'+params;}
QT.helper.dialog('添加项目',href,true,function($dialog){var $form=$dialog.find('form:eq(0)');if(!$form.form('validate')){return false;}
$.messager.progress({text:'处理中，请稍候...'});$.post(href,$form.serialize(),function(res){$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg);$dialog.dialog('close');that.reload();}},'json');},<?=$loginMobile?"'90%'":"900"?>,"100%",'globel-dialog-div');},edit:function(id){var href='<?=$urls['edit']?>?id='+(id?id:'');QT.helper.view({url:href,title:'编辑项目',width:<?=$loginMobile?"'100%'":"'100%'"?>,height:'100%',iconCls:iconClsDefs.edit,dialog:'globel-dialog-div'});},saveInfos:function(enterprise_id,form_id){var $form=$(form_id);if(!$form.form('validate')){return false;}
var $data=$form.serialize();$.each($('.empty_value'),function(){var $name=$(this).attr('textboxname');if(!$form.find('input[name="'+$name+'"]').length){$data+='&'+encodeURIComponent($name)}});$.messager.progress({text:'处理中，请稍候...'});$.post('<?=url('Enterprises/edit')?>?id='+enterprise_id,$data,function(res){$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg);}},'json');},remove:function(id){var that=this;$.messager.confirm('提示','确认删除吗?',function(result){if(!result)return false;$.messager.progress({text:'处理中，请稍候...'});$.post('<?=$urls['delete']?>',{id:id},function(res){$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg,'info');that.reload();}},'json');});},goStep:function(id,type){var that=this,msgs={forward:'确定进入下个阶段吗？',backward:'确定退回上一步吗？',};$.messager.confirm('提示',msgs[type],function(result){if(!result)return false;$.messager.progress({text:'处理中，请稍候...'});$.post('<?=$urls['gostep']?>',{id:id,type:type},function(res){$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg,'info');that.reload();}},'json');});},meeting:function(enterpriseId,meetingType){var that=this,href='<?=$urls['initiate_meeting']?>?enterprise_id='+enterpriseId+'&meeting_type='+meetingType+'&callback=EnterpriseModule.reload';QT.helper.dialog(that.meetingTypes[meetingType].label,href,false);},invest:function(enterprise_id){var that=this;$.get('<?=url('Investment/getPendingRow')?>',{enterprise_id:enterprise_id},function(res){if(res){QT.helper.view({title:'投资交割',url:'<?=url('Investment/delivery')?>?id='+res,width:'90%',height:'95%',dialog:'investment_delivery'})}else{that.addInvestment(enterprise_id,function(id){QT.helper.view({title:'投资交割',url:'<?=url('Investment/delivery')?>?id='+id,width:'90%',height:'95%',dialog:'investment_delivery'});that.reload();});}},'json');},external:function(source){var $dialog=QT.helper.genDialogId('enterprise-external-dialog');$dialog.dialog({title:'快捷添加',width:<?=$loginMobile?"'90%'":800?>,height:'95%',content:'<iframe style="height:99%;width:100%;border:none" src="<?=url('enterprises/external')?>?source='+source+'"></iframe>',modal:true,border:false,buttons:[{text:'关闭',iconCls:iconClsDefs.cancel,handler:function(){$dialog.dialog('close');}}]});$dialog.dialog('center');},uploadLogo:function(callback){$.app.method.uploadOne('<?=url('Upload/uploadImage')?>',function(obj){console.log(obj);callback&&callback(obj);});},addInvestment:function(enterprise_id,callback){var url='<?=url('Investment/add')?>?enterprise_id='+enterprise_id;QT.helper.dialog('新增投资',url,true,function($dialog){var $form=$dialog.find('form:eq(0)');if(!$form.form('validate')){return false;}
$.messager.progress({text:'处理中，请稍候...'});$.post(url,$form.serialize(),function(res){$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg);$dialog.dialog('close');if(typeof callback=='function'){callback(res.data);}}},'json');},<?=$loginMobile?"'90%'":800?>,"80%",'investment-add');}};</script>