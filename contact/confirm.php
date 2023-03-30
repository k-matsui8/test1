<?php

	//reCAPTCHA v2 start
	// g-recaptcha-responseのデータが送られていなかったら、つまりロボットではありませんにチェックされていなかったら
	// エラーとして扱う
	if( !isset( $_POST['g-recaptcha-response'] ) ){
		$_POST['g-recaptcha-response'] = '' ;
	}

	$secret_key = '6LdgbagZAAAAAGQd4ozHILkjRlKOErvC6TrVT1tk' ;

	// google reCAPTCHAにsecret keyなどを送って、不正なくチェックなどされているかどうかを判断してもらう
	//（https://developers.google.com/recaptcha/docs/verify などを参照）
	$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret_key}&response={$_POST['g-recaptcha-response']}");

	//不正があるかないか、reCAPTCHAが返答してくれる
	$json = json_decode($response,true);

	//認証に成功した場合successにtrueが入力される
	//上記問題がなかった場合はこの中のプログラムを実行
	if($json["success"]==true){

	}
	// reCAPTCHA v2 end

	//reCAPTCHA v3 start
	$recaptcha_response = $_POST['recaptcha_response'];
	$recaptcha_secret = '6LcacqgZAAAAAOjzu9ytlR0woW2zdy7pWyFLveGY';

	$recaptch_url = 'https://www.google.com/recaptcha/api/siteverify?secret=';
	$recaptcha = file_get_contents(
	$recaptch_url.$recaptcha_secret. '&response='.$recaptcha_response
	);
	$recaptcha = json_decode($recaptcha);

	print_r('$recaptcha->score : '.var_export($recaptcha->score,true));
	if ($recaptcha->score >= 0.5) {
	// reCAPTCHA合格
	} else {
	// reCAPTCH不合格。ボットの可能性があるので、送信しない
	}
	// reCAPTCHA v3 end

	// フォームのボタンが押されたら
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// フォームから送信されたデータを各変数に格納
		$contactPlan = htmlspecialchars($_POST["contactPlan"]);
		$name = htmlspecialchars($_POST["氏名"]);
		$furigana = htmlspecialchars($_POST["フリガナ"]);
		$tel = htmlspecialchars($_POST["電話番号"]);
		$email = htmlspecialchars($_POST["メールアドレス"]);
		$email2 = htmlspecialchars($_POST["確認用メールアドレス"]);
		$detail = htmlspecialchars($_POST["お問い合わせ内容"]);
	}
	else{
		//header("Location:/");
		//exit();
	}

	// 送信ボタンが押されたら
	if (isset($_POST["submit"])) {
		// 送信ボタンが押された時に動作する処理をここに記述する

		// 日本語をメールで送る場合のおまじない
    mb_language("ja");
		mb_internal_encoding("UTF-8");

		// 送信元のメールアドレスを変数fromEmailに格納(メールの登録先メールアドレス)
		//$fromEmail = "";
		//$fromEmail = "info-mail@apms-japan.com";

    // 件名を変数subjectに格納
		if ($contactPlan == "採用に関して") {
			$subject = "［自動送信］採用に関してのお問い合わせ内容の確認";
			$fromName = "会社HPのWEBフォーム[採用に関して]";
			$fromEmail = "info-mail@hitotohito.co.jp";
			//$fromEmail = "info-mail@apms-japan.com";
		}else if ($contactPlan == "事業に関して") {
			$subject = "［自動送信］事業に関してのお問い合わせ内容の確認";
			$fromName = "会社HPのWEBフォーム[事業に関して]";
			$fromEmail = "info-mail@hitotohito.co.jp";
			//$fromEmail = "info-mail@apms-japan.com";
		}
		else{
			$subject = "［自動送信］お問い合わせ内容の確認";
			$fromName = "会社HPのWEBフォーム[お問い合わせ]";
			$fromEmail = "info-mail@hitotohito.co.jp";
			//$fromEmail = "info-mail@apms-japan.com";
		}

// メール本文を変数bodyに格納
$body = <<< EOM
{$name}　様

採用に関してのお問い合わせありがとうございます。
以下のお問い合わせ内容を、メールにて確認させていただきました。

＝■お問い合わせ内容■＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝

【 お問い合わせ種類 】
 {$contactPlan}

 【 氏名 】
 {$name}

【 フリガナ 】
{$furigana}

【 メールアドレス 】
 {$email}
【 電話番号 】
{$tel}

【 お問い合わせ内容 】
{$detail}

===================================================

業務の都合上、ご連絡するまでにお時間がかかる場合がございます。
もし数日中に返事が無い場合は、その際にはお手数ですが下記までご連絡ください。

---------------------------------------------------
株式会社　アプメス
東京都渋谷区神宮前2-21-9
TEL：03-6416-1411　FAX：03-6809-1161
URL：https://www.apms-japan.net/

EOM;

$body1 = <<< EOM
{$name}　様

お問い合わせありがとうございます。
以下のお問い合わせ内容を、メールにて確認させていただきました。

＝■お問い合わせ内容■＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝

【 お問い合わせ種類 】
 {$contactPlan}

 【 氏名 】
 {$name}

【 フリガナ 】
{$furigana}

【 メールアドレス 】
 {$email}
【 電話番号 】
{$tel}

【 お問い合わせ内容 】
{$detail}

===================================================

業務の都合上、ご連絡するまでにお時間がかかる場合がございます。
もし数日中に返事が無い場合は、その際にはお手数ですが下記までご連絡ください。

---------------------------------------------------
株式会社　アプメス
東京都渋谷区神宮前2-21-9
TEL：03-6416-1411　FAX：03-6809-1161
URL：https://www.apms-japan.net/

EOM;

// 設置者に送られるメール内容
$body2 = <<< EOM

会社HPのWEBフォームより、以下の問い合わせがありました。

＝■お問い合わせ内容■＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝

【 お問い合わせ種類 】
 {$contactPlan}

 【 氏名 】
 {$name}

【 フリガナ 】
{$furigana}

【 メールアドレス 】
 {$email}
【 電話番号 】
{$tel}

【 お問い合わせ内容 】
{$detail}

===================================================

内容を確認のうえ、ご連絡お願い致します。

---------------------------------------------------
株式会社　アプメス
東京都渋谷区神宮前2-21-9
TEL：03-6416-1411　FAX：03-6809-1161
URL：https://www.apms-japan.net/

EOM;

		// ヘッダ情報を変数headerに格納する
		$header = "From: " .mb_encode_mimeheader($fromName) ."<{$fromEmail}>";

		if ($contactPlan == "採用に関して") {
			mb_send_mail($email, $subject, $body, $header);
			mb_send_mail($fromEmail, $fromName, $body2, $header);
		}else if ($contactPlan == "事業に関して") {
			mb_send_mail($email, $subject, $body1, $header);
			mb_send_mail($fromEmail, $fromName, $body2, $header);
		}else{
			mb_send_mail($email, $subject, $body1, $header);
			mb_send_mail($fromEmail, $fromName, $body2, $header);
		}


		// メール送信を行う


 		// サンクスページに画面遷移させる
		header("Location:/contact/thanks.php");
		exit;
	}
?>
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
					Confirmation
				</strong>
				<span>
					お問い合わせ｜確認画面
				</span>
			</h2>
		</div>
	</section>

	<section class="box">

<div class="page contact-top">
	<div class="wrap">
		<div id="confirmation" class="common">

   <form action="confirm.php" method="post">
            <input type="hidden" name="contactPlan" value="<?php echo $contactPlan; ?>">
            <input type="hidden" name="氏名" value="<?php echo $name; ?>">
            <input type="hidden" name="フリガナ" value="<?php echo $furigana; ?>">
            <input type="hidden" name="電話番号" value="<?php echo $tel; ?>">
            <input type="hidden" name="メールアドレス" value="<?php echo $email; ?>">
            <input type="hidden" name="確認用メールアドレス" value="<?php echo $email2; ?>">
            <input type="hidden" name="お問い合わせ内容" value="<?php echo $detail; ?>">
        <table>
        	<tr>
            	<th><span class="must">必須</span>お問い合わせ種類</th>
            	<td>
                <?php echo $contactPlan; ?>
                </td>
            </tr>
        	<tr>
            	<th><span class="must">必須</span>氏名</th>
            	<td><?php echo $name; ?></td>
            </tr>
        	<tr>
            	<th><span class="must">必須</span>フリガナ</th>
            	<td><?php echo $furigana; ?></td>
            </tr>
        	<tr>
            	<th>電話番号</th>
            	<td><?php echo $tel; ?></td>
            </tr>
        	<tr>
            	<th><span class="must">必須</span>メールアドレス</th>
            	<td><?php echo $email; ?></td>
            </tr>
        	<tr>
            	<th><span class="must">必須</span>お問い合わせ内容</th>
            	<td><?php echo $detail; ?></td>
            </tr>
        </table>
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

		<div class="captcha-check">
			<div class="g-recaptcha" data-sitekey="6LdgbagZAAAAALckDwZDRQEZP58GVp0F8OkNsW7t" data-callback="validateRecaptcha" ></div>
		</div>

		<ul>
			<li><input type="submit" name="submit" value="送信する" class="recaptcha btn-attention-block-large" disabled />
			<input type="button" value="内容を修正する" onclick="history.back(-1)"></li>
		</ul>
    </form>

    </div>
</div>
</div></section>


<!-- [ include header/ ] -->
<?php include(dirname(__FILE__).'/../inc/footer.php'); ?>
<!-- [ /include header ] -->

<!-- [ /contents ] -->
</div>

<!-- JS -->
<script src="https://www.google.com/recaptcha/api.js?render=6LcacqgZAAAAALGxVSjZyhKE64kYbGBe0xeQeytx"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
function validateRecaptcha ( code ) {
	if ( !!code ) {
		var form = document.querySelector(".recaptcha");
		form.removeAttribute('disabled');
	}
}
</script>
<script src="/base/js/common.js"></script>

</body>
</html>
