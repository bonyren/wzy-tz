<form>
    <table class="table-form" cellpadding="5">
        <tr>
            <td class="field-label">项目名称:</td>
            <td class="field-input"><input class="easyui-textbox" name="project_name" value="<?=isset($dd['project_name'])?$dd['project_name']:''?>" data-options="width:300,validType:['length[1,100]']" /></td>
        </tr>
        <tr>
            <td class="field-label">注册地:</td>
            <td class="field-input"><input class="easyui-textbox" name="register_place" value="<?=isset($dd['register_place'])?$dd['register_place']:''?>" data-options="width:300,validType:['length[1,100]']" /></td>
        </tr>
        <tr>
            <td class="field-label">是否领投:</td>
            <td class="field-input">
                <input class="easyui-radiobutton" name="is_lead_investment" value="1" label="是" <?=(isset($dd['is_lead_investment']) && $dd['is_lead_investment'])?'checked':''?>/>
                <input class="easyui-radiobutton" name="is_lead_investment" value="0" label="否" <?=(!isset($dd['is_lead_investment']) || !$dd['is_lead_investment'])?'checked':''?>/>
            </td>
        </tr>
        <tr>
            <td class="field-label">当轮共同投资人:</td>
            <td class="field-input"><input class="easyui-textbox" name="co_investors" value="<?=isset($dd['co_investors'])?$dd['co_investors']:''?>" data-options="width:300,validType:['length[1,100]']" /></td>
        </tr>
        <tr>
            <td class="field-label">是否占董监高席位:</td>
            <td class="field-input">
                <input class="easyui-radiobutton" name="is_director_position" value="1" label="是" <?=(isset($dd['is_director_position']) && $dd['is_director_position'])?'checked':''?>/>
                <input class="easyui-radiobutton" name="is_director_position" value="0" label="否" <?=(!isset($dd['is_director_position']) || !$dd['is_director_position'])?'checked':''?>/>
            </td>
        </tr>
        <tr>
            <td class="field-label">后轮融资情况:</td>
            <td class="field-input"><input class="easyui-textbox" name="after_financing_info" value="<?=isset($dd['after_financing_info'])?$dd['after_financing_info']:''?>" data-options="width:300,validType:['length[1,100]']" /></td>
        </tr>
        <tr>
            <td class="field-label">现在占股比:</td>
            <td class="field-input"><input class="easyui-textbox" name="now_stock_ratio" value="<?=isset($dd['now_stock_ratio'])?$dd['now_stock_ratio']:''?>" data-options="width:300,validType:['length[1,100]']" /></td>
        </tr>
        <tr>
            <td class="field-label">现持有股权价值:</td>
            <td class="field-input"><input class="easyui-textbox" name="now_hold_stock_value" value="<?=isset($dd['now_hold_stock_value'])?$dd['now_hold_stock_value']:''?>" data-options="width:300,validType:['length[1,100]']" /></td>
        </tr>
        <tr>
            <td class="field-label">退出方式:</td>
            <td class="field-input"><input class="easyui-textbox" name="exit_way" value="<?=isset($dd['exit_way'])?$dd['exit_way']:''?>" data-options="width:300,validType:['length[1,100]']" /></td>
        </tr>
        <tr>
            <td class="field-label">是否已完全退出:</td>
            <td class="field-input">
                <input class="easyui-radiobutton" name="is_totally_exist" value="1" label="是" <?=(isset($dd['is_totally_exist']) && $dd['is_totally_exist'])?'checked':''?>/>
                <input class="easyui-radiobutton" name="is_totally_exist" value="0" label="否" <?=(!isset($dd['is_totally_exist']) || !$dd['is_totally_exist'])?'checked':''?>/>
            </td>
        </tr>
        <tr>
            <td class="field-label">分红/退出金额:</td>
            <td class="field-input"><input class="easyui-textbox" name="dividend_return_amount" value="<?=isset($dd['dividend_return_amount'])?$dd['dividend_return_amount']:''?>" data-options="width:300,validType:['length[1,100]']" /></td>
        </tr>
        <tr>
            <td class="field-label">回报倍数:</td>
            <td class="field-input"><input class="easyui-textbox" name="return_multiple" value="<?=isset($dd['return_multiple'])?$dd['return_multiple']:''?>" data-options="width:300,validType:['length[1,100]']" /></td>
        </tr>
        <tr>
            <td class="field-label">IRR:</td>
            <td class="field-input"><input class="easyui-textbox" name="irr" value="<?=isset($dd['irr'])?$dd['irr']:''?>" data-options="width:300,validType:['length[1,100]']" /></td>
        </tr>
    </table>
</form>