$(function () {
    $('.nav-stacked li').click(function () {
        var id = ($(this).attr('data-value'));
        $(this).siblings().removeClass('active');
        $(this).addClass('active');
        $('#'+id).siblings().hide();
        $('#'+id).show();
    });
});