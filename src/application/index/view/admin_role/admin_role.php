<table id="adminRoleDatagrid" class="easyui-datagrid" data-options="striped:true,
    nowrap:false,
    rownumbers:true,
    autoRowHeight:true,
    singleSelect:true,
    url:'<?=$urlHrefs['adminRole']?>',
    method:'post',
    toolbar:'#adminRoleToolbar',
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
        <th data-options="field:'operate',width:100,fixed:true,align:'center',formatter:adminRoleModule.operate">操作</th>
        <th data-options="field:'role_name',width:200,fixed:true,align:'center'">角色名</th>
        <th data-options="field:'description',width:200,align:'center'">描述</th>
    </tr>
    </thead>
</table>
<div id="adminRoleToolbar" class="p-1">
    <div>
        <a href="#" class="easyui-linkbutton" data-options="onClick:function(){ adminRoleModule.add(); },iconCls:iconClsDefs.add">添加新角色</a>
    </div>
</div>
<script>
    var adminRoleModule = {
        dialog:'#globel-dialog-div',
        datagrid:'#adminRoleDatagrid',
        operate:function(val, row){
            var btns = [];
            btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="adminRoleModule.edit(' + row.role_id + ')" title="编辑"><i class="fa fa-pencil-square-o fa-lg"></i></a>');
            btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="adminRoleModule.delete(' + row.role_id + ')" title="删除"><i class="fa fa-trash-o fa-lg"></i></a>');
            btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="adminRoleModule.authorize(' + row.role_id + ')" title="授权"><i class="fa fa-hand-o-right fa-lg"></i></a>');
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
        add:function(){
            var that = this;
            var href = '<?=$urlHrefs['add']?>';
            $(that.dialog).dialog({
                title: '添加角色',
                iconCls: 'fa fa-plus-circle',
                width: <?=$loginMobile?"'90%'":600?>,
                height: '95%',
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
        },
        edit:function(roleId){
            var that = this;
            var href = '<?=$urlHrefs['edit']?>';
            href += href.indexOf('?') != -1 ? '&roleId=' + roleId : '?roleId='+roleId;
            $(that.dialog).dialog({
                title: '修改角色',
                iconCls: iconClsDefs.edit,
                width: <?=$loginMobile?"'90%'":600?>,
                height: '95%',
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
        },
        delete:function(roleId){
            var that = this;
            var href = '<?=$urlHrefs['delete']?>';
            href += href.indexOf('?') != -1 ? '&roleId=' + roleId : '?roleId='+roleId;
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
        authorize:function(roleId){
            var that = this;
            var href = '<?=$urlHrefs['authorize']?>';
            href += href.indexOf('?') != -1 ? '&roleId='+roleId : '?roleId='+roleId;
            var that = this;
            $(that.dialog).dialog({
                title: '角色授权',
                iconCls: 'fa fa-hand-o-right',
                width: <?=$loginMobile?"'90%'":600?>,
                height: '95%',
                cache: false,
                href: href,
                modal: true,
                buttons:[{
                    text:'确定',
                    iconCls:iconClsDefs.ok,
                    handler:function(){
                        var nodes = $(that.dialog).find('#authUserNodeTree').tree('getChecked');
                        if (!nodes.length) {
                            $.app.method.alertError(null, '请选择访问权限');
                            return false;
                        }
                        var nodeIds = [];
                        for (var i in nodes) {
                            if (nodes[i]['pid'] !== '0') {
                                nodeIds.push(nodes[i]['id']);
                            }
                        }
                        $.messager.progress({text:'处理中，请稍候...'});
                        $.post(href, {nodeIds:nodeIds}, function(res){
                            $.messager.progress('close');
                            if(!res.code){
                                $.app.method.alertError(null, res.msg);
                            }else{
                                $.app.method.tip('提示', res.msg, 'info');
                                $(that.dialog).dialog('close');
                                that.reload();
                            }
                        }, 'json');
                    }
                },{
                    text: '取消',
                    iconCls: iconClsDefs.cancel,
                    handler: function(){
                        $(that.dialog).dialog('close');
                    }
                }]
            });
            $(that.dialog).dialog('center');
        }
    };
</script>