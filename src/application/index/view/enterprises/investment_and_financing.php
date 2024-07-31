<div class="easyui-layout" data-options="fit:true">
    <div data-options="
        region:'north',
        title:'股权变更',
        href:'<?=url('enterprises/financeRecords',['enterprise_id'=>$enterprise_id,'readonly'=>$readonly])?>',
        border:false" style="height:50%;border-bottom:1px solid #95B8E7"></div>
    <div data-options="
        href:'<?=url('enterprises/shareholders',['enterprise_id'=>$enterprise_id,'readonly'=>$readonly])?>',
        region:'center',
        title:'股东表',
        border:false"></div>
</div>