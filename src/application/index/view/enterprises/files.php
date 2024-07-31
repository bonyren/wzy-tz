<style>
a.file-type-click{margin-right:10px;text-decoration: none;color:#999;}
a.active{background-color: #2fb5f4;color: #fff;border-radius:5px;padding: 0 5px;}
</style>
<table id="<?=DATAGRID_ID?>" class="easyui-datagrid" data-options="
    nowrap:false,
    striped:true,
    rownumbers:true,
    singleSelect:true,
    selectOnCheck:false,
    checkOnSelect:false,
    url:'<?=url('enterprises/files',['enterprise_id'=>$enterprise_id,'stage'=>$stage])?>',
    toolbar:'#<?=TOOLBAR_ID?>',
    pagination:true,
    pageSize:<?=DEFAULT_PAGE_ROWS?>,
    fit:true,
    fitColumns:<?=$loginMobile?'false':'true'?>,
    onLoadSuccess:<?=JVAR?>.convert,
    border:false">
    <thead>
    <tr>
        <?php if(!$readonly): ?>
        <th data-options="field:'ck',checkbox:true"></th>
        <?php endif; ?>
        <th data-options="field:'name',width:200">文件名称</th>
        <th data-options="field:'type',width:100">类型</th>
        <th data-options="field:'entered',width:100">上传时间</th>
        <th data-options="field:'down',width:50,align:'center'">下载</th>
        <?php if(!$readonly): ?>
        <th data-options="field:'del',width:50,align:'center'">删除</th>
        <?php endif; ?>
    </tr>
    </thead>
</table>
<div id="<?=TOOLBAR_ID?>" style="background-color:#FFF;">
    <div style="padding:0 10px;">
        <p>分类：
            <a href="javascript:void(0)" class="file-type-click active" onclick="<?=JVAR?>.handleTypeClick('',this)">不限</a>
            <?php foreach ($types as $k=>$v): ?>
            <a href="javascript:void(0)" class="file-type-click" onclick="<?=JVAR?>.handleTypeClick('<?=$k?>',this)">
                <?=$k?\app\index\logic\Upload::$attachTypeDefs[$k]['label']:'未分类'?>
            </a>
            <?php endforeach; ?>
        </p>
        <p>
            文件名：<input id="N<?=UNIQID?>" class="easyui-textbox" name="name">
            <a class="easyui-linkbutton" plain="true" iconCls="fa fa-search" onClick="<?=JVAR?>.search()">搜索</a>
            <a class="easyui-linkbutton" plain="true" iconCls="fa fa-reply" onClick="<?=JVAR?>.reset()">重置</a>
            <?php if(!$readonly): ?>
            |
            <a class="easyui-linkbutton" plain="true" iconCls="fa fa-cloud-upload" onClick="<?=JVAR?>.upload()">上传文件</a>
            <a class="easyui-linkbutton" plain="true" iconCls="fa fa-file-zip-o" onClick="<?=JVAR?>.uploadZip()">上传Zip</a>
            <a class="easyui-linkbutton" plain="true" iconCls="fa fa-pencil-square-o" onClick="<?=JVAR?>.settype()">归类</a>
            <a class="easyui-linkbutton" plain="true" iconCls="fa fa-trash-o" onClick="<?=JVAR?>.remove()">删除</a>
            <?php endif; ?>
        </p>
    </div>
</div>
<script>
var <?=JVAR?> = {
    datagrid:'#<?=DATAGRID_ID?>',
    toolbar:'#<?=TOOLBAR_ID?>',
    types:<?=json_encode(\app\index\logic\Upload::$attachTypeDefs,JSON_UNESCAPED_UNICODE)?>,
    params:{type:'',name:''},
    checkedType:'',
    currentDirId:0, //当前目录id
    convert:function(data){
        var that = <?=JVAR?>;
        $.each(data.rows, function(i,v){
            var name = '';
            if(v.isdir == '1'){
                name = '<a onclick="<?=JVAR?>.listDir('+v.attachment_id+')" href="javascript:void(0)"><i class="fa fa-folder text-orange mr-10"></i>'+v.original_name+'</a>';
            } else {
                name = '<a href="javascript:void(0)" onclick="QT.filePreview('+v.attachment_id+')">' + v.original_name + '</a>';
            }
            $(that.datagrid).datagrid('updateRow',{
                index: i,
                row: {
                    // size:(v.size/1024).toFixed(2) + 'KB',
                    name:name,
                    type:(v.attachment_type in that.types)?that.types[v.attachment_type].label:'<span class="text-red">未分类</span>',
                    entered:v.entered == '0000-00-00 00:00:00' ? '' : v.entered.substr(0,16),
                    down: v.isdir == '1' ? '' : '<a class="text-secondary size-MINI fa fa-download" href="<?=url('Upload/downloadAttach')?>?attachmentId='+v.attachment_id+'" target="_blank">&nbsp;</a>',
                    del:'<a class="text-danger size-MINI fa fa-remove" href="javascript:void(0)" onclick="<?=JVAR?>.remove('+v.attachment_id+')">&nbsp;</a>',
                }
            });
        });
    },
    upload:function(){
        var that = this;
        if ('' === that.checkedType) {
            $.app.method.tip('提示','请先选择分类','error');
            return;
        }
        var url = '<?=url('Upload/uploadAttach',['externalId'=>$enterprise_id])?>&attachmentType='+that.checkedType+'&pid='+that.currentDirId;
        $.app.method.upload(url, function (obj){
            if(!obj.code){
                $.app.method.tip('提示',obj.msg,'error');
                return;
            }else{
                if (obj.html) {
                    $.messager.alert('提示',obj.html,'warning');
                } else {
                    $.app.method.tip('提示','成功','info');
                }
            }
            $(that.datagrid).datagrid('reload');
        });
    },
    uploadZip:function(){
        var that = this;
        var url = '<?=url('Upload/uploadAttachZip',['externalId'=>$enterprise_id])?>&attachmentType='+that.checkedType+'&pid='+that.currentDirId;
        $.app.method.uploadZip(url, function (obj) {
            if(!obj.code){
                $.app.method.tip('提示',obj.msg,'error');
            } else {
                $.app.method.tip('提示','成功','info');
                $(that.datagrid).datagrid('reload');
            }
        });
    },
    search:function(){
        var that = this;
        var data = that.params;
        data.name = $('#N<?=UNIQID?>').textbox('getValue');
        $(that.datagrid).datagrid('load',{search:data});
    },
    reset:function(){
        var that = this;
        that.checkedType = '';
        that.params = {type:'',name:''};
        that.currentDirId = 0;
        $(that.toolbar).find('.easyui-textbox').textbox('clear');
        $(that.toolbar).find('a.file-type-click:eq(0)').addClass('active').siblings().removeClass('active');
        $(that.datagrid).datagrid('load',{});
    },
    listDir:function(id){
        this.currentDirId = id;
        $(this.datagrid).datagrid('load',{pid:id});
    },
    handleTypeClick:function(type,target){
        var that = this;
        $(that.toolbar).find('.easyui-textbox').textbox('clear');
        $(target).addClass('active').siblings().removeClass('active');
        that.params.type = type;
        that.checkedType = type;
        $(that.datagrid).datagrid('load',{search:{type:type}});
    },
    settype:function(){
        var that = this;
        var rows = $(that.datagrid).datagrid('getChecked');
        if (0 == rows.length) {
            $.app.method.tip('提示', '请选择要修改的文件', 'error');
            return;
        }
        var ids = [];
        $.each(rows,function(i,v){
            ids.push(v.attachment_id);
        });
        var $dialog = QT.helper.genDialogId('dialog-file-edit-type');
        var url = '<?=url('Upload/setAttachesType')?>?attachmentId='+ids.join(',')+'&entity_type=<?=\app\index\logic\Defs::ENTITY_PROJECT?>';
        $dialog.dialog({
            title: '文件归类',
            iconCls: 'fa fa-pencil-square',
            href:url,
            width: 450,
            height: 150,
            cache: false,
            modal: true,
            buttons:[{
                text:'提交',
                iconCls:iconClsDefs.ok,
                handler: function(){
                    var $form = $dialog.find('form');
                    if(!$form.form('validate')){
                        return false;
                    }
                    $.messager.progress({text:'处理中，请稍候...'});
                    $.post(url, $form.serialize(), function(res){
                            $.messager.progress('close');
                            if(!res.code){
                                $.app.method.alertError(null, res.msg);
                            }else{
                                $.app.method.tip('提示', res.msg);
                                $dialog.dialog('close');
                                $(that.datagrid).datagrid('reload');
                            }
                        }, 'json'
                    );
                }
            },{
                text:'取消',
                iconCls:iconClsDefs.cancel,
                handler: function(){
                    $dialog.dialog('close');
                }
            }]
        });
        $dialog.dialog('center');
    },
    remove:function(id){
        var that = this;
        var ids = [];
        if (!id) {
            var rows = $(that.datagrid).datagrid('getChecked');
            if (0 == rows.length) {
                $.app.method.tip('提示', '请选择要删除的文件', 'error');
                return;
            }
            $.each(rows,function(i,v){
                ids.push(v.attachment_id);
            });
        } else {
            ids = id;
        }
        $.messager.confirm('提示', '确认删除吗?', function(result){
            if(!result) return false;
            $.messager.progress({text:'处理中，请稍候...'});
            $.post('<?=url('Upload/deleteAttach')?>', {attachmentId:ids}, function(res){
                $.messager.progress('close');
                if(!res.code){
                    $.app.method.alertError(null, res.msg);
                }else{
                    $.app.method.tip('提示', res.msg, 'info');
                    $(that.datagrid).datagrid('reload');
                }
            }, 'json');
        });
    }
};
</script>