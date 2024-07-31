<?php
use app\index\controller\Upload;
use app\index\logic\ProgressLogs;
?>
<div class="easyui-tabs" data-options="fit:true,border:false,tabPosition:'bottom',selected:<?=$default_tab?>">
    <div title="基本信息" iconCls="fa fa-square"
        href="<?=url('enterprises/baseInfo',['enterprise_id'=>$row['id']])?>"></div>

    <?php if ($row['step'] > 1): ?>
    <div title="公司情况" border="false" iconCls="fa fa-square"
         href="<?=url('enterprises/companyInfo',['enterprise_id'=>$row['id']])?>"></div>

    <?php if ($row['step'] >= 4): ?>
    <div title="投资与交割" border="false" iconCls="fa fa-square"
         href="<?=url('Investment/invested',['enterprise_id'=>$row['id'],'readonly'=>1])?>"></div>

    <?php if ($row['step'] >= 5): ?>
    <div title="投后管理" border="false" iconCls="fa fa-square">
        <div class="easyui-tabs" fit="true" border="false">
            <div title="投后概览" iconCls="fa fa-square"
                 href="<?=url('EnterpriseInvest/investedOverview',['enterprise_id'=>$row['id']])?>">
            </div>
            <div title="财务报告" iconCls="fa fa-square"
                 href="<?=url('index/upload/viewAttaches',['attachmentType'=>19,'externalId'=>$row['id'],'uiStyle'=>Upload::ATTACHES_UI_DATAGRID_STYLE])?>">
            </div>
            <div title="投后支持" iconCls="fa fa-square"
                 href="<?=url('ProgressLogs/light',['category'=>ProgressLogs::INVESTED_SUPPORT_CATEGORY,'externalId'=>$row['id'],'readOnly'=>1])?>">
            </div>
            <div title="公司动态"
                 href="<?=url('ProgressLogs/light',['category'=>ProgressLogs::INVESTED_PROGRESS_CATEGORY,'externalId'=>$row['id'],'readOnly'=>1])?>">
            </div>
            <div title="投融资管理" href="<?=url('enterprises/investmentAndFinancing',['enterprise_id'=>$row['id'],'readonly'=>1])?>"></div>
        </div>
    </div>

    <div title="退出管理" cache="false" href="<?=url('enterprises/exitList',['enterprise_id'=>$row['id'],'readonly'=>1])?>" border="false" iconCls="fa fa-square">
       <!--
        <div class="easyui-tabs" fit="true" border="false">
            <div title="项目分红"href="<?=url('enterprises/dividends',['enterprise_id'=>$row['id'],'readonly'=>1])?>"></div>
            <div title="退出方案" href="">
                <table class="table-form" cellpadding="5">
                    <tr>
                        <td width="26%" class="field-label">方案说明</td>
                        <td><?=$row['extra']['exit_schemes']?></td>
                    </tr>
                    <tr>
                        <td class="field-label">附件</td>
                        <td>
                            <div class="easyui-panel" data-options="
                                    href:'<?=url('index/upload/viewAttaches',['attachmentType'=>23,'externalId'=>$row['id'],'uiStyle'=>Upload::ATTACHES_UI_TABLE_STYLE])?>',
                                    border:false,
                                    minimizable:false,
                                    maximizable:false">
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div title="分配方案">
                <table class="table-form" cellpadding="5">
                    <tr>
                        <td width="26%" class="field-label">方案说明</td>
                        <td><?=$row['extra']['exit_allocate_schemes']?></td>
                    </tr>
                    <tr>
                        <td class="field-label">附件</td>
                        <td>
                            <div class="easyui-panel" data-options="
                                    href:'<?=url('index/upload/viewAttaches',['attachmentType'=>24,'externalId'=>$row['id'],'uiStyle'=>Upload::ATTACHES_UI_TABLE_STYLE])?>',
                                    border:false,
                                    minimizable:false,
                                    maximizable:false">
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div title="退出交割"></div>
            <div title="税务方案">
                <table class="table-form" cellpadding="5">
                    <tr>
                        <td width="26%" class="field-label">方案说明</td>
                        <td><?=$row['extra']['exit_tax_schemes']?></td>
                    </tr>
                    <tr>
                        <td class="field-label">附件</td>
                        <td>
                            <div class="easyui-panel" data-options="
                                    href:'<?=url('index/upload/viewAttaches',['attachmentType'=>25,'externalId'=>$row['id'],'uiStyle'=>Upload::ATTACHES_UI_TABLE_STYLE])?>',
                                    border:false,
                                    minimizable:false,
                                    maximizable:false">
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        -->
    </div>
    <?php endif; ?>
    <?php endif; ?>
    <?php endif; ?>
    <div title="文件归档" iconCls="fa fa-square" href="<?=url('enterprises/filesTab',['enterprise_id'=>$row['id'],'readonly'=>1])?>"></div>
    <div title="日志" iconCls="fa fa-square" href="<?=url('audit_logs/index')?>?models=<?=$_model_name?>&recordId=<?=$row['id']?>"></div>
</div>
<script>
    $.parser.onComplete = function(){
        var txtbox = $(".auto-height");
        if (txtbox.length) {
            $.each(txtbox, function(i,v){
                $(v).textbox('autoHeight');
            })
        }
    }
</script>