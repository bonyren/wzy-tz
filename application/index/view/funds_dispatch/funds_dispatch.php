<table id="fundsDispatchDatagrid" class="easyui-datagrid" data-options="striped:true,
    nowrap:false,
    rownumbers:true,
    autoRowHeight:true,
    singleSelect:true,
    url:'<?=$urlHrefs['index']?>',
    method:'post',
    pagination:true,
    pageSize:<?=DEFAULT_PAGE_ROWS?>,
    pageList:[10,20,30,50,80,100],
    border:false,
    fit:true,
    fitColumns:<?=$loginMobile?'false':'true'?>,
    title:'',
    onDblClickRow:function(index, row){
        //fundsDispatchModule.view(row.id);
    },
    view: detailview,
    detailFormatter:function(index,row){
        return fundsDispatchModule.detailFormatter();
    },
    onExpandRow:function(index,row){
        var ddv = $(this).datagrid('getRowDetail',index).find('div.ddv');
        var href = '<?=$urlHrefs['fundsDispatchDetail']?>';
        var ffiId = row.ffi_id;
        href += href.indexOf('?') != -1 ? '&ffiId=' + ffiId : '?ffiId='+ffiId;
        ddv.panel({
            border:false,
            cache:false,
            href:href,
            onLoad:function(){
                $('#fundsDispatchDatagrid').datagrid('fixDetailRowHeight',index);
            }
        });
        $('#fundsDispatchDatagrid').datagrid('fixDetailRowHeight',index);
    }
    ">
    <thead>
    <tr>
        <?php if(!$readOnly){ ?>
            <th data-options="field:'operate',width:100,fixed:true,align:'center',formatter:fundsDispatchModule.operate">操作</th>
        <?php } ?>
        <th data-options="field:'name',width:200,align:'center'">项目名称</th>
        <th data-options="field:'e_type',width:200,align:'center',formatter:fundsDispatchModule.transExitType">分配类型</th>
        <th data-options="field:'amount',width:100,align:'center',formatter:fundsDispatchModule.thousandSeparator">分配金额</th>
        <th data-options="field:'date',width:100,align:'center'">交割时间</th>
    </tr>
    </thead>
</table>
<div id="fundsDispatchToolbar">
</div>
<script>
var fundsDispatchModule={dialog:'#globel-dialog2-div',datagrid:'#fundsDispatchDatagrid',exitTypes:<?=json_encode(\app\index\logic\Defs::ENTERPRISE_EXIT_TYPES,JSON_UNESCAPED_UNICODE)?>,operate:function(val,row){var btns=[];btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="fundsDispatchModule.dispatch('+row.ffi_id+','+row.enterprise_id+')" title="合伙人派发"><i class="fa fa-share-alt fa-lg"></i></a>');return btns.join(' ');},transExitType:function(v){return fundsDispatchModule.exitTypes[v];},detailFormatter:function(){return'<div class="ddv" style="padding:5px 0"></div>';},thousandSeparator:function(v){return parseInt(v).toLocaleString();},reload:function(){$(this.datagrid).datagrid('reload');},load:function(){$(this.datagrid).datagrid('load');},reset:function(){var that=this;var queryParams=$(that.datagrid).datagrid('options').queryParams;for(var key in queryParams){delete queryParams[key];}
that.load();},dispatch:function(ffiId,enterpriseId){var that=this;var href='<?=$urlHrefs['fundsDispatchPartners']?>';href+=href.indexOf('?')!=-1?'&ffiId='+ffiId:'?ffiId='+ffiId;href+=href.indexOf('?')!=-1?'&enterpriseId='+enterpriseId:'?enterpriseId='+enterpriseId;$(that.dialog).dialog({title:'合伙人分配方案',iconCls:'fa fa-share-alt',width:'50%',height:'100%',cache:false,href:href,modal:true,collapsible:false,minimizable:false,resizable:false,maximizable:true,buttons:[{text:'关闭',iconCls:iconClsDefs.cancel,handler:function(){$(that.dialog).dialog('close');}}]});$(that.dialog).dialog('center');}};</script>