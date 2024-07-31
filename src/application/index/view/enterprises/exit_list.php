<table id="<?=DATAGRID_ID?>" class="easyui-datagrid" data-options="striped:true,
    nowrap:false,
    rownumbers:true,
    singleSelect:true,
    pagination:true,
    pageSize:<?=DEFAULT_PAGE_ROWS?>,
    url:'<?=$_request_url?>',
    toolbar:'#<?=TOOLBAR_ID?>',
    iconCls:'fa fa-list',
    title:'退出记录',
    fit:true,
    fitColumns:<?=$loginMobile?'false':'true'?>,
    onLoadSuccess:ENTERPRISE_EXIT_LIST.convert,
    border:false">
    <thead>
    <tr>
        <th data-options="field:'btns',width:60">操作</th>
        <th data-options="field:'date',width:80">时间</th>
        <th data-options="field:'fund_name',width:80">退出基金</th>
        <th data-options="field:'type',width:100">类型</th>
        <th data-options="field:'round',width:100">轮次</th>
        <th data-options="field:'amount',width:150">退出金额</th>
    </tr>
    </thead>
</table>
<?php if (!$readonly): ?>
<div id="<?=TOOLBAR_ID?>" class="p-1">
    <div>
        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="onClick:function(){ENTERPRISE_EXIT_LIST.show(0,1);},iconCls:'fa fa-plus-circle'">新增退出</a>
    </div>
</div>
<?php endif; ?>
<script>
var ENTERPRISE_EXIT_LIST = {
    datagrid:'#<?=DATAGRID_ID?>',
    toolbar:'#<?=TOOLBAR_ID?>',
    readonly:<?=intval($readonly)?>,
    convert:function(data){
        var that = ENTERPRISE_EXIT_LIST;
        $.each(data.rows, function(i,v){
            var btns = [];
            if (that.readonly) {
                var cls = 'fa-eye', tip = '查看';
            } else {
                var cls = 'fa-pencil-square-o', tip = '编辑';
            }
            btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="ENTERPRISE_EXIT_LIST.show('+v.id+',1)" title="'+tip+'"><i class="fa '+cls+' fa-lg"></i></a>');
            btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="ENTERPRISE_EXIT_LIST.show('+v.id+',2)" title="资金分配"><i class="fa fa-share-alt fa-lg"></i></a>');
            if (!that.readonly) {
                btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="ENTERPRISE_EXIT_LIST.del(' + v.id + ')" title="删除"><i class="fa fa-trash-o fa-lg"></i></a>');
            }
            $(that.datagrid).datagrid('updateRow',{
                index: i,
                row: {
                    type:data.types[v.type],
                    amount:parseInt(v.amount).toLocaleString(),
                    remark:v.remark ? '<div class="desc-limiter">'+v.remark+'</div>' : '',
                    btns:btns.join(' ')
                }
            });
        });
    },
    reload:function(){
        $(this.datagrid).datagrid('reload');
    },
    search:function(){
        var that = this, data = {};
        var params = $(that.toolbar).children('form').serializeArray()
        $.each(params, function() {
            data[this['name']] = this['value'];
        });
        $(that.datagrid).datagrid('load',data);
    },
    reset:function(){
        var that = this;
        $(that.toolbar).find('.easyui-textbox').textbox('clear');
        $(that.datagrid).datagrid('load',{});
    },
    show:function(id,type){
        var that = this, defs= {
            1:{title:'项目退出', url:'<?=url('Enterprises/exitEdit')?>?enterprise_id=<?=$enterprise_id?>&id='+id+'&readonly='+that.readonly},
            2:{title:'资金分配', url:'<?=url('Enterprises/exitFundAllocation')?>?id='+id},
        };
        QT.helper.dialog(defs[type].title, defs[type].url, !that.readonly, function($dialog){
            that.reload();
        },<?=$loginMobile?"'90%'":800?>,"90%");
    },
    del:function(id){
        var that = this;
        var url = '<?=url('enterprises/exitDelete')?>';
        $.messager.confirm('提示', '确定删除该退出记录吗?', function(result){
            if(!result) return false;
            $.messager.progress({text:'处理中，请稍候...'});
            $.post(url, {id:id}, function(res){
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