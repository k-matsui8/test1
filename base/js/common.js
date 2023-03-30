$(function() {

    //スクロールしてトップ
    var topBtn = $('#page-top');
    topBtn.click(function() {
        $('body,html').animate({
            scrollTop: 0
        }, 500);
        return false;
    });

    //SP　MENU
    var state = false;
    var scrollpos;

    $('.menu-trigger').on('click', function() {
        $(this).toggleClass('active');
        if (state == false) {
            scrollpos = $(window).scrollTop();
            $('body').addClass('fixed').css({
                'top': -scrollpos
            });
            $('#menu').addClass('open');
            state = true;
        } else {
            $('body').removeClass('fixed').css({
                'top': 0
            });
            window.scrollTo(0, scrollpos);
            $('#menu').removeClass('open');
            state = false;
        }
    });


});

$(function () {
	$(window).scroll(function () {
		if ($(this).scrollTop() > 90) { //100px以上スクロールした固定
		$('#nav').addClass('fixed');
		} else {
		$('#nav').removeClass('fixed');
		}
	});
});
