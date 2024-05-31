<?php
/* プログラム名：logout.php
 * プログラム説明：ログアウト画面の作成
 * 作成日時：2024/05/28
 * 作成者：井出愛美
 */
session_start();

// ユーザー情報の削除
unset($_SESSION['userInfo']);
session_destroy();



?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Style-Type" content="text/css" />
		<title>ContactList</title>
		<style>
        body {
        background-color:#eee;
        }
        .white-area {
        background-color:#fff;
        padding:20px 60px 40px 60px;
        display:inline-block;
        border-radius: 10px;
        }
        .main-area {
        display:flex;
        justify-content:center;
        align-items:center;
        }
        </style>
	</head>
	<body>
<header>
	<div style="background-color:darkblue;padding:3px;">	
		<h1 align="center" style="margin-top: 21px;color:#fff;">お問い合わせシステム</h1>
	</div>
	<div  style="position:relative;border-bottom:solid 3px darkBlue;height:80px;padding:3px;background-color:#fff;">
		<div style="position:absolute;top:8px;left:20px;">
		</div>
		<h2 align="center" style="color:black;">ログアウト</h2>
	</div>
	</header>
	<div align="center">
<br>
<br>
<br>
<br>

<div class="main-area">
<div class="white-area" align="center">
<h4>ログアウトしました。</h4><br>
<a href="login.php">[ログイン画面へ戻る]</a>
</div>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
	<!-- フッター -->
	<footer>
	<hr align="center" size="3" color="darkBlue"></hr>
    	<table align="center" width="950">
    		<tr>
    			<td>copyright (c) 2024 all rights reserved.</td>
    		</tr>
    	</table>
	</footer>
	</body>
</html>