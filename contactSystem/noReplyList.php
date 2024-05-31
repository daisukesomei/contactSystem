<?php
/* プログラム名：お問い合わせフォーム　PasswordChange
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

require_once 'dbprocess.php';

//検索用SQL文
$sql ="SELECT * FROM contactinfo WHERE sendmail = '1' ORDER BY number DESC";
$result = executeQuery($sql);
$rows = mysqli_num_rows($result);

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
        .main-table th {
        padding-bottom:20px;
        color:darkblue;
        }
        .white-area {
        background-color:#fff;
        padding:30px 40px;
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
		<h2 align="center" style="color:black;">未返信一覧</h2>
	</div>
	</header>	
    	<br><br>
    	
    	<div class="main-area">
    	<div class="white-area">
    	<table align="center" border="0" class="main-table">
    		<tr>
    			<th>No.</th>
    			<th>名前</th>
    			<th>種類</th>
    			<th>お問い合わせ日時</th>
    			<th>お問い合わせ内容</th>
    			<th></th>
    			<th></th>
    		</tr>
    		
    		<?php if($rows>0){?>
    		<?php while($row = mysqli_fetch_array($result)){?>
    		<tr>
    			<td width="30"><a href="contactDetail.php?number=<?=$row['number']?>"><?=$row['number']?></td>
    			<td width="80"><?=$row['name']?></td>
    			<td width="130">
    			<?php if($row['category'] == 1){
    			    echo '<img src="./img/pay.png">';
    			} elseif($row['category'] == 2){
    			    echo '<img src="./img/course.png">';
    			} elseif($row['category'] == 3){
    			    echo '<img src="./img/how_to_study.png">';
    			} elseif($row['category'] == 4){
    			    echo '<img src="./img/period.png">';
    			} elseif($row['category'] == 5){
    			    echo '<img src="./img/support.png">';
    			}
                 ?>
				</td>
    			<td width="190">
    			<?php 
    			     echo date("Y/m/d", strtotime($row['date']));
    			     $week = array( "日", "月", "火", "水", "木", "金", "土" );
    			     echo "({$week[date("w", strtotime($row['date']))]})";
    			     echo date("H:i", strtotime($row['date']));
    			?>
                </td>
    			<td width="250">
    			<?php echo mb_substr($row['content'],0,25);
    			      if(mb_strlen($row['content']) > 26){
    			         echo "…";
    			}?>
    			</td>
    			<td width="50">
    			<?php if($row['sendmail'] == 1){
                            echo '<img src="./img/noreply.png">';
                        } elseif($row['sendmail'] == 2){
                            echo '<img src="./img/reply.png">';
                        }
                 ?>
                 </td>
                 <td width="50">
                     <form action="sendEmail.php" method="post" style="margin-bottom:0;">
                     	<input type="hidden" name="number" value="<?=$row['number']?>">
                     	<input type="image" src="img/mail.png" name="mailExac" alt="メール送信">
                     </form>    			
    			 </td>
    		</tr>
    		
    		<?php }}else{ ?>
        		<tr><td colspan="6" align="center">未返信のお問い合わせは１件もありません。</td></tr>
    		<?php }   mysqli_free_result($result);?> 
    	</table>
        </div>
        </div>
    <br><br><br><br><br><br><br><br>
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