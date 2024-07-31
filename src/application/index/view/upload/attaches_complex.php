<style>
    .attaches-breadcrumb{z-index:1;background-color:#F2F5FF;margin-left: 10px;}/*导航条背景*/
    .attaches-breadcrumb > ul{ font-size: 0; line-height: 0; margin-bottom: 0; padding-left: 0;}
    .attaches-breadcrumb > ul > li,
    .attaches-breadcrumb > ul > li > a{height:40px;line-height:40px}/*导航条高度*/
    .attaches-breadcrumb > ul > li{display:inline-block;color:#fff;font-size:14px;font-weight:bold}/*设置字体*/
    .attaches-breadcrumb > ul > li > a{display:inline-block;padding:0 20px;color:#005580;text-align:center}/*链接颜色*/
    .attaches-breadcrumb > ul > li > a:hover,
    .attaches-breadcrumb > ul > li.current > a{color:#000000;text-decoration:none; background-color:#F2F5FF;-webkit-transition: background-color 0.3s ease 0s; -moz-transition: background-color 0.3s ease 0s; -o-transition: background-color 0.3s ease 0s; -ms-transition: background-color 0.3s ease 0s;transition: background-color 0.3s ease 0s}/*交互颜色*/
    .attaches-breadcrumb > ul > li + li:before {
        color: #CCCCCC;
        content: "/ ";
        padding: 0 5px;
    }
</style>
<table id="attachesComplexDatagrid_<?=$uniqid?>" class="easyui-datagrid" data-options="striped:true,
    nowrap:false,
    rownumbers:true,
    autoRowHeight:true,
    singleSelect:true,
    selectOnCheck:false,
    checkOnSelect:false,
    url:'<?=$urlHrefs['attachesComplex']?>',
    method:'post',
    toolbar:'#attachesComplexToolbar_<?=$uniqid?>',
    pagination:false,
    border:false,
    fit:<?=$fit?'true':'false'?>,
    fitColumns:<?=$loginMobile?'false':'true'?>,
    title:'<?=$_GET['title']?>',
    dragSelection:false,
    onLoadSuccess:function(data){
        $(this).datagrid('enableDnd');
        breadcrumbsModule_<?=$uniqid?>.refresh();
    },
    onBeforeDrag:function(row){
        <?php if(!$readOnly){ ?>
        return row.attachment_id==0?false:true;
        <?php }else{ ?>
        return false;
        <?php } ?>
    },
    onStartDrag:function(row){
        //console.log('onStartDrag');
    },
    onDragEnter:function(targetRow, sourceRow){
        //console.log('onDragEnter');
        //return targetRow.attachment_category_id==sourceRow.attachment_category_id?false:true;
        return targetRow.isdir == '1';
    },
    onDragOver:function(targetRow, sourceRow){
        //console.log('onDragOver');
        //return targetRow.attachment_category_id==sourceRow.attachment_category_id?false:true;
        return targetRow.isdir == '1';
    },
    onBeforeDrop:function(targetRow, sourceRow, point){
        //console.log('onBeforeDrop', targetRow);
        //return targetRow==null?false:true;
        if (!targetRow || targetRow.isdir == '0') {
            return false;
        } else {
            return window.confirm('确定移动到【'+targetRow.original_name+'】文件夹下吗？');
        }
    },
    onDrop:function(targetRow, sourceRow, point){
        //console.log('onDrop', targetRow);
        //attachesComplexModule_<?=$uniqid?>.changeCategory(sourceRow.attachment_id, targetRow.attachment_category_id);
        attachesComplexModule_<?=$uniqid?>.changeDir(sourceRow.attachment_id, targetRow.attachment_id);
        return false;
    }
    ">
    <thead>
    <tr>
        <?php if(!$readOnly){ ?>
        <th data-options="field:'ck',checkbox:true"></th>
        <?php } ?>
        <th data-options="field:'original_name',align:'left',width:300,formatter:attachesComplexModule_<?=$uniqid?>.formatName">文件名</th>
        <!--
        <th data-options="field:'size',align:'center',width:100,formatter:GLOBAL.func.byteFormat">大小(Bytes)</th>
        -->
        <th data-options="field:'entered',align:'center',width:100,formatter:GLOBAL.func.dateTimeFilter">时间</th>
        <th data-options="field:'download_url',align:'center',width:60,formatter:attachesComplexModule_<?=$uniqid?>.formatDownload">下载</th>
        <?php if(!$readOnly){ ?>
        <th data-options="field:'opt',align:'center',width:60,formatter:attachesComplexModule_<?=$uniqid?>.formatOperate">删除</th>
        <?php } ?>
    </tr>
    </thead>
</table>
<div id="attachesComplexToolbar_<?=$uniqid?>" class="p-1">
    <?php if(!$readOnly){ ?>
    <div>
        <!--
        <a href="#" class="easyui-linkbutton" data-options="onClick:function(){ attachesComplexModule_<?=$uniqid?>.addCategory(); },iconCls:'fa fa-plus-square-o'">添加类别</a>
        -->
        <a href="#" class="easyui-linkbutton" data-options="onClick:function(){ attachesComplexModule_<?=$uniqid?>.addDir(); },iconCls:'fa fa-folder-o'">新建文件夹</a>
        <a href="#" class="easyui-linkbutton" data-options="onClick:function(){ attachesComplexModule_<?=$uniqid?>.uploadAttach(0); },iconCls:'fa fa-cloud-upload'">上传文件</a>
        <a href="#" class="easyui-linkbutton" data-options="onClick:function(){ attachesComplexModule_<?=$uniqid?>.uploadZip(); },iconCls:'fa fa-file-zip-o'">上传zip文件</a>
        <a href="#" class="easyui-linkbutton" data-options="onClick:function(){ attachesComplexModule_<?=$uniqid?>.deleteAttaches(); },iconCls:'fa fa-trash-o'">批量删除</a>
    </div>
    <?php } ?>
    <div class="line my-1"></div>
    <div class="d-flex justify-content-start">
        <form id="attachesComplexToolbarForm_<?=$uniqid?>" style="width: 400px;">
            文件名:
            <input name="search[name]" class="easyui-textbox" data-options="width:200" />
            <a class="easyui-linkbutton" data-options="iconCls:'fa fa-search',
                        onClick:function(){ attachesComplexModule_<?=$uniqid?>.search(); }">搜索
            </a>
            <a class="easyui-linkbutton" data-options="iconCls:'fa fa-reply',
                        onClick:function(){ attachesComplexModule_<?=$uniqid?>.reset(); }">重置
            </a>
        </form>
        <div class="attaches-breadcrumb">
            <ul id="attaches-breadcrumb_<?=$uniqid?>">
            </ul>
        </div>
    </div>
</div>
<script>
    var breadcrumbsModule_<?=$uniqid?> = function(){
        var breadcrumbs = [{id:0,text:'Home'}];
        return {
            refresh:function(){
                var breadcrumbsAfter = breadcrumbs.map(function(currentBreadcrumb, index){
                    if(index == breadcrumbs.length - 1){
                        return '<li class="current"><a href="#">' + currentBreadcrumb.text + '</a></li>';
                    }else {
                        return '<li><a href="#" onclick="breadcrumbsModule_<?=$uniqid?>.switchBreadCrumb(' + currentBreadcrumb.id + ',\'' + currentBreadcrumb.text + '\')">' + currentBreadcrumb.text + '</a></li>';
                    }
                });
                $('#attaches-breadcrumb_<?=$uniqid?>').html(breadcrumbsAfter.join(''));
            },
            openDir:function(id, text){
                breadcrumbs.push({
                    id:id,
                    text:text
                });
                attachesComplexModule_<?=$uniqid?>.listDir(id, text);
            },
            switchBreadCrumb:function(id, text){
                var findIndex = breadcrumbs.findIndex(function(currentBreadcrumb, index){
                    if(currentBreadcrumb.id == id){
                        return true;
                    }
                });
                if(findIndex >= 0){
                    breadcrumbs.splice(findIndex + 1);
                }
                //console.log(breadcrumbs);
                attachesComplexModule_<?=$uniqid?>.listDir(id, text);
            }
        };
    }();
    var attachesComplexModule_<?=$uniqid?> = {
        categoryDefs:<?=json_encode($categoryDefs, JSON_UNESCAPED_UNICODE)?>,
        dialog:'#globel-dialog-div',
        dialog2:'#globel-dialog2-div',
        datagrid:'#attachesComplexDatagrid_<?=$uniqid?>',
        currentDirId:0,
        /*
        formatGroup:function(val, rows){
            var count = 0;
            for(var key in rows){
                if(rows[key].attachment_id > 0){
                    count++;
                }
            }
            var btns = [];
            btns.push(attachesComplexModule_<?=$uniqid?>.categoryDefs[val] + ' - ' + count + ' file(s)');
            <?php if(!$readOnly){ ?>
            if(val > 0) {
                btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="attachesComplexModule_<?=$uniqid?>.editCategory(' + val + ')" title="修改类别"><i class="fa fa-pencil-square-o"></i></a>');
                btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="attachesComplexModule_<?=$uniqid?>.deleteCategory(' + val + ')" title="删除类别"><i class="fa fa-trash-o"></i></a>');
                btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="attachesComplexModule_<?=$uniqid?>.uploadAttach(' + val + ')" title="上传"><i class="fa fa-cloud-upload"></i></a>');
            }else{
                btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="attachesComplexModule_<?=$uniqid?>.uploadAttach(' + val + ')" title="上传"><i class="fa fa-cloud-upload"></i></a>');
            }
            <?php } ?>
            return btns.join(' ');
        },*/
        formatName:function(val, row, index){
            if(row.attachment_id == 0){
                return '';
            }
            if(row.isdir == '1'){
                return '<a onclick="breadcrumbsModule_<?=$uniqid?>.openDir('+row.attachment_id+',\'' + GLOBAL.func.escapeChar(row.original_name) + '\')" href="javascript:void(0)"><i class="fa fa-folder text-orange mr-10"></i>'+val+'</a>';
            }
            return '<a title="' + val + '" href="javascript:void(0)" onclick="QT.filePreview(' + row.attachment_id + ')">' + val + '</a>';
        },
        formatDownload:function(val, row, index){
            if(row.attachment_id == 0 || row.isdir == '1'){
                return '';
            }
            return '<a class="text-secondary size-MINI fa fa-download" href="' + row.download_url + '" target="_blank">&nbsp;</a>';
        },
        formatOperate:function(val, row, index){
            if(row.attachment_id == 0){
                return '';
            }
            var btns = [];
            btns.push('<a class="text-danger size-MINI fa fa-remove" href="javascript:void(0)" onclick="attachesComplexModule_<?=$uniqid?>.deleteAttach(' + row.attachment_id + ')">&nbsp;</a>');
            return btns.join(' ');
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
            $.each($("#attachesComplexToolbarForm_<?=$uniqid?>").serializeArray(), function(i, v) {
                delete queryParams[this['name']];
            });
            $.each($("#attachesComplexToolbarForm_<?=$uniqid?>").serializeArray(), function(i, v) {
                queryParams[this['name']] = this['value'];
            });
            that.load();
        },
        reset:function(){
            var that = this;
            $("#attachesComplexToolbarForm_<?=$uniqid?>").form('reset');
            var queryParams = $(that.datagrid).datagrid('options').queryParams;
            $.each($("#attachesComplexToolbarForm_<?=$uniqid?>").serializeArray(), function(i, v) {
                delete queryParams[this['name']];
            });
            queryParams.pid = 0;
            that.load();
        },
        listDir:function(id, name){
            $(this.datagrid).datagrid('load',{pid:id});
            this.currentDirId = id;
        },
        changeDir:function(id,pid){
            var that = this;
            $.messager.progress({text:'处理中，请稍候...'});
            $.post('<?=url('Upload/changeDir')?>', {attachment_id:id,pid:pid}, function(res){
                $.messager.progress('close');
                if(!res.code){
                    $.app.method.alertError(null, res.msg);
                }else{
                    $.app.method.tip('提示', res.msg, 'info');
                    that.reload();
                }
            }, 'json');
        },
        addDir:function(){
            var that = this;
            var href = '<?=url('Upload/addDir')?>';
            $.messager.prompt('提示', '请输入文件夹名', function(result){
                if(!result) return false;
                $.messager.progress({text:'处理中，请稍候...'});
                $.post(href, {
                    external_id:<?=$bindValues['externalId']?>,
                    external_id2:<?=$bindValues['externalId2']?>,
                    attachment_type:<?=$bindValues['attachmentType']?>,
                    dir_name:result,
                    pid:that.currentDirId
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
        },
        uploadZip:function(){
            var that = this;
            var url = '<?=$urlHrefs['uploadAttachZip']?>';
            url += url.indexOf('?')==-1?'?':'&';
            url += '&pid='+that.currentDirId;
            $.app.method.uploadZip(url, function (obj) {
                if(!obj.code){
                    $.app.method.tip('提示',obj.msg,'error');
                    return;
                }else{
                    $.app.method.tip('提示','成功','info');
                    that.reload();
                }
            });
        },
        uploadAttach:function(attachmentCategoryId){
            var that = this;
            var url = '<?=$urlHrefs['uploadAttach']?>';
            url += url.indexOf('?')==-1?'?':'&';
            url += 'attachmentCategoryId='+attachmentCategoryId;
            url += '&pid='+that.currentDirId;
            $.app.method.upload(url, function (obj) {
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
                that.reload();
            });
        },
        deleteAttach:function(attachmentId){
            var that = this;
            var href = '<?=$urlHrefs['deleteAttach']?>';
            href += href.indexOf('?') != -1 ? '&attachmentId=' + attachmentId : '?attachmentId='+attachmentId;
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
        deleteAttaches:function(){
            var that = this;
            var attachmentIds = [];
            var rows = $(that.datagrid).datagrid('getChecked');
            if(rows.length == 0){
                $.app.method.alertError(null, '请选择要删除的文件');
                return;
            }
            $.each(rows, function(index, val){
                attachmentIds.push(val.attachment_id);
            });
            var href = '<?=$urlHrefs['deleteAttaches']?>';
            $.messager.confirm('提示', '确认删除吗?', function(result){
                if(!result) return false;
                $.messager.progress({text:'处理中，请稍候...'});
                $.post(href, {attachmentIds:attachmentIds}, function(res){
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