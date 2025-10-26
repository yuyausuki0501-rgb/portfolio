<?php   
session_name('DrivingSchool');
session_start();
require_once __DIR__.'/../classes/userLogic.php';
require_once __DIR__.'/../config/db_connect.php';

if(!isset($_SESSION['login_user'])){
    exit('ログイン処理をしてください。');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>予約場所を指定してください</h1>

    <h2><a href="location.php?city=角田市">角田市</a></h2>
    <h2><a href="location.php?city=丸森町">丸森町</a></h2>
    <h2>柴田郡船岡</h2>
    <h2>大河原町</h2>


   
</body>
</html>
