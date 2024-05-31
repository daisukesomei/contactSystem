<?php
/* プログラム名		：contactForm.php
 * プログラム説明	：コンタクトフォーム画面の作成
 * 作成日時			：2024/05/29
 * 作成者			：井出愛美
 */



require_once ("dbprocess.php");

//メールテンプレ
$template = "例)料金の支払いは銀行振込のみになりますでしょうか？";

//送信データを変数に代入
$name = $_POST['name'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$address = $_POST['address'];
$category = $_POST['category'];
$content = $_POST['content'];


if(isset($_POST['Exec'])){
    // エラーメッセージ
    if (empty($email)) {
        header("Location:./error.php?errMsg=メールアドレスが未入力の為、お問い合わせは行えませんでした。&path=contactForm.php");
        exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location:./error.php?errMsg=メールアドレスが不正の為、お問い合わせは行えませんでした。&path=contactForm.php");
        exit();
    } elseif (empty($name)) {
        header("Location:./error.php?errMsg=名前が未入力の為、お問い合わせは行えませんでした。&path=contactForm.php");
        exit();
    } elseif (empty($age)) {
        header("Location:./error.php?errMsg=年齢が未入力の為、お問い合わせは行えませんでした。&path=contactForm.php");
        exit();
    } elseif (!is_numeric($age)) {
        header("Location:./error.php?errMsg=年齢の値が不正の為、お問い合わせは行えませんでした。&path=contactForm.php");
        exit();
    } elseif ($age<0 || $age>130) {
        header("Location:./error.php?errMsg=年齢の値が不正の為、お問い合わせは行えませんでした。&path=contactForm.php");
        exit();
    } elseif (empty($gender)) {
        header("Location:./error.php?errMsg=性別が未入力の為、お問い合わせは行えませんでした。&path=contactForm.php");
        exit();
    } elseif (empty($address)) {
        header("Location:./error.php?errMsg=住所が未入力の為、お問い合わせは行えませんでした。&path=contactForm.php");
        exit();
    } elseif (empty($content)) {
        header("Location:./error.php?errMsg=お問い合わせ自由記入欄が未入力の為、お問い合わせは行えませんでした。&path=contactForm.php");
        exit();
    }
    
    
    //SQL文用意
    $sql = "INSERT INTO contactinfo VALUES(null,'{$name}','{$age}','{$gender}','{$email}','{$address}','{$category}','{$content}','1',null)";
    executeQuery($sql);
    
    
    //メール送信
    
    //メール送信準備
    mb_language("japanese");
    mb_internal_encoding("UTF-8");
    $to= $email; 
    $sbj="お問い合わせ受け付けました（神田英会話スクール）";
    //本文を一部用意
    $body = $name."様\n\nお問い合わせいただき\nありがとうございます。\n\n確認いたしまして、\n回答の返信をいたします。\n\n少しお時間をいただければ幸いです。\n何卒、よろしくお願いいたします。\n\n神田英会話スクール\n白石　大";
    $hdr = "Content-Type: text/plain;charset=ISO-2022-JP";
    
    //メール送信
    $result = mb_send_mail($to, $sbj, $body, $hdr);
}
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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
	<div  style="position:relative;border-top:solid 5px darkBlue;border-bottom:solid 3px darkBlue;height:80px;background-color:#fff;">
		<h1 align="center" style="color:darkblue;">お問い合わせフォーム</h1>
	</div>
	</header>
	<br>
	<br>
	<div class="main-area">
    <div class="white-area" align="center">
		<?php if($_POST["Exec"]){?>
		<h3 align="center">送信完了しました</h3>
		<br>
		<br>
		<a href="contactForm.php">[お問い合わせフォームに戻る]</a>
		<?php }else{?>
		<form action="contactForm.php" method="post">
		<table>
			<tr>
				<th bgcolor="royalblue" width=200px style="color:#fff;">メールアドレス</th>
				<td width="200"><input type="text" name="email"></td>
			</tr>
			<tr>
			</tr>
			<tr>
				<th bgcolor="royalblue" width=200px style="color:#fff;">名前</th>
				<td width="200"><input type="text" name="name"></td>
			</tr>
			<tr>
				<th bgcolor="royalblue" width=200px style="color:#fff;">年齢</th>
				<td width="200"><input type="text" name="age"></td>
			</tr>
			<tr>
				<th bgcolor="royalblue" width=200px style="color:#fff;">性別</th>
				<td width="200">
					<input type="radio" name="gender" value="1" checked="checked">男性
					<input type="radio" name="gender" value="2">女性
				</td>
			</tr>
			<tr>
				<th bgcolor="royalblue" width=200px style="color:#fff;">住所</th>
				<td width="200"><input type="text" name="address"></td>
			</tr>
			<tr>
				<th bgcolor="royalblue" width=200px style="color:#fff;">問い合わせ項目</th>
				<td>
					<select name="category">
						<option value="1">①料金・支払いについて</option>
						<option value="2">②講座、コース、教材について</option>
						<option value="3">③学習の進め方について</option>
						<option value="4">④受講期限について</option>
						<option value="5">⑤受講終了後のサポートについて</option>
					</select>
				</td>
			</tr>
			<tr>
				<th bgcolor="royalblue" width=200px height="100" style="color:#fff;">お問い合わせ自由記入<br>(200文字）</th>			
				<td width="200" height="100"><textarea name="content" rows="10" cols="22" maxlength="200"><?=$template?></textarea></td>
			</tr>
		</table>
		<br>
		<input type="submit" name="Exec" value="送信">
		</form>
		
		<br><br>
		<a href="homepage.php">[ホームへ戻る]</a>
		<?php }?>
		<br>
	</div>
	</div>
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