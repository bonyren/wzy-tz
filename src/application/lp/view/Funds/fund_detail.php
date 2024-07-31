<table class="table table-striped">
    <tbody>
        <tr>
            <th>基金名称</th>
        </tr>
        <tr>
            <td><?=$fund['name']?></td>
        </tr>
        <tr>
            <th>注册地址</th>
        </tr>
        <tr>
            <td><?=$fund['reg_place']?></td>
        </tr>
        <tr>
            <th>规模</th>
        </tr>
        <tr>
            <td><?=round($fund['size']/10000,2)?> 万元</td>
        </tr>
        <tr>
            <th>基金投资期</th>
        </tr>
        <tr>
            <td>
                <?=$fund['invest_period']?> 年（管理费率：<?=$fund['invest_fee_ratio']?> %）
            </td>
        </tr>
        <tr>
            <th>基金退出期</th>
        </tr>
        <tr>
            <td><?=$fund['exit_period']?> 年（管理费率：<?=$fund['exit_fee_ratio']?> %）</td>
        </tr>
        <tr>
            <th>基金延长期</th>
        </tr>
        <tr>
            <td><?=$fund['extend_period']?> 年</td>
        </tr>
        <tr>
            <th>基金年度报告</th>
        </tr
        <tr>
            <td>
                <?php foreach($fund['reports'] as $report){ ?>
                    <table class="table table-sm">
                        <tr class="table-info"><td><?=$report['from_date']?> -  <?=$report['end_date']?></td></tr>
                        <tr class="table-light"><td><?=$report['desc']?></td></tr>
                        <tr class="table-light"><td>
                            <?php foreach($report['files'] as $file){ ?>
                                <a href="javascript:void(0)" onclick="mApp.view({title:'',url:'<?=url('index/Upload/previewAttach',['attachmentId'=>$file['attachment_id']])?>'})"><b><?=$file['original_name']?></b></a><br />
                            <?php } ?>
                        </td></tr>
                    </table>
                <?php } ?>
            </td>
        </tr>
    </tbody>
</table>