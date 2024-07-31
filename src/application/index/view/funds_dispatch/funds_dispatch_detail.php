<table class="table-form">
    <thead class="field-label">
        <tr>
            <th width="30%">合伙人</th>
            <th>类型</th>
            <th>金额</th>
            <th>费用</th>
            <th>所得税</th>
            <th>实收</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($records as $record){ ?>
        <tr>
            <th><?=$record['name']?></th>
            <th><?=\app\index\logic\Defs::$partnerTypeHtmlDefs[$record['type']]?></th>
            <th><?=$record['amount']?></th>
            <th><?=$record['fee']?></th>
            <th><?=$record['tax']?></th>
            <th><?=$record['final']?></th>
        </tr>
    <?php } ?>
    </tbody>
</table>