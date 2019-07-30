$( document ).ready(function() {
    if($(window).width()>=1280 && $(window).height()>=720)
    {
        $(".gigaForm").css("transform","scale(1.35)");
    }
    else {
        $(".gigaForm").css("transform","scale(1)");
    }
});
$(window).resize(function() {
    if ( $(window).width() >= 480 && $(window).height()>=480 ) {
        var a = 1 + 2/9*$(window).height()/1980+2/9*$(window).width()/1080;
        $(".gigaForm").css("transform","scale("+a.toFixed(1)+")");
    }
    else if ( $(window).width() <= 320 && $(window).height()<=480 ) {
        var a = 1 - 2/9*$(window).height()/1980-2/9*$(window).width()/1080;
        $(".gigaForm").css("transform","scale("+a.toFixed(1)+")");
    }
    else {
        $(".gigaForm").css("transform","scale(1)");
    }
});