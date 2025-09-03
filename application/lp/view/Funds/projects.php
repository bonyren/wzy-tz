<style>
    .funds .table td, .funds .table th {vertical-align:middle;}
</style>
<div class="container funds">
    <!--
    <table class="mt-3 table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">项目名称</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($projects as $k=>$v): ?>
            <tr>
                <td scope="row"><?=($k+1)?></td>
                <td><a href="javascript:void(0)" onclick="Projects.detail('<?=$v['enterprise_id']?>')"><?=$v['name']?></a></td>
            </tr>
            <tr>
                <td align="right" colspan="2" style="padding:0.5rem;border-top-style: dashed;">
                    <?php if(empty($fund_id)): ?>
                    <a href="javascript:void(0)" onclick="Projects.funds('<?=$v['enterprise_id']?>')" class="badge badge-warning">基金:<?=$v['funds_count']?></a>
                    <?php endif; ?>
                    <span class="badge badge-success">投资:<?=round($v['amount']/10000,2)?>万</span>
                    <span class="badge badge-danger">占股:<?=$v['stock_ratio']?>%</span>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    -->
    <div class="mt-4"></div>
    <?php foreach ($projects as $k=>$v): ?>
    <div class="mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1"><a href="javascript:void(0)" onclick="Projects.detail('<?=$v['enterprise_id']?>')"><?=$v['name']?></a></div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto text-center">
                                <div class="mr-3">投资</div>
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?=round($v['amount']/10000,2)?>万</div>
                            </div>
                            <div class="col text-center">
                                <div class="mr-3">占股</div>
                                <div class="h5 mb-0 mr-3 font-weight-bold text-success"><?=$v['stock_ratio']?>%</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-cube fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<script>
var Projects=Projects||{detail:function(project_id){var url='<?=url('funds/projectDetail')?>?project_id='+project_id;mApp.go('项目信息',url);},funds:function(project_id){var url='<?=url('funds/index')?>?project_id='+project_id;mApp.go('投资基金',url);}};</script>