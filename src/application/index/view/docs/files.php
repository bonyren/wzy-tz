<table id="<?=DATAGRID_ID?>" class="easyui-treegrid"
       data-options="url:'<?=url('Docs/files', ['category'=>$category, 'owned'=>$owned])?>',
        method:'post',
        striped:true,
        nowrap:true,
        fit:true,
        fitColumns:<?=$loginMobile?'false':'true'?>,
        rownumbers: true,
        border:false,
        idField:'id',
        treeField:'name',
        lines:true,
        animate:true,
        pagination:true,
        pageSize:<?=DEFAULT_PAGE_ROWS?>,
        pageList:[10,20,30,50,80,100],
        toolbar:'#<?=TOOLBAR_ID?>'">
    <thead>
    <tr>
        <th field="name" width="200">名称</th>
        <th field="type" width="100" align="center">类型</th>
        <th field="size" width="60" align="center">大小</th>
        <th field="entered" width="100" align="center">上传时间</th>
        <th field="user" width="100" align="center">上传人</th>
        <th field="opt" width="50" align="center" formatter="<?=JVAR?>.formatOpt">下载</th>
    </tr>
    </thead>
</table>
<div id="<?=TOOLBAR_ID?>" class="p-1">
    <form id="<?=FORM_ID?>">
        <?php
        if($category == 1){
            echo "项目名称:";
        }else if($category == 2){
            echo "基金名称:";
        }
        ?>
        <input name="search[name]" class="easyui-textbox" data-options="width:160" />
        <a class="easyui-linkbutton" data-options="iconCls:'fa fa-search',
                    onClick:function(){ <?=JVAR?>.search(); }">搜索
        </a>
        <a class="easyui-linkbutton" data-options="iconCls:'fa fa-reply',
                    onClick:function(){ <?=JVAR?>.reset(); }">重置
        </a>
    </form>
</div>

<script type="text/javascript">
    var <?=JVAR?> = {
        treegrid:'#<?=DATAGRID_ID?>',
        searchForm: '#<?=FORM_ID?>',
        formatOpt:function(val, row){
            var btns = [];
            if(row.entered){
                btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="<?=JVAR?>.download(\'' + row.id + '\')" title="下载"><i class="fa fa-cloud-download fa-lg">下载</i></a>');
            }
            return btns.join(' ');
        },
        download:function(id){
            var ids = id.split('_');
            var attachmentId = ids[ids.length - 1];
            var url = '<?=url('Upload/downloadAttach')?>';
            url = GLOBAL.func.addUrlParam(url, 'attachmentId', attachmentId);
            window.open(url);
        },
        reload:function(){
            $(this.treegrid).treegrid('reload');
        },
        search:function(){
            var param = {};
            $.each($(this.searchForm).serializeArray(), function(){
                param[this.name] = this.value;
            });
            $(this.treegrid).treegrid('load', param);
        },
        reset:function(){
            $(this.searchForm).form('reset');
            $(this.treegrid).treegrid('load', {});
        }
    };
</script>