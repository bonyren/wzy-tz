<table id="creditSearchDatagrid" class="easyui-datagrid" data-options="striped:true,
    nowrap:false,
    rownumbers:true,
    autoRowHeight:true,
    singleSelect:true,
    method:'post',
    url:'<?=url('Enterprises/creditSearch')?>',
    toolbar:'#creditSearchToolbar',
    pagination:false,
    border:false,
    fit:true,
    fitColumns:<?=$loginMobile?'false':'true'?>,
    onLoadSuccess:function(data){
        if(data.error){
            $.app.method.alertError(null, data.error);
        }
    },
    onLoadError:function(){
        console.log('onLoadError');
    },
    onDblClickRow:function(index, row){
        creditSearchModule.view(row.fund_id, row.name);
    }">
    <thead>
    <tr>
        <th data-options="field:'opt',formatter:creditSearchModule.formatOpt,width:150">操作</th>
        <th data-options="field:'companyName',width:300">公司名称</th>
        <th data-options="field:'creditNo',width:300">统一社会信用代码</th>
        
        <th data-options="field:'legalPerson',width:150">法人</th>
        <th data-options="field:'establishDate',width:150">成立时间</th>
        <th data-options="field:'companyStatus',width:150">登记状态</th>
    </tr>
    </thead>
</table>

<div id="creditSearchToolbar" class="p-1">
    <form id="creditSearchForm">
        <input name="search[kw]" class="easyui-textbox" data-options="width:200" />
        <a class="easyui-linkbutton" data-options="iconCls:'fa fa-search',
                    onClick:function(){ creditSearchModule.search(); }">搜索
        </a>
        <a class="easyui-linkbutton" data-options="iconCls:'fa fa-reply',
                    onClick:function(){ creditSearchModule.reset(); }">重置
        </a>
    </form>
</div>
<script type="text/javascript">
    var creditSearchModule = {
        dialog:'#globel-dialog-div',
        datagrid:'#creditSearchDatagrid',
        searchForm: '#creditSearchForm',
        formatOpt:function(val, row){
            var btns = [];
            btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="creditSearchModule.add(\'' + encodeURIComponent(JSON.stringify(row)) + '\')" title="添加"><i class="fa fa-plus fa-lg">添加</i></a>');
            return btns.join(' ');
        },
        reload:function(){
            $(creditSearchModule.datagrid).datagrid('reload');
        },
        search:function(){
            var param = {};
            $.each($(this.searchForm).serializeArray(), function(){
                param[this.name] = this.value;
            });
            $(this.datagrid).datagrid('load', param);
        },
        reset:function(){
            $(this.searchForm).form('reset');
            $(this.datagrid).datagrid('load', {});
        },
        add:function(row){
            var row = JSON.parse(decodeURIComponent(row));
            EnterpriseModule.add({
                name:row.companyName,
                boss:row.legalPerson,
                phone:''
            });
        }
    }
</script>