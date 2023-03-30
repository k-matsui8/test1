<?php
define("PHP_DIR", "scphp/");
include_once(PHP_DIR . "form/inc_contact.php");
// メール送信
MailFunc();
?>
<!DOCTYPE html>
<html lang="ja">

<head prefix="og: https://ogp.me/ns# fb: https://ogp.me/ns/fb# article: https://ogp.me/ns/article#">
    <meta charset="UTF-8">

    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-M73PMNK');
    </script>
    <!-- End Google Tag Manager -->

    <title>ビジネスブートキャンプ can-tera</title>
    <meta name="description" content="can-teraでは社会人経験のない方や、やる気はあるのにチャンスがなくて困っている若者を支援し、社会に送り出すために代表の小早川が直接研修を行います。研修後は、正社員雇用を目指して、就職先の紹介、その後のサポートまで一貫して行います。" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=0">
    <script>
        var agent = window.navigator.userAgent.toLowerCase();
        var ipad = agent.indexOf('ipad') > -1 || agent.indexOf('macintosh') > -1 && 'ontouchend' in document;
        if (ipad == true) {
            viewportContent = "width=1300";
            document.querySelector("meta[name='viewport']").setAttribute("content", viewportContent);
        }
    </script>
    <!-- Google Tag Manager -->

    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':

                    new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],

                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =

                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);

        })(window, document, 'script', 'dataLayer', 'GTM-MN64J4Z');
    </script>

    <!-- End Google Tag Manager -->
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <link rel="manifest" href="favicon/site.webmanifest">
    <link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="favicon/favicon.ico">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="favicon/browserconfig.xml">
    <meta name="theme-color" content="#5bbad5">
    <meta property="og:title" content="ビジネスブートキャンプ can-tera" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://www.apms-japan.net/cantera/" />
    <meta property="og:image" content="img/can-tera_screenshot.png" />
    <meta property="og:site_name" content="ビジネスブートキャンプ can-tera" />
    <meta property="og:description" content="can-teraでは社会人経験のない方や、やる気はあるのにチャンスがなくて困っている若者を支援し、社会に送り出すために代表の小早川が直接研修を行います。研修後は、正社員雇用を目指して、就職先の紹介、その後のサポートまで一貫して行います。" />
    <meta property="og:image:secure_url" content="https://www.apms-japan.net/cantera/" />
    <meta name="twitter:card" content="can-teraでは社会人経験のない方や、やる気はあるのにチャンスがなくて困っている若者を支援し、社会に送り出すために代表の小早川が直接研修を行います。研修後は、正社員雇用を目指して、就職先の紹介、その後のサポートまで一貫して行います。" />
    <meta name="twitter:title" content="ビジネスブートキャンプ can-tera" />
    <meta name="twitter:description" content="can-teraでは社会人経験のない方や、やる気はあるのにチャンスがなくて困っている若者を支援し、社会に送り出すために代表の小早川が直接研修を行います。研修後は、正社員雇用を目指して、就職先の紹介、その後のサポートまで一貫して行います。" />
    <meta name="format-detection" content="telephone=no">
    <script type="text/javascript" src="//typesquare.com/3/tsst/script/ja/typesquare.js?-F1vbssfEf0%3D" charset="utf-8"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@500;700&family=Secular+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css?ver=22">
    <link rel="stylesheet" href="css/contact.css?ver=22">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M73PMNK" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <header>
        <nav>
            <div class="logo-header"><img src="img/logo.png" alt="Logo"></div>
            <a href="#contact-form">
                <div class="entry-btn"><img src="img/icon-mail-entry.png" alt=""></div>
            </a>
        </nav>
    </header>
    <main>
        <section class="banner-section" title="banner-section">
            <div class="background-banner">
                <div class="inner003">
                    <h1 class="banner-txt-container">
                        <img src="img/banner-txt.png" alt="社会人未経験からの正社員">
                    </h1>
                </div>
            </div>
        </section>

        <section class="section2" title="section2">
            <div class="section2-background-img">
                <div class="inner003 section2-padding">
                    <div class="title">
                        <div class="title-black-bbl">
                            <img src="img/worry-tl1.png" alt="こんなお悩みございませんか？">
                        </div>
                        <h2 class="english-title"><img src="img/worry-tl2.png" alt="worry"></h2>
                    </div>
                    <div class="avatar-message-container">
                        <div class="moveFlag avatar-left">
                            <div class="avatar-container">
                                <img src="img/s2-avatar-1.png" alt="">
                            </div>
                            <div class="message-bubble">
                                <div>
                                    <img class="white-arw-left" src="img/white-arw.svg" alt="" class="bubble-arrow-left">
                                </div>
                                <div class="quotation-open">
                                    <img src="img/quotation-open.svg" alt="" class="quote-open">
                                </div>
                                <div class="quotation-close">
                                    <img src="img/quotation-close.svg" alt="" class="quote-close">
                                </div>
                                <div class="message-bubble-txt">
                                    <h3 class="bubble-title">フリーター歴が長いせいで、書類審査で落とされる…</h3>
                                    <p>社員として働いた経験がないので、求人に応募しても面接まで全然進めません。そもそも採用してもらえないから経験を積むことができず、時間だけがすぎていくのが怖いです。自分ではどうにもできなくて困っています。</p>
                                </div>
                            </div>
                        </div>
                        <div class="avatar-right moveFlag">
                            <div class="sp_mode avatar-container">
                                <img src="img/message-bubble-avatar.png" alt="">
                            </div>
                            <div class="message-bubble">
                                <div>
                                    <img class="white-arw-right" src="img/white-arw.svg" alt="" class="bubble-arrow-right">
                                </div>
                                <div class="quotation-open">
                                    <img src="img/quotation-open.svg" alt="" class="quote-open">
                                </div>
                                <div class="quotation-close">
                                    <img src="img/quotation-close.svg" alt="" class="quote-close">
                                </div>
                                <div class="message-bubble-txt">
                                    <h3 class="bubble-title">社員経験がないから、周囲の人と同じように<br>
                                        働けるか不安…
                                    </h3>
                                    <p>正社員として働きたいという気持ちはあるのですが、バイトの経験しかなく、面接などでアピールできる材料が何もありません。もし入社できたとしても、この歳でゼロからスタートするのは大変そうで、なかなか一歩を踏み出せません。</p>
                                </div>
                            </div>
                            <div class="pc_mode avatar-container">
                                <img class="pc_mode" src="img/message-bubble-avatar.png" alt="">
                            </div>
                        </div>
                        <div class="moveFlag avatar-left">
                            <div class="avatar-container">
                                <img src="img/s2-avatar-3.png" alt="">
                            </div>
                            <div class="message-bubble">
                                <div>
                                    <img class="white-arw-left" src="img/white-arw.svg" alt="" class="bubble-arrow-left">
                                </div>
                                <div class="quotation-open">
                                    <img src="img/quotation-open.svg" alt="" class="quote-open">
                                </div>
                                <div class="quotation-close">
                                    <img src="img/quotation-close.svg" alt="" class="quote-close">
                                </div>
                                <div class="message-bubble-txt">
                                    <h3 class="bubble-title">就活自体したことがなくて、会社の探し方すら<br>
                                        わからない…</h3>
                                    <p>夢を追いかけて活動を続けていたので、就活をしてきませんでした。どんな企業にどんな仕事があるのか、どんな仕事が自分に向いているのか分かりません。イメージできないので、面接でもぼんやりした回答しかできず落とされてしまいます。</p>
                                </div>
                            </div>
                        </div>
                        <div class="moveFlag avatar-right last-avatar">
                            <div class="sp_mode avatar-container">
                                <img src="img/s2-avatar-4.png" alt="">
                            </div>
                            <div class="message-bubble">
                                <div>
                                    <img class="white-arw-right" src="img/white-arw.svg" alt="" class="bubble-arrow-right">
                                </div>
                                <div class="quotation-open">
                                    <img src="img/quotation-open.svg" alt="" class="quote-open">
                                </div>
                                <div class="quotation-close">
                                    <img src="img/quotation-close.svg" alt="" class="quote-close">
                                </div>
                                <div class="message-bubble-txt">
                                    <h3 class="bubble-title">未経験で採用してくれるのは、ブラック企業が多くて
                                        働くのが辛い…</h3>
                                    <p>就活で失敗して、ブラック企業に入ってしまいました。経験がないまま転職しようとしても、結局、ブラックな会社でしか採用してもらえず、なかなか仕事が長続きしません。最低限の待遇さえあれば頑張り続けたいのですが、ぜいたくな悩みなのでしょう。</p>
                                </div>
                            </div>
                            <div class="pc_mode avatar-container">
                                <img class="pc_mode" src="img/s2-avatar-4.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="background-arrow-btm"></div>
        </section>

        <section class="section3" title="section3">
            <div class="section3-background-img">
                <div class="inner002">
                    <div class="section3-main-contents">
                        <div class="moveFlag section3-img">
                            <img src="img/section3-img.png" alt="">
                        </div>
                        <div class="section3-txt-container">
                            <div class="title s3-title">
                                <div class="title-black-bbl">
                                    <img src="img/message-tl1.png" alt="あなたには無限の可能性がある！">
                                </div>
                                <h2 class="english-title"><img src="img/message-tl2.png" alt="セカンドキャリア総合支援
それが「can-tera」"></h2>
                            </div>
                            <div class="moveFlag section3-img-mobile section3-img">
                                <img src="img/section3-mobile.png" alt="">
                            </div>
                            <div class="section3-txt-1">
                                <div class="bullet-txt">
                                    <img src="img/section3-bullet.svg" alt="">
                                    社長の私も、元フリーターです。「<span class="s3-eng-spc">can-tera</span>（カンテラ）」を<br class="pc_mode">
                                    運営する株式会社アプメス代表 小早川大典と申します。
                                </div>
                                <p>
                                    芸能界に憧れがあり、大学在籍中に事務所に所属。ミュージシャン、役者、お笑い芸人など、次々とチャレンジをしていくなかで、テレビ出演の機会をいただくこともありました。しかし、最前線で活躍されているプロの芸人さんやタレントさんの力を目の当たりにし、挫折。芸能の道を諦めて、2005年12月に知人の紹介で当社、アプメスに入社しました。
                                </p>
                            </div>
                            <div class="section3-txt-2">
                                <div class="bullet-txt">
                                    <img src="img/section3-bullet.svg" alt="">
                                    CAN-寺<span class="s3-eng-spc">（can-tera）</span>とは？
                                </div>
                                <p>
                                    「can-tera」というサービス名は、スペインのサッカー育成組織のカンテラから来ています。スペインのカンテラで、若い選手を育てトップチームへと送り出しているように、
                                    私たちの運営するCAN-寺も未来ある若者を育て、社会に送り出したいと考えています。また、CAN-寺には、「できるようになるための駆け込み寺」の意味も込めました。30歳すぎて、社会人経験のなかった私が就職できたのは、たまたま知人のサポートを受けられたからです。「can-tera」を通じて、やる気はあるのにチャンスがなくて困っている若者を、一人でも多く支援するのが私たちの目標です。ぜひ、勇気を出してエントリーしてください。
                                </p>
                            </div>
                            <div class="message-signature">代表取締役社長<br class="sp_mode"><span>小早川 大典</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section4" title="section4">
            <div class="section4-background-image">
                <div class="inner001">
                    <div class="section4-bubble-title"><img src="img/sect4-tl1.png" alt="私も昔“未経験”でした"></div>
                    <div class="private-container">
                        <div class="moveFlag private-img-container">
                            <div class="private-img"><img src="img/sect4-container-1.png" alt=""></div>
                            <div class="private-tl">コンビ結成当初</div>
                            <p>2000年、当時所属していた劇団の仲間とお笑いコンビを結成
                                土日はライブに出たり、路上ライブを開催したり、平日はネタ合わせや
                                事務所へのネタ見せなどプロの芸人になるべく1歩を踏み出した頃。
                            </p>
                        </div>
                        <div class="moveFlag private-img-container">
                            <div class="private-img"><img src="img/sect4-container-2.png" alt=""></div>
                            <div class="private-tl">所属事務所での営業</div>
                            <p>
                                元吉本の芸人だった人が立ち上げた事務所に所属、結婚式の二次会や学校の文化祭、遊園地でのイベントなど吉本の芸人がメインで行く営業に前座として参加していた頃。
                            </p>
                        </div>
                        <div class="moveFlag private-img-container">
                            <div class="private-img"><img src="img/sect4-container-3.png" alt=""></div>
                            <div class="private-tl">アルバイトで生計を立てる</div>
                            <p>
                                芸人だけでは食べていけないので、派遣会社に登録、空いている日はイベントのディレクターや携帯販売スタッフとして働いていました。この頃の人脈が後のアプメスでの
                                事業に繋がっていった。
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sect4-photo-bkg">
                <div class="inner001">
                    <div class="section4-video container">
                        <div class="section4-bubble-title private-bubble">
                            <img src="img/sect4-tl2.png" alt="1分でわかるカンテラ">
                        </div>
                        <div class="moveFlag video">
                            <iframe class="video-banner" src="https://www.youtube.com/embed/7a1zH1nOMiw" poster="./img/cantera-vid.png" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section5" title="section5">
            <div class="section5-banner-img">
                <div class="inner004 take-the-challenge">
                    <a href="#contact-form" class="moveFlag btn-container">
                        <div class="btn-header"><img src="img/button-header.png" alt=""></div>
                        <div class="yellow-btn">
                            <img src="img/yellow-btn-icon.png" alt=""><span>エントリーはこちら！</span>
                        </div>
                    </a>
                </div>
            </div>
        </section>
        <section class="section6" title="section6">
            <div class="section6-background-image">
                <div class="inner003 section6-padding inner-s6">
                    <div class="title section6-tl">
                        <div class="title-black-bbl">
                            <div class="message-bubble-title">
                                <img src="img/sect6-tl1.png" alt="can-tera　入所３つのメリット">
                            </div>
                        </div>
                        <div class="english-title"><img src="img/sect6-tl2.png" alt="ADVANTAGE"></div>
                    </div>
                    <div class="moveFlag section6-container">
                        <div class="s6-img-container"><img src="img/sect6-1.png" alt=""></div>
                        <div class="s6-txt-container">
                            <img src="img/sect6-1-icon1.png" alt="">
                            <div class="s6-num">01</div>
                            <ul>
                                <li>無料研修（4日間）</li>
                            </ul>
                            <p>2日間のマインド講習（通称：小早川塾）＋2日間のビジネス基礎研修の合計4日間の研修が無償で受けられます。</p>
                            <div class="s6-cover-div1"></div>
                        </div>
                    </div>
                    <div class="moveFlag section6-container">
                        <div class="view-1200 s6-img-container"><img src="img/s6-2.JPG" alt="">
                            <div class="s6-cover-top"></div>
                        </div>
                        <div class="s6-txt-container-left">
                            <img src="img/sect6-1-icon2.png" alt="">
                            <div class="s6-num">02</div>
                            <ul>
                                <li>OJTで6カ月の実務研修</li>
                            </ul>
                            <p>①を追えると、6カ月間のOJT研修。お給料もでますので、まずは社会人としての実務経験を通してスキルをしっかり身に着けてもらいます。メンター制度を導入しているので相談しながら成長できます。
                            </p>
                            <div class="s6-cover-div3 view-1200"></div>
                        </div>
                        <div class="desktop-view s6-img-container"><img class="desktop_view" src="img/s6-2.JPG" alt="">
                            <div class="s6-cover-div3"></div>
                        </div>
                    </div>
                    <div class="moveFlag section6-container">
                        <div class="s6-img-container"><img src="img/s6-3.JPG" alt="">
                            <div class="s6-cover-top"></div>
                        </div>
                        <div class="s6-txt-container">
                            <img src="img/sect6-1-icon3.png" alt="">
                            <div class="s6-num">03</div>
                            <ul>
                                <li>様々な会社で実務経験</li>
                            </ul>
                            <p>当社での研修①②を終えると実際の企業で実務経験を積むことができます。お互いがマッチすれば、派遣先の企業へ就職することも可能です。</p>
                            <div class="s6-cover-div3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section7" title="section7">
            <div class="section7-background-image">
                <div class="inner001 section7-padding">
                    <div class="title section7-tl">
                        <div>
                            <div class="message-bubble-title">
                                <img src="img/voice-tl1.png" alt="当社を通じて正社員になられた卒業生の声">
                            </div>
                        </div>
                        <div class="english-title voice-tl"><img src="img/voice-tl2.png" alt="VOICE"></div>
                    </div>
                    <div class="section7-container">
                        <div class="moveFlag s7-white-box">
                            <div>
                                <img src="img/s7-img1.png" alt="">
                            </div>
                            <div class="s7-white-box-txt">
                                <div>派遣社員経験後、<br>
                                    社員登用。
                                </div>
                                <p>派遣先での仕事をしていく中で、職場をより良いものにしていきたい気持ちが大きくなり、変えるには社員になって行動することが一番の近道だと考え、社員登用を目指しました。社員になって、任されることが増えて、やりがいが増えました。また、顧客へのサービスの質の向上、作業効率向上にはどうするのが良いのか考えることが増え、毎日が刺激的になりました。</p>
                                <div>
                                    コネクシオ株式会社　20代 男性
                                </div>
                            </div>
                            <div class="s7-cover-div-top"></div>
                            <div class="s7-cover-div-bottom"></div>
                        </div>
                        <div class="moveFlag s7-white-box">
                            <div>
                                <img src="img/s7-img2.png" alt="">
                            </div>
                            <div class="s7-white-box-txt">
                                <div>レゲエDJから、<br>
                                    正社員へ。
                                </div>
                                <p>大学卒業後はレゲエのDJとして、ジャマイカやカナダ、アメリカなどへ渡航し修行をしていました。今までは自分のことを好きにしてきた人生でしたが、結婚をきっかけとして、しっかりとした生活基盤を構築したいと感じ正社員を目指しました。今では、収入も安定しマイホームを購入し、私生活も充実しています。</p>
                                <br>
                                <br>
                                <div>
                                    ドコモサポート株式会社　30代 男性
                                </div>
                            </div>
                            <div class="s7-cover-div-top"></div>
                            <div class="s7-cover-div-bottom"></div>
                        </div>
                        <div class="moveFlag s7-white-box">
                            <div>
                                <img src="img/s7-avatar.png" alt="">
                            </div>
                            <div class="s7-white-box-txt">
                                <div>販売スタッフから店舗責任者へ
                                </div>
                                <p>接客の経験を活かしていきたく、携帯販売員として仕事を選び入社しました。
                                    勤務をしていく中で売上管理やスタッフ育成、接客手法を学び、
                                    販売員としてのやりがいを実感することができました。
                                    更なるスキルアップを目指し、代理店への転職を決意しました。
                                    現在は店舗責任者として現場で周りと協力していきながら頑張ってます！
                                </p>
                                <br>
                                <br>
                                <div>
                                    株式会社ティーガイア　30代　男性
                                </div>
                            </div>
                            <div class="s7-cover-div-top"></div>
                            <div class="s7-cover-div-bottom"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section8" title="section8">
            <div class="section5-banner-img">
                <div class="inner004 take-the-challenge">
                    <a href="#contact-form" class="moveFlag btn-container">
                        <div class="btn-header"><img src="img/button-header.png" alt=""></div>
                        <div class="yellow-btn">
                            <img src="img/yellow-btn-icon.png" alt=""><span>エントリーはこちら！</span>
                        </div>
                    </a>
                </div>
            </div>
        </section>
        <section class="section9" title="section9">
            <div class="section9-background-img">
                <div class="inner001 section9-padding">
                    <div class="title section9-tl">
                        <div class="title-black-bbl">
                            <img src="img/achievements-tl1.png" alt="就労先実績">
                        </div>
                        <h2 class="english-title achievements-tl"><img src="img/achievements-tl2.png" alt="ACHIEVEMENTS"></h2>
                    </div>
                    <div class="moveFlag company-logos achievements-images">
                        <div class="s9-achievement-container">
                            <div class="s9-company-logos">コネクシオ株式会社</div>
                            <div class="s9-company-logos">株式会社ティーガイア</div>
                            <div class="s9-company-logos">楽天モバイル株式会社</div>
                            <div class="s9-company-logos">アライ電機産業株式会社</div>
                            <div class="s9-company-logos">サムスン電子ジャパン株式会社</div>
                            <div class="s9-company-logos">イリオスネット株式会社</div>
                            <div class="s9-company-logos">トーンモバイル株式会社</div>
                            <div class="s9-company-logos">株式会社新城</div>
                            <div class="s9-company-logos">エヌビーアイ株式会社</div>
                            <div class="s9-company-logos">ドコモ・サポート株式会社</div>
                            <div class="s9-company-logos">株式会社ベルシステム24</div>
                            <div class="s9-company-logos">キューアンドエー株式会社</div>
                            <div class="s9-company-logos">株式会社NTTアド</div>
                            <div class="s9-company-logos switch-position1"></div>
                            <div class="s9-company-logos switch-position2">（順不同）</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section10" title="section10">
            <div class="section10-background-img">
                <div class="inner003 section10-padding">
                    <div class="title">
                        <div class="title-black-bbl s10-bbl">
                            <div class="message-bubble-title">
                                <img src="img/flow-tl1.png" alt="入所後の流れ">
                            </div>
                        </div>
                        <div class="english-title achievements-tl"><img src="img/flow-tl2.png" alt="FLOW"></div>
                        <div class="third-title">一人前の社会人として自立するために</div>
                    </div>
                    <div class="flow-container">
                        <div class="flow-bar">
                            <div class="step1-bar">
                                01
                            </div>
                            <div class="step2-bar">
                                02
                            </div>
                            <div class="step3-bar">
                                03
                            </div>
                            <div class="step4-bar">
                                04
                            </div>
                            <div class="step5-bar">
                                05
                            </div>
                        </div>
                        <div class="flow-step-container">
                            <div class="moveFlag step" data-step="1">
                                <div class="step-num">STEP<br><span>01</span></div>
                                <p>説明会～入所登録</p>
                                <div class="s10-cover-top"></div>
                                <div class="s10-cover-bottom"></div>
                            </div>
                            <div class="moveFlag step" data-step="2">
                                <div class="step-num">STEP<br><span>02</span></div>
                                <p>マインド研修（小早川塾）2日間</p>
                                <div class="step2-image">
                                    <img src="img/section10-step2.jpg" alt="">
                                </div>
                                <div class="s10-cover-top"></div>
                                <div class="s10-cover-bottom"></div>
                            </div>
                            <div class="moveFlag step" data-step="3">
                                <div class="step-num">STEP<br><span>03</span></div>
                                <p>基礎研修（社会人として）2日間</p>
                                <div class="s10-cover-top"></div>
                                <div class="s10-cover-bottom"></div>
                            </div>
                            <div class="moveFlag step" data-step="4">
                                <div class="step-num">STEP<br><span>04</span></div>
                                <p>OJT（6カ月）</p>
                                <div class="red-bullet-list">
                                    <div><img src="img/square-bullet.svg" alt=""> 月2回程度でビジネス研修<br>
                                        （マインド研修、提案資料作成、営業同行、社内業務体験等）</div><br>
                                    <div><img src="img/square-bullet.svg" alt="">営業としての実技向上とモチベーション維持</div><br>
                                    <div><img src="img/square-bullet.svg" alt="">卒業面談（未来年表の作成）</div>
                                </div>
                                <div class="s10-cover-top"></div>
                                <div class="s10-cover-bottom"></div>
                            </div>
                            <div class="moveFlag step" data-step="5">
                                <div class="step-num">STEP<br><span>05</span></div>
                                <p>卒業後は提携先企業にて正社員として働くことを目標とする
                                </p>
                                <div class="s10-cover-top"></div>
                                <div class="s10-cover-bottom"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section11" title="section11">
            <div class="best-match-background">
                <div class="inner001 section11-padding">
                    <div class="title">
                        <div class="title-black-bbl">
                            <img src="img/bm-tl1.png" alt="can-teraはこんな人にピッタリ">
                        </div>
                        <div class="english-title bm-tl"><img src="img/bm-tl2.png" alt="BEST MATCH"></div>
                    </div>
                    <div class="best-match-container">
                        <div class="moveFlag bm-box bm-mt">
                            <div class="bm-box-image">
                                <img src="img/best-match-img1.png" alt="">
                            </div>
                            <div class="bm-box-txt">
                                <div class="bm-box-red">
                                    夢を追いかけていたけど、<br>
                                    諦めて就職する人
                                </div>
                                <p>
                                    スポーツ選手や芸能、美容師などを志した方で次のステージに挑戦しようとお考えの方
                                </p>
                                <div class="s11-cover-bottom"></div>
                            </div>
                        </div>
                        <div class="moveFlag bm-box">
                            <div class="bm-box-image">
                                <img src="img/best-match-img2.png" alt="">
                            </div>
                            <div class="bm-box-txt">
                                <div class="bm-box-red">
                                    これまで、社員として<br>
                                    働いた経験がない人
                                </div>
                                <p>
                                    フリーターのみ・夜職のみ・ガテン系のみ等、正社員的な働き方が未経の方
                                </p>
                                <div class="s11-cover-bottom"></div>
                            </div>
                        </div>
                        <div class="moveFlag bm-box bm-mt">
                            <div class="bm-box-image">
                                <img src="img/best-match-img3.png" alt="">
                            </div>
                            <div class="bm-box-txt">
                                <div class="bm-box-red">
                                    地方から東京に上京して、<br>
                                    正社員として働きたい人
                                </div>
                                <p>
                                    ホワイトカラー経験があっても大成できなかった地方労働者で東京での労働を希望している方
                                </p>
                                <div class="s11-cover-bottom"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="contact-form" class="section12" title="section12">
            <div class="section12-background-img">
            </div>
        </section>
        <section id="contact" class="section13 contact01" title="section13">
            <div class="gray-bkg">
                <div class="inner002">
                    <div class="moveFlag contact-background">
                        <div class="form-inner section-padding">
                            <div class="title">
                                <div class="title-black-bbl">
                                    <img src="img/section13-tl1.png" alt="まずはお気軽にご相談ください">
                                </div>
                                <div class="english-title achievements-tl">
                                    <img src="img/section13-tl2.png" alt="CONTACT">
                                </div>
                                <div class="phone-txt"><img src="img/section13-tl3.png" alt=""></div>
                                <div class="s13-mail"><img src="img/section13-mail.svg" alt="03-6416-1411"></div>
                                <div class="pc_mode s13-tl4"><img src="img/section13-tl4.png" alt="平日9：00～18：00"></div>
                                <div class="sp_mode s13-tl4"><img src="img/section13-tl4-sp.png" alt="平日9：00～18：00"></div>
                            </div>
                            <div class="form"><?php
                                                // $pos = strpos($_SERVER['SCRIPT_FILENAME'],"?");
                                                // $url = substr($_SERVER['SCRIPT_FILENAME'],0,$pos);
                                                $url = "index.php";

                                                $pos = strpos($_SERVER['SCRIPT_FILENAME'], "?");
                                                if ($pos !== false) {
                                                    $url = mb_substr($_SERVER['SCRIPT_FILENAME'], 0, $pos);
                                                } else {
                                                    $url = $_SERVER['REQUEST_URI'];
                                                }
                                                SetForm('name="form1" id="form1" class="form01" action="' . $url . '#contact" method="post"');


                                                if (RetMode() != PAGE_CHECK) {
                                                ?>

                                <?php } ?>
                                <?php
                                if (RetMode() == PAGE_ERROR) {

                                    print "<p id=\"form_error\" class=\"left_txt\">▼下記のエラーを修正して下さい。<br />";
                                    PrintError();
                                    print '</p>';
                                } else if (RetMode() == PAGE_CHECK) {

                                    print "<p id=\"form_error\" class=\"left_txt\" style='color:black'>";
                                    print "▼入力内容をご確認の上、送信するボタンを押してください<br />";
                                    print '</p>';
                                } else { ?>



                                <?php } ?>

                                <div class="radio-container radio-text">
                                    <label class="heading" for="">種別<img src="img/required.png" alt=""></label>
                                    <?php $lst = 'エントリー,お問い合わせ'; ?>
                                    <?php PrintRadio("type", $lst, ",", 2); ?>
                                </div>
                                <div class="">
                                    <label class="heading" for="">氏名<img src="img/required.png" alt=""></label>
                                    <div class="flex-box">
                                        <?php
                                        PrintInput('name="name1" type="text" class="middle" id="name1" placeholder="例）山田"', "");
                                        PrintInput('name="name2" type="text" class="middle" id="name2" placeholder="例）太郎"', "");
                                        ?>
                                    </div>
                                </div>
                                <div class="">
                                    <label class="heading" for="">フリガナ<img src="img/required.png" alt=""></label>
                                    <div class="flex-box">
                                        <?php
                                        PrintInput('name="name3" type="text" class="middle" id="name3" placeholder="例）ヤマダ"', "");
                                        PrintInput('name="name4" type="text" class="middle" id="name4" placeholder="例）タロウ"', "");
                                        ?>
                                    </div>
                                </div>
                                <div class="radio-container radio-text">
                                    <label class="heading" for="">性別<img src="img/required.png" alt=""></label>
                                    <?php $lst = '男性,女性,その他'; ?>
                                    <?php PrintRadio("gender", $lst, ",", 3); ?>
                                </div>
                                <div class="select">
                                    <label class="heading" for="">年齢<img src="img/required.png" alt=""></label>
                                    <?php
                                    PrintInput('name="age" type="text" class="small addNum"  placeholder="20" id="age"', "");
                                    ?>
                                    <label class="age-text" for="">歳</label>
                                </div>
                                <div class="">
                                    <label class="heading" for="">TEL<img src="img/required.png" alt=""></label>
                                    <?php
                                    PrintInput('name="phone" type="tel" class="middle" id="phone" placeholder="例：03-6416-1411（半角）"', "");
                                    ?>
                                </div>
                                <div class="">
                                    <label class="heading" for="">メール<img src="img/required.png" alt=""></label>
                                    <?php
                                    PrintInput('name="email" type="text" class="max" id="email" placeholder="例）sample@mail.co.jp"', "");
                                    ?>
                                </div>
                                <div class="">
                                    <label class="heading" for="">備考<img src="img/optional.png" alt=""></label>
                                    <?php
                                    PrintTextarea('name="coment" class="" id="coment"', "");
                                    ?>
                                </div>

                                <div class="privacy_box">
                                    <?php
                                    if (RetMode() != PAGE_CHECK) {
                                    ?>

                                        <p class="center">
                                            <?php
                                            // print PrintCheckOne( "privacy", "　, ", ",", 0 );
                                            ?>
                                        </p>
                                    <?php
                                    } else {
                                    ?>
                                        <input type="hidden" name="privacy" value="　
                                    " />
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="form_viewport">

                                    <p class="submit_box">
                                        <?php
                                        if (RetMode() == PAGE_CHECK) {
                                            print '<input id="sendmail_btn" type="button" value="送信する">';
                                            print '<input id="amend_btn" type="button" value="修正する">';
                                        } else {
                                            print '<input id="submit_btn"  type="button" value="入力内容を確認する">';
                                        }

                                        ?>
                                    </p>

                                </div>

                                <?php
                                SetFormEnd();
                                if (RetMode() != PAGE_INIT) {
                                    print PrintErrCss();
                                }
                                ?>
                                <?php
                                if (RetMode() == PAGE_CHECK) {
                                ?>

                                    <style>
                                        .p_input_box {
                                            display: inline;
                                        }
                                    </style>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section14" title="section14">
            <div class="company-background-image">
                <div class="inner003 section-padding">
                    <div class="title">
                        <div class="title-black-bbl s10-bbl">
                            <img src="img/section14-tl1.png" alt="運営会社">
                        </div>
                        <div class="english-title achievements-tl"><img src="img/section14-tl2.png" alt="COMPANY"></div>
                    </div>
                    <div class="moveFlag table-container">
                        <table>
                            <tr>
                                <th class="tb1">運営会社名</th>
                                <td class="tb2">株式会社アプメス</td>
                            </tr>
                            <tr>
                                <th class="tb1">代表者</th>
                                <td class="tb2">小早川　大典</td>
                            </tr>
                            <tr>
                                <th class="tb1">資本金</th>
                                <td class="tb2">30,000,000円 ※2021年3月1日現在</td>
                            </tr>
                            <tr>
                                <th class="tb1">住所</th>
                                <td class="tb2">〒105-0001　東京都港区虎ノ門5-1-5 メトロシティ神谷町6</td>
                            </tr>
                            <tr>
                                <th class="tb1">TEL/FAX</th>
                                <td class="tb2">TEL：03-6416-1411 FAX：03-6809-1161</td>
                            </tr>
                            <tr>
                                <th class="tb1">事業内容</th>
                                <td class="tb2">120名　契約・アルバイトを除く（2021年3月時点）</td>
                            </tr>
                            <tr>
                                <th class="tb1">URL</th>
                                <td class="tb2"><a href="https://www.apms-japan.net/" target="_blank">https://www.apms-japan.net/</a></td>
                            </tr>
                            <tr>
                                <th class="tb1">関連会社</th>
                                <td class="tb2">ヒトトヒトホールディングス株式会社（100%親会社）</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="profile-background">
                <div class="scrolled scroll-up-btn">
                    <a class="scrolled scroll-up-btn" href="#"><img src="img/scroll-up.png" alt="TOP"></a>
                </div>
            </div>
        </section>


    </main>
    <footer>
        <div class="footer-red-container">
            <div><img src="img/footer-apms.png" alt=""></div>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


    <script type="text/javascript">
        $(document).ready(function() {
            <?php
            $pos1 = strrpos($_SERVER['SCRIPT_FILENAME'], "/");
            $pos2 = strrpos($_SERVER['SCRIPT_FILENAME'], ".");
            $contact_mode = substr($_SERVER['SCRIPT_FILENAME'], $pos1 + 1, $pos2 - $pos1 - 1);
            $contact_mode = $contact_mode . "_mode";
            ?>
            $("#submit_btn").click(function() {
                $("#form1").submit();
            });
            $("#reset_btn").click(function() {
                location.href = "<?php print $_SERVER["REQUEST_URI"]; ?>";
            });
            $("#sendmail_btn").click(function() {
                $("#<?php print $contact_mode . '_btn'; ?>").val("sendmail");
                $("#form1").submit();
            });
            $("#amend_btn").click(function() {
                $("#<?php print $contact_mode . '_btn'; ?>").val("amend");
                $("#form1").submit();
            });
        });
    </script>


    <script>
        $(document).ready(function() {

            // function Ajaxzip3onload()
            // {
            //     document.getElementById("zip").onkeyup = function() {
            //         AjaxZip3.zip2addr(this, "", "ken", "address1");
            //     }

            // }

            // if(window.addEventListener) {
            //     window.addEventListener("load", Ajaxzip3onload, false);
            // }
            // else if(window.attachEvent) {
            //     window.attachEvent("onload", Ajaxzip3onload);
            // }


            // if($("input[name='kind']:checked").val()=="その他"){
            //     $("#kind_other").css("display","inline-block");
            // }else{
            //     $("#kind_other").css("display","none");
            // }

            // $("input[name=kind]").click(function(){
            //     if($("input[name='kind']:checked").val()=="その他"){
            //         $("#kind_other").css("display","inline-block");
            //     }else{
            //         $("#kind_other").css("display","none");
            //     }
            // });

        });
    </script>
    <!--     <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/gsap-latest-beta.min.js?r=5426"></script>
    <script type="text/javascript" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/ScrollTrigger.min.js"></script> -->

    <!-- Google Tag Manager (noscript) -->

    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MN64J4Z" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

    <!-- End Google Tag Manager (noscript) -->
    <script type="text/javascript" src="js/index.js"></script>
</body>

</html>