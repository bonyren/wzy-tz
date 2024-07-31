<div id="enterprise-invested-tabs" class="easyui-tabs" data-options="fit:true,border:false,tools:'#invested-tab-tools'">
    <?php foreach ($rows as $v): ?>
    <div title="<?=$v['title']?>" href="<?=url('Investment/delivery',['id'=>$v['id'],'readonly'=>$readonly])?>" iconCls="fa fa-tags"></div>
    <?php endforeach; ?>
</div>
<?php if(!$readonly): ?>
<div id="invested-tab-tools">
    <a href="javascript:void(0)" class="easyui-linkbutton" data-options="plain:true,iconCls:'fa fa-plus'"
       onclick="addInvestmentTab()">新增投资</a>
</div>
<?php endif; ?>
<script type="text/javascript">
var addInvestmentTab = function(){
    EnterpriseModule.addInvestment('<?=$enterprise_id?>',function(){
        var tab = $('#enterprise_edit_view').tabs('getSelected');
        tab.panel('refresh');
    })
}
</script>