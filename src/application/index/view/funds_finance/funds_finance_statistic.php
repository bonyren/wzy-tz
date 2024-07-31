<table class="daohe-table daohe-table-border">
    <tr>
        <td class="active" width="15%"><span class="fa fa-money text-danger"></span> 剩余现金金额:</td>
        <td class="text-c"><span class="text-primary"><?=moneyFormat($bindValues['infos']['left_amount'])?></span></td>
    </tr>
    <tr>
        <td class="active"><span class="fa fa-star text-danger"></span> 合伙人出资:</td>
        <td>
            <table class="daohe-table daohe-table-border daohe-table-bordered daohe-table-bg">
                <thead>
                <tr class="text-c">
                    <th width="30%">总额(元)</th>
                </tr>
                </thead>
                <tbody>
                    <tr class="text-c">
                        <td>
                            <span class="text-primary"><?=moneyFormat($bindValues['infos']['contributes']['total'])?></span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td class="active"><span class="fa fa-square text-danger"></span> 基金收入:</td>
        <td>
            <table class="daohe-table daohe-table-border daohe-table-bordered daohe-table-bg">
                <thead>
                <tr class="text-c">
                    <th width="20%">类型</th>
                    <th width="30%">总额(元)</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($bindValues['infos']['incomes'] as $income){ ?>
                <tr class="text-c">
                    <td>
                        <?=\app\index\logic\Defs::$fundIncomeTypeHtmlDefs[$income['type']]?>
                    </td>
                    <td>
                        <span class="text-primary"><?=moneyFormat($income['total'])?></span>
                    </td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td class="active"><span class="fa fa-leaf text-danger"></span> 基金缴税:</td>
        <td>
            <table class="daohe-table daohe-table-border daohe-table-bordered daohe-table-bg">
                <thead>
                <tr class="text-c">
                    <th width="20%">类型</th>
                    <th width="30%">总额(元)</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($bindValues['infos']['taxes'] as $tax){ ?>
                    <tr class="text-c">
                        <td>
                            <?=\app\index\logic\Defs::$fundTaxTypeHtmlDefs[$tax['type']]?>
                        </td>
                        <td>
                            <span class="text-primary"><?=moneyFormat($tax['total'])?></span>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td class="active"><span class="fa fa-share-alt text-danger"></span> 项目投资:</td>
        <td>
            <table class="daohe-table daohe-table-border daohe-table-bordered daohe-table-bg">
                <thead>
                <tr class="text-c">
                    <th width="30%">总额(元)</th>
                </tr>
                </thead>
                <tbody>
                <tr class="text-c">
                    <td>
                        <span class="text-primary"><?=moneyFormat($bindValues['infos']['invests']['total'])?></span>
                    </td>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td class="active"><span class="fa fa-square text-danger"></span> 基金费用:</td>
        <td>
            <table class="daohe-table daohe-table-border daohe-table-bordered daohe-table-bg">
                <thead>
                <tr class="text-c">
                    <th width="20%">类型</th>
                    <th width="30%">总额(元)</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($bindValues['infos']['fees'] as $fee){ ?>
                    <tr class="text-c">
                        <td>
                            <?=\app\index\logic\Defs::$fundFeeTypeHtmlDefs[$fee['type']]?>
                        </td>
                        <td>
                            <span class="text-primary"><?=moneyFormat($fee['total'])?></span>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </td>
    </tr>
</table>