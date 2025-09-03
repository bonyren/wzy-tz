<?php
if (empty($principle) && isset($enterprise['extra']['principle'])) {
    $principle = &$enterprise['extra']['principle'];
}
$disabled = $readonly ? 'true' : 'false';
?>
<tr>
    <td>
        <span class="field-label">1.未来公司有10倍的成长空间吗？</span>
        <textarea class="easyui-textbox auto-height" name="extra[principle][q1]" data-options="
            disabled:<?=$disabled?>,
            width:'100%',
            multiline:true,
            validType:['length[1,2048]']"><?=$principle['q1']?></textarea>
    </td>
</tr>
<tr>
    <td>
        <span class="field-label">2.当前盈利能力及未来变化趋势？</span>
        <textarea class="easyui-textbox auto-height" name="extra[principle][q2]" data-options="
            disabled:<?=$disabled?>,
            width:'100%',
            multiline:true,
            validType:['length[1,2048]']"><?=$principle['q2']?></textarea>
    </td>
</tr>
<tr>
    <td>
        <span class="field-label">3.公司业绩未来5年能翻5倍吗？</span>
        <textarea class="easyui-textbox auto-height" name="extra[principle][q3]" data-options="
            disabled:<?=$disabled?>,
            width:'100%',
            multiline:true,
            validType:['length[1,2048]']"><?=$principle['q3']?></textarea>
    </td>
</tr>
<tr>
    <td>
        <span class="field-label">4.企业核心竞争力是什么？</span>
        <textarea class="easyui-textbox auto-height" name="extra[principle][q4]" data-options="
            disabled:<?=$disabled?>,
            width:'100%',
            multiline:true,
            validType:['length[1,2048]']"><?=$principle['q4']?></textarea>
    </td>
</tr>
<tr>
    <td>
        <span class="field-label">5.企业文化有什么不同？</span>
        <textarea class="easyui-textbox auto-height" name="extra[principle][q6]" data-options="
            disabled:<?=$disabled?>,
            width:'100%',
            multiline:true,
            validType:['length[1,2048]']"><?=$principle['q6']?></textarea>
    </td>
</tr>
<tr>
    <td>
        <span class="field-label">6.为什么用户选择/喜欢这个企业？它为社会提供了什么价值？</span>
        <textarea class="easyui-textbox auto-height" name="extra[principle][q7]" data-options="
            disabled:<?=$disabled?>,
            width:'100%',
            multiline:true,
            validType:['length[1,2048]']"><?=$principle['q7']?></textarea>
    </td>
</tr>
<tr>
    <td>
        <span class="field-label">7.短期风险是什么？</span>
        <textarea class="easyui-textbox auto-height" name="extra[principle][q8]" data-options="
            disabled:<?=$disabled?>,
            width:'100%',
            multiline:true,
            validType:['length[1,2048]']"><?=$principle['q8']?></textarea>
    </td>
</tr>
<tr>
    <td>
        <span class="field-label">8.为什么市场没有发现价值？</span>
        <textarea class="easyui-textbox auto-height" name="extra[principle][q9]" data-options="
            disabled:<?=$disabled?>,
            width:'100%',
            multiline:true,
            validType:['length[1,2048]']"><?=$principle['q9']?></textarea>
    </td>
</tr>