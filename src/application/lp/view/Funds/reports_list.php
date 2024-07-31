<?php
use app\index\logic\ChangeLogs;
?>
<script type="text/javascript" src="/static/js/funds.js?<?=STATIC_VER?>"></script>
<table id="fundsDatagrid" class="easyui-datagrid" data-options="striped:true,
    nowrap:false,
    rownumbers:true,
    autoRowHeight:true,
    singleSelect:true,
    url:'<?=$_request_url?>',
    method:'post',
    toolbar:'#fundsToolbar',
    pagination:true,
    pageSize:<?=DEFAULT_PAGE_ROWS?>,
    border:false,
    fit:true,
    fitColumns:<?=$loginMobile?'false':'true'?>,
    onLoadSuccess:function(data){
        $.each(data.rows, function(i, row){
            $('#collect-progressbar-' + i).progressbar();
            $('#invest-progressbar-' + i).progressbar();
        });
    }
    ">
    <thead>
    <tr>
        <th data-options="field:'operate',width:85,fixed:true,align:'center',formatter:fundsModule.operate">操作</th>
        <th data-options="field:'name',width:300">基金名</th>
        <?php if (!$isMobile): ?>
        <th data-options="field:'actual_size',width:150,formatter:GLOBAL.func.moneyFormat">认缴规模(元)</th>
        <th data-options="field:'actual_paid_size',width:150,formatter:GLOBAL.func.moneyFormat">实缴规模(元)</th>
        <th data-options="field:'collect_progress_value',fixed:true,width:80,align:'center',formatter:fundsModule.formatCollectProgressBar">募集进度</th>
        <th data-options="field:'invest_size',width:150,align:'center',formatter:GLOBAL.func.moneyFormat">投资金额(元)</th>
        <th data-options="field:'invest_progress_value',fixed:true,width:80,align:'center',formatter:fundsModule.formatInvestProgressBar">投资进度</th>
        <th data-options="field:'establish_date',width:100,align:'center',formatter:GLOBAL.func.dateFilter">成立日期</th>
        <?php endif; ?>
    </tr>
    </thead>
</table>
<script>
var fundsModule = {
    dialog:'#globel-dialog-div',
    datagrid:'#fundsDatagrid',
    isMoble:<?=$isMobile ? 'true' : 'false'?>,
    operate:function(val, row){
        var btns = [];
        btns.push('<a href="javascript:void(0);" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsModule.view(' + row.fund_id + ',\'' + GLOBAL.func.escapeChar(row.name) + '\')" title="点击查看"><i class="fa fa-files-o"> 查看报告</i></a>');
        return btns.join(' ');
    },
    formatCollectProgressBar:function(val, row, index){
        return '<div id="collect-progressbar-' + index + '" class="easyui-progressbar" data-options="value:'+val+'"></div>';
    },
    formatInvestProgressBar:function(val, row, index){
        return '<div id="invest-progressbar-' + index + '" class="easyui-progressbar" data-options="value:'+val+'"></div>';
    },
    reload:function(){
        $(this.datagrid).datagrid('reload');
    },
    load:function(){
        $(this.datagrid).datagrid('load');
    },
    search:function(){
        var that = this;
        var queryParams = $(that.datagrid).datagrid('options').queryParams;
        //reset the query parameter
        $.each($("#fundsToolbarForm").serializeArray(), function() {
            delete queryParams[this['name']];
        });
        $.each($("#fundsToolbarForm").serializeArray(), function() {
            queryParams[this['name']] = this['value'];
        });
        that.load();
    },
    reset:function(){
        var that = this;
        $("#fundsToolbarForm").form('reset');
        var queryParams = $(that.datagrid).datagrid('options').queryParams;
        for(var key in queryParams){
            delete queryParams[key];
        }
        that.load();
    },
    view:function(fundId, name){
        var that = this;
        /*
        if (that.isMoble) {
            return $.messager.alert('提示','暂不支持手机端查看','warning');
        }*/
        var href = '<?=url('index/changeLogs/index')?>?readOnly=1&category=<?=ChangeLogs::CHANGE_LOG_FUND_MANAGE_REPORT_CATEGORY?>&externalId='+fundId;
        fundsCommonModule.view(href, name + ' - 基金报告');
    }
};
</script>