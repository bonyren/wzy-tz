<form id="enterprise_companyinfo_form" style="height:100%">
<div class="easyui-tabs" fit="true" border="false">
    <div title="投资决策八问">
        <div class="form-container">
            <div class="form-body">
                <table class="table-form" cellpadding="5">
                <?php include(APP_PATH . 'index' . DS . 'view' . DS . 'investment/principle.php'); ?>
                </table>
            </div>
            <div class="form-toolbar <?=$hidden?>">
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-save"
                    onclick="EnterpriseModule.saveInfos(<?=$enterprise['id']?>,'#enterprise_companyinfo_form')">
                    保存
                </a>
            </div>
        </div>
    </div>
    <!--##############################################-->
    <div title="创始团队" data-options="
        href:'<?=url('enterprises/founders',['enterprise_id'=>$enterprise['id'],'readonly'=>$readonly])?>'">
    </div>
    <!--##############################################-->
    <div title="产品&技术">
        <table class="table-form" cellpadding="5">
            <tr>
                <td width="150" class="field-label">产品服务</td>
                <td>
                    <?php echo \app\index\service\View::tagger(2,$enterprise['id'],'',[
                        'name'=>'enterprise[tags][2]',
                    ]); ?>
                </td>
            </tr>
            <tr>
                <td class="field-label">技术</td>
                <td>
                    <?php echo \app\index\service\View::tagger(5,$enterprise['id'],'',[
                        'name'=>'enterprise[tags][5]',
                    ]); ?>
                </td>
            </tr>
            <tr>
                <td class="field-label">说明</td>
                <td>
                    <input name="enterprise[productions_technologies]"
                           class="easyui-textbox auto-height" multiline="true"
                           data-options="value:'<?=convertLineBreakToEscapeChars($enterprise['productions_technologies'])?>'" prompt="核心技术、产品形态、服务等" style="width:95%;">
                </td>
            </tr>
            <tr class="form-tools <?=$hidden?>">
                <td colspan="2" align="center">
                    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-save"
                        onclick="EnterpriseModule.saveInfos(<?=$enterprise['id']?>,'#enterprise_companyinfo_form')">
                        保存
                    </a>
                </td>
            </tr>
        </table>
        <div id="F7<?=UNIQID?>" style="width:100%;height:100%"></div>
        <script>
            $('#F7<?=UNIQID?>').attachesComplex({
                attachmentType:7,
                externalId:'<?=$enterprise['id']?>',
                readOnly:<?=$readonly?>,
                title:'附件列表',
                fit:true
            });
        </script>
    </div>
    <!--##############################################-->
    <div title="客户&业务">
        <table class="table-form" cellpadding="5">
            <tr>
                <td class="field-label">客户</td>
                <td>
                    <input name="enterprise[extra][customer][description]"
                           class="easyui-textbox auto-height" multiline="true"
                           data-options="value:'<?=convertLineBreakToEscapeChars($enterprise['extra']['customer']['description'])?>'" style="width:100%;">
                </td>
            </tr>
            <tr>
                <td width="150" class="field-label">业务</td>
                <td>
                    <input name="enterprise[extra][business][description]"
                           class="easyui-textbox auto-height" multiline="true"
                           data-options="value:'<?=convertLineBreakToEscapeChars($enterprise['extra']['business']['description'])?>'" style="width:100%;">
                </td>
            </tr>
            <tr>
                <td class="field-label">标签</td>
                <td>
                    <?php echo \app\index\service\View::tagger(3,$enterprise['id'],'',[
                        'name'=>'enterprise[tags][3]',
                    ]); ?>
                </td>
            </tr>
            <tr class="form-tools <?=$hidden?>">
                <td colspan="2" align="center">
                    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-save"
                        onclick="EnterpriseModule.saveInfos(<?=$enterprise['id']?>,'#enterprise_companyinfo_form')">
                        保存
                    </a>
                </td>
            </tr>
        </table>
        <div colspan="2" id="F6<?=UNIQID?>" style="width:100%;height:100%"></div>
        <script>
            $('#F6<?=UNIQID?>').attachesComplex({
                attachmentType:6,
                externalId:'<?=$enterprise['id']?>',
                readOnly:<?=$readonly?>,
                fit:true,
                title:'附件列表'
            });
        </script>
    </div>
    <!--##############################################-->
    <div title="行业分析">
        <table class="table-form" cellpadding="5">
            <tr>
                <td width="150" class="field-label">描述</td>
                <td>
                    <input name="enterprise[extra][industry][description]"
                           class="easyui-textbox auto-height" multiline="true"
                           data-options="value:'<?=convertLineBreakToEscapeChars($enterprise['extra']['industry']['description'])?>'" style="width:100%;">
                </td>
            </tr>
            <tr class="form-tools <?=$hidden?>">
                <td colspan="2" align="center">
                    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-save"
                        onclick="EnterpriseModule.saveInfos(<?=$enterprise['id']?>,'#enterprise_companyinfo_form')">
                        保存
                    </a>
                </td>
            </tr>
        </table>
        <div colspan="2" id="F8<?=UNIQID?>" style="width:100%;height:100%"></div>
        <script>
            $('#F8<?=UNIQID?>').attachesComplex({
                attachmentType:27,
                externalId:'<?=$enterprise['id']?>',
                readOnly:<?=$readonly?>,
                fit:true,
                title:'附件列表'
            });
        </script>
    </div>
    <!--##############################################-->
    <div title="财务">
        <table class="table-form" cellpadding="5">
            <tr>
                <td width="150" class="field-label">备注说明</td>
                <td>
                    <input name="enterprise[extra][finance][description]"
                           class="easyui-textbox auto-height" multiline="true"
                           data-options="value:'<?=convertLineBreakToEscapeChars($enterprise['extra']['finance']['description'])?>'" style="width:100%;">
                </td>
            </tr>
            <tr class="form-tools <?=$hidden?>">
                <td colspan="2" align="center">
                    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-save"
                        onclick="EnterpriseModule.saveInfos(<?=$enterprise['id']?>,'#enterprise_companyinfo_form')">
                        保存
                    </a>
                </td>
            </tr>
        </table>
        <div colspan="2" id="F4<?=UNIQID?>" style="width:100%;height:100%"></div>
        <script>
            $('#F4<?=UNIQID?>').attachesComplex({
                attachmentType:4,
                externalId:'<?=$enterprise['id']?>',
                readOnly:<?=$readonly?>,
                fit:true,
                title:'附件列表'
            });
        </script>
    </div>
    <!--##############################################-->
    <div title="法务">
        <table class="table-form" cellpadding="5">
            <tr>
                <td width="150" class="field-label">备注说明</td>
                <td>
                    <input name="enterprise[extra][legal][description]"
                           class="easyui-textbox auto-height" multiline="true"
                           data-options="value:'<?=convertLineBreakToEscapeChars($enterprise['extra']['legal']['description'])?>'" style="width:100%;">
                </td>
            </tr>
            <tr class="form-tools <?=$hidden?>">
                <td colspan="2" align="center">
                    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-save"
                        onclick="EnterpriseModule.saveInfos(<?=$enterprise['id']?>,'#enterprise_companyinfo_form')">
                        保存
                    </a>
                </td>
            </tr>
        </table>
        <div colspan="2" id="F5<?=UNIQID?>" style="width:100%;height:100%"></div>
        <script>
            $('#F5<?=UNIQID?>').attachesComplex({
                attachmentType:5,
                externalId:'<?=$enterprise['id']?>',
                readOnly:<?=$readonly?>,
                fit:true,
                title:'附件列表'
            });
        </script>
    </div>
</div>
</form>