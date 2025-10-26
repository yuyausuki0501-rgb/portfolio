<?php 
session_name('DrivingSchool');
session_start();
require_once __DIR__.'/../functions/functions.php';
require_once __DIR__.'/../config/db_connect.php';
require_once __DIR__.'/../classes/userLogic.phpS';


if(!isset($_SESSION['login_user'])){
    echo 'ログイン処理をしてください';
    exit();
}

//バリデーション
    $err = [];
    if(!isset($_POST['departure_datetime'])){
        header('Location: reservation_form.php');
        exit();
    }

?>