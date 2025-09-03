<div class="easyui-tabs" data-options="fit:true,border:false">
    <div title="项目文档" data-options="cache:false,href:'<?=url('Docs/files', ['category'=>1, 'owned'=>$owned])?>',iconCls:'fa fa-circle'"></div>
    <div title="基金文档" data-options="cache:false,href:'<?=url('Docs/files', ['category'=>2, 'owned'=>$owned])?>',iconCls:'fa fa-circle'"></div>
</div>