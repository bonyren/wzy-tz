<table id="scientistFieldDatagrid" data-options="striped:true,
    nowrap:false,
    rownumbers:true,
    autoRowHeight:true,
    singleSelect:true,
    url:'',
    method:'post',
    pagination:true,
    pageSize:<?=DEFAULT_PAGE_ROWS?>,
    pageList:[10,20,30,50,80,100],
    border:false,
    fit:true,
    fitColumns:<?=$loginMobile?'false':'true'?>,
    title:''">
    <thead>
    <tr>
        <?php 
        foreach($datagrid['fields'] as $label=>$field){ 
            $optionStr = '';
            foreach($field as $optionLabel=>$optionValue){
                $optionStr .= $optionLabel;
                $optionStr .= ":";
                if(is_string($optionValue)){
                    if($optionLabel == 'formatter'){
                        $optionStr .= "{$optionValue}";
                        $optionStr .= ",";
                    }else{
                        $optionStr .= "'{$optionValue}'";
                        $optionStr .= ",";
                    }
                }else if(is_numeric($optionValue)){
                    $optionStr .= "{$optionValue}";
                    $optionStr .= ",";
                }else if(is_bool($optionValue)){
                    $optionStr .= json_encode($optionValue);
                    $optionStr .= ",";
                }
            }
        ?>
        <th data-options="<?=$optionStr?>">
            <?=$label?>
        </th>
        <?php } ?>
    </tr>
    </thead>
</table>

<script type="text/javascript">
    var scientistFieldModule = {
        dialog:   '#globel-dialog-div',
        datagrid: '#scientistFieldDatagrid',
        //工具栏
        toolbar: [
            { text: '添加', iconCls: iconClsDefs.add, handler: function(){scientistFieldModule.save();} },
            { text: '刷新', iconCls: 'fa fa-refresh', handler: function(){scientistFieldModule.reload();} }
        ],
        operate: function(val, row ,index){
            var btn = [];
            btn.push('<a href="javascript:;" onclick="scientistFieldModule.save('+row.id+',\''+HtmlUtil.htmlEncode(row.name)+'\''+')"><i class="fa fa-pencil-square-o fa-lg"></i></a>');
            btn.push('<a href="javascript:;" onclick="scientistFieldModule.delete('+row.id+',\''+HtmlUtil.htmlEncode(row.name)+'\''+')"><i class="fa fa-trash-o fa-lg"></i></a>');
            return btn.join(' | ');
        },
        reload:function(){
            $(this.datagrid).datagrid('reload');
        },
        save: function(id=0, title=''){
            var that = this;
            var href = '<?=$urlHrefs['save']?>';
            href = GLOBAL.func.addUrlParam(href, 'id', id);
            if(id == 0){
                var dialogTitle = '新增科学家领域';
                var iconCls = 'fa fa-plus-circle';
            }else{
                var dialogTitle = '修改科学家领域 - ' + title;
                var iconCls = 'fa fa-pencil-square';
            }
            $(that.dialog).dialog({
                title: dialogTitle,
                iconCls: iconCls,
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
                        var $form = $(that.dialog).find('form').eq(0);
                        var isValid = $form.form('validate');
                        if (!isValid) return false;
                        $.messager.progress({text:'处理中，请稍候...'});
                        $.post(href, $form.serialize(), function(res){
                            $.messager.progress('close');
                            if(!res.code){
                                $.app.method.alertError(null, res.msg);
                            }else{
                                $.app.method.tip('提示', res.msg, 'info');
                                $(that.dialog).dialog('close');
                                that.reload();
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
        delete: function(id, title){
            var that = this;
            var href = '<?=$urlHrefs['delete']?>';
            href += href.indexOf('?') != -1 ? '&id=' + id : '?id='+id;
            $.messager.confirm('提示', '确认删除['+title+']吗?', function(result){
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
	var options = <?=json_encode($datagrid['options'])?>;
    for(var key in options){
        if(key=='toolbar'){
            options[key] = scientistFieldModule.toolbar;
        }
    }
    $('#scientistFieldDatagrid').datagrid(options);
</script>