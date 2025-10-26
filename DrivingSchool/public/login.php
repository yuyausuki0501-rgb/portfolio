<?php 
session_name('DrivingSchool');
session_start(); 

require_once __DIR__.'/../config/db_connect.php';//DBコネクトをリクワイア




// CSRFトークンを生成
if (empty($_SESSION['csrf_token'])) {  
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$err = $_SESSION;


$err = [];
if (!empty($_SESSION['err'])) {
    $err = $_SESSION['err'];
    unset($_SESSION['err']); // 一度だけ取り出したら消す
    }
?>




<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>送迎予約システム</title>
</head>
<body>
    <h1>送迎予約システム</h1>
    <p>ログイン画面</p>
    <?php if(isset($err['msg'])) :?>
            <p><?php echo $err['msg']; ?></p>
    <?php endif; ?>
   
    <form action="../login_check.php" method="POST" >
        <p>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

            <label for="number">教習生番号</label>
            <input type="number" name="studentNumber">
            <?php if(isset($err['studentNumber'])) :?>
                <p><?php echo $err['studentNumber']; ?></p>
            <?php endif; ?>
            <?php if(isset($err['studentNumber_conf'])) :?>
                <p><?php echo $err['studentNumber_conf']; ?></p> 
                <?php endif; ?>  
        </p>
        <p>
            <label for="password">パスワード</label>
            <input type="password" name="password"> 
            <?php if(isset($err['password'])): ?>
                <p><?php echo $err['password'];?></p>
                <?php endif; ?> 
        </p>  
        
        <input type="submit" value="ログイン">
    </form> 
    
    <p>新規登録の方は <a href=signup.php>こちら</a></p>
    
</body>
</html>
<?php require_once __DIR__.'/../inc/footer.php';?>