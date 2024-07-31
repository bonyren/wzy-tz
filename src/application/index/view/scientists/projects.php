<table id="<?=DATAGRID_ID?>" class="easyui-datagrid" data-options="
    striped:true,
    rownumbers:true,
    nowrap:false,
    autoRowHeight:true,
    singleSelect:true,
    url:'<?=$_request_url?>',
    toolbar:'#<?=TOOLBAR_ID?>',
    pagination:true,
    pageSize:<?=DEFAULT_PAGE_ROWS?>,
    pageList:[10,20,30,50,80,100],
    fit:true,
    fitColumns:<?=$loginMobile?'false':'true'?>,
    onDblClickRow:function(idx,row){QT.helper.view({url:'<?=url('enterprises/view')?>?id='+row.id,width:'100%',height:'100%',dialog:'scientist-project-view-dialog'})},
    onLoadSuccess:ScientistProjects.convert,
    border:false">
    <thead>
    <tr>
        <th data-options="field:'name',width:250,fixed:true">企业名称</th>
        <th data-options="field:'description',width:500">公司简介</th>
    </tr>
    </thead>
</table>
<?php if(!$readOnly): ?>
<div id="<?=TOOLBAR_ID?>" class="pd-5">
    <?php echo \app\index\service\View::selector([
        'value_field'=>'id',
        'type'=>'callback',
        'multiple'=>true,
        'callback'=>'ScientistProjects.addProject',
        'btn_text'=>'新增关联项目',
        'url' => url('index/Enterprises/index'),
    ]); ?>
</div>
<?php endif; ?>
<script>
var ScientistProjects = {
    datagrid:'#<?=DATAGRID_ID?>',
    toolbar:'#<?=TOOLBAR_ID?>',
    convert:function(data){
        var that = ScientistProjects;
        $.each(data.rows, function(i,v){
            $(that.datagrid).datagrid('updateRow',{
                index: i,
                row: {
                    name: v.alias ? v.alias : v.name,
                    description: '<div class="desc-limiter">'+v.description+'</div>'
                }
            });
        });
    },
    reload:function(){
        $(this.datagrid).datagrid('reload');
    },
    addProject:function(ids){
        var that = ScientistProjects;
        $.messager.progress({text:'处理中，请稍候...'});
        $.post('<?=url('scientists/projectsAdd')?>', {scientist_id:'<?=$scientist_id?>',enterprise_id:ids}, function(res){
            $.messager.progress('close');
            if(!res.code){
                $.app.method.alertError(null, res.msg);
            }else{
                $.app.method.tip('提示', res.msg, 'info');
                that.reload();
            }
        }, 'json');
    }
};
</script>