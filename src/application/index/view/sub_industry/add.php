<form method="post" style="height:100%">
    <table class="table-form" cellpadding="5">
        <tr>
            <td width="120" class="field-label">行业名称</td>
            <td>
                <input class="easyui-textbox" required="true" name="data[name]" style="width:95%;">
            </td>
        </tr>
        <tr>
            <td class="field-label">行业描述</td>
            <td>
                <input id="D<?=UNIQID?>" class="easyui-textbox" width="100%" height="auto" multiline="true" name="data[description]" style="width:95%;height:85px;">
            </td>
        </tr>
        <tr>
            <td class="field-label">关联项目</td>
            <td>
                <?php echo \app\index\service\View::selector([
                    'name'=>'data[enterprises]',
                    'model'=>'enterprises',
                    'value_field'=>'id',
                    'label_field'=>'name',
                    'multiple'=>true,
                    'url' => url('index/Enterprises/index'),
                ]); ?>
            </td>
        </tr>
    </table>
</form>
<script type="text/javascript">
$.parser.onComplete = function(context){
    if ($("#D<?=UNIQID?>").length) {
        $("#D<?=UNIQID?>").textbox('autoHeight');
    }
}
</script>