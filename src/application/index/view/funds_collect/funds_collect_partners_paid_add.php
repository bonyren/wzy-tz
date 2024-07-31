<form method="post" style="width: 100%;height: 100%;">
    <table class="table-form">
        <tr class="form-caption">
            <td colspan="2">添加实投</td>
        </tr>
        <tr>
            <td class="field-label">实投金额(元):</td>
            <td class="field-input">
                <div id="funds_collect_partners_paid_amount" data-options="fundId:<?=$bindValues['fund_id']?>,
                    ffcId:0,
                    title:'<?=$bindValues['title'].'合伙出资'?>'">
                </div>
            </td>
        </tr>
        <input type="hidden" id="funds_collect_partners_paid_amount_input" name="infos[ffc_id]" value=""/>
    </table>
</form>
<script type="text/javascript">
    $("#funds_collect_partners_paid_amount").fundContribute();
    var fundsCollectPartnersPaidAddModule = {
        save:function(){
            var ffcId = $("#funds_collect_partners_paid_amount").fundContribute('save');
            if(ffcId<=0){
                return false;
            }
            $('#funds_collect_partners_paid_amount_input').val(ffcId);
            return true;
        }
    }
</script>