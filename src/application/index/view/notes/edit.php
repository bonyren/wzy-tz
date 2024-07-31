<form id="F<?=UNIQID?>" method="post" style="height:100%">
    <table class="table-form" cellpadding="5">
        <tr>
            <td width="120" class="field-label">标题</td>
            <td class="field-input">
                <input class="easyui-textbox" name="data[title]" value="<?=$row['title']?>" data-options="
                            width:'95%',
                            required:true,
                            prompt:'不超过100个字',
                            validType:['length[5,100]']" />
            </td>
        </tr>
        <tr>
            <td class="field-label">日期</td>
            <td class="field-input">
                <input class="easyui-datebox" name="data[date]" data-options="editable:false,required:true" value="<?=$row['date']?>" />
            </td>
        </tr>
        <tr>
            <td class="field-label" valign="top">内容</td>
            <td class="field-input">
                <input class="easyui-textbox auto-height" name="data[entry]" data-options="
                    width:'95%',
                    multiline:true,
                    validType:['length[1,60000]'],
                    value:'<?=convertLineBreakToEscapeChars($row['entry'])?>'">
            </td>
        </tr>
    </table>
    <div id="A<?=UNIQID?>" style="width:100%;height:100%;<?=$row['id']?'':'display:none'?>"></div>
</form>
<script>
<?php if($row['id']): ?>
$('#A<?=UNIQID?>').attachesComplex({
    attachmentType:<?=\app\index\logic\Upload::ATTACH_NOTES?>,
    externalId:'<?=$row['id']?>',
    fit:true,
    title:'附件列表'
});
<?php endif; ?>
$.parser.onComplete = function(context){
    var txtbox = $(".auto-height");
    if (txtbox.length) {
        $.each(txtbox, function(i,v){
            $(v).textbox('autoHeight');
        })
    }
}
</script>