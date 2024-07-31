<table class="table-form" cellpadding="5">
    <tr>
        <td width="150" class="field-label">公司名称</td>
        <td><?=$data['name']?></td>
    </tr>
    <tr>
        <td class="field-label">所属省份</td>
        <td><?=$data['province']?></td>
    </tr>
    <tr>
        <td class="field-label">董事长</td>
        <td><?=$data['chairman']?></td>
    </tr>
    <tr>
        <td class="field-label">实际控制人</td>
        <td><?=$data['controller']?></td>
    </tr>
    <tr>
        <td class="field-label">所有制性质</td>
        <td><?=$data['forms']?></td>
    </tr>
    <tr>
        <td class="field-label">成立日期</td>
        <td><?=$data['established_date']?></td>
    </tr>
    <tr>
        <td class="field-label">注册资本</td>
        <td><?=$data['reg_asset']?></td>
    </tr>
    <tr>
        <td class="field-label">上市日期</td>
        <td><?=$data['listed_date']?></td>
    </tr>
    <tr>
        <td class="field-label">公司网址</td>
        <td><?=$data['website']?></td>
    </tr>
    <tr>
        <td class="field-label">公司简介</td>
        <td><?=$data['introduction']?></td>
    </tr>
    <tr>
        <td class="field-label">招股说明书</td>
        <td>
            <div class="easyui-panel" data-options="border:false,href:'<?=url('upload/viewAttaches',[
                'attachmentType'=>29,
                'externalId'=>$data['id'],
                'uiStyle'=>\app\index\controller\Upload::ATTACHES_UI_TABLE_STYLE])?>'">
            </div>
        </td>
    </tr>
    <tr>
        <td class="field-label">研究报告</td>
        <td>
            <div class="easyui-panel" data-options="border:false,href:'<?=url('upload/viewAttaches',[
                'attachmentType'=>30,
                'externalId'=>$data['id'],
                'uiStyle'=>\app\index\controller\Upload::ATTACHES_UI_TABLE_STYLE])?>'">
            </div>
        </td>
    </tr>
    <tr>
        <td class="field-label">跟进人</td>
        <td>
            <?php echo \app\index\service\View::selector([
                'value'=>$data['assigner'],
                'model'=>'admins',
                'value_field'=>'admin_id',
                'label_field'=>'realname',
                'readonly'=>1
            ]); ?>
        </td>
    </tr>
</table>