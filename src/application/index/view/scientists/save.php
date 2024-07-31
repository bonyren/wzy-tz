<div class="easyui-layout" data-options="fit:true">
    <?php if($id){ ?>
    <div data-options="region:'north',collapsible:false,border:false" style="height:50%;">
    <?php } ?>
        <form id="scientist-save-form" method="post">
            <table class="table-form" cellpadding="2">
                <tr>
                    <td class="field-label" style="width: 20%;">姓名:</td>
                    <td class="field-input">
                        <input class="easyui-textbox" name="infos[name]" value="<?=$infos['name']?>"
                                                               data-options="required:true,width:'100%',validType:['length[1,60]']" />
                    </td>
                </tr>
                <tr>
                    <td class="field-label">领域:</td>
                    <td class="field-input"">
                        <select class="easyui-combobox" name="infos[field][]" data-options="editable:false,
                                        method:'get',
                                        url:'<?=url('index/Config/getScientistFieldComboConfig')?>',
                                        valueField:'id',
                                        textField:'name',
                                        panelHeight:'auto',
                                        width:'100%',
                                        multiple:true,
                                        value:'<?=$infos['field']?>'">
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="field-label">工作场所(高校/企业):</td>
                    <td class="field-input" colspan="3">
                        <input class="easyui-textbox" name="infos[place]" value="<?=$infos['place']?>"
                                                               data-options="width:'100%',validType:['length[1,200]']" />
                    </td>
                </tr>
                <tr>
                    <td class="field-label">联系方式:</td>
                    <td class="field-input">
                        <input class="easyui-textbox" name="infos[contact_way]" value="<?=$infos['contact_way']?>" data-options="width:'100%',validType:['length[1,200]']" />
                    </td>
                </tr>
                <tr>
                    <td class="field-label">简介:</td>
                    <td class="field-input">
                        <input id="brief-introduction-textbox" class="easyui-textbox" name="infos[brief_introduction]" data-options="value:'<?=convertLineBreakToEscapeChars($infos['brief_introduction'])?>',width:'100%',height:'auto',multiline:true" />
                    </td>
                </tr>
                <tr>
                    <td class="field-label">核心技术:</td>
                    <td class="field-input">
                        <input id="core-tech-textbox" class="easyui-textbox" name="infos[core_tech]" data-options="value:'<?=convertLineBreakToEscapeChars($infos['core_tech'])?>',width:'100%',height:'auto',multiline:true,validType:['length[1,1024]']" />
                    </td>
                </tr>
                <tr>
                    <td class="field-label">跟进人</td>
                    <td>
                        <input class="easyui-combobox" name="infos[assigner]" style="width:200px;"
                            data-options="
                                editable:false,
                                value:'<?=$infos['assigner']?$infos['assigner']:''?>',
                                valueField:'admin_id',textField:'realname',
                                url:'<?=url('admins/getAllUsers')?>'">
                    </td>
                </tr>
            </table>
        </form>
    <?php if($id){ ?>
    </div>
    <?php } ?>
    <?php if($id){ ?>
    <div data-options="region:'center',border:true">
        <div class="easyui-tabs" data-options="fit:true,tabPosition:'left',justified:false,border:false">
            <div title="关联项目" data-options="cache:false,href:'<?=$urlHrefs['projects']?>',iconCls:'fa fa-diamond',border:false"></div>
            <div title="核心需求" data-options="cache:false,href:'<?=$urlHrefs['requirements']?>',iconCls:'fa fa-diamond',border:false"></div>
            <div title="事件" data-options="cache:false,href:'<?=$urlHrefs['events']?>',iconCls:'fa fa-th-list',border:false"></div>
        </div>
    </div>
    <?php } ?>
</div>
<script type="text/javascript">
    setTimeout(function() {
        $("#brief-introduction-textbox").textbox('autoHeight');
        $("#core-tech-textbox").textbox('autoHeight');
    }, 200);
</script>