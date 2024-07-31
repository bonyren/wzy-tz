<table id="choosePartnerDatagrid" class="easyui-datagrid" data-options="striped:true,
    nowrap:false,
    rownumbers:true,
    autoRowHeight:true,
    singleSelect:true,
    url:'<?=$urlHrefs['choosePartner']?>',
    method:'post',
    toolbar:'#choosePartnerToolbar',
    pagination:false,
    border:false,
    fit:true,
    fitColumns:<?=$loginMobile?'false':'true'?>,
    title:'',
    onSelect:function(index, row){
        choosePartnerModule.onSelect(index, row);
    }
    ">
    <thead>
    <tr>
        <th data-options="field:'name',width:200,align:'center'">姓名</th>
        <th data-options="field:'title',width:200,align:'center'">职位</th>
        <th data-options="field:'type',width:300,align:'center',formatter:choosePartnerModule.formatType">类型</th>
        <th data-options="field:'total_amount',width:200,align:'center',formatter:GLOBAL.func.moneyFormat">总认缴(元)</th>
        <th data-options="field:'total_paid_amount',width:200,align:'center',formatter:GLOBAL.func.moneyFormat">总实缴(元)</th>
        <th data-options="field:'total_fund_count',width:100,align:'center'">参与基金</th>
        <th data-options="field:'total_enterprise_count',width:100,align:'center'">参与项目</th>
        <th data-options="field:'progress_log',width:200,align:'center'">最新进展</th>
        <th data-options="field:'status',width:200,align:'center',formatter:choosePartnerModule.formatStatus">状态</th>
    </tr>
    </thead>
</table>
<div id="choosePartnerToolbar" class="p-1">
    <form id="choosePartnerToolbarForm">
        姓名: <input name="search[name]" class="easyui-textbox" data-options="width:200" />
        <a class="easyui-linkbutton" data-options="iconCls:'fa fa-search',
                    onClick:function(){ choosePartnerModule.search(); }">搜索
        </a>
        <a class="easyui-linkbutton" data-options="iconCls:'fa fa-reply',
                    onClick:function(){ choosePartnerModule.reset(); }">重置
        </a>
    </form>
    <div class="line my-1"></div>
    <div style="padding: 10px 10px;">
        已选: <span id="choosePartnerName" class="badge badge-success"></span>
    </div>
</div>
<script type="text/javascript">
    var choosePartnerModule = {
        datagrid: '#choosePartnerDatagrid',
        choosePartner: {pId:0, name:''},
        formatStatus: function (val, row) {
            return '<span class="badge badge-success">有效</span>';
        },
        formatType:function(val, row){
            return <?=json_encode(\app\index\logic\Defs::$partnerTypeHtmlDefs, JSON_UNESCAPED_UNICODE)?>[val];
        },
        reload: function () {
            $(this.datagrid).datagrid('reload');
        },
        load: function () {
            $(this.datagrid).datagrid('load');
        },
        search:function(){
            var that = this;
            var queryParams = $(that.datagrid).datagrid('options').queryParams;
            //reset the query parameter
            $.each($("#choosePartnerToolbarForm").serializeArray(), function() {
                delete queryParams[this['name']];
            });
            $.each($("#choosePartnerToolbarForm").serializeArray(), function() {
                queryParams[this['name']] = this['value'];
            });
            that.load();
        },
        reset:function(){
            var that = this;
            var queryParams = $(that.datagrid).datagrid('options').queryParams;
            for(var key in queryParams){
                delete queryParams[key];
            }
            $("#choosePartnerToolbarForm").form('reset');
            that.load();
        },
        onSelect:function(index, row){
            var that = this;
            that.choosePartner.pId = row.p_id;
            that.choosePartner.name = row.name;
            $("#choosePartnerName").text(row.name);
        }
    };
</script>