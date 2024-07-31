<div class="easyui-panel" fit="true" border="false" style="padding:0 20px;">
    <div class="qt-tag-exists" style="border-bottom:1px solid #ccc;padding:20px 0;margin-bottom:20px;">
        <div class="clearfloat" style="clear: both"></div>
    </div>

    <input id="qt-tag-input-name" class="easyui-textbox" required="true" prompt="请输入标签文本" style="width:50%">
    <a class="easyui-linkbutton" iconCls="fa fa-plus" onclick="<?=JVAR?>.add()">添加</a>

    <h3 class="">或从以下标签中选择:</h3>
    <div class="qt-tag-pools">
        <?php foreach ($pools as $v): ?>
        <span id="qt-tag-id-<?=$v['tag_id']?>" class="qt-tag-label" tag-id="<?=$v['tag_id']?>" tag-name="<?=$v['name']?>" onclick="<?=JVAR?>.choose(<?=$v['tag_id']?>)">
            <?=$v['name']?><a href="javascript:;" class="qt-tag-add"></a>
        </span>
        <?php endforeach; ?>
        <div class="clearfloat" style="clear:both"></div>
    </div>
</div>
<script type="text/javascript">
var <?=JVAR?> = {
    default_value:<?=$default_value?>,
    init:function(){
        var that = this;
        if (!that.default_value.length) {
            return;
        }
        for (var i in that.default_value) {
            that.choose(that.default_value[i]);
        }
    },
    add:function(){
        var that = this,$tbox = $('#qt-tag-input-name');
        if (!$tbox.textbox('isValid')) {
            return;
        }
        var name = $tbox.textbox('getValue');
        $.messager.progress({text:'处理中，请稍候...'});
        $.post('<?=$urls['add']?>', {name:name,category:'<?=$category?>'}, function(res){
            $.messager.progress('close');
            if(!res.code){
                $.app.method.alertError(null, res.msg);
            }else{
                $tbox.textbox('clear');
                var elem_id = 'qt-tag-id-'+res.data.id;
                var str = '<span id="'+elem_id+'" class="qt-tag-label" tag-id="'+res.data.id+'" tag-name="'+res.data.name+'" onclick="<?=JVAR?>.choose('+res.data.id+')">'
                    +res.data.name+'<a href="javascript:;" class="qt-tag-add"></a></span>';
                if (!$('#'+elem_id).length) {
                    $('.qt-tag-pools .clearfloat').before(str);
                }
                that.choose(res.data.id);
            }
        }, 'json');
    },
    choose:function(id){
        var $tag = $('#qt-tag-id-'+id);
        $tag.hide();
        var name = $tag.attr('tag-name');
        var str = '<span class="qt-tag-label" tag-id="'+id+'" tag-name="'+name+'">' + name +
            '<a href="javascript:;" class="qt-tag-remove" onclick="<?=JVAR?>.remove(this)"></a>'+
            '</span>';
        $('.qt-tag-exists .clearfloat').before(str);
    },
    remove:function(that){
        var $tag = $(that).parent();
        var tid = $tag.attr('tag-id');
        $tag.remove();
        $('#qt-tag-id-'+tid).show();
    }
};
<?=JVAR?>.init();
</script>