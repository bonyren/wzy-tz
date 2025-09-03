<span id="attaches_<?=$uniqid?>">
    <?php foreach($bindValues['attaches'] as $attach){ ?>
        <div id="attach_file_<?=$uniqid?>_<?=$attach['attachment_id']?>" class="attach-box-light">
            <div class="text-center mr-1 pull-left">
                <a title="<?=$attach['original_name']?>" href="javascript:void(0)" onclick="QT.filePreview(<?=$attach['attachment_id']?>)">
                    <?=$attach['original_name']?>
                </a>
            </div>
            <div class="text-center pull-left">
                <a class="btn btn-danger size-MINI" href="javascript:void(0)" onclick="attachModule_<?=$uniqid?>.deleteAttach(<?=$attach['attachment_id']?>)"><span class="fa fa-remove"></span></a>
                <a class="btn btn-secondary size-MINI" href="<?=$attach['download_url']?>" target="_blank"><span class="fa fa-download"></span></a>
            </div>
        </div>
    <?php } ?>
</span>
<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-cloud-upload" onclick="attachModule_<?=$uniqid?>.uploadAttach()">上传</a>
<?php if ($_GET['tpl']): ?>
<a href="<?=IMPORT_URL_ROOT.urlencode($_GET['tpl'])?>" class="ml-10" target="_blank">(下载模板)</a>
<?php endif; ?>

<script type="text/javascript">
var attachModule_<?=$uniqid?>={dialog:'#globel-dialog-div',dialog2:'#globel-dialog2-div',replace:<?=$bindValues['replace']?>,callback:<?=$bindValues['callback']?$bindValues['callback']:'null'?>,queries:<?=json_encode($_GET,JSON_UNESCAPED_UNICODE)?>,uploadAttach:function(){var that=this;var url='<?=$urlHrefs['uploadAttach']?>';$.app.method.upload(url,function(obj){if(!obj.code){$.app.method.tip('提示',obj.msg,'error');return;}else{if(obj.html){$.messager.alert('提示',obj.html,'warning');}else{$.app.method.tip('提示','成功','info');}}
var html=[];$.each(obj.data,function(i,v){html.push('<div id="attach_file_<?=$uniqid?>_'+v.attachment_id+'" class="attach-box-light">'+'<div class="text-center mr-1 pull-left"><a title="'+v.name+'" href="javascript:void(0)" onclick="QT.filePreview('+v.attachment_id+')">'+
v.name+'</a></div>'+'<div class="text-center pull-left">'+'<a class="btn btn-danger size-MINI" href="javascript:void(0)" onclick="attachModule_<?=$uniqid?>.deleteAttach('+v.attachment_id+')"><span class="fa fa-remove"></span></a>'+' '+'<a class="btn btn-secondary size-MINI" href="'+v.download_url+'" target="_blank"><span class="fa fa-download"></span></a></div>'+'</div>');});if(that.replace){$("#attaches_<?=$uniqid?>").html(html.pop());}else{$("#attaches_<?=$uniqid?>").append(html);}
if(that.callback){that.callback(obj.data,that.queries);}});},deleteAttach:function(attachmentId){var that=this;var href='<?=$urlHrefs['deleteAttach']?>';href+=href.indexOf('?')!=-1?'&attachmentId='+attachmentId:'?attachmentId='+attachmentId;$.messager.confirm('提示','确认删除吗?',function(result){if(!result)return false;$.messager.progress({text:'处理中，请稍候...'});$.post(href,{},function(res){$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg,'info');$('#attach_file_<?=$uniqid?>_'+attachmentId).remove();}},'json');});}};</script>