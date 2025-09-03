<form method="post" style="width: 100%;height: 100%;">
    <table class="table-form" cellpadding="5">
        <tr class="form-caption">
            <td colspan="2">查看有限合伙人</td>
        </tr>
        <tr>
            <td class="field-label" width="15%">姓名:</td>
            <td class="field-input"><?=$bindValues['infos']['name']?></td>
        </tr>
        <tr>
            <td class="field-label">电话:</td>
            <td class="field-input"><?=$bindValues['infos']['tel']?></td>
        </tr>
        <tr>
            <td class="field-label">电子邮箱:</td>
            <td class="field-input"><?=$bindValues['infos']['email']?></td>
        </tr>
        <tr>
            <td class="field-label">地址:</td>
            <td class="field-input"><?=$bindValues['infos']['address']?></td>
        </tr>
        <tr>
            <td class="field-label">证件类型:</td>
            <td class="field-input"><?=\app\index\logic\Defs::$partnerCredentialTypeDefs[$bindValues['infos']['credential_type']]?></td>
        </tr>
        <tr>
            <td class="field-label">证件号码:</td>
            <td class="field-input"><?=$bindValues['infos']['credential_no']?></td>
        </tr>
        <?php if ($bindValues['infos']['enterprises']): ?>
        <tr>
            <td class="field-label">可见项目:</td>
            <td class="field-input">
                <?=\app\index\service\View::selector([
                    'value'=>$bindValues['infos']['enterprises'],
                    'model'=>'enterprises',
                    'readonly' => true,
                ])?>
            </td>
        </tr>
        <?php endif; ?>
        <tr>
            <td class="field-label">备注:</td>
            <td class="field-input"><?=str_replace("\r\n","<br>",$bindValues['infos']['note'])?></td>
        </tr>
    </table>
    <div class="easyui-tabs" data-options="fit:true">
        <div title="参与的基金" data-options="cache:false,href:'<?=$urlHrefs['funds']?>',iconCls:'fa fa-money',border:false"></div>
        <div title="投资收益" data-options="cache:false,href:'<?=$urlHrefs['dividends']?>',iconCls:'fa fa-share-alt',border:false"></div>
        <div title="附件" data-options="cache:false,href:'<?=$urlHrefs['attachments']?>',iconCls:'fa fa-file-text',border:false"></div>
    </div>
</form>