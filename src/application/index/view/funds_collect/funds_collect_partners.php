<table id="fundsCollectPartnersDatagrid" class="easyui-datagrid" data-options="striped:true,
    nowrap:false,
    rownumbers:true,
    autoRowHeight:true,
    singleSelect:true,
    url:'<?=$urlHrefs['fundsCollectPartners']?>',
    method:'post',
    toolbar:'#fundsCollectPartnersToolbar',
    pagination:false,
    border:false,
    fit:true,
    fitColumns:<?=$loginMobile?'false':'true'?>,
    showFooter:true,
    title:'',
    onDblClickRow:function(index, row){
        //fundsCollectPartnersModule.view(row.project_id);
    },
    view: detailview,
    onLoadSuccess:function(data){
        //fundsCollectPartnersModule.expandAll();
    },
    detailFormatter:function(index,row){
        return fundsCollectPartnersModule.detailFormatter();
    },
    onExpandRow:function(index,row){
        var ddv = $(this).datagrid('getRowDetail',index).find('div.ddv');
        var href = '<?=$urlHrefs['fundsCollectPartnersPaid']?>';
        var fpId = row.fp_id;
        href += href.indexOf('?') != -1 ? '&fpId=' + fpId : '?fpId='+fpId;
        ddv.panel({
            height:200,
            border:false,
            cache:false,
            href:href,
            onLoad:function(){
                $('#fundsCollectPartnersDatagrid').datagrid('fixDetailRowHeight',index);
            }
        });
        $('#fundsCollectPartnersDatagrid').datagrid('fixDetailRowHeight',index);
    }
    ">
    <thead>
    <tr>
        <?php if(!$readOnly){ ?>
            <th data-options="field:'operate',width:120,fixed:true,align:'center',formatter:fundsCollectPartnersModule.operate">操作</th>
        <?php } ?>
        <th data-options="field:'name',width:200,align:'center'">名称</th>
        <th data-options="field:'amount',width:100,align:'center',formatter:GLOBAL.func.moneyFormat">认投金额(元)</th>
        <th data-options="field:'share_proportion',width:100,align:'center'">占股比例</th>
        <th data-options="field:'actual_amount',width:100,align:'center',formatter:GLOBAL.func.moneyFormat">实投金额(元)</th>
        <th data-options="field:'type',width:100,align:'center',formatter:fundsCollectPartnersModule.formatType">类型</th>
        <th data-options="field:'status',width:100,align:'center',formatter:fundsCollectPartnersModule.formatStatus">状态</th>
    </tr>
    </thead>
</table>
<div id="fundsCollectPartnersToolbar" class="p-1">
    <div>
        <?php if(!$readOnly){ ?>
            <a href="#" class="easyui-linkbutton" data-options="onClick:function(){ fundsCollectPartnersModule.add(<?=\app\index\logic\Defs::PARTNER_LIMITED_INDIVIDUAL_TYPE?>); },iconCls:iconClsDefs.add">添加个人有限合伙人</a>
            <a href="#" class="easyui-linkbutton" data-options="onClick:function(){ fundsCollectPartnersModule.add(<?=\app\index\logic\Defs::PARTNER_LIMITED_INSTITUTIONAL_TYPE?>); },iconCls:iconClsDefs.add">添加机构有限合伙人</a>
            <a href="#" class="easyui-linkbutton" data-options="onClick:function(){ fundsCollectPartnersModule.add(<?=\app\index\logic\Defs::PARTNER_GENERAL_TYPE?>); },iconCls:iconClsDefs.add">添加普通合伙人</a>
        <?php } ?>
    </div>
</div>
<script>
    var fundsCollectPartnersModule = {
        dialog:'#globel-dialog-div',
        dialog2: '#globel-dialog2-div',
        datagrid:'#fundsCollectPartnersDatagrid',
        operate:function(val, row){
            if(row.fp_id == 0){
                return '';
            }
            var btns = [];
            btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsCollectPartnersModule.edit(' + row.fp_id + ')" title="编辑"><i class="fa fa-pencil-square-o fa-lg"></i></a>');
            if(row.status == <?=\app\index\logic\Defs::FUND_PARTNER_ACTIVE_STATUS?>) {
                btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsCollectPartnersModule.exit(' + row.fp_id + ')" title="退伙"><i class="fa fa-sign-out fa-lg"></i></a>');
            }else{
                btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsCollectPartnersModule.enter(' + row.fp_id + ')" title="入伙"><i class="fa fa-sign-in fa-lg"></i></a>');
            }
            btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsCollectPartnersModule.delete(' + row.fp_id + ')" title="删除"><i class="fa fa-trash-o fa-lg"></i></a>');
            btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsCollectPartnersModule.addPaid(' + row.fp_id + ')" title="实投"><i class="fa fa-money fa-lg"></i></a>');
            return btns.join(' ');
        },
        formatType:function(val, row){
            var typeObj = <?=json_encode(\app\index\logic\Defs::$partnerTypeHtmlDefs)?>;
            return typeObj[val];
        },
        formatStatus:function(val, row){
            var typeObj = <?=json_encode(\app\index\logic\Defs::$fundPartnerStatusHtmlDefs)?>;
            return typeObj[val];
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
        add:function(type){
            var that = this;
            var href = '<?=$urlHrefs['fundsCollectPartnersAdd']?>';
            href += href.indexOf('?') != -1 ? '&type=' + type : '?type='+type;
            $(that.dialog2).dialog({
                title: '添加新合伙人',
                iconCls: iconClsDefs.add,
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
                            url:href,
                            /*
                            onSubmit: function(){
                                var isValid = $(this).form('validate');
                                if (!isValid) return false;
                                $.messager.progress({text:'处理中，请稍候...'});
                                return true;
                            },
                            success: function(data){
                                var res = eval('(' + data + ')');  // change the JSON string to javascript object
                                $.messager.progress('close');
                                if(!res.code){
                                    $.app.method.alertError(null, res.msg);
                                }else{
                                    $.app.method.tip('提示', res.msg, 'info');
                                    $(that.dialog2).dialog('close');
                                    that.reload();
                                }
                            }*/
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
        addPaid:function(fpId){
            var that = this;
            var href = '<?=$urlHrefs['fundsCollectPartnersPaidAdd']?>';
            href += href.indexOf('?') != -1 ? '&fpId=' + fpId : '?fpId='+fpId;
            $(that.dialog2).dialog({
                title: '添加实投',
                iconCls: iconClsDefs.add,
                width: 600,
                height: 600,
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
                                if(!fundsCollectPartnersPaidAddModule.save()){
                                    return false;
                                }
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
        edit:function(fpId){
            var that = this;
            var href = '<?=$urlHrefs['fundsCollectPartnersEdit']?>';
            href += href.indexOf('?') != -1 ? '&fpId=' + fpId : '?fpId='+fpId;
            $(that.dialog2).dialog({
                title: '修改合伙人',
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
        exit:function(fpId){
            var that = this;
            var href = '<?=$urlHrefs['fundsCollectPartnersExit']?>';
            href += href.indexOf('?') != -1 ? '&fpId=' + fpId : '?fpId='+fpId;
            $.messager.confirm('提示', '确认退伙吗?', function(result){
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
        },
        enter:function(fpId){
            var that = this;
            var href = '<?=$urlHrefs['fundsCollectPartnersEnter']?>';
            href += href.indexOf('?') != -1 ? '&fpId=' + fpId : '?fpId='+fpId;
            $.messager.confirm('提示', '确认入伙吗?', function(result){
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
        },
        delete:function(fpId){
            var that = this;
            var href = '<?=$urlHrefs['fundsCollectPartnersDelete']?>';
            href += href.indexOf('?') != -1 ? '&fpId=' + fpId : '?fpId='+fpId;
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
        },
        detailFormatter:function(){
            return '<div class="ddv" style="padding:5px 0"></div>';
        },
        expandAll:function(){
            var that = this;
            var rows = $(that.datagrid).datagrid('getRows');
            for(var i= 0,count=rows.length; i<count; i++){
                var row = rows[i];
                var index = $(that.datagrid).datagrid('getRowIndex', row);
                $(that.datagrid).datagrid('expandRow', index);
            }
        }
    };
</script>