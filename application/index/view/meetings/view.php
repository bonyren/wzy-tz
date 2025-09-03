<?php
use app\index\logic\Meeting as MeetingLogic;
?>
<table class="table-form" cellpadding="5" style="height: 300px;">
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
        <td><?=MeetingLogic::STATUS_HTML[$meeting['status']]?></td>
    </tr>
    <tr>
        <td class="field-label">反馈意见</td>
        <td><?=$meeting['feedback']?></td>
    </tr>
</table>
<div style="height: calc(100% - 310px);">
    <div class="easyui-tabs" border="false" fit="true">
        <div title="会议资料" href="<?php echo url('upload/viewAttaches',[
                'attachmentType'=>28,
                'externalId'=>$meeting['relate_id'],
                'externalId2'=>$meeting['id'],
                'uiStyle'=>\app\index\controller\Upload::ATTACHES_UI_DATAGRID_STYLE]);?>">
        </div>
    </div>
</div>