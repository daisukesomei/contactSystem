<?php
/* プログラム名:お問い合わせ詳細　sendDetail.php
 * プログラムの説明：メール送信機能
 * 作成者：
 * 作成日：2024年5月29日
 */

header('Content-type: text/html; charset=UTF-8');

session_start();

if (!isset($_SESSION["userInfo"])) {
    $errMsg = "セッションが切れています。";
    header("Location: ./error.php?errMsg={$errMsg}&path=logout.php");
}

require_once 'dbprocess.php'; // データベースプロセスファイル読み込み

//number情報取得
if (isset($_POST['number'])){
    $number = $_POST['number'];
}

//詳細表示対象ISBNの書籍情報取得
$sql = "SELECT * FROM contactinfo WHERE number ='{$number}'";
$result = executeQuery($sql);
$rows = mysqli_num_rows($result);

//詳細情報のデータチェック
if($rows == 0){
    $errMsg = "メール送信対象のデータが存在しない為、メール送信処理は行えません。";
    header("Location: ./error.php?errMsg={$errMsg}&path=contactList.php");
    exit;
}

//書籍情報からisbn,title,priceの値取得
$row = mysqli_fetch_array($result);
$email = $row['email'];
$name = $row['name'];
$age = $row['age'];
if($row['gender']==1){
    $gender="男性";
}elseif($row['gender']==2){
    $gender="女性";
}
$address = $row['address'];
if($row['category']==1){
    $category="料金・お支払いについて";
}elseif($row['category']==2){
    $category="講座、コース、教材について";
}elseif($row['category']==3){
    $category="学習の進め方について";
}elseif($row['category']==4){
    $category="受講期限について";
}elseif($row['category']==5){
    $category="受講終了後のサポートについて";
}
$content = $row['content'];

mysqli_free_result($result);


if(isset($_POST['replyExac'])){
    if($_POST['message']==""){
        $errMsg = "本文が未入力の為、メール返信は行えませんでした。";
        header("Location:./error.php?errMsg={$errMsg}&path=contactList.php");
        exit;
    }
    
    
    //メール送信
    //メール送信準備
    mb_language("japanese");
    mb_internal_encoding("UTF-8");
    $to = $email;
    $sbj = "お問い合わせいただいた{$category}";
    $body = $_POST['message'];
    $hdr = "Content-Type: text/plain;charset=ISO-2022-JP";
    
    //メール送信
    $resultMail = mb_send_mail($to, $sbj, $body, $hdr);
    
    //sendmail項目更新
    $sql = "UPDATE contactinfo SET sendmail='2' WHERE number ='{$number}'"; // 全検索SQL文
    $result = executeQuery($sql); // SQL発行
    
}

//メールテンプレ
$template = <<<__LONG_STRRING__
{$name}様


























神田英会話スクール\n白石　大
__LONG_STRRING__;

?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Style-Type" content="text/css" />
		<title>SendEmail</title>
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
        .table{
        table-layout: fixed;
        width: 450px;
        }

        .table td{
        word-wrap: break-word;
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
		<h2 align="center" style="color:black;">メール返信</h2>
	</div>
	</header>
		<br><br>
		
		<div class="main-area">
    	<div class="white-area"  align="center">
		<?php if(!isset($_POST['replyExac'])){  ?>
		<table>
			<tr>
				<th bgcolor="#DDDDD" width="200" style="padding:8px;">メール返信</th>
			</tr>
		</table>
		<br><br>
		<form action="sendEmail.php" method="post">
		<table>
			<tr>
				<textarea rows="30" cols="80" name="message"><?=$template?></textarea>
			</tr>
		</table>
		<br>
			<input type="hidden" name="number" value="<?=$number?>">
			<input type="submit" name="replyExac" value="返信">
		</form>
		
		<br><br>
		<table class="table">
			<tr>
				<th bgcolor="royalblue" width=200px style="color:#fff;">メールアドレス</th>
				<td><?=$email?></td>
			</tr>
			<tr>
			</tr>
			<tr>
				<th bgcolor="royalblue" width=200px style="color:#fff;">名前</th>
				<td><?=$name?></td>
			</tr>
			<tr>
				<th bgcolor="royalblue" width=200px style="color:#fff;">年齢</th>
				<td><?=$age?></td>
			</tr>
			<tr>
				<th bgcolor="royalblue" width=200px style="color:#fff;">性別</th>
				<td><?=$gender?></td>
			</tr>
			<tr>
				<th bgcolor="royalblue" width=200px style="color:#fff;">住所</th>
				<td><?=$address?></td>
			</tr>
			<tr>
				<th bgcolor="royalblue" width=200px style="color:#fff;">問い合わせ項目</th>
				<td><?=$category?></td>
			</tr>
			<tr>
				<th bgcolor="royalblue" width=200px style="color:#fff;">お問い合わせ自由記入</th>			
				<td><?=$content?></td>
			</tr>
		</table>
		<br>
		<br>
		<br>
		
		<?php }?>
		
		<?php if(isset($_POST['replyExac'])){  ?>
		<font color="red">メール返信しました</font>
		<br><br>
		[<a href="contactDetail.php?number=<?=$number?>">お問い合わせ詳細画面に戻る</a>]
		<?php }?>
		
    	</div>
    	</div>
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
