<?php
/* プログラム名		：error.php
 * プログラム説明	：エラー画面の作成
 * 作成日時			：2024/05/28
 * 作成者			：井出愛美
 */

//各ファイルから送られてくるエラーメッセージを$errMsgに格納
$errMsg = $_GET['errMsg'];
//各ファイルから送られてくるパス情報を$pathに格納
$path = $_GET['path'];

?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Style-Type" content="text/css" />
		<title>エラー画面</title>
	</head>
	<body>
		<div style="background-color:darkblue;padding:3px;">	
			<h1 align="center" style="margin-top: 21px;color:#fff;">お問い合わせシステム</h1>
		</div>
		
		<div align="center">
			<h2>●●エラー●●</h2>
			<br>
			<br>
			<?=urldecode($errMsg)?>
			<br>
			<br>
			<br>
			<br>
			<?php if($path == "contactForm.php"){?>
		    [<a href="<?=$path?>">お問い合わせフォームへ戻る</a>]
			<?php }elseif($path == "contactList.php"){?>
			[<a href="<?=$path?>">お問い合わせ一覧へ戻る</a>]
			<?php }elseif($path == "passwordChange.php"){?>
			[<a href="<?=$path?>">パスワード変更へ戻る</a>]
			<?php }else{?>
			[<a href="<?=$path?>">ログアウトする</a>]
			<?php }?>
		</div>
	</body>
</html>

