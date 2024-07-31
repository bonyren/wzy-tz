<table id="projectsDatagrid" class="easyui-datagrid" data-options="striped:true,
    nowrap:false,
    rownumbers:true,
    autoRowHeight:true,
    singleSelect:true,
    url:'<?=$urlHrefs['projects']?>',
    method:'post',
    toolbar:'#projectsToolbar',
    pagination:true,
    pageSize:<?=DEFAULT_PAGE_ROWS?>,
    pageList:[10,20,30,50,80,100],
    border:false,
    fit:true,
    fitColumns:<?=$loginMobile?'false':'true'?>,
    title:''
    ">
    <thead>
    <tr>
        <th data-options="field:'operate',width:100,fixed:true,align:'center',formatter:projectsModule.operate">操作</th>
        <th data-options="field:'name',width:200,fixed:true,align:'center'">项目名</th>
        <th data-options="field:'status',width:200,align:'center',formatter:projectsModule.formatStatus">状态</th>
    </tr>
    </thead>
</table>
<div id="projectsToolbar" class="p-1">
    <div>
        <a href="#" class="easyui-linkbutton" data-options="onClick:function(){ projectsModule.add(); },iconCls:'fa fa-plus'">添加新项目</a>
    </div>
</div>
<script>
    var projectsModule = {
        dialog:'#globel-dialog-div',
        datagrid:'#projectsDatagrid',
        operate:function(val, row){
            var btns = [];
            btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="projectsModule.edit(' + row.project_id + ')" title="编辑"><i class="fa fa-pencil-square-o fa-lg"></i></a>');
            btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="projectsModule.delete(' + row.project_id + ')" title="删除"><i class="fa fa-trash-o fa-lg"></i></a>');
            return btns.join(' ');
        },
        formatStatus:function(val, row){
            return "";
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
        add:function(){
            var that = this;
        },
        edit:function(projectId){
            var that = this;
        },
        delete:function(projectId){
        }
    };
</script>