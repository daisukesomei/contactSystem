<?php
/* プログラム名：お問い合わせフォーム　homepage
 * プログラムの説明：ホームページの表示
 * 作成者：
 * 作成日：2024年5月28日
 */

header('Content-type: text/html; charset=UTF-8');

session_start();

?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Style-Type" content="text/css" />
		<title>Homepage</title>
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
    		<h1 align="center" style="margin-top: 21px;color:#fff;">神田英会話スクール</h1>
    	</div>
    	<div  style="position:relative;border-bottom:solid 3px darkBlue;height:80px;padding:3px;background-color:#fff;">
    		<div style="position:absolute;top:8px;left:20px;">
    		</div>
    		<h2 align="center" style="color:black;">ＭＥＮＵ</h2>
    	</div>
	</header>
    	<br><br>
    	<div class="main-area">
            <div class="white-area">
                <table align="center">
                <tr><td><h5><a href="contactForm.php">【お問い合わせフォーム】</a></h5></td></tr>  
                </table>
            
            	<!-- 管理者画面用ボタン（必要あれば） -->
            	<br><br><br>
            	<div align="center">
            	<form action="login.php">
            		<input type="submit" value="管理者用ボタン">
            	</form>
            	</div>
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