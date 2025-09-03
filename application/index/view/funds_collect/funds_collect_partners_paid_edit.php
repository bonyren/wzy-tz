<form method="post" style="width: 100%;height: 100%;">
    <table class="table-form" cellpadding="5">
        <tr>
            <td class="field-label" style="width: 150px;">合伙出资</td>
            <td class="field-input">
                <div id="funds_collect_partners_paid_amount" data-options="fundId:<?=$bindValues['fund_id']?>,
                    ffcId:<?=$bindValues['infos']['ffc_id']?>,
                    title:'<?=$bindValues['title'].'合伙出资'?>'"></div>
            </td>
        </tr>
    </table>
</form>
<script type="text/javascript">
$("#funds_collect_partners_paid_amount").fundContribute();var fundsCollectPartnersPaidEditModule={save:function(){var ffcId=$("#funds_collect_partners_paid_amount").fundContribute('save');return ffcId>0?true:false;}};</script>