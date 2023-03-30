// SMOOTH SCROLL

$("a[href^='#']").click(function () {
    var speed = 300;
    var href = $(this).attr("href");
    var target = $(href == "#" || href == "" ? "html" : href);
    var position = target.offset().top;
    $("body,html").animate({ scrollTop: position }, speed, "swing");
    return false;
});

/* animate objects on scroll */

var flag = 1;
$(window).on("load scroll resize", function () {
    var scroll = $(window).scrollTop();
    if(scroll > 550){
        $('nav').addClass('scrolled');
        $('.scroll-up-btn').addClass('scroll-up-btn-display');
    }else{
        $('nav').removeClass('scrolled');
        $('.scroll-up-btn').removeClass('scroll-up-btn-display');
    }
    var windowHeight = $(window).height();
    $(".moveFlag").each(function () {
        var imgPos = $(this).offset().top;
        var imgStep = $(this).data("step");
        if (scroll > imgPos - windowHeight + windowHeight / 3) {
            $(this).addClass("on");
        } else if (scroll < imgPos - windowHeight + windowHeight / 3) {
            //$(this).removeClass("on");
        }
    });
});

var flag = 1;
$(window).on("load scroll resize", function () {
    var scroll = $(window).scrollTop();
    //  var windowHeight = $(window).height();
    $(".moveFlag.step").each(function () {
        var imgPos = $(this).offset().top;
        var imgStep = $(this).data("step");
        if (scroll > imgPos) {
            $(this).addClass("animate-on");
            // console.log(imgStep);
            $('.step'+imgStep+'-bar').addClass('animate-on');
        }
    });
});
