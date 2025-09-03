<div class="easyui-tabs" data-options="fit:true,tabPosition:'bottom',justified:false,border:false">
    <div title="基金概览" data-options="cache:false,href:'<?=$urlHrefs['fundsOverview']?>',iconCls:'fa fa-eye',border:false,onResize:function(width, height){
            $(document).trigger('resizeFundTimelineChart');
        }">
    </div>
    <div title="基金进展" data-options="cache:false,href:'<?=$urlHrefs['fundsProgressEvent']?>',iconCls:'fa fa-flag',border:false"></div>
    <div title="基本信息" data-options="cache:false,href:'<?=$urlHrefs['fundsSave']?>',iconCls:'fa fa-info-circle',border:false"></div>
    <div title="基金财务" data-options="cache:false,href:'<?=$urlHrefs['fundsFinance']?>',iconCls:'fa fa-money',border:false"></div>
    <?php if($bindValues['statusFilter'] == \app\index\logic\Funds::FUND_ALL_STATUS || $bindValues['statusFilter'] >= \app\index\logic\Funds::FUND_COLLECT_STATUS){ ?>
    <div title="基金募集" data-options="cache:false,href:'<?=$urlHrefs['fundsCollect']?>',iconCls:'fa fa-magnet',border:false,selected:<?=$bindValues['statusFilter'] == \app\index\logic\Funds::FUND_COLLECT_STATUS?'true':'false'?>">
    </div>
    <?php } ?>
    <?php if($bindValues['statusFilter'] == \app\index\logic\Funds::FUND_ALL_STATUS || $bindValues['statusFilter'] >= \app\index\logic\Funds::FUND_INVEST_STATUS){ ?>
    <div title="基金投资" data-options="cache:false,iconCls:'fa fa-share-alt',border:false,selected:<?=$bindValues['statusFilter'] == \app\index\logic\Funds::FUND_INVEST_STATUS?'true':'false'?>">
        <div class="easyui-tabs" data-options="fit:true">
            <div title="投资项目" data-options="cache:false,href:'<?=$urlHrefs['fundsInvestProjects']?>',iconCls:'fa fa-random',border:false"></div>
        </div>
    </div>
    <?php } ?>
    <?php if($bindValues['statusFilter'] == \app\index\logic\Funds::FUND_ALL_STATUS || $bindValues['statusFilter'] >= \app\index\logic\Funds::FUND_MANAGE_STATUS){ ?>
    <div title="基金管理" data-options="cache:false,iconCls:'fa fa-wrench',border:false,selected:<?=$bindValues['statusFilter'] == \app\index\logic\Funds::FUND_MANAGE_STATUS?'true':'false'?>">
        <div class="easyui-tabs" data-options="fit:true,justified:false">
            <div title="文件管理" data-options="cache:false,href:'<?=$urlHrefs['fundsManageArchives']?>',iconCls:'fa fa-files-o',border:false"></div>
        </div>
    </div>
    <?php } ?>
    <?php if($bindValues['statusFilter'] == \app\index\logic\Funds::FUND_ALL_STATUS || $bindValues['statusFilter'] >= \app\index\logic\Funds::FUND_MANAGE_STATUS){ ?>
    <div title="基金退出" data-options="cache:false,iconCls:'fa fa-sign-out',border:false,selected:<?=$bindValues['statusFilter'] == \app\index\logic\Funds::FUND_EXIT_STATUS?'true':'false'?>">
        <div class="easyui-tabs" data-options="fit:true,justified:false">
            <div title="收益分配" data-options="cache:false,href:'<?=$urlHrefs['fundsDispatch']?>',iconCls:'fa fa-users',border:false"></div>
        </div>
    </div>
    <?php } ?>
</div>