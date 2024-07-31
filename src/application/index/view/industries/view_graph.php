<div id="chart-<?=$row['id']?>" style="width:100%;height:100%"></div>
<script type="text/javascript" src="/static/highcharts/code/highcharts-more.js"></script>
<script>
var chart = Highcharts.chart('chart-<?=$row['id']?>', {
    chart: {
        type: 'bubble',
        plotBorderWidth: 1,
        zoomType: 'xy',
    },
    credits:false,
    legend: {
        enabled: false
    },
    title: {
        text: '<?=$row['name']?>'
    },
    xAxis: {
        gridLineWidth: 1,
        // title: {
        //     text: '每天脂肪摄入量'
        // },
        // labels: {
        //     format: '{value} gr'
        // },
        // plotLines: [{
        //     color: 'black',
        //     dashStyle: 'dot',
        //     width: 2,
        //     value: 65,
        //     label: {
        //         rotation: 0,
        //         y: 15,
        //         style: {
        //             fontStyle: 'italic'
        //         },
        //         text: '正常脂肪摄入量65g/天'
        //     },
        //     zIndex: 3
        // }]
    },
    yAxis: {
        startOnTick: false,
        endOnTick: false,
        // title: {
        //     text: '行业高度'
        // },
        // labels: {
        //     format: '{value} gr'
        // },
        maxPadding: 0.2,
        // plotLines: [{
        //     color: 'black',
        //     dashStyle: 'dot',
        //     width: 2,
        //     value: 50,
        //     label: {
        //         align: 'right',
        //         style: {
        //             fontStyle: 'italic'
        //         },
        //         text: '正常糖的摄入量 50g/天',
        //         x: -10
        //     },
        //     zIndex: 3
        // }]
    },
    tooltip: {
        useHTML: true,
        headerFormat: '<table>',
        pointFormat: '<tr><th colspan="2"><h3>{point.full_name}</h3></th></tr>' +
        '<tr><th>偏移值:</th><td>{point.x}</td></tr>' +
        '<tr><th>行业高度:</th><td>{point.y}</td></tr>' +
        '<tr><th>企业实力:</th><td>{point.z}</td></tr>',
        footerFormat: '</table>',
        followPointer: true
    },
    plotOptions: {
        series: {
            dataLabels: {
                enabled: true,
                format: '{point.name}'
            }
        }
    },
    series: [{
        data: <?=$data?>
    }]
});
</script>