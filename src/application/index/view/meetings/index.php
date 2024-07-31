<?php
use app\index\logic\Meeting;
?>
<table id="<?=DATAGRID_ID?>" class="easyui-datagrid" data-options="
    nowrap:false,
    striped:true,
    rownumbers:true,
    autoRowHeight:true,
    singleSelect:true,
    url:'<?=$bind['urls']['list']?>',
    pagination:true,
    pageSize:<?=DEFAULT_PAGE_ROWS?>,
    pageList:[10,20,30,50,80,100],
    fit:true,
    fitColumns:<?=$loginMobile?'false':'true'?>,
    onLoadSuccess:<?=JVAR?>.convert,
    border:false">
    <thead>
    <tr>
        <th data-options="field:'opt',width:100,align:'center'">操作</th>
        <th data-options="field:'title',width:300">会议主题</th>
        <th data-options="field:'type',width:100">会议类型</th>
        <th data-options="field:'relate_item',width:200">项目(投资)</th>
        <th data-options="field:'status',width:100">会议状态</th>
        <th data-options="field:'date_start',width:150">开始时间</th>
        <th data-options="field:'description',width:500">会议内容</th>
    </tr>
    </thead>
</table>
<script type="text/javascript">
var <?=JVAR?> = {
    datagrid:'#<?=DATAGRID_ID?>',
    dialog:'#globel-dialog-div',
    convert:function(data){
        var that = <?=JVAR?>;
        $.each(data.rows, function(i,v){
            var optBtns = [];
            if(v.status == <?=Meeting::STATUS_PLANNED?> || v.status == <?=Meeting::STATUS_IN_PROGRESS?>){
                optBtns.push('<a href="javascript:void(0)" class="btn btn-outline-info size-MINI radius my-1" onclick="<?=JVAR?>.feedback(' + v.id + ')"><i class="fa fa-comment">反馈</i></a>');
            }
            optBtns.push('<a href="javascript:void(0)" class="btn btn-outline-info size-MINI radius my-1" onclick="<?=JVAR?>.view(' + v.id + ')"><i class="fa fa-eye">查看</i></a>');
            $(that.datagrid).datagrid('updateRow',{
                index: i,
                row: {
                    opt:optBtns.join(' '),
                    type:<?=json_encode(Meeting::TYPES_HTML)?>[v.type],
                    status:<?=json_encode(Meeting::STATUS_HTML)?>[v.status]
                }
            });
        });
    },
    reload:function(){
        $(this.datagrid).datagrid('reload');
    },
    load:function(){
        $(this.datagrid).datagrid('load');
    },
    feedback:function(id){
        var url = '<?=url('index/Meetings/feedback')?>';
        url = GLOBAL.func.addUrlParam(url, 'meeting_id', id);
        url = GLOBAL.func.addUrlParam(url, 'callback', "<?=JVAR?>.onFeedbackAfter()");
        QT.helper.view({
            title:"会议反馈",
            href:url,
            iconCls:'fa fa-comment'
        });
    },
    onFeedbackAfter:function(){
        $('#qt-helper-dialog').dialog('close');
        <?=JVAR?>.reload();
    },
    view:function(id){
        var url = '<?=url('index/Meetings/view')?>';
        url = GLOBAL.func.addUrlParam(url, 'meeting_id', id);
        QT.helper.view({
            title:"会议详情",
            href:url,
            iconCls:'fa fa-eye'
        });
    }
};
</script>