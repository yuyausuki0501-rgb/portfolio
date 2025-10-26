<?php 
session_start();
require_once __DIR__ . '/../config/db_connect.php';
require_once '/../classes/userLogic.php';
require_once '../functions/functions.php';

//角田市の送迎場所を取得
$city = '丸森町';
$location = Reservation::getcity($city);
var_dump($location);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>丸森町の送迎場所</title>
</head>
<body>
<?php if(isset($_SESSION['loginUser']['name'])) : ?>
    <?php $name = $_SESSION['loginUser']['name'];  ?>
    <p><?php echo h($name) . ' さんでログインしています。'; ?></p>
    <?php endif ?>
    <h1>丸森町内の送迎場所</h1>
    <p><?php foreach($location as $spot): ?>
        <?php echo $spot['location_name']."</br>";?>
        <?php endforeach; ?>
    </p>
    


</body>
</html>