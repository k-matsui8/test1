<?php
// ページ遷移
define( "PAGE_INIT",	0 );
define( "PAGE_ERROR",	1 );
define( "PAGE_CHECK",	2 );
define( "PAGE_END",	3 );


// 内部設定用
define( "_KIND", 0 );
define( "_NAME", 1 );
define( "_CHECK",2 );
define( "_MSG",  3 );
define( "_MIN",  4 );
define( "_MAX",  5 );

define( "PRINT_SELECT_CUT", "|" );


// 項目ごとにエラー表示する場合
define( "ERR_DISP_INPUT", true );

define( "_ERR_MAIL_", 					"_ERR_MAIL_" );
define( "_ERR_MAIL_MSG_", 				"_ERR_MAIL_MSG_" );
define( "_ERR_MAIL_BACKGROUND_COLOR",	"#FFEEEE" );

/// 130820
// 入力チェックキャンセル
$GLOBALS['check_cancel'] = array("CHK_YEAR","CHK_MONTH","CHK_DAY","CHK_HOUR","CHK_MINUTE","CHK_SEC","CHK_YMDHM","CHK_YMD","CHK_YM");
// セレクト
$GLOBALS['check_select_type'] = array("CHK_SELECT","CHK_YEAR","CHK_MONTH","CHK_DAY","CHK_HOUR","CHK_MINUTE","CHK_SEC");
/// 130820 end

global $end_body;

global $end_script;

global $set_form;
global $sets;

global $print_err_msg;

// フォントカラーなど（contact.jsにも反映するように)
$GLOBALS['sets']['color']['font']['err'] = '#000000';
$GLOBALS['sets']['color']['background']['err'] = _ERR_MAIL_BACKGROUND_COLOR;


$GLOBALS["_sess_"] = "_sess_".str_replace( array("-",".","/"), "", $_SERVER["PHP_SELF"]);

// メール送信が押された
function PushMailSend()
{
	$pos1 = strrpos($_SERVER['SCRIPT_FILENAME'],"/");
	$pos2 = strrpos($_SERVER['SCRIPT_FILENAME'],".");
	$contact_mode = substr($_SERVER['SCRIPT_FILENAME'], $pos1+1, $pos2-$pos1-1 );
	$contact_mode = $contact_mode."_mode_btn";
//	print basename($_SERVER['PHP_SELF'])."_mode";

	if( isset($_POST['sendmail']) || (isset($_POST[$contact_mode]) && strcmp($_POST[$contact_mode],"sendmail") == 0) )
	{
		return 1;
	}
	
	return 0;
}

// 0:入力 1:エラー 2:確認 3:完了
function RetMode()
{
	$val = intval($GLOBALS['sets']['mode_val']);
	return $val;
}

function PrintButton()
{
	// 確認画面location.href=\''.$GLOBALS['sets']['php'].'\'
	if( $GLOBALS['sets']['mode_val'] == PAGE_CHECK )
	{
		print '<div><input name="amend" type="submit" value="　　訂正する　　" /></div><div><input type="submit" name="sendmail" value="　　送信する　　" /></div>';
	}
	else
	{
		print '<div><input type="submit" value="上記の内容で確認" /></div>';
	}
}

function SetError( )
{
	$err_msg['CHK_NEC']		= "を入力してください。";
	$err_msg['CHK_COM']		= "必須項目です。";
	$err_msg['CHK_HANKANA']	= "半角カタカナは使用しないでください。";
	$err_msg['CHK_MAX']		= "文字以下で入力してください。";

	$err_msg['CHK_RADIO']	= "選択してください。";
	$err_msg['CHK_NAME']	= "を確認してください。";
	$err_msg['CHK_ZIP']		= "半角数字と[-]で入力してください。";
	$err_msg['CHK_KEN']		= "選択してください。";
	$err_msg['CHK_ADDR']	= "を確認してください。";
	$err_msg['CHK_TEL']		= "半角数字と[-]で入力してください。";
	$err_msg['CHK_TEXT']	= "を確認してください。";
	$err_msg['CHK_MAIL']	= "メールアドレス形式で入力してください。";
	$err_msg['CHK_MAIL_COM']= "メールアドレス形式で必ず入力してください。";
	$err_msg['CHK_CHECK']	= "選択してください。";
	$err_msg['CHK_CHECK_MAX']	= "以下で選択してください。";
	$err_msg['CHK_ZENKANA']	= "全角カタカナのみで入力してください。";
	$err_msg['CHK_N_KANJI']	= "全角ひらがなカタカナで入力してください。";
	$err_msg['CHK_YOMIGANA']= "全角ひらがなカタカナで入力してください。";
	$err_msg['CHK_URL']		= "ＵＲＬ形式で入力してください。";
	$err_msg['CHK_NUM']		= "半角数字で入力してください。";
	$err_msg['CHK_MONTH']	= "1から12の半角数字で入力してください。";
	$err_msg['CHK_DAY']		= "1から31の半角数字で入力してください。";
	$err_msg['CHK_HAN_EISU']= "半角英数字で入力してください。";
	$err_msg['CHK_X']= "は半角カタカナは使用しないでください。";
	$err_msg['CHK_SELECT']	= "を選択してください。";

	$err_msg['CHK_YEAR']	= "年形式で入力してください。";
	$err_msg['CHK_MONTH']	= "月形式で入力してください。";
	$err_msg['CHK_DAY']		= "日付形式で入力してください。";
	$err_msg['CHK_HOUR']	= "時形式で入力してください。";
	$err_msg['CHK_MINUTE']	= "分形式で入力してください。";
	$err_msg['CHK_YM']		= "年月形式で入力してください。";
	$err_msg['CHK_YMD']		= "年月日形式で入力してください。";
	$err_msg['CHK_YMDHM']	= "年月日時分形式で入力してください。";
	$err_msg['CHK_YMD_NOT']		= "年月日が間違っています";
	$err_msg['CHK_MD_NOT']		= "月日が間違っています";
	
	$GLOBALS['end_body'] = "";

	$print_msg = "";
	
	foreach($GLOBALS['set_items'] as $value)
	{
		if( isset($_POST[$value[_NAME]]) )
		{
			$val = $_POST[$value[_NAME]];
		}
		else
		{
			$val = "";
		}
		
// && !isset($_POST['contact_mode'])
		if( strcmp($value[_CHECK],'CHK_CHECK')!=0  )
		{

			$flg = $value[_NAME]."_flg";
			if( isset($_POST[$flg]) )
			{
				$flg_val = intval($_POST[$flg]);
			}
			else
			{
				$flg_val = 0;
			}

			if( $flg_val == 0 && isset($_POST[$flg]) )
			{
			//	$val = "";
			}
		}
		//
//		print $value[_NAME]." ".$val." --- <br />\n";

		/// 130820
		
		// セレクトならNUMを取る
		for( $j=0; $j<count($GLOBALS['check_select_type']); $j++)
		{
			if( strcmp($value[_CHECK], $GLOBALS['check_select_type'][$j]) == 0 )
			{
				$exp = explode(PRINT_SELECT_CUT, $val);
				
				$num = $exp[1];
				$val = $exp[0];
			}
		}
		
		/// 130820 end
		

//		${_ERR_MAIL_."_cnt"} = count($GLOBALS[_ERR_MAIL_]);
		${_ERR_MAIL_."_cnt"} = isset($GLOBALS[_ERR_MAIL_]) ? count($GLOBALS[_ERR_MAIL_]) : 0;
		
		// Rev.07
		// ファイルならキャンセル
		if( strcmp($value[_CHECK],'CHK_IMG') == 0 )
		{
			if( $GLOBALS['sets']['mode_val']-0 > PAGE_CHECK-0 )
			{
				continue;
			}
//			$set_items_file[count($set_items_file)] = $set_items_cont;
//			continue;

//			for($i=0; $i<count($set_items_file); $i++)
//			{
				$file_max = 1;	//$value[_MAX];
				$file_min = $value[_MIN];
				
				
				$cnt = 0;
				for($j=0; $j<$file_max; $j++)
				{
					$file_size = $_FILES[$value[_NAME]]['size'][$j]-0;	//$value[_NAME]."_name";
					
		//			$GLOBALS['set_items'][$set_items_file[$i]][_NAME] = 
					if($file_size > 0 )
					{
						$cnt++;
					}
				}
				if( $file_min > 0 && $cnt == 0 )
				{
					$print_msg .= "[".$value[_MSG]."]は".$err_msg['CHK_COM']."<br />";
				}
				else if( $file_min > 0 && $cnt == 0 )
				{
					$print_msg .= "[".$value[_MSG]."]は".$err_msg['CHK_COM']."<br />";
				}
				else
				{
					$name = $value[_NAME];
					$f_exp = "file_exp_".$name;
					$exp_lst = split(",",$_POST[$f_exp]);
					//$_POST[$file_name]
					
					for($j=0; $j<count($exp_lst); $j++)
					{
						for($m=0; $m<count($_FILES[$value[_NAME]]); $m++)
						{
							$file_name = $_FILES[$value[_NAME]]['name'][$m];
							
							if( strstr($file_name,".") === FALSE )
							{
								break;
							}
								$file_exp = mb_strrpos($file_name,".");

							
							if( $file_exp === FALSE )$file_exp = 0;
							$file_exp++;
							
							$file_exp = mb_substr($file_name, $file_exp, 3);
							

							if( strcmp($exp_lst[$j],$file_exp) == 0 )
							{
								break;
							}
							
//							print $file_exp."<br />\n";
						}
						
						if( $m == count($_FILES[$value[_NAME]]) )
						{
							$print_msg .= "[".$value[_MSG]."]「".$file_exp."」".$err_msg['CHK_EXP']."<br />";
						}
						/*
						print "-----\n";
						print_r($exp_lst);
						print "---";
						print_r($file_exp);
						print "-----\n";
						*/
					}
				}
//			}
			continue;
		}
		
		
		/// 130820
		// 入力チェックキャンセル
		$chk_on_flag = 1;
		for($j=0; $j<count($GLOBALS['check_cancel']); $j++)
		{
			if( strcmp( $value[_CHECK], $GLOBALS['check_cancel'][$j] ) == 0 )
			{
				$chk_on_flag = 0;
			}
		}
		/// 130820 end

		// Rev.07 end
		
		if( strcmp($value[_CHECK],'CHK_SELECT')==0 )
		{
			if( strrchr($val,"|") !== FALSE)
			{
				$pos = mb_strrpos($val,"|");
				$num = mb_substr($val,$pos+1);
				$val = mb_substr($val,0,$pos);
			}
		}
		
		// 必須チェック
		$flagname = $value[_NAME]."_flg";
		if( $value[_MIN] > 0 && $chk_on_flag == 1 )
		{
			if( strcmp($value[_CHECK],'CHK_SELECT')==0 )
			{
//print "--------".$value[_NAME]."--".$num."==".$value[_MAX]."<br>";
				if( strcmp($num,$value[_MAX])==0 )
				{
					$print_msg .= "[".$value[_MSG]."]は".$err_msg['CHK_COM']."<br />";
					$GLOBALS[_ERR_MAIL_MSG_][$value[_NAME]] = $err_msg['CHK_COM'];
					$GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['name'] = $value[_NAME];
					$GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['msg'] = $err_msg['CHK_COM'];
					continue;
				}
			} 
			else
			{
				if( !(strcmp($value[_CHECK],'CHK_CHECK')==0 && count($val)>0) )
				{
					if( !is_array($val) && mb_strlen($val) == 0 )
					{
						if( strcmp($value[_CHECK],'CHK_MAIL')==0 )
						{
							$print_msg .= "[".$value[_MSG]."]は".$err_msg['CHK_MAIL_COM']."<br />";
							$GLOBALS[_ERR_MAIL_MSG_][$value[_NAME]] = $err_msg['CHK_MAIL_COM'];
							$GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['name'] = $value[_NAME];
							$GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['msg'] = $err_msg['CHK_MAIL_COM'];
						}
						else
						{
							$print_msg .= "[".$value[_MSG]."]は".$err_msg['CHK_COM']."<br />";
							$GLOBALS[_ERR_MAIL_MSG_][$value[_NAME]] = $err_msg['CHK_COM'];
							$GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['name'] = $value[_NAME];
							$GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['msg'] = $err_msg['CHK_COM'];
						}

						/*
						if (strlen($GLOBALS['end_body'])==0 && strcmp($_POST[$flagname],"0")==0 && strcmp($value[_CHECK],'CHK_RADIO')!=0 && strcmp($value[_CHECK],'CHK_KEN')!=0 && strcmp($value[_CHECK],'CHK_CHECK')!=0 )
						{

//							$GLOBALS['end_body'] = "\n<script type=\"text/javascript\">document.".$GLOBALS['set_form'].".".$value[_NAME].".focus();</script>\n";

						}
						*/
						continue;
					}
				}
			}
		}
		else
		{
//			if( strcmp($_POST[$flagname],"0")==0 )continue;
		}
		
		// 文字数オーバー
		if( !is_array($val) && mb_strlen($val) > $value[_MAX] && strcmp($value[_CHECK],"CHK_RADIO")!=0 && strcmp($value[_CHECK],"CHK_SELECT")!=0 && strcmp($value[_CHECK],"CHK_CHECK")!=0 && strcmp($value[_CHECK],"CHK_KEN")!=0 )
		{
			$print_msg .= "[".$value[_MSG]."]".$value[_MAX].$err_msg['CHK_MAX']."<br />";
			$GLOBALS[_ERR_MAIL_MSG_][$value[_NAME]] = $value[_MAX].$err_msg['CHK_MAX'];
			$GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['name'] = $value[_NAME];
			$GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['msg'] = $err_msg['CHK_MAX'];
			continue;
		}
		/*
		// 半角カタカナ
		if( strcmp($value[_CHECK],"CHK_RADIO")!=0 && strcmp($value[_CHECK],"CHK_CHECK")!=0 && strcmp($value[_CHECK],"CHK_KEN")!=0 )
		{
			mb_internal_encoding("EUC");
		
			if(mb_preg_match("[^ｦ-ﾟ]+$", $val) === false)
			{
				$print_msg .= "[".$value[_MSG]."]は".$err_msg['CHK_HANKANA']."<br />";
				continue;
			}
		}
		*/
		switch( $value[_CHECK] )
		{
		case 'CHK_RADIO':
			if( strlen($val) == 0 && $value[_MIN] != 0 )
			{
				$print_msg .= "[".$value[_MSG]."]を".$err_msg['CHK_RADIO']."<br />";
				$GLOBALS[_ERR_MAIL_MSG_][$value[_NAME]] = $err_msg['CHK_RADIO'];
				$GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['name'] = $value[_NAME];
				$GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['msg'] = $err_msg['CHK_RADIO'];
			}
			break;
		case 'CHK_TEL':
			if (preg_match("/[^-0-9０-９‐]/", $val))
			// if (!preg_match("/^[0-9]{2,4}-[0-9]{2,4}-[0-9]{3,4}$/", $val))
			{
				$print_msg .= "[".$value[_MSG]."]は".$err_msg['CHK_TEL']."<br />";
				$GLOBALS[_ERR_MAIL_MSG_][$value[_NAME]] = $err_msg['CHK_TEL'];
				$GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['name'] = $value[_NAME];
				$GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['msg'] = $err_msg['CHK_TEL'];
			}
			break;
		case 'CHK_FAX':
			if (preg_match("[^-0-9]", $val))
			{
				$print_msg .= "[".$value[_MSG]."]".$err_msg['CHK_FAX']."<br />";
				$GLOBALS[_ERR_MAIL_MSG_][$value[_NAME]] = $err_msg['CHK_FAX'];
				$GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['name'] = $value[_NAME];
				$GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['msg'] = $err_msg['CHK_FAX'];
			}
			break;
		case 'CHK_ZIP':
			if (preg_match("[^-0-9]", $val) )
			{
				$print_msg .= "[".$value[_MSG]."]は".$err_msg['CHK_ZIP']."<br />";
				$GLOBALS[_ERR_MAIL_MSG_][$value[_NAME]] = $err_msg['CHK_ZIP'];
				$GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['name'] = $value[_NAME];
				$GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['msg'] = $err_msg['CHK_ZIP'];
			}
			break;
		case 'CHK_KEN':
			if (strpos($val, "都道府県") === false)
			{}else
			{
				if( $value[_MIN]-0 != 0 )
				{
					$print_msg .= "[".$value[_MSG]."]を".$err_msg['CHK_KEN']."<br />";
				$GLOBALS[_ERR_MAIL_MSG_][$value[_NAME]] = $err_msg['CHK_KEN'];
					$GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['name'] = $value[_NAME];
					$GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['msg'] = $err_msg['CHK_KEN'];
					$GLOBALS[_ERR_MAIL_MSG_][ $value[_NAME] ] = $err_msg['CHK_KEN'];
				}
			}
			break;
		case 'CHK_CHECK':
			if( is_array($val) )
			{
				if( count($val) > $value[_MAX] )
				{
					$print_msg .= "[".$value[_MSG]."]を".$value[_MAX].$err_msg['CHK_CHECK_MAX']."<br />";
					$GLOBALS[_ERR_MAIL_MSG_][$value[_NAME]] = $err_msg['CHK_CHECK_MAX'];
					$GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['name'] = $value[_NAME];
					$GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['msg'] = $err_msg['CHK_CHECK_MAX'];
				}
			}
			else
			{
				if( $value[_MIN] != 0 )
				{
					$print_msg .= "[".$value[_MSG]."]を".$err_msg['CHK_KEN']."<br />";
					$GLOBALS[_ERR_MAIL_MSG_][$value[_NAME]] = $err_msg['CHK_KEN'];
					$GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['name'] = $value[_NAME];
					$GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['msg'] = $err_msg['CHK_KEN'];
				}
			}
			break;

		case 'CHK_MAIL':
		//	if ((!preg_match('^[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+'.'@'.'[-!#$%&\'*+\\/0-9=?A-Z^_`a-z{|}~]+\.'.'[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+$', $val)) && ($val != "newuser@localhost"))
			if( !isValidEmailFormat($val) )
			{
				if( intval($value[_MIN]) > 0 )
				{
					$print_msg .= "[".$value[_MSG]."]は".$err_msg['CHK_MAIL_COM']."<br />";
					$GLOBALS[_ERR_MAIL_MSG_][$value[_NAME]] = $err_msg['CHK_MAIL_COM'];
					$GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['name'] = $value[_NAME];
					$GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['msg'] = $err_msg['CHK_MAIL_COM'];
				}
				else
				{
					$print_msg .= "[".$value[_MSG]."]は".$err_msg['CHK_MAIL']."<br />";
					$GLOBALS[_ERR_MAIL_MSG_][$value[_NAME]] = $err_msg['CHK_MAIL'];
					$GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['name'] = $value[_NAME];
					$GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['msg'] = $err_msg['CHK_MAIL'];
				}
			}
			if( isset($_POST['email2']) && !isset($mail_chk) )
			{
				if( strcmp($_POST['email'],$_POST['email2'])!=0)
				{
					$mail_chk = 'chk';
					$print_msg .= "「メールアドレス」と「メールアドレス※確認用」に違いがあります。<br />";
					$GLOBALS[_ERR_MAIL_MSG_][$value[_NAME]] = "「メールアドレス」と「メールアドレス※確認用」に違いがあります。";
					$GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['name'] = $value[_NAME];
					$GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['msg'] = "「メールアドレス」と「メールアドレス※確認用」に違いがあります。";
				}
			}
			break;
		case 'CHK_ZENKANA';
			if(mb_preg_match("^[ァ-ヶ\\s　]*$", $val) === false )
			{
				$print_msg .= "[".$value[_MSG]."]は".$err_msg['CHK_ZENKANA']."<br />";
				$GLOBALS[_ERR_MAIL_MSG_][$value[_NAME]] = $err_msg['CHK_ZENKANA'];
				$GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['name'] = $value[_NAME];
				$GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['msg'] = $err_msg['CHK_ZENKANA'];
			}
			break;
		case 'CHK_N_KANJI';
			if(mb_preg_match("^[ぁ-んァ-ヶ\\s　]*$", $val) === false )
			{
				$print_msg .= "[".$value[_MSG]."]は".$err_msg['CHK_N_KANJI']."<br />";
				$GLOBALS[_ERR_MAIL_MSG_][$value[_NAME]] = $err_msg['CHK_N_KANJI'];
				$GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['name'] = $value[_NAME];
				$GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['msg'] = $err_msg['CHK_N_KANJI'];
			}
			break;
		case 'CHK_YOMIGANA';
			if(mb_preg_match("^[ぁ-んァ-ヶ\\s　！”＃＄％＆’（）＝～｜＠￥「」：；￥・。、－ー]*$", $val) === false )
			{
				$print_msg .= "[".$value[_MSG]."]は".$err_msg['CHK_YOMIGANA']."<br />";
				$GLOBALS[_ERR_MAIL_MSG_][$value[_NAME]] = $err_msg['CHK_YOMIGANA'];
				$GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['name'] = $value[_NAME];
				$GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['msg'] = $err_msg['CHK_YOMIGANA'];
			}
		case 'CHK_URL';
			if(mb_preg_match("(https?:\/\/[-_.!~*\'()a-zA-Z0-9;/?:@&=+$,%#]+)", $val) === false && mb_strlen($val) > 0 )
			{
				$print_msg .= "[".$value[_MSG]."]は".$err_msg['CHK_URL']."<br />";
				$GLOBALS[_ERR_MAIL_MSG_][$value[_NAME]] = $err_msg['CHK_URL'];
				$GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['name'] = $value[_NAME];
				$GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['msg'] = $err_msg['CHK_URL'];
			}
			break;
		case 'CHK_NUM':
			if (preg_match("[^0-9]", $val) )
			{
				$print_msg .= "[".$value[_MSG]."]は".$err_msg['CHK_NUM']."<br />";
				$GLOBALS[_ERR_MAIL_MSG_][$value[_NAME]] = $err_msg['CHK_NUM'];
				$GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['name'] = $value[_NAME];
				$GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['msg'] = $err_msg['CHK_NUM'];
			}
			break;
			/*
		case 'CHK_MONTH':
			if( mb_strlen($val) == 0 )
			{
			
			}
			else if (preg_match("[^0-9]", $val) )
			{
				$print_msg .= "[".$value[_MSG]."]は".$err_msg['CHK_HAN_EISU']."<br />";
				$GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['name'] = $value[_NAME];
				$GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['msg'] = $err_msg['CHK_HAN_EISU'];
			}
			else if( intval($val) < 1 || intval($val) > 12 )
			{
				$print_msg .= "[".$value[_MSG]."]は".$err_msg['CHK_MONTH']."<br />";
				$GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['name'] = $value[_NAME];
				$GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['msg'] = $err_msg['CHK_MONTH'];
			}
			break;
		case 'CHK_DAY':
			if( mb_strlen($val) == 0 )
			{
			
			}
			else if (preg_match("[^0-9]", $val) )
			{
				$print_msg .= "[".$value[_MSG]."]は".$err_msg['CHK_HAN_EISU']."<br />";
				$GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['name'] = $value[_NAME];
				$GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['msg'] = $err_msg['CHK_HAN_EISU'];
			}
			else if( intval($val) < 1 || intval($val) > 31 )
			{
				$print_msg .= "[".$value[_MSG]."]は".$err_msg['CHK_DAY']."<br />";
				$GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['name'] = $value[_NAME];
				$GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['msg'] = $err_msg['CHK_DAY'];
			}
			break;
			*/
		case 'CHK_HAN_EISU':
			if(preg_match("[^0-9a-zA-Z_]", $val) )
			{
				$print_msg .= "[".$value[_MSG]."]は".$err_msg['CHK_HAN_EISU']."<br />";
				$GLOBALS[_ERR_MAIL_MSG_][$value[_NAME]] = $err_msg['CHK_HAN_EISU'];
				$GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['name'] = $value[_NAME];
				$GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['msg'] = $err_msg['CHK_HAN_EISU'];
			}
			break;
			
		case 'CHK_DAY':
			if( strcmp($val,"--") == 0 )
			{
			}
			else if( $val < 1 || $val > 31 )
			{
				$print_msg .= "[".$value[_MSG]."]は".$err_msg['CHK_DAY']."<br />";
				$GLOBALS[_ERR_MAIL_MSG_][$value[_NAME]] = $err_msg['CHK_DAY'];
				$GLOBALS[_ERR_]['ITEMS'][$value[_NAME]] = "※".$err_msg['CHK_DAY'];
			}			
			break;
		case 'CHK_MONTH':
			if( strcmp($val,"--") == 0 )
			{
			}
			else if( $val < 1 || $val > 12 )
			{
				$print_msg .= "[".$value[_MSG]."]は".$err_msg['CHK_MONTH']."<br />";
				$GLOBALS[_ERR_MAIL_MSG_][$value[_NAME]] = $err_msg['CHK_MONTH'];
				$GLOBALS[_ERR_]['ITEMS'][$value[_NAME]] = "※".$err_msg['CHK_MONTH'];
			}
			break;
		case 'CHK_HOUR':
			if( strcmp($val,"--") == 0 )
			{
			}
			else if( $val < 0 || $val > 25 )
			{
				$print_msg .= "[".$value[_MSG]."]は".$err_msg['CHK_HOUR']."<br />";
				$GLOBALS[_ERR_MAIL_MSG_][$value[_NAME]] = $err_msg['CHK_HOUR'];
				$GLOBALS[_ERR_]['ITEMS'][$value[_NAME]] = "※".$err_msg['CHK_HOUR'];
			}
			break;
		case 'CHK_MINUTE':
			if( strcmp($val,"--") == 0 )
			{
			}
			else if( $val < 0 || $val >= 60 )
			{
				$print_msg .= "[".$value[_MSG]."]は".$err_msg['CHK_MINUTE']."<br />";
				$GLOBALS[_ERR_MAIL_MSG_][$value[_NAME]] = $err_msg['CHK_MINUTE'];
				$GLOBALS[_ERR_]['ITEMS'][$value[_NAME]] = "※".$err_msg['CHK_MINUTE'];
			}
			break;
		case 'CHK_YEAR':
			break;
		/// 130820
		case 'CHK_MD':
				$ymd_lst = array("month","day");
				
				$bar_cnt = 0;
				
				unset($chk_ymd);
				//$ttt = "";
				for( $loop=0; $loop<count($ymd_lst); $loop++ )
				{
					$ymd = $value[_NAME]."_".$ymd_lst[$loop];
					
					$tmp[$ymd]['post'] = $_POST[$ymd];
					
					$tmp_pos = mb_strrpos($tmp[$ymd]['post'],"|");
					$tmp_num = mb_substr($tmp[$ymd]['post'],$tmp_pos);
					$tmp[$ymd]['val'] = mb_substr($tmp[$ymd]['post'],0,$tmp_pos);
				//	$ttt .= $tmp_num."--";
					if( is_numeric($tmp[$ymd]['val']) === false )
					{
						$bar_cnt++;
					}
					else
					{
						$chk_ymd[$loop] = $tmp[$ymd]['val'];
					}
				}
				
				$chk_year = intval(date("Y"));
				if( intval($chk_ymd[0]) < intval(date("n")) )
				{
					$chk_year++;
				}
				
				if( checkdate( $chk_ymd[0], $chk_ymd[1], $chk_year ) === false )
				{
					$print_msg .= "[".$value[_MSG]."]は".$err_msg['CHK_MD_NOT']."<br />";
					$GLOBALS[_ERR_MAIL_MSG_][$value[_NAME]] = $err_msg['CHK_MD_NOT'];
					$GLOBALS[_ERR_]['ITEMS'][$value[_NAME]] = "※".$err_msg['CHK_MD_NOT'];
				}
				else 
				if( $bar_cnt != count($ymd_lst) && $bar_cnt != 0 )
				{
					$print_msg .= "[".$value[_MSG]."]は".$err_msg['CHK_YMD']."<br />";
					$GLOBALS[_ERR_MAIL_MSG_][$value[_NAME]] = $err_msg['CHK_YMD'];
					$GLOBALS[_ERR_]['ITEMS'][$value[_NAME]] = "※".$err_msg['CHK_YMD'];
				}
				else if( $bar_cnt != 0 && $value[_MIN] > 0 )
				{
					$print_msg .= "[".$value[_MSG]."]は".$err_msg['CHK_COM']."<br />";
					$GLOBALS[_ERR_MAIL_MSG_][$value[_NAME]] = $err_msg['CHK_COM'];
					$GLOBALS[_ERR_]['ITEMS'][$value[_NAME]] = "※".$err_msg['CHK_COM'];
				}
			break;
		case 'CHK_YMD':
				$ymd_lst = array("year","month","day");
				
				$bar_cnt = 0;
				
				unset($chk_ymd);
				
				for( $loop=0; $loop<count($ymd_lst); $loop++ )
				{
					$ymd = $value[_NAME]."_".$ymd_lst[$loop];
					
					$tmp[$ymd]['post'] = $_POST[$ymd];
					
					$tmp_pos = mb_strrpos($tmp[$ymd]['post'],PRINT_SELECT_CUT);
					$tmp_num = mb_substr($tmp[$ymd]['post'],$tmp_pos+1);
					$tmp[$ymd]['val'] = mb_substr($tmp[$ymd]['post'],0,$tmp_pos);
					
					if( is_numeric($tmp[$ymd]['val']) === false )
					{
						$bar_cnt++;
					}
					else
					{
						$chk_ymd[$loop] = $tmp[$ymd]['val'];
					}
					
				//	print "|".$tmp_pos." -- ".$ymd." -- ";
				}
				
				
				if( checkdate( $chk_ymd[1], $chk_ymd[2], $chk_ymd[0] ) === false )
				{
					if( $value[_MIN] == 0 && !is_numeric($chk_ymd[1]) && !is_numeric($chk_ymd[2]) && !is_numeric($chk_ymd[0]) )
					{
					}
					else
					{
						$print_msg .= "[".$value[_MSG]."]は".$err_msg['CHK_YMD_NOT']."<br />";
						$GLOBALS[_ERR_MAIL_MSG_][$value[_NAME]] = $err_msg['CHK_YMD_NOT'];
						$GLOBALS[_ERR_]['ITEMS'][$value[_NAME]] = "※".$err_msg['CHK_YMD_NOT'];
					}
				}
				else if( $bar_cnt != count($ymd_lst) && $bar_cnt != 0 )
				{
					$print_msg .= "[".$value[_MSG]."]は".$err_msg['CHK_YMD']."<br />";
					$GLOBALS[_ERR_MAIL_MSG_][$value[_NAME]] = $err_msg['CHK_YMD'];
					$GLOBALS[_ERR_]['ITEMS'][$value[_NAME]] = "※".$err_msg['CHK_YMD'];
				}
				else if( $bar_cnt != 0 && $value[_MIN] > 0 )
				{
					$print_msg .= "[".$value[_MSG]."]は".$err_msg['CHK_COM']."<br />";
					$GLOBALS[_ERR_MAIL_MSG_][$value[_NAME]] = $err_msg['CHK_COM'];
					$GLOBALS[_ERR_]['ITEMS'][$value[_NAME]] = "※".$err_msg['CHK_COM'];
				}
			break;
		case 'CHK_YMDHM':
				$ymd_lst = array("year","month","day", "hour", "minute");
				
				unset($chk_ymd);
				
				$bar_cnt = 0;
				for( $loop=0; $loop<count($ymd_lst); $loop++ )
				{
					$ymd = $ymd_lst[$loop];
					
					$tmp = $items[$i+$loop+1];
					$tmp[$ymd]['post'] = $_POST[$tmp[_NAME]];
					$tmp_pos = mb_strrpos($tmp[$ymd]['post'],PRINT_SELECT_CUT);
					$tmp_num = mb_substr($tmp[$ymd]['post'],$tmp_pos+1);
					$tmp[$ymd]['val'] = mb_substr($tmp[$ymd]['post'],0,$tmp_pos);
					
					if( is_numeric($tmp[$ymd]['val']) === false )
					{
						$bar_cnt++;
					}
					
					$chk_ymd[$loop] = $tmp[$ymd]['val'];
				}

				if( checkdate( $chk_ymd[1], $chk_ymd[2], $chk_ymd[0] ) === false )
				{
					$print_msg .= "[".$value[_MSG]."]は".$err_msg['CHK_YMD_NOT']."<br />";
					$GLOBALS[_ERR_MAIL_MSG_][$value[_NAME]] = $err_msg['CHK_YMD_NOT'];
					$GLOBALS[_ERR_]['ITEMS'][$value[_NAME]] = "※".$err_msg['CHK_YMD_NOT'];
				}
				else 
				if( $bar_cnt != count($ymd_lst) && $bar_cnt != 0 )
				{
					$print_msg .= "[".$value[_MSG]."]は".$err_msg['CHK_YMDHM']."<br />";
					$GLOBALS[_ERR_MAIL_MSG_][$value[_NAME]] = $err_msg['CHK_YMDHM'];
					$GLOBALS[_ERR_]['ITEMS'][$value[_NAME]] = "※".$err_msg['CHK_YMDHM'];
				}
				else if( $bar_cnt != 0 && $value[_MIN] > 0 )
				{
					$print_msg .= "[".$value[_MSG]."]は".$err_msg['CHK_COM']."<br />";
					$GLOBALS[_ERR_MAIL_MSG_][$value[_NAME]] = $err_msg['CHK_COM'];
					$GLOBALS[_ERR_]['ITEMS'][$value[_NAME]] = "※".$err_msg['CHK_COM'];
				}
			break;
		/// 130820 end
			
		case 'CHK_ADDR':
		case 'CHK_NAME':
		case 'CHK_TEXT':
		case 'CHK_X':
			break;
		  default:
		      ;
		}
	}
	
//	if( mb_strlen($GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['msg']) > 0 )
	if( isset($GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['msg']) && mb_strlen($GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['msg']) > 0 )
	{
		$GLOBALS[_ERR_MAIL_MSG_][ $GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['name'] ] = $GLOBALS[_ERR_MAIL_][${_ERR_MAIL_."_cnt"}]['msg'];
	}
	
	if( isset($_POST[$GLOBALS['sets']['mode_name']]) && strlen($_POST[$GLOBALS['sets']['mode_name']])>0 )
//	if( !is_array($_POST) )
	{
		// 修正する
		if( isset( $_POST['amend'] ) || strcmp($_POST[ $GLOBALS['sets']['mode_name'].'_btn'],"amend") == 0 )
		{
			$GLOBALS['print_err_msg'] .= "";
			$GLOBALS['sets']['mode_val'] = PAGE_INIT;
			unset($GLOBALS[_ERR_MAIL_MSG_]);
		}
		// 完了画面		
		else if( strcmp($_POST[$GLOBALS['sets']['mode_name']],"1") == 0 && isset($_POST['sendmail']) )
		{
			$GLOBALS['sets']['mode_val'] = PAGE_END;
		}
		else if( strlen($print_msg) > 0 )
		{
		// 入力画面（エラー）
			$GLOBALS['print_err_msg'] .= $print_msg;
			$GLOBALS['sets']['mode_val'] = PAGE_ERROR;
		}
		else
		{
		// 確認画面
			$GLOBALS['sets']['mode_val'] = PAGE_CHECK;
		}
	}
	else
	{
		// 入ってきた
		$GLOBALS['sets']['mode_val'] = PAGE_INIT;
		$GLOBALS['sets']['init'] = "1";
		unset($GLOBALS[_ERR_MAIL_MSG_]);
	}

//	print '<input type="hidden" name="'.$GLOBALS['sets']['mode_name'].'" value="'.$GLOBALS['sets']['mode_val'].'" />'."\n";
}

function PrintError()
{
	print $GLOBALS['print_err_msg'];
//	print '<input type="hidden" name="'.$GLOBALS['sets']['mode_name'].'" value="'.$GLOBALS['sets']['mode_val'].'" />'."\n";
}

function PrintInput( $set, $msg = "", $err = "" )
{
	$str = str_replace(" ", "", $set );
	
	if( mb_strpos($str, 'name="') === false ){return false;}
	$pos = mb_strpos($str, 'name="') + strlen('name="');
	$str2 = substr( $str, $pos ); 
	$namestr = substr( $str2, 0, strpos($str2,'"') );

	if( mb_strpos($set, 'type="') === false ){
		$set .= ' type="text" ';
	}

	$name['name'] = $namestr;
	
	if( isset($_POST[$namestr]) )
	{
		if( strcmp($_POST[$namestr],$msg) == 0 )
		{
			$name['value'] = "";
		}
		else
		{
			$name['value'] = $_POST[$namestr];
		}
	}
	else
	{
		$name['value'] = "";
	}

	$name['flag'] = $name['name']."_flg";
	
	if( isset($_POST[$namestr]) )
	{
		$name['flag_val'] = intval($_POST[$name['flag']]);
	}
	else
	{
		$name['flag_val'] = "";
	}


	if( mb_strpos($str, 'id="') === false )
	{
		$id['name'] = $name['name'];
		$id_str = 'id="'.$id['name'].'"';
	}
	else
	{
		$pos = mb_strpos($str, 'id="') + strlen('id="');
		$str2 = substr( $str, $pos ); 
		$namestr = substr( $str2, 0, strpos($str2,'"') );

		$id['name'] = $namestr;
		$id_str = "";;
	}
	
	$hidd = '<input type="hidden" name="'.$name['flag'].'" id="'.$name['flag'].'" value="';
	$hidd .= $name['flag_val'];
	$hidd .= '" />';

	// 確認画面
	if( RetMode() == 2 )
	{
		$str = stripslashes($name['value']);
		$str = RetHtmlEncode($str);
		print '<input type="hidden" name="'.$name['name'].'" value="'.$str.'" />';
		print '<p class="p_input_box">'.$str.'</p>';
	}
	else
	{
	// 入力画面
		$valchk = 0;
//		for($i=0; $GLOBALS['set_items'][$i]!=NULL; $i++)
		for($i=0; isset($GLOBALS['set_items'][$i]); $i++)
		{
			//入力必須なら
			if( strcmp( $GLOBALS['set_items'][$i][_NAME], $name['name'] ) == 0 )
			{
				if( $GLOBALS['set_items'][$i][_MIN] > 0 ) $valchk = 1;
			}
		}
		
		


		print "<input $set $id_str ";
		print " value=\"";

		if(!isset($_POST[$name['name']])){ print $msg; }else{
			$str = stripslashes($name['value']);
			$str = RetHtmlEncode($str);
			print $str;
		}
		print "\" />\n";
		
		if( ERR_DISP_INPUT == true && mb_strlen($GLOBALS[_ERR_MAIL_MSG_][$name['name']]) > 0 )
		{
			// print '<p class="p_input_err_input">'.$GLOBALS[_ERR_MAIL_MSG_][$name['name']].'</p>';
		}

		if( ERR_DISP_INPUT == true && mb_strlen($GLOBALS[_ERR_MAIL_MSG_][$name['mail']]) > 0 )
		{
			// print '<p class="p_input_err_input">'.$GLOBALS[_ERR_MAIL_MSG_][$name['mail']].'</p>';
		}
		
	}
	
	print $hidd;
	
	SetErrCss($name['name'],$err);
}

function PrintTextarea( $set, $msg, $err = "" )
{
	$str = str_replace(" ", "", $set );
	
	if( mb_strpos($str, 'name="') === false ){return false;}
	$pos = mb_strpos($str, 'name="') + strlen('name="');
	$str2 = substr( $str, $pos ); 
	$namestr = substr( $str2, 0, strpos($str2,'"') );

	$name['name'] = $namestr;
	if( isset($_POST[$name['name']]) )
	{
		$name['value'] = $_POST[$name['name']];
	}
	else
	{
		$name['value'] = "";
	}
	$name['flag'] = $name['name']."_flg";

	if( mb_strpos($str, 'id="') === false )
	{
		$id['name'] = $name['name'];
		$id_str = 'id="'.$id['name'].'"';
	}
	else
	{
		$pos = mb_strpos($str, 'id="') + strlen('id="');
		$str2 = substr( $str, $pos ); 
		$namestr = substr( $str2, 0, strpos($str2,'"') );

		$id['name'] = $namestr;
		$id_str = "";
	}
	
	
	// 確認画面
	if( RetMode() == 2 )
	{
		$str = stripslashes($name['value']);
		$str = RetHtmlEncode($str);
		print '<input type="hidden" name="'.$name['name'].'" value="'.$str.'" />';
		$str = str_replace("\n", "<br />",$str);
		print '<p class="p_input_box">'.$str.'</p>';

		print '<input type="hidden" name="'.$name['flag'].'" id="'.$name['flag'].'" value="';if(strcmp($_POST[$name['flag']],'1')==0){print "1";}else{print "0";};print '" />';
	}
	else
	{
	// 入力画面
		$valchk = 0;
//		for($i=0; $GLOBALS['set_items'][$i]!=NULL; $i++)
		for($i=0; isset($GLOBALS['set_items'][$i]); $i++)
		{
			//入力必須なら
			if( strcmp( $GLOBALS['set_items'][$i][_NAME], $name['name'] ) == 0 )
			{
				if( $GLOBALS['set_items'][$i][_MIN] > 0 ) $valchk = 1;
			}
		}

		

		print '<input type="hidden" name="'.$name['flag'].'" id="'.$name['flag'].'" value="';if(strcmp($_POST[$name['flag']],'1')==0){print "1";}else{print "0";};print '" />';
		print "<textarea $set $id_str ";
		print " >";
		
		if(!$name['name']){ print $msg; }else{
			$str = stripslashes($name['value']);
			$str = RetHtmlEncode($str);
			print $str;
		}
		print "</textarea>\n";
		
		if( ERR_DISP_INPUT == true && mb_strlen($GLOBALS[_ERR_MAIL_MSG_][$name['name']]) > 0 )
		{
			print '<p class="p_input_err_input">'.$GLOBALS[_ERR_MAIL_MSG_][$name['name']].'</p>';
		}
	}
	
	SetErrCss($name['name'],$err);
}


function PrintRadio( $name, $lst, $cut, $num = 0, $err = "" )
{
	$radio_lst = explode($cut, $lst);
	$radio_post = $_POST[$name];
	
	if( count($lst) <= $num )
	{
		$cnt = 0;
		for( $i=0; isset($radio_lst[$i]); $i++)
		{
			$cnt += mb_strlen($radio_lst[$i]);
		}
		for( $i=0; isset($radio_lst[$i]); $i++)
		{
			$wid[$i] = mb_strlen($radio_lst[$i]) / $cnt * 100;
		}
	} 

	// 確認画面
	if( RetMode() == 2 )
	{
		if( strcmp($_POST[$radio_post],"0")==0 )
		{
			$radio_post = "";
		}
		print '<input type="hidden" name="'.$name.'" value="'.$radio_post.'" />';
		print '<p class="p_input_box">'.$radio_post.'</p>';
	}
	else
	{
	// 入力画面
		for( $i=0; isset($radio_lst[$i]); $i++)
		{
			if( mb_strlen($wid[$i]) > 0 )
			{
				$width_str = "";	//" width=\"".$wid[$i]."%\" ";
			}
			else
			{ 
				$width_str = "";
			}
			$id = $name."__".$i;

			if( ERR_DISP_INPUT == true && mb_strlen($GLOBALS[_ERR_MAIL_MSG_][$name]) > 0 )
			{
//				print '<p class="p_input_err">'.$GLOBALS[_ERR_MAIL_MSG_][$name].'</p>';
			}

			if( $radio_post == $radio_lst[$i] ){ $check_msg = ' checked="checked"'; }else{ $check_msg = ''; }
			print	"<input type=\"radio\" name=\"".$name."\" id=\"".$id."\" value=\"".$radio_lst[$i]."\"$check_msg />";
			print	"<label for=\"".$id."\"> ".$radio_lst[$i]."</label>&nbsp;&nbsp;";
			
			if( ($i%$num) == $num-1 ){print "<br />";}
		}
	}
	
	SetErrCss($name,$err);
}

function PrintRadioOne( $name, $list, $cut, $num = 0, $err = "" )
{
	$radio_lst = explode($cut, $list);
	$name_num = $name.$num;
	
//	$radio_lst = explode($cut, $lst);

	if( isset($_POST[$name]) )
	{
		$radio_post = $_POST[$name];
	}
	else
	{
		$radio_post = "";
	}

	// 確認画面
	if( RetMode() == 2 )
	{
		$name_init_flag = $name."__init_";
		
		if( !isset($GLOBALS[$name_init_flag]) )
		{
			print '<input type="hidden" name="'.$name.'" value="'.$radio_post.'" />';
			print $radio_post;
			
			$GLOBALS[$name_init_flag] = 1;
		}
	}
	else
	{
	// 入力画面

		if( ERR_DISP_INPUT == true && isset($GLOBALS[_ERR_MAIL_MSG_][$name]) && mb_strlen($GLOBALS[_ERR_MAIL_MSG_][$name]) > 0 )
		{
//			print '<p class="p_input_err">'.$GLOBALS[_ERR_MAIL_MSG_][$name].'</p>';
		}
		
		$id = $name."__".$num;
		if( strcmp($radio_post,$radio_lst[$num]) == 0 ){ $check_msg = ' checked="checked"'; }else{ $check_msg = ''; }

		print	"<input type=\"radio\" name=\"".$name."\" id=\"".$id."\" value=\"".$radio_lst[$num]."\"".$check_msg." />";
		print	"<label for=\"".$id."\"> ".$radio_lst[$num]."</label>";
	}
	
	SetErrCss($name,$err);
}


function PrintCheck( $name, $lst, $cut, $num = 0, $err = "" )
{
	$check_lst = explode($cut, $lst);
	$check_name = $name."[]";
	$check_data = $_POST[$name];
	
	// 修正
	if( isset($_POST['amend']) || strcmp($_POST[ $GLOBALS['sets']['mode_name'].'_btn'],"amend") == 0 )
	{
		$check_data = explode("\n", $_POST[$name]);
	}

	// 確認画面
	if( RetMode() == 2 )
	{
		$check_str = "";
		$check_value = "";
		
		if( isset($check_data) )
		{
			if( is_array($check_data) === false )
			{
				$check_str .= $check_data."<br />";
				$check_value .= $check_data."\n";
			}
			else
			{
				foreach($check_data as $value)
				{
					$check_str .= $value."<br />";
					$check_value .= $value."\n";
				}
			}
		}
		
		print '<input type="hidden" name="'.$name.'" value="'.$check_value.'" />';
		
		print '<p class="p_input_box">'.$check_str.'</p>';
	}
	else
	{
	// 入力画面
		for( $i=0; isset($check_lst[$i]); $i++)
		{
			$id = $name."___".$i;
			
			if( isset($check_data) )
			{
				if( is_array($check_data) === false )
				{
					if( strstr($check_data,$check_lst[$i]) == 0 )
					{
						$check_msg = ' checked="checked"';
						break;
					}
					else
					{
						$check_msg = '';
					}
				}
				else
				{
					foreach($check_data as $value)
					{
						if( strcmp(trim($value),trim($check_lst[$i])) == 0 )
						{
							$check_msg = ' checked="checked"';
							break;
						}
						else
						{
							$check_msg = '';
						}
					}
				}
			}
			
			if( ERR_DISP_INPUT == true && mb_strlen($GLOBALS[_ERR_MAIL_MSG_][$name]) > 0 )
			{
//				print '<p class="p_input_err">'.$GLOBALS[_ERR_MAIL_MSG_][$name].'</p>';
			}

			print	"<input type=\"checkbox\" name=\"".$check_name."\" id=\"".$id."\" value=\"".$check_lst[$i]."\"$check_msg />";
			print	"<label for=\"".$id."\"> ".$check_lst[$i]."</label>";

//			if( $i%$num == ($num-1) ){ print "</tr>"; }
			if( ($i+1)%$num == 0 ){ print "<br />"; }
		}
		
	}
	
	SetErrCss($name,$err);
}


function PrintCheckOne( $name, $lst, $cut, $num, $label_lst = '' )
{
	if ($label_lst == '') {
		$label_lst = $lst;
	}

	$check_lst = explode($cut, $lst);
	$check_label_lst = explode($cut, $label_lst);
	$check_name = $name."[]";
	$check_data = $_POST[$name];

	// 確認画面
	if( RetMode() == 2 )
	{
		$check_str = "";
		$check_value = "";
		
		if( isset($check_data) )
		{
			if( is_array($check_data) === false )
			{
				$check_value .= $check_data."\n";
			}
			else
			{
				foreach($check_data as $value)
				{
					$check_value .= $value."\n";
				}
			}
		}
	
//		print '<input type="hidden" name="'.$name.'" value="'.$check_value.'" />'.$name_init_flag;
	
//		print $check_str;





 if( strcmp($GLOBALS[$name."_FLAG__"],"ON") != 0 )
  {
   print '<input type="hidden" name="'.$name.'" value="'.$check_value.'" />'.$name_init_flag;
 
 	$check_value = str_replace( array("\n","\n\r"), "<br />", $check_value );
   print $check_value;

   $GLOBALS[$name."_FLAG__"] = "ON";
  }
  
  	//		return str_replace( array("\n","\n\r"), "<br />", $check_data );
  
  
  

	}
	else
	{
	// 入力画面
		$id = $name."___".$num;
		
		$check_msg = '';
		
		if( isset($check_data) )
		{
			if( is_array($check_data) === false )
			{
				if( strstr($check_data,$check_lst[$num]) !== false )
				{
					$check_msg = ' checked="checked"';
				}
				else
				{
					$check_msg = '';
				}
			}
			else
			{
				foreach($check_data as $value)
				{
					if( strcmp(trim($value),trim($check_lst[$num])) == 0 )
					{
						$check_msg = ' checked="checked"';
						break;
					}
					else
					{
						$check_msg = '';
					}
				}
			}
		}
		
		print	"<input type=\"checkbox\" name=\"".$check_name."\" id=\"".$id."\" value=\"".$check_lst[$num]."\"".$check_msg." />";
		if ($check_name == "privacy[]") {
			# code...
			print	"<label for=\"".$id."\"><a href=\"/privacy-policy/\"> プライバシーポリシー</a>に同意します</label>\t";
			// print	"<label for=\"".$id."\"> プライバシーポリシーに同意します</label>\t";
		}else{
			print	"<label for=\"".$id."\"> ".$check_label_lst[$num]."</label>\t";
		}
	}
}




function PrintSelect( $name, $lst, $cut, $err = "" )
{
	$select_lst = explode($cut, $lst);
	$select_name = $name;
	$select_data = $_POST[$name];

//	if( mb_strlen($select_data) > 0 && !isset($_POST['amend']) )
	if( (mb_strlen($select_data) > 0 && !isset($_POST['amend'])) || (mb_strlen($select_data) > 0 && strcmp($_POST[ $GLOBALS['sets']['mode_name'].'_btn'],"amend") == 0 ) )
	{
		$pos = mb_strrpos($select_data,"|");
		if( $pos === false )
		{
			$select_data = $_POST[$name];
		}
		else
		{
			$num = mb_substr($select_data,$pos+1);
			$select_data = mb_substr($select_data,0,$pos);
		}
	}


	// 確認画面
	if( RetMode() == 2 )
	{
		if( $min!=0 || ($min==0 && $num!=0) )
		{
			print '<input type="hidden" name="'.$select_name.'" value="'.$select_data.'" />';
		//	print $select_data;
			print '<p class="p_input_box">'.$select_data.'</p>';
		}
	}
	else
	{
	// 入力画面
		
		print "<select name=\"".$name."\" >";
		for( $i=0; isset($select_lst[$i]); $i++)
		{
			$select_msg = "";
			
			if( isset($select_data) )
			{
				if( strcmp($select_data,$select_lst[$i])==0 )
				{
					$select_msg = ' selected="selected"';
				}
			}
			
//			if( $cnt == $i )$select_msg = ' selected="selected"';
			
			print "<option value=\"".$select_lst[$i]."|".$i."\"".$select_msg.">".$select_lst[$i]."</option>";
		}
		print "</select>";
		if( ERR_DISP_INPUT == true && mb_strlen($GLOBALS[_ERR_MAIL_MSG_][$name]) > 0 )
		{
			// print '<p class="p_input_err_select">'.$GLOBALS[_ERR_MAIL_MSG_][$name].'</p>';
		}
	}

	SetErrCss($name,$err);

}

function PrintSelectKen( $name )
{
	if( isset($_POST[$name]) )
	{
		$select_ken = $_POST[$name];
	}
	else
	{
		$select_ken = "";
	}
	$selected_chk = ' selected="selected"';
	
	if( isset($_POST[$name]) && mb_strlen($_POST[$name]) == 0 )
	{
		$select_ken = '--都道府県--';
	}

	// 確認画面
	if( RetMode() == 2 )
	{
		if( strcmp($select_ken,'--都道府県--') == 0 )
		{
			$select_ken = "";
		}
		print '<input type="hidden" name="'.$name.'" id="'.$name.'" value="'.$select_ken.'" />';
//		print $select_ken;
		print '<p class="p_input_box">'.$select_ken.'</p>';
	}
	else
	{
	// 入力画面 
		if( isset($GLOBALS[_ERR_MAIL_MSG_][$name]) )
		{
			if( ERR_DISP_INPUT == true && mb_strlen($GLOBALS[_ERR_MAIL_MSG_][$name]) > 0 )
			{
				print '<p class="p_input_err">'.$GLOBALS[_ERR_MAIL_MSG_][$name].'</p>';
			}
		}

		print "<select name=\"".$name."\" id=\"".$name."\" >";
		print "<option value=\"--都道府県--\"";if($select_ken=='--都道府県--'){print $selected_chk;}print ">--都道府県--</option>";
		print "<option value=\"北海道\"";if($select_ken=='北海道'){print $selected_chk;}print ">北海道</option>";
		print "<option value=\"青森県\"";if($select_ken=='青森県'){print $selected_chk;}print ">青森県</option>";
		print "<option value=\"岩手県\"";if($select_ken=='岩手県'){print $selected_chk;}print ">岩手県</option>";
		print "<option value=\"宮城県\"";if($select_ken=='宮城県'){print $selected_chk;}print ">宮城県</option>";
		print "<option value=\"秋田県\"";if($select_ken=='秋田県'){print $selected_chk;}print ">秋田県</option>";
		print "<option value=\"山形県\"";if($select_ken=='山形県'){print $selected_chk;}print ">山形県</option>";
		print "<option value=\"福島県\"";if($select_ken=='福島県'){print $selected_chk;}print ">福島県</option>";
		print "<option value=\"茨城県\"";if($select_ken=='茨城県'){print $selected_chk;}print ">茨城県</option>";
		print "<option value=\"栃木県\"";if($select_ken=='栃木県'){print $selected_chk;}print ">栃木県</option>";
		print "<option value=\"群馬県\"";if($select_ken=='群馬県'){print $selected_chk;}print ">群馬県</option>";
		print "<option value=\"埼玉県\"";if($select_ken=='埼玉県'){print $selected_chk;}print ">埼玉県</option>";
		print "<option value=\"千葉県\"";if($select_ken=='千葉県'){print $selected_chk;}print ">千葉県</option>";
		print "<option value=\"東京都\"";if($select_ken=='東京都'){print $selected_chk;}print ">東京都</option>";
		print "<option value=\"神奈川県\"";if($select_ken=='神奈川県'){print $selected_chk;}print ">神奈川県</option>";
		print "<option value=\"新潟県\"";if($select_ken=='新潟県'){print $selected_chk;}print ">新潟県</option>";
		print "<option value=\"富山県\"";if($select_ken=='富山県'){print $selected_chk;}print ">富山県</option>";
		print "<option value=\"石川県\"";if($select_ken=='石川県'){print $selected_chk;}print ">石川県</option>";
		print "<option value=\"福井県\"";if($select_ken=='福井県'){print $selected_chk;}print ">福井県</option>";
		print "<option value=\"山梨県\"";if($select_ken=='山梨県'){print $selected_chk;}print ">山梨県</option>";
		print "<option value=\"長野県\"";if($select_ken=='長野県'){print $selected_chk;}print ">長野県</option>";
		print "<option value=\"岐阜県\"";if($select_ken=='岐阜県'){print $selected_chk;}print ">岐阜県</option>";
		print "<option value=\"静岡県\"";if($select_ken=='静岡県'){print $selected_chk;}print ">静岡県</option>";
		print "<option value=\"愛知県\"";if($select_ken=='愛知県'){print $selected_chk;}print ">愛知県</option>";
		print "<option value=\"三重県\"";if($select_ken=='三重県'){print $selected_chk;}print ">三重県</option>";
		print "<option value=\"滋賀県\"";if($select_ken=='滋賀県'){print $selected_chk;}print ">滋賀県</option>";
		print "<option value=\"京都府\"";if($select_ken=='京都府'){print $selected_chk;}print ">京都府</option>";
		print "<option value=\"大阪府\"";if($select_ken=='大阪府'){print $selected_chk;}print ">大阪府</option>";
		print "<option value=\"兵庫県\"";if($select_ken=='兵庫県'){print $selected_chk;}print ">兵庫県</option>";
		print "<option value=\"奈良県\"";if($select_ken=='奈良県'){print $selected_chk;}print ">奈良県</option>";
		print "<option value=\"和歌山県\"";if($select_ken=='和歌山県'){print $selected_chk;}print ">和歌山県</option>";
		print "<option value=\"鳥取県\"";if($select_ken=='鳥取県'){print $selected_chk;}print ">鳥取県</option>";
		print "<option value=\"島根県\"";if($select_ken=='島根県'){print $selected_chk;}print ">島根県</option>";
		print "<option value=\"岡山県\"";if($select_ken=='岡山県'){print $selected_chk;}print ">岡山県</option>";
		print "<option value=\"広島県\"";if($select_ken=='広島県'){print $selected_chk;}print ">広島県</option>";
		print "<option value=\"山口県\"";if($select_ken=='山口県'){print $selected_chk;}print ">山口県</option>";
		print "<option value=\"徳島県\"";if($select_ken=='徳島県'){print $selected_chk;}print ">徳島県</option>";
		print "<option value=\"香川県\"";if($select_ken=='香川県'){print $selected_chk;}print ">香川県</option>";
		print "<option value=\"愛媛県\"";if($select_ken=='愛媛県'){print $selected_chk;}print ">愛媛県</option>";
		print "<option value=\"高知県\"";if($select_ken=='高知県'){print $selected_chk;}print ">高知県</option>";
		print "<option value=\"福岡県\"";if($select_ken=='福岡県'){print $selected_chk;}print ">福岡県</option>";
		print "<option value=\"佐賀県\"";if($select_ken=='佐賀県'){print $selected_chk;}print ">佐賀県</option>";
		print "<option value=\"長崎県\"";if($select_ken=='長崎県'){print $selected_chk;}print ">長崎県</option>";
		print "<option value=\"熊本県\"";if($select_ken=='熊本県'){print $selected_chk;}print ">熊本県</option>";
		print "<option value=\"大分県\"";if($select_ken=='大分県'){print $selected_chk;}print ">大分県</option>";
		print "<option value=\"宮崎県\"";if($select_ken=='宮崎県'){print $selected_chk;}print ">宮崎県</option>";
		print "<option value=\"鹿児島県\"";if($select_ken=='鹿児島県'){print $selected_chk;}print ">鹿児島県</option>";
		print "<option value=\"沖縄県\"";if($select_ken=='沖縄県'){print $selected_chk;}print ">沖縄県</option>";
		print "</select>";
	}
}

function MakeFileMsg( $file )
{
	$contents = @file($file);
	$msg = "";
	foreach($contents as $line){
		$valchk = 0;
		for($i=0; $GLOBALS['set_items'][$i]!=NULL; $i++)
		{
			$rep = "<$".$GLOBALS['set_items'][$i][_NAME].">";
			$list = $_POST[$GLOBALS['set_items'][$i][_NAME]];
			if( is_array($list) === false )
			{
				$conv = mb_convert_kana($list, 'aKV');
				$line = str_replace( $rep, $conv, $line );
			}
			else
			{
				$lst = "";
				for($j=0; $list[$j]!=NULL; $j++)
				{
					$conv = mb_convert_kana($list[$j], 'aKV');
					$lst .= $conv."\n";
				}
				$line = str_replace( $rep, $lst, $line );
			}
		}
		
		$msg .= $line;
	}
	
	return $msg;
}
function PrintFileImg( $name, $set, $btn, $exp, $thumbnamil_id = "", $filename_id = "" )
{
	// 確認画面
	$f_exp = "file_exp_".$name;
	$f_id = "file_id_".$name;
	$f_del = "file_delflag_".$name;

	$sess = $GLOBALS["_sess_"];

	if( RetMode() == PAGE_CHECK )
	{
		if( intval($_POST[$f_del]) )
		{
			unset($_SESSION[$sess][$name]);
		}

		if ($_POST['from_canvas640'] != '') {
			$_SESSION[$sess][$name]["base64"] = $_POST['from_canvas640'];
		}

		$filedata = $_SESSION[$sess][$name];
	}
	else
	{
		// 入力画面
		if( isset( $_POST['amend_btn'] ) || strcmp($_POST[ $GLOBALS['sets']['mode_name'].'_btn'],"amend") == 0 )
		{
			// print "<pre style='background: #fff;'>";
			// print_r($_POST);
			// print "</pre>";
			if ($_POST['from_canvas640'] != '') {
				$_SESSION[$sess][$name]["base64"] = $_POST['from_canvas640'];
			}
			$filedata = $_SESSION[$sess][$name];
		}
		else if( intval($_POST[$f_del]) || !isset($_POST[$f_del]) )
		{
			unset($_SESSION[$sess][$name]);
		}
		else if( $_FILES[$name]['size'] > 0 )
		{
			$filedata = $_FILES[$name];
			$filedata["base64"] = base64_encode(file_get_contents($_FILES[$name]["tmp_name"]));
			if ($_POST['from_canvas640'] != '') {
				$filedata["base64"] = $_POST['from_canvas640'];
			}
			$_SESSION[$sess][$name] = $filedata;
		}
		else
		{
			if ($_POST['from_canvas640'] != '') {
				$_SESSION[$sess][$name]["base64"] = $_POST['from_canvas640'];
			}
			$filedata = $_SESSION[$sess][$name];
		}

		print '<input type="hidden" name="'.$f_exp.'" value="'.$exp.'" />';
		print '<input type="hidden" name="'.$f_del.'" class="del_flag" value="" />';
		print "<input name=\"".$name."\" ".$set." type=\"file\" id=\"".$f_id."\" /><label for=\"".$f_id."\" ".$set.">".$btn."</label>\n";
	}

//	print_r($_SESSION[$sess][$name]);
//	print_r($_FILES[$name]);

/*
//	print $thumbnamil_id." -- ".mb_substr($filedata["base64"],0,10);
	if( mb_strlen($thumbnamil_id) && mb_strlen($filedata["base64"]) )
	{
		$src = "data:".$filedata["type"].";base64,".$filedata["base64"];
//		print $src;
		print "<script>\n";
//		print 'var tmp_img = "'.$src.'";'."\n\n"; 
		print "$(document).ready(function(){\n";
//		print '$("#'.$thumbnamil_id.'").attr("src",tmp_img);'."\n";
		print '$("#'.$thumbnamil_id.'").html(\'<img src="'.$src.'" class="object-fit">\');';
		print "});\n";
		print "</script>\n";

//		print '<img src="'.$src.'">';
	}
*/
	$jq = "";
	/*
	if( mb_strlen($thumbnamil_id) && mb_strlen($filedata["base64"]) )
	{
		$src = "data:".$filedata["type"].";base64,".$filedata["base64"];
//		$jq .= '$("#'.$thumbnamil_id.'").html(\'<img src="'.$src.'" class="object-fit">\');'."\n";
		$jq .= 'var tmp_src = \'<img src="'.$src.'" class="object-fit">\';'."\n";
		$jq .= '$("#'.$thumbnamil_id.'").html(tmp_src);'."\n";
	}
	*/
	if( mb_strlen($filename_id) && mb_strlen($filedata["base64"]) )
	{
		$jq .= '$("#'.$filename_id.'").text("'.$filedata["name"].'");'."\n";
	}

	if( mb_strlen($jq) )
	{
		print "<script>\n";
		print "$(document).ready(function(){\n";
		print $jq;
		print "});\n";
		print "</script>\n";
	}
}



function SendMail( $to, $from_msg, $from_mail, $subject, $body, $env_from = "" )
{
	if( mb_strlen($to) == 0 )return 1;
	if( mb_strlen($from_msg) == 0 )return 2;
	if( mb_strlen($from_mail) == 0 )return 3;
	if( mb_strlen($subject) == 0 )return 4;
	if( mb_strlen($body) == 0 )return 5;

//	$before[] = array( "㈱", "㈲" );
//	$after[] = array( "(株)", "(有)" );
	
//	$body_str = str_replace($before, $after, $body );
	$body_str = $body;
	
//	mb_language("Japanese");
//	mb_internal_encoding("SJIS");
	mb_language("uni");
	mb_internal_encoding("utf8");

//	$re_subject = mb_convert_encoding($subject,"sjis","utf8");
	$re_subject = $subject;
	// 自社宛メール
//	$from_str	= mb_encode_mimeheader(mb_convert_encoding($from_msg,"sjis"))."<".$from_mail.">\n";
//	$from_str	= mb_encode_mimeheader(mb_convert_encoding($from_msg,"sjis","utf8"))."<".$from_mail.">\n";
//	$from_str	= mb_encode_mimeheader(mb_convert_encoding($from_msg,"JIS","SJIS"))."<".$from_mail.">\n";
	$from_str	= mb_encode_mimeheader($from_msg)."<".$from_mail.">\n";
	$heady  = "From:" .$from_str;
	
	if( mb_strlen($env_from) == 0 )
	{
		$env_from = $from_mail;
	}

	$env_from = "-f".$env_from;

	$body_str = stripslashes($body_str);
//	$body_str = mb_convert_encoding($body_str,"JIS","EUC-JP");
	// $body_str = mb_convert_encoding($body_str,"sjis","utf8");
	// print 'to:'.$to.'<br>';
	// print 're_subject:'.$re_subject.'<br>';
	// print 'body_str:'.$body_str.'<br>';
	// print 'heady:'.$heady.'<br>';
	// print 'env_from:'.$env_from.'<br>';
	// exit;
	if( mb_send_mail($to, $re_subject, $body_str, $heady, $env_from) === false )
	// if( mail($to, $re_subject, $body_str, $heady, $env_from) === false )
	{
		return 6;
	}
	
	return 0;
}

function SetForm( $formset )
{
//	mb_language("Japanese");
//	mb_language("uni");
//	mb_internal_encoding("UTF-8");
	
	$str = str_replace(" ", "", $formset );
	if( mb_strpos($str, 'name="') === false ){return false;}
	$pos = mb_strpos($str, 'name="') + mb_strlen('name="');
	$str2 = mb_substr( $str, $pos ); 
	$namestr = mb_substr( $str2, 0, mb_strpos($str2,'"') );
	$GLOBALS['set_form'] = $namestr;
	
	
	$pos = strrpos($_SERVER['PHP_SELF'], "/");
	if ($pos === false) {
		$pos = 0;
	}
	else
	{
		$pos++;
	}
	$php_self = mb_substr( $_SERVER['PHP_SELF'], $pos );
	$GLOBALS['sets']['php'] = $php_self;
	
	$php_self_mode = str_replace(".php", "_mode", $_SERVER['PHP_SELF']);
	$pos = strrpos($php_self_mode, "/");
	if ($pos === false) {
		$pos = 0;
	}
	else
	{
		$pos++;
	}
	$php_self = mb_substr( $php_self_mode, $pos );

	if( mb_strpos($str, 'action="') === false )
	{
		$GLOBALS['sets']['action'] = "";
	}else{
		$pos = mb_strpos($str, 'action="') + mb_strlen('action="');
		$str2 = mb_substr( $str, $pos ); 
		$namestr = mb_substr( $str2, 0, mb_strpos($str2,'"') );
		$GLOBALS['sets']['action'] = $namestr;
	}

	$GLOBALS['sets']['form'] = $GLOBALS['set_form'];
	$GLOBALS['sets']['mode_name'] = $php_self;
		
	if( !isset($GLOBALS['sets']['mode_val']) )
	{
		$GLOBALS['sets']['mode_val'] = PAGE_INIT;
	}
	
	print "<form ".$formset.">\n";
	
	SetError();

	print '<input type="hidden" id="'.$GLOBALS['sets']['mode_name'].'" name="'.$GLOBALS['sets']['mode_name'].'" value="'.$GLOBALS['sets']['mode_val'].'" />'."\n";
//	print '<input type="hidden" id="'.$GLOBALS['sets']['mode_name'].'_btn" name="'.$GLOBALS['sets']['mode_name'].'_btn" value="'.$_POST[$GLOBALS['sets']['mode_name'].'_btn'].'" />'."\n";
	print '<input type="hidden" id="'.$GLOBALS['sets']['mode_name'].'_btn" name="'.$GLOBALS['sets']['mode_name'].'_btn" value="" />'."\n";
}


function SetFormEnd()
{
	print "<script type=\"text/javascript\">\n".$GLOBALS['end_script']."</script>";
	print $GLOBALS['end_body'];
	print "\n</form>";
}

function RetErrMsg( $name, $tag = '', $class = '' ){
	$str = $GLOBALS[_ERR_MAIL_MSG_][$name];
	/*
	for($i=0; $i<count($GLOBALS[_ERR_MAIL_]); $i++ )
	{
		if( strcmp($GLOBALS[_ERR_MAIL_][$i]['name'],$name) == 0 )
		{
			$str = $GLOBALS[_ERR_MAIL_][$i]['msg'];
		}
	}
	*/
	if( mb_strlen($tag) > 0 )
	{
		if( mb_strlen($class) > 0 )
		{
			$str = '<'.$tag.' class="'.$class.'">'.$str.'</'.$tag.'>';
		}
		else
		{
			$str = '<'.$tag.'>'.$str.'</'.$tag.'>';
		}
	}
	
	return $str;
}

function SetErrCss($name,$str){
	if( mb_strlen($str) > 0 )
	{
		for($i=0; $i<count($GLOBALS[_ERR_MAIL_]); $i++ )
		{
			if( strcmp($GLOBALS[_ERR_MAIL_][$i]['name'],$name) == 0 )
			{
				$GLOBALS[_ERR_MAIL_][$i]['css'] = $str;
			}
		}
	}
}

function PrintErrCss(){
	$str = "";
	for($i=0; $i<count($GLOBALS[_ERR_MAIL_]); $i++ )
	{
		if( mb_strlen($GLOBALS[_ERR_MAIL_][$i]['css']) > 0 )
		{
//			$str .= $GLOBALS[_ERR_MAIL_][$i]['css']."{ background-color:"._ERR_MAIL_BACKGROUND_COLOR.";}\n";
			$str .= $GLOBALS[_ERR_MAIL_][$i]['css']."\n";
		}
	}
	return "<style>\n".$str."\n</style>";
}

// function SendMailTemp( $to_org, $from_msg, $from_mail, $subject2, $body_msg, $file_name )
// {
// 	if( is_array( $to_org ) )
// 	{
// 		$mail_lst = $to_org;
// 	}
// 	else
// 	{
// 		$mail_lst[0] = $to_org;
// 	}
// 	if( mb_strlen($mail_lst[0]) == 0 )return 1;
// 	if( mb_strlen($to_org) == 0 )return 1;
// 	if( mb_strlen($from_msg) == 0 )return 2;
// 	if( mb_strlen($from_mail) == 0 )return 3;
// 	if( mb_strlen($subject2) == 0 )return 4;
// 	if( mb_strlen($body_msg) == 0 )return 5;
	
// //	mb_language("uni");
// //	mb_internal_encoding("UTF-8");
	
// 	$from_name = $from_msg;
// 	$from_address = $from_mail;
// 	$subject = $subject2;
// 	$message = $body_msg;
// 	$boundary = md5(uniqid(rand()));

// //$from_name = "てすと";
// //$from_address = "webtest2@sc-scc.com";
// //$subject = "添付メール";
// //$message = "これは添付メールのテストです。";
// //$boundary = "simple_boundary";
// //$filename = "1.jpg";
	
// 	$mime_type = "application/octet-stream";

// 	unset($up);
	
// 	if( strstr($file_name,",") === false )
// 	{
// 		$file_lst[] = $file_name;
// 	}
// 	else
// 	{
// 		$file_lst = split(",",$file_name);
// 	}
	
// 	$file_num = 0;
// 	for($i=0; $i<count($file_lst); $i++)
// 	{
// 		$fname_tmp = $file_lst[$i];
// 		$h_name = $fname_tmp."_name";
// 		$h_type = $fname_tmp."_type";
// 		$h_tmp = $fname_tmp."_tmp_name";
// 		$h_size = $fname_tmp."_size";
// 		$h_upname = $fname_tmp."_upname";
	
		
// 		for($j=0; count($_POST[$h_name])>$j; $j++ )
// 		{
// 			$up[$file_num]['tmp_name']	= $_POST[$h_tmp][$j];
// 			$up[$file_num]['name']		= $_POST[$h_name][$j];
		
// 			$up[$file_num]['filename']	= $up[$file_num]['name'];
// 			$up[$file_num]['upname']	= $_POST[$h_upname][$j];
// 			$up[$file_num]['size']		= $_POST[$h_size][$j];
			
			
// 			if(file_exists($_POST[$h_upname][$j])) {
// 			}else {
// 				return 7;
// 			}
			
// 			$file_num++;
// 		}
// 	}

// 	// 通常はこちら（標準だが特殊文字が出ない)		
// 	define(ENC_STR,"ISO-2022-JP");
// 	define(ENC_STR2,"Shift-JIS");
// 	define(ENC_MAIL,"ISO-2022-JP");
// /*
// 	define(ENC_STR,"UTF-8");
// 	define(ENC_STR2,"UTF-8");
// 	define(ENC_MAIL,"UTF-8");
// */
	
// 	// 件名のエンコード
// 	$subject = mb_convert_encoding($subject,"SJIS");	//mb_convert_encoding($subject, ENC_MAIL);
	
// 	// 本文のエンコード
// //	$message = mb_convert_encoding($message, 'ISO-2022-JP', ENC_STR);
// 	$message = mb_convert_encoding($message, ENC_STR, ENC_STR2);
// //	$message .= $testmsg;
	
	
// 	for($i=0;$i<count($mail_lst);$i++)
// 	{
// 		$pos = strpos($mail_lst[$i],MAIL_HEAD_CC);
// 		if( $pos !== false && $pos == 0 )
// 		{
// 			$address = substr($mail_lst[$i], strlen(MAIL_HEAD_CC));
// 			if( strlen($CC) > 0 )
// 			{
// 				$CC .= ",";
// 			}
// 			$CC .= $address;
// 		}
// 		else
// 		{
// 			$pos = strpos($mail_lst[$i],MAIL_HEAD_BCC);
// 			if( $pos !== false && $pos == 0 )
// 			{
// 				$address = substr($mail_lst[$i], strlen(MAIL_HEAD_BCC));
// 				if( strlen($BCC) > 0 )
// 				{
// 					$BCC .= ",";
// 				}
// 				$BCC .= $address;
// 			}
// 			else
// 			{
// 				if (preg_match('^[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+'.'@'.'[-!#$%&\'*+\\/0-9=?A-Z^_`a-z{|}~]+\.'.'[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+$', $mail_lst[$i]))
// 				{
// 					if( strlen($to_lst) > 0 )$to .= ",";
// 					$to_lst .= $mail_lst[$i];
// 				}
// 			}
// 		}
// 	}
	
// 	// toをエンコード
// 	$to = mb_convert_encoding($to_lst, ENC_STR);
// 	$to = "=?".ENC_MAIL."?B?" . base64_encode($to) . '?= <' . $to_lst . '>';

// 	// fromをエンコード
// 	$from = mb_convert_encoding($from_name, ENC_STR);
// 	$from = "=?".ENC_MAIL."?B?" . base64_encode($from) . '?= <' . $from_address . '>';
// 	//bcc
// //	$from .= "\nbcc:m_tochizawa@sc-scc.com";	
// 	if( strlen($CC)  > 0 )$from .= "\n".MAIL_HEAD_CC.$CC;
// 	if( strlen($BCC) > 0 )$from .= "\n".MAIL_HEAD_BCC.$BCC;
	
	
// 	// ヘッダーの指定
// 	$header = '';
// 	$header .= "From: {$from}\n";
// 	$header .= "MIME-Version: 1.0\n";
// 	$header .= "Content-Type: multipart/mixed; boundary=\"{$boundary}\"\n";
// 	$header .= "Content-Transfer-Encoding: 7bit";
	
// 	$msg = '';
	
// 	// 本文
// 	$msg .= "--{$boundary}\n";
// //	$msg .= "Content-Type: text/plain; charset=ISO-2022-JP\n" .
// //			  "Content-Transfer-Encoding: 7bit\n";
// 	$msg .= "Content-Type: text/plain; charset=".ENC_MAIL."\n" .
// 			  "Content-Transfer-Encoding: 7bit\n";
// 	$msg .= "\n";
// 	$msg .= "{$message}\n{$testmsg}\n";

// 	for($i=0;$i<count($up);$i++)
// 	{
// 		if($up[$i]['size']-0 > 0)
// 		{
// 			// 添付ファイルのエンコード
// 			$attach_file = file_get_contents($up[$i]['upname']); // ファイルを開く
// 			$attach_file = chunk_split(base64_encode($attach_file), 76, "\n"); // Base64に変換し76Byte分割
// 			$filename = mb_convert_encoding($up[$i]['name'], ENC_STR, ENC_STR2);
// 			$up_name = $filename;
// 			$filename = "=?".ENC_MAIL."?B?" . base64_encode($filename) . "?=";
			
// 			// 添付ファイルの処理
// 			$msg .= "--{$boundary}\n";
// 			$msg .= "Content-Type: {$mime_type}; name=\"{$up_name}\"\n" .
// 					 "Content-Transfer-Encoding: base64\n" .
// 					 "Content-Disposition: attachment; filename=\"{$up_name}\"\n";
// 			$msg .= "\n";
// 			$msg .= "{$attach_file}\n\n";
			
// 			// 削除
// 			unlink($up[$i]['upname']);
// 		}
// 	}

// 	// マルチパートの終了
// 	$msg .= "--$boundary--\n";
// 	//////////////////////////
	

// 	// 携帯文字化け対応
	
// 	$encoding = mb_detect_encoding($body, "SJIS,EUC-JP,JIS,UTF-8");
// 	if ($encoding != "JIS") {
// 	$subject = mb_convert_encoding($subject, "JIS", $encoding);
// //	$body = mb_convert_encoding($body, "JIS", $encoding);
// 	}
	
	
// //	$subject = mb_convert_encoding($subject, "JIS", $encoding);
// 	$subject = base64_encode($subject);
// 	$subject = '=?ISO-2022-JP?B?' . $subject . '?=';
// 	// 携帯文字化け対応　END
	
// 	$msg = mb_convert_encoding($msg, ENC_STR);
// 	print $msg;
// 	exit;

// 	if (mail($to, $subject, $msg, $header)) {
// 		return 0;
// 	} else {
// 		return 6;
// 	}
	
// 	return 0;
// }


function SendMailTemp( $to_org, $from_msg, $from_mail, $subject2, $body_msg, $file_name )
{
	if( is_array( $to_org ) )
	{
		$mail_lst = $to_org;
	}
	else
	{
		$mail_lst[0] = $to_org;
	}
	if( strlen($mail_lst[0]) == 0 )return 1;
	if( strlen($to_org) == 0 )return 1;
	if( strlen($from_msg) == 0 )return 2;
	if( strlen($from_mail) == 0 )return 3;
	if( strlen($subject2) == 0 )return 4;
	if( strlen($body_msg) == 0 )return 5;
	
//	mb_language("uni");
//	mb_internal_encoding("UTF-8");
	
	$from_name = $from_msg;
	$from_address = $from_mail;
	$subject = $subject2;
	$message = $body_msg;
	$boundary = md5(uniqid(rand()));

//$from_name = "てすと";
//$from_address = "webtest2@sc-scc.com";
//$subject = "添付メール";
//$message = "これは添付メールのテストです。";
//$boundary = "simple_boundary";
//$filename = "1.jpg";
	
	$mime_type = "application/octet-stream";

	unset($up);
	
	if( strstr($file_name,",") === false )
	{
		$file_lst[] = $file_name;
	}
	else
	{
		$file_lst = explode(",",$file_name);
	}
	
	/*
	$file_num = 0;
	for($i=0; $i<count($file_lst); $i++)
	{
		$fname_tmp = $file_lst[$i];
		$h_name = $fname_tmp."_name";
		$h_type = $fname_tmp."_type";
		$h_tmp = $fname_tmp."_tmp_name";
		$h_size = $fname_tmp."_size";
		$h_upname = $fname_tmp."_upname";
	
		
		for($j=0; count($_POST[$h_name])>$j; $j++ )
		{
			$up[$file_num]['tmp_name']	= $_POST[$h_tmp][$j];
			$up[$file_num]['name']		= $_POST[$h_name][$j];
		
			$up[$file_num]['filename']	= $up[$file_num]['name'];
			$up[$file_num]['upname']	= $_POST[$h_upname][$j];
			$up[$file_num]['size']		= $_POST[$h_size][$j];
			
			
			if(file_exists($_POST[$h_upname][$j])) {
			}else {
				return 7;
			}
			
			$file_num++;
		}
	}
	*/

/*
	// 通常はこちら（標準だが特殊文字が出ない)		
	define(ENC_STR,"ISO-2022-JP");
	define(ENC_STR2,"Shift-JIS");
	define(ENC_MAIL,"ISO-2022-JP");
*/
	define(ENC_STR,"UTF-8");
	define(ENC_STR2,"UTF-8");
	define(ENC_MAIL,"UTF-8");
	
	// 件名のエンコード
	$subject = mb_convert_encoding($subject,"SJIS");	//mb_convert_encoding($subject, ENC_MAIL);
	
	// 本文のエンコード
//	$message = mb_convert_encoding($message, 'ISO-2022-JP', ENC_STR);
//	$message = mb_convert_encoding($message, ENC_STR, ENC_STR2);
//	$message .= $testmsg;
	
	
	for($i=0;$i<count($mail_lst);$i++)
	{
		$pos = strpos($mail_lst[$i],MAIL_HEAD_CC);
		if( $pos !== false && $pos == 0 )
		{
			$address = substr($mail_lst[$i], strlen(MAIL_HEAD_CC));
			if( strlen($CC) > 0 )
			{
				$CC .= ",";
			}
			$CC .= $address;
		}
		else
		{
			$pos = strpos($mail_lst[$i],MAIL_HEAD_BCC);
			if( $pos !== false && $pos == 0 )
			{
				$address = substr($mail_lst[$i], strlen(MAIL_HEAD_BCC));
				if( strlen($BCC) > 0 )
				{
					$BCC .= ",";
				}
				$BCC .= $address;
			}
			else
			{
//					(^[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+'.'@'.'[-!#$%&\'*+\\/0-9=?A-Z^_`a-z{|}~]+\.'.'[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+$
//				if (preg_match('^[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+'.'@'.'[-!#$%&\'*+\\/0-9=?A-Z^_`a-z{|}~]+\.'.'[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+$', $mail_lst[$i]))
				if ((!preg_match('(^[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+'.'@'.'[-!#$%&\'*+\\/0-9=?A-Z^_`a-z{|}~]+\.'.'[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+$)', $mail_lst[$i])) && ($mail_lst[$i] != "newuser@localhost")) {
				}
				else
				{
					if( strlen($to_lst) > 0 )$to .= ",";
					$to_lst .= $mail_lst[$i];
				}
			}
		}
	}
	
	// toをエンコード
	$to = mb_convert_encoding($to_lst, ENC_STR);
	$to = "=?".ENC_MAIL."?B?" . base64_encode($to) . '?= <' . $to_lst . '>';

	// fromをエンコード
	$from = mb_convert_encoding($from_name, ENC_STR);
	$from = "=?".ENC_MAIL."?B?" . base64_encode($from) . '?= <' . $from_address . '>';
	//bcc
//	$from .= "\nbcc:m_tochizawa@sc-scc.com";	
	if( strlen($CC)  > 0 )$from .= "\n".MAIL_HEAD_CC.$CC;
	if( strlen($BCC) > 0 )$from .= "\n".MAIL_HEAD_BCC.$BCC;
	
	
	// ヘッダーの指定
	$header = '';
	$header .= "From: {$from}\n";
	$header .= "MIME-Version: 1.0\n";
	$header .= "Content-Type: multipart/mixed; boundary=\"{$boundary}\"\n";
	$header .= "Content-Transfer-Encoding: 7bit";
	
	$msg = '';
	
	// 本文
	$msg .= "--{$boundary}\n";
//	$msg .= "Content-Type: text/plain; charset=ISO-2022-JP\n" .
//			  "Content-Transfer-Encoding: 7bit\n";
	$msg .= "Content-Type: text/plain; charset=".ENC_MAIL."\n" .
			  "Content-Transfer-Encoding: 7bit\n";
	$msg .= "\n";
	$msg .= "{$message}\n{$testmsg}\n";

	/*
	for($i=0;$i<count($up);$i++)
	{
		if($up[$i]['size']-0 > 0)
		{
			// 添付ファイルのエンコード
			$attach_file = file_get_contents($up[$i]['upname']); // ファイルを開く
			$attach_file = chunk_split(base64_encode($attach_file), 76, "\n"); // Base64に変換し76Byte分割
			$filename = mb_convert_encoding($up[$i]['name'], ENC_STR, ENC_STR2);
			$up_name = $filename;
			$filename = "=?".ENC_MAIL."?B?" . base64_encode($filename) . "?=";
			
			// 添付ファイルの処理
			$msg .= "--{$boundary}\n";
			$msg .= "Content-Type: {$mime_type}; name=\"{$up_name}\"\n" .
					 "Content-Transfer-Encoding: base64\n" .
					 "Content-Disposition: attachment; filename=\"{$up_name}\"\n";
			$msg .= "\n";
			$msg .= "{$attach_file}\n\n";
			
			// 削除
//			unlink($up[$i]['upname']);
		}
	}
	*/

	// print "<pre style='background: #fff;'>";
	// print_r($file_lst);
	// print "</pre>";

	// print "<pre style='background: #fff;'>";
	// print_r($_SESSION);
	// print "</pre>";
	// exit;

	for($i=0;$i<count($file_lst);$i++)
	{
		// if( $_SESSION[$GLOBALS["_sess_"]][$file_lst[$i]]["size"] > 0)
		if( $_SESSION[$GLOBALS["_sess_"]][$file_lst[$i]]["base64"] != '')
		{
			// 添付ファイルのエンコード
//			$attach_file = file_get_contents($up[$i]['upname']); // ファイルを開く
			$attach_file = chunk_split($_SESSION[$GLOBALS["_sess_"]][$file_lst[$i]]["base64"], 76, "\n"); // Base64に変換し76Byte分割
			// $filename = mb_convert_encoding($_SESSION[$GLOBALS["_sess_"]][$file_lst[$i]]['name'], ENC_STR, ENC_STR2);
			$filename = mb_convert_encoding('form_img.jpg', ENC_STR, ENC_STR2);
			$up_name = $filename;
			$filename = "=?".ENC_MAIL."?B?" . base64_encode($filename) . "?=";
			
			// 添付ファイルの処理
			$msg .= "--{$boundary}\n";
			$msg .= "Content-Type: {$mime_type}; name=\"{$up_name}\"\n" .
					 "Content-Transfer-Encoding: base64\n" .
					 "Content-Disposition: attachment; filename=\"{$up_name}\"\n";
			$msg .= "\n";
			$msg .= "{$attach_file}\n\n";
			
			// 削除
//			unlink($up[$i]['upname']);
		}
	}

	// マルチパートの終了
	$msg .= "--$boundary--\n";
	//////////////////////////
	

	// 携帯文字化け対応
	
	$encoding = mb_detect_encoding($body, "SJIS,EUC-JP,JIS,UTF-8");
	if ($encoding != "JIS") {
	$subject = mb_convert_encoding($subject, "JIS", $encoding);
//	$body = mb_convert_encoding($body, "JIS", $encoding);
	}
	
	
//	$subject = mb_convert_encoding($subject, "JIS", $encoding);
	$subject = base64_encode($subject);
	$subject = '=?ISO-2022-JP?B?' . $subject . '?=';
	// 携帯文字化け対応　END
	
	$msg = mb_convert_encoding($msg, ENC_STR);
	if (mail($to, $subject, $msg, $header)) {
		return 0;
	} else {
		return 6;
	}
	
	return 0;
}



function WriteMsgFile( $name, $msg )
{
	$mode = file_exists($name) ? "a" : "w";
	
	$fp = @fopen($name,$mode) or die("File open error.");
	stream_set_write_buffer($fp, 0);
	
	flock($fp,LOCK_EX);

	$str ="";

	if( is_array($msg) )
	{
		foreach($msg as $val)
		{
			$str .= $val."/";
		}	
	}
	else
	{
		$str = $msg;
	}
	
	$str .= "\n";
	
	fwrite($fp,$str);
	
	flock($fp, LOCK_UN);
	fclose($fp);
}


function unhtmlentities ($string)
{
    $trans_tbl = get_html_translation_table (HTML_ENTITIES);
    $trans_tbl = array_flip ($trans_tbl);
    return strtr ($string, $trans_tbl);
}


define( "DATE_SYS", "" );
function date_sys( $format, $timestamp = "" )
{
	if( mb_strlen($timestamp) == 0 )$timestamp = time();
	
	if( mb_strlen(DATE_SYS) == 0 )
	{
		return date($format, $timestamp);
	}
	else
	{
		return date($format, DATE_SYS );
	}
}

function date_sys_timestamp()
{
	$str = sprintf( "%04d-%02d-%02d 00:00:00", date_sys("Y"), date_sys("n"), date_sys("d") );
	return strtotime( $str );
}

function RetHtmlEncode($str, $encode="")
{
//	$str = stripslashes($str);
	
	if( mb_strlen($encode) > 0 )
	{
		return htmlentities($str, ENT_QUOTES, $encode);
	}
	else
	{
		return htmlentities($str, ENT_QUOTES, "UTF-8");
	}
}

function RetHtmlDecode($str)
{
	return html_entity_decode($str, ENT_QUOTES);
}

//ob_start();


function ReplaceFlush()
{
	$out = ob_get_contents();
	
	ob_end_clean();
	
	return $out;
}


function isValidEmailFormat($email, $supportPeculiarFormat = true){
    $wsp              = '[\x20\x09]'; // 半角空白と水平タブ
    $vchar            = '[\x21-\x7e]'; // ASCIIコードの ! から ~ まで
    $quoted_pair      = "\\\\(?:{$vchar}|{$wsp})"; // \ を前につけた quoted-pair 形式なら \ と " が使用できる
    $qtext            = '[\x21\x23-\x5b\x5d-\x7e]'; // $vchar から \ と " を抜いたもの。\x22 は " , \x5c は \
    $qcontent         = "(?:{$qtext}|{$quoted_pair})"; // quoted-string 形式の条件分岐
    $quoted_string    = "\"{$qcontent}+\""; // " で 囲まれた quoted-string 形式。
    $atext            = '[a-zA-Z0-9!#$%&\'*+\-\/\=?^_`{|}~]'; // 通常、メールアドレスに使用出来る文字
    $dot_atom         = "{$atext}+(?:[.]{$atext}+)*"; // ドットが連続しない RFC 準拠形式をループ展開で構築
    $local_part       = "(?:{$dot_atom}|{$quoted_string})"; // local-part は dot-atom 形式 または quoted-string 形式のどちらか
    // ドメイン部分の判定強化
    $alnum            = '[a-zA-Z0-9]'; // domain は先頭英数字
    $sub_domain       = "{$alnum}+(?:-{$alnum}+)*"; // hyphenated alnum をループ展開で構築
    $domain           = "(?:{$sub_domain})+(?:[.](?:{$sub_domain})+)+"; // ハイフンとドットが連続しないように $sub_domain をループ展開
    $addr_spec        = "{$local_part}[@]{$domain}"; // 合成
    // 昔の携帯電話メールアドレス用
    $dot_atom_loose   = "{$atext}+(?:[.]|{$atext})*"; // 連続したドットと @ の直前のドットを許容する
    $local_part_loose = $dot_atom_loose; // 昔の携帯電話メールアドレスで quoted-string 形式なんてあるわけない。たぶん。
    $addr_spec_loose  = "{$local_part_loose}[@]{$domain}"; // 合成
    // 昔の携帯電話メールアドレスの形式をサポートするかで使う正規表現を変える
    if($supportPeculiarFormat){
        $regexp = $addr_spec_loose;
    }else{
        $regexp = $addr_spec;
    }
    // \A は常に文字列の先頭にマッチする。\z は常に文字列の末尾にマッチする。
    if(preg_match("/\A{$regexp}\z/", $email)){
        return true;
    }else{
        return false;
    }
}

?>