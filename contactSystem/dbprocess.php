<?php
//DBへSQLを発行する関数を提供
function executeQuery($sql){
    $url = "localhost";         //ホスト名
    $user = "root";               //ユーザー名
    $pass = "root123";           //パスワード
    $db = "mycontactdb";            //データベース
    
    //MariaDBへ接続
    $link = mysqli_connect($url,$user,$pass) or die("MariaDBへの接続に失敗しました>>");
    
    //データベース選択
    mysqli_select_db($link,$db) or die("データベースの選択に失敗しました");
    
    //クエリを送信する。
    $result = mysqli_query($link,$sql) or die("クエリの送信に失敗しました。SQL:".$sql);
    
    //MariaDBへの接続を閉じる
    mysqli_close($link);
    
    //SQL文の結果を返す（戻り値）
    return($result);
}
?>