<form>
	<table class="table-form" cellpadding="5">
		<tr>
			<td width="100" class="field-label">上级行业</td>
			<td>
                <select class="easyui-combobox" name="data[pid]" data-options="width:'100%',editable:false,value:'<?=$row['pid']?$row['pid']:''?>'">
                    <option value=""></option>
                    <?php foreach ($parents as $v): ?>
                    <option value="<?=$v['id']?>"><?=$v['name']?></option>
                    <?php endforeach; ?>
                </select>
            </td>
		</tr>
		<tr>
			<td class="field-label">行业名称</td>
			<td><input class="easyui-textbox" required="true" name="data[name]" value="<?=$row['name']?>" style="width:100%"></td>
		</tr>
	</table>
</form>