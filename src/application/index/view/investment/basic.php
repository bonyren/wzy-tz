<?php
use app\index\logic\Defs;
?>
<form id="investment-base-info-<?=$row['id']?>" method="post">
    <table class="table-form" cellpadding="5">
        <tr>
            <td width="150" class="field-label">投资阶段</td>
            <td>
                <?php echo \app\index\service\View::dropdown('financing_stage',[
                    'required' => true,
                    'name'=>'data[financing_stage]',
                    'value'=>$row['financing_stage']?$row['financing_stage']:'',
                    'width'=>'200px'
                ]); ?>
            </td>
        </tr>
        <tr>
            <td class="field-label">投后估值</td>
            <td>
                <input name="data[initial_valuation]" value="<?=$row['initial_valuation']?$row['initial_valuation']:''?>"
                       class="easyui-numberbox" data-options="disabled:<?=$readonly?'true':'false'?>" prompt="请输入数字" groupSeparator="," style="width:200px;">
            </td>
        </tr>
        <tr>
            <td class="field-label">方案说明</td>
            <td>
                <input name="data[trade_plan]"
                       class="easyui-textbox"
                       data-options="disabled:<?=$readonly?'true':'false'?>,value:'<?=convertLineBreakToEscapeChars($row['trade_plan'])?>'" multiline="true" style="width:100%;height:50px;">
            </td>
        </tr>
        <tr>
            <td class="field-label">新增董事</td>
            <td>
                <select class="easyui-combobox" name="data[director]" style="width:200px;"
                        data-options="multiple:true,multivalue:false,editable:false,value:'<?=$row['director']?>',disabled:<?=$readonly?'true':'false'?>">
                    <?php foreach ($users as $v): ?>
                        <option value="<?=$v['admin_id']?>"><?=$v['realname']?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="field-label">特殊条款</td>
            <td>
                <?php foreach(Defs::SPECIAL_TERM__TYPE_DEFS as $key=>$value){ ?>
                    <input name="extra[special_terms][rights][]" class="easyui-checkbox" value="<?=$key?>"
                           data-options="label:'<?=$value?>',labelPosition:'after',disabled:<?=$readonly?'true':'false'?>,checked:<?=in_array($key, $row['extra_special_terms']['rights'])?'true':'false'?>">
                <?php } ?>
                <div class="mt-2">
                    <input name="extra[special_terms][desc]" class="easyui-textbox auto-height" multiline="true"
                           data-options="disabled:<?=$readonly?'true':'false'?>,value:'<?=convertLineBreakToEscapeChars($row['extra_special_terms']['desc'])?>'" style="width:100%;">
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">交割状态</td>
            <td>
                <select class="easyui-combobox" name="data[status]" data-options="value:<?=$row['status']?>,editable:false,panelHeight:'auto',width:120,disabled:<?=$readonly?'true':'false'?>">
                    <?php foreach(Defs::$investmentStatusDefs as $key=>$value){ ?>
                        <option value="<?=$key?>"><?=$value?></option>
                    <?php } ?>
                </select>
            </td>
        </tr>
        <?php if(!$readonly): ?>
            <tr class="form-tools">
                <td align="center" colspan="2">
                    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-save"
                       onclick="deliveryView.save(<?=$row['id']?>)">保存数据</a>
                    <a href="javascript:void(0)" class="easyui-linkbutton ml-10" iconCls="fa fa-trash-o"
                           onclick="deliveryView.remove(<?=$row['id']?>)">删除投资交割</a>
                </td>
            </tr>
        <?php endif; ?>
    </table>
</form>