jQuery(function(){
  var h = jQuery(window).height(); //ブラウザウィンドウの高さを取得
  jQuery('#main-contents').css('display','none'); //初期状態ではメインコンテンツを非表示
  jQuery('#loader-bg ,#loader').height(h).css('display','block'); //ウィンドウの高さに合わせでローディング画面を表示
  });

  jQuery(window).load(function () {
  jQuery('#loader-bg').delay(900).fadeOut(1500); //jQuery('#loader-bg')delay(900).fadeOut(800);でも可
  jQuery('#loader').delay(600).fadeOut(1500); //jQuery('#loader').delay(600).fadeOut(300);でも可
  jQuery('#main-contents').css('display', 'block'); // ページ読み込みが終わったらメインコンテンツを表示する


//topslider
  jQuery('.slider01').infiniteslide({
      speed: 25,
      responsive: true
  });
  jQuery('.slider02').infiniteslide({
      speed: 15,
      responsive: true
  });
  jQuery('.slider03').infiniteslide({
      speed: 48,
      responsive: true
  });
  jQuery('.slider04').infiniteslide({
      speed: 40,
      responsive: true
  });

  jQuery('a[href^="#"]').click(function(){
    var speed = 500;
    var href= jQuery(this).attr("href");
    var target = jQuery(href == "#" || href == "" ? 'html' : href);
    var position = target.offset().top;
    jQuery("html, body").animate({scrollTop:position}, speed, "swing");
    return false;
      });


      if(navigator.userAgent.match(/(iPhone|iPad|iPod|Android)/)){
        jQuery('#btn').click(function(e) {
          jQuery('#btn').addClass("active");
          jQuery('#style1').addClass("active");
          jQuery('#btn2').removeClass("active");
          jQuery('#style2').removeClass("active");
          jQuery('#btn3').removeClass("active");
          jQuery('#style3').removeClass("active");
        });

        jQuery('#btn2').click(function(e) {
          jQuery('#btn').removeClass("active");
          jQuery('#style1').removeClass("active");
          jQuery('#btn2').addClass("active");
          jQuery('#style2').addClass("active");
          jQuery('#btn3').removeClass("active");
          jQuery('#style3').removeClass("active");
        });

        jQuery('#btn3').click(function(e) {
          jQuery('#btn').removeClass("active");
          jQuery('#style1').removeClass("active");
          jQuery('#btn2').removeClass("active");
          jQuery('#style2').removeClass("active");
          jQuery('#btn3').addClass("active");
          jQuery('#style3').addClass("active");
        });


        //　Interviewの部分
        jQuery(function() {
          jQuery('#style0').toggle();
          jQuery('.toggle0').click(function(){
          jQuery('#style0').slideToggle('javax');
          });
          });

          jQuery('.toggle0').on('click', function () {
            if (jQuery(this).text() === '全てのインタビューを見る') {
                jQuery(this).text('一部表示にする');
            } else {
                jQuery(this).text('全てのインタビューを見る');
            }
        });
        }
        //　------------------------------------------------------スマホここまで


    //モーダル
  jQuery('.modal-open').each(function(){
    jQuery(this).click(function(){
      var scrollPosition;
      scrollPosition = jQuery(window).scrollTop();
      jQuery('body').addClass('fixed_people').css({'top': -scrollPosition});
      var target = jQuery(this).data('target');
      var modal = document.getElementById(target);
      jQuery(modal).fadeIn();
      jQuery('.modal-btn-close').click(function(){
        jQuery('body').removeClass('fixed_people').css({'top': 0});
        window.scrollTo( 0 , scrollPosition );
        jQuery(modal).fadeOut();
      });
      jQuery('.close').click(function () {
        jQuery('body').removeClass('fixed_people').css({'top': 0});
        window.scrollTo( 0 , scrollPosition );
        jQuery(modal).fadeOut();
      });
      jQuery('.overlay').click(function(){
        jQuery('body').removeClass('fixed_people').css({'top': 0});
        window.scrollTo( 0 , scrollPosition );
        jQuery(modal).fadeOut();
      });
      jQuery('.menu-trigger').click(function(){
        jQuery('body').removeClass('fixed_people').css({'top': 0});
        window.scrollTo( 0 , scrollPosition );
        // jQuery(modal).fadeOut();
      });
    });
  });
});
