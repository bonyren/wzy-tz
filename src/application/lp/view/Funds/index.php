<style>
    .funds .card-header {padding:0;}
    .funds .btn {padding:.375rem;}
    .funds .table td, .funds .table th {vertical-align:middle;}
</style>
<div class="container funds">
    <!--
    <table class="mt-3 table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">基金名称</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($funds as $k=>$v) {
            if ($project_id) {
                $pids = $invested[$v['fund_id']]['projects_id'];
                if (empty($pids) || !in_array($project_id,$pids)) {
                    continue;
                }
            }
        ?>
            <tr>
                <td scope="row"><?=($k+1)?></td>
                <td><a href="javascript:void(0)" onclick="Funds.detail('<?=$v['fund_id']?>')"><?=$v['name']?></a></td>
            </tr>
            <tr>
                <td align="right" colspan="2" style="padding:0.5rem;border-top-style: dashed;">
                    <a href="javascript:void(0)" onclick="Funds.projects('<?=$v['fund_id']?>')" class="badge badge-warning">项目:<?=intval($invested[$v['fund_id']]['total'])?></a>
                    <span class="badge badge-info">规模:<?=round($v['size']/10000,2)?>万</span>
                    <span class="badge badge-danger">出资:<?=round($v['amount']/10000,2)?>万</span>
                    <?=\app\index\logic\Defs::$fundPartnerStatusHtmlDefs[$v['fp_status']]?>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    -->
    <div class="mt-4"></div>
    <?php
    foreach ($funds as $k=>$v) {
    if ($project_id) {
        $pids = $invested[$v['fund_id']]['projects_id'];
        if (empty($pids) || !in_array($project_id,$pids)) {
            continue;
        }
    }
    ?>
    <div class="mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1"><a href="javascript:void(0)" onclick="Funds.detail('<?=$v['fund_id']?>')"><?=$v['name']?></a></div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto text-center">
                                <div class="mr-3">规模</div>
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?=round($v['size']/10000,2)?>万</div>
                            </div>
                            <div class="col text-center">
                                <div class="mr-3">出资</div>
                                <div class="h5 mb-0 mr-3 font-weight-bold text-success"><?=round($v['amount']/10000,2)?>万</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-money fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
<script>
var Funds = Funds || {
    detail: function(fund_id){
        var url = '<?=url('funds/fundDetail')?>?fund_id='+fund_id;
        mApp.go('基金信息',url);
    },
    projects:function(fund_id){
        var url = '<?=url('funds/projects')?>?fund_id='+fund_id;
        mApp.go('投资项目',url);
    }
}
</script>