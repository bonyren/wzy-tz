<table id="fundsFinanceEnterprisesDatagrid" class="easyui-datagrid" data-options="striped:true,
    nowrap:false,
    rownumbers:true,
    autoRowHeight:true,
    singleSelect:true,
    selectOnCheck:false,
    checkOnSelect:false,
    url:'<?=$urlHrefs['fundsFinanceEnterprises']?>',
    method:'post',
    toolbar:'#fundsFinanceEnterprisesToolbar',
    pagination:true,
    pageSize:<?=DEFAULT_PAGE_ROWS?>,
    pageList:[10,20,30,50,80,100],
    border:false,
    fit:true,
    fitColumns:<?=$loginMobile?'false':'true'?>,
    title:'',
    onDblClickRow:function(index, row){
        //fundsFinanceEnterprisesModule.view(row.id);
    },
    rowStyler:fundsFinanceEnterprisesModule.rowStyler,
    showFooter:true,
    /*
    view: detailview,
    detailFormatter:function(index,row){
        return fundsFinanceEnterprisesModule.detailFormatter();
    },
    onExpandRow:function(index,row){
        var ddv = $(this).datagrid('getRowDetail',index).find('div.ddv');
        var href = '<?=$urlHrefs['fundsFinancePaid']?>';
        var ffeId = row.ffe_id;
        href += href.indexOf('?') != -1 ? '&itemId=' + ffeId : '?itemId='+ffeId;
        ddv.panel({
            height:120,
            border:false,
            cache:false,
            href:href,
            onLoad:function(){
                $('#fundsFinanceEnterprisesDatagrid').datagrid('fixDetailRowHeight',index);
            }
        });
        $('#fundsFinanceEnterprisesDatagrid').datagrid('fixDetailRowHeight',index);
    }*/
    ">
    <thead>
    <tr>
        <?php if(!$readOnly){ ?>
            <!--
            <th field="ck" checkbox="true"></th>
            -->
            <th data-options="field:'operate',width:100,fixed:true,align:'center',formatter:fundsFinanceEnterprisesModule.operate">操作</th>
        <?php } ?>
        <th data-options="field:'title',width:200,align:'center'">名称</th>
        <th data-options="field:'date',width:100,align:'center'">日期</th>
        <th data-options="field:'name',width:200,align:'center'">项目</th>
        <th data-options="field:'amount',width:100,align:'center',formatter:GLOBAL.func.moneyFormat">应付投资</th>
        <!--
        <th data-options="field:'actual_amount',width:100,align:'center',formatter:GLOBAL.func.moneyFormat">已核销</th>
        <th data-options="field:'status',width:100,align:'center',formatter:fundsFinanceEnterprisesModule.formatStatus">状态</th>
        -->
    </tr>
    </thead>
</table>
<div id="fundsFinanceEnterprisesToolbar" class="p-1">
    <div>
        <?php if(!$readOnly){ ?>
            <a href="#" class="easyui-linkbutton" data-options="onClick:function(){ fundsFinanceEnterprisesModule.add(); },iconCls:iconClsDefs.add">添加应付投资</a>
            <!--
            <a href="#" class="easyui-linkbutton" data-options="onClick:function(){ fundsFinanceEnterprisesModule.batchPaid(); },iconCls:'fa fa-legal'">批量核销</a>
            -->
        <?php } ?>
    </div>
</div>
<script>
    var fundsFinanceEnterprisesModule = {
        dialog:'#globel-dialog2-div',
        dialog2: '#globel-dialog2-div',
        datagrid:'#fundsFinanceEnterprisesDatagrid',
        operate:function(val, row){
            if(row.ffe_id == 0){
                return '';
            }
            var btns = [];
            btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsFinanceEnterprisesModule.edit(' + row.ffe_id + ')" title="编辑"><i class="fa fa-pencil-square-o fa-lg"></i></a>');
            btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsFinanceEnterprisesModule.delete(' + row.ffe_id + ')" title="删除"><i class="fa fa-trash-o fa-lg"></i></a>');
            //btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsFinanceEnterprisesModule.addPaid(' + row.ffe_id + ')" title="核销"><i class="fa fa-money fa-lg"></i></a>');
            return btns.join(' ');
        },
        /*
        detailFormatter:function(){
            return '<div class="ddv" style="padding:5px 0"></div>';
        },*/
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
        formatType:function(val, row, index){
            return <?=json_encode(\app\index\logic\Defs::$fundTaxTypeHtmlDefs)?>[val];
        },
        /*
        formatStatus:function(val, row, index){
            return <?=json_encode(\app\index\logic\Defs::$fundFinancePaidStatusHtmlDefs)?>[val];
        },*/
        rowStyler:function(index, row){
            row.belong_interval = row.from_date + ' - ' + row.end_date;
        },
        add:function(){
            var that = this;
            var href = '<?=$urlHrefs['fundsFinanceEnterprisesAdd']?>';
            $(that.dialog).dialog({
                title: '添加应付投资',
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
        edit:function(ffeId){
            var that = this;
            var href = '<?=$urlHrefs['fundsFinanceEnterprisesEdit']?>';
            href += href.indexOf('?') != -1 ? '&ffeId=' + ffeId : '?ffeId='+ffeId;
            $(that.dialog).dialog({
                title: '修改应付投资',
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
        delete:function(ffeId){
            var that = this;
            var href = '<?=$urlHrefs['fundsFinanceEnterprisesDelete']?>';
            href += href.indexOf('?') != -1 ? '&ffeId=' + ffeId : '?ffeId='+ffeId;
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