<div id="timeline-Chart-<?=$uniqid?>" style="width:100%;height:100%;">
    <div id="timeline-Container-<?=$uniqid?>"></div>
</div>
<script>
    var milestonesModule_<?=$uniqid?> = {
        timelineChart:null,
        resizeTimelineChart:function(){
            if(milestonesModule_<?=$uniqid?>.timelineChart) {
                var w1 = $("#timeline-Chart-<?=$uniqid?>").width();
                var h1 = $("#timeline-Chart-<?=$uniqid?>").height();
                console.log(w1, h1);
                if(w1 && h1) {
                    var chart = $('#timeline-Container-<?=$uniqid?>').highcharts();
                    chart.setSize(w1, h1, false);
                    chart.reflow();
                }
            }
        },
        refreshTimelineChart:function(){
            milestonesModule_<?=$uniqid?>.timelineChart = $('#timeline-Container-<?=$uniqid?>').highcharts({
                chart: {
                    type: 'timeline'
                },
                credits: {
                    enabled: false
                },
                xAxis: {
                    visible: false
                },
                yAxis: {
                    visible: false
                },
                title: {
                    text: '<?=$title?>'
                },
                subtitle: {
                    text: ''
                },
                colors: [
                    '#4185F3',
                    '#427CDD',
                    '#406AB2',
                    '#3E5A8E',
                    '#3B4A68',
                    '#363C46'
                ],
                series: [{
                    data: <?=json_encode($milestones, JSON_UNESCAPED_UNICODE)?>
                }]
            });
        }
    };
    $(function(){
        milestonesModule_<?=$uniqid?>.refreshTimelineChart();
        milestonesModule_<?=$uniqid?>.resizeTimelineChart();
        $(document).off('resizeFundTimelineChart').on('resizeFundTimelineChart', function(){
            console.log('milestones chart resize');
            milestonesModule_<?=$uniqid?>.resizeTimelineChart();
            return false;
        });
    });
</script>