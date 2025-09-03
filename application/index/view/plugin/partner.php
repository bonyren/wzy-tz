<input type="hidden" id="partner-id-<?=$uniqid?>" name="<?=$inputName?>" value="<?=$pId?>" />
<div id="partner-container-<?=$uniqid?>" class="qt-tagger-preview" style="display:inline-block">
    <?php if($pId){ ?>
        <span class="qt-tag-label">
            <?=$partnerName?><a href="javascript:;" class="qt-tag-remove" onclick="partnerModule_<?=$uniqid?>.onRemovePartner();return false;"></a>
        </span>
    <?php } ?>
</div>
<a class="easyui-linkbutton" iconCls="fa fa-plus" onclick="partnerModule_<?=$uniqid?>.onChoosePartner();return false;">选择</a>
<script type="text/javascript">
var partnerModule_<?=$uniqid?>={onRemovePartner:function(){$('#partner-container-<?=$uniqid?>').empty();$('#partner-id-<?=$uniqid?>').val('0');},onChoosePartner:function(){var that=this;var href='<?=url('index/Partners/choosePartner', ['type'=>$partnerType])?>';var $dialog=QT.helper.genDialogId('choosePartner');$dialog.dialog({title:'选择合伙人',iconCls:'fa fa-group',width:'70%',height:'80%',cache:false,href:href,modal:true,collapsible:false,minimizable:false,resizable:false,maximizable:false,buttons:[{text:'确定',iconCls:iconClsDefs.ok,handler:function(){if(choosePartnerModule.choosePartner.pId==0){$.app.method.alertError(null,'请选择合伙人');return;}
that.onRemovePartner();$('#partner-id-<?=$uniqid?>').val(choosePartnerModule.choosePartner.pId);$('#partner-container-<?=$uniqid?>').append('<span class="qt-tag-label">'+
choosePartnerModule.choosePartner.name+'<a href="javascript:;" class="qt-tag-remove" onclick="partnerModule_<?=$uniqid?>.onRemovePartner();return false;"></a></span>');$dialog.dialog('close');}},{text:'取消',iconCls:iconClsDefs.cancel,handler:function(){$dialog.dialog('close');}}]});$dialog.dialog('center');return false;}};</script>