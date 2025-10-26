<?php
session_name('DrivingSchool');
session_start();
require_once __DIR__.'/../classes/userLogic.php';
require_once __DIR__.'/../functions/functions.php';
require_once __DIR__.'/../inc/header.php';

$err = [];

$token = filter_input(INPUT_POST,'csrf_token');
    //トークンがない、または一致しない場合は処置を中止
      if(!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token'] ){
        exit('不正なリクエスト');
    }
//トークンが一致したらトークンを削除    
unset($_SESSION['csrf_token']);

//バリデーション
if(!$name = filter_input(INPUT_POST,'name')){
    $err[] ='名前を入力してください';//未入力
}
if(!$number = filter_input(INPUT_POST,'studentNumber')){
    $err[] = '教習生番号を入れてください';//教習生 未入力
}
$number = filter_input(INPUT_POST,'studentNumber');
if(!preg_match("/^[0-9]{6}$/",$number)){
    $err[] = '６桁の教習生番号を入れてください';
}

$password = filter_input(INPUT_POST,'password');//パスワード

$password_conf = filter_input(INPUT_POST,'password_conf');//パスワード確認用

if (!preg_match("/^[0-9]{4,20}$/", $password)) {
    $err[] = 'パスワードは数字を４文字以上入れてください';//パスワードバリデーション
}

if ($password !== $password_conf) {//確認用パスワードバリデーション
    $err[] = 'パスワードが一致していません。';
}
if(count($err) === 0){ 
    //ユーザーを登録する処理
    $hasCreated = Userlogic::createUser($_POST);
    if(!$hasCreated){
        $err[] = '登録失敗しました';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録完了</title>
</head>
<body>
    <?php if (count($err) > 0) :?>
    <?php foreach($err as $e) :?>
        <p><?php echo $e ?></p>
    <?php endforeach ?> 
    <?php else: ?>
        <p>ユーザー登録が完了しました。</p>
    <?php endif ?>
    <a href="signup.php">戻る</a>
</body>
</html>
