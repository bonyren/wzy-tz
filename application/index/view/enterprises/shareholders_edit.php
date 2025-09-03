<form id="F<?=UNIQID?>" style="height:100%">
    <table class="table-form" cellpadding="5">
        <tr>
            <td width="150" class="field-label">标题</td>
            <td>
                <input name="data[name]" value="<?=$info['name']?>"
                   class="easyui-textbox" required="true" prompt="如：xx轮融资股东表" style="width:100%;">
            </td>
        </tr>
        <tr>
            <td class="field-label">更新日期</td>
            <td>
                <input name="data[date]" value="<?=$info['date']?>" class="easyui-datebox" required="true" validType="date" style="width:100%;">
            </td>
        </tr>
        <tr>
            <td class="field-label">股东表导入</td>
            <td>
                <div class="easyui-panel" data-options="
                    href:'<?=url('upload/'.($readonly?'viewAttaches':'attaches'),['attachmentType'=>31,
                            'externalId'=>intval($info['id']),
                            'replace'=>1,
                            'tpl'=>'股东表_模板.xlsx',
                            'uiStyle'=>\app\index\controller\Upload::ATTACHES_UI_LINK_STYLE])?>&callback=<?=JVAR?>.uploaded',
                    border:false">
                </div>
            </td>
        </tr>
        <?php if($info['id']): ?>
        <tr>
            <td class="form-tip" colspan="2">股东表明细</td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="easyui-panel" href="<?=url('Enterprises/getShareholderDetail')?>?esid=<?=$info['id']?>&readonly=0"></div>
            </td>
        </tr>
        <?php endif; ?>
    </table>
    <input type="hidden" id="fid<?=UNIQID?>" name="shareholders_excel">
</form>
<script>
var <?=JVAR?>={uploaded:function(files){var that=<?=JVAR?>;$.each(files,function(i,v){$('#fid<?=UNIQID?>').val(v.attachment_id);});}};</script>