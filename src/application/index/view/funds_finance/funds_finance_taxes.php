<table id="fundsFinanceTaxesDatagrid" class="easyui-datagrid" data-options="striped:true,
    nowrap:false,
    rownumbers:true,
    autoRowHeight:true,
    singleSelect:true,
    selectOnCheck:false,
    checkOnSelect:false,
    url:'<?=$urlHrefs['fundsFinanceTaxes']?>',
    method:'post',
    toolbar:'#fundsFinanceTaxesToolbar',
    pagination:true,
    pageSize:<?=DEFAULT_PAGE_ROWS?>,
    pageList:[10,20,30,50,80,100],
    border:false,
    fit:true,
    fitColumns:<?=$loginMobile?'false':'true'?>,
    title:'',
    onDblClickRow:function(index, row){
        //fundsFinanceTaxesModule.view(row.id);
    },
    rowStyler:fundsFinanceTaxesModule.rowStyler,
    showFooter:true,
    /*
    view: detailview,
    detailFormatter:function(index,row){
        return fundsFinanceTaxesModule.detailFormatter();
    },
    onExpandRow:function(index,row){
        var ddv = $(this).datagrid('getRowDetail',index).find('div.ddv');
        var href = '<?=$urlHrefs['fundsFinancePaid']?>';
        var fftId = row.fft_id;
        href += href.indexOf('?') != -1 ? '&itemId=' + fftId : '?itemId='+fftId;
        ddv.panel({
            height:120,
            border:false,
            cache:false,
            href:href,
            onLoad:function(){
                $('#fundsFinanceTaxesDatagrid').datagrid('fixDetailRowHeight',index);
            }
        });
        $('#fundsFinanceTaxesDatagrid').datagrid('fixDetailRowHeight',index);
    }*/
    ">
    <thead>
    <tr>
        <?php if(!$readOnly){ ?>
            <!--
            <th field="ck" checkbox="true"></th>
            -->
            <th data-options="field:'operate',width:100,fixed:true,align:'center',formatter:fundsFinanceTaxesModule.operate">操作</th>
        <?php } ?>
        <th data-options="field:'title',width:200,align:'center'">名称</th>
        <th data-options="field:'date',width:100,align:'center'">日期</th>
        <th data-options="field:'amount',width:100,align:'center',formatter:GLOBAL.func.moneyFormat">应付税费</th>
        <!--
        <th data-options="field:'actual_amount',width:100,align:'center',formatter:GLOBAL.func.moneyFormat">已核销</th>
        -->
        <th data-options="field:'type',width:100,align:'center',formatter:fundsFinanceTaxesModule.formatType">类型</th>
        <!--
        <th data-options="field:'status',width:100,align:'center',formatter:fundsFinanceTaxesModule.formatStatus">状态</th>
        -->
    </tr>
    </thead>
</table>
<div id="fundsFinanceTaxesToolbar" class="p-1">
    <div>
        <?php if(!$readOnly){ ?>
            <a href="#" class="easyui-linkbutton" data-options="onClick:function(){ fundsFinanceTaxesModule.add(); },iconCls:iconClsDefs.add">添加应付税费</a>
            <!--
            <a href="#" class="easyui-linkbutton" data-options="onClick:function(){ fundsFinanceTaxesModule.batchPaid(); },iconCls:'fa fa-legal'">批量核销</a>
            -->
        <?php } ?>
    </div>
    <div class="line my-1"></div>
</div>
<script>
    var fundsFinanceTaxesModule = {
        dialog:'#globel-dialog2-div',
        dialog2: '#globel-dialog2-div',
        datagrid:'#fundsFinanceTaxesDatagrid',
        operate:function(val, row){
            if(row.fft_id == 0){
                return '';
            }
            var btns = [];
            btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsFinanceTaxesModule.edit(' + row.fft_id + ')" title="编辑"><i class="fa fa-pencil-square-o fa-lg"></i></a>');
            btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsFinanceTaxesModule.delete(' + row.fft_id + ')" title="删除"><i class="fa fa-trash-o fa-lg"></i></a>');
            //btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsFinanceTaxesModule.addPaid(' + row.fft_id + ')" title="核销"><i class="fa fa-money fa-lg"></i></a>');
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
            var href = '<?=$urlHrefs['fundsFinanceTaxesAdd']?>';
            $(that.dialog).dialog({
                title: '添加应付税费',
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
        edit:function(fftId){
            var that = this;
            var href = '<?=$urlHrefs['fundsFinanceTaxesEdit']?>';
            href += href.indexOf('?') != -1 ? '&fftId=' + fftId : '?fftId='+fftId;
            $(that.dialog).dialog({
                title: '修改应付税费',
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
        delete:function(fftId){
            var that = this;
            var href = '<?=$urlHrefs['fundsFinanceTaxesDelete']?>';
            href += href.indexOf('?') != -1 ? '&fftId=' + fftId : '?fftId='+fftId;
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