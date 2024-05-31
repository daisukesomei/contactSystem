<?php

/* プログラム名：お問い合わせフォームPasswordChange
 * プログラムの説明：パスワード変更
 * 作成者：
 * 作成日：2024年5月28日
 */

header('Content-type: text/html; charset=UTF-8');

session_start();

if (!isset($_SESSION["userInfo"])) {
    $errMsg = "セッションが切れています。";
    header("Location: ./error.php?errMsg={$errMsg}&path=logout.php");
}

// セッション情報の取得
$userinfo = $_SESSION['userInfo'];

// データ情報の取得
$user = $userinfo['user'];
$pass = $userinfo['password'];

// include関数を使ってファイルを読み込む
include 'dbprocess.php';

// 変更ボタンを押した場合
if (isset($_POST['changeExec'])) {
    
    //     ポスト送信された値を変数に代入
    $oldpass = $_POST['oldpass'];
    $newpass = $_POST['newpass'];
    $repass = $_POST['repass'];
    
    //     エラー処理
    
    
    //    旧パスワードが未入力の場合
    if ($oldpass == ""){
        header("Location: ./error.php?errMsg=旧パスワードが未入力です。&path=passwordChange.php");
        exit();
    }
    
    //     旧パスワードが間違っている場合
    elseif ($oldpass != $pass) {
        header("Location: ./error.php?errMsg=旧パスワードが違います。&path=passwordChange.php");
        exit();
    }
    
    
    //    旧パスワードと新パスワードが同じの場合
    elseif ($oldpass == $newpass){
        header("Location: ./error.php?errMsg=そのパスワードは既に使われています。&path=passwordChange.php");
        exit();
    }
    
    
    //    新パスワードが未入力の場合
    elseif ($newpass == ""){
        header("Location: ./error.php?errMsg=新パスワードが未入力です。&path=passwordChange.php");
        exit();
    }
    
    //    新パスワード(確認用)が未入力の場合
    elseif ($repass == ""){
        header("Location: ./error.php?errMsg=新パスワード(確認用)が未入力です。&path=passwordChange.php");
        exit();
    }
    
    //    新パスワードと新パスワード(確認用)が一致しない場合
    elseif ($newpass != $repass){
        header("Location: ./error.php?errMsg=パスワードが一致しません。&path=passwordChange.php");
        exit();
    }
    
    //    パスワード更新のSQL文の用意
    $sql = "UPDATE userinfo SET password = '{$newpass}' WHERE user = '{$user}'";
    
    //    SQL文の発行
    executeQuery($sql);
    
    //   セッション情報の削除(パスワードのみ)
    unset($_SESSION['userInfo']['password']);
    
    //    新パスワードのセッション登録
    $_SESSION["userInfo"]['password'] = $newpass;
    
    $changeMsg ="パスワードを変更しました。";
    
    setcookie("user", $user, (time() + 30 * 86400), '/');
    setcookie("pass", $newpass, (time() + 30 * 86400), '/');
}

?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Style-Type" content="text/css" />
		<title>passwordChange</title>
		<style>
        body {
        background-color:#eee;
        }
        .main-table th {
        padding:4px;
        }
        .white-area {
        background-color:#fff;
        padding:40px;
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
		<h2 align="center" style="color:black;">パスワード変更</h2>
	</div>
	</header>	
    <br><br>
    
    <div class="main-area">
    <div class="white-area">
    <?php if (!isset($_POST['changeExec'])){?>
    <form action="passwordChange.php" method="post">
        <table align="center" class="main-table">
        <tr>
        <th bgcolor="royalblue" width=200px style="color:#fff;">ユーザー</th>
        <td width=200px><?=$user?></td>
        </tr>
        <tr>
        <th bgcolor="royalblue" width=200px style="color:#fff;">旧パスワード</th>
        <td width=200px><input type="password" name="oldpass"></td>
        </tr>
        <tr>
        <th bgcolor="royalblue" width=200px style="color:#fff;">新パスワード</th>
        <td width=200px><input type="password" name="newpass"></td>
        </tr>
        <tr>
        <th bgcolor="royalblue" width=150px style="color:#fff;">新パスワード(確認用）</th>
        <td width=200px><input type="password" name="repass"></td>
        </tr>
        </table>
        <br><br><br>
        <div align="center">
        <input type="submit" name="changeExec" value="変更">
        </div>
        </form>
    <br>
<?php }else {?>
<div align="center">
<br><br><br>
<h4><?=$changeMsg?></h4><br>
<a href="login.php">[ログイン画面へ戻る]</a>
</div>
<?php }?>
</div>
    <br>
	<br>
	<br>
	<br>
	<br>
</div>
	<!-- フッター -->
	<br>
	<br>
	<br>
	<br>
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