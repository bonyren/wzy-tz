<table id="fundsFinancePaidDatagrid_<?=$uniqid?>" class="easyui-datagrid" data-options="striped:true,
    nowrap:false,
    rownumbers:true,
    autoRowHeight:true,
    singleSelect:true,
    url:'<?=$urlHrefs['fundsFinancePaid']?>',
    method:'post',
    pagination:false,
    border:true,
    fit:true,
    fitColumns:<?=$loginMobile?'false':'true'?>,
    title:''">
    <thead>
    <tr>
        <?php if(!$readOnly){ ?>
        <th data-options="field:'operate',width:100,fixed:true,align:'center',formatter:fundsFinancePaidModule_<?=$uniqid?>.operate">操作</th>
        <?php } ?>
        <th data-options="field:'actual_amount',width:200,align:'center',formatter:GLOBAL.func.moneyFormat">核销金额</th>
        <th data-options="field:'pay_date',width:100,align:'center'">核销日期</th>
    </tr>
    </thead>
</table>
<script type="text/javascript">
    var fundsFinancePaidModule_<?=$uniqid?> = {
        dialog:'#globel-dialog-div',
        dialog2: '#globel-dialog2-div',
        datagrid:'#fundsFinancePaidDatagrid_<?=$uniqid?>',
        operate:function(val, row){
            var btns = [];
            btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsFinancePaidModule_<?=$uniqid?>.edit(' + row.id + ')" title="编辑"><i class="fa fa-pencil-square-o fa-lg"></i></a>');
            btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsFinancePaidModule_<?=$uniqid?>.delete(' + row.id + ')" title="删除"><i class="fa fa-trash-o fa-lg"></i></a>');
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
        edit:function(id){
            var that = this;
            var href = '<?=$urlHrefs['fundsFinancePaidEdit']?>';
            href += href.indexOf('?') != -1 ? '&id=' + id : '?id='+id;
            $(that.dialog2).dialog({
                title: '修改核销',
                iconCls: iconClsDefs.edit,
                width: 450,
                height: 300,
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
                        $(that.dialog2).find('form').eq(0).form('submit', {
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
                                        $(that.dialog2).dialog('close');
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
                        $(that.dialog2).dialog('close');
                    }
                }]
            });
            $(that.dialog2).dialog('center');
        },
        delete:function(id){
            var that = this;
            var href = '<?=$urlHrefs['fundsFinancePaidDelete']?>';
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