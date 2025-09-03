<form id="F<?=UNIQID?>">
    <table class="table-form" cellpadding="5">
        <tr>
            <th colspan="4" class="form-tip" align="center">基金分红配置</th>
        </tr>
        <tr class="field-label">
            <td width="200" align="center">基金名称</td>
            <td width="80" align="center">占股比例</td>
            <td align="center">分红金额</td>
            <td align="center">备注说明</td>
        </tr>
        <?php foreach ($funds as $i=>$v): if ($id) ?>
        <tr>
            <td align="center"><?=$v['name']?></td>
            <td align="center"><?=$v['stock_ratio']?>%</td>
            <td align="center">
                <input type="hidden" name="allocate[<?=$v['fund_id']?>][id]" value="<?=$ed['id']?>">
                <input id="fund_dividend_amount_<?=$v['fund_id']?>_input" type="hidden" name="allocate[<?=$v['fund_id']?>][ffi_id]" value="<?=$ed['ffi_id']?>">
                <div id="fund_dividend_amount_<?=$v['fund_id']?>"></div>
            </td>
            <td align="center">
                <textarea class="easyui-textbox auto-height" name="allocate[<?=$v['fund_id']?>][description]" data-options="
                    width:210,
                    multiline:true,
                    validType:['length[1,1024]']"><?=$ed['description']?></textarea>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</form>
<script type="text/javascript"><?php  foreach($funds as $i=>$v):?>$('#fund_dividend_amount_<?=$v['fund_id']?>').fundIncome({fundId:'<?=$v['fund_id']?>',ffiId:'<?=$ed['ffi_id']?>',type:'<?=\app\index\logic\Defs::FUND_INCOME_DIVIDEND_TYPE?>',title:'<?=$enterprise['name']?>-项目分红',uniqid:md5('#fund_dividend_amount_<?=$v['fund_id']?>')});<?php  endforeach;?>GLOBAL.HelperDialog={saveAmount:function(){<?php  foreach($funds as $i=>$v):?>var theId='#fund_dividend_amount_<?=$v['fund_id']?>';var ffiId=$(theId).fundIncome('save');$(theId+'_input').val(ffiId);<?php  endforeach;?>},submit:function(url,$dialog,success){var $form=$('#F<?=UNIQID?>');if(!$form.form('validate')){return false;}
$.messager.progress({text:'处理中，请稍候...'});GLOBAL.HelperDialog.saveAmount();$.post(url,$form.serialize(),function(res){$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg,'info');$dialog.dialog('close');if(success){success();}}},'json');}};</script>