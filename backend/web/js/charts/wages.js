var date = new Date();
var time = date.getFullYear().toString() + (date.getMonth() + 1);

getWagesChartsData();

//获取报表数据
function getWagesChartsData(startTime) {
    // var url = startTime == '' ? '/charts/ajaxtotalwages' : '/charts/ajaxtotalwages?st=' + startTime;
    var url = '/charts/ajaxwagestotal';
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
                        value: item.total_price,
                        name: item.center_info_name
                    };
                    series_data.push(info);
                });
                showCharts(xAxis_data, series_data, 'wages_total','各中心月月工资总数','总工资');
            }

        }
    });
}


