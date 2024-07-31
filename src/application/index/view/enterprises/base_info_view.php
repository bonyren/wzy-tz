<table class="table-form" cellpadding="5">
    <tr>
        <td width="26%" class="field-label">企业名称</td>
        <td>
            <?=$enterprise['name']?>
            <a href="https://www.tianyancha.com/search?key=<?=urlencode($enterprise['name'])?>" target="_blank">[天眼查]</a>
        </td>
    </tr>
    <tr>
        <td class="field-label">企业简称</td>
        <td><?=$enterprise['alias']?></td>
    </tr>
    <tr>
        <td class="field-label">企业Logo</td>
        <td>
            <img id="enterprise_logo_preview" src="<?=$enterprise['logo']?>" class="img-thumbnail" style="width: 120px;">
        </td>
    </tr>
    <tr>
        <td class="field-label">创始人</td>
        <td><?=$enterprise['founder']['name']?></td>
    </tr>
    <tr>
        <td class="field-label">公司简介</td>
        <td>
            <?=$enterprise['description']?>
        </td>
    </tr>
    <tr>
        <td class="field-label">地址</td>
        <td><?=$enterprise['address']?></td>
    </tr>
    <tr>
        <td class="field-label">联系方式</td>
        <td><?=$enterprise['founder']['contact']?></td>
    </tr>
    <tr>
        <td class="field-label">所在行业</td>
        <td>
            <?php echo \app\index\service\View::showTags(\app\index\logic\Tag::TAG_INDUSTRY,$enterprise['id']); ?>
        </td>
    </tr>
    <tr>
        <td class="field-label">项目来源</td>
        <td><?=$enterprise['lead_source']?></td>
    </tr>
    <tr>
        <td class="field-label">商业计划书(BP)</td>
        <td>
            <div class="easyui-panel" data-options="
                href:'<?=url('upload/viewAttaches',['attachmentType'=>3,'externalId'=>$enterprise['id'],'uiStyle'=>\app\index\controller\Upload::ATTACHES_UI_TABLE_STYLE])?>',
                border:false,
                minimizable:false,
                maximizable:false">
            </div>
        </td>
    </tr>
    <?php if ($enterprise['step'] >= 3): ?>
        <tr>
            <td class="field-label">投资建议书</td>
            <td>
                <div class="easyui-panel" data-options="
                    href:'<?=url('upload/viewAttaches',['attachmentType'=>9,'externalId'=>$enterprise['id'],'uiStyle'=>\app\index\controller\Upload::ATTACHES_UI_TABLE_STYLE])?>',
                    border:false,
                    minimizable:false,
                    maximizable:false">
                </div>
            </td>
        </tr>
    <?php endif; ?>
    <tr>
        <td class="field-label">关联子行业</td>
        <td>
            <?php echo \app\index\service\View::selector([
                'value'=>$enterprise['extra']['sub_industry'],
                'model'=>'sub_industry',
                'value_field'=>'id',
                'label_field'=>'name',
                'readonly' => true,
            ]); ?>
        </td>
    </tr>
    <tr>
        <td class="field-label">关联辅助项目</td>
        <td>
            <?php echo \app\index\service\View::selector([
                'value'=>$enterprise['relate_enterprises'],
                'model'=>'enterprises',
                'value_field'=>'id',
                'label_field'=>'name',
                'readonly' => true,
            ]); ?>
        </td>
    </tr>
    <tr>
        <td class="field-label">关联科学家</td>
        <td>
            <?php echo \app\index\service\View::selector([
                'value'=>$enterprise['scientist_id'],
                'model'=>'scientists',
                'value_field'=>'id',
                'label_field'=>'name',
                'readonly' => true,
            ]); ?>
        </td>
    </tr>
    <tr>
        <td class="field-label">关联上市公司</td>
        <td>
            <?php echo \app\index\service\View::selector([
                'value'=>$enterprise['relate_companies'],
                'model'=>'companies',
                'value_field'=>'id',
                'label_field'=>'name',
                'readonly' => true,
            ]); ?>
        </td>
    </tr>
    <tr>
        <td class="field-label">主跟进人</td>
        <td>
            <?php echo \app\index\service\View::selector([
                'value'=>$enterprise['assigner'],
                'model'=>'admins',
                'value_field'=>'admin_id',
                'label_field'=>'realname',
                'readonly' => true,
            ]); ?>
        </td>
    </tr>
    <tr>
        <td class="field-label">辅助跟进人</td>
        <td>
            <?php echo \app\index\service\View::selector([
                'value'=>$enterprise['additional_assigners'],
                'model'=>'admins',
                'value_field'=>'admin_id',
                'label_field'=>'realname',
                'readonly' => true,
            ]); ?>
        </td>
    </tr>
</table>