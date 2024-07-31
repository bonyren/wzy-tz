<!--
<table border="0" cellpadding="0" cellspacing="0" style="width:100%;height:100%;border-collapse: collapse">
    <tr>
        <td height="80" align="center">
            <button type="button" class="btn btn-sm btn-outline-primary">投入 <b><?=$total?>万</b></button>
            <button type="button" class="btn btn-sm btn-outline-success mx-1">退出 <b><?=$quit?>万</b></button>
            <button type="button" class="btn btn-sm btn-outline-danger">收益 <b><?=$quit-$total?>万</b></button>
        </td>
    </tr>
    <tr>
        <td>
            <div id="chart1" style="height:100%;"></div>
        </td>
    </tr>
</table>
-->
<div id="chart1" style="height:95%;width:100%;margin:0 auto"></div>
<script>
    // window.chartColors = {
    //     red: 'rgb(255, 99, 132)',
    //     orange: 'rgb(255, 159, 64)',
    //     yellow: 'rgb(255, 205, 86)',
    //     green: 'rgb(75, 192, 192)',
    //     blue: 'rgb(54, 162, 235)',
    //     purple: 'rgb(153, 102, 255)',
    //     grey: 'rgb(201, 203, 207)'
    // };
    // var colors = Highcharts.getOptions().colors;
    // console.log(colors);
    Highcharts.chart('chart1', {
        chart: {
            type: 'pie',
        },
        credits: false,
        title: false,
        // subtitle: {
        //     text: '数据来源：<a href=""></a>'
        // },
        yAxis: {
            title: {
                text: 'Total percent market share'
            }
        },
        plotOptions: {
            pie: {
                shadow: false,
                center: ['50%', '50%'],
            }
        },
        // tooltip: {
        //     valueSuffix: '%'
        // },
        colors:[
            'rgb(255, 159, 64)',
            'rgb(255, 205, 86)',
            'rgb(75, 192, 192)',
            'rgb(54, 162, 235)',
            'rgb(153, 102, 255)',
            'rgb(201, 203, 207)',
            'rgb(255, 99, 132)',
        ],
        series: [{
            name: '金额',
            data: [{name: "总投入", y: <?=$total?>, color: 'rgb(255, 99, 132)'}],
            size: '60%',
            dataLabels: {
                formatter: function () {
                    return this.point.name + '<br> ' + this.y + '万元';
                },
                color: '#ffffff',
                distance: -90
            }
        }, {
            name: '实投金额',
            showInLegend: true,
            data: <?=$funds?>,
            // [
            //     {name: "Chrome v65.0", y: 40},
            //     {name: "Chrome v64.0", y: 10},
            //     {name: "Chrome v63.0", y: 20},
            //     {name: "Chrome v62.0", y: 30}
            // ],
            size: '100%',
            innerSize: '50%',
            dataLabels: {
                formatter: function () {
                    return (this.point.alias ? this.point.alias : this.point.name) + '<br> ' + this.y + '万元';
                },
                color: '#ffffff',
                distance: -40
            },
            id: 'the-funds',
            events: {
                click: function(event) {
                    var url = '<?=url('funds/projects')?>?fund_id='+event.point.fund_id;
                    mApp.go('已投项目',url);
                }
            }
        }]
        // responsive: {
        //     rules: [{
        //         condition: {
        //             maxWidth: 400
        //         },
        //         chartOptions: {
        //             series: [{
        //                 id: 'versions',
        //                 dataLabels: {
        //                     enabled: false
        //                 }
        //             }]
        //         }
        //     }]
        // }
    });
</script>