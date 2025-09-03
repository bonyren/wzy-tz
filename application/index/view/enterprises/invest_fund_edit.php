<form>
    <table class="table-form" cellpadding="5">
        <tr>
            <td width="120" class="field-label">基金名称</td>
            <td><?=$data['fund']['name']?></td>
        </tr>
        <tr>
            <td class="field-label">投资金额</td>
            <td>
                <div id="<?=$element_id?>"></div>
            </td>
        </tr>
        <tr>
            <td class="field-label">占股比例</td>
            <td>
                <input type="hidden" name="data[fund_id]" value="<?=$data['fund_id']?>">
                <input class="easyui-numberbox" name="data[stock_ratio]" value="<?=$data['stock_ratio']?>"
                       suffix="%" required="true" min="0" max="100" precision="2">
            </td>
        </tr>
        <tr>
            <td class="field-label">所占注册资本</td>
            <td>
                <input class="easyui-numberbox" required="true" min="0" precision="4" groupSeparator="," name="data[stock_total]" value="<?=$data['stock_total']?>">
            </td>
        </tr>
        <tr>
            <td class="field-label">交割时间</td>
            <td>
                <input class="easyui-datebox" required="true" name="data[date_delivery]" value="<?=$data['date_delivery']?>">
            </td>
        </tr>
        <tr>
            <td class="field-label">划款指令</td>
            <td>
                <div class="easyui-panel" data-options="
                    href:'<?=url('upload/attaches',['attachmentType'=>20,'externalId'=>$data['enterprise_id'],'externalId2'=>$data['id'],'uiStyle'=>\app\index\controller\Upload::ATTACHES_UI_TABLE_STYLE])?>',
                    border:false,
                    minimizable:false,
                    maximizable:false">
                </div>
            </td>
        </tr>
    </table>
</form>
<script type="text/javascript">
var InvestFundEdit={init:function(){$('#<?=$element_id?>').fundEnterprise({fundId:'<?=$data['fund_id']?>',ffeId:'<?=$data['ffe_id']?>',enterpriseId:'<?=$data['enterprise_id']?>',uniqid:'<?=$uuid?>'});},saveAmount:function(){$('#<?=$element_id?>').fundEnterprise('save');}};InvestFundEdit.init();</script>