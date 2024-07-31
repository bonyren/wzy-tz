<table id="<?=DATAGRID_ID?>" class="easyui-datagrid"
       data-options="
            nowrap:false,
            rownumbers:true,
            singleSelect:true,
            url:'<?=url('config/dropdowns')?>',
            toolbar:'#<?=TOOLBAR_ID?>',
            pagination:true,
            pageSize:<?=DEFAULT_PAGE_ROWS?>,
            pageList:[10,20,30,50,80,100],
            fit:true,
            fitColumns:<?=$loginMobile?'false':'true'?>,
            onLoadSuccess:<?=JVAR?>.convert,
            border:false">
    <thead>
    <tr>
        <th data-options="field:'btns',width:100,align:'center'">操作</th>
        <th data-options="field:'field',width:200,align:'center'">字段</th>
        <th data-options="field:'description',width:400,align:'center'">描述</th>
    </tr>
    </thead>
</table>
<div id="<?=TOOLBAR_ID?>" class="p-1">
    <div>
        <a href="javascript:void(0)" class="easyui-linkbutton" onClick="<?=JVAR?>.edit(0)" iconCls="fa fa-plus">添加</a>
    </div>
</div>
<script>
var <?=JVAR?> = {
    datagrid:'#<?=DATAGRID_ID?>',
    convert:function(data){
        var that = <?=JVAR?>;
        $.each(data.rows, function(i,v){
            var btns = [];
            btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="<?=JVAR?>.edit(' + v.id + ')" title="编辑"><i class="fa fa-pencil-square-o fa-lg"></i></a>');
            btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="<?=JVAR?>.remove(' + v.id + ')" title="删除"><i class="fa fa-trash-o fa-lg"></i></a>');
            $(that.datagrid).datagrid('updateRow',{
                index: i,
                row: {
                    btns: btns.join(' ')
                }
            });
        });
    },
    reload:function(){
        $(this.datagrid).datagrid('reload');
    },
    load:function(){
        $(this.datagrid).datagrid('load');
    },
    edit:function(id){
        var href = '<?=url('config/editDropdown')?>?id='+id;
        QT.helper.dialog('数据选项',href,true,function(){
            <?=JVAR?>.reload();
        });
    },
    remove:function(id){
        var that = this;
        $.messager.confirm('提示', '确认删除吗?', function(result){
            if(!result) return false;
            $.messager.progress({text:'处理中，请稍候...'});
            $.post('<?=url('config/deleteDropdown')?>', {id:id}, function(res){
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