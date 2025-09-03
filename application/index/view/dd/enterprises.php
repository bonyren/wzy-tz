<?php
use app\common\CommonDefs;
?>
<table class="table-form" cellpadding="5">
    <tr class="form-caption">
        <td colspan="5">投资情况列表（单位：万元）</td>
    </tr>
    <tr>
        <td class="field-label"></td>
        <td class="field-label">序号</td>
        <td class="field-label">公司名称</td>
        <td class="field-label">项目名称</td>
        <td class="field-label">投资阶段</td>
        <td class="field-label">投资金额</td>

        <td class="field-label">投后估值</td>
        <td class="field-label">初始占股比</td>
        <td class="field-label">注册地</td>
        <td class="field-label">是否领投</td>
        <td class="field-label">当轮共同投资人</td>

        <td class="field-label">是否占董监高席位</td>
        <td class="field-label">后轮融资情况</td>
        <td class="field-label">最新估值</td>
        <td class="field-label">现在占股比</td>
        <td class="field-label">现持有股权价值</td>

        <td class="field-label">退出方式</td>
        <td class="field-label">是否已完全退出</td>
        <td class="field-label">分红/退出金额</td>
        <td class="field-label">回报倍数</td>
        <td class="field-label">IRR</td>
    </tr>
    <?php foreach($enterprises as $enterprise){ ?>
        <tr>
            <td class="field-input">
                <?php if(checkMenuPriv('index', 'Dd', 'index') == CommonDefs::AUTHORIZE_READ_WRITE_TYPE){ ?>
                <a class="btn btn-outline-info size-MINI radius my-1" href="javascript:;" onclick="ddEdit(this, <?=htmlspecialchars(json_encode($enterprise, JSON_UNESCAPED_UNICODE))?>);return false;"><span class="fa fa-pencil"></span></a>
                <?php } ?>
            </td>
            <td class="field-input"><?=$enterprise['index']?></td>
            <td class="field-input"><?=$enterprise['name']?></td>
            <td class="field-input"><?=$enterprise['project_name']?></td>
            <td class="field-input"><?=$enterprise['stage']?></td>
            <td class="field-input"><?=$enterprise['amount']?></td>

            <td class="field-input"><?=$enterprise['post_investment_valuation']?></td>
            <td class="field-input"><?=$enterprise['stock_ratio']?></td>
            <td class="field-input"><?=$enterprise['register_place']?></td>
            <td class="field-input"><?=$enterprise['is_lead_investment']?></td>
            <td class="field-input"><?=$enterprise['co_investors']?></td>

            <td class="field-input"><?=$enterprise['is_director_position']?></td>
            <td class="field-input"><?=$enterprise['after_financing_info']?></td>
            <td class="field-input"><?=$enterprise['latest_valuation']?></td>
            <td class="field-input"><?=$enterprise['now_stock_ratio']?></td>
            <td class="field-input"><?=$enterprise['now_hold_stock_value']?></td>

            <td class="field-input"><?=$enterprise['exit_way']?></td>
            <td class="field-input"><?=$enterprise['is_totally_exist']?></td>
            <td class="field-input"><?=$enterprise['dividend_return_amount']?></td>
            <td class="field-input"><?=$enterprise['return_multiple']?></td>
            <td class="field-input"><?=$enterprise['irr']?></td>
        </tr>
    <?php } ?>
</table>
<script type="text/javascript">
function ddEdit(that,param){console.log(param);var redisKey=param.redis_key;var href='<?=url('Dd/enterpriseSave')?>';href=GLOBAL.func.addUrlParam(href,'redisKey',redisKey);var postUrl='<?=url('Redis/setData')?>';postUrl=GLOBAL.func.addUrlParam(postUrl,'key',redisKey);var dialogId='#globel-dialog-div';$(dialogId).dialog({title:'设置尽调数据'+'-'+param.name,iconCls:iconClsDefs.edit,width:'50%',height:'50%',cache:false,href:href,modal:true,collapsible:false,minimizable:false,resizable:false,maximizable:false,buttons:[{text:'确定',iconCls:iconClsDefs.ok,handler:function(){var $form=$(dialogId).find('form').eq(0);var params=$form.serializeArray();var paramObj={};$.each(params,function(){paramObj[this['name']]=this['value'];});var jsonStr=JSON.stringify(paramObj);$.post(postUrl,jsonStr,function(res){$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg,'info');$(dialogId).dialog('close');$(that).closest('.ddv').panel('refresh');}},'json');}},{text:'取消',iconCls:iconClsDefs.cancel,handler:function(){$(dialogId).dialog('close');}}]});$(dialogId).dialog('center');}</script>