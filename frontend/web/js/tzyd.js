$(function(){
    $("#page li").click(function(){
        var index = $(this).children('a').html();
        console.log(index);
        $('.article').children('.article-block').addClass('hide');
        $('.article').children('.article-block').removeClass('show');
        $('.article').children('.article-block').eq(index-1).addClass('show');
    })
});