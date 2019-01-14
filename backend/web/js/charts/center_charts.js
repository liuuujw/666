
$.ajax({
    url: '/charts/centerannualprofit',
    type: 'POST',
    success: function (data) {
        if(data !== false){
            var xAxis_data = [];
            var series_data = [];
            data = JSON.parse(data);
            data.forEach(function (val) {
                xAxis_data.push(val.name);
                var item = {
                    value: val.lirun,
                    name: val.name,
                };
                series_data.push(item);
            });

            var myChart = echarts.init(document.getElementById('zonglirun'));
            var option = {
                title: {
                    text: '各中心总利润',
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
                        name: '访问来源',
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
            // 使用刚指定的配置项和数据显示图表。
            myChart.setOption(option);
        }
    }
});

$.ajax({
    url: '/charts/totalwages',
    type: 'POST',
    success: function(data){
        if(data !== false){
            data = JSON.parse(data);
            var xAxis_data = [];
            var series_data = [];
            data.forEach(function(item,i){
                xAxis_data.push(item.center_info_name);
                series_data.push(item.total_wages)
            });
            var option = {
                color: ['#3398DB'],
                title: {
                    text: '各中心工资发放总数',
                    x: 'center'
                },
                tooltip : {
                    trigger: 'axis',
                    axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                        type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
                    }
                },
                xAxis: {
                    type: 'category',
                    data: xAxis_data
                },
                yAxis: {
                    type: 'value'
                },
                series: [{
                    data: series_data,
                    type: 'bar',
                    barWidth: 30,
                }]
            };
            var wages_charts = echarts.init(document.getElementById('total_wages'));
            wages_charts.setOption(option)
        }
    }
});

$.ajax({
    url: '/charts/soldtotal',
    type: 'POST',
    success: function (data) {
        if (data !== false) {
            data = JSON.parse(data);
            var xAxis_data = [];
            var series_data = [];
            data.forEach(function (item, i) {
                xAxis_data.push(item.center_info_name);
                var info = {
                    value:item.sold_total,
                    name: item.center_info_name
                };
                series_data.push(info);
            });
            var option = {
                title: {
                    text: '各中心总销量',
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
                        name: '访问来源',
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
            var sold_charts =echarts.init(document.getElementById('sold_total'));
            sold_charts.setOption(option);
        }
    }
});




