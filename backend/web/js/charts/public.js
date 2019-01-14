//显示报表
function showCharts(xAxis_data, series_data, id, title, series_name) {
    var option = {
        title: {
            text: title,
            x: 'center'
        },
        tooltip: {
            trigger: 'item',
            formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        legend: {
            orient: 'vertical',
            left: 'left',
            data: xAxis_data
        },
        series: [
            {
                name: series_name,
                type: 'pie',
                radius: '55%',
                center: ['50%', '60%'],
                data: series_data,
                itemStyle: {
                    emphasis: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                    }
                }
            }
        ]
    };
    var sold_charts = echarts.init(document.getElementById(id));
    sold_charts.setOption(option);
}