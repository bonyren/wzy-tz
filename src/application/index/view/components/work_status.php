<table class="table-form">
    <tr>
        <td>
            承担人：
            <?php echo \app\index\service\View::selector([
                'name'=>'work_status[workers]',
                'value'=>$workers,
                'model'=>'admins',
                'value_field'=>'admin_id',
                'label_field'=>'realname',
                'multiple'=>true,
                'url' => url('index/Admins/admins'),
                'readonly'=>$readOnly
            ]); ?>
        </td>
        <td>
            已完成？
            <input class="easyui-checkbox" name="work_status[status]" value="<?=\app\index\model\WorkStatus::WORK_FINISHED_STATUS?>" data-options="onChange:function(checked){
                        if(checked){
                            $('#date_<?=$uniqid?>').datebox('enable');
                        }else{
                            $('#date_<?=$uniqid?>').datebox('disable');
                        }
                    },checked:<?=$status==\app\index\model\WorkStatus::WORK_FINISHED_STATUS?'true':'false'?>,
                    disabled:<?=$readOnly?'true':'false'?>"/>
            <input class="easyui-datebox" id="date_<?=$uniqid?>" name="work_status[finished_date]"
                   data-options="required:true,width:200,editable:false,disabled:<?=(!$readOnly && $status==\app\index\model\WorkStatus::WORK_FINISHED_STATUS)?'false':'true'?>"
                   value="<?=dateFilter($finished_date)?>"/>
        </td>
    </tr>
</table>
