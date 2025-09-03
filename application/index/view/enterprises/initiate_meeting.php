<?php
use app\index\logic\Meeting as MeetingLogic;
?>
<form id="F<?=UNIQID?>" style="height:100%">
    <div class="easyui-layout" fit="true" border="false">
        <div data-options="region:'north',border:false,height:200">
            <?php include(APP_PATH . 'index' . DS . 'view' . DS . 'enterprises/meeting_form.php'); ?>
            <input type="hidden" id="meeting_pending_files" name="pending_files">
            <div class="text-center p-2 bg-light">
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icons-other-tick" onclick="<?=JVAR?>.submit()">
                <?=empty($bind['meeting'])?'发起会议':'更新会议'?>
                </a>
            </div>
        </div>
        <div data-options="region:'center',border:false">
            <div class="easyui-tabs" border="false" fit="true">
                <!--################################################################################################-->
                <?php if ($bind['meeting_type'] == MeetingLogic::MEETING_INVEST_DECISION_TYPE): $readonly = true; ?>
                <div title="投资决策八问" style="overflow-x: hidden;">
                    <table class="table-form" cellpadding="5">
                        <?php include(APP_PATH . 'index' . DS . 'view' . DS . 'investment/principle.php'); ?>
                    </table>
                </div>
                <?php endif; ?>
                <!--################################################################################################-->
                <div title="会议资料" href="<?php echo url('upload/attaches',[
                    'attachmentType'=>28,
                    'externalId'=>$bind['meeting']['id'] ? $bind['enterprise_id'] : 0,
                    'externalId2'=>intval($bind['meeting']['id']),
                    'uiStyle'=>\app\index\controller\Upload::ATTACHES_UI_DATAGRID_STYLE]
                );?>&callback=<?=JVAR?>.uploaded"></div>
                <!--################################################################################################-->
                <div title="历史会议" href="<?=url('index/Meetings/index',['filters'=>['relate_id'=>$meeting['relate_id'],'status'=>MeetingLogic::STATUS_ENDED_PASS.','.MeetingLogic::STATUS_ENDED_REJECT]])?>"></div>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
var <?=JVAR?>={pendingFiles:[],uploaded:function(files){<?php  if(!empty($bind['meeting']['id'])):?>return;<?php  endif;?>var that=<?=JVAR?>;$.each(files,function(i,v){that.pendingFiles.push(v.attachment_id);});$('#meeting_pending_files').val(that.pendingFiles.join(','));},submit:function(){var $form=$('#F<?=UNIQID?>');if(!$form.form('validate')){return false;}
$.messager.progress({text:'处理中，请稍候...'});var url='<?=$_request_url?>';<?php  if(!empty($bind['meeting'])){?>url=GLOBAL.func.addUrlParam(url,'meeting_id','<?=$bind['meeting']['id']?>');<?php }?>$.post(url,$form.serialize(),function(res){$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg,'info');$('#qt-helper-dialog').dialog('close');try{var callback=eval('<?=$_GET['callback']?>');console.log(callback,typeof callback);if(typeof callback=='function'){callback();}}catch(e){}}},'json');}};</script>