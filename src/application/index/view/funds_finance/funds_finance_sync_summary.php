<table id="fundsFinanceSyncSummaryDatagrid" class="easyui-datagrid" data-options="striped:true,
    nowrap:false,
    rownumbers:true,
    autoRowHeight:true,
    singleSelect:true,
    url:'<?=$urlHrefs['fundsFinanceSyncSummary']?>',
    method:'post',
    toolbar:'#fundsFinanceSyncSummaryToolbar',
    pagination:true,
    pageSize:<?=DEFAULT_PAGE_ROWS?>,
    pageList:[10,20,30,50,80,100],
    border:false,
    fit:true,
    fitColumns:<?=$loginMobile?'false':'true'?>,
    title:'',
    onDblClickRow:function(index, row){
        //fundsFinanceSyncSummaryModule.view(row.id);
    },
    rowStyler:fundsFinanceSyncSummaryModule.rowStyler,
    view: detailview,
    detailFormatter:function(index,row){
        return fundsFinanceSyncSummaryModule.detailFormatter();
    },
    onExpandRow:function(index,row){
        var ddv = $(this).datagrid('getRowDetail',index).find('div.ddv');
        var href = '<?=$urlHrefs['fundsFinanceSyncComposition']?>';
        var ffsId = row.ffs_id;
        href += href.indexOf('?') != -1 ? '&ffsId=' + ffsId : '?ffsId='+ffsId;
        ddv.panel({
            height:120,
            border:false,
            cache:false,
            href:href,
            onLoad:function(){
                $('#fundsFinanceSyncSummaryDatagrid').datagrid('fixDetailRowHeight',index);
            }
        });
        $('#fundsFinanceSyncSummaryDatagrid').datagrid('fixDetailRowHeight',index);
    }
    ">
    <thead>
    <tr>
        <?php if(!$readOnly){ ?>
            <th data-options="field:'operate',width:100,fixed:true,align:'center',formatter:fundsFinanceSyncSummaryModule.operate">操作</th>
        <?php } ?>
        <th data-options="field:'sync_date',width:100,align:'center'">同步日期</th>
        <th data-options="field:'amount',width:200,align:'center',formatter:GLOBAL.func.moneyFormat">剩余现金金额</th>
    </tr>
    </thead>
</table>
<div id="fundsFinanceSyncSummaryToolbar" class="p-1">
    <div>
        <?php if(!$readOnly){ ?>
            <a href="#" class="easyui-linkbutton" data-options="onClick:function(){ fundsFinanceSyncSummaryModule.add(); },iconCls:iconClsDefs.add">添加摘要</a>
        <?php } ?>
    </div>
    <div class="line my-1"></div>
</div>
<script>
    var fundsFinanceSyncSummaryModule = {
        dialog:'#globel-dialog2-div',
        dialog2: '#globel-dialog2-div',
        datagrid:'#fundsFinanceSyncSummaryDatagrid',
        operate:function(val, row){
            var btns = [];
            btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsFinanceSyncSummaryModule.edit(' + row.ffs_id + ')" title="编辑"><i class="fa fa-pencil-square-o fa-lg"></i></a>');
            btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsFinanceSyncSummaryModule.delete(' + row.ffs_id + ')" title="删除"><i class="fa fa-trash-o fa-lg"></i></a>');
            return btns.join(' ');
        },
        detailFormatter:function(){
            return '<div class="ddv" style="padding:5px 0"></div>';
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
        add:function(){
            var that = this;
            var href = '<?=$urlHrefs['fundsFinanceSyncSummaryAdd']?>';
            $(that.dialog).dialog({
                title: '添加摘要',
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
        edit:function(ffsId){
            var that = this;
            var href = '<?=$urlHrefs['fundsFinanceSyncSummaryEdit']?>';
            href += href.indexOf('?') != -1 ? '&ffsId=' + ffsId : '?ffsId='+ffsId;
            $(that.dialog).dialog({
                title: '修改摘要',
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
        delete:function(ffsId){
            var that = this;
            var href = '<?=$urlHrefs['fundsFinanceSyncSummaryDelete']?>';
            href += href.indexOf('?') != -1 ? '&ffsId=' + ffsId : '?ffsId='+ffsId;
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