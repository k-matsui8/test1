<?php
global $set_items;
error_reporting(0);

//define( PHP_DIR,$_SERVER['PHPRC'] );
// define( PHP_DIR, "" );
include("INC/mail_lib.php");

// ログ名称
define( LOG_NAME01, "dsgj1r");
define( LOG_NAME02, "fkja2g");
define( LOG_NAME03, "hkf3hg");



//								項目,			name="",	入力チェック,	エラーメッセージ,	MIN, MAX

	$GLOBALS['set_items'][] = array("種別",			"type",			"CHK_RADIO",	"種別",			1, 512);
$GLOBALS['set_items'][] = array("お名前",				"name1",		"CHK_NAME",		"お名前",			1, 512);
$GLOBALS['set_items'][] = array("お名前",				"name2",		"CHK_NAME",		"お名前",			1, 512);
$GLOBALS['set_items'][] = array("フリガナ",	"name3",		"CHK_NAME",		"フリガナ",			1, 512);
$GLOBALS['set_items'][] = array("フリガナ",	"name4",		"CHK_NAME",		"フリガナ",			1, 512);
	$GLOBALS['set_items'][] = array("性別",			"gender",			"CHK_RADIO",	"性別",			1, 512);
$GLOBALS['set_items'][] = array("年齢",			"age",		"CHK_TEXT",		"年齢",			1, 50);
$GLOBALS['set_items'][] = array("TEL",			"phone",		"CHK_TEL",		"TEL",			1, 20);
$GLOBALS['set_items'][] = array("メールアドレス",	"email",	"CHK_MAIL",		"メールアドレス",	1, 128);


$GLOBALS['set_items'][] = array("備考",			"coment",		"CHK_TEXT",		"備考",			0, 8192);
// $GLOBALS['set_items'][] = array("同意",				"privacy",	"CHK_CHECK",	"同意",				1, 256);



function MailFunc()
{



	for( $i=0; $i<count($GLOBALS['set_items1']); $i++ )
	{
		$GLOBALS['set_items'][] = $GLOBALS['set_items1'][$i];
	}

	if( PushMailSend() )
	{
		// メール設定
		$err = "";

		
		$admin_email = "can-tera@hitotohito.co.jp";
		$to_email = $admin_email;
		// $admin_email = '';
		// 管理者アドレス（送信者アドレス）
				
		// -----自社宛設定-----
		// 送信者
		$from_msg = "can-tera";
		
		// $kind = $_POST["type"];
		// $kind = "お問い合わせ";
		
		// 件名".$_POST['kind']."
		$subject = "[can-tera] ".$_POST["kind"];
		
		// 自社宛の内容
		$body = "▼ホームページからお問い合わせがありました。
--------------------------

種別：".$_POST['type']."
お名前：".$_POST["name1"]."".$_POST["name2"]."
お名前フリガナ：".$_POST["name3"]."".$_POST["name4"]."
性別：".$_POST["gender"]."
年齢：".$_POST["age"]."
TEL：".$_POST['phone']."
メールアドレス：".$_POST['email']."
備考：
".$_POST['coment']."

□・--------------------------------・□
株式会社アプメス
住所：〒105-0001
　　　　　東京都港区虎ノ門5-1-5
　　　　　メトロシティ神谷町6F
電話番号：03-6416-1411
E-mail：can-tera@hitotohito.co.jp
Web: https://www.apms-japan.net/
□・--------------------------------・□

------------------------------------------------------------
";
		// -----自社宛設定-----end
		
		
		// -----お客様宛設定-----
		// 件名
		
		// お客様宛の内容
		// お客様宛の内容 MakeFileMsg( MAIL_CONTACT_2 );
if($_POST['type'] == 'エントリー'){
	$auto_subject = "セカンドキャリア総合支援【can-tera】エントリーありがとうございます";
	$entry_or_contact = "※このメールはシステムからの自動返信です

セカンドキャリア総合支援【can-tera】へエントリーいただきまして
誠にありがとうございます。
このメールは、エントリー時に確認のため送信させていただいております。";
} else {
	$auto_subject = "セカンドキャリア総合支援【can-tera】お問合せありがとうございます";
	$entry_or_contact = "※このメールはシステムからの自動返信です

セカンドキャリア総合支援【can-tera】へのお問合せありがとうございました。
以下のお問合せ内容で送信いたしました。";
}

		$auto_body = $_POST['name1']." 様
".$entry_or_contact."
--------------------------
お名前：".$_POST["name1"]."".$_POST["name2"]."
お名前フリガナ：".$_POST["name3"]."".$_POST["name4"]."
性別：".$_POST["gender"]."
年齢：".$_POST["age"]."歳"."
TEL：".$_POST['phone']."
メール：".$_POST['email']."
備考：
".$_POST['coment']."
--------------------------

後日、担当者よりご連絡いたしますので、
今しばらくお待ちくださいませ。

□・--------------------------------・□
株式会社アプメス
住所：〒105-0001
　　　　　東京都港区虎ノ門5-1-5
　　　　　メトロシティ神谷町6F
電話番号：03-6416-1411
E-mail：can-tera@hitotohito.co.jp
Web: https://www.apms-japan.net/
□・--------------------------------・□

";
		// print "<pre style='background: #fff;'>";
		// print_r($_SESSION);
		// print "</pre>";
		// print "<pre style='background: #fff;'>";
		// print_r($_FILE);
		// print "</pre>";
		// print "<pre style='background: #fff;'>";
		// print_r($_POST);
		// print "</pre>";
		// exit;
		// 自社宛送信

		// 自社宛送信
		$ret = SendMail( $to_email, $_POST['email'], $_POST['email'], $subject, $body);
		// $ret = SendMailTemp( $admin_email, $_POST['email'], $_POST['email'], $subject, $body, "photo01");
		if( $ret != 0 )
		{
			unset($_SESSION[$GLOBALS["_sess_"]]);
			$err .= "メールエラー1($ret)<br>";
		}
		
		// お客様宛送信
		$ret = SendMail( $_POST['email'], $from_msg, $admin_email, $auto_subject, $auto_body);
		// $ret = SendMailTemp( $_POST['email'], $from_msg, $admin_email, $auto_subject, $auto_body, "photo01");
		if( $ret != 0 )
		{
			unset($_SESSION[$GLOBALS["_sess_"]]);
			$err .= "メールエラー2($ret)<br>";
		}

		unset($_SESSION[$GLOBALS["_sess_"]]);
		
		if( mb_strlen($err) == 0 )
		{
			// サンクス画面に
			$GLOBALS['sets']['mode_val'] = PAGE_END;

//			$act = "Location:http://".$_SERVER['HTTP_HOST']."/html_test/contact/thanks.html";
			$act = "Location:thanks.php";
/*
			if (headers_sent()) {
				print_r(headers_list());
				die('cannot send location header (anymore)');
			}
*/		
			header( $act ); 
			exit;
		}
		else
		{
			// メールエラー
			$GLOBALS['print_err_msg'] = $err;
		}
	}
}
?>