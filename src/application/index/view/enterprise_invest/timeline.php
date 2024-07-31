<div id="T<?=UNIQID?>" style="width:100%;"></div>
<script type="text/javascript">
var <?=JVAR?> = {
    chart:null,
    init:function(){
        this.chart();
    },
    chart:function(){
        this.chart = $('#T<?=UNIQID?>').highcharts({
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
                text: '<?=$bind['enterprise']['name']?>'
            },
            subtitle: {
                text: ''
            },
            series: [{
                // label: {
                //     style:{"font-weight": "normal"}
                // },
                data: <?=json_encode($bind['chart_data'], JSON_UNESCAPED_UNICODE)?>,
                // data: [{
                //     name: 'First dogs',
                //     label: '1951: First dogs in space',
                //     description: '22 July 1951 First dogs in space (Dezik and Tsygan) '
                // }, {
                //     name: 'Sputnik 1',
                //     label: '1957: First artificial satellite',
                //     description: '4 October 1957 First artificial satellite. First signals from space.'
                // }, {
                //     name: 'First human spaceflight',
                //     label: '1961: First human spaceflight (Yuri Gagarin)',
                //     description: 'First human spaceflight (Yuri Gagarin), and the first human-crewed orbital flight'
                // }, {
                //     name: 'First human on the Moon',
                //     label: '1969: First human on the Moon',
                //     description: 'First human on the Moon, and first space launch from a celestial body other than the Earth. First sample return from the Moon'
                // }, {
                //     name: 'First space station',
                //     label: '1971: First space station',
                //     description: 'Salyut 1 was the first space station of any kind, launched into low Earth orbit by the Soviet Union on April 19, 1971.'
                // }, {
                //     name: 'Apollo–Soyuz Test Project',
                //     label: '1975: First multinational manned mission',
                //     description: 'The mission included both joint and separate scientific experiments, and provided useful engineering experience for future joint US–Russian space flights, such as the Shuttle–Mir Program and the International Space Station.'
                // }]
            }]
        });
    }
}
<?=JVAR?>.init();
</script>