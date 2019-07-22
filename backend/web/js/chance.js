$(function () {
    $('#search').click(function () {
        var chooseDate = $('#date').val();
        if (chooseDate === '') {
            return false;
        }
        window.location.href = '/xyft/chance?date=' + chooseDate;
    });

    $('#indexSearch').click(function () {
        var chooseDate = $('#date').val();
        if (chooseDate === '') {
            return false;
        }
        window.location.href = '/xyft?date=' + chooseDate;
    });
});
