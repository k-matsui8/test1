'use strict';

(function ($) {

  //gnavの高さ分メインコンテンツにpadding-topをつける
  $(window).on('load resize', function () {
    var windowWidth = $(window).width();
    var windowSm = 768;
    var gNavHeight = 0;
    var gNavHeight = $('#gNav .site-header').innerHeight();
    $('.main').css({ 'padding-top': gNavHeight });
  });

  //sp gnavi
  $(function () {
    $('.js-spNav-trigger').on('click', function () {
      $(this).closest('#gNav').toggleClass('is-open');
    })

    //gNav メニューでページないの要素に遷移
    var $gNaivBtnSp = $('.sp-gNav__list_item > a');
    var pathname = location.pathname;



    $gNaivBtnSp.on('click', function (e) {
      //LPページ以外は処理をしない
      if (!(pathname === '/jokin/' || pathname === '/jokin/index.html')) return;
      // aタグの遷移を無効化
      e.preventDefault();
      // ボタンのhrefからIDの取得
      var id = $(this).attr('href');
      var $target = $(id);
      // 遷移先の要素の位置を取得
      var top = $target.offset().top;
      //gNav閉じる
      $('.js-spNav-trigger').closest('#gNav').removeClass('is-open');
      //アンカーに遷移
      $('html,body').animate(
        { scrollTop: top },
        {
          duration: 0,
          easing: 'swing'
        }
      );
    });
  });

})(jQuery);
