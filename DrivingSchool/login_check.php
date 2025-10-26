<?php 
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    
    session_name('DrivingSchool');
    session_start();

    require_once __DIR__.'/config/db_connect.php';
    require_once __DIR__.'/functions/functions.php';
    

    $err = [];

    // CSRFチェック
    $token = filter_input(INPUT_POST, 'csrf_token');
    if (!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {
        exit('不正なリクエスト');
    }
    unset($_SESSION['csrf_token']);

    //入力チェック
    $studentNumber = filter_input(INPUT_POST,'studentNumber');
    $password = filter_input(INPUT_POST,'password');
    //未入力時
    if(!$studentNumber){
        $err['studentNumber'] = '教習生番号を入力してください。';
    }
    if(!$password){
        $err['password']='パスワードを入力してください。';
    }

    if(count($err)>0){
        $_SESSION['err']=$err;
        header('Location: public/login.php');
        exit;
    }
  
   
    //入力確認後sqlで確認
    $dbh = dbConnect();
    $sql = "SELECT * FROM login WHERE studentNumber = :studentNumber LIMIT 1";
    $stmt = $dbh->prepare($sql);
    $stmt->bindvalue(':studentNumber',$studentNumber,PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);


    if(!$user || !password_verify($password,$user['password'])){
        //パスワードが存在しない、パスワードが違う場合
        $err['msg'] = '教習生番号またはパスワードが違います。';

        $_SESSION['err'] = $err;
        header('Location: public/login.php');
        exit;
    }

    //ログイン成功時
    $_SESSION['login_user'] = $user;
    header('Location: public/top.php');
    exit;
?>
