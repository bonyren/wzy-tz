<form id="F<?=UNIQID?>" method="post" style="height:100%">
    <table class="table-form" cellpadding="5">
        <tr>
            <td class="field-label" style="width: 150px;">标题</td>
            <td class="field-input">
                <input class="easyui-textbox" name="data[title]" value="<?=$row['title']??''?>" data-options="
                            width:'95%',
                            required:true,
                            prompt:'不超过100个字',
                            validType:['length[5,100]']" />
            </td>
        </tr>
        <tr>
            <td class="field-label">日期</td>
            <td class="field-input">
                <input class="easyui-datebox" name="data[date]" data-options="editable:false,required:true" value="<?=$row['date']??''?>" style="width: 120px;" />
            </td>
        </tr>
        <tr>
            <td class="field-label" valign="top">内容</td>
            <td class="field-input">
                <textarea class="easyui-textbox auto-height" name="data[entry]" data-options="
                    width:'95%',
                    multiline:true,
                    validType:['length[1,60000]']"><?=$row['entry']??''?></textarea>
            </td>
        </tr>
    </table>
    <div id="A<?=UNIQID?>" style="width:100%;height:100%;<?=isset($row['id'])?'':'display:none'?>"></div>
</form>
<script><?php  if(isset($row['id'])){?>$('#A<?=UNIQID?>').attachesComplex({attachmentType:<?=\app\index\logic\Upload::ATTACH_NOTES?>,externalId:'<?=$row['id']?>',fit:true,title:'附件列表'});<?php }?>$.parser.onComplete=function(context){var txtbox=$(".auto-height");if(txtbox.length){$.each(txtbox,function(i,v){$(v).textbox('autoHeight');})}
$.parser.onComplete=$.noop;};</script>