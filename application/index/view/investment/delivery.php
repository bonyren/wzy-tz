<?php
use app\index\controller\Upload;
?>
<div class="easyui-tabs" data-options="fit:true,border:false,selected:<?=$row['status']>0 && $row['meeting_id'] ? 1 : 0?>">
    <?php if ($row['meeting_id']) { ?>
    <div title="投决会" data-options="
        href:'<?=url('index/meetings/view', ['meeting_id'=>$row['meeting_id'],'style'=>'full'])?>',
        iconCls:'fa fa-hand-paper-o'"></div>
    <?php } elseif ($row['status'] < 100) { ?>
        <div title="投决会" data-options="
        href:'<?=url('index/enterprises/initiatemeeting')?>?meeting_type=3&enterprise_id=<?=$enterprise_id?>&investment_id=<?=$row['id']?>&callback=deliveryView.reload',
        iconCls:'fa fa-hand-paper-o'"></div>
    <?php } ?>

    <div title="投资信息" data-options="
        href:'<?=url('index/Investment/basic', ['id'=>$row['id'], 'readonly'=>$readonly])?>',
        iconCls:'fa fa-info'"></div>

    <?php if($row['status'] > 0) { ?>
    <div title="尽调资料" data-options="
        href:'<?=url('index/upload/attachesComplex',['attachmentType'=>25,'externalId'=>$enterprise_id,'externalId2'=>$row['id'],'readOnly'=>$readonly])?>',
        iconCls:'fa fa-search'"></div>

    <div title="投资协议" data-options="
        href:'<?=url('index/upload/'.$attaches,['attachmentType'=>11,'externalId'=>$enterprise_id,'externalId2'=>$row['id'],'uiStyle'=>Upload::ATTACHES_UI_DATAGRID_STYLE])?>',
        iconCls:'fa fa-share-alt'"></div>

    <div title="前置材料" iconCls="fa fa-files-o">
        <table class="table-form" cellpadding="5">
            <tr>
                <td width="200" class="field-label">股东会决议-盖章附件</td>
                <td>
                    <div class="easyui-panel" data-options="
                        href:'<?=url('upload/'.$attaches,['attachmentType'=>12,'externalId'=>$enterprise_id,'externalId2'=>$row['id'],'uiStyle'=>Upload::ATTACHES_UI_TABLE_STYLE])?>',
                        border:false,
                        minimizable:false,
                        maximizable:false">
                    </div>
                </td>
            </tr>

            <tr>
                <td class="field-label">投资协议-盖章附件</td>
                <td>
                    <div class="easyui-panel" data-options="
                        href:'<?=url('upload/'.$attaches,['attachmentType'=>13,'externalId'=>$enterprise_id,'externalId2'=>$row['id'],'uiStyle'=>Upload::ATTACHES_UI_TABLE_STYLE])?>',
                        border:false,
                        minimizable:false,
                        maximizable:false">
                    </div>
                </td>
            </tr>
            <tr>
                <td class="field-label">投委会决议-签字附件</td>
                <td>
                    <div class="easyui-panel" data-options="
                        href:'<?=url('upload/'.$attaches,['attachmentType'=>14,'externalId'=>$enterprise_id,'externalId2'=>$row['id'],'uiStyle'=>Upload::ATTACHES_UI_TABLE_STYLE])?>',
                        border:false,
                        minimizable:false,
                        maximizable:false">
                    </div>
                </td>
            </tr>
            <tr>
                <td class="field-label">合规证明-盖章附件</td>
                <td>
                    <div class="easyui-panel" data-options="
                        href:'<?=url('upload/'.$attaches,['attachmentType'=>15,'externalId'=>$enterprise_id,'externalId2'=>$row['id'],'uiStyle'=>Upload::ATTACHES_UI_TABLE_STYLE])?>',
                        border:false,
                        minimizable:false,
                        maximizable:false">
                    </div>
                </td>
            </tr>
            <tr>
                <td class="field-label">股东放弃优先购买权-签字附件</td>
                <td>
                    <div class="easyui-panel" data-options="
                        href:'<?=url('upload/'.$attaches,['attachmentType'=>16,'externalId'=>$enterprise_id,'externalId2'=>$row['id'],'uiStyle'=>Upload::ATTACHES_UI_TABLE_STYLE])?>',
                        border:false,
                        minimizable:false,
                        maximizable:false">
                    </div>
                </td>
            </tr>
            <tr>
                <td class="field-label">打款账号通知-盖章附件</td>
                <td>
                    <div class="easyui-panel" data-options="
                        href:'<?=url('upload/'.$attaches,['attachmentType'=>17,'externalId'=>$enterprise_id,'externalId2'=>$row['id'],'uiStyle'=>Upload::ATTACHES_UI_TABLE_STYLE])?>',
                        border:false,
                        minimizable:false,
                        maximizable:false">
                    </div>
                </td>
            </tr>
            <tr>
                <td class="field-label">营业执照</td>
                <td>
                    <div class="easyui-panel" data-options="
                        href:'<?=url('upload/'.$attaches,['attachmentType'=>22,'externalId'=>$enterprise_id,'externalId2'=>$row['id'],'uiStyle'=>Upload::ATTACHES_UI_TABLE_STYLE])?>',
                        border:false,
                        minimizable:false,
                        maximizable:false">
                    </div>
                </td>
            </tr>
        </table>
        <div class="easyui-panel" title="其他文件" data-options="
            height:500,
            href:'<?=url('upload/attachesComplex',['attachmentType'=>26,'externalId'=>$enterprise_id,'externalId2'=>$row['id'],'fit'=>true])?>',
            border:false">
        </div>
    </div>
    <div data-options="title:'交割操作',iconCls:'fa fa-exchange',
                href:'<?=url('EnterpriseInvest/joinedFunds',['enterprise_id'=>$enterprise_id,'investment_id'=>$row['id'],'readonly'=>$readonly])?>'"></div>
    <div title="交割后证明" data-options="
                href:'<?=url('upload/'.$attaches,['attachmentType'=>18,'externalId'=>$enterprise_id,'externalId2'=>$row['id'],'uiStyle'=>Upload::ATTACHES_UI_DATAGRID_STYLE])?>',
                iconCls:'fa fa-print'"></div>
    <?php } ?>
</div>
<script type="text/javascript">
var deliveryView={investmentId:<?=$row['id']?>,save:function(id){var $form=$('#investment-base-info-'+id);if(!$form.form('validate')){return false;}
$.messager.progress({text:'处理中，请稍候...'});$.post('<?=url('investment/add')?>?id='+id,$form.serialize(),function(res){$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg);}},'json');},remove:function(id){$.messager.confirm('提示','确定删除该轮投资吗？',function(y){if(!y){return false;}
$.messager.progress({text:'处理中，请稍候...'});$.post('<?=url('investment/remove')?>',{id:id},function(res){$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg);$('#enterprise_edit_view').tabs('getSelected').panel('refresh');}},'json');})},reload:function(){$('#enterprise-invested-tabs').tabs('getSelected').panel('refresh');}};</script>