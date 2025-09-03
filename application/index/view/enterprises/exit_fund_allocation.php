<form id="F<?=UNIQID?>">
    <table class="table-form" cellpadding="5">
        <tr>
            <th colspan="4" class="form-tip" align="center">退出资金分配到基金</th>
        </tr>
        <tr class="field-label">
            <td width="200" align="center">基金名称</td>
            <td width="80" align="center">占股比例</td>
            <td align="center">退出金额</td>
        </tr>
        <?php foreach ($funds as $i=>$v): if ($id) ?>
        <tr>
            <td align="center"><?=$v['name']?></td>
            <td align="center"><?=$v['stock_ratio']?>%</td>
            <td align="center">
                <input id="fund_dividend_amount_<?=$v['fund_id']?>_input" type="hidden" name="ffi_id[]" value="<?=$ffis[$v['fund_id']] ?? 0?>">
                <div id="fund_dividend_amount_<?=$v['fund_id']?>"></div>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</form>
<script type="text/javascript"><?php  foreach($funds as $i=>$v):?>$('#fund_dividend_amount_<?=$v['fund_id']?>').fundIncome({fundId:'<?=$v['fund_id']?>',ffiId:'<?=$ffis[$v['fund_id']] ?? 0?>',type:'<?=\app\index\logic\Defs::FUND_INCOME_DIVIDEND_TYPE?>',title:'<?=$ffi_title?>',uniqid:md5('#fund_dividend_amount_<?=$v['fund_id']?>')});<?php  endforeach;?>GLOBAL.HelperDialog={submit:function(url,$dialog,success){$.messager.progress({text:'处理中，请稍候...'});<?php  foreach($funds as $i=>$v):?>var theId='#fund_dividend_amount_<?=$v['fund_id']?>';var ffiId=$(theId).fundIncome('save');$(theId+'_input').val(ffiId);<?php  endforeach;?>var $form=$dialog.find('form');setTimeout(function(){$.post(url,$form.serialize(),function(res){$.messager.progress('close');if(res.code===0){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg,'info');$dialog.dialog('close');}},'json');},500);}};</script>