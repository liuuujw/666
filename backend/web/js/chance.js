$(function(){
    $('#search').click(function(){
        var chooseDate = $('#date').val();
        window.location.href = '/xyft/chance?date='+chooseDate;
    });
});