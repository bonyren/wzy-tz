<?php
use app\common\CommonDefs;
?>
<script type="text/javascript" src="/static/js/funds.js?<?=STATIC_VER?>"></script>
<table id="fundsDatagrid" class="easyui-datagrid" data-options="striped:true,
    nowrap:false,
    rownumbers:true,
    autoRowHeight:true,
    singleSelect:true,
    <?php if(!empty($_GET['multiple'])) { ?>
    selectOnCheck:false,
    checkOnSelect:false,
    <?php } ?>
    url:'<?=$urlHrefs['funds']?>',
    method:'post',
    toolbar:'#fundsToolbar',
    pagination:true,
    pageSize:<?=DEFAULT_PAGE_ROWS?>,
    pageList:[10,20,30,50,80,100],
    border:false,
    fit:true,
    fitColumns:<?=$loginMobile?'false':'true'?>,
    <?php if(empty($_GET['dialog_call'])) { ?>
    onDblClickRow:function(index, row){
        fundsModule.view(row.fund_id, row.name);
    },
    <?php } ?>
    onLoadSuccess:function(data){
        $.each(data.rows, function(i, row){
            $('#collect-progressbar-' + i).progressbar();
            $('#invest-progressbar-' + i).progressbar();
        });
    }
    ">
    <thead>
    <tr>
        <?php if(!empty($_GET['multiple'])) { ?>
        <th field="ck" checkbox="true"></th>
        <?php } ?>
        <?php if(empty($_GET['dialog_call'])) { ?>
        <th data-options="field:'operate',width:200,fixed:true,align:'center',formatter:fundsModule.operate">操作</th>
        <?php } ?>
        <th data-options="field:'name',width:200">基金名</th>
        <th data-options="field:'actual_size',width:100,formatter:GLOBAL.func.moneyFormat">认缴规模(元)</th>
        <th data-options="field:'actual_paid_size',width:100,formatter:GLOBAL.func.moneyFormat">实缴规模(元)</th>
        <th data-options="field:'collect_progress_value',fixed:true,width:80,align:'center',formatter:fundsModule.formatCollectProgressBar">募集进度</th>
        <th data-options="field:'invest_size',width:100,align:'center',formatter:GLOBAL.func.moneyFormat">投资金额(元)</th>
        <th data-options="field:'invest_progress_value',fixed:true,width:80,align:'center',formatter:fundsModule.formatInvestProgressBar">投资进度</th>

        <th data-options="field:'establish_date',width:100,align:'center',formatter:GLOBAL.func.dateFilter">成立日期</th>
        <th data-options="field:'status',align:'center',formatter:fundsModule.formatStatus">状态</th>
    </tr>
    </thead>
</table>
<div id="fundsToolbar" class="p-1">
    <?php if(empty($_GET['dialog_call'])) { ?>
    <div>
        <a href="#" class="easyui-linkbutton" data-options="onClick:function(){ fundsModule.add(); },iconCls:iconClsDefs.add">添加新基金</a>
    </div>
    <div class="line my-1"></div>
    <?php } ?>
    <form id="fundsToolbarForm">
        基金名: <input id="fundsToolbarFormSearchbox" name="search[name]" class="easyui-textbox"
                    data-options="width:160" />
        <a class="easyui-linkbutton" data-options="iconCls:'fa fa-search',
                    onClick:function(){ fundsModule.search(); }">搜索
        </a>
        <a class="easyui-linkbutton" data-options="iconCls:'fa fa-reply',
                    onClick:function(){ fundsModule.reset(); }">重置
        </a>
    </form>
</div>
<script>
    var fundsModule = {
        dialog:'#globel-dialog-div',
        datagrid:'#fundsDatagrid',
        operate:function(val, row){
            var btns = [];
            <?php if($loginUserMenuPriv == CommonDefs::AUTHORIZE_READ_WRITE_TYPE){ ?>
            btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsModule.view(' + row.fund_id + ',\'' + GLOBAL.func.escapeChar(row.name) + '\')" title="查看"><i class="fa fa-eye">查看</i></a>');
            btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsModule.edit(' + row.fund_id + ',\'' + GLOBAL.func.escapeChar(row.name) + '\')" title="编辑"><i class="fa fa-pencil-square-o">编辑</i></a>');
            btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsModule.progress(' + row.fund_id + ',\'' + GLOBAL.func.escapeChar(row.name) + '\')" title="进展"><i class="fa fa-flag">进展</i></a>');
            btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsModule.delete(' + row.fund_id + ',\'' + GLOBAL.func.escapeChar(row.name) + '\')" title="删除"><i class="fa fa-trash-o">删除</i></a>');
            <?php }else if($loginUserMenuPriv == CommonDefs::AUTHORIZE_READ_ONLY_TYPE){ ?>
            btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsModule.view(' + row.fund_id + ',\'' + GLOBAL.func.escapeChar(row.name) + '\')" title="查看"><i class="fa fa-eye">查看</i></a>');
            <?php } ?>
            return btns.join(' ');
        },
        formatStatus:function(val, row){
            var statusObj = <?=json_encode(\app\index\logic\Funds::$fundStatusHtmlDefs)?>;
            return statusObj[val];
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
        add:function(){
            var that = this;
            var href = '<?=$urlHrefs['fundsAdd']?>';
            fundsCommonModule.add(href, function(){
                that.reload();
            });
        },
        edit:function(fundId, name){
            var that = this;
            var href = '<?=$urlHrefs['fundsEdit']?>';
            href += href.indexOf('?') != -1 ? '&fundId=' + fundId : '?fundId='+fundId;
            fundsCommonModule.edit(href, name + ' - 基金编辑', function(){
                that.reload();
            });
        },
        delete:function(fundId, name){
            var that = this;
            var href = '<?=$urlHrefs['fundsDelete']?>';
            href += href.indexOf('?') != -1 ? '&fundId=' + fundId : '?fundId='+fundId;
            $.messager.confirm('提示', '确认删除[' + name + ']吗?', function(result) {
                if(!result) return false;
                fundsCommonModule.delete(href, function () {
                    that.reload();
                });
            });
        },
        view:function(fundId, name){
            var that = this;
            var href = '<?=$urlHrefs['fundsView']?>';
            href += href.indexOf('?') != -1 ? '&fundId=' + fundId : '?fundId='+fundId;
            fundsCommonModule.view(href, name + ' - 基金查看');
        },
        progress:function(fundId, name){
            var that = this;
            var href = '<?=$urlHrefs['fundsProgress']?>';
            href += href.indexOf('?') != -1 ? '&externalId=' + fundId : '?externalId='+fundId;
            fundsCommonModule.progress(href, name + ' - 基金进展事件');
        }
    };
</script>