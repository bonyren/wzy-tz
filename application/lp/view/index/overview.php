<div class="jumbotron bg-white">
    <p class="lead">尊敬的客户，感谢您一如既往的支持。</p>
    <p class="lead"></p>当前投资金额：</p>
    <h2 class="display-5 text-danger">￥<?=$amount?></h2>
    <p class="lead"></p>参与如下项目：</p>
    <div class="container">
        <?php
        $i=0;
        $total = count($enterprises);
        while($i<$total) {?>
            <div class="row">
                <?php for($j=0; $j<3; $j++){ ?>
                <div class="col">
                    <?php if($i<$total){ ?>
                        <a href="javascript:;" onclick="Overview.detail('<?=$enterprises[$i]['id']?>')" style="line-height:80px">
                            <?php if($enterprises[$i]['logo']){ ?>
                            <img src="<?=$enterprises[$i]['logo']?>" title="<?=$enterprises[$i]['name']?>" class="img-thumbnail align-middle"/>
                            <?php }else{ ?>
                            <div class="border border-warning text-center shadow-sm rounded bg-warning text-white" style="height: 100%">
                                <span class="align-middle"><?=$enterprises[$i]['name']?></span>
                            </div>
                            <?php } ?>
                        </a>
                    <?php } ?>
                    <?php $i++ ?>
                </div>
                <?php } ?>
            </div>
            <div class="mt-1"></div>
        <?php } ?>
    </div>
</div>
<script>
var Overview=Overview||{detail:function(project_id){var url='<?=url('funds/projectDetail')?>?project_id='+project_id;mApp.go('项目信息',url);}};</script>