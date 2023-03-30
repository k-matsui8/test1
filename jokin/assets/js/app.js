//* ****************************************************************************************************************
// accordion
//* ****************************************************************************************************************
$(function () {
    $('.js-accordion-body').hide();
    $('.js-accordion-header').click(function (e) {
        e.preventDefault();
        var $target = $(this).closest('.js-accordion');
        var $targetBody = $target.find('.js-accordion-body');

        if ($target.hasClass('is-accordion-active'))
        {
            $target.removeClass('is-accordion-active');
            $targetBody.slideUp();
        } else
        {
            $target.addClass('is-accordion-active');
            $targetBody.slideDown();
        }
    });
    $('a.place_coating_ex_close').click(function () {
        //クリックされたa.close_btnの親要素の.accordion_oneの.accordion_innerを閉じる。
        $(this).parents('.js-accordion .js-accordion-body').slideUp();
        $('.js-accordion').removeClass("is-accordion-active");
    });
});
// ページ内リンク
$(function () {
    // 閉じるボタンをクリックした場合に処理
    $('a.place_coating_ex_close').click(function () {
        // 移動先を0px上にずらす
        var adjust = 0;
        // スクロールの速度
        var speed = 500; // ミリ秒
        // アンカーの値取得
        var href = $(this).attr("href");
        // 移動先を取得
        var target = $(href == "#" || href == "" ? 'html' : href);
        // 移動先を調整
        var position = target.offset().top - adjust;
        // スムーススクロール
        $('body,html').animate({ scrollTop: position }, speed, 'swing');
        return false;
    });
});