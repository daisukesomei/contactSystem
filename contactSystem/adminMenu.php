<?php
/* プログラム名：お問い合わせフォームadminMenu
 * プログラムの説明：メニューの表示
 * 作成者：
 * 作成日：2024年5月28日
 */

header('Content-type: text/html; charset=UTF-8');

session_start();

if (!isset($_SESSION["userInfo"])) {
    $errMsg = "セッションが切れています。";
    header("Location: ./error.php?errMsg={$errMsg}&path=logout.php");
}

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<title>AdminMenu</title>
<style>
    body {
    background-color:#eee;
    }
    .white-area {
    background-color:#fff;
    padding:40px 60px;
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
			<a href="adminMenu.php"><img src="img/home_btn.png" alt="ホーム" style="width:70px;"></a>
			<a href="contactList.php"><img src="img/contact_btn.png" alt="お問い合わせ" style="width:70px;"></a>
		</div>
		<h2 align="center" style="color:black;">メニュー</h2>
	</div>
	</header>
    
    <br><br>
    <div class="main-area">
    <div class="white-area">
        <table align="center">
        <tr><td style="padding:10px;"><h4><a href="contactList.php">【お問い合わせ一覧】</a></h4></td></tr>
        <tr></tr>
        <tr><td style="padding:10px;"><h4><a href="noReplyList.php">【未返信一覧】</a></h4></td></tr>
        <tr></tr>
        <tr><td style="padding:10px;"><h4><a href="passwordChange.php">【パスワード変更】</a></h4></td></tr>
        <tr></tr>
        <tr><td style="padding:10px;"><h4><a href="logout.php">【ログアウト】</a></h4></td></tr>   
        
        </table>
     </div>
     </div>
    
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