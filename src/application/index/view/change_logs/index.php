<table id="changeLogsDatagrid_<?=$uniqid?>" class="easyui-datagrid" data-options="striped:true,
    nowrap:false,
    rownumbers:true,
    autoRowHeight:true,
    singleSelect:true,
    url:'<?=$urlHrefs['index']?>',
    method:'post',
    toolbar:'#changeLogsToolbar_<?=$uniqid?>',
    pagination:true,
    pageSize:<?=DEFAULT_PAGE_ROWS?>,
    pageList:[10,20,30,50,80,100],
    border:false,
    fit:true,
    fitColumns:<?=$loginMobile?'false':'true'?>,
    title:'',
    onDblClickRow:function(index, row){
        //changeLogsModule_<?=$uniqid?>.view(row.id);
    },
    view: detailview,
    detailFormatter:function(index,row){
        return changeLogsModule_<?=$uniqid?>.detailFormatter();
    },
    onExpandRow:function(index,row){
        var ddv = $(this).datagrid('getRowDetail',index).find('div.ddv');
        var href = '<?=$urlHrefs['attachments']?>';
        var id = row.id;
        href += href.indexOf('?') != -1 ? '&externalId=' + id : '?externalId='+id;
        ddv.panel({
            height:200,
            border:false,
            cache:false,
            href:href,
            onLoad:function(){
                $('#changeLogsDatagrid_<?=$uniqid?>').datagrid('fixDetailRowHeight',index);
            },
            onResize:function(width, height){
                $('#changeLogsDatagrid_<?=$uniqid?>').datagrid('fixDetailRowHeight',index);
            }
        });
        $('#changeLogsDatagrid_<?=$uniqid?>').datagrid('fixDetailRowHeight',index);
    }
    ">
    <thead>
    <tr>
        <?php if(!$readOnly){ ?>
        <th data-options="field:'operate',width:100,fixed:true,align:'center',formatter:changeLogsModule_<?=$uniqid?>.operate">操作</th>
        <?php } ?>
        <?php if($type == \app\index\logic\ChangeLogs::CHANGE_LOG_POINT_TYPE){ ?>
        <th data-options="field:'change_date',width:100,align:'center'">日期</th>
        <?php }else{ ?>
        <th data-options="field:'from_date',width:100,align:'center'">区间开始</th>
        <th data-options="field:'end_date',width:100,align:'center'">区间结束</th>
        <?php } ?>
        <th data-options="field:'desc',width:200,align:'left'">描述</th>
    </tr>
    </thead>
</table>
<?php if(!$readOnly){ ?>
<div id="changeLogsToolbar_<?=$uniqid?>" class="p-1">
    <div>
        <a href="#" class="easyui-linkbutton" data-options="onClick:function(){ changeLogsModule_<?=$uniqid?>.add(); },iconCls:iconClsDefs.add">添加</a>
    </div>
    <div class="line my-1"></div>
</div>
<?php } ?>
<script>
    var changeLogsModule_<?=$uniqid?> = {
        dialog:'#globel-dialog2-div',
        datagrid:'#changeLogsDatagrid_<?=$uniqid?>',
        operate:function(val, row){
            var btns = [];
            btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="changeLogsModule_<?=$uniqid?>.edit(' + row.id + ')" title="编辑"><i class="fa fa-pencil-square-o fa-lg"></i></a>');
            btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="changeLogsModule_<?=$uniqid?>.delete(' + row.id + ')" title="删除"><i class="fa fa-trash-o fa-lg"></i></a>');
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
        add:function(){
            var that = this;
            var href = '<?=$urlHrefs['add']?>';
            $(that.dialog).dialog({
                title: '添加<?=$title?>维护',
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
        edit:function(id){
            var that = this;
            var href = '<?=$urlHrefs['edit']?>';
            href += href.indexOf('?') != -1 ? '&id=' + id : '?id='+id;
            $(that.dialog).dialog({
                title: '修改<?=$title?>维护',
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
        delete:function(id){
            var that = this;
            var href = '<?=$urlHrefs['delete']?>';
            href += href.indexOf('?') != -1 ? '&id=' + id : '?id='+id;
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