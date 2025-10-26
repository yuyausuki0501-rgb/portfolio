<?php
session_name('DrivingSchool');
session_start();
require_once __DIR__.'/../functions/functions.php';
require_once __DIR__.'/../classes/userLogic.php';

if(!isset($_SESSION['login_user'])){
    echo 'ログイン処理がされていません';
    exit;
}

if(!isset($_GET['city'])){
    exit('無効なリクエストです。');
}

$city = h($_GET['city']);
$locations = Reservation::getCity($city);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo h($city)?>の送迎場所</title>
</head>
<body>
    <h1><?php echo h($city)?>の送迎場所一覧</h1>

    <?php foreach ($locations as $location) :?>
    <h3><a href="reservation_form.php?id=<?php echo h($location['id']);?>&address=<?php echo h($location['address']);?>"><?php echo h($location['location_name'])?></a></h3>
    <p><?php echo $location['address']?></p>
    <?php endforeach ;?>
</body>
</html>