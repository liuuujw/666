$(function () {

    $('#indexSearch').click(function () {
        var chooseDate = $('#date').val();
        if (chooseDate === '') {
            return false;
        }
        var path;
        $('.rank-btn-div a').each(function(){
            if($(this).hasClass('btn-danger')){
                path = $(this).attr('data-value');
            }
        });
        window.location.href = path + '&date=' + chooseDate;
    });

    $('#today').click(function(){
        var path;
        $('.rank-btn-div a').each(function(){
            if($(this).hasClass('btn-danger')){
                path = $(this).attr('data-value');
            }
        });
        window.location.href = path;
    });

    $('.rank-btn-div a').click(function(){
        var date = $('#date').val();
        var path = $(this).attr('data-value');
        if(date !== ''){
            path += '&date='+date;
        }
        window.location.href = path;
    });

    $('.stages-show-div i').click(function(){
        if($(this).hasClass('glyphicon-chevron-down')){
            //显示内容
            $(this).next().removeClass('hide');
            $(this).next().addClass('show');
            $(this).removeClass('glyphicon-chevron-down');
            $(this).addClass('glyphicon-chevron-up');
        }else{
            //影藏内容
            $(this).next().removeClass('show');
            $(this).next().addClass('hide');
            $(this).removeClass('glyphicon-chevron-up');
            $(this).addClass('glyphicon-chevron-down');
        }

    });

    var interval = setInterval(function(){
        window.location.reload();
    },60000)
});
