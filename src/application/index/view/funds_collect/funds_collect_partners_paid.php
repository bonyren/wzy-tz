<table id="fundsCollectPartnersPaidDatagrid_<?=$fpId?>" class="easyui-datagrid" data-options="striped:true,
    nowrap:false,
    rownumbers:true,
    autoRowHeight:true,
    singleSelect:true,
    url:'<?=$urlHrefs['fundsCollectPartnersPaid']?>',
    method:'post',
    pagination:false,
    border:true,
    fit:true,
    fitColumns:<?=$loginMobile?'false':'true'?>,
    title:'',
    onLoadSuccess:function(data){
        for(var i=0; i<$('#fundsCollectPartnersPaidDatagrid_<?=$fpId?>').datagrid('getRows').length; i++){
            $('#<?=$fpId?>_partner_paid_row_' + i).fundContributeView();
        }
    }">
    <thead>
    <tr>
        <?php if(!$readOnly){ ?>
            <th data-options="field:'operate',width:100,fixed:true,align:'center',formatter:fundsCollectPartnersPaidModule_<?=$fpId?>.operate">操作</th>
        <?php } ?>
        <th data-options="field:'ffc_id',width:500,align:'center',formatter:fundsCollectPartnersPaidModule_<?=$fpId?>.FormatFFC">实投金额</th>
    </tr>
    </thead>
</table>
<script type="text/javascript">
    var fundsCollectPartnersPaidModule_<?=$fpId?> = {
        dialog:'#globel-dialog-div',
        dialog2: '#globel-dialog2-div',
        datagrid:'#fundsCollectPartnersPaidDatagrid_<?=$fpId?>',
        operate:function(val, row){
            var btns = [];
            btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsCollectPartnersPaidModule_<?=$fpId?>.edit(' + row.fp_paid_id + ')" title="编辑"><i class="fa fa-pencil-square-o fa-lg"></i></a>');
            btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsCollectPartnersPaidModule_<?=$fpId?>.delete(' + row.fp_paid_id + ')" title="删除"><i class="fa fa-trash-o fa-lg"></i></a>');
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
        FormatFFC:function(val, row, index){
            return '<div id="<?=$fpId?>_partner_paid_row_' + index + '"'  +
                'data-options="' +
                'ffcId:' + val +
                '"</div>';
        },
        edit:function(fpPaidId){
            var that = this;
            var href = '<?=$urlHrefs['fundsCollectPartnersPaidEdit']?>';
            href += href.indexOf('?') != -1 ? '&fpPaidId=' + fpPaidId : '?fpPaidId='+fpPaidId;
            $(that.dialog2).dialog({
                title: '修改实投',
                iconCls: iconClsDefs.edit,
                width: 600,
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
                                if(!fundsCollectPartnersPaidEditModule.save()){
                                    $.app.method.alertError(null, '失败');
                                    return false;
                                }else{
                                    $.app.method.tip('提示', '成功', 'info');
                                    $(that.dialog2).dialog('close');
                                    that.reload();
                                }
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
        delete:function(fpPaidId){
            var that = this;
            var href = '<?=$urlHrefs['fundsCollectPartnersPaidDelete']?>';
            href += href.indexOf('?') != -1 ? '&fpPaidId=' + fpPaidId : '?fpPaidId='+fpPaidId;
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