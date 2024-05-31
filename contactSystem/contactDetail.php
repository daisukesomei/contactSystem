<?php
/* プログラム名:お問い合わせ詳細　contactDetail.php
 * プログラムの説明：お問い合わせ詳細の表示
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

//list.phpから選択したisbn情報取得
if(isset($_GET['number'])){
    $number = $_GET['number'];
}elseif (isset($_POST['number'])){
    $number = $_POST['number'];
}

//詳細表示対象ISBNの書籍情報取得
$sql = "SELECT * FROM contactinfo WHERE number ='{$number}'";
$result = executeQuery($sql);
$rows = mysqli_num_rows($result);

//詳細情報のデータチェック
if($rows == 0){
    $errMsg = "詳細対象のデータが存在しない為、詳細情報処理は行えません。";
    header("Location:./error.php?errMsg={$errMsg}&path=contactList.php");
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
    $category="①料金・お支払いについて";
}elseif($row['category']==2){
    $category="②講座、コース、教材について";
}elseif($row['category']==3){
    $category="③学習の進め方について";
}elseif($row['category']==4){
    $category="④受講期限について";
}elseif($row['category']==5){
    $category="⑤受講終了後のサポートについて";
}
$content = $row['content'];

mysqli_free_result($result);

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<title>ContactDetail</title>
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
		<h2 align="center" style="color:black;">お問い合わせ詳細</h2>
	</div>
	</header>
	
	<br><br>
	
	<div class="main-area">
    <div class="white-area">
    	<form action="sendEmail.php" method="post">
                         	<input type="hidden" name="number" value="<?=$number?>">
                         	<input type="image" src="img/mail.png" alt="メール送信">
        </form>  
	
		<br>
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
				<th bgcolor="royalblue" width=200px height=100px style="color:#fff;">お問い合わせ自由記入</th>			
				<td><?=$content?></td>
			</tr>
		</table>
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
