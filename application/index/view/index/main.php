<div class="easyui-layout" data-options="fit:true">
    <div data-options="region:'north',
        collapsible:true,
        border:false,
        iconCls:'fa fa-pie-chart',
        title:'',
        collapsed:false,
        href:'<?=$urlHrefs['dashboard']?>'" style="height: 30%;">
    </div>
    <div data-options="region:'center',border:false">
        <div class="easyui-tabs" data-options="fit:true,border:false">
            <div data-options="title:'项目事件',iconCls:'fa fa-th-list',href:'<?=$urlHrefs['projectEvents']?>'"></div>
            <div data-options="title:'基金事件',iconCls:'fa fa-th-list',href:'<?=$urlHrefs['fundEvents']?>'"></div>
        </div>

    </div>
</div>