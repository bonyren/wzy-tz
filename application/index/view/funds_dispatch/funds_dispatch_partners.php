<div class="easyui-layout" data-options="fit:true">
    <div data-options="region:'north',collapsible:false,border:false,height:'60%'">
        <table id="fundsDispatchPartnersDatagrid" class="easyui-datagrid" data-options="
            url:'<?=$_request_url?>',
            method:'post',
            title:'',
            fit:true,
            fitColumns:<?=$loginMobile?'false':'true'?>,
            singleSelect:true,
            rownumbers:true,
            toolbar:'#fundsDispatchPartnersToolbar',
            onClickCell: fundsDispatchPartnersModule.onClickCell,
            onEndEdit: fundsDispatchPartnersModule.onEndEdit,
            border:false">
            <thead>
            <tr>
                <th data-options="field:'name',width:100">名称</th>
                <th data-options="field:'type',width:60,formatter:fundsDispatchPartnersModule.formatType">类型</th>
                <th data-options="field:'share',width:60">基金份额</th>
                <th data-options="field:'amount',width:50,editor:{type:'numberbox',options:{precision:2, validType:['length[0,10]']}}">金额</th>
                <th data-options="field:'fee',width:50,editor:{type:'numberbox',options:{precision:2, validType:['length[0,10]']}}">费用</th>
                <th data-options="field:'tax',width:50,editor:{type:'numberbox',options:{precision:2, validType:['length[0,10]']}}">所得税</th>
            </tr>
            </thead>
        </table>
        <div id="fundsDispatchPartnersToolbar" style="padding:5px;">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icons-my-reload" onclick="fundsDispatchPartnersModule.refresh()">刷新</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icons-other-tick" onclick="fundsDispatchPartnersModule.accept()">确定</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icons-arrow-cross" onclick="fundsDispatchPartnersModule.reject()">取消</a>
            /
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-gavel" onclick="fundsDispatchPartnersModule.auto()">默认分配</a>
        </div>
    </div>
    <div data-options="region:'center',border:true,href:'',title:'附件'">
        <div id="fundsDispatchPartnersAttachments"></div>
    </div>
</div>
<script>
$('#fundsDispatchPartnersAttachments').attaches({attachmentType:<?=\app\index\logic\Upload::ATTACH_FUND_DISPATCH_PARTNERS?>,externalId:<?=$ffiId?>,uiStyle:<?=\app\index\controller\Upload::ATTACHES_UI_DATAGRID_STYLE?>,readOnly:false});var fundsDispatchPartnersModule={datagrid:'#fundsDispatchPartnersDatagrid',formatType:function(val,row){var typeObj=<?=json_encode(\app\index\logic\Defs::$partnerTypeHtmlDefs)?>;return typeObj[val];},refresh:function(){$(this.datagrid).datagrid('reload');},reload:function(){var that=this;var params={};$(that.datagrid).datagrid('load',params);},editIndex:undefined,endEditing:function(){var that=fundsDispatchPartnersModule;if(that.editIndex==undefined){return true}
if($(that.datagrid).datagrid('validateRow',that.editIndex)){$(that.datagrid).datagrid('endEdit',that.editIndex);that.editIndex=undefined;return true;}else{return false;}},onClickCell:function(index,field){var that=fundsDispatchPartnersModule;if(that.editIndex!=index){if(that.endEditing()){$(that.datagrid).datagrid('selectRow',index).datagrid('beginEdit',index);var ed=$(that.datagrid).datagrid('getEditor',{index:index,field:field});if(ed){($(ed.target).data('textbox')?$(ed.target).textbox('textbox'):$(ed.target)).focus();}
that.editIndex=index;}else{setTimeout(function(){$(that.datagrid).datagrid('selectRow',that.editIndex);},0);}}},onEndEdit:function(index,data,changes){var that=fundsDispatchPartnersModule;var oldrow=$(that.datagrid).datagrid('getEditors',index);if(commonModule.IsEmptyObject(changes)){return false;}
changes.p_id=data.p_id;$.post("<?=$urlHrefs['fundsDispatchPartnersSave']?>",changes,function(res){if(!res.code){$.messager.alert('提示',res.msg,'error');$(that.datagrid).datagrid('updateRow',{index:index,row:{amount:oldrow[0].oldHtml,fee:oldrow[1].oldHtml,tax:oldrow[2].oldHtml}});}else{that.refresh();that.editIndex=undefined;}},'json');that.accept();},accept:function(){var that=fundsDispatchPartnersModule;if(that.endEditing()){$(that.datagrid).datagrid('acceptChanges');}},reject:function(){var that=fundsDispatchPartnersModule;$(that.datagrid).datagrid('rejectChanges');that.editIndex=undefined;},auto:function(){var that=this;$.messager.confirm('提示','确定执行默认分配吗?<br>（分配总额 * 基金份额占比）',function(result){if(!result)return false;$.messager.progress({text:'处理中，请稍候...'});$.post('<?=url('index/fundsDispatch/fundsDispatchPartnersDefault')?>',{ffiId:'<?=$ffiId?>'},function(res){$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg,'info');that.reload();}},'json');});}};</script>