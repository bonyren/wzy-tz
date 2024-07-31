<?php
use app\index\logic\Upload as UploadLogic;
use app\index\controller\Upload as UploadController;
?>
<div class="form-container">
<form id="enterprise_baseinfo_form" class="form-body">
<table class="table-form" cellpadding="5">
    <tr>
        <td width="100" class="field-label">企业名称</td>
        <td>
            <input class="easyui-textbox" required="true" name="enterprise[name]" value="<?=$enterprise['name']?>" 
                data-options="validType:['length[1,60]']" style="width:90%">
            <a href="https://www.tianyancha.com/search?key=<?=urlencode($enterprise['name'])?>" target="_blank">天眼查</a>
        </td>
    </tr>
    <tr>
        <td class="field-label">企业简称</td>
        <td>
            <input class="easyui-textbox" name="enterprise[alias]" value="<?=$enterprise['alias']?>" style="width:100%" data-options="validType:['length[1,20]']">
        </td>
    </tr>
    <tr>
        <td class="field-label">企业Logo</td>
        <td>
            <div>
                <img id="enterprise_logo_preview" src="<?=$enterprise['logo']?>" class="img-thumbnail" style="width: 120px;">
                <a href="#" class="easyui-linkbutton" data-options="iconCls:'fa fa-upload',onClick:function(){
                        EnterpriseModule.uploadLogo(function(obj){
                            if(obj.code){
                                $('#enterprise_logo_preview').attr('src', obj.data.absolute_url);
                                $('#enterprise_logo_path').val(obj.data.absolute_url);
                            }else{
                                $.app.method.alertError(null, obj.msg);
                            }
                        });
                    }"></a>
            </div>
            <input id="enterprise_logo_path" type="hidden" name="enterprise[logo]" value="<?=$enterprise['logo']?>">
        </td>
    </tr>
    <tr>
        <td class="field-label">创始人</td>
        <td>
            <input class="easyui-textbox" required="true" name="founder[name]" value="<?=$enterprise['founder']['name']?>" 
                data-options="validType:['length[1,100]']" style="width:100%">
        </td>
    </tr>
    <tr>
        <td class="field-label">公司简介</td>
        <td>
            <input class="easyui-textbox auto-height" multiline="true" name="enterprise[description]"
                   data-options="validType:['length[1,1024]'],value:'<?=convertLineBreakToEscapeChars($enterprise['description'])?>'" style="width:100%;">
        </td>
    </tr>
    <tr>
        <td class="field-label">地址</td>
        <td>
            <input class="easyui-textbox" name="enterprise[address]" value="<?=$enterprise['address']?>" 
                data-options="validType:['length[1,100]']" style="width:100%">
        </td>
    </tr>
    <tr>
        <td class="field-label">联系方式</td>
        <td>
            <input class="easyui-textbox" name="founder[contact]" value="<?=$enterprise['founder']['contact']?>" 
                data-options="validType:['length[1,100]']" style="width:100%">
        </td>
    </tr>
    <tr>
        <td class="field-label">所在行业</td>
        <td>
            <input class="easyui-combotree empty_value" name="enterprise[tags][<?=\app\index\logic\Tag::TAG_INDUSTRY?>]" data-options="
                value:[<?=$enterprise['tags'][\app\index\logic\Tag::TAG_INDUSTRY]?join(',',array_keys($enterprise['tags'][\app\index\logic\Tag::TAG_INDUSTRY])):''?>],
                url:'<?=url('enterprises/getIndustriesTree')?>',
                multivalue:false,
                multiple:true" style="width:100%">
        </td>
    </tr>
    <tr>
        <td class="field-label">项目来源</td>
        <td>
            <input class="easyui-textbox" name="enterprise[lead_source]" value="<?=$enterprise['lead_source']?>" 
                data-options="validType:['length[1,20]']" style="width:100%">
        </td>
    </tr>
    <tr>
        <td class="field-label">商业计划书(BP)</td>
        <td>
            <div class="easyui-panel" data-options="
                href:'<?=url('upload/attaches',['attachmentType'=>3,'externalId'=>$enterprise['id'],'uiStyle'=>UploadController::ATTACHES_UI_LIGHT_STYLE])?>',
                border:false">
            </div>
        </td>
    </tr>
    <?php if($enterprise['step'] >= 3): ?>
        <tr>
            <td class="field-label">投资建议书</td>
            <td>
                <div class="easyui-panel" data-options="
                    href:'<?=url('upload/attaches',['attachmentType'=>9,'externalId'=>$enterprise['id'],'uiStyle'=>UploadController::ATTACHES_UI_LINK_STYLE])?>',
                    border:false">
                </div>
            </td>
        </tr>
    <?php endif; ?>
    <tr>
        <td class="field-label">关联子行业</td>
        <td>
            <?php echo \app\index\service\View::selector([
                'name'=>'extra[sub_industry]',
                'value'=>$enterprise['extra']['sub_industry'],
                'model'=>'sub_industry',
                'value_field'=>'id',
                'label_field'=>'name',
                'url' => url('index/SubIndustry/index'),
            ]); ?>
        </td>
    </tr>
    <tr>
        <td class="field-label">关联辅助项目</td>
        <td>
            <?php echo \app\index\service\View::selector([
                'name'=>'enterprise[relate_enterprises]',
                'value'=>$enterprise['relate_enterprises'],
                'model'=>'enterprises',
                'value_field'=>'id',
                'label_field'=>'name',
                'multiple'=>1,
                'url' => url('enterprises/index'),
            ]); ?>
        </td>
    </tr>
    <tr>
        <td class="field-label">关联科学家</td>
        <td>
            <?php echo \app\index\service\View::selector([
                'name'=>'enterprise[scientist_id]',
                'value'=>$enterprise['scientist_id'],
                'model'=>'scientists',
                'value_field'=>'id',
                'label_field'=>'name',
                'url' => url('scientists/index')
            ]); ?>
        </td>
    </tr>
    <tr>
        <td class="field-label">关联上市公司</td>
        <td>
            <?php echo \app\index\service\View::selector([
                'name'=>'enterprise[relate_companies]',
                'value'=>$enterprise['relate_companies'],
                'model'=>'companies',
                'value_field'=>'id',
                'label_field'=>'name',
                'multiple'=>1,
                'url' => url('companies/index'),
            ]); ?>
        </td>
    </tr>
    <tr>
        <td class="field-label">主跟进人</td>
        <td>
            <select class="easyui-combobox" name="enterprise[assigner]" style="width:100%;"
                    data-options="required:true,multiple:true,multivalue:false,editable:false,value:'<?=$enterprise['assigner']?>'">
                <?php foreach ($users as $v): ?>
                    <option value="<?=$v['admin_id']?>"><?=$v['realname']?></option>
                <?php endforeach; ?>
            </select>
        </td>
    </tr>
    <tr>
        <td class="field-label">辅助跟进人</td>
        <td>
            <select class="easyui-combobox empty_value" name="enterprise[additional_assigners]" style="width:100%;"
                    data-options="multiple:true,multivalue:false,editable:false,value:'<?=$enterprise['additional_assigners']?>'">
                <?php foreach ($users as $v): ?>
                    <option value="<?=$v['admin_id']?>"><?=$v['realname']?></option>
                <?php endforeach; ?>
            </select>
        </td>
    </tr>
</table>
</form>
<div class="form-toolbar">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-save"
        onclick="EnterpriseModule.saveInfos(<?=$enterprise['id']?>,'#enterprise_baseinfo_form')">保存
    </a>
</div>
</div>