<?php
use app\index\logic\ProgressLogs;
use app\index\logic\Enterprise as EnterpriseLogic;
?>
<div id="enterprise_edit_view" class="easyui-tabs" data-options="fit:true,border:false,tabPosition:'bottom',selected:<?=intval($default_tab)?>">
    <div title="基本信息" cache="false" iconCls="fa fa-square"
         href="<?=url('enterprises/baseInfo',['enterprise_id'=>$enterprise['id'],'readonly'=>$readonly])?>">
    </div>

    <?php if ($enterprise['step'] >= EnterpriseLogic::STEP_LEARN): ?>
    <div title="公司情况" cache="false" border="false" iconCls="fa fa-square"
         href="<?=url('enterprises/companyInfo',['enterprise_id'=>$enterprise['id'],'readonly'=>$readonly])?>">
    </div>
    <?php endif; ?>
    <?php if ($enterprise['step'] >= EnterpriseLogic::STEP_INVESTING): ?>
    <div  title="投资与交割" cache="false" border="false" iconCls="fa fa-square"
        href="<?=url('Investment/invested',['enterprise_id'=>$enterprise['id'],'readonly'=>0])?>">
    </div>
    <?php endif; ?>
    <?php if ($enterprise['step'] >= EnterpriseLogic::STEP_POST_INVESTED): ?>
    <div title="投后管理" cache="false" border="false" iconCls="fa fa-square">
        <div class="easyui-tabs" fit="true" border="false">
            <div title="投后概览" iconCls="fa fa-square"
                 href="<?=url('EnterpriseInvest/investedOverview',['enterprise_id'=>$enterprise['id']])?>">
            </div>
            <div title="财务报告" data-options="
                fit:true,
                href:'<?=url('index/upload/attaches',['attachmentType'=>19,'externalId'=>$enterprise['id'],'uiStyle'=>\app\index\controller\Upload::ATTACHES_UI_DATAGRID_STYLE])?>',
                border:false">
            </div>
            <div title="投后支持" iconCls="fa fa-square"
                 href="<?=url('ProgressLogs/light',['category'=>ProgressLogs::PROGRESS_LOG_INVESTED_SUPPORT_CATEGORY,'externalId'=>$enterprise['id']])?>">
            </div>
            <div title="公司动态"
                 href="<?=url('ProgressLogs/light',['category'=>ProgressLogs::PROGRESS_LOG_INVESTED_ACTIVITY_CATEGORY,'externalId'=>$enterprise['id']])?>">
            </div>
            <div title="投融资管理" href="<?=url('enterprises/investmentAndFinancing',['enterprise_id'=>$enterprise['id']])?>"></div>
        </div>
    </div>
    <div title="退出管理" cache="false" 
        href="<?=url('enterprises/exitList',['enterprise_id'=>$enterprise['id']])?>" border="false" iconCls="fa fa-square">
    </div>
    <?php endif; ?>
    <div title="文件归档" iconCls="fa fa-square" href="<?=url('enterprises/filesTab',['enterprise_id'=>$enterprise['id']])?>"></div>
</div>
<script>
$.parser.onComplete=function(){var txtbox=$(".auto-height");if(txtbox.length){$.each(txtbox,function(i,v){$(v).textbox('autoHeight');})}
$.parser.onComplete=$.noop;};</script>