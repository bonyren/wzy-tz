<?php
use app\common\CommonDefs;
?>
<table id="<?=DATAGRID_ID?>" class="easyui-datagrid" data-options="striped:true,
    nowrap:false,
    rownumbers:true,
    autoRowHeight:true,
    singleSelect:true,
    url:'<?=$urlHrefs['index']?>',
    method:'post',
    pagination:false,
    pageSize:<?=DEFAULT_PAGE_ROWS?>,
    pageList:[10,20,30,50,80,100],
    border:false,
    fit:true,
    fitColumns:<?=$loginMobile?'false':'true'?>,
    title:'',
    onDblClickRow:function(index, row){
    },
    onLoadSuccess:function(data){
        $.each(data.rows, function(i, row){
        });
    },
    showFooter:true,
    footer:'#<?=FOOTER_ID?>'
    ">
    <thead>
    <tr>
        <?php if(!$readOnly){ ?>
        <th data-options="field:'operate',width:180,fixed:true,formatter:<?=JVAR?>.operate,align:'center'">操作</th>
        <?php } ?>
        <th data-options="field:'content',width:600,align:'center'">内容</th>
        <th data-options="field:'entered',width:200,align:'center'">时间</th>
    </tr>
    </thead>
</table>
<div id="<?=FOOTER_ID?>">
    <?php if(!$readOnly){ ?>
    <form id="<?=FORM_ID?>" method="post">
        <table class="table-form">
            <tr>
                <td class="field-input" style="width:80%;">
                    <input id="<?=FORM_ID?>_content" class="easyui-textbox" name="infos[content]" data-options="width:'100%',height:150,multiline:true,validType:['length[1,1024]']" />
                </td>
                <td class="field-input">
                    <a id="<?=FORM_ID?>_save" href="#" class="easyui-linkbutton" data-options="onClick:function(){ <?=JVAR?>.save(); },iconCls:'fa fa-save'">新增</a>
                    <a id="<?=FORM_ID?>_cancelEdit" href="#" class="easyui-linkbutton c2" data-options="onClick:function(){ <?=JVAR?>.cancelEdit(); },iconCls:'fa fa-mail-reply'">撤销</a>
                </td>
            </tr>
        </table>
    </form>
    <?php } ?>
</div>
<script type="text/javascript">
    var <?=JVAR?> = {
        currentId:0,
        datagrid:'#<?=DATAGRID_ID?>',
        operate:function(val, row){
            var btns = [];
            btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="<?=JVAR?>.edit(' + row.id + ')" title="编辑"><i class="fa fa-pencil-square-o">编辑</i></a>');
            btns.push('<a href="javascript:;" class="btn btn-outline-info size-MINI radius my-1" onclick="<?=JVAR?>.delete(' + row.id + ')" title="删除"><i class="fa fa-trash-o">删除</i></a>');
            return btns.join(' ');
        },
        reload:function(){
            $(this.datagrid).datagrid('reload');
        },
        edit:function(id){
            var that = this;
            var data = $(that.datagrid).datagrid('getData');
            var targetRows = $.grep(data.rows, function(row, index){
                return row.id == id;
            });
            if(targetRows.length == 0){
                return;
            }
            $('#<?=FORM_ID?>_cancelEdit').show();
            $('#<?=FORM_ID?>_save').linkbutton({text:'保存'});
            $("#<?=FORM_ID?>_content").textbox('setValue', targetRows[0].content);
            that.currentId = targetRows[0].id;
        },
        cancelEdit:function(){
            var that = this;
            $('#<?=FORM_ID?>_cancelEdit').hide();
            $('#<?=FORM_ID?>_save').linkbutton({text:'新增'});
            $("#<?=FORM_ID?>_content").textbox('setValue', '');
            that.currentId = 0;
        },
        save:function(){
            var that = this;
            var href = '<?=$urlHrefs['save']?>';
            var $form = $('#<?=FORM_ID?>');
            if(that.currentId){
                //修改
                href = GLOBAL.func.addUrlParam(href, 'id', that.currentId);
            }
            var isValid = $form.form('validate');
            if (!isValid) return;
            $.messager.progress({text:'处理中，请稍候...'});
            $.post(href, $form.serialize(), function(res){
                $.messager.progress('close');
                if(!res.code){
                    $.app.method.alertError(null, res.msg);
                }else{
                    $.app.method.tip('提示', res.msg, 'info');
                    $(that.dialog).dialog('close');
                    that.reload();
                    that.cancelEdit();
                }
            }, 'json');
            $(that.dialog).dialog('center');
        },
        delete:function(id){
            var that = this;
            var href = '<?=url('index/Scientists/requirementDelete')?>';
            href = GLOBAL.func.addUrlParam(href, 'id', id);
            $.messager.confirm('提示', '确认删除吗?', function(result){
                if(!result) return false;
                $.messager.progress({text:'处理中，请稍候...'});
                $.post(href, {}, function(res){
                    $.messager.progress('close');
                    if(!res.code){
                        $.app.method.alertError(null, res.msg);
                    }else{
                        $.app.method.tip('提示', res.msg, 'info');
                        that.reload();
                    }
                }, 'json');
            });

        }
    };
    setTimeout(function() {
        $('#<?=FORM_ID?>_cancelEdit').hide();
    }, 100);
</script>