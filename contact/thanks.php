<!doctype html>
<html lang="ja">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#"  itemscope itemtype="http://schema.org/WebPage">

<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<meta name="format-detection" content="telephone=no">

<!-- [ itemprop ] -->
<meta itemprop="name" content="株式会社アプメス">
<meta itemprop="url" content="">
<meta itemprop="about" content="人材派遣、セールスプロモーション、イベント運営はアプメスにお任せください。iPadを使ったアンケート回収型抽選機も大好評。イベント丸ごと一括でお手伝いいたします。">

<!-- [ META ] -->
<meta name="author" content="株式会社アプメス">
<meta name="keywords" content="派遣,人材派遣,セールスプロモーション,イベント,抽選機,iPad抽選機">
<meta name="description" content="人材派遣、セールスプロモーション、イベント運営はアプメスにお任せください。iPadを使ったアンケート回収型抽選機も大好評。イベント丸ごと一括でお手伝いいたします。">
<meta name="rating" content="general" />
<meta name="coverage" content="japan" />
<link rel="canonical" href="">

<!-- [ OG ] -->
<meta property="og:type" content="website"/>
<meta property="og:title" content="株式会社アプメス"/>
<meta property="og:description" content="人材派遣、セールスプロモーション、イベント運営はアプメスにお任せください。iPadを使ったアンケート回収型抽選機も大好評。イベント丸ごと一括でお手伝いいたします。" />
<meta property="og:image" content="http://www.apms-japan.net/ogp.png" />
<meta property="og:url" content="http://www.apms-japan.net/" />
<meta property="og:site_name" content="株式会社アプメス"/>

<title>株式会社アプメス</title>

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/css/swiper.min.css">
<link rel="stylesheet" type="text/css" href="/base/css/style.css">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/css/swiper.min.css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

</head>

<body>
<div id="Loader"></div>
<div id="contents">
<!-- [ contents/ ] -->

<!-- [ include header/ ] -->
<?php include(dirname(__FILE__).'/../inc/header.php'); ?>
<!-- [ /include header ] -->

	<section id="p-title" class="contact">
		<div class="wrap">
			<h2 class="page-title">
				<strong>
					Complete
				</strong>
				<span>
					お問い合わせ 完了
				</span>
			</h2>
		</div>
	</section>

<section class="box">

<div class="contact-comp">
	<h2 class="center">お問い合わせありがとうございました。</h2>
	<p>ご登録いただきましたメールアドレスに、自動送信で確認のメールをお送りいたしました。<br>
メールが届かない場合は、お問い合せフォームよりご連絡ください。<br>
※迷惑メールへ振り分けられてしまう場合がございますのでご確認ください。</p>
  <p class="center"><a href="/" class="totop"><span>TOPへ戻る</span></a></p>
</div>
<input type="hidden" name="recaptcha_response" id="recaptchaResponse">
<script>
	grecaptcha.ready(function () {
		grecaptcha.execute('6LcacqgZAAAAALGxVSjZyhKE64kYbGBe0xeQeytx', { action: 'confirm.php' })
		.then(function (token) {
		var recaptchaResp = document.getElementById('recaptchaResponse');
		recaptchaResp.value = token;
		});
	});
</script>
</section>

<!-- [ include header/ ] -->
<?php include(dirname(__FILE__).'/../inc/footer.php'); ?>
<!-- [ /include header ] -->

<!-- [ /contents ] -->
</div>

<!-- JS -->
<script src="https://www.google.com/recaptcha/api.js?render=6LcacqgZAAAAALGxVSjZyhKE64kYbGBe0xeQeytx"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="/base/js/common.js"></script>

</body>
</html>
