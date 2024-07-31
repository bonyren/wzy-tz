<table id="adminsDatagrid" class="easyui-datagrid" data-options="striped:true,
    nowrap:false,
    rownumbers:true,
    autoRowHeight:true,
    singleSelect:true,
    <?php if(isset($_GET['dialog_call']) && $_GET['dialog_call'] && isset($_GET['multiple']) && $_GET['multiple']): ?>
    selectOnCheck:false,
    checkOnSelect:false,
    <?php endif; ?>
    url:'<?=$urlHrefs['admins']?>',
    method:'post',
    toolbar:'#adminsToolbar',
    pagination:true,
    pageSize:<?=DEFAULT_PAGE_ROWS?>,
    pageList:[10,20,30,50,80,100],
    border:false,
    fit:true,
    fitColumns:<?=$loginMobile?'false':'true'?>,
    title:''">
    <thead>
    <tr>
        <?php if(isset($_GET['dialog_call']) && $_GET['dialog_call'] && isset($_GET['multiple']) && $_GET['multiple']): ?>
        <th field="ck" checkbox="true"></th>
        <?php endif; ?>
        <th data-options="field:'operate',width:100,fixed:true,align:'center',formatter:adminsModule.operate">操作</th>
        <th data-options="field:'realname',width:200,align:'center'">姓名</th>
        <th data-options="field:'login_name',width:200,align:'center'">登录名</th>
        <th data-options="field:'email',width:200,align:'center'">邮箱</th>
        <th data-options="field:'super_user',width:200,align:'center',formatter:adminsModule.formatSuper">类型</th>
        <th data-options="field:'role_name',width:100,align:'center'">角色</th>
        <th data-options="field:'disabled',width:200,align:'center',formatter:adminsModule.formatDisabled">状态</th>
    </tr>
    </thead>
</table>
<div id="adminsToolbar" class="p-1">
    <div>
        <a href="#" class="easyui-linkbutton" data-options="onClick:function(){ adminsModule.add(); },iconCls:iconClsDefs.add">添加用户</a>
    </div>
    <div class="line my-1"></div>
</div>
<script>
    var adminsModule = {
        dialog:'#globel-dialog-div',
        datagrid:'#adminsDatagrid',
        operate:function(val, row){
            var btns = [];
            btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="adminsModule.edit(' + row.admin_id + ')" title="编辑"><i class="fa fa-pencil-square-o fa-lg"></i></a>');
            btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="adminsModule.delete(' + row.admin_id + ')" title="删除"><i class="fa fa-trash-o fa-lg"></i></a>');
            btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="adminsModule.changePwd(' + row.admin_id + ')" title="修改密码"><i class="fa fa-key fa-lg"></i></a>');
            return btns.join(' ');
        },
        formatSuper:function(val, row){
            if(val == <?=\app\index\model\Admins::eAdminSuperRole?>){
                return '<span class="badge badge-success radius mt-1">超级用户</span>';
            }else{
                return '<span class="badge badge-default radius mt-1">普通用户</span>';
            }
        },
        formatDisabled:function(val, row){
            if(val == <?=\app\index\model\Admins::eAdminEnableStatus?>){
                return '<span class="badge badge-success radius mt-1">有效</span>';
            }else{
                return '<span class="badge badge-default radius mt-1">无效</span>';
            }
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
            var href = '<?=$urlHrefs['adminsAdd']?>';
            $(that.dialog).dialog({
                title: '添加用户',
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
        edit:function(adminId){
            var that = this;
            var href = '<?=$urlHrefs['adminsEdit']?>';
            href += href.indexOf('?') != -1 ? '&adminId=' + adminId : '?adminId='+adminId;
            $(that.dialog).dialog({
                title: '修改用户',
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
        delete:function(adminId){
            var that = this;
            var href = '<?=$urlHrefs['adminsDelete']?>';
            href += href.indexOf('?') != -1 ? '&adminId=' + adminId : '?adminId='+adminId;
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
        changePwd:function(adminId){
            var that = this;
            var href = '<?=$urlHrefs['adminsChangePwd']?>';
            href += href.indexOf('?') != -1 ? '&adminId=' + adminId : '?adminId='+adminId;
            $(that.dialog).dialog({
                title: '修改管理员密码',
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
        }
    };

</script>