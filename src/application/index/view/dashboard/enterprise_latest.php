<table class="easyui-datagrid" data-options="striped:true,
    nowrap:false,
    rownumbers:false,
    autoRowHeight:true,
    singleSelect:true,
    url:'<?=$urlHrefs['enterpriseLatest']?>',
    method:'post',
    pagination:false,
    border:false,
    fit:true,
    fitColumns:<?=$loginMobile?'false':'true'?>,
    title:'',
    onDblClickRow:function(index, row){
    }
    ">
    <thead>
    <tr>
        <th data-options="field:'occur_date',width:100,fixed:true">时间</th>
        <th data-options="field:'realname',width:100,fixed:true">提交人</th>
        <th data-options="field:'name',width:200,fixed:true">项目名称</th>
        <th data-options="field:'title',width:300">最新进展</th>
    </tr>
    </thead>
</table>