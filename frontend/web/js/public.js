$(function(){
    var num=15;
    for(var i=0;i<num;i++)
    {
        var posL=Math.random()*$('.stars').width()+'px';
        var posT=Math.random()*$('.stars').height()+'px';
        $('.stars').append("<span style=\'"+"left:"+posL+";top:"+posT+"\'></span>");
        dark();
    }
    function dark(){
        $star=$('.stars').find('span');
        $star.animate({'opacity':'0'},200,function(){ light() });

    }
    function light(){

        $star.animate({'opacity':'0.8'},100,function(){ dark() });
    }
});