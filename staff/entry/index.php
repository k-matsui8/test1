<?php
	// フォームのボタンが押されたら
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// フォームから送信されたデータを各変数に格納
		$name = htmlspecialchars($_POST["氏名"]);
		$furigana = htmlspecialchars($_POST["フリガナ"]);
		$tel = htmlspecialchars($_POST["電話番号"]);
		$year = htmlspecialchars($_POST["年"]);
		$month = htmlspecialchars($_POST["月"]);
		$day = htmlspecialchars($_POST["日"]);
		$email = htmlspecialchars($_POST["メールアドレス"]);
		$email2 = htmlspecialchars($_POST["確認用メールアドレス"]);
		$detail = htmlspecialchars($_POST["お問い合わせ内容"]);
		$staffinfo = htmlspecialchars($_POST["staffinfo"]);

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
		$fromEmail = "info@gramglan.com";
		$subject = "［自動送信］スタッフエントリーの確認";


    // メール本文を変数bodyに格納
		$body = <<< EOM
{$name}　様

スタッフ募集に関してのご応募ありがとうございます。
以下の内容を、メールにて確認させていただきました。

===================================================
【 スタッフ募集内容 】 {$staffinfo}
【 お問い合わせ内容 】
{$detail}
---------------------------------------------------
【 氏名 】 {$name}
【 フリガナ 】 {$furigana}
【 メールアドレス 】 {$email}
【 電話番号 】 {$tel}
【 生年月日 】 {$year} / {$month} / {$day}
===================================================

内容を確認のうえ、ご連絡させて頂きます。

---------------------------------------------------
株式会社　アプメス
東京都渋谷区円山町5-5　渋谷橋本ビル4F
TEL：03-6416-1411　FAX：03-3770-2344
URL：http://www.apms-japan.net/

EOM;

// 設置者に送られるメール内容
$body2 = <<< EOM
以下のご応募がありました。
===================================================
【 スタッフ募集内容 】 {$staffinfo}
【 お問い合わせ内容 】
{$detail}
---------------------------------------------------
【 氏名 】 {$name}
【 フリガナ 】 {$furigana}
【 メールアドレス 】 {$email}
【 電話番号 】 {$tel}
【 生年月日 】 {$year} / {$month} / {$day}
===================================================

EOM;



		// ヘッダ情報を変数headerに格納する
		$header = "From: " .mb_encode_mimeheader($fromName) ."<{$fromEmail}>";


		// メール送信を行う
		mb_send_mail($email, $subject, $body, $header);
		mb_send_mail($fromEmail, $fromName, $body2, $header);

 		// サンクスページに画面遷移させる
		header("Location:/staff/complete/");
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
<?php include(dirname(__FILE__).'/../../inc/header.php'); ?>
<!-- [ /include header ] -->

	<section id="p-title" class="company">
		<div class="wrap">
			<h2 class="page-title">
				<strong>
					Confirmation
				</strong>
				<span>
					スタッフご応募｜確認画面
				</span>
			</h2>
		</div>
	</section>

	<section class="box">

<div class="page contact-top">
	<div class="wrap">
		<div id="confirmation" class="common">

   <form action="index.php" method="post">
            <input type="hidden" name="staffinfo" value="<?php echo $staffinfo; ?>">
            <input type="hidden" name="氏名" value="<?php echo $name; ?>">
            <input type="hidden" name="フリガナ" value="<?php echo $furigana; ?>">
            <input type="hidden" name="電話番号" value="<?php echo $tel; ?>">
            <input type="hidden" name="メールアドレス" value="<?php echo $email; ?>">
            <input type="hidden" name="確認用メールアドレス" value="<?php echo $email2; ?>">
            <input type="hidden" name="お問い合わせ内容" value="<?php echo $detail; ?>">
						<input type="hidden" name="年" value="<?php echo $year; ?>">
						<input type="hidden" name="月" value="<?php echo $month; ?>">
						<input type="hidden" name="日" value="<?php echo $day; ?>">
        <table>
        	<tr>
            	<th><span class="must">必須</span>スタッフ募集内容</th>
            	<td>
                <?php echo $staffinfo; ?>
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
	           	<th>生年月日</th>
	           	<td><?php echo $year; ?>/<?php echo $month; ?>/<?php echo $day; ?></td>
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

    <ul>
    	<li><input type="submit" name="submit" value="送信する"></li>
    </ul>
    </form>

    </div>
</div>
</div></section>


<!-- [ include header/ ] -->
<?php include(dirname(__FILE__).'/../../inc/footer.php'); ?>
<!-- [ /include header ] -->

<!-- [ /contents ] -->
</div>

<!-- JS -->


<script src="/base/js/common.js"></script>

</body>
</html>
