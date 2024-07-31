<?php
if (empty($principle) && isset($enterprise['extra']['principle'])) {
    $principle = &$enterprise['extra']['principle'];
}
$disabled = $readonly ? 'true' : 'false';
?>
<tr>
    <td>
        <span class="field-label">1.未来公司有10倍的成长空间吗？</span>
        <input name="extra[principle][q1]"
               class="easyui-textbox auto-height" multiline="true"
               data-options="disabled:<?=$disabled?>,value:'<?=convertLineBreakToEscapeChars($principle['q1'])?>'" style="width:100%;">
    </td>
</tr>
<tr>
    <td>
        <span class="field-label">2.当前盈利能力及未来变化趋势？</span>
        <input name="extra[principle][q2]"
               class="easyui-textbox auto-height" multiline="true"
               data-options="disabled:<?=$disabled?>,value:'<?=convertLineBreakToEscapeChars($principle['q2'])?>'" style="width:100%;">
    </td>
</tr>
<tr>
    <td>
        <span class="field-label">3.公司业绩未来5年能翻5倍吗？</span>
        <input name="extra[principle][q3]"
               class="easyui-textbox auto-height" multiline="true"
               data-options="disabled:<?=$disabled?>,value:'<?=convertLineBreakToEscapeChars($principle['q3'])?>'" style="width:100%;">
    </td>
</tr>
<tr>
    <td>
        <span class="field-label">4.企业核心竞争力是什么？</span>
        <input name="extra[principle][q5]"
               class="easyui-textbox auto-height" multiline="true"
               data-options="disabled:<?=$disabled?>,value:'<?=convertLineBreakToEscapeChars($principle['q5'])?>'" style="width:100%;">
    </td>
</tr>
<tr>
    <td>
        <span class="field-label">5.企业文化有什么不同？</span>
        <input name="extra[principle][q6]"
               class="easyui-textbox auto-height" multiline="true"
               data-options="disabled:<?=$disabled?>,value:'<?=convertLineBreakToEscapeChars($principle['q6'])?>'" style="width:100%;">
    </td>
</tr>
<tr>
    <td>
        <span class="field-label">6.为什么用户选择/喜欢这个企业？它为社会提供了什么价值？</span>
        <input name="extra[principle][q7]"
               class="easyui-textbox auto-height" multiline="true"
               data-options="disabled:<?=$disabled?>,value:'<?=convertLineBreakToEscapeChars($principle['q7'])?>'" style="width:100%;">
    </td>
</tr>
<tr>
    <td>
        <span class="field-label">7.短期风险是什么？</span>
        <input name="extra[principle][q8]"
               class="easyui-textbox auto-height" multiline="true"
               data-options="disabled:<?=$disabled?>,value:'<?=convertLineBreakToEscapeChars($principle['q8'])?>'" style="width:100%;">
    </td>
</tr>
<tr>
    <td>
        <span class="field-label">8.为什么市场没有发现价值？</span>
        <input name="extra[principle][q9]"
               class="easyui-textbox auto-height" multiline="true"
               data-options="disabled:<?=$disabled?>,value:'<?=convertLineBreakToEscapeChars($principle['q9'])?>'" style="width:100%;">
    </td>
</tr>