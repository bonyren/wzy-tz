<table id="fundsFinanceSyncFlowDatagrid" class="easyui-datagrid" data-options="striped:true,
    nowrap:false,
    rownumbers:true,
    autoRowHeight:true,
    singleSelect:true,
    url:'<?=$urlHrefs['fundsFinanceSyncFlow']?>',
    method:'post',
    toolbar:'#fundsFinanceSyncFlowToolbar',
    pagination:true,
    pageSize:<?=DEFAULT_PAGE_ROWS?>,
    pageList:[10,20,30,50,80,100],
    border:false,
    fit:true,
    fitColumns:<?=$loginMobile?'false':'true'?>,
    title:'',
    onDblClickRow:function(index, row){
        //fundsFinanceSyncFlowModule.view(row.id);
    },
    rowStyler:fundsFinanceSyncFlowModule.rowStyler
    ">
    <thead>
    <tr>
        <?php if(!$readOnly){ ?>
            <th data-options="field:'operate',width:100,fixed:true,align:'center',formatter:fundsFinanceSyncFlowModule.operate">操作</th>
        <?php } ?>
        <th data-options="field:'serial_number',width:100,align:'center'">交易流水号</th>
        <th data-options="field:'entry_date',width:50,align:'center'">记账日期</th>
        <th data-options="field:'entry_amount',width:50,align:'center',formatter:GLOBAL.func.moneyFormat">入账金额</th>
        <th data-options="field:'entry_type',width:50,align:'center',formatter:fundsFinanceSyncFlowModule.formatEntryType">类型</th>
        <th data-options="field:'entry_summary',width:100,align:'center'">摘要</th>
    </tr>
    </thead>
</table>
<div id="fundsFinanceSyncFlowToolbar" class="p-1">
    <div>
        <?php if(!$readOnly){ ?>
            <a href="#" class="easyui-linkbutton" data-options="onClick:function(){ fundsFinanceSyncFlowModule.add(); },iconCls:iconClsDefs.add">添加流水</a>
        <?php } ?>
    </div>
    <div class="line my-1"></div>
</div>
<script>
    var fundsFinanceSyncFlowModule = {
        dialog:'#globel-dialog2-div',
        dialog2: '#globel-dialog2-div',
        datagrid:'#fundsFinanceSyncFlowDatagrid',
        operate:function(val, row){
            var btns = [];
            btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsFinanceSyncFlowModule.edit(' + row.fff_id + ')" title="编辑"><i class="fa fa-pencil-square-o fa-lg"></i></a>');
            btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsFinanceSyncFlowModule.delete(' + row.fff_id + ')" title="删除"><i class="fa fa-trash-o fa-lg"></i></a>');
            return btns.join(' ');
        },
        reload:function(){
            $(this.datagrid).datagrid('reload');
        },
        load:function(){
            $(this.datagrid).datagrid('load');
        },
        reset:function(){
            var that = this;
            var queryParams = $(that.datagrid).datagrid('options').queryParams;
            for(var key in queryParams){
                delete queryParams[key];
            }
            that.load();
        },
        rowStyler:function(index, row){
        },
        formatEntryType:function(val){
            return <?=json_encode(\app\index\logic\Defs::$fundBankSyncFlowTypeHtmlDefs)?>[val];
        },
        add:function(){
            var that = this;
            var href = '<?=$urlHrefs['fundsFinanceSyncFlowAdd']?>';
            $(that.dialog).dialog({
                title: '添加流水',
                iconCls: iconClsDefs.add,
                width: '50%',
                height: '80%',
                cache: false,
                href: href,
                modal: true,
                collapsible: false,
                minimizable: false,
                resizable: false,
                maximizable: false,
                buttons:[{
                    text:'确定',
                    iconCls:iconClsDefs.ok,
                    handler: function(){
                        $(that.dialog).find('form').eq(0).form('submit', {
                            onSubmit: function(){
                                var isValid = $(this).form('validate');
                                if (!isValid) return false;
                                $.messager.progress({text:'处理中，请稍候...'});
                                $.post(href, $(this).serialize(), function(res){
                                    $.messager.progress('close');
                                    if(!res.code){
                                        $.app.method.alertError(null, res.msg);
                                    }else{
                                        $.app.method.tip('提示', res.msg, 'info');
                                        $(that.dialog).dialog('close');
                                        that.reload();
                                    }
                                }, 'json');
                                return false;
                            }
                        });
                    }
                },{
                    text:'取消',
                    iconCls:iconClsDefs.cancel,
                    handler: function(){
                        $(that.dialog).dialog('close');
                    }
                }]
            });
            $(that.dialog).dialog('center');
        },
        edit:function(fffId){
            var that = this;
            var href = '<?=$urlHrefs['fundsFinanceSyncFlowEdit']?>';
            href += href.indexOf('?') != -1 ? '&fffId=' + fffId : '?fffId='+fffId;
            $(that.dialog).dialog({
                title: '修改流水',
                iconCls: iconClsDefs.edit,
                width: '50%',
                height: '100%',
                cache: false,
                href: href,
                modal: true,
                collapsible: false,
                minimizable: false,
                resizable: false,
                maximizable: false,
                buttons:[{
                    text:'确定',
                    iconCls:iconClsDefs.ok,
                    handler: function(){
                        $(that.dialog).find('form').eq(0).form('submit', {
                            onSubmit: function(){
                                var isValid = $(this).form('validate');
                                if (!isValid) return false;
                                $.messager.progress({text:'处理中，请稍候...'});
                                $.post(href, $(this).serialize(), function(res){
                                    $.messager.progress('close');
                                    if(!res.code){
                                        $.app.method.alertError(null, res.msg);
                                    }else{
                                        $.app.method.tip('提示', res.msg, 'info');
                                        $(that.dialog).dialog('close');
                                        that.reload();
                                    }
                                }, 'json');
                                return false;
                            }
                        });
                    }
                },{
                    text:'取消',
                    iconCls:iconClsDefs.cancel,
                    handler: function(){
                        $(that.dialog).dialog('close');
                    }
                }]
            });
            $(that.dialog).dialog('center');
        },
        delete:function(fffId){
            var that = this;
            var href = '<?=$urlHrefs['fundsFinanceSyncFlowDelete']?>';
            href += href.indexOf('?') != -1 ? '&fffId=' + fffId : '?fffId='+fffId;
            $.messager.confirm('提示', '确认删除吗?', function(result){
                if(!result) return false;
                $.messager.progress({text:'处理中，请稍候...'});
                $.post(href, {}, function(res){
                    $.messager.progress('close');
                    if(!res.code){
                        $.app.method.alertError(null, res.msg);
                    }else{
                        $.app.method.tip('提示', res.msg, 'info');
                        that.reload();
                    }
                }, 'json');
            });
        }
    };
</script>