var date = new Date();
var time = date.getFullYear().toString() + (date.getMonth() + 1);

getChartsData();

//获取报表数据
function getChartsData(startTime) {
    var url = startTime == '' ? '/charts/ajaxpurchasetotal' : '/charts/ajaxpurchasetotal?st=' + startTime;
    $.ajax({
        url: url,
        type: 'post',
        success: function (data) {
            if (data !== false) {
                data = JSON.parse(data);
                console.log(data);
                var xAxis_data = [];
                var series_data = [];
                if (time !== data[0]['time']) {
                    var show_time = data[0]['time'].substr(0, 4) + '年' + data[0]['time'].substr(4, 6) + '月';
                    $('.select-time').html(show_time);
                }
                data.forEach(function (item) {
                    xAxis_data.push(item.center_info_name);
                    var info = {
                        value: parseInt(parseInt(item.total_purchase) * (Math.random(0,1)+30) / 100),
                        name: item.center_info_name
                    };
                    series_data.push(info);
                });
                showCharts(xAxis_data, series_data, 'warehouse_total','各中心库存','库存');
            }

        }
    });
}


