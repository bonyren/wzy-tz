<?php
use app\common\CommonDefs;
?>
<script type="text/javascript" src="/static/js/funds.js?<?=STATIC_VER?>"></script>
<table id="fundsCollectDatagrid" class="easyui-datagrid" data-options="striped:true,
    nowrap:false,
    rownumbers:true,
    autoRowHeight:true,
    singleSelect:true,
    url:'<?=$urlHrefs['fundsCollect']?>',
    method:'post',
    toolbar:'#fundsCollectToolbar',
    pagination:true,
    pageSize:<?=DEFAULT_PAGE_ROWS?>,
    pageList:[10,20,30,50,80,100],
    border:false,
    fit:true,
    fitColumns:<?=$loginMobile?'false':'true'?>,
    title:'',
    onDblClickRow:function(index, row){
        fundsCollectModule.view(row.fund_id, row.name);
    },
    onLoadSuccess:function(data){
        $.each(data.rows, function(i, row){
            $('#collect-progressbar-' + i).progressbar();
        });
    }
    ">
    <thead>
    <tr>
        <th data-options="field:'operate',width:200,fixed:true,align:'center',formatter:fundsCollectModule.operate">操作</th>
        <th data-options="field:'name',width:200,align:'center'">基金名</th>
        <th data-options="field:'size',width:100,align:'center',formatter:GLOBAL.func.moneyFormat">总规模(元)</th>
        <th data-options="field:'actual_size',width:100,align:'center',formatter:GLOBAL.func.moneyFormat">认缴规模(元)</th>
        <th data-options="field:'actual_paid_size',width:100,align:'center',formatter:GLOBAL.func.moneyFormat">实缴规模(元)</th>
        <th data-options="field:'collect_progress_value',fixed:true,width:150,align:'center',formatter:fundsCollectModule.formatCollectProgressBar">募集进度</th>
        <th data-options="field:'progress_log',fixed:true,width:300,align:'center'">最新进展</th>
        <th data-options="field:'establish_date',width:100,align:'center',formatter:GLOBAL.func.dateFilter">成立日期</th>
        <th data-options="field:'status',align:'center',formatter:fundsCollectModule.formatStatus">状态</th>
    </tr>
    </thead>
</table>
<div id="fundsCollectToolbar" class="p-1">
    <div>
        <a href="#" class="easyui-linkbutton" data-options="onClick:function(){ fundsCollectModule.add(); },iconCls:iconClsDefs.add">添加新基金</a>
    </div>
    <div class="line my-1"></div>
    <form id="fundsCollectToolbarForm">
        基金名: <input id="fundsCollectToolbarFormSearchbox" name="search[name]" class="easyui-textbox"
                    data-options="width:160" />
        <a class="easyui-linkbutton" data-options="iconCls:'fa fa-search',
                    onClick:function(){ fundsCollectModule.search(); }">搜索
        </a>
        <a class="easyui-linkbutton" data-options="iconCls:'fa fa-reply',
                    onClick:function(){ fundsCollectModule.reset(); }">重置
        </a>
    </form>
</div>
<script>
    var fundsCollectModule = {
        dialog:'#globel-dialog-div',
        datagrid:'#fundsCollectDatagrid',
        operate:function(val, row){
            var btns = [];
            <?php if($loginUserMenuPriv == CommonDefs::AUTHORIZE_READ_WRITE_TYPE){ ?>
            btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsCollectModule.view(' + row.fund_id + ',\'' + GLOBAL.func.escapeChar(row.name) + '\')" title="查看"><i class="fa fa-eye">查看</i></a>');
            btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsCollectModule.edit(' + row.fund_id + ',\'' + GLOBAL.func.escapeChar(row.name) + '\')" title="编辑"><i class="fa fa-pencil-square-o">编辑</i></a>');
            btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsCollectModule.delete(' + row.fund_id + ',\'' + GLOBAL.func.escapeChar(row.name) + '\')" title="删除"><i class="fa fa-trash-o">删除</i></a>');
            btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsCollectModule.progress(' + row.fund_id + ',\'' + GLOBAL.func.escapeChar(row.name) + '\')" title="进展"><i class="fa fa-flag">进展</i></a>');
            btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsCollectModule.partners(' + row.fund_id + ',\'' + GLOBAL.func.escapeChar(row.name) + '\')" title="合伙人"><i class="fa fa-group">合伙人</i></a>');
            btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsCollectModule.goInvest(' + row.fund_id + ',\'' + GLOBAL.func.escapeChar(row.name) + '\')" title="进入投资"><i class="fa fa-arrow-down">进入投资</i></a>');
            <?php }else if($loginUserMenuPriv == CommonDefs::AUTHORIZE_READ_ONLY_TYPE){ ?>
            btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsCollectModule.view(' + row.fund_id + ',\'' + GLOBAL.func.escapeChar(row.name) + '\')" title="查看"><i class="fa fa-eye">查看</i></a>');
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
            $.each($("#fundsCollectToolbarForm").serializeArray(), function() {
                delete queryParams[this['name']];
            });
            $.each($("#fundsCollectToolbarForm").serializeArray(), function() {
                queryParams[this['name']] = this['value'];
            });
            that.load();
        },
        reset:function(){
            var that = this;
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
            fundsCommonModule.edit(href, name + ' - 基金募集', function(){
                that.reload();
            });
        },
        delete:function(fundId, name){
            var that = this;
            var href = '<?=$urlHrefs['fundsDelete']?>';
            href += href.indexOf('?') != -1 ? '&fundId=' + fundId : '?fundId='+fundId;
            $.messager.confirm('提示', '确认删除[' + name + ']吗?', function(result) {
                if (!result) return false;
                fundsCommonModule.delete(href);
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
        },
        partners:function(fundId, name){
            var that = this;
            var href = '<?=$urlHrefs['fundsPartners']?>';
            href += href.indexOf('?') != -1 ? '&fundId=' + fundId : '?fundId='+fundId;
            $(that.dialog).dialog({
                title: name + ' - 合伙人',
                iconCls: 'fa fa-eye',
                width: '50%',
                height: '100%',
                cache: false,
                href: href,
                modal: true,
                collapsible: false,
                minimizable: false,
                resizable: false,
                maximizable: true,
                buttons:[{
                    text:'关闭',
                    iconCls:iconClsDefs.cancel,
                    handler: function(){
                        $(that.dialog).dialog('close');
                    }
                }]
            });
            $(that.dialog).dialog('center');
        },
        goInvest:function(fundId, name){
            var that = this;
            $.messager.confirm('提示', '确认[' + name + ']募集完成，进如基金投资阶段吗?', function(result){
                if(!result) return false;
                $.messager.progress({text:'处理中，请稍候...'});
                $.post('<?=url('index/Funds/changeStatus')?>', {
                        fundId:fundId,
                        fromStatus:<?=\app\index\logic\Funds::FUND_COLLECT_STATUS?>,
                        toStatus:<?=\app\index\logic\Funds::FUND_INVEST_STATUS?>
                    },
                    function(res){
                        $.messager.progress('close');
                        if(!res.code){
                            $.app.method.alertError(null, res.msg);
                        }else{
                            $.app.method.tip('提示', res.msg, 'info');
                            that.reload();
                        }
                    }, 'json'
                );
            });
        }
    };
</script>