<?php
use app\index\logic\Meeting as MeetingLogic;
?>
<form style="height: 310px;">
    <table class="table-form" cellpadding="5">
        <tr>
            <td width="120" class="field-label">会议名称</td>
            <td><?=$meeting['title']?></td>
        </tr>
        <tr>
            <td class="field-label">会议类型</td>
            <td><?=MeetingLogic::TYPES_HTML[$meeting['type']]?></td>
        </tr>
        <tr>
            <td class="field-label">项目(投资)</td>
            <td><?=$meeting['relate_item']?></td>
        </tr>
        <tr>
            <td class="field-label">开始时间</td>
            <td><?=$meeting['date_start']?></td>
        </tr>
        <tr>
            <td class="field-label">会议内容</td>
            <td><?=$meeting['description']?></td>
        </tr>
        <tr>
            <td class="field-label">反馈结果</td>
            <td>
                <select name="formData[status]" class="easyui-combobox" style="width:120px;"
                        data-options="required:true,editable:false,panelHeight:'auto',value:''">
                    <?php foreach (MeetingLogic::STATUS_DEFS as $k=>$v): ?>
                    <option value="<?=$k?>"><?=$v?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="field-label">反馈意见</td>
            <td>
                <input class="easyui-textbox" multiline="true" name="formData[feedback]" value="<?=$meeting['feedback']?>" style="width:100%;height:50px;">
            </td>
        </tr>
        <tr class="form-tools">
            <td colspan="2" align="center">
                <a href="javascript:void(0)" class="easyui-linkbutton" onclick="meetingFeedback.submit(this)" data-options="iconCls:'icons-other-tick'">提交反馈</a>
            </td>
        </tr>
    </table>
</form>
<div style="height: calc(100% - 310px);">
<div class="easyui-tabs" border="false" fit="true">
    <!--################################################################################################-->
    <?php if ($meeting['type'] == MeetingLogic::MEETING_INVEST_DECISION_TYPE): $readonly = true; ?>
    <div title="投资决策八问" style="overflow-x:hidden;">
        <table class="table-form" cellpadding="5">
            <?php include(APP_PATH . 'index' . DS . 'view' . DS . 'investment/principle.php'); ?>
        </table>
    </div>
    <?php endif; ?>
    <!--################################################################################################-->
    <div title="会议资料" href="<?php echo url('index/Upload/attaches',[
        'attachmentType'=>28,
        'externalId'=>$meeting['relate_id'],
        'externalId2'=>$meeting['id'],
        'uiStyle'=>\app\index\controller\Upload::ATTACHES_UI_DATAGRID_STYLE]
    );?>" cache="false"></div>
    <!--################################################################################################-->
    <div title="历史会议" href="<?=url('index/Meetings/index',['filters'=>['relate_id'=>$meeting['relate_id'],'status'=>MeetingLogic::STATUS_ENDED_PASS.','.MeetingLogic::STATUS_ENDED_REJECT]])?>" cache="false"></div>
</div>
<div>
<script type="text/javascript">
var meetingFeedback={submit:function(that){var $form=$(that).closest('form');if(!$form.form('validate')){return false;}
$.messager.progress({text:'处理中，请稍候...'});$.post('<?=$urls['feedback']?>',$form.serialize(),function(res){$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg,'info');var callback='<?=$_GET['callback']??''?>';if(callback)eval(callback);}},'json');}};</script>