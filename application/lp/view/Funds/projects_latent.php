<style>
    .funds .table td, .funds .table th {vertical-align:middle;}
</style>
<div class="container funds">
    <div class="mt-4"></div>
    <?php foreach ($projects as $k=>$v): ?>
    <div class="mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            <a href="javascript:void(0)" onclick="Projects.detail('<?=$v['id']?>')"><?=$v['name']?></a>
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto text-center">
                                <div class="mr-3">投资</div>
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?=$v['ffe_id'] ? floor($v['amount']/10000).'万' : ' - '?></div>
                            </div>
                            <div class="col text-center">
                                <div class="mr-3">占股</div>
                                <div class="h5 mb-0 mr-3 font-weight-bold text-success">%</div>
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
var Projects=Projects||{detail:function(project_id){var url='<?=url('funds/projectDetail')?>?project_id='+project_id;mApp.go('项目信息',url);}};</script>