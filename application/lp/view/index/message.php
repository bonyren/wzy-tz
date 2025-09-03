<div class="container mt-3">
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        这是一条测试消息
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        2020 welcome
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
<script>
    // Highcharts.setOptions({
    //     lang: {
    //         thousandsSep: ','
    //     }
    // });
    // var data = [{
    //     'id': '0.0',
    //     'parent': '',
    //     'name': '总投入资金'
    // }, {
    //     'id': '1.1',
    //     'parent': '0.0',
    //     'name': '进行中',
    // }, {
    //     'id': '1.2',
    //     'parent': '0.0',
    //     'name': '已退出',
    //     'value': 0
    // },
    //     {
    //         'id': '2.1',
    //         'parent': '1.1',
    //         'name': '中国',
    //         'value': 9000,
    //         // 'color': '#BF0B23',
    //     },
    //     {
    //         'id': '2.2',
    //         'parent': '1.1',
    //         'name': '其他',
    //         'value': 1000
    //     }
    // ];

    // Splice in transparent for the center circle
    // Highcharts.getOptions().colors.splice(0, 0, 'transparent');
    //
    // Highcharts.chart('chart2', {
    //     credits: false,
    //     title: {
    //         text: '2017 世界人口分布'
    //     },
    //     subtitle: {
    //         text: '数据来源： <href="">道和科技投资</a>'
    //     },
    //     series: [{
    //         type: "sunburst",
    //         data: data,
    //         allowDrillToNode: true,
    //         cursor: 'pointer',
    //         dataLabels: {
    //             formatter: function () {
    //                 var shape = this.point.node.shapeArgs;
    //                 var innerArcFraction = (shape.end - shape.start) / (2 * Math.PI);
    //                 var perimeter = 2 * Math.PI * shape.innerR;
    //                 var innerArcPixels = innerArcFraction * perimeter;
    //                 if (innerArcPixels > 16) {
    //                     return this.point.name;
    //                 }
    //             }
    //         },
    //         levels: [{
    //             level: 2,
    //             colorByPoint: true,
    //             dataLabels: {
    //                 rotationMode: 'parallel'
    //             }
    //         }]
    //
    //     }],
    //     tooltip: {
    //         headerFormat: "",
    //         pointFormat: '<b>{point.name}</b>的人口数量是：<b>{point.value}</b>'
    //     }
    // });
</script>