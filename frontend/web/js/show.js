$(function () {
    var ppt_count = $('.ppt-content').find('.ppt-content-block').length;
    $('.nav-stacked li').click(function () {
        var id = ($(this).attr('data-value'));
        $(this).siblings().removeClass('active');
        $(this).addClass('active');
        $('#' + id).siblings().hide();
        $('#' + id).show();
    });


    //上一页
    $('.previous').click(function () {
        var num = $('.ppt-content').find('.show').index();
        if (num == 0) {
            alert('当前是第一页');
            return false;
        }
        $(".ppt-content-block").eq(num).removeClass('show');
        $(".ppt-content-block").eq(num).addClass('hide');
        $(".ppt-content-block").eq(num - 1).addClass('show');
    });
    //下一页
    $(".next").click(function () {
        var num = $('.ppt-content').find('.show').index();
        if(num == (ppt_count-1)){
            alert("当前是最后一页");
            return false;
        }
        $(".ppt-content-block").eq(num).removeClass('show');
        $(".ppt-content-block").eq(num).addClass('hide');
        $(".ppt-content-block").eq(num + 1).addClass('show');
    });

});
