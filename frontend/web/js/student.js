$(function () {

    //上一页
    $('#pre').click(function () {
        var index = $('.student-main').find('.show').index();
        if (index === 0) {
            alert('当前已是第一页');
            return false;
        }
        $('.student-main').children().eq(index).removeClass('show');
        $('.student-main').children().eq(index).addClass('hide');
        $('.student-main').children().eq(index-1).removeClass('hide');
        $('.student-main').children().eq(index-1).addClass('show');
    });

    //下一页
    $("#next").click(function () {
        var len = $('.student-main').find('.student-content').length;
        var index = $('.student-main').find('.show').index();
        if (index === (len-1)) {
            alert('当前已是最后一页');
            return false;
        }
        $('.student-main').children().eq(index).removeClass('show');
        $('.student-main').children().eq(index).addClass('hide');
        $('.student-main').children().eq(index+1).removeClass('hide');
        $('.student-main').children().eq(index+1).addClass('show');
    })

});