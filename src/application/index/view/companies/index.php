<?php
use app\common\CommonDefs;
?>
<table id="<?=DATAGRID_ID?>" class="easyui-datagrid" data-options="
    striped:true,
    rownumbers:true,
    nowrap:false,
    autoRowHeight:true,
    singleSelect:true,
    <?php if(isset($_GET['dialog_call']) && $_GET['dialog_call'] && isset($_GET['multiple']) && $_GET['multiple']): ?>
    selectOnCheck:false,
    checkOnSelect:false,
    <?php endif; ?>
    url:'<?=$_request_url?>',
    toolbar:'#<?=TOOLBAR_ID?>',
    pagination:true,
    pageSize:<?=DEFAULT_PAGE_ROWS?>,
    fit:true,
    fitColumns:<?=$loginMobile?'false':'true'?>,
    onDblClickRow:function(idx,row){QT.helper.view({url:'<?=url('companies/view')?>?id='+row.id,width:<?=$loginMobile?"'90%'":900?>,height:'90%',dialog:'companies_view'})},
    onLoadSuccess:Companies.convert,
    border:false">
    <thead>
    <tr>
        <?php if(isset($_GET['dialog_call']) && $_GET['dialog_call'] && isset($_GET['multiple']) && $_GET['multiple']): ?>
            <th field="ck" checkbox="true"></th>
        <?php endif; ?>
        <?php if(!isset($_GET['dialog_call']) || !$_GET['dialog_call']): ?>
        <th data-options="field:'btns',width:150">操作</th>
        <?php endif; ?>
        <th data-options="field:'name',width:150">公司名称</th>
        <th data-options="field:'controller',width:100">实际控制人</th>
        <th data-options="field:'introduction',width:200">公司简介</th>
        <th data-options="field:'assigner',width:100">跟进人</th>
    </tr>
    </thead>
</table>
<div id="<?=TOOLBAR_ID?>" class="p-1">
    <form>
        <?php if(!isset($_GET['dialog_call']) || empty($_GET['dialog_call'])): ?>
            <a href="javascript:void(0)" class="easyui-linkbutton" onclick="Companies.add(0)" iconCls="fa fa-plus-circle">添加公司</a>
            <div class="line my-1"></div>
        <?php endif; ?>
        公司名称<input name="search[name]" class="easyui-textbox" data-options="width:160">
        <a class="easyui-linkbutton" data-options="iconCls:'fa fa-search',onClick:function(){Companies.search();}">搜索</a>
        <a class="easyui-linkbutton" data-options="iconCls:'fa fa-reply',onClick:function(){Companies.reset();}">重置</a>
    </form>
    <div class="line my-1"></div>
</div>
<script>
var Companies = {
    datagrid:'#<?=DATAGRID_ID?>',
    toolbar:'#<?=TOOLBAR_ID?>',
    convert:function(data){
        var that = Companies;
        $.each(data.rows, function(i,v){
            var btns = [];
            <?php if($loginUserMenuPriv == CommonDefs::AUTHORIZE_READ_WRITE_TYPE){ ?>
                btns.push('<a href="javascript:void(0);" class="btn btn-outline-info size-MINI radius my-1" onclick="QT.helper.view({url:\'<?=url('companies/view')?>?id='+v.id+'\',width:<?=$loginMobile?"\'90%\'":900?>,height:\'90%\',dialog:\'companies_view\'})" title="查看"><i class="fa fa-eye"></i>查看</a>');
                btns.push('<a href="javascript:void(0);" class="btn btn-outline-info size-MINI radius my-1" onclick="Companies.add(' + v.id + ')" title="编辑"><i class="fa fa-pencil-square-o"></i>编辑</a>');
                btns.push('<a href="javascript:void(0);" class="btn btn-outline-info size-MINI radius my-1" onclick="Companies.del(' + v.id + ')" title="删除"><i class="fa fa-trash-o"></i>删除</a>');
            <?php }else if($loginUserMenuPriv == CommonDefs::AUTHORIZE_READ_ONLY_TYPE){ ?>
                btns.push('<a href="javascript:void(0);" class="btn btn-outline-info size-MINI radius my-1" onclick="QT.helper.view({url:\'<?=url('companies/view')?>?id='+v.id+'\',width:<?=$loginMobile?"\'90%\'":900?>,height:\'90%\',dialog:\'companies_view\'})" title="查看"><i class="fa fa-eye"></i>查看</a>');
            <?php } ?>
            $(that.datagrid).datagrid('updateRow',{
                index: i,
                row: {
                    introduction:'<div class="desc-limiter">'+v.introduction+'</div>',
                    assigner:v.assigner in data.users ? data.users[v.assigner].realname : '',
                    btns:btns.join(' ')
                }
            });
        });
    },
    reload:function(){
        $(this.datagrid).datagrid('reload');
    },
    search:function(){
        var that = Companies, data = {};
        var params = $(that.toolbar).children('form').serializeArray()
        $.each(params, function() {
            data[this['name']] = this['value'];
        });
        $(that.datagrid).datagrid('load',data);
    },
    reset:function(){
        var that = this;
        $(that.toolbar).find('.easyui-textbox').textbox('clear');
        $(that.toolbar).find('.easyui-checkbox').checkbox('reset');
        $(that.datagrid).datagrid('load',{});
    },
    add:function(id){
        QT.helper.view({
            title:id ? '编辑上市公司' : '添加上市公司',
            url:'<?=url('index/Companies/add')?>?id='+id+'&grid=<?=DATAGRID_ID?>',
            width:<?=$loginMobile?"'90%'":900?>,
            height:'90%',
            iconCls:'fa fa-plus',
            collapsible: false,
            minimizable: false,
            resizable: false,
            maximizable: false,
            dialog:'globel-dialog-div'
        });
    },
    del:function(id){
        var that = this;
        $.messager.confirm('提示', '确认删除吗?', function(result){
            if(!result) return false;
            $.messager.progress({text:'处理中，请稍候...'});
            $.post('<?=url('companies/remove')?>', {id:id}, function(res){
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