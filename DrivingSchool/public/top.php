<?php

session_name('DrivingSchool');
session_start();
require_once __DIR__.'/../classes/userLogic.php';
require_once __DIR__.'/../functions/functions.php';
require_once __DIR__.'/../inc/header.php';

//ログイン失敗時の処理
if(!isset($_SESSION['login_user'])){
    exit('ログインしてください。');
}

if(!$_SESSION['login_user']) {
    header('Location: login.php');
    return; 
}
echo 'ログインしました'; 

$date = date('m/d');
?>




<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録完了</title>
</head>
<body>
   
    <?php if(isset($_SESSION['login_user']['name'])) : ?>
    <?php $name = $_SESSION['login_user']['name'];  ?>
    <p><?php echo 'ようこそ ' . h($name) . ' さん!'; ?></p>
    <?php endif ?>
    <p>本日は<?php echo $date?>日です</p>
  
    <h2><a href="reservation.php">新規送迎予約</a></h2>
    
    <a href="login.php">戻る</a>
</body>
</html> 
<?php require_once __DIR__.'/../inc/footer.php';?>