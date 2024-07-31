<div class="easyui-tabs" data-options="fit:true,border:false,selected:0">
    <?php foreach ($stage as $k=>$v): ?>
    <div title="<?=$v['label']?>" href="<?=url('enterprises/files',['enterprise_id'=>$enterprise_id,'stage'=>$k,'readonly'=>$readonly])?>"
         iconCls="<?=$k>1?'fa fa-angle-right':''?>"></div>
    <?php endforeach; ?>
</div>