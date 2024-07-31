<?php
use app\common\CommonDefs;
?>
<table id="fundsExitDatagrid" class="easyui-datagrid" data-options="striped:true,
    nowrap:false,
    rownumbers:true,
    autoRowHeight:true,
    singleSelect:true,
    url:'<?=$urlHrefs['fundsExit']?>',
    method:'post',
    toolbar:'#fundsExitToolbar',
    pagination:true,
    pageSize:<?=DEFAULT_PAGE_ROWS?>,
    pageList:[10,20,30,50,80,100],
    border:false,
    fit:true,
    fitColumns:<?=$loginMobile?'false':'true'?>,
    title:'',
    onDblClickRow:function(index, row){
        fundsExitModule.view(row.fund_id, row.name);
    }
    ">
    <thead>
    <tr>
        <th data-options="field:'operate',width:120,fixed:true,align:'center',formatter:fundsExitModule.operate">操作</th>
        <th data-options="field:'name',width:200,align:'center'">基金名</th>
        <th data-options="field:'size',width:100,align:'center'">总规模(元)</th>
        <th data-options="field:'actual_size',width:100,align:'center',formatter:GLOBAL.func.moneyFormat">认缴规模(元)</th>
        <th data-options="field:'actual_paid_size',width:100,align:'center',formatter:GLOBAL.func.moneyFormat">实缴规模(元)</th>
        <th data-options="field:'establish_date',width:100,align:'center',formatter:GLOBAL.func.dateFilter">成立日期</th>
        <th data-options="field:'status',align:'center',formatter:fundsExitModule.formatStatus">状态</th>
    </tr>
    </thead>
</table>
<div id="fundsExitToolbar" class="p-1">
    <form id="fundsExitToolbarForm">
        基金名: <input id="fundsExitToolbarFormSearchbox" name="search[name]" class="easyui-textbox"
                    data-options="width:160" />
        <a class="easyui-linkbutton" data-options="iconCls:'fa fa-search',
                    onClick:function(){ fundsExitModule.search(); }">搜索
        </a>
        <a class="easyui-linkbutton" data-options="iconCls:'fa fa-reply',
                    onClick:function(){ fundsExitModule.reset(); }">重置
        </a>
    </form>
</div>
<script>
    var fundsExitModule = {
        dialog:'#globel-dialog-div',
        datagrid:'#fundsExitDatagrid',
        operate:function(val, row){
            var btns = [];
            <?php if($loginUserMenuPriv == CommonDefs::AUTHORIZE_READ_WRITE_TYPE){ ?>
            btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsExitModule.backManage(' + row.fund_id + ',\'' + GLOBAL.func.escapeChar(row.name) + '\')" title="返回管理"><i class="fa fa-arrow-up">返回管理</i></a>');
            <?php }else if($loginUserMenuPriv == CommonDefs::AUTHORIZE_READ_ONLY_TYPE){ ?>

            <?php } ?>
            return btns.join(' ');
        },
        formatStatus:function(val, row){
            var statusObj = <?=json_encode(\app\index\logic\Funds::$fundStatusHtmlDefs)?>;
            return statusObj[val];
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
            $.each($("#fundsExitToolbarForm").serializeArray(), function() {
                delete queryParams[this['name']];
            });
            $.each($("#fundsExitToolbarForm").serializeArray(), function() {
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
        view:function(fundId, name){
            var that = this;
            var href = '<?=$urlHrefs['fundsView']?>';
            href += href.indexOf('?') != -1 ? '&fundId=' + fundId : '?fundId='+fundId;
            fundsCommonModule.view(href, name + ' - 基金查看');
        },
        backManage:function(fundId, name){
            var that = this;
            $.messager.confirm('提示', '确认[' + name + ']返回管理阶段吗?', function(result){
                if(!result) return false;
                $.messager.progress({text:'处理中，请稍候...'});
                $.post('<?=url('index/Funds/changeStatus')?>', {
                        fundId:fundId,
                        fromStatus:<?=\app\index\logic\Funds::FUND_EXIT_STATUS?>,
                        toStatus:<?=\app\index\logic\Funds::FUND_MANAGE_STATUS?>
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