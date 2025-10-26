<?php 

    session_name('DrivingSchool');
    session_start();
        require_once __DIR__.'/../functions/functions.php';
        require_once __DIR__.'/../inc/header.php';
        
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>新規登録画面</h1>
    <form action="register.php" method="POST" >
        <p>
            <label for="name">名前</label>
            <input type="name" name="name">
        </p>
        <p>
            <label for="number">教習生番号</label>
            <input type="number" name="studentNumber">
        </p>
        <p>
            <label for="password">パスワード</label>
            <input type="password" name="password">
        </p>  
        <p>
            <label for="password_conf">パスワード確認</label>
            <input type="password" name="password_conf">
        </p>
        <p>
            <input type="hidden" name="csrf_token" value="<?php echo h(setToken());?>" >
        </p>
        <input type="submit" value="新規登録">
    </form>
</body>
</html>
<?php require_once __DIR__.'/../inc/footer.php'; ?>