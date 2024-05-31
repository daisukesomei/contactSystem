<?php
/* プログラム名：login.php
 * プログラム説明：ログイン画面の作成
 * 作成日時：2024/05/28
 * 作成者：井出愛美
 */

session_start();

// ファイル取り込み
include 'dbprocess.php';

// ログインボタンを押した場合
if (isset($_POST['loginExec'])) {
    
    //     ポスト送信された値を変数に代入
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    
    //     送信された情報と一致するものがデータベースにあるか確認するSQL文の用意
    $sql = "select * from userinfo where user='{$user}' and password='{$pass}'";
    
    //     SQL文の発行
    $result = executeQuery($sql);
    
    //     結果件数の取得
    $rows = mysqli_num_rows($result);
    
    
    
    //     件数が０の場合(データベースに一致する情報がなかった場合)
    if ($rows == 0) {
        $errMsg = "入力されたユーザー名とパスワードが間違っています";
        header("Location: ./login.php?errMsg={$errMsg}");
        exit();
    }
    //     情報があった場合
    else {
        //         結果の行を連想配列で取得
        $userInfo = mysqli_fetch_assoc($result);
        
        //         データベースから取得した情報をセッションに保存
        $_SESSION["userInfo"] = $userInfo;
        
        //         クッキーを設定(前回のログイン情報を残すため)
        setcookie("user", $user, (time() + 30 * 86400), '/');
        setcookie("pass", $pass, (time() + 30 * 86400), '/');
        
        header("location: ./adminMenu.php");
    }
}
// 二回目以降のログイン
else {
    
    //     クッキー情報の取得
    $user = $_COOKIE['user'];
    $pass = $_COOKIE['pass'];
}

?>



<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Style-Type" content="text/css" />
		<title>Login</title>
		<style>
        body {
        background-color:#eee;
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
		</div>
		<h2 align="center" style="color:black;">ログイン</h2>
	</div>
	</header>
		<br>
		<br>
		<br>
		<br>
	<div class="main-area">
	<div class="white-area" align="center">
   <form action="login.php" method="post">
    <table style="margin: 0 auto;">
    <tr>
    <th>ID</th>
    <!-- 		クッキー情報の取得(あれば)を取得するためvalueに変数を埋める -->
    <td><input type="text" name="user" value="<?=$user?>"></td>
    </tr>
    <tr>
    <th>パスワード</th>
    <td><input type="password" name="pass" value="<?=$pass?>"></td>
    </tr>
    </table>
    <?=$_GET['errMsg']?>
    <br> <br> 
    
    <input type="submit" name="loginExec" value="ログイン">
    </form>
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