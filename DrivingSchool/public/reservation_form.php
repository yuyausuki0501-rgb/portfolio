<?php 
    session_name('DrivingSchool');
    session_start();
    require_once __DIR__.'/../config/db_connect.php';
    require_once __DIR__ . '/../classes/userLogic.php';
    require_once __DIR__.'/../functions/functions.php';

    if(!isset($_SESSION['login_user'])){
        echo 'ログイン処理が行われておりません。';
        echo "<a href='login.php'>ログイン</a>";
    }


//サニタイズ
    $get_id = filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT);
    $get_address = filter_input(INPUT_GET,'address',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
//DB接続
    $spotContent = Reservation::getLocationSpot($get_id);


//GETした住所でiframeを作成
    $google_map_address = urlencode($get_address);
    $google_map = "https://maps.google.com/maps?q={$google_map_address}&output=embed";


//ID、addressを確認
    if(!isset($get_id)||empty($get_id)){
        header('Location: top.php');
        exit('無効なリクエストです。');
    }
    if(!isset($get_address) || empty($get_address)){
        header('Location: top.php');
        exit('無効なリクエストです。');
    }

//出力した内容を展開する
if($spotContent){
    $location_name = h($spotContent['location_name']);
    $address = h($spotContent['address']);
    $notes = h($spotContent['notes']);
}else{
    echo '指定されたIDが見つかりませんでした。';
    header('Location: top.php');
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>送迎予約フォーム</title>
</head>
<body>
    <!-- ユーザー名を表示 -->
    <?php if(isset($_SESSION['loginUser']['name'])) : ?>
    <?php $name = $_SESSION['loginUser']['name'];  ?>
    <p><?php echo  h($name) . ' さんでログインしています。'; ?></p>
    <?php endif ?>
    <h1>送迎予約フォーム</h1>
    <h2>予約する日時を決めてください</h2>
    <br>
    <iframe src="<?php echo $google_map?>" frameborder="1"></iframe>
    <h2>送迎場所：<?php echo h($location_name) ?></h2>
    <br>
    <h3>住所：<?php echo h($address) ?></h3>
    <br>
    <p>備考：<?php echo h($notes) ?></p>

    <form action="reservation_confirm.php" method="POST" >
        <label for="departure_datetime">迎えの予約時間：</label>
        <input type="datetime-local" name="departure_datetime" id="departure_datetime">
        <br>
        <br>
        <label for="return_datetime">帰りの予約時間:</label>
        <input type="datetime-local" name="return_datetime" id="return_datetime">
        <br><br>
        <button type="submit">この時間で予約する</button>
    </form>

   
  
</body>
</html>