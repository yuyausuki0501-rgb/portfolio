<?php 
session_start();
require_once __DIR__ . '/../config/db_connect.php';
require_once(__DIR__ . '/../classes/userLogic.php');
require_once(__DIR__ . '/../functions/functions.php');


//角田市の送迎場所を取得
$city = '角田市';
$location = Reservation::getcity($city);
var_dump($location);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>角田市内の送迎場所</title>
</head>
<body>
<?php if(isset($_SESSION['login_user']['name'])) : ?>
    <?php $name = $_SESSION['loginUser']['name'];  ?>
    <p><?php echo  h($name) . ' さんでログインしています。'; ?></p>
    <?php endif ?>
    <h1>角田市内の送迎場所</h1>
    <p><?php foreach($location as $spot): ?>
        <a href="../reservation_form.php/?id=<?php echo $spot['id']; ?>"><?php echo $spot['location_name']?></a><?php echo"</br>";?>
        <?php echo h($spot['address'])."</br>";?>
        <?php echo h('乗降場所：'.$spot['notes'])."</br>","</br>";?>
        <?php endforeach; ?>
    </p>

<!--  -->


</body>
</html>