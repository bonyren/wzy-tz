<table id="attachmentsDatagrid" class="easyui-datagrid" data-options="striped:true,
    nowrap:false,
    rownumbers:true,
    autoRowHeight:true,
    singleSelect:true,
    url:'<?=$urlHrefs['docs']?>',
    method:'post',
    toolbar:'#attachmentsToolbar',
    pagination:true,
    pageSize:<?=DEFAULT_PAGE_ROWS?>,
    pageList:[10,20,30,50,80,100],
    border:false,
    fit:true,
    fitColumns:<?=$loginMobile?'false':'true'?>,
    title:'',
    onLoadSuccess:function(data){
        $.each(data.rows, function(i, row){
            $('#doc-file-' + i).attaches({
                attachmentType:row.attachment_type,
                externalId:row.external_id,
                uiStyle:<?=\app\index\controller\Upload::ATTACHES_UI_LIGHT_STYLE?>,
                prompt:'',
                readOnly:true
            });
        });
    }
    ">
    <thead>
    <tr>
        <th data-options="field:'operate',width:60,fixed:true,align:'center',formatter:attachmentsModule.operate">操作</th>
        <th data-options="field:'attachment_type',width:150,fixed:true,align:'center',formatter:attachmentsModule.formatType">类型</th>
        <th data-options="field:'external_name',width:200,fixed:true,align:'center'">所属</th>
        <th data-options="field:'file',align:'center',width:300,formatter:attachmentsModule.formatFile"></th>
    </tr>
    </thead>
</table>
<div id="attachmentsToolbar" class="p-1">
    <form id="attachmentsToolbarForm">
        文件类型:
        <select class="easyui-combobox" name="search[attachment_type]" data-options="editable:false,panelHeight:300,width:200,value:''">
            <?php foreach(\app\index\logic\Upload::$attachTypeDefs as $key=>$value){ ?>
            <option value="<?=$key?>"><?=$value['label']?></option>
            <?php } ?>
        </select>
        <a class="easyui-linkbutton" data-options="iconCls:'fa fa-search',
                    onClick:function(){ attachmentsModule.search(); }">搜索
        </a>
        <a class="easyui-linkbutton" data-options="iconCls:'fa fa-reply',
                    onClick:function(){ attachmentsModule.reset(); }">重置
        </a>
    </form>
</div>
<script>
    var attachmentsModule = {
        dialog:'#globel-dialog-div',
        datagrid:'#attachmentsDatagrid',
        operate:function(val, row){
            var btns = [];
            btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="attachmentsModule.delete(' + row.attachment_type + ',' + row.external_id + ')" title="删除"><i class="fa fa-trash-o fa-lg"></i></a>');
            return btns.join(' ');
        },
        formatType:function(val, row){
            var typeObj = <?=json_encode(\app\index\logic\Upload::$attachTypeDefs,JSON_UNESCAPED_UNICODE)?>;
            return (val in typeObj) ? typeObj[val].label : '';
        },
        formatFile:function(val, row, index){
            return '<div id="doc-file-' + index + '"></div>';
        },
        reload:function(){
            $(this.datagrid).datagrid('reload');
        },
        load:function(){
            $(this.datagrid).datagrid('load');
        },
        search:function(){
            var that = this;
            var queryParams = $(that.datagrid).datagrid('options').queryParams;
            //reset the query parameter
            $.each($("#attachmentsToolbarForm").serializeArray(), function(i, v) {
                delete queryParams[this['name']];
            });
            $.each($("#attachmentsToolbarForm").serializeArray(), function(i, v) {
                queryParams[this['name']] = this['value'];
            });
            that.load();
        },
        reset:function(){
            var that = this;
            $("#attachmentsToolbarForm").form('reset');
            var queryParams = $(that.datagrid).datagrid('options').queryParams;
            $.each($("#attachmentsToolbarForm").serializeArray(), function(i, v) {
                delete queryParams[this['name']];
            });
            that.load();
        },
        delete:function(attachmentType, externalId){
            var that = this;
            var href = '<?=$urlHrefs['delete']?>';
            $.messager.confirm('提示', '确认删除吗?', function(result){
                if(!result) return false;
                $.messager.progress({text:'处理中，请稍候...'});
                $.post(href, {
                    attachmentType:attachmentType,
                    externalId:externalId
                }, function(res){
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