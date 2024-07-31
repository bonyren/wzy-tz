<table id="fundsFinanceContributesDatagrid" class="easyui-datagrid" data-options="striped:true,
    nowrap:false,
    rownumbers:true,
    autoRowHeight:true,
    singleSelect:true,
    selectOnCheck:false,
    checkOnSelect:false,
    url:'<?=$urlHrefs['fundsFinanceContributes']?>',
    method:'post',
    toolbar:'#fundsFinanceContributesToolbar',
    pagination:true,
    pageSize:<?=DEFAULT_PAGE_ROWS?>,
    pageList:[10,20,30,50,80,100],
    border:false,
    fit:true,
    fitColumns:<?=$loginMobile?'false':'true'?>,
    title:'',
    onDblClickRow:function(index, row){
        //fundsFinanceContributesModule.view(row.id);
    },
    showFooter:true,
    /*
    view: detailview,
    detailFormatter:function(index,row){
        return fundsFinanceContributesModule.detailFormatter();
    },
    onExpandRow:function(index,row){
        var ddv = $(this).datagrid('getRowDetail',index).find('div.ddv');
        var href = '<?=$urlHrefs['fundsFinancePaid']?>';
        var ffcId = row.ffc_id;
        href += href.indexOf('?') != -1 ? '&itemId=' + ffcId : '?itemId='+ffcId;
        ddv.panel({
            height:120,
            border:false,
            cache:false,
            href:href,
            onLoad:function(){
                $('#fundsFinanceContributesDatagrid').datagrid('fixDetailRowHeight',index);
            }
        });
        $('#fundsFinanceContributesDatagrid').datagrid('fixDetailRowHeight',index);
    }*/
    ">
    <thead>
    <tr>
        <?php if(!$readOnly){ ?>
            <!--
            <th field="ck" checkbox="true"></th>
            -->
            <th data-options="field:'operate',width:100,fixed:true,align:'center',formatter:fundsFinanceContributesModule.operate">操作</th>
        <?php } ?>
        <th data-options="field:'title',width:200,align:'center'">名称</th>
        <th data-options="field:'date',width:100,align:'center'">日期</th>
        <th data-options="field:'amount',width:100,align:'center',formatter:GLOBAL.func.moneyFormat">金额</th>
        <!--
        <th data-options="field:'actual_amount',width:100,align:'center',formatter:GLOBAL.func.moneyFormat">已核销</th>
        <th data-options="field:'status',width:100,align:'center',formatter:fundsFinanceContributesModule.formatStatus">状态</th>
        -->
    </tr>
    </thead>
</table>
<!--
<div id="fundsFinanceContributesToolbar" class="p-1">
    <div>
        <?php if(!$readOnly){ ?>
            <a href="#" class="easyui-linkbutton" data-options="onClick:function(){ fundsFinanceContributesModule.add(); },iconCls:iconClsDefs.add">添加合伙人出资</a>
            <a href="#" class="easyui-linkbutton" data-options="onClick:function(){ fundsFinanceContributesModule.batchPaid(); },iconCls:'fa fa-legal'">批量核销</a>
        <?php } ?>
    </div>
</div>
-->
<script>
    var fundsFinanceContributesModule = {
        dialog:'#globel-dialog2-div',
        dialog2: '#globel-dialog2-div',
        datagrid:'#fundsFinanceContributesDatagrid',
        operate:function(val, row){
            if(row.ffc_id == 0){
                return '';
            }
            var btns = [];
            btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsFinanceContributesModule.edit(' + row.ffc_id + ')" title="编辑"><i class="fa fa-pencil-square-o fa-lg"></i></a>');
            //btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsFinanceContributesModule.delete(' + row.ffc_id + ')" title="删除"><i class="fa fa-trash-o fa-lg"></i></a>');
            //btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsFinanceContributesModule.addPaid(' + row.ffc_id + ')" title="核销"><i class="fa fa-money fa-lg"></i></a>');
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
        edit:function(ffcId){
            var that = this;
            var href = '<?=$urlHrefs['fundsFinanceContributesEdit']?>';
            href += href.indexOf('?') != -1 ? '&ffcId=' + ffcId : '?ffcId='+ffcId;
            $(that.dialog).dialog({
                title: '修改合伙人出资',
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
        }
    };
</script>