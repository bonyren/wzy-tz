<div class="easyui-layout" data-options="fit:true">
    <div data-options="region:'north',collapsible:false,border:false" style="height:40%;">
        <table class="table-form" cellpadding="5">
            <tr>
                <td class="field-label" style="width: 20%;">姓名:</td>
                <td class="field-input">
                    <?=$infos['name']?>
                </td>
            </tr>
            <tr>
                <td class="field-label">领域:</td>
                <td class="field-input"">
                    <?=$infos['field_text']?>
                </td>
            </tr>
            <tr>
                <td class="field-label">工作场所(高校/企业):</td>
                <td class="field-input" colspan="3">
                    <?=$infos['place']?>
                </td>
            </tr>
            <tr>
                <td class="field-label">联系方式:</td>
                <td class="field-input">
                    <?=$infos['contact_way']?>
                </td>
            </tr>
            <tr>
                <td class="field-label">简介:</td>
                <td class="field-input">
                    <?=$infos['brief_introduction']?>
                </td>
            </tr>
            <tr>
                <td class="field-label">核心技术:</td>
                <td class="field-input">
                    <?=$infos['core_tech']?>
                </td>
            </tr>
            <tr>
                <td class="field-label">跟进人</td>
                <td>
                    <?php echo \app\index\service\View::selector([
                        'value'=>$infos['assigner'],
                        'model'=>'admins',
                        'value_field'=>'admin_id',
                        'label_field'=>'realname',
                        'readonly'=>1
                    ]); ?>
                </td>
            </tr>
        </table>
    </div>
    <div data-options="region:'center',border:true">
        <div class="easyui-tabs" data-options="fit:true,tabPosition:'left',justified:false,border:false">
            <div title="关联项目" data-options="cache:false,href:'<?=$urlHrefs['projects']?>',iconCls:'fa fa-diamond',border:false"></div>
            <div title="核心需求" data-options="cache:false,href:'<?=$urlHrefs['requirements']?>',iconCls:'fa fa-diamond',border:false"></div>
            <div title="事件" data-options="cache:false,href:'<?=$urlHrefs['events']?>',iconCls:'fa fa-th-list',border:false"></div>
        </div>
    </div>
</div>