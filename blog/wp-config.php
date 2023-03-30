<?php
/**
 * WordPress の基本設定
 *
 * このファイルは、インストール時に wp-config.php 作成ウィザードが利用します。
 * ウィザードを介さずにこのファイルを "wp-config.php" という名前でコピーして
 * 直接編集して値を入力してもかまいません。
 *
 * このファイルは、以下の設定を含みます。
 *
 * * MySQL 設定
 * * 秘密鍵
 * * データベーステーブル接頭辞
 * * ABSPATH
 *
 * @link http://wpdocs.osdn.jp/wp-config.php_%E3%81%AE%E7%B7%A8%E9%9B%86
 *
 * @package WordPress
 */

// 注意:
// Windows の "メモ帳" でこのファイルを編集しないでください !
// 問題なく使えるテキストエディタ
// (http://wpdocs.osdn.jp/%E7%94%A8%E8%AA%9E%E9%9B%86#.E3.83.86.E3.82.AD.E3.82.B9.E3.83.88.E3.82.A8.E3.83.87.E3.82.A3.E3.82.BF 参照)
// を使用し、必ず UTF-8 の BOM なし (UTF-8N) で保存してください。

// ** MySQL 設定 - この情報はホスティング先から入手してください。 ** //
/** WordPress のためのデータベース名 */
define('DB_NAME', 'apms-cathand_apmsblog');

/** MySQL データベースのユーザー名 */
define('DB_USER', 'apms-cathand');

/** MySQL データベースのパスワード */
define('DB_PASSWORD', 'apms0203');

/** MySQL のホスト名 */
define('DB_HOST', 'mysql650.db.sakura.ne.jp');

/** データベースのテーブルを作成する際のデータベースの文字セット */
define('DB_CHARSET', 'utf8mb4');

/** データベースの照合順序 (ほとんどの場合変更する必要はありません) */
define('DB_COLLATE', '');

/**#@+
 * 認証用ユニークキー
 *
 * それぞれを異なるユニーク (一意) な文字列に変更してください。
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org の秘密鍵サービス} で自動生成することもできます。
 * 後でいつでも変更して、既存のすべての cookie を無効にできます。これにより、すべてのユーザーを強制的に再ログインさせることになります。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '2+euGc{Xd%.qTpw`ya9~bD>g{(i;_H6+u5>5C+Q89XZ`gF6gl~$<gs?h0}Z^#5hm');
define('SECURE_AUTH_KEY',  'A-Q@>L>l/mSLp,yaur+v)vazEGS4d@o6oy4/lj33`;a>KKBwGgU[Wm+Hp^E$sB2V');
define('LOGGED_IN_KEY',    '~zUvAbjaIA~xu!#z^)3eS=C<}CpazTg*{4VMXJo>U]0D?$a:st;MY{QcXpSv*,.X');
define('NONCE_KEY',        '7hOl})7s.(UzL{l[I9c(u=6QwBGte*1CB!s`>_Fm-qQi7rHq/:DIah:d?|hTsD|*');
define('AUTH_SALT',        '},83.B/H$cnL2)s3lHipEcIOK035ISvSTQ&E02:0`Eunab}pO(]5~Pnrd;zs~qe*');
define('SECURE_AUTH_SALT', 'XBW%X*8U3[DodZ*~vB%@qU[}6xww6rc])49K0v(dGK`n1QvuOj%Oy:6Kpp<C{OP/');
define('LOGGED_IN_SALT',   'Y+1>Dg4O;F7cTQ4;*abFD59RfdUUx,?.cdE;#50:dFDGB;f&w;y#YZp&=f;4TRSB');
define('NONCE_SALT',       '9XXe^&r@r.)0Db$9=LR]=_wnpY-%>S~YbHhgSXpyEO2=M-vr{I[x/d+o_4))sQ,f');

/**#@-*/

/**
 * WordPress データベーステーブルの接頭辞
 *
 * それぞれにユニーク (一意) な接頭辞を与えることで一つのデータベースに複数の WordPress を
 * インストールすることができます。半角英数字と下線のみを使用してください。
 */
$table_prefix  = 'ab_';

/**
 * 開発者へ: WordPress デバッグモード
 *
 * この値を true にすると、開発中に注意 (notice) を表示します。
 * テーマおよびプラグインの開発者には、その開発環境においてこの WP_DEBUG を使用することを強く推奨します。
 *
 * その他のデバッグに利用できる定数については Codex をご覧ください。
 *
 * @link http://wpdocs.osdn.jp/WordPress%E3%81%A7%E3%81%AE%E3%83%87%E3%83%90%E3%83%83%E3%82%B0
 */
define('WP_DEBUG', false);

/* 編集が必要なのはここまでです ! WordPress でブログをお楽しみください。 */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
