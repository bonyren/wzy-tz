<?php
use app\index\logic\Funds as FundsLogic;
?>
<div class="form-container">
    <form id="<?=FORM_ID?>" method="post" class="form-body">
        <table class="table-form" cellpadding="5">
            <tr class="form-caption">
                <td colspan="2">基金基本信息</td>
            </tr>
            <tr>
                <td class="field-label" style="width: 20%;">名称</td>
                <td class="field-input">
                    <input class="easyui-textbox" name="infos[name]" value="<?=$formData['name']??''?>"
                        data-options="required:true,width:'100%',validType:['length[1,100]'],disabled:<?=$readOnly?'true':'false'?>" />
                </td>
            </tr>
            <tr>
                <td class="field-label">简称</td>
                <td class="field-input">
                    <input class="easyui-textbox" name="infos[alias]" value="<?=$formData['alias']??''?>"
                        data-options="width:'100%',validType:['length[1,20]'],disabled:<?=$readOnly?'true':'false'?>" />
                </td>
            </tr>
            <tr>
                <td class="field-label">代号</td>
                <td class="field-input">
                    <input class="easyui-textbox" name="infos[code]" value="<?=$formData['code']??''?>"
                        data-options="width:'100%',validType:['length[1,20]'],disabled:<?=$readOnly?'true':'false'?>" />
                </td>
            </tr>
            <tr>
                <td class="field-label">注册地</td>
                <td class="field-input">
                    <input class="easyui-textbox" name="infos[reg_place]" value="<?=$formData['reg_place']??''?>"
                        data-options="width:'100%',validType:['length[1,100]'],disabled:<?=$readOnly?'true':'false'?>" />
                </td>
            </tr>
            <tr>
                <td class="field-label">规模(元)</td>
                <td class="field-input">
                    <input class="easyui-numberbox" name="infos[size]" value="<?=$formData['size']??''?>"
                        data-options="width:'100%',min:0,precision:2,disabled:<?=$readOnly?'true':'false'?>" />
                </td>
            </tr>
            <tr>
                <td class="field-label">合伙企业起止日期</td>
                <td class="field-input">
                    <input class="easyui-datebox" name="infos[partnership_start_date]" value="<?=dateFilter($formData['partnership_start_date']??'')?>" 
                        data-options="width:120,editable:false,disabled:<?=$readOnly?'true':'false'?>" />
                    -
                    <input class="easyui-datebox" name="infos[partnership_end_date]" value="<?=dateFilter($formData['partnership_end_date']??'')?>" 
                        data-options="width:120,editable:false,disabled:<?=$readOnly?'true':'false'?>" />
                </td>
            </tr>
            <tr>
                <td class="field-label">基金成立结束日期</td>
                <td class="field-input">
                    <input class="easyui-datebox" name="infos[establish_date]" value="<?=dateFilter($formData['establish_date']??'')?>"
                        data-options="width:120,editable:false,disabled:<?=$readOnly?'true':'false'?>" />
                    -
                    <input class="easyui-datebox" name="infos[over_date]" value="<?=dateFilter($formData['over_date']??'')?>"
                        data-options="width:120,editable:false,disabled:<?=$readOnly?'true':'false'?>" />
                </td>
            </tr>
            <tr>
                <td class="field-label" style="width: 20%;">基金投资期(年)</td>
                <td class="field-input">
                    <input class="easyui-numberbox" name="infos[invest_period]" value="<?=$formData['invest_period']??''?>"
                        data-options="width:60,min:0,precision:0,disabled:<?=$readOnly?'true':'false'?>" />
                    管理费率<input class="easyui-numberbox" name="infos[invest_fee_ratio]" value="<?=$formData['invest_fee_ratio']??''?>"
                        data-options="width:60,min:0,precision:2,disabled:<?=$readOnly?'true':'false'?>" />%
                </td>
            </tr>

            <tr>
                <td class="field-label" style="width: 20%;">基金退出期(年)</td>
                <td class="field-input">
                    <input class="easyui-numberbox" name="infos[exit_period]" value="<?=$formData['exit_period']??''?>"
                        data-options="width:60,min:0,precision:0,disabled:<?=$readOnly?'true':'false'?>" />
                    管理费率<input class="easyui-numberbox" name="infos[exit_fee_ratio]" value="<?=$formData['exit_fee_ratio']??''?>"
                        data-options="width:60,min:0,precision:2,disabled:<?=$readOnly?'true':'false'?>" />%
                </td>
            </tr>

            <tr>
                <td class="field-label">基金延长期(年)</td>
                <td class="field-input">
                    <input class="easyui-numberbox" name="infos[extend_period]" value="<?=$formData['extend_period']??''?>"
                        data-options="width:60,min:0,precision:0,disabled:<?=$readOnly?'true':'false'?>" />
                </td>
            </tr>
            <tr>
                <td class="field-label">运营状态</td>
                <td class="field-input">
                    <select class="easyui-combobox" name="infos[status]" 
                        data-options="editable:false,width:100,panelHeight:'auto',value:'<?=$formData['status']??FundsLogic::FUND_COLLECT_STATUS?>',disabled:<?=$readOnly?'true':'false'?>">
                        <?php foreach(FundsLogic::$fundStatusDefs as $key=>$value){ ?>
                            <option value="<?=$key?>"><?=$value?></option>
                        <?php }?>
                    </select>
                </td>
            </tr>
        </table>
    </form>
    <?php if(empty($readOnly)){ ?>
        <div class="form-toolbar">
            <a class="easyui-linkbutton" href="javascript:;"  data-options="iconCls:iconClsDefs.save,
                        onClick:function(){
                            <?=JVAR?> .save(this);
                        }">保存
            </a>
            &nbsp;
            <?php if(empty($fundId)){ ?>
                <a class="easyui-linkbutton" href="javascript:;"  data-options="iconCls:iconClsDefs.cancel,
                            onClick:function(){
                                <?=JVAR?> .cancel(this);
                            }">取消
                </a>
            <?php } ?>
        </div>
    <?php } ?>
</div>
<script>
var <?=JVAR?>={form:'#<?=FORM_ID?>',save:function(that){var href='<?=$urlHrefs['save']?>';$(<?=JVAR?>.form).form('submit',{onSubmit:function(){var isValid=$(this).form('validate');if(!isValid)return false;$.messager.progress({text:'处理中，请稍候...'});$.post(href,$(this).serialize(),function(res){$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg,'info');<?php  if(!empty($_GET['callback_submit'])){?>eval('<?=$_GET['callback_submit']?>');<?php }?><?php  if(empty($fundId)){?>$(that).closest('.window-body').dialog('close');<?php }?>}},'json');return false;}});},cancel:function(that){<?php  if(!empty($_GET['callback_cancel'])){?>eval('<?=$_GET['callback_cancel']?>');<?php }?>$(that).closest('.window-body').dialog('close');}};</script>