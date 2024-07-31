<form id="fundsCollectTaxForm" method="post">
    <table class="table-form">
        <tr>
            <td class="field-label" style="width: 150px;">
                增值税率：
            </td>
            <td class="field-input">
                <input class="easyui-textbox" name="infos[tax_valueadded_ratio]" data-options="label:'',
                    disabled:<?=$readOnly?'true':'false'?>,
                    validType:['length[1,100]'],
                    width:100" value="<?=$bindValues['infos']['tax_valueadded_ratio']?>" prompt="如：20%"/>
            </td>
            <td class="field-label" style="width: 150px;">
                增值税优惠：
            </td>
            <td class="field-input">
                <input class="easyui-textbox" name="infos[tax_valueadded_discount]" data-options="label:'',
                    disabled:<?=$readOnly?'true':'false'?>,
                    validType:['length[1,100]'],
                    width:100" value="<?=$bindValues['infos']['tax_valueadded_discount']?>" prompt="如：15%"/>
            </td>
        </tr>
        <tr>
            <td class="field-label">
                个人经营所得税：
            </td>
            <td class="field-input">
                <select class="easyui-combobox" name="infos[tax_income_type]" data-options="label:'类型：',
                    disabled:<?=$readOnly?'true':'false'?>,
                    editable:false,
                    panelHeight:'auto',
                    width:300">
                    <?php foreach(\app\index\logic\Defs::$fundTaxIncomeTypeDefs as $key=>$value){ ?>
                        <option value="<?=$key?>" <?=$bindValues['infos']['tax_income_type']==$key?'selected':''?>><?=$value?></option>
                    <?php } ?>
                </select>
                <br />
                <input class="easyui-textbox" name="infos[tax_income_ratio]" data-options="label:'税率：',
                    disabled:<?=$readOnly?'true':'false'?>,
                    validType:['length[1,100]'],
                    width:300" value="<?=$bindValues['infos']['tax_income_ratio']?>" prompt="如：20%"/>
            </td>
            <td class="field-label">
                个人经营所得优惠：
            </td>
            <td class="field-input">
                <input class="easyui-textbox" name="infos[tax_income_discount]" data-options="label:'',
                    disabled:<?=$readOnly?'true':'false'?>,
                    validType:['length[1,100]'],
                    width:100" value="<?=$bindValues['infos']['tax_income_discount']?>" prompt="如：15%"/>
            </td>
        </tr>
        <tr>
            <td class="field-label">
                印花税率：
            </td>
            <td class="field-input">
                <input class="easyui-textbox" name="infos[tax_stamp_ratio]" data-options="label:'',
                    disabled:<?=$readOnly?'true':'false'?>,
                    validType:['length[1,100]'],
                    width:100" value="<?=$bindValues['infos']['tax_stamp_ratio']?>" prompt="如：20%"/>
            </td>
            <td class="field-label">
                印花税优惠：
            </td>
            <td class="field-input">
                <input class="easyui-textbox" name="infos[tax_stamp_discount]" data-options="label:'',
                    disabled:<?=$readOnly?'true':'false'?>,
                    validType:['length[1,100]'],
                    width:100" value="<?=$bindValues['infos']['tax_stamp_discount']?>" prompt="如：15%"/>
            </td>
        </tr>
        <tr>
            <td class="field-label">
                增值税附加税率：
            </td>
            <td class="field-input">
                <input class="easyui-textbox" name="infos[tax_valueadded_extra_ratio]" data-options="label:'',
                    disabled:<?=$readOnly?'true':'false'?>,
                    validType:['length[1,100]'],
                    width:100" value="<?=$bindValues['infos']['tax_valueadded_extra_ratio']?>" prompt="如：20%"/>
            </td>
            <td class="field-label">
                增值税附加优惠：
            </td>
            <td class="field-input">
                <input class="easyui-textbox" name="infos[tax_valueadded_extra_discount]" data-options="label:'',
                    disabled:<?=$readOnly?'true':'false'?>,
                    validType:['length[1,100]'],
                    width:100" value="<?=$bindValues['infos']['tax_valueadded_extra_discount']?>" prompt="如：15%"/>
            </td>
        </tr>
        <tr>
            <td class="field-label">
                税务备注：
            </td>
            <td class="field-input" colspan="3">
                <input id="funds-collect-tax-info-textbox" class="easyui-textbox" name="infos[tax_info]" data-options="label:'',
                    width:'100%',
                    height:'auto',
                    multiline:true,
                    disabled:<?=$readOnly?'true':'false'?>,
                    validType:['length[1,255]'],
                    value:'<?=convertLineBreakToEscapeChars($bindValues['infos']['tax_info'])?>'" prompt="请输入税务相关信息"
                    />
            </td>
        </tr>
        <?php if(!$readOnly){ ?>
            <tr class="form-tools">
                <td colspan="4" align="center">
                    <a href="#" class="easyui-linkbutton" data-options="onClick:function(){ fundsCollectTaxModule.edit(); },iconCls:'fa fa-save'">保存</a>
                </td>
            </tr>
        <?php } ?>
        <tr>
            <td class="field-label">
                税务附件：
            </td>
            <td class="field-input" colspan="3">
                <div id="taxOtherAttachments"></div>
            </td>
        </tr>
    </table>
</form>
<script type="text/javascript">
    var fundsCollectTaxModule = {
        edit:function(){
            var href = '<?=$urlHrefs['fundsCollectTax']?>';
            $('#fundsCollectTaxForm').form('submit', {
                onSubmit: function(){
                    var isValid = $(this).form('validate');
                    if (!isValid) return false;
                    $.messager.progress({text:'处理中，请稍候...'});
                    $.post(href, $(this).serialize(), function(res){
                        $.messager.progress('close');
                        if(!res.code){
                            $.app.method.alertError(null, res.msg);
                        }else{
                            $.app.method.tip('提示', res.msg, 'info');
                        }
                    }, 'json');
                    return false;
                }
            });
        }
    };
    $('#taxOtherAttachments').attaches({
        attachmentType:<?=\app\index\logic\Upload::ATTACH_FUND_COLLECT_TAX_OTHER?>,
        externalId:<?=$externalId?>,
        uiStyle:<?=\app\index\controller\Upload::ATTACHES_UI_DATAGRID_STYLE?>,
        readOnly:<?=$readOnly?'true':'false'?>
    });
    $.parser.onComplete = function(context){
        $("#funds-collect-tax-info-textbox").textbox('autoHeight');
    }
</script>