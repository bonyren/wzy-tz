<table class="table-form" cellpadding="5">
    <tr>
        <td class="field-label" width="120">姓名</td>
        <td><?=$row['name']?></td>
    </tr>
    <tr>
        <td class="field-label">职务</td>
        <td><?=$row['title']?></td>
    </tr>
    <tr>
        <td class="field-label">联系方式</td>
        <td><?=$row['contact']?></td>
    </tr>
    <tr>
        <td class="field-label">标签</td>
        <td>
            <?php echo \app\index\service\View::showTags(4,$row['id']); ?>
        </td>
    </tr>
    <tr>
        <td class="field-label">背景</td>
        <td><?=$row['description']?></td>
    </tr>
    <tr>
        <td class="field-label">附件</td>
        <td>
            <div class="easyui-panel" data-options="
                href:'<?=url('index/upload/viewAttaches',['attachmentType'=>8,'externalId'=>$row['id'],'uiStyle'=>\app\index\controller\Upload::ATTACHES_UI_LIGHT_STYLE])?>',
                border:false,
                minimizable:false,
                maximizable:false">
            </div>
        </td>
    </tr>
    <tr>
        <td class="field-label">跟进人</td>
        <td>
            <?php echo \app\index\service\View::selector([
                'value'=>$row['assigner'],
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
                'value'=>$row['additional_assigners'],
                'model'=>'admins',
                'value_field'=>'admin_id',
                'label_field'=>'realname',
                'readonly' => true,
            ]); ?>
        </td>
    </tr>
</table>