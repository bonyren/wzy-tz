<form>
    <table class="table-form" cellpadding="5">
        <tr>
            <td width="150" class="field-label">投资阶段</td>
            <td>
                <?=\app\index\service\View::dropdown('financing_stage',[
                    'required' => true,
                    'width'=>'200px',
                    'name'=>'data[financing_stage]',
                    'value'=>$row['financing_stage']?$row['financing_stage']:''
                ])?>
            </td>
        </tr>
        <tr>
            <td class="field-label">投后估值</td>
            <td>
                <input name="data[initial_valuation]" value="<?=$row['initial_valuation']?$row['initial_valuation']:''?>"
                       class="easyui-numberbox" prompt="请填写数字" groupSeparator="," style="width:100%;">
            </td>
        </tr>
        <tr>
            <td class="field-label">方案说明</td>
            <td>
                <input name="data[trade_plan]"
                       class="easyui-textbox" multiline="true"
                       data-options="value:'<?=convertLineBreakToEscapeChars($row['trade_plan'])?>'" style="width:100%;height:50px;">
            </td>
        </tr>
    </table>
</form>